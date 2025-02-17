<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FinSupp_model extends CI_Model {
    public function getInvDP() {
        $this->db->select('invoice_dp');
        $this->db->from('tb_dp_supplier');
        $this->db->order_by('invoice_dp', 'desc');
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getBank($searchTerm=null) {
        $this->db->select(['id_bank','nama_bank','no_rek', 'nama_rek']);
        $this->db->from('tb_bank');
    
        if ($searchTerm) {
            $this->db->group_start();
            $this->db->like('no_rek', $searchTerm);
            $this->db->or_like('nama_rek', $searchTerm);
            $this->db->group_end();
        }
    
        $this->db->order_by('nama_bank', 'asc');
        $query = $this->db->get();
        return $query->result_array();        
    }
    public function create($data){
        $this->db->insert('tb_dp_supplier', $data);
    }
    public function getDP($id){
        $this->db->select(['id_supplier','nama_supplier','sum(nominal_dp) as total_dp']);
        $this->db->from('vdpsupplier');
        $this->db->where('id_supplier',$id);
        $this->db->group_by('id_supplier');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function delete($id){
      $success = $this->db->delete('tb_dp_supplier', array("id_transaksi_dp" => $id));
      $message = $success ? 'Data berhasil dihapus' : 'Gagal dihapus';
      return array('success' => $success, 'message' => $message);
    }
}

/* End of file FinSupp_model.php */
/* Location: ./application/models/FinSupp_model.php */