<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PenRiwayat_model extends CI_Model {
    public function cancel($inv, $data) {
        $this->db->where('kode_penjualan', $inv);
        $this->db->update('tb_detail_penjualan', $data);
    }
    public function stok($idk, $data) {
        $this->db->where('id_keluar', $idk);
        $this->db->update('tb_brg_keluar', $data);
    }
    public function update_komisi($kode, $data) {
        $this->db->where('kode_penjualan', $kode);
        $this->db->update('tb_detail_penjualan', $data);
    }
}

/* End of file PenRiwayat_model.php */
/* Location: ./application/models/PenRiwayat_model.php */