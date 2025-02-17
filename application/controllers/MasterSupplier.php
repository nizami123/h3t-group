<?php
defined('BASEPATH') or exit('No direct script access allowed');
include_once(APPPATH . 'controllers/Auth.php');
class MasterSupplier extends Auth
{
    
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Msupplier_model');
  }

  function generateid(){
    $data['lastID'] = $this->Msupplier_model->getLastID();
    if (!empty($data['lastID'])) {
      $numericPart = isset($data['lastID'][0]['id_supplier']) ? preg_replace('/[^0-9]/', '', $data['lastID'][0]['id_supplier']) : '';
      $incrementedNumericPart = sprintf('%04d', intval($numericPart) + 1);
      $data['newID'] = 'H3TSUPP-' . $incrementedNumericPart;
    }else {
      $data['newID'] = 'H3TSUPP-0001';
    }
    return $data;
  }

  public function index()
  {
    $data = $this->generateid();
    $cab = $this->session->userdata('id_toko');
    $data['barangcabang'] = $this->second->barangCabang($cab);
    $data['setcabang'] = $this->first->getCabang();
    $data['content'] = $this->load->view('master/mastersupplier', $data, true);
    $data['modal'] = '';
    $data['css'] = '
    <link rel="stylesheet" type="text/css" href="'.base_url('assets/css/vendors/datatables.css').'">
    <link rel="stylesheet" type="text/css" href="'.base_url('assets/css/vendors/sweetalert2.css').'">
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
          margin-bottom :-2%;
        }
    </style>    
    ';
    $data['js'] = '<script>var base_url = "' . base_url() . '";</script>
    <script src="' . base_url('assets/js/additional-js/rajaongkir.js') . '"></script>
    <script src="' . base_url('assets/js/sweet-alert/sweetalert.min.js').'"></script>
    <script src="' . base_url('assets/js/additional-js/msupplier.js') . '"></script>
    <script src="' . base_url('assets/js/select2/select2.full.min.js') . '"></script>
    <script src="' . base_url('assets/js/modalpage/validation-modal.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatables/jquery.dataTables.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatables/datatable.custom.js') . '"></script>
    ';
    $this->load->view('layout/base', $data);    
  }

  function createpost(){
    $ids = $this->input->post('id');
    $ns = $this->input->post('ns');
    $wa = $this->input->post('wa');
    $pic = $this->input->post('pic');
    $prov = $this->input->post('prov_name');
    $kab = $this->input->post('kab_name');
    $kec = $this->input->post('kec_name');
    $alamat = $this->input->post('alamat');
		
		$this->Msupplier_model->create($ids, $ns, $wa, $pic, $prov, $kab, $kec, $alamat);

    redirect('master-supplier');
  }

  public function edit($id){
    $data['get_id']= $this->Msupplier_model->getWhere($id);
    echo json_encode($data);
  }

  public function updatepost(){
    if ($this->input->is_ajax_request()) {
      $id = $this->input->post('eid');
      $data = [
        'nama_supplier'     => $this->input->post('enama'),
        'kontak'   => $this->input->post('ekontak'),
        'pic'   => $this->input->post('epic'),
        'provinsi'    => $this->input->post('eprov'),
        'kabupaten'   => $this->input->post('ekot'),
        'kecamatan'   => $this->input->post('ekec'),
        'alamat'      => $this->input->post('ealamat'),
        'status'      => $this->input->post('estatus'),
      ];
      
      $this->Msupplier_model->update($id, $data);
      echo json_encode(['status' => 'success']);
    } else {
      redirect('master-supplier');
    }
  }

  public function deletepost($id) {
    $result = $this->Msupplier_model->delete($id);
    echo json_encode($result);
  }

  public function jsonsup(){
    $this->load->library('datatables');
    $this->datatables->select('id_supplier,nama_supplier,kontak,pic,provinsi,kabupaten,kecamatan,alamat,status');
    $this->datatables->from('tb_supplier');
    return print_r($this->datatables->generate());
  }

}


/* End of file MasterSupplier.php */
/* Location: ./application/controllers/MasterSupplier.php */