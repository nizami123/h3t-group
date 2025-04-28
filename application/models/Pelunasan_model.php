<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelunasan_model extends CI_Model {


  public function getLastID() {
    $this->db->select('id_pelunasan');
    $this->db->from('tb_pelunasan');
    $this->db->order_by('id_pelunasan', 'asc');
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

  public function getFakturByNo($no_faktur) {
    $this->db->select('nama_supplier, tagihan');
    $this->db->from('vfaktur');
    $this->db->where('no_fm', $no_faktur);
    $query = $this->db->get();
    return $query->row(); // Mengembalikan satu baris data
  }

  public function getFakturByNoPenjualan($no_faktur) {
    $this->db->select('nama_plg, tagihan');
    $this->db->from('vfaktur_penjualan');
    $this->db->where('kode_penjualan', $no_faktur);
    $query = $this->db->get();
    return $query->row(); // Mengembalikan satu baris data
  }

  public function getLunas($id) {
    $this->db->where('id_pelunasan', $id);
    $query = $this->db->get('tb_pelunasan'); // Ganti 'tb_pelunasan' dengan nama tabel yang sesuai
    return $query->row(); // Ambil satu baris data
}
}