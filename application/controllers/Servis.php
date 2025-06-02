<?php
defined('BASEPATH') or exit('No direct script access allowed');
include_once(APPPATH . 'controllers/Auth.php');
class Servis extends Auth
{
    
  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    $cab = $this->session->userdata('id_toko');
    $data['barangcabang'] = $this->second->barangCabang($cab);
    $data['setcabang'] = $this->first->getCabang();
    $data['content'] = $this->load->view('servis/servis', '', true);
    $data['modal'] = '';
    $data['css'] = '<link rel="stylesheet" type="text/css" href="'.base_url('assets/css/vendors/datatables.css').'">
    <link rel="stylesheet" type="text/css" href="' . base_url('assets/css/vendors/select2.css') . '">
    <link rel="stylesheet" type="text/css" href="'.base_url('assets/css/vendors/sweetalert2.css').'">
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
    </style>';
    $data['js'] = '<script>var base_url = "' . base_url() . '";</script>
    <script src="' . base_url('assets/js/additional-js/servis.js?v='.time().'') . '"></script>
    <script src="' . base_url('assets/js/select2/select2.full.min.js') . '"></script>
    <script src="' . base_url('assets/js/modalpage/validation-modal.js') . '"></script>
    <script src="' . base_url('assets/js/sweet-alert/sweetalert.min.js').'"></script>
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
  public function tableservis(){
    $this->load->library('datatables');
    $this->datatables->select('id_masuk,sn_brg,no_imei,nama_brg,merk');
    $this->datatables->from('listservice');
    return print_r($this->datatables->generate());
  }
  public function tabledetailservis($id){
    $this->load->library('datatables');
    $this->datatables->select('id_masuk,sn_item,item,merk, jenis, keterangan');
    $this->datatables->from('vdetailservice');
    $this->datatables->where('id_masuk', $id);
    return print_r($this->datatables->generate());
  }
  public function getItemServis() {
    $searchTerm = $this->input->get('searchTerm');

    // Build query: search by SN or item name
    $this->db->select('id_masuk, sn_brg, nama_brg, merk,jenis');
    $this->db->from('vbarangready');
    if (!empty($searchTerm)) {
        $this->db->like('sn_brg', $searchTerm);
        $this->db->or_like('nama_brg', $searchTerm);
    }
    $query = $this->db->get();

    echo json_encode($query->result());
  }
  public function addDetailServis(){
    if ($this->input->is_ajax_request()) {
       $postData = $this->input->post();
       
      $sn_brg = $this->input->post('sn_brg');
      $items = $this->input->post('items'); // JSON
      $keterangan = $this->input->post('keterangan');
      $id_user = $this->session->userdata('id_user');
     

      // Pastikan tidak null
      $decodedItems = json_decode($items, true);
      if (!is_array($decodedItems)) {
          echo json_encode(['status' => 'error', 'message' => 'Invalid items format']);
          return;
      }

      $list_tumbal = implode(',', array_column($decodedItems, 'id'));

      if (!$sn_brg || !$list_tumbal) {
          echo json_encode(['status' => 'error', 'message' => 'Missing required data']);
          return;
      }
      // Jalankan stored procedure
      $sql = "CALL proses_service_baru(?, ?, ?, ?)";
      $this->db->query($sql, array($sn_brg, $list_tumbal, $keterangan, $id_user));

      // Cek apakah prosedur berhasil (jika pakai RETURN bisa dikembangkan)
       echo json_encode(['status' => 'success', 'message' => 'Service process completed']);
    }else{
      show_404();
    }
  }


}


/* End of file Servis.php */
/* Location: ./application/controllers/Servis.php */