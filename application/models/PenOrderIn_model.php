<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PenOrderIn_model extends CI_Model {

  public function countHJ($id = null) {
    $currentDate = date('Y-m-d');
    $this->db->select([
      "COALESCE((SELECT REPLACE(REPLACE(FORMAT(SUM(v.harga_bayar),0), ',', '.'), '.', '.')
                FROM vpenjualan AS v
                WHERE v.id_toko = stores.id_toko
                AND DATE(v.tgl_transaksi) = '{$currentDate}'
                AND v.status IN (1, 2)), 0) AS total_penjualan",
      "stores.id_toko", 
      "stores.nama_toko"
    ]);
    $this->db->from('vtoko AS stores');
    if ($id) {
        $this->db->group_start();
        $this->db->like('stores.id_toko', $id);
        $this->db->group_end();
    }
    $query = $this->db->get();
    return $query->result_array();
  }
  public function approve($inv, $data) {
    $this->db->where('kode_penjualan', $inv);
    $this->db->update('tb_detail_penjualan', $data);
  }
  public function approvegestun($idk, $data) {
    $this->db->where('id_keluar', $idk);
    $this->db->update('tb_brg_keluar', $data);
  }
  public function approvedsold($idk, $data) {
    $this->db->where('id_keluar', $idk);
    $this->db->update('tb_brg_keluar', $data);
  }    
  public function cancel($inv, $data) {
    $this->db->where('kode_penjualan', $inv);
    $this->db->update('tb_detail_penjualan', $data);
  }
  public function stok($idk, $data) {
    $this->db->where('id_keluar', $idk);
    $this->db->update('tb_brg_keluar', $data);
  }
  public function diskon($kdi, $data) {
    $this->db->where('kode_diskon', $kdi);
    $this->db->update('tb_diskon', $data);
  }
  public function getidbarang($idkel) {
    $this->db->select(['id_keluar','id_diskon',
    '(COUNT(id_diskon)+td.kuota) AS kuota',
    '((harga_diskon * COUNT(id_diskon))+td.total_diskon) AS total_diskon']);
    $this->db->from('vpenjualan v');
    $this->db->join('tb_diskon td','v.id_diskon = td.kode_diskon', 'left');
    $this->db->where('kode_penjualan', $idkel);
    $this->db->group_by('id_keluar');
    $query = $this->db->get();
    return $query->result_array();
  }
}

/* End of file PenOrderIn_model.php */
/* Location: ./application/models/PenOrderIn_model.php */