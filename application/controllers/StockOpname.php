<?php
defined('BASEPATH') or exit('No direct script access allowed');


include_once(APPPATH . 'controllers/Auth.php');

class StockOpname extends Auth
{
    
  public function __construct()
  {
    parent::__construct();
    $this->load->model('StockOpname_model');
    $this->load->model('BarangKeluar_model');
  }

  function generateid(){
    $data['lastID'] = $this->StockOpname_model->getLastKode();
    $numericPart = isset($data['lastID'][0]['kode_opname']) ? preg_replace('/[^0-9]/', '', $data['lastID'][0]['kode_opname']) : '';
    $incrementedNumericPart = sprintf('%04d', intval($numericPart) + 1);
    $data['newID'] = 'OPNM-' . $incrementedNumericPart;
    $data['defID'] = 'OPNM-0001';
    $this->output->set_content_type('application/json')->set_output(json_encode($data));
  }

  public function index()
  {
    $cab = $this->session->userdata('id_toko');
    $data['barangcabang'] = $this->second->barangCabang($cab);
    $data['setcabang'] = $this->BarangKeluar_model->getCabang();
    $data['content'] = $this->load->view('inventaris/stockopname', $data, true);
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
    <script src="' . base_url('assets/js/additional-js/istockopname.js?v=1.1') . '"></script>
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
  public function countpm() {
    $results = $this->StockOpname_model->prodm();
    header('Content-Type: application/json');
    echo json_encode($results);
  }
  public function countpk() {
    $results = $this->StockOpname_model->prodk();
    header('Content-Type: application/json');
    echo json_encode($results);
  }
  public function counttotal() {
    $results = $this->StockOpname_model->totalprod();
    header('Content-Type: application/json');
    echo json_encode($results);
  }
  public function loadriwayat() {
    $this->load->library('datatables');
    $tgl = $this->input->post('tgl'); 
    $this->datatables->select('id_opname,kode_opname, 
    DATE_FORMAT(tgl_opname, "%d-%M-%Y") AS tgl_opname,
    (SELECT COUNT(id_opname) FROM tb_opname_detail WHERE tb_opname_detail.id_opname = vopname.id_opname) AS total_produk,
    nama_lengkap,id_toko,nama_toko,jabatan,status');
    $this->datatables->from('vopname');
    if (!empty($tgl)) {
      $this->datatables->where('date(tgl_opname)', $tgl);
    }
    $this->datatables->where('status','2');
    return print_r($this->datatables->generate());
  }
  public function loaddetail($id_opname) {
    $this->load->library('datatables');
    $this->datatables->select('id_keluar,sn_brg,nama_brg,merk,jenis');
    $this->datatables->from('vopname_dtl');
    $this->datatables->where('id_opname',$id_opname);
    return print_r($this->datatables->generate());
  }     

  // function for opnm_new
  public function addstockopname()
  {
    $cab = $this->session->userdata('id_toko');
    $data['barangcabang'] = $this->second->barangCabang($cab);
    $data['setcabang'] = $this->BarangKeluar_model->getCabang();
    $data['content'] = $this->load->view('inventaris/opnamebaru', $data, true);
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
    <script src="' . base_url('assets/js/additional-js/iopnamebaru.js?v=2.2') . '"></script>
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
  public function loadauditor($id) {
    $searchTerm = $this->input->get('q');
    $results = $this->StockOpname_model->getAuditor($id,$searchTerm);
    header('Content-Type: application/json');
    echo json_encode($results);
  }
  public function loadcabang() {
    $searchTerm = $this->input->get('q');
    $idtoko = $this->session->userdata('id_toko');
    $results = $this->StockOpname_model->getCabang($idtoko,$searchTerm);
    header('Content-Type: application/json');
    echo json_encode($results);
  }
  public function loadfilterjenis() {
    $searchTerm = $this->input->get('q');
    $results = $this->StockOpname_model->getFilterJenis($searchTerm);
    header('Content-Type: application/json');
    echo json_encode($results);
  }
  public function createpost(){
    if ($this->input->is_ajax_request()) {
      $data = [
        'kode_opname'      => $this->input->post('idstockopname'),
        'tgl_opname'      => $this->input->post('tanggalwaktubarang'),
        'id_toko'      => $this->input->post('cabang'),
        'id_user'      => $this->input->post('auditor'),
        'status'      => '1',
      ];
      
      $this->StockOpname_model->create($data);
      echo json_encode(['status' => 'success']);
    } else {
      redirect('stock-opname');
    }
  }
  public function addpr() {
    if ($this->input->is_ajax_request()) {
      $data = [
        'id_opname'      => $this->input->post('idopname'),
        'id_keluar'      => $this->input->post('idkeluar'),
      ];
      $inserted = $this->StockOpname_model->createpr($data);
      if ($inserted) {
        echo json_encode(['status' => 'success']);
      } else {
        echo json_encode(['status' => 'exists']);
      }
    } else {
      redirect('stock-opname');
    }    
  }
  public function addprodacc() {
    if ($this->input->is_ajax_request()) {
      $data = [
        'id_opname'      => $this->input->post('idopname'),
        'id_keluar'      => $this->input->post('idkeluar'),
      ];
      
      $this->StockOpname_model->createpr($data);
      echo json_encode(['status' => 'success']);
    } else {
      redirect('stock-opname');
    }    
  }
  public function loadopnamelist() {
    $auditor = $this->session->userdata('nama_lengkap');
    $role = $this->session->userdata('jabatan');
    if ($role == 'OWNER' || $role == 'Finance' || $role == 'Manager Oprasional') {
      $this->load->library('datatables');
      $this->datatables->select('id_opname,kode_opname, DATE_FORMAT(tgl_opname, "%d-%M-%Y") AS tgl_opname,nama_lengkap,id_toko,nama_toko,status');
      $this->datatables->from('vopname');
      $this->datatables->where('status','1');
      return print_r($this->datatables->generate());
    } else if ($role == 'KEPALA CABANG' || $role == 'PIC'){
      $this->load->library('datatables');
      $this->datatables->select('id_opname,kode_opname, DATE_FORMAT(tgl_opname, "%d-%M-%Y") AS tgl_opname,nama_lengkap,id_toko,nama_toko,status');
      $this->datatables->from('vopname');
      $this->datatables->where('status','1');
      $this->datatables->where('nama_lengkap',$auditor);
      return print_r($this->datatables->generate());
    }
  }
  public function loadproduklist($id_toko,$ido) {
    $this->load->library('datatables');
    $this->datatables->select('id_keluar,sn_brg,nama_brg,merk,jenis,status_brg');
    $this->datatables->from('vprdop');
    $this->datatables->where('jenis <>', 'Aksesoris');
    $this->datatables->where('id_toko',$id_toko);
    $this->datatables->where('id_opname',$ido);
    return print_r($this->datatables->generate());
  }  
  public function loadproplist($id_toko,$ido) {
    $this->load->library('datatables');
    $this->datatables->select('id_keluar,sn_brg,nama_brg,merk,jenis,status');
    $this->datatables->from('vopname_dtl');
    $this->datatables->where('jenis <>', 'Aksesoris');
    $this->datatables->where('id_toko',$id_toko);
    $this->datatables->where('id_opname',$ido);
    return print_r($this->datatables->generate());
  }
  public function loadacclist($id_toko,$ido) {
    $this->load->library('datatables');
    $this->datatables->select('id_keluar,sn_brg,nama_brg,merk,jenis,status_brg');
    $this->datatables->from('vprdop');
    $this->datatables->where_in('tipe', ['Aksesoris','Accesoris']);
    $this->datatables->where('id_toko',$id_toko);
    $this->datatables->where('id_opname',$ido);
    return print_r($this->datatables->generate());
  }  
  public function loadpropacclist($id_toko,$ido) {
    $this->load->library('datatables');
    $this->datatables->select('id_keluar,sn_brg,nama_brg,merk,jenis,status');
    $this->datatables->from('vopname_dtl');
    $this->datatables->where_in('tipe', ['Aksesoris','Accesoris']);
    $this->datatables->where('id_toko',$id_toko);
    $this->datatables->where('id_opname',$ido);
    return print_r($this->datatables->generate());
  }  
  public function getbarang($id){
    $data['get_id']= $this->StockOpname_model->getWhere($id);
    echo json_encode($data);
  }
  public function approveopnm(){
    if ($this->input->is_ajax_request()) {
      $data = [
        'status'      => '2',
      ];
      $this->StockOpname_model->approveop($data);
      echo json_encode(['status' => 'success']);
    } else {
      redirect('stock-opname');
    }
  }
  public function approvebyop($idop){
    if ($this->input->is_ajax_request()) {
      $getidop = $this->db->where('id_opname', $idop)->get('tb_opname_detail')->result();
      if (!empty($getidop)) {
        foreach ($getidop as $row) {
            $dataop = ['status' => '2'];
            $databrg = ['status' => '2'];

            $this->StockOpname_model->approvebyop($idop, $dataop);
            $this->StockOpname_model->updatebrgcab($row->id_keluar, $databrg);
        }
        echo json_encode(['status' => 'success']);
      } else {
        echo json_encode(['status' => 'error']);
      }
    } else {
      redirect('stock-opname');
    }
  }
  public function deletepost($id){
    $result = $this->StockOpname_model->delete($id);
    echo json_encode($result);
  }
  public function searchSN($idt,$idop,$sn){
    $results = $this->StockOpname_model->getProdOP($idt,$idop,$sn);
    if (empty($results)) {
      $results = $this->StockOpname_model->getProdOPHistory($idt, $idop, $sn);
      header('Content-Type: application/json');
      echo json_encode([
          'data' => $results,
          'is_alr' => 1
      ]);
      return;
    }
    header('Content-Type: application/json');
    echo json_encode([
      'data' => $results,
      'is_not' => 1
    ]);
  }
  public function searchAccSN($idt,$idop,$sn){
    $results = $this->StockOpname_model->getAccOP($idt,$idop,$sn);
    if (empty($results)) {
      $results = $this->StockOpname_model->getAccOPHistory($idt, $idop, $sn);
      header('Content-Type: application/json');
      echo json_encode([
          'data' => $results,
          'is_alr' => 1
      ]);
      return;
    }
    header('Content-Type: application/json');
    echo json_encode([
      'data' => $results,
      'is_not' => 1
    ]);
  }  
}


/* End of file StockOpname.php */
/* Location: ./application/controllers/StockOpname.php */
