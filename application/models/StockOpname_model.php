<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class StockOpname_model extends CI_Model {

  public function prodm() {
    $this->db->where_in('status', ['1']);
    $query = $this->db->get('vbarangmasuk');
    return $query->num_rows();
  }

  public function prodk() {
    $this->db->where_in('status', ['2']);
    $query = $this->db->get('vbarangkeluar');
    return $query->num_rows();
  }

  public function totalprod() {
    $this->db->where_in('status', ['1']);
    $pm = $this->db->get('vbarangmasuk')->num_rows(); // Get the number of rows directly
    
    $this->db->where_in('status', ['2']);
    $pk = $this->db->get('vbarangkeluar')->num_rows(); // Get the number of rows directly
    
    $total = $pm + $pk; // Calculate the total
    return $total; // Return the total number of products
  }

  public function getAuditor($id,$searchTerm=null){
    $this->db->select(['id_admin as id_user', 'nama_lengkap','nama_toko','id_toko']);
    $this->db->from('vtoko_opname');
    $this->db->where('id_toko',$id);
		$this->db->where('id_admin',$this->session->userdata('id_user'));
    if ($searchTerm) {
        $this->db->group_start();
        $this->db->like('id_user', $searchTerm);
        $this->db->or_like('nama_lengkap', $searchTerm);
        $this->db->group_end();
    }
    $query = $this->db->get();
    return $query->result_array();
  }

  public function getCabang($idt=null,$searchTerm=null){
    $this->db->select(['id_user', 'nama_lengkap','nama_toko','id_toko']);
    $this->db->from('vtoko');
    if ($searchTerm) {
        $this->db->group_start();
        $this->db->like('id_toko', $searchTerm);
        $this->db->or_like('nama_toko', $searchTerm);
        $this->db->group_end();
    }
    if ($idt !== null) {
      $this->db->where('id_toko', $idt);
    }
    $query = $this->db->get();
    return $query->result_array();
  }
  public function getDetailOpname($kode_opname)
  {
    $data_opname = $this->db->where('kode_opname', $kode_opname)->get('vopname_dtl')->result();
    return $data_opname;
  }

  public function getLastKode() {
    $this->db->select('kode_opname');
    $this->db->from('tb_opname');
    $this->db->order_by('kode_opname', 'desc');
    $this->db->limit(1);
    $query = $this->db->get();
    return $query->result_array();
  }
  public function getWhere($id){   
    $query = $this->db->group_by('kode_opname')->get_where('vopname', array('id_opname' => $id));
    return $query->result_array();
  }
  public function create($data){
    $this->db->insert('tb_opname',$data);
  }
  public function createpr($data) {
    $existdata = $this->db->select('id_opname, id_keluar')
                ->where('id_opname', $data['id_opname'])
                ->where('id_keluar', $data['id_keluar'])
                ->get('tb_opname_detail')
                ->row();
    if (!$existdata) {
      $this->db->insert('tb_opname_detail',$data);
      return true;
    } else {
      return false;
    }
  }
  public function approveop($data){
    $this->db->where('status','1');
    $this->db->update('tb_opname', $data);
  }
  public function approvebyop($idop,$data){
    $this->db->where('id_opname',$idop);
    $this->db->update('tb_opname', $data);
  }
  public function updatebrgcab($idk,$data){
    $this->db->where('id_keluar',$idk);
    $this->db->update('tb_brg_keluar', $data);
  }
  public function delete($id){
    $success_opname = $this->db->delete('tb_opname', array("id_opname" => $id));
    $success_detail = $this->db->delete('tb_opname_detail', array("id_opname" => $id));
    $success = $success_opname && $success_detail;
    $message = $success ? 'Data berhasil dihapus' : 'Gagal dihapus';
    return array('success' => $success, 'message' => $message);
  }
  public function getProdOP($idt,$idop,$sn) {
    $this->db->select(['id_opname','id_keluar', 'sn_brg', 'merk', 'jenis', 'nama_brg','kondisi','spek','hrg_hpp','hrg_jual','id_toko'])
    ->from('vprdop')
    ->where_not_in('jenis','Aksesoris')
    ->where('id_toko',$idt)
    ->where('id_opname',$idop)
    ->where('sn_brg', $sn);
    $query = $this->db->get();
    return $query->result_array();
  }
  public function getProdOPHistory($idt,$idop,$sn) {
    $this->db->select(['id_opname','id_keluar', 'sn_brg', 'merk', 'jenis', 'nama_brg','id_toko'])
    ->from('vopname_dtl')
    ->where_not_in('jenis','Aksesoris')
    ->where('id_toko',$idt)
    ->where('id_opname',$idop)
    ->where('sn_brg', $sn);
    $query = $this->db->get();
    return $query->result_array();
  }
  public function getAccOP($idt,$idop,$sn) {
    $this->db->select(['id_opname','id_keluar', 'sn_brg', 'merk', 'jenis', 'nama_brg','kondisi','spek','hrg_hpp','hrg_jual','id_toko'])
    ->from('vprdop')
    ->where_in('tipe',['Aksesoris','Accesoris'])
    ->where('id_toko',$idt)
    ->where('id_opname',$idop)
    ->where('sn_brg', $sn);
    $query = $this->db->get();
    return $query->result_array();
  }
  public function getAccOPHistory($idt,$idop,$sn) {
    $this->db->select(['id_opname','id_keluar', 'sn_brg', 'merk', 'jenis', 'nama_brg','id_toko'])
    ->from('vopname_dtl')
    ->where_in('tipe',['Aksesoris','Accesoris'])
    ->where('id_toko',$idt)
    ->where('id_opname',$idop)
    ->where('sn_brg', $sn);
    $query = $this->db->get();
    return $query->result_array();
  }  
  public function getFilterJenis($searchTerm) {
    $this->db->select(['jenis']);
    $this->db->from('vprdop');
    if ($searchTerm) {
        $this->db->group_start();
        $this->db->like('jenis', $searchTerm);
        $this->db->group_end();
    }
    $this->db->group_by('jenis');
    $query = $this->db->get();
    return $query->result_array();
  }
}

/* End of file StockOpname_model.php */
/* Location: ./application/models/StockOpname_model.php */
