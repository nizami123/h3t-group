<?php
defined('BASEPATH') or exit('No direct script access allowed');
include_once(APPPATH . 'controllers/Auth.php');
class MasterKaryawan extends Auth
{
    
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Mkaryawan_model');
  }

  public function generateid() {
    $lastID = $this->Mkaryawan_model->getLastID();
    
    if (!empty($lastID)) {
        preg_match('/(\d+)$/', $lastID, $matches);
        $numericPart = isset($matches[1]) ? $matches[1] : '0000';
        $incrementedNumericPart = sprintf('%04d', intval($numericPart) + 1);
        $newID = 'H3TEMP-' . $incrementedNumericPart;
    } else {
        $newID = 'H3TEMP-0001';
    }
    return $newID;
  }


  public function index()
  {
    $cab = $this->session->userdata('id_toko');
    $data['barangcabang'] = $this->second->barangCabang($cab);
    $data['setcabang'] = $this->first->getCabang();
    $data['newID'] = $this->generateid();
    $data['content'] = $this->load->view('master/masterkaryawan', $data, true);
    $data['modal'] = $this->load->view('master/modal/m_editkar','',true);
    $data['css'] = '<link rel="stylesheet" type="text/css" href="'.base_url('assets/css/vendors/datatables.css').'">
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
    <script src="' . base_url('assets/js/additional-js/serverside.js') . '"></script>
    <script src="' . base_url('assets/js/select2/select2.full.min.js') . '"></script>
    <script src="' . base_url('assets/js/additional-js/id.js') . '"></script>
    <script src="' . base_url('assets/js/modalpage/validation-modal.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatables/jquery.dataTables.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatables/datatable.custom.js') . '"></script>
    <script src="' . base_url('assets/js/flat-pickr/flatpickr.js') . '"></script>
    <script src="' . base_url('assets/js/flat-pickr/custom-flatpickr.js') . '"></script>
    <script src="' . base_url('assets/js/additional-js/custom-scripts.js') . '"></script>
    <script src="'.base_url('assets/js/sweet-alert/sweetalert.min.js').'"></script>
    ';
    $this->load->view('layout/base', $data);    
  }
  public function createjabatan() {
    if ($this->input->is_ajax_request()) {
      $nj = $this->input->post('namajab');
      $data = [
        'nama_jab'      => $this->input->post('namajab'),
      ];
      $inserted = $this->Mkaryawan_model->tambahjabatan($nj,$data);
      if ($inserted) {
          echo json_encode(['status' => 'success']);
      } else {
          echo json_encode(['status' => 'exists']);
      }
    } else {
        redirect('master-karyawan');
    }
  }
  public function createrole() {
    if ($this->input->is_ajax_request()) {
      $nr = $this->input->post('namarole');
      $data = [
        'nama_role'      => $this->input->post('namarole'),
      ];
      $inserted = $this->Mkaryawan_model->tambahrole($nr,$data);
      if ($inserted) {
          echo json_encode(['status' => 'success']);
      } else {
          echo json_encode(['status' => 'exists']);
      }
    } else {
        redirect('master-karyawan');
    }    
  }
  public function loadjab(){
    $searchTerm = $this->input->get('q');
    $results = $this->Mkaryawan_model->getJabatan($searchTerm);
    header('Content-Type: application/json');
    echo json_encode($results);
  }
  public function loadrole(){
    $searchTerm = $this->input->get('q');
    $results = $this->Mkaryawan_model->getRole($searchTerm);
    header('Content-Type: application/json');
    echo json_encode($results);
  }    
  function edit($id){
    $data['get_id']= $this->Mkaryawan_model->getWhere($id);
    echo json_encode($data);
  }
  function createpost(){
    $id = $this->input->post('id');
    $nl = $this->input->post('nl');
    $tl = $this->input->post('tl');
    $jk = $this->input->post('jk');
    $email = $this->input->post('email');
    $password = $this->input->post('password');
    $prov = $this->input->post('prov_name');
    $kab = $this->input->post('kab_name');
    $kec = $this->input->post('kec_name');
    $kode = $this->input->post('kode_pos');
    $alamat = $this->input->post('alamat');
    $wa = $this->input->post('wa');
    $jabatan = $this->input->post('jabatan');
    $role = $this->input->post('role');
    // $gaji = str_replace('.', '', $this->input->post('gaji'));
    $cv = "";
        
    $file_path = realpath(APPPATH . '../assets/dhdokumen/karyawan');
    $config['upload_path'] = $file_path;
    $config['allowed_types'] = 'pdf';
    $config['overwrite'] = true;
    $config['file_name'] = $_FILES['cv']['name'];
    $config['max_size'] = 10048;
        
    $this->load->library('upload', $config);
        
    if (!empty($_FILES['cv']['name'])) {
        if ($this->upload->do_upload('cv')) {
            $data1 = $this->upload->data();
            $cv = $data1['file_name'];
        } else {
            $error = $this->upload->display_errors();
            echo "Upload failed: $error";
        }
        $this->Mkaryawan_model->create($id,$nl,$tl,$jk,$email,$password,$prov,$kab,$kec,$kode,$alamat,$wa,$cv,$jabatan,$role,0);
        redirect('master-karyawan');
    } else {
      $this->Mkaryawan_model->create($id,$nl,$tl,$jk,$email,$password,$prov,$kab,$kec,$kode,$alamat,$wa,$cv,$jabatan,$role,0);
      redirect('master-karyawan');
    }
  }
  public function updatepost(){
    if ($this->input->is_ajax_request()) {
      $id = $this->input->post('eid');
      $fileupload = isset($_FILES['e_filecv']) ? $_FILES['e_filecv']['name'] : null;
      $data = [
        'nama_lengkap'     => $this->input->post('enama'),
        'tanggal_lahir'   => $this->input->post('etgl'),
        'jen_kel'   => $this->input->post('ejk'),
        'email'   => $this->input->post('email'),
        'password'   => $this->input->post('epassword'),
        'provinsi'    => $this->input->post('eprov'),
        'kabupaten'   => $this->input->post('ekot'),
        'kecamatan'   => $this->input->post('ekec'),
        'kode_pos'    => $this->input->post('ekode'),
        'alamat'      => $this->input->post('ealamat'),
        'no_wa'  => $this->input->post('ewa'),
        'file_cv'  => $this->input->post('efile'),
        'jabatan'  => $this->input->post('ejabatan'),
        'role_user'  => $this->input->post('erole'),
        // 'gaji'  => $this->input->post('egaji'),
        'status'      => $this->input->post('estatus'),
      ];
      $data2 = [
        'nama_ksr'=>$this->input->post('enama'),
        'no_ponsel'=>$this->input->post('ewa'),
        'email'=>$this->input->post('email'),
        'alamat'=>$this->input->post('ealamat'),
      ];
      $data3 = [
        'nama_admin'=>$this->input->post('enama'),
        'email_admin'=>$this->input->post('email'),
        'password'=>$this->input->post('epassword'),
        'level'=>$this->input->post('erole'),
      ];

      $file_path = realpath(APPPATH . '../assets/dhdokumen/karyawan');
      $config['upload_path'] = $file_path;
      $config['allowed_types'] = 'pdf';
      $config['overwrite'] = true;
      $config['file_name'] = $fileupload;
      $config['max_size'] = 10048;
          
      $this->load->library('upload', $config);
          
      if (!empty($fileupload)) {
        if ($this->upload->do_upload('e_filecv')) {
            $data1 = $this->upload->data();
            $cv = $data1['file_name'];
            $data['file_cv'] = $cv; // Update the file_cv field with the new filename
        } else {
            $error = $this->upload->display_errors();
            echo "Upload failed: $error";
            return; // Stop execution if upload fails
        }
      } 
      $this->Mkaryawan_model->update($id, $data);
      $this->Mkaryawan_model->updateksr($id, $data2);
      $this->Mkaryawan_model->updateadm($id, $data3);
      echo json_encode(['status' => 'success']);
    } else {
      redirect('master-karyawan');
    }
  }
  public function deletepost($id) {
    $result = $this->Mkaryawan_model->delete($id);
    $result2 = $this->Mkaryawan_model->deleteksr($id);
    $result3 = $this->Mkaryawan_model->deleteadm($id);
    $image = $this->Mkaryawan_model->getWhere($id);
    $response = array(
      'result' => $result,
      'result2' => $result2,
      'result3' => $result3
    );

    if ($result['success'] && $result2['success'] && $result3['success']) {
      foreach ($image as $i) {
        if (!empty($i['file_cv'])) {
          $filePath = realpath(APPPATH . '../assets/dhdokumen/karyawan') . '/' . $i['file_cv'];
          if (file_exists($filePath)) {
              unlink($filePath);
          }
        }
      }
      $response['success'] = true;
      $response['message'] = 'Data and associated files successfully deleted.';
    } else {
      if (!$result['success']) {
        $response['message'] = $result['message'];
      } elseif (!$result2['success']) {
          $response['message'] = $result2['message'];
      } elseif (!$result3['success']) {
          $response['message'] = $result3['message'];
      }
      $response['success'] = false;
    }
    echo json_encode($response);
  }  
  public function jsonkar(){
    $this->load->library('datatables');
    $this->datatables->select('id_user, nama_lengkap, jabatan, role_user, file_cv, no_wa, email, password, status');
    $this->datatables->from('tb_user');
    return print_r($this->datatables->generate());
  }

}


/* End of file MasterKaryawan.php */
/* Location: ./application/controllers/MasterKaryawan.php */