<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BarangPindah_model extends CI_Model {
    public function update($id, $data) {
        $this->db->where('id_keluar', $id);
        $this->db->update('tb_brg_keluar', $data);
        // $this->db->update_batch('tb_brg_keluar', $data);
    }
    public function create($data) {
        $this->db->insert('tb_pindahbrg', $data);
    }
    public function addpindahbrg($data) {
        $this->db->insert('tb_pindahbrgdetail', $data);
    }
    public function deletebrg($idtl,$idk,$data){
      $success = $this->db->delete('tb_pindahbrgdetail', array("id_detailp" => $idtl));
      $this->db->where('id_keluar', $idk);
      $this->db->update('tb_brg_keluar', $data);
      $message = $success ? 'Data berhasil dihapus' : 'Gagal dihapus';
      return array('success' => $success, 'message' => $message);
    }
    public function deletesp($idp,$data){
        $delete1 = true;
        $delete2 = true;
        if ($idp !== null) {
            $this->db->select('id_keluar');
            $this->db->from('tb_pindahbrgdetail');
            $this->db->where('id_pindah', $idp);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                $delete1 = $this->db->delete('tb_pindahbrg', array("id_pindah" => $idp));
                $delete2 = $this->db->delete('tb_pindahbrgdetail', array("id_pindah" => $idp));

                foreach ($query->result() as $row) {
                    $idk = $row->id_keluar;
                    $this->db->where('id_keluar', $idk);
                    $this->db->update('tb_brg_keluar', $data);
                }
            }else{
                $delete1 = $this->db->delete('tb_pindahbrg', array("id_pindah" => $idp));
            }
        }
        $success = $delete1 && $delete2;
        $message = $success ? 'Data berhasil dihapus' : 'Gagal dihapus';
        return array('success' => $success, 'message' => $message);
    }
    public function approvepindah($sp) {
        $this->db->where('id_pindah', $sp);
        $this->db->update('tb_pindahbrg', array("status" => "1"));
    }
    public function getWhere($id){   
      $query = $this->db->group_by('nosp')->get_where('vpindah', array('nosp' => $id));
      return $query->result_array();
    }
    public function detailprint($sp) {
      $this->db->select('id_detailp,tgl_pindah,nosp,kpd_cab,sn_brg,nama_brg,merk,jenis,spek,kondisi')
      ->from('vpindahdtl')
      ->where('nosp',$sp);
      $this->db->order_by('id_detailp', 'asc');
      $query = $this->db->get();
      return $query->result_array();
    }
    
    public function getProd($fcab,$searchTerm = null) {
        $this->db->select(['vbk.id_keluar', 'sn_brg', 'merk', 'jenis', 'nama_brg','kondisi','spek','hrg_hpp','hrg_jual'])
        ->from('vbarangkeluar AS vbk')
        ->join('tb_pindahbrgdetail AS tpd', 'vbk.id_keluar = tpd.id_keluar', 'left')
        // ->join('tb_pindahbrg AS tpb', 'tpd.id_pindah = tpb.id_pindah', 'left')
        // ->where('tpd.id_keluar IS NULL')
        // ->where('tpd.id_pindah NOT IN (SELECT id_pindah FROM tb_pindahbrg)')
        ->where('id_toko',$fcab)
        ->where('vbk.status','2')
        ->group_by('vbk.id_keluar');
        if ($searchTerm) {
            $this->db->group_start();
            $this->db->like('sn_brg', $searchTerm);
            $this->db->or_like('merk', $searchTerm);
            $this->db->or_like('jenis', $searchTerm);
            $this->db->or_like('nama_brg', $searchTerm);
            $this->db->group_end();
        }

        $this->db->order_by('id_keluar', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }
}

/* End of file BarangPindah_model.php */
/* Location: ./application/models/BarangPindah_model.php */