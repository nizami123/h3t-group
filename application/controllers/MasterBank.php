<?php
defined('BASEPATH') or exit('No direct script access allowed');
include_once(APPPATH . 'controllers/Auth.php');
class MasterBank extends Auth
{
    
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Mbank_model');
  }

  public function index(){
    $cab = $this->session->userdata('id_toko');
    $data['barangcabang'] = $this->second->barangCabang($cab);
    $data['setcabang'] = $this->first->getCabang();
    $data['content'] = $this->load->view('master/masterbank', '', true);
    $data['modal'] = $this->load->view('master/modal/m_bank','',true);
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
          margin-top:-2%; !important;
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
    <script src="' . base_url('assets/js/additional-js/mbank.js') . '"></script>
    <script src="' . base_url('assets/js/additional-js/id.js') . '"></script>
    <script src="' . base_url('assets/js/modalpage/validation-modal.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatables/jquery.dataTables.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatables/datatable.custom.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/dataTables.buttons.min.js') . '"></script>
    ';
    $this->load->view('layout/base', $data);   
  }

  public function bank_json() {
    $json_file_path = FCPATH . 'assets/json/bank.json';
    $json = file_get_contents($json_file_path);
    $data = json_decode($json, true); 
    $searchTerm = $this->input->get('q');
    
    if (!empty($searchTerm)) {
        $filteredData = array_filter($data, function($item) use ($searchTerm) {
            // Perform case-insensitive search on the 'name' field
            $nameMatch = stripos($item['name'], $searchTerm) !== false;
            $codeMatch = stripos($item['code'], $searchTerm) !== false;
            return $nameMatch || $codeMatch;
        });

        $data = array_values($filteredData);
    }
    header('Content-Type: application/json');
    echo json_encode($data);
  }

  public function loadbank(){
    $this->load->library('datatables');
    $this->datatables->select('id_bank,no_rek,nama_bank,nama_rek');
    $this->datatables->from('tb_bank');
    return print_r($this->datatables->generate());
  }

  function createpost(){
    if ($this->input->is_ajax_request()) {
      $data = [
        'no_rek'      => $this->input->post('no_rek'),
        'nama_bank'      => $this->input->post('nama_bank'),
        'nama_rek'      => $this->input->post('nama_rek'),
      ];
      
      $this->Mbank_model->create($data);
      echo json_encode(['status' => 'success']);
    } else {
      redirect('master-bank');
    }
  }

  public function deletepost($id) {
    $result = $this->Mbank_model->delete($id);
    echo json_encode($result);
  }

  public function edit($id){
    $data['get_id']= $this->Mbank_model->getWhere($id);
    echo json_encode($data);
  }

  function updatepost(){
    if ($this->input->is_ajax_request()) {
      $id = $this->input->post('data_id');
      $data = [
        'no_rek' => $this->input->post('e_no_rek'),
        'nama_bank'      => $this->input->post('e_nama_bank'),
        'nama_rek'      => $this->input->post('e_nama_rek')
      ];
      
      $this->Mbank_model->update($id, $data);
      echo json_encode(['status' => 'success']);
    } else {
      redirect('master-bank');
    }
  }  
}


/* End of file MasterBank.php */
/* Location: ./application/controllers/MasterBank.php */