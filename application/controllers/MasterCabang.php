<?php
defined('BASEPATH') or exit('No direct script access allowed');
// Don't forget include/define REST_Controller path
include_once(APPPATH . 'controllers/Auth.php');

class MasterCabang extends Auth
{
    
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Mcabang_model');
  }

  function generateid(){
    $data['lastID'] = $this->Mcabang_model->getLastID();
    if (!empty($data['lastID'])) {
      preg_match('/(\d+)$/', $data['lastID'][0]['id_toko'], $matches);
      $numericPart = isset($matches[1]) ? $matches[1] : '0000';
      $incrementedNumericPart = sprintf('%04d', intval($numericPart) + 1);
      $data['newID'] = 'H3TC-' . $incrementedNumericPart;
    }else {
      $data['newID'] = 'H3TC-0001';
    }
    return $data;
  }

  public function loadkar(){
    $searchTerm = $this->input->get('q');
    $kar = $this->Mcabang_model->getAllKar($searchTerm);
    header('Content-Type: application/json');
    echo json_encode($kar);
  }

  public function index()
  {
    $data = $this->generateid();
    $cab = $this->session->userdata('id_toko');
    $data['barangcabang'] = $this->second->barangCabang($cab);
    $data['setcabang'] = $this->first->getCabang();
    $data['kacab'] = $this->Mcabang_model->getAllKar();
    $data['content'] = $this->load->view('master/mastercabang', $data, true);
    $data['modal'] = '';
    $data['css'] = '
    <link rel="stylesheet" type="text/css" href="'.base_url('assets/css/vendors/datatables.css').'">
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
          margin-bottom :-2%;
        }
    </style>
    ';
    $data['js'] = '<script>var base_url = "' . base_url() . '";</script>
    <script src="' . base_url('assets/js/additional-js/rajaongkir.js') . '"></script>
    <script src="' . base_url('assets/js/sweet-alert/sweetalert.min.js').'"></script>
    <script src="' . base_url('assets/js/select2/select2.full.min.js') . '"></script>
    <script src="' . base_url('assets/js/additional-js/mcabang.js') . '"></script>
    <script src="' . base_url('assets/js/additional-js/id.js') . '"></script>
    <script src="' . base_url('assets/js/modalpage/validation-modal.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatables/jquery.dataTables.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatables/datatable.custom.js') . '"></script>
    ';
    $this->load->view('layout/base', $data);    
  }

  function createpost(){
    $idt = $this->input->post('id');
    $idk = $this->input->post('kc');
    $nt = $this->input->post('nt');
    $prov = $this->input->post('prov_name');
    $kab = $this->input->post('kab_name');
    $kec = $this->input->post('kec_name');
    $kode = $this->input->post('kode_pos');
    $alamat = $this->input->post('alamat');
    $jenis = $this->input->post('jenis');
		
		$this->Mcabang_model->create($idt, $idk, $nt, $prov, $kab, $kec, $kode, $alamat,$jenis);

    redirect('master-cabang');
  }

  public function edit($id){
    $data['get_id']= $this->Mcabang_model->getWhere($id);
    echo json_encode($data);
  }

  public function updatepost(){
    if ($this->input->is_ajax_request()) {
      $id = $this->input->post('eid');
      $data = [
        'id_karyawan'     => $this->input->post('ekacab'),
        'nama_toko'   => $this->input->post('ecab'),
        'provinsi'    => $this->input->post('eprov'),
        'kabupaten'   => $this->input->post('ekot'),
        'kecamatan'   => $this->input->post('ekec'),
        'kode_pos'    => $this->input->post('ekode'),
        'alamat'      => $this->input->post('ealamat'),
        'jenis_toko'  => $this->input->post('ejenis'),
        'status'      => $this->input->post('estatus'),
      ];
      
      $this->Mcabang_model->update($id, $data);
      echo json_encode(['status' => 'success']);
    } else {
      redirect('master-cabang');
    }
  }

  public function deletepost($id) {
    $result = $this->Mcabang_model->delete($id);
    echo json_encode($result);
  }

  public function jsoncab(){
    $this->load->library('datatables');
    $this->datatables->select('id_toko,nama_lengkap,nama_toko,provinsi,kabupaten,kecamatan,alamat,status');
    $this->datatables->from('vtoko');
    return print_r($this->datatables->generate());
  }

}


/* End of file MasterCabang.php */
/* Location: ./application/controllers/MasterCabang.php */