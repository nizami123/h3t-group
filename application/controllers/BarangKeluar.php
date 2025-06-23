<?php
defined('BASEPATH') or exit('No direct script access allowed');
include_once(APPPATH . 'controllers/Auth.php');

class BarangKeluar extends Auth
{
    
  public function __construct()
  {
    parent::__construct();
    $this->load->model('BarangKeluar_model');
    $this->load->library('zend');
  }

  public function datacount($id){
    $results = $this->BarangKeluar_model->countBK($id);
    header('Content-Type: application/json');
    echo json_encode($results);
  }

  public function formatsk($id) {
    $data['get_id']= $this->BarangKeluar_model->getWhere($id);
    $data['detail']= $this->BarangKeluar_model->detailprint($id);
    $this->load->view('print/formatsk',$data);
  }

  public function index()
  {
    $cab = $this->session->userdata('id_toko');
    $data['barangcabang'] = $this->second->barangCabang($cab);
    $data['setcabang'] = $this->first->getCabang();
    $data['setcabang'] = $this->BarangKeluar_model->getCabang();
    $data['content'] = $this->load->view('inventaris/barangkeluar', $data, true);
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
    <script src="' . base_url('assets/js/additional-js/ibarangk.js') . '"></script>
    <script src="' . base_url('assets/js/additional-js/id.js') . '"></script>
    <script src="' . base_url('assets/js/modalpage/validation-modal.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatables/jquery.dataTables.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatables/datatable.custom.js') . '"></script>
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
    $results = $this->BarangKeluar_model->getCabang($searchTerm);
    header('Content-Type: application/json');
    echo json_encode($results);
  }
  public function loadbrgb() {
    $searchTerm = $this->input->get('q');
    $results = $this->BarangKeluar_model->getBrgb($searchTerm);
    header('Content-Type: application/json');
    echo json_encode($results);    
  }
  public function loadbrgk() {
    $searchTerm = $this->input->get('q');
    $results = $this->BarangKeluar_model->getBrgk($searchTerm);
    header('Content-Type: application/json');
    echo json_encode($results);    
  }
  public function loadbrgacc() {
    $searchTerm = $this->input->get('q');
    $results = $this->BarangKeluar_model->getBrgacc($searchTerm);
    header('Content-Type: application/json');
    echo json_encode($results);    
  }
  public function loadmerkacc($nm) {
    $searchTerm = $this->input->get('q');
    $results = $this->BarangKeluar_model->getMerkacc($nm,$searchTerm);
    header('Content-Type: application/json');
    echo json_encode($results);    
  }

  public function barcode($sp){
    $this->zend->load('Zend/Barcode');
    $imageResource = Zend_Barcode::factory('code128','image', array('text'=>$sp), array())->draw();
    $imageName = $sp.'.jpg';
      if ($_SERVER['SERVER_NAME'] == 'localhost') {
        $imagePath = './assets/dhdokumen/suratkeluarbarcode/';
      } else if($_SERVER['SERVER_NAME'] == 'live.akira.id'){
        $imagePath = $_SERVER['DOCUMENT_ROOT'] . '/h3tgroup/assets/dhdokumen/suratkeluarbarcode/';
      } else {
        $imagePath = $_SERVER['DOCUMENT_ROOT'] . '/assets/dhdokumen/suratkeluarbarcode/';
      }
    imagejpeg($imageResource, $imagePath.$imageName);    
  }

  public function addmb() {
    if ($this->input->is_ajax_request()) {
      $data = [
        'id_masuk'      => $this->input->post('prodbaru'),
        'id_toko'      => $this->input->post('cabangbaru'),
        'tgl_keluar'      => $this->input->post('tglbaru'),
        'no_surat_keluar'      => $this->input->post('nosuratb'),
        'hrg_hpp' => $this->input->post('hrg_hpp'),
        'hrg_jual' => $this->input->post('hrg_jual'),
        'margin' => $this->input->post('margin'),
        'status'      => '1',
      ];
      $inserted = $this->BarangKeluar_model->create($data);
      if ($inserted) {
        $this->barcode($this->input->post('nosuratb'));
        echo json_encode(['status' => 'success']);
      } else {
        echo json_encode(['status' => 'exists']);
      }
    } else {
      redirect('barang-keluar');
    }
  }

