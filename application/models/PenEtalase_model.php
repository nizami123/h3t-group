<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PenEtalase_model extends CI_Model {
    public function update($id, $data)
    {
      $this->db->where('id_keluar', $id);
      $this->db->update('tb_brg_keluar', $data);
    }
    public function updatebm($id, $data)
    {
      $this->db->where('id_masuk', $id);
      $this->db->update('tb_brg_masuk', $data);
    }
    public function getWhere($id){   
      $this->db->select('id_keluar,sn_brg,nama_supplier,nama_brg,kondisi,merk,jenis,spek,tgl_keluar,nama_toko');
      $query = $this->db->get_where('vbarangkeluar', array('id_keluar' => $id));
      return $query->result_array();
    }
}

/* End of file PenEtalase_model.php */
/* Location: ./application/models/PenEtalase_model.php */