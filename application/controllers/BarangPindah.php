<?php
defined('BASEPATH') or exit('No direct script access allowed');
include_once(APPPATH . 'controllers/Auth.php');
class BarangPindah extends Auth
{
    
  public function __construct()
  {
    parent::__construct();
    $this->load->model('BarangPindah_model');
    $this->load->library('zend');
  }

  public function index()
  {
    $cab = $this->session->userdata('id_toko');
    $data['barangcabang'] = $this->second->barangCabang($cab);
    $data['setcabang'] = $this->first->getCabang();
    $data['content'] = $this->load->view('inventaris/pindahbarang', '', true);
    $data['modal'] = '';
    $data['css'] = '
    <link rel="stylesheet" type="text/css" href="' . base_url('assets/css/vendors/datatables.css') . '">
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
    <script src="' . base_url('assets/js/additional-js/ibarangp.js?v=1.3') . '"></script>
    <script src="' . base_url('assets/js/additional-js/id.js') . '"></script>
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

  public function indexpemindahan() {
    $cab = $this->session->userdata('id_toko');
    $data['barangcabang'] = $this->second->barangCabang($cab);
    $data['setcabang'] = $this->first->getCabang();
    $data['content'] = $this->load->view('inventaris/pemindahanbarang', '', true);
    $data['modal'] = '';
    $data['css'] = '
    <link rel="stylesheet" type="text/css" href="' . base_url('assets/css/vendors/datatables.css') . '">
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
          margin-top: -2% !important;
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
    <script src="' . base_url('assets/js/additional-js/ibarangp.js?v=1.3') . '"></script>
    <script src="' . base_url('assets/js/additional-js/id.js') . '"></script>
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
  public function loadsp(){
    $this->load->library('datatables');
    $this->datatables->select('id_pindah,nosp,tgl_pindah,fcabang,dari_cab,tcabang,kpd_cab,status');
    $this->datatables->from('vpindah');
    return print_r($this->datatables->generate());
  }
  public function loadtsp($idp){
    $this->load->library('datatables');
    $this->datatables->select('id_detailp,id_pindah,id_keluar,sn_brg,nama_brg,merk,jenis,fcabang');
    $this->datatables->from('vpindahdtl');
    $this->datatables->where('id_pindah', $idp);
    return print_r($this->datatables->generate());
  }
  public function createsp() {
    if ($this->input->is_ajax_request()) {
      $data = [
        'nosp'      => $this->input->post('nsp'),
        'fcabang'      => $this->input->post('fcab'),
        'tcabang'      => $this->input->post('tcab'),
        'tgl_pindah'      => $this->input->post('tglp'),
        'id_user' => $this->session->userdata('id_user'),
        'status'      => '0',
      ];
      $inserted = $this->BarangPindah_model->create($data);
      echo json_encode(['status' => 'success']);
    } else {
      redirect('pindah-barang');
    }
  }
  public function addbrg() {
    if ($this->input->is_ajax_request()) {
      $ids = $this->input->post('idk');
      $data = [
        'id_pindah'      => $this->input->post('idp'),
        'id_keluar'      => $this->input->post('idk')
      ];
      $data2 = [
        'id_toko' => $this->input->post('kcab'),
        'status' => '5'
      ];
      $this->BarangPindah_model->addpindahbrg($data);
      $this->BarangPindah_model->update($ids, $data2);
      echo json_encode(['status' => 'success']);
    } else {
      redirect('pindah-barang');
    }
  }
  public function loadprodf($fcab,$searchTerm) {
    // $searchTerm = $this->input->get('carisnacc');
    $results = $this->BarangPindah_model->getProd($fcab,$searchTerm);
    header('Content-Type: application/json');
    echo json_encode($results);    
  }
  public function deletebrg() {
    if ($this->input->is_ajax_request()) {
      $idtl = $this->input->post('idtl');
      $idk = $this->input->post('idk');
      $idt = $this->input->post('idt');
      $data = [
        'id_toko'=> $idt,
        'status'=> '2'
      ];
      $result = $this->BarangPindah_model->deletebrg($idtl,$idk,$data);
      echo json_encode($result);
    }else{
      redirect('pindah-barang');
    }
  }
  public function deletesp() {
    if ($this->input->is_ajax_request()) {
      $idp = $this->input->post('idp');
      $idt = $this->input->post('idt');
      $data = [
        'id_toko'=> $idt,
        'status'=> '2'
      ];
      $result = $this->BarangPindah_model->deletesp($idp,$data);
      echo json_encode($result);
    }else{
      redirect('pindah-barang');
    }
  }
  public function approvesp(){
    if ($this->input->is_ajax_request()) {
      $sp = $this->input->post('nosp');
      $fsp = $this->input->post('fsp');
      
      $this->BarangPindah_model->approvepindah($sp);
      $this->barcode($fsp);
      echo json_encode(['status' => 'success']);
    } else {
      redirect('pindah-barang');
    }
  }
  public function barcode($sp){
    $this->zend->load('Zend/Barcode');
    $imageResource = Zend_Barcode::factory('code128','image', array('text'=>$sp), array())->draw();
    $imageName = $sp.'.jpg';
      if ($_SERVER['SERVER_NAME'] == 'localhost') {
        $imagePath = './assets/dhdokumen/suratpindahbarcode/';
      } else if($_SERVER['SERVER_NAME'] == 'live.akira.id'){
        $imagePath = $_SERVER['DOCUMENT_ROOT'] . '/h3tgroup/assets/dhdokumen/suratpindahbarcode/';
      } else {
        $imagePath = $_SERVER['DOCUMENT_ROOT'] . '/assets/dhdokumen/suratpindahbarcode/';
      }
    imagejpeg($imageResource, $imagePath.$imageName);    
  }
  public function printsp($id) {
    $data['get_id']= $this->BarangPindah_model->getWhere($id);
    $data['detail']= $this->BarangPindah_model->detailprint($id);
    $this->load->view('print/formatsp',$data);
  }

  public function loadbk(){
    $this->load->library('datatables');
    $this->datatables->select('id_keluar,id_toko,nama_toko,sn_brg,nama_brg,merk,jenis,spek,kondisi,status');
    $this->datatables->from('vbarangkeluar');
    $this->datatables->where_in('status',[2]);
    return print_r($this->datatables->generate());
  }
  public function update(){
    if ($this->input->is_ajax_request()) {
        $ids = $this->input->post('ids');
        $cab = $this->input->post('cab');

        $data = array(
            'id_toko' => $cab,
        );
        $this->BarangPindah_model->update($ids, $data);

        echo json_encode(['status' => 'success']);
    } else {
        redirect('pindah-barang');
    }
  }
}


/* End of file BarangPindah.php */
/* Location: ./application/controllers/BarangPindah.php */