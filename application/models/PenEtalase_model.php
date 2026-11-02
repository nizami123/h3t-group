<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PenEtalase_model extends CI_Model {
    /**
     * @param int|string $id
     * @param array $data
     * @return void
     */
    public function update($id, $data): void
    {
      $this->db->where('id_keluar', $id);
      $this->db->update('tb_brg_keluar', $data);
    }
    /**
     * @param int|string $id
     * @param array $data
     * @return void
     */
    public function updatebm($id, $data): void
    {
      $this->db->where('id_masuk', $id);
      $this->db->update('tb_brg_masuk', $data);
    }
    /**
     * @param int|string $id
     * @return array
     */
    public function getWhere($id): array
    {   
      $this->db->select('id_keluar,sn_brg,nama_supplier,nama_brg,kondisi,merk,jenis,spek,tgl_keluar,nama_toko');
      $query = $this->db->get_where('vbarangkeluar', array('id_keluar' => $id));
      return $query->result_array();
    }
}

/* End of file PenEtalase_model.php */
/* Location: ./application/models/PenEtalase_model.php */