  public function addmk() {
    if ($this->input->is_ajax_request()) {
      $data = [
        'id_masuk'      => $this->input->post('prodbekas'),
        'id_toko'      => $this->input->post('cabangbekas'),
        'tgl_keluar'      => $this->input->post('tglbekas'),
        'no_surat_keluar'      => $this->input->post('nosuratk'),
        'hrg_hpp' => $this->input->post('hrg_hpp'),
        'hrg_jual' => $this->input->post('hrg_jual'),
        'margin' => $this->input->post('margin'),
        'status'      => '1',
      ];
      $inserted = $this->BarangKeluar_model->create($data);
      if ($inserted) {
        $this->barcode($this->input->post('nosuratk'));
        echo json_encode(['status' => 'success']);
      } else {
        echo json_encode(['status' => 'exists']);
      }
    } else {
      redirect('barang-keluar');
    }
  }
  public function addacc() {
    if ($this->input->is_ajax_request()) {
        $checkedCheckboxes = $this->input->post('checkedCheckboxes');
        foreach ($checkedCheckboxes as $checkbox) {
            $data = [
                'id_masuk' => $checkbox['id_masuk'],
                'id_toko' => $checkbox['id_toko'],
                'tgl_keluar' => $checkbox['tgl_keluar'],
                'no_surat_keluar' => $checkbox['no_surat_keluar'],
                'hrg_hpp' => $checkbox['hrg_hpp'],
                'hrg_jual' => $checkbox['hrg_jual'],
                'margin' => $checkbox['margin'],
                'status' => $checkbox['status'],
            ];
            $inserted = $this->BarangKeluar_model->create($data);
            if (!$inserted) {
                echo json_encode(['status' => 'error']);
                return;
            }
        }
        $lastCheckbox = end($checkedCheckboxes);
        $this->barcode($lastCheckbox['no_surat_keluar']);
        echo json_encode(['status' => 'success']);
    } else {
        redirect('barang-keluar');
    }
  }
  public function deletepost($id) {
    $this->db->select('id_masuk');
    $this->db->from('tb_brg_keluar');
    $this->db->where('id_keluar', $id);
    $query = $this->db->get();
    $cekidm = $query->row()->id_masuk;

    $this->db->select('id_detailp');
    $this->db->from('tb_pindahbrgdetail');
    $this->db->where('id_keluar', $id);
    $query2 = $this->db->get();
    $cekidp_row = $query2->row();
    // Delete if there is a record in 
    if ($cekidp_row !== null) {
        $cekidp = $cekidp_row->id_detailp;
        $this->BarangKeluar_model->deleteidk($cekidp);
    }
    //update stok gd
    $this->BarangKeluar_model->updatestokgd($cekidm);
    $result = $this->BarangKeluar_model->delete($id);
    echo json_encode($result);
  }

  public function groupsk(){
    $this->load->library('datatables');
    $this->datatables->select('id_keluar,tgl_keluar, no_surat_keluar, nama_toko, status');
    $this->datatables->from('vbarangkeluar');
    $this->datatables->where_in('status',[1,0,2,6]);
    $this->datatables->group_by('no_surat_keluar');
    return print_r($this->datatables->generate());    
  }
  public function sendingsk($nosk){
    if ($this->input->is_ajax_request()) {
      $this->BarangKeluar_model->sendcab($nosk);
      echo json_encode(['status' => 'success']);
    } else {
      redirect('barang-keluar');
    }
  }
  public function loadbk(){
    $this->load->library('datatables');
    $this->datatables->select('id_keluar,tgl_keluar,no_surat_keluar,nama_toko,sn_brg,nama_brg,spek,kondisi,status');
    $this->datatables->from('vbarangkeluar');
    return print_r($this->datatables->generate());    
  }
  public function loadprdacc(){
    $this->load->library('datatables');
    $nm = $this->input->post('nm'); 
    $mk = $this->input->post('mk'); 
    $this->datatables->select('id_masuk,sn_brg,nama_brg,merk,jenis,hrg_hpp,hrg_jual,status');
    $this->datatables->from('vprdbm');
    if (!empty($nm) && $nm !== '0') {
      $this->datatables->where('nama_brg', $nm);
    }
    if (!empty($mk) && $mk !== '0') {
        $this->datatables->where('merk', $mk);
    }
    $this->datatables->where_in('tipe',['Accessories','Aksesoris','Acc','Accesoris','Software']);
    $this->datatables->where_in('status',['1']);
    return print_r($this->datatables->generate());    
  }
  public function getsk($ns){
    $this->load->library('datatables');
    $this->datatables->select('id_keluar,tgl_keluar,no_surat_keluar,nama_toko,sn_brg,nama_brg,merk,jenis,spek,kondisi,status');
    $this->datatables->from('vbarangkeluar');
    $this->datatables->where('no_surat_keluar',$ns);
    return print_r($this->datatables->generate());    
  }

  public function getdetailsk($id){
    $data['get_id']= $this->BarangKeluar_model->getWhere($id);
    echo json_encode($data);
  }

}


/* End of file BarangKeluar.php */
/* Location: ./application/controllers/BarangKeluar.php */