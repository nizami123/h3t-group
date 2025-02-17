<?php
defined('BASEPATH') or exit('No direct script access allowed');
include_once(APPPATH . 'controllers/Auth.php');
class FinSupp extends Auth
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('FinSupp_model');
  }
  function generateid() {
    $randomNumericPart = rand(1, 999999999999999); 
    $data['newTR'] = str_pad($randomNumericPart, 4, '0', STR_PAD_LEFT);
    $this->output->set_content_type('application/json')->set_output(json_encode($data));
  }
  function generateinv(){
    $data['lastID'] = $this->FinSupp_model->getInvDP();
    $numericPart = isset($data['lastID'][0]['invoice_dp']) ? preg_replace('/[^0-9]/', '', $data['lastID'][0]['invoice_dp']) : '';
    $incrementedNumericPart = sprintf('%04d', intval($numericPart) + 1);
    $data['newINV'] = 'INV-' . $incrementedNumericPart;
    $data['defINV'] = 'INV-0001';
    $this->output->set_content_type('application/json')->set_output(json_encode($data));
  }
  function loadbank() {
    $searchTerm = $this->input->get('q');
    $results = $this->FinSupp_model->getBank($searchTerm);
    header('Content-Type: application/json');
    echo json_encode($results);    
  }

  public function index(){
    $cab = $this->session->userdata('id_toko');
    $data['barangcabang'] = $this->second->barangCabang($cab);
    $data['setcabang'] = $this->first->getCabang();
    $data['content'] = $this->load->view('finance/supplier/dpsupp', '', true);
    $data['modal'] = '';
    $data['css'] = '
    <link rel="stylesheet" type="text/css" href="' . base_url('assets/css/vendors/datatables.css') . '">
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
        .select2-container{
          margin-bottom :-6%;
        }
    </style>
    ';
    $data['js'] = '
    <script>var base_url = "' . base_url() . '";</script>
    <script src="' . base_url('assets/js/sweet-alert/sweetalert.min.js').'"></script>
    <script src="' . base_url('assets/js/select2/select2.full.min.js') . '"></script>
    <script src="' . base_url('assets/js/additional-js/fdpsupp.js') . '"></script>
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

  public function createpost() {
    if ($this->input->is_ajax_request()) {
      $data = [
        'id_transaksi_dp'      => $this->input->post('idtr'),
        'invoice_dp'      => $this->input->post('invdp'),
        'no_mutasi'      => $this->input->post('nomut'),
        'tgl_dp'      => $this->input->post('tgldp'),
        'id_supplier'      => $this->input->post('ids'),
        'id_bank'      => $this->input->post('idb'),
        'nominal_dp'      => $this->input->post('nominal'),
        'catatan'      => $this->input->post('catat')
      ];
      
      $this->FinSupp_model->create($data);
      echo json_encode(['status' => 'success']);
    } else {
      redirect('finance-supplier/dp-supplier');
    }
  }
  public function dpsupp() {
    $this->load->library('datatables');
    $this->datatables->select('id_supplier,nama_supplier,sum(nominal_dp) as total_dp');
    $this->datatables->from('vdpsupplier');
    $this->datatables->group_by('id_supplier');
    return print_r($this->datatables->generate());
  }
  public function getidsupp($id){
    $data['get_id']= $this->FinSupp_model->getDP($id);
    echo json_encode($data);
  }
  public function detaildp($idsupp){
    $this->load->library('datatables');
    $this->datatables->select('tgl_dp,invoice_dp,id_transaksi_dp,nominal_dp,
    CONCAT(nama_bank, "|", nama_rek) AS bank_acc, catatan');
    $this->datatables->from('vdpsupplier');
    $this->datatables->where('id_supplier',$idsupp);
    return print_r($this->datatables->generate());
  }  
  public function deletepost($id) {
    $result = $this->FinSupp_model->delete($id);
    echo json_encode($result);
  }  
}


/* End of file FinSupp.php */
/* Location: ./application/controllers/FinSupp.php */