<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mbank_model extends CI_Model {

  public function getWhere($id)
  {   
    $query = $this->db->get_where('tb_bank', array('id_bank' => $id));
    return $query->result_array();
  }

  public function create($data)
  {
    $this->db->insert('tb_bank',$data);
  }

  public function update($id, $data) {
    $this->db->where('id_bank', $id);
    $this->db->update('tb_bank', $data);
  }

  public function delete($id)
  {
    $this->db->where('id_bank', $id);
    $query = $this->db->get('tb_detail_penjualan');

    if ($query->num_rows() > 0) {
      return array('success' => false, 'message' => 'Data bank dengan nomor rekening "'.$id.'" tidak bisa dihapus, karena sudah terdaftar dipenjualan');
    }   
    $success = $this->db->delete('tb_bank', array("id_bank" => $id));
    $message = $success ? 'Data berhasil dihapus' : 'Gagal dihapus';
    return array('success' => $success, 'message' => $message);
  }

}

/* End of file Mbank_model.php */
/* Location: ./application/models/Mbank_model.php */