<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Mkaryawan_model extends CI_Model {


  public function __construct()
  {
    parent::__construct();
  }

  public function tambahjabatan($nj,$data) {
    $exist = $this->db->where('nama_jab', $nj)
                        ->get('tb_jabatan')
                        ->row();
    if (!$exist) {
        $this->db->insert('tb_jabatan',$data);
        return true; 
    } else {
        return false; 
    }
  }
  public function tambahrole($nr,$data) {
    $exist = $this->db->where('nama_role', $nr)
                        ->get('tb_role')
                        ->row();
    if (!$exist) {
        $this->db->insert('tb_role',$data);
        return true; 
    } else {
        return false; 
    }    
  }
  public function getJabatan($searchTerm = null) {
    $this->db->select(['id_jab', 'nama_jab']);
    $this->db->from('tb_jabatan');

    if ($searchTerm) {
        $this->db->group_start();
        $this->db->like('nama_jab', $searchTerm);
        $this->db->group_end();
    }

    $this->db->order_by('id_jab', 'asc');
    $query = $this->db->get();
    return $query->result_array();
  }
  public function getRole($searchTerm = null) {
    $this->db->select(['id_role','nama_role']);
    $this->db->from('tb_role');
    if ($searchTerm) {
      $this->db->group_start();
      $this->db->like('nama_role', $searchTerm);
      $this->db->group_end();
    }
    $this->db->order_by('id_role', 'asc');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function create($id,$nl,$tl,$jk,$email,$password,$prov,$kab,$kec,$kode,$alamat,$wa,$cv,$jabatan,$role,$gaji)
  {
    $data = array(
      'id_user' => $id,
      'nama_lengkap' => $nl,
      'tanggal_lahir' => $tl,
      'jen_kel' => $jk,
      'email'=> $email,
      'password'=> $password,
      'provinsi'=> $prov,
      'kabupaten'=> $kab,
      'kecamatan'=> $kec,
      'kode_pos'=> $kode,
      'alamat' => $alamat,
      'no_wa' => $wa,
      'file_cv' => $cv,
      'jabatan' => $jabatan,
      'role_user' => $role,
      'gaji' => $gaji,
      'status' => '1'
    );  
    $this->db->insert('tb_user',$data);
  }

  public function delete($id)
  {
    $this->db->where('id_karyawan', $id);
    $query = $this->db->get('tb_toko');
    $this->db->where('id_ksr', $id);
    $query2 = $this->db->get('tb_detail_penjualan');
    $this->db->where('id_user', $id);
    $query3 = $this->db->get('tb_opname');

    if ($query->num_rows() > 0) {
      return array('success' => false, 'message' => 'Data karyawan dengan id "'.$id.'" tidak bisa dihapus, karena terdaftar di Cabang');
    } elseif ($query2->num_rows() > 0) {
        return array('success' => false, 'message' => 'Data karyawan dengan id "'.$id.'" tidak bisa dihapus, karena sudah melakukan Transaksi Penjualan');
    } elseif ($query3->num_rows() > 0) {
        return array('success' => false, 'message' => 'Data karyawan dengan id "'.$id.'" tidak bisa dihapus, karena sudah melakukan Stock Opname');
    }
    $success = $this->db->delete('tb_user', array("id_user" => $id));
    $message = $success ? 'Data berhasil dihapus' : 'Gagal dihapus';
    return array('success' => $success, 'message' => $message);
  }
  public function deleteksr($id)
  {
    $this->db->where('id_karyawan', $id);
    $query = $this->db->get('tb_toko');
    $this->db->where('id_ksr', $id);
    $query2 = $this->db->get('tb_detail_penjualan');
    $this->db->where('id_user', $id);
    $query3 = $this->db->get('tb_opname');

    if ($query->num_rows() > 0) {
      return array('success' => false, 'message' => 'Data karyawan dengan id "'.$id.'" tidak bisa dihapus, karena terdaftar di Cabang');
    } elseif ($query2->num_rows() > 0) {
        return array('success' => false, 'message' => 'Data karyawan dengan id "'.$id.'" tidak bisa dihapus, karena sudah melakukan Transaksi Penjualan');
    } elseif ($query3->num_rows() > 0) {
        return array('success' => false, 'message' => 'Data karyawan dengan id "'.$id.'" tidak bisa dihapus, karena sudah melakukan Stock Opname');
    }
    $success = $this->db->delete('tb_kasir', array("id_ksr" => $id));
    $message = $success ? 'Data berhasil dihapus' : 'Gagal dihapus';
    return array('success' => $success, 'message' => $message);
  }
  public function deleteadm($id)
  {
    $this->db->where('id_karyawan', $id);
    $query = $this->db->get('tb_toko');
    $this->db->where('id_ksr', $id);
    $query2 = $this->db->get('tb_detail_penjualan');
    $this->db->where('id_user', $id);
    $query3 = $this->db->get('tb_opname');

    if ($query->num_rows() > 0) {
      return array('success' => false, 'message' => 'Data karyawan dengan id "'.$id.'" tidak bisa dihapus, karena terdaftar di Cabang');
    } elseif ($query2->num_rows() > 0) {
      return array('success' => false, 'message' => 'Data karyawan dengan id "'.$id.'" tidak bisa dihapus, karena sudah melakukan Transaksi Penjualan');
    } elseif ($query3->num_rows() > 0) {
      return array('success' => false, 'message' => 'Data karyawan dengan id "'.$id.'" tidak bisa dihapus, karena sudah melakukan Stock Opname');
    }
    $success = $this->db->delete('tb_admin', array("id_admin" => $id));
    $message = $success ? 'Data berhasil dihapus' : 'Gagal dihapus';
    return array('success' => $success, 'message' => $message);
  }

  public function update($id,$data){
    $this->db->where('id_user', $id);
    $this->db->update('tb_user', $data);
  }
  public function updateksr($id,$data){
    $this->db->where('id_ksr', $id);
    $this->db->update('tb_kasir', $data);
  }
  public function updateadm($id,$data){
    $this->db->where('id_admin', $id);
    $this->db->update('tb_admin', $data);
  }

  public function getWhere($id)
  {   
    $query = $this->db->get_where('tb_user', array('id_user' => $id));
    return $query->result_array();
  }

  public function getLastID() {
    $this->db->select('id_user');
    $this->db->from('tb_user');
    $this->db->where('status', '1');
    $this->db->order_by('id_user', 'desc');
    $this->db->limit(1);
    $query = $this->db->get();
    $result = $query->row(); // Get single row
    return $result ? $result->id_user : null; // Return single value or null if no result
  }

}

/* End of file Mkaryawan_model.php */
/* Location: ./application/models/Mkaryawan_model.php */