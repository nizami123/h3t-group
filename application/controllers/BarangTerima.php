<?php
defined('BASEPATH') or exit('No direct script access allowed');
include_once(APPPATH . 'controllers/Auth.php');
class BarangTerima extends Auth
{
    
  public function __construct()
  {
    parent::__construct();
    $this->load->model('BarangTerima_model');
  }

  public function index()
  {
    $cab = $this->session->userdata('id_toko');
    $data['barangcabang'] = $this->second->barangCabang($cab);
    $data['setcabang'] = $this->first->getCabang();
    $data['content'] = $this->load->view('inventaris/terimabarang', '', true);
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
    <script src="' . base_url('assets/js/additional-js/ibarangt.js') . '"></script>
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

  public function loadstore(){
    $searchTerm = $this->input->get('q');
    $results = $this->BarangTerima_model->getCabang($searchTerm);
    header('Content-Type: application/json');
    echo json_encode($results);
  }

  public function groupsk(){
    $this->load->library('datatables');
    $this->datatables->select('id_keluar,tgl_keluar, no_surat_keluar, nama_toko, status');
    $this->datatables->from('vbarangkeluar');
    $this->datatables->where('status','0');
    $this->datatables->group_by('no_surat_keluar');
    return print_r($this->datatables->generate());    
  }

  public function filtersk($cab=null){
    $decoded_cab = urldecode($cab);
    $this->load->library('datatables');
    $this->datatables->select('id_keluar,tgl_keluar, no_surat_keluar, nama_toko, status');
    $this->datatables->from('vbarangkeluar');
    $this->datatables->where('status','1');
    $this->datatables->like('nama_toko', $decoded_cab);
    $this->datatables->group_by('no_surat_keluar');
    return print_r($this->datatables->generate());    
  }
  public function filtersp($cab=null){
    $decoded_cab = urldecode($cab);
    $this->load->library('datatables');
    $this->datatables->select('id_pindah,nosp,tgl_pindah,fcabang,dari_cab,tcabang,kpd_cab,status');
    $this->datatables->from('vpindah');
    $this->datatables->where('status','1');
    $this->datatables->like('kpd_cab', $decoded_cab);
    $this->datatables->group_by('nosp');
    return print_r($this->datatables->generate());    
  }
  public function groupsp() {
    $this->load->library('datatables');
    $this->datatables->select('id_pindah,nosp,tgl_pindah,fcabang,dari_cab,tcabang,kpd_cab,status');
    $this->datatables->where('status','1');
    $this->datatables->from('vpindah');
    $this->datatables->group_by('nosp');
    return print_r($this->datatables->generate()); 
  }

  public function approve(){
    if ($this->input->is_ajax_request()) {
      $sk = $this->input->post('ska');
      $data = [
        'status'      => '6',
      ];
      $data2 = [
        'tb_brg_masuk.status' => '2'
      ];
      
      $this->BarangTerima_model->approve($sk, $data);
      $this->BarangTerima_model->approvegd($sk, $data2);
      echo json_encode(['status' => 'success']);
    } else {
      redirect('terima-barang');
    }
  }
  public function approvesp(){
    if ($this->input->is_ajax_request()) {
      $idp = $this->input->post('idp');
      $data = [
        'status'      => '2',
      ];
      $data2 = [
        'tb_brg_keluar.status' => '6'
      ];
      
      $this->BarangTerima_model->approvesp($idp, $data);
      $this->BarangTerima_model->approvestp($idp, $data2);
      echo json_encode(['status' => 'success']);
    } else {
      redirect('terima-barang');
    }
  }
  public function getsp($nsp){
    $this->load->library('datatables');
    $this->datatables->select('id_detailp,tgl_pindah,nosp,kpd_cab,sn_brg,nama_brg,merk,jenis,spek,kondisi,status');
    $this->datatables->from('vpindahdtl');
    $this->datatables->where('nosp',$nsp);
    return print_r($this->datatables->generate());
  }

}


/* End of file BarangTerima.php */
/* Location: ./application/controllers/BarangTerima.php */