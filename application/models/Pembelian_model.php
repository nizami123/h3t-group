<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembelian_model extends CI_Model {
    public function cancel($inv, $data) {
        $this->db->where('kode_penjualan', $inv);
        $this->db->update('tb_detail_penjualan', $data);
    }
    public function stok($idk, $data) {
        $this->db->where('id_keluar', $idk);
        $this->db->update('tb_brg_keluar', $data);
    }
}

/* End of file Pembelian_model.php */
/* Location: ./application/models/Pembelian_model.php */