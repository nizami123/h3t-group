<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mbarang_model extends CI_Model {

  public function getLastID() {
    $this->db->select('id_brg');
    $this->db->from('tb_barang');
    $this->db->order_by('id_brg', 'desc');
    $this->db->limit(1);
    $query = $this->db->get();
    return $query->result_array();
  }

  public function getSupp($searchTerm = null) {
    $this->db->select(['id_supplier', 'nama_supplier']);
    $this->db->from('tb_supplier');
    $this->db->where_in('status', ['1']);

    // Add the search conditions if a search term is provided
    if ($searchTerm) {
        $this->db->group_start();
        $this->db->like('nama_supplier', $searchTerm);
        $this->db->or_like('id_supplier', $searchTerm);
        $this->db->group_end();
    }

    $this->db->order_by('id_supplier', 'asc');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function getMerk($searchTerm = null) {
    $this->db->select(['id_kategori','kode','nama_kategori']);
    $this->db->from('tb_kategori');
    $this->db->where('kode', 'MRK');
    if ($searchTerm) {
      $this->db->group_start();
      $this->db->like('nama_kategori', $searchTerm);
      $this->db->group_end();
    }
    $this->db->order_by('nama_kategori', 'asc');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function getJenis($searchTerm = null) {
    $this->db->select(['id_kategori','kode','nama_kategori']);
    $this->db->from('tb_kategori');
    $this->db->where('kode', 'JNS');
    if ($searchTerm) {
      $this->db->group_start();
      $this->db->like('nama_kategori', $searchTerm);
      $this->db->group_end();
    }
    $this->db->order_by('nama_kategori', 'asc');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function getWhere($id)
  {   
    $query = $this->db->get_where('tb_barang', array('id_brg' => $id));
    return $query->result_array();
  }

  public function create($data)
  {
    $this->db->insert('tb_barang',$data);
  }

  public function update($id, $data) {
    $this->db->where('id_brg', $id);
    $this->db->update('tb_barang', $data);
  }

  public function delete($id){ 
    $this->db->where('id_brg', $id);
    $query = $this->db->get('tb_brg_masuk');

    if ($query->num_rows() > 0) {
        return array('success' => false, 'message' => 'Data barang dengan id "'.$id.'" tidak bisa dihapus, karena masih digunakan di Barang Gudang');
    }
    $success = $this->db->delete('tb_barang', array("id_brg" => $id));
    $message = $success ? 'Data berhasil dihapus' : 'Gagal dihapus';
    return array('success' => $success, 'message' => $message);
  }
}

/* End of file Mbarang_model.php */
/* Location: ./application/models/Mbarang_model.php */