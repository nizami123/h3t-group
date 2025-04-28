<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mkustomer_model extends CI_Model {


  public function getLastID() {
    $this->db->select('id_plg');
    $this->db->from('tb_pelanggan');
    $this->db->order_by('id_plg', 'asc');
    $this->db->limit(1);
    $query = $this->db->get();
    return $query->result_array();
  }

  public function create($idp, $np, $wa, $email, $alamat)
  {
    $data = array(
      'id_plg' => $idp,
      'nama_plg' => $np,
      'no_ponsel' => $wa,
      'email'=> $email,
      'alamat'=> $alamat
    );  
    $this->db->insert('tb_pelanggan',$data);
  }

  public function delete($id)
  {
    $this->db->where('id_plg', $id);
    $query = $this->db->get('tb_detail_penjualan');

    if ($query->num_rows() > 0) {
      return array('success' => false, 'message' => 'Data customer dengan id "'.$id.'" tidak bisa dihapus, karena sudah pernah melakukan pembelian barang');
    }   
    $success = $this->db->delete('tb_pelanggan', array("id_plg" => $id));
    $message = $success ? 'Data berhasil dihapus' : 'Gagal dihapus';
    return array('success' => $success, 'message' => $message);
  }

  public function update($idp, $data)
  {
    $this->db->where('id_plg', $idp);
    $this->db->update('tb_pelanggan', $data);
  }

  public function getWhere($id)
  {
    $query = $this->db->get_where('tb_pelanggan', array('id_plg' => $id));
    return $query->result_array();
  }
}

/* End of file Mkustomer_model.php */
/* Location: ./application/models/Mkustomer_model.php */