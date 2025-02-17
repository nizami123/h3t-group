<?php
defined('BASEPATH') or exit('No direct script access allowed');
include_once(APPPATH . 'controllers/Auth.php');
class PenList extends Auth
{
    
  public function __construct()
  {
    parent::__construct();
    $this->load->model('PenList_model');
  }

  public function index(){
    $cab = $this->session->userdata('id_toko');
    $data['barangcabang'] = $this->second->barangCabang($cab);
    $data['setcabang'] = $this->first->getCabang();
    // $data['setcabang'] = $this->PenList_model->countHJ();
    $data['content'] = $this->load->view('kasir/produklist', '', true);
    $data['modal'] = '';
    $data['css'] = '<link rel="stylesheet" type="text/css" href="'.base_url('assets/css/vendors/datatables.css').'">
    <link rel="stylesheet" type="text/css" href="' . base_url('assets/css/vendors/select2.css') . '">
    <style>
        .select2-selection__rendered {
            line-height: 35px !important;
        }
        .select2-container .select2-selection--single {
            height: 38px !important;
            padding: 2px !important;
        }
        .select2-dropdown--below {
          margin-top:-2% !important;
        }
        .select2-selection__arrow {
            height: 37px !important;
        }
        .select2-container{
          margin-bottom :-6%;
        }
    </style>';
    $data['js'] = '<script>var base_url = "' . base_url() . '";</script>
    <script src="' . base_url('assets/js/additional-js/plistproduk.js?v='.time().'') . '"></script>
    <script src="' . base_url('assets/js/select2/select2.full.min.js') . '"></script>
    <script src="' . base_url('assets/js/additional-js/id.js') . '"></script>
    <script src="' . base_url('assets/js/modalpage/validation-modal.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatables/jquery.dataTables.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/dataTables.buttons.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/jszip.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/buttons.colVis.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/vfs_fonts.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/dataTables.autoFill.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/dataTables.select.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/buttons.bootstrap4.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/buttons.html5.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/dataTables.bootstrap4.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/dataTables.responsive.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/responsive.bootstrap4.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/dataTables.keyTable.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/dataTables.colReorder.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/dataTables.fixedHeader.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/dataTables.scroller.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/custom.js') . '"></script>
    ';
    $this->load->view('layout/base', $data);
  }
  public function loadkondisi(){
    $searchTerm = $this->input->get('q');
    $results = $this->PenList_model->getKondisi($searchTerm);
    header('Content-Type: application/json');
    echo json_encode($results);
  }
  public function produklist(){
    $this->load->library('datatables');
    $jns = $this->input->post('jns'); 
    $kond = $this->input->post('kond'); 
    $cab = $this->input->post('cab'); 
    $search = $this->input->post('search');
    $this->datatables->select('id_keluar,sn_brg,nama_brg,kondisi,hrg_hpp,hrg_jual,nama_toko,status');
    $this->datatables->from('vbarangkeluar');
    if (!empty($jns) && $jns !== 'all') {
      $this->datatables->where('jenis', $jns);
    }
    if (!empty($kond) && $kond !== 'all') {
      $this->datatables->where('kondisi', $kond);
    }
    if (!empty($cab) && $cab !== 'AllCab') {
      $this->datatables->where('id_toko', $cab);
    }
    if (!empty($search)) {
      $searchTerms = explode(' ', $search);
      $likeClauses = [];
      
      foreach ($searchTerms as $term) {
          $likeClauses[] = 'concat(sn_brg, " ", nama_brg) LIKE \'%' . $this->db->escape_like_str($term) . '%\'';
      }

      $this->datatables->where(implode(' AND ', $likeClauses));
    }
    $this->datatables->where_in('status',[2,6]);
    return print_r($this->datatables->generate());
  }
  public function infoBrg($id){
    $data['get_id']= $this->PenList_model->getWhere($id);
    echo json_encode($data);
  }
  public function filtercab($cab=null){
    $decoded_cab = urldecode($cab);
    $this->load->library('datatables');
    $this->datatables->select('id_keluar,sn_brg,nama_brg,hrg_hpp,hrg_jual,nama_toko,status');
    $this->datatables->from('vbarangkeluar');
    $this->datatables->where('hrg_hpp !=0');
    $this->datatables->where('hrg_jual !=0');
    $this->datatables->where_in('status',[2,6]);
    $this->datatables->like('nama_toko', $decoded_cab);
    return print_r($this->datatables->generate());    
  }
  public function datacountHP($id = null){
    $results = $this->PenList_model->countHJ($id);
    header('Content-Type: application/json');
    echo json_encode($results);
  }
  public function exportbarcode($jns = 'all', $kond = 'all', $cab = 'AllCab', $searchTerm = ''){
    $decode_jns = urldecode($jns);
    $decode_kond = urldecode($kond);
    $decode_cab = urldecode($cab);
    $decode_search = urldecode($searchTerm);
    $decode_cab = ($decode_cab === 'AllCab') ? 'all' : $decode_cab;
    $data['products'] = $this->PenList_model->layoutbarcode($decode_jns,$decode_kond,$decode_cab,$decode_search);
    $this->load->view('print/formatbarcode',$data);
  }

}


/* End of file PenList.php */
/* Location: ./application/controllers/PenList.php */