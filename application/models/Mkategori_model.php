<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mkategori_model extends CI_Model {

  public function create($kode, $nk)
  {
    $existingCategory = $this->db->where('nama_kategori', $nk)
                        ->where('kode', $kode)
                        ->get('tb_kategori')
                        ->row();
    if (!$existingCategory) {
        $data = array(
            'kode' => $kode,
            'nama_kategori' => $nk
        );
        $this->db->insert('tb_kategori', $data);
        return true; 
    } else {
        return false; 
    }
  }

  public function delete($id)
  {
    $success = $this->db->delete('tb_kategori', array("id_kategori" => $id));
    $message = $success ? 'Data berhasil dihapus' : 'Gagal dihapus';
    return array('success' => $success, 'message' => $message);
  }

}

/* End of file Mkategori_model.php */
/* Location: ./application/models/Mkategori_model.php */