<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Masterppn_model extends CI_Model {

    public function get_all()
    {
        return $this->db->get('tb_ppn')->result();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('tb_ppn', ['id' => $id])->row();
    }

    public function insert($data)
    {
        return $this->db->insert('tb_ppn', $data);
    }

    public function update($id, $data)
    {
        return $this->db->where('id', $id)->update('tb_ppn', $data);
    }

    public function delete($id)
    {
        return $this->db->where('id', $id)->delete('tb_ppn');
    }

}

/* End of file Masterppn_model.php */
/* Location: ./application/models/Masterppn_model.php */
