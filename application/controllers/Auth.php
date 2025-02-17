<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    
  public function __construct()
  {
    parent::__construct();
    $this->load->library('session');
        
    if(! $this->session->userdata('logged') == TRUE) {
        redirect(base_url('login'));
    }
  }

}


/* End of file Auth.php */
/* Location: ./application/controllers/Auth.php */