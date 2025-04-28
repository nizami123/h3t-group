<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Mcabang_model extends CI_Model {

  public function __construct()
  {
    parent::__construct();
  }

  public function getLastID() {
    $this->db->select('id_toko');
    $this->db->from('tb_toko');
    $this->db->order_by('id_toko', 'asc');
    $this->db->limit(1);
    $query = $this->db->get();
    return $query->result_array();
  }

  public function getAllKar($searchTerm=null) {
    $this->db->select(['id_user', 'nama_lengkap']);
    $this->db->from('tb_user');
    if ($searchTerm) {
      $this->db->group_start();
      $this->db->like('nama_lengkap', $searchTerm);
      $this->db->group_end();
    }
    $this->db->where_in('status', ['1']);
    $this->db->order_by('id_user', 'asc');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function create($idt, $idk, $nt, $prov, $kab, $kec, $kode, $alamat,$jenis)
  {
    $data = array(
      'id_toko' => $idt,
      'id_karyawan' => $idk,
      'nama_toko' => $nt,
      'provinsi'=> $prov,
      'kabupaten'=> $kab,
      'kecamatan'=> $kec,
      'kode_pos'=> $kode,
      'alamat' => $alamat,
      'jenis_toko' => $jenis,
      'status' => '1'
    );  
    $this->db->insert('tb_toko',$data);
  }

  public function delete($id)
  {
    $this->db->where('id_toko', $id);
    $query = $this->db->get('tb_brg_keluar');

    if ($query->num_rows() > 0) {
        return array('success' => false, 'message' => 'Data cabang dengan id "'.$id.'" tidak bisa dihapus');
    }
    $success = $this->db->delete('tb_toko', array("id_toko" => $id));
    $message = $success ? 'Data berhasil dihapus' : 'Gagal dihapus';
    return array('success' => $success, 'message' => $message);
  }

  public function update($idt, $data)
  {
    $this->db->where('id_toko', $idt);
    $this->db->update('tb_toko', $data);
  }

  public function getWhere($id)
  {   
    $query = $this->db->get_where('vtoko', array('id_toko' => $id));
    return $query->result_array();
  }


}

/* End of file Mcabang_model.php */
/* Location: ./application/models/Mcabang_model.php */