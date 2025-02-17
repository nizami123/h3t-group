<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Login_model');
		$this->load->library('form_validation');
  }
  public function checkown() {
    $query = $this->db->query('SELECT id_user FROM tb_user WHERE role_user="OWNER"');
    $num_rows = $query->num_rows();
    return $num_rows;
  }

  public function index(){
    $data['own']= $this->checkown();
    $data['css'] = '
    <link rel="stylesheet" type="text/css" href="'.base_url('assets/css/vendors/sweetalert2.css').'">
    ';
    $data['js'] = '
    <script>var base_url = "' . base_url() . '";</script>
    <script src="' . base_url('assets/js/sweet-alert/sweetalert.min.js').'"></script>
    <script src="' . base_url('assets/js/additional-js/auth.js') . '"></script>
    ';
    $this->load->view('absensi/login',$data);
  }
  function aksi_login() {
    $username = $this->input->post('email');
    $password = $this->input->post('password');
    $where = array(
        'email' => $username,
        'password' => $password,
    );

    // Call the model method once
    $result = $this->Login_model->cek_login($where);

    // Check if any rows are returned
    if ($result->num_rows() > 0) {
        $data = $result->row_array();
        if ($password == $data['password'] && $username == $data['email']) {
            $data_session = array(
                'email' => $data['email'],
                'role_user' => $data['role_user'],
                'id_user' => $data['id_user'],
                'jabatan' => $data['jabatan'],
                'nama_lengkap' => $data['nama_lengkap'],
                'id_toko' => $data['id_toko'],
                'nama_toko' => $data['nama_toko'],
                'logged' => TRUE
            );
            $this->session->set_userdata($data_session);
            $response = array('success' => true, 'message' => 'Login berhasil.');
            if ($data['jabatan'] == 'KEPALA CABANG') {
                $response['message'] = 'Login berhasil kepala cabang';
                $response['id_toko'] = $data['id_toko'];
                $response['nama_toko'] = $data['nama_toko'];
            }
            echo json_encode($response);
            return;
        } else {
            echo json_encode(array('success' => false, 'message' => 'Password atau Email yang anda masukkan salah, Silahkan Coba Lagi'));
            return;
        }
    } else {
        echo json_encode(array('success' => false, 'message' => 'Anda belum terdaftar di sistem DH Holding'));
        return;
    }
  }
	function logout(){
		$this->session->sess_destroy();
		redirect(base_url('login'));
	}
  function generateid(){
    $data['lastID'] = $this->Login_model->getLastKode();
    if (!empty($data['lastID'])) {
      $numericPart = isset($data['lastID'][0]['id_user']) ? preg_replace('/[^0-9]/', '', $data['lastID'][0]['id_user']) : '';
      $incrementedNumericPart = sprintf('%04d', intval($numericPart) + 1);
      $data['newID'] = 'H3TEMP-' . $incrementedNumericPart;
    }else{
      $data['newID'] = 'H3TEMP-0001';
    }
    return $data['newID'];
    // $this->output->set_content_type('application/json')->set_output(json_encode($data));
  }
  function createpost(){
    if ($this->input->is_ajax_request()) {
      $num_owners = $this->checkown();
      if ($num_owners > 0) {
        echo json_encode(['status' => 'exists']);
      }else{
        $data = [
          'id_user'      => $this->generateid(),
          'nama_lengkap'      => $this->input->post('nl'),
          'email'      => $this->input->post('em'),
          'password'      => $this->input->post('pass'),
          'jabatan'      => 'OWNER',
          'role_user'      => 'OWNER',
          'status'      => '1',
        ];
        
        $this->Login_model->create($data);
        echo json_encode(['status' => 'success']);
      }
    } else {
      redirect('login');
    }
  }
}


/* End of file Login.php */
/* Location: ./application/controllers/Login.php */