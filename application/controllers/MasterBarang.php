<?php
defined('BASEPATH') or exit('No direct script access allowed');
include_once(APPPATH . 'controllers/Auth.php');
class MasterBarang extends Auth
{
    
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Mbarang_model');
    $this->load->model('Mkategori_model');
  }

  function gen(){
    $data['lastID'] = $this->Mbarang_model->getLastID();
    if (!empty($data['lastID'])) {
      preg_match('/(\d+)$/', $data['lastID'][0]['id_brg'], $matches);
      $numericPart = isset($matches[1]) ? $matches[1] : '0000';
      $incrementedNumericPart = sprintf('%04d', intval($numericPart) + 1);
      $data['newID'] = 'H3TP-' . $incrementedNumericPart;
    }else {
      $data['newID'] = 'H3TP-0001';
    }
    return $data;
  }

  public function loadsupp(){
    $searchTerm = $this->input->get('q');
    $results = $this->Mbarang_model->getSupp($searchTerm);
    header('Content-Type: application/json');
    echo json_encode($results);
  }

  public function loadmerk(){
    $searchTerm = $this->input->get('q');
    $results = $this->Mbarang_model->getMerk($searchTerm);
    header('Content-Type: application/json');
    echo json_encode($results);
  }

  public function loadwarna(){
    $searchTerm = $this->input->get('q');
    $results = $this->Mbarang_model->getWarna($searchTerm);
    header('Content-Type: application/json');
    echo json_encode($results);
  }

  public function loadjenis(){
    $searchTerm = $this->input->get('q');
    $results = $this->Mbarang_model->getJenis($searchTerm);
    header('Content-Type: application/json');
    echo json_encode($results);
  }

  public function loadbrg(){
    $this->load->library('datatables');
    $this->datatables->select('id_brg,merk,jenis,warna,nama_brg,status');
    $this->datatables->from('tb_barang');
    return print_r($this->datatables->generate());
  }

  public function index()
  {
    $data = $this->gen();
    $cab = $this->session->userdata('id_toko');
    $data['barangcabang'] = $this->second->barangCabang($cab);
    $data['setcabang'] = $this->first->getCabang();
    $data['supplier'] = $this->Mbarang_model->getSupp();
    $data['content'] = $this->load->view('master/masterbarang', $data, true);
    $data['modal'] = $this->load->view('master/modal/m_barang','',true);
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
    <script src="' . base_url('assets/js/additional-js/mbarang.js') . '"></script>
    <script src="' . base_url('assets/js/additional-js/id.js') . '"></script>
    <script src="' . base_url('assets/js/modalpage/validation-modal.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatables/jquery.dataTables.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatables/datatable.custom.js') . '"></script>
    ';
    $this->load->view('layout/base', $data);    
  }

  function createpost(){
    if ($this->input->is_ajax_request()) {
      $data = [
        'id_brg'      => $this->input->post('id_brg'),
        'merk'      => $this->input->post('merk'),
        'jenis'      => $this->input->post('jenis'),
        'warna'      => $this->input->post('warna'),
        'tipe'      => $this->input->post('tipe'),
        'nama_brg'      => $this->input->post('nama_brg'),
        'status'      => '1',
      ];
      $this->Mbarang_model->create($data);
      echo json_encode(['status' => 'success']);
    } else {
      redirect('master-barang');
    }
  }

  function addmerk(){
    if ($this->input->is_ajax_request()) {
      $kode = "MRK";
      $nk = $this->input->post('newmerk');

      // Check if nama_kategori already exists
      $inserted = $this->Mkategori_model->create($kode, $nk);

      if ($inserted) {
          echo json_encode(['status' => 'success']);
      } else {
          echo json_encode(['status' => 'exists']);
      }
    } else {
        redirect('master-barang');
    }
  }

  function addjenis(){
    if ($this->input->is_ajax_request()) {
      $kode = "JNS";
      $nk = $this->input->post('newjenis');

      $inserted = $this->Mkategori_model->create($kode, $nk);

      if ($inserted) {
          echo json_encode(['status' => 'success']);
      } else {
          echo json_encode(['status' => 'exists']);
      }
    } else {
        redirect('master-barang');
    }
  }

  function addwarna(){
    if ($this->input->is_ajax_request()) {
      $kode = "WRN";
      $nk = $this->input->post('newwarna');

      $inserted = $this->Mkategori_model->create($kode, $nk);

      if ($inserted) {
          echo json_encode(['status' => 'success']);
      } else {
          echo json_encode(['status' => 'exists']);
      }
    } else {
        redirect('master-barang');
    }
  }

  public function deletepost($id) {
    $result = $this->Mbarang_model->delete($id);
    echo json_encode($result);
  }

  public function edit($id){
    $data['get_id']= $this->Mbarang_model->getWhere($id);
    echo json_encode($data);
  }

  function updatepost(){
    if ($this->input->is_ajax_request()) {
      $id = $this->input->post('e_id_brg');
      $data = [
        'merk'      => $this->input->post('e_merk'),
        'jenis'      => $this->input->post('e_jenis'),
        'warna'      => $this->input->post('e_warna'),
        'tipe'      => $this->input->post('e_tipe'),
        'nama_brg'      => $this->input->post('e_nama_brg'),
        'status'      => '1',
      ];
      
      $this->Mbarang_model->update($id, $data);
      echo json_encode(['status' => 'success']);
    } else {
      redirect('master-barang');
    }
  }

}


/* End of file MasterBarang.php */
/* Location: ./application/controllers/MasterBarang.php */