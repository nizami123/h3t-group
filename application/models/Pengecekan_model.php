<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengecekan_model extends CI_Model {

    public function addItem($data)
    {
      $insert = $this->db->insert('tb_pengecekan', $data);
      return $insert;
    }

}

/* End of file Pengecekan_model.php */
/* Location: ./application/models/Pengecekan_model.php */