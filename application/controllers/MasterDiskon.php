<?php
defined('BASEPATH') or exit('No direct script access allowed');
include_once(APPPATH . 'controllers/Auth.php');
class MasterDiskon extends Auth
{
    
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Mdiskon_model');
  }

  public function index()
  {
    $cab = $this->session->userdata('id_toko');
    $data['barangcabang'] = $this->second->barangCabang($cab);
    $data['setcabang'] = $this->first->getCabang();
    $data['content'] = $this->load->view('master/masterdiskon', '', true);
    $data['modal'] = '';
    $data['css'] = '
    <link rel="stylesheet" type="text/css" href="'.base_url('assets/css/vendors/datatables.css').'">
    <link rel="stylesheet" type="text/css" href="'.base_url('assets/css/vendors/sweetalert2.css').'">
    ';
    $data['js'] = '<script>var base_url = "' . base_url() . '";</script>
    <script src="' . base_url('assets/js/sweet-alert/sweetalert.min.js').'"></script>
    <script src="' . base_url('assets/js/additional-js/custom-scripts.js') . '"></script>
    <script src="' . base_url('assets/js/additional-js/mdiskon.js') . '"></script>
    <script src="' . base_url('assets/js/modalpage/validation-modal.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatables/jquery.dataTables.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatables/datatable.custom.js') . '"></script>
    ';
    $this->load->view('layout/base', $data);    
  }

  public function jsondis(){
    $this->load->library('datatables');
    $this->datatables->select('kode_diskon,nilai,kuota,total_diskon');
    $this->datatables->from('tb_diskon');
    return print_r($this->datatables->generate());
  }

  function createpost(){
    if ($this->input->is_ajax_request()) {
      $kode = $this->input->post('kode');
      $tipe = $this->input->post('tipe');
      $nilai = $this->input->post('nilai');
      $kuota = $this->input->post('kuota');
      $total = $this->input->post('total');

      $this->Mdiskon_model->create($kode, $tipe, $nilai, $kuota, $total);

      echo json_encode(['status' => 'success']);
      } else {
          redirect('master-diskon');
      }
  }

  public function edit($id){
    $data['get_id']= $this->Mdiskon_model->getWhere($id);
    echo json_encode($data);
  }
  public function updatepost(){
    if ($this->input->is_ajax_request()) {
      $id = $this->input->post('ekode');
      $data = [
        'tipe'     => $this->input->post('etipe'),
        'nilai'   => $this->input->post('ediskon'),
        'kuota'    => $this->input->post('ekuota'),
        'total_diskon'   => $this->input->post('etotal'),
      ];
      
      $this->Mdiskon_model->update($id, $data);
      echo json_encode(['status' => 'success']);
    } else {
      redirect('master-diskon');
    }
  }

  public function deletepost($id) {
    $result = $this->Mdiskon_model->delete($id);
    echo json_encode($result);
  }

}


/* End of file MasterDiskon.php */
/* Location: ./application/controllers/MasterDiskon.php */