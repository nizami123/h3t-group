<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BarangTerima_model extends CI_Model {
    public function approve($sk, $data) {
        $this->db->where('no_surat_keluar', $sk);
        $this->db->update('tb_brg_keluar', $data);
    }

    public function approvegd($sk, $data) {
        $this->db->where('tb_brg_masuk.id_masuk IN (SELECT id_masuk FROM tb_brg_keluar WHERE no_surat_keluar = "'.$sk.'")', NULL, FALSE);
        $this->db->update('tb_brg_masuk', $data);
    }    

    public function getCabang($searchTerm=null){
        $this->db->select(['id_toko', 'nama_toko']);
        $this->db->from('tb_toko');
        if ($searchTerm) {
            $this->db->group_start();
            $this->db->like('id_toko', $searchTerm);
            $this->db->or_like('nama_toko', $searchTerm);
            $this->db->group_end();
        }
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getKCabang($searchTerm=null){
        $this->db->select(['id_toko', 'nama_toko']);
        $this->db->from('tb_toko');
        if ($searchTerm) {
            $this->db->group_start();
            $this->db->like('id_toko', $searchTerm);
            $this->db->or_like('nama_toko', $searchTerm);
            $this->db->group_end();
        }
        $query = $this->db->get();
        return $query->result_array();
    }
    public function approvesp($idp, $data) {
        $this->db->where('id_pindah', $idp);
        $this->db->update('tb_pindahbrg', $data);
    }
    public function approvestp($idp, $data) {
        $this->db->where('tb_brg_keluar.id_keluar IN (SELECT id_keluar FROM tb_pindahbrgdetail WHERE id_pindah = "'.$idp.'")', NULL, FALSE);
        $this->db->update('tb_brg_keluar', $data);
    }
}

/* End of file BarangTerima_model.php */
/* Location: ./application/models/BarangTerima_model.php */