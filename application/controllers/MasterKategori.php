<?php
defined('BASEPATH') or exit('No direct script access allowed');
include_once(APPPATH . 'controllers/Auth.php');
class MasterKategori extends Auth
{
    
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Mkategori_model');
  }

  public function index()
  {
    $cab = $this->session->userdata('id_toko');
    $data['barangcabang'] = $this->second->barangCabang($cab);
    $data['setcabang'] = $this->first->getCabang();
    $data['content'] = $this->load->view('master/masterkategori', '', true);
    $data['modal'] = $this->load->view('master/modal/m_kategori','',true);
    $data['css'] = '
    <link rel="stylesheet" type="text/css" href="'.base_url('assets/css/vendors/datatables.css').'">
    <link rel="stylesheet" type="text/css" href="'.base_url('assets/css/vendors/sweetalert2.css').'">
    
    ';
    $data['js'] = '<script>var base_url = "' . base_url() . '";</script>
    <script src="' . base_url('assets/js/sweet-alert/sweetalert.min.js').'"></script>
    <script src="' . base_url('assets/js/additional-js/mkategori.js') . '"></script>
    <script src="' . base_url('assets/js/modalpage/validation-modal.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatables/jquery.dataTables.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatables/datatable.custom.js') . '"></script>
    ';
    $this->load->view('layout/base', $data);    
  }

  public function jsonkat($kode){
    $this->load->library('datatables');
    $this->datatables->select('id_kategori,kode,nama_kategori');
    $this->datatables->from('tb_kategori');
    $this->datatables->where('kode',$kode);
    return print_r($this->datatables->generate());
  }

  function createpost(){
      if ($this->input->is_ajax_request()) {
        $kode = "MRK";
        $nk = $this->input->post('merek');

        $this->Mkategori_model->create($kode, $nk);

        echo json_encode(['status' => 'success']);
      } else {
          redirect('master-kategori');
      }
  }

  function addjenis(){
    if ($this->input->is_ajax_request()) {
      $kode = "JNS";
      $nk = $this->input->post('jenis');

      $this->Mkategori_model->create($kode, $nk);

      echo json_encode(['status' => 'success']);
    } else {
        redirect('master-kategori');
    }
  }

  function addstorage(){
    if ($this->input->is_ajax_request()) {
      $kode = "STR";
      $nk = $this->input->post('storage');

      $this->Mkategori_model->create($kode, $nk);

      echo json_encode(['status' => 'success']);
    } else {
        redirect('master-kategori');
    }
  }

  function addvariant(){
    if ($this->input->is_ajax_request()) {
      $kode = "VRT";
      $nk = $this->input->post('variant');

      $this->Mkategori_model->create($kode, $nk);

      echo json_encode(['status' => 'success']);
    } else {
        redirect('master-kategori');
    }
  }
  
  function deletepost($id) {
    $result = $this->Mkategori_model->delete($id);
    echo json_encode($result);
  }
}


/* End of file MasterKategori.php */
/* Location: ./application/controllers/MasterKategori.php */