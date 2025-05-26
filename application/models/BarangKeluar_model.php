<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BarangKeluar_model extends CI_Model {

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

  public function getBrgb($searchTerm = null) {
    $this->db->select(['vm.id_masuk', 'vm.sn_brg', 'vm.merk', 'vm.jenis', 'vm.nama_brg','vm.kondisi','vm.spek','vm.hrg_hpp','vm.hrg_jual'])
             ->from('vbarangready AS vm')
             ->where('vm.kondisi','Baru')
             ->where('vm.jenis_barang', 'UNIT');
    if ($searchTerm) {
        $this->db->group_start();
        $this->db->like('vm.sn_brg', $searchTerm);
        $this->db->or_like('vm.merk', $searchTerm);
        $this->db->or_like('vm.jenis', $searchTerm);
        $this->db->or_like('vm.nama_brg', $searchTerm);
        $this->db->group_end();
    }

    $this->db->order_by('vm.sn_brg', 'desc');
    $query = $this->db->get();
    return $query->result_array();
  }
  public function getBrgk($searchTerm = null) {
    $this->db->select(['vm.id_masuk', 'vm.sn_brg', 'vm.merk', 'vm.jenis', 'vm.nama_brg','vm.kondisi','vm.spek','vm.hrg_hpp','vm.hrg_jual'])
             ->from('vbarangready AS vm')
             ->where('vm.kondisi','Bekas')
             ->where('vm.jenis_barang', 'UNIT');
    if ($searchTerm) {
        $this->db->group_start();
        $this->db->like('vm.sn_brg', $searchTerm);
        $this->db->or_like('vm.merk', $searchTerm);
        $this->db->or_like('vm.jenis', $searchTerm);
        $this->db->or_like('vm.nama_brg', $searchTerm);
        $this->db->group_end();
    }

    $this->db->order_by('vm.sn_brg', 'desc');
    $query = $this->db->get();
    return $query->result_array();
  }
  public function getBrgacc($searchTerm = null) {
    $this->db->select(['vm.id_masuk', 'vm.sn_brg', 'vm.merk', 'vm.jenis', 'vm.nama_brg','vm.kondisi','vm.spek','vm.hrg_hpp','vm.hrg_jual','count(vm.merk) as total_acc'])
             ->from('vbarangready AS vm')
             ->where('vm.jenis_barang', 'ACC');
    if ($searchTerm) {
        $this->db->group_start();
        $this->db->like('vm.nama_brg', $searchTerm);
        $this->db->group_end();
    }
    $this->db->group_by('vm.nama_brg');
    $this->db->order_by('vm.sn_brg', 'desc');
    $query = $this->db->get();
    return $query->result_array();
  }
  public function getMerkacc($nmbrg,$searchTerm = null) {
    $nmbrg = urldecode($nmbrg);
    $this->db->select(['vm.id_masuk', 'vm.merk', 'vm.nama_brg'])
        ->from('vbarangmasuk AS vm')
        ->join('vbarangkeluar AS vk', 'vm.id_masuk = vk.id_masuk', 'left')
        ->where('vk.id_masuk IS NULL')
        ->like('vm.nama_brg',$nmbrg);
    if ($searchTerm) {
      $this->db->group_start();
      $this->db->or_like('vm.merk', $searchTerm);
      $this->db->group_end();
    }
    $this->db->group_by('vm.merk');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function countBK($id){
    $this->db->select('id_toko, 
        COUNT(CASE WHEN status = 2 THEN 1 END) AS brg_rdy,
        COUNT(CASE WHEN status = 1 THEN 1 END) AS brg_otw');
    $this->db->from('tb_brg_keluar');
    $this->db->where('id_toko',$id);
    $this->db->group_by('id_toko');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function create($data){
    $existingRecord = $this->db->where('id_masuk', $data['id_masuk'])
                        ->get('tb_brg_keluar')
                        ->row();
    if (!$existingRecord) {
        $this->db->insert('tb_brg_keluar', $data);
        return true;
    } else {
        return false;
    }
  }

  public function delete($id)
  {
    $success = $this->db->delete('tb_brg_keluar', array("id_keluar" => $id));
    $message = $success ? 'Data berhasil dihapus' : 'Gagal dihapus';
    return array('success' => $success, 'message' => $message);
  }
  public function deleteidk($id)
  {
    $this->db->delete('tb_pindahbrgdetail', array("id_detailp" => $id));
  }
  public function updatestokgd($id) {
    $this->db->where('id_masuk', $id);
    $this->db->update('tb_brg_masuk', array('status'=>'1'));
  }
  public function sendcab($nosk) {
    $this->db->where('no_surat_keluar', $nosk);
    $this->db->update('tb_brg_keluar', array('status'=>'0'));
  }
  public function getWhere($id)
  {   
    $query = $this->db->group_by('no_surat_keluar')->get_where('vbarangkeluar', array('no_surat_keluar' => $id));
    return $query->result_array();
  }

  public function detailprint($ns) {
    $this->db->select('id_keluar,tgl_keluar,no_surat_keluar,nama_toko,sn_brg,nama_brg,merk,jenis,spek,kondisi,status')
    ->from('vbarangkeluar')
    ->where('no_surat_keluar',$ns);
    $this->db->order_by('id_keluar', 'asc');
    $query = $this->db->get();
    return $query->result_array();
  }

}

/* End of file BarangKeluar_model.php */
/* Location: ./application/models/BarangKeluar_model.php */