<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LpConfig_model extends CI_Model {

    public function insert_banner($data)
    {
        return $this->db->insert('tb_lp_banner', $data);
    }

    public function get_banners()
    {
        return $this->db->get('tb_lp_banner')->result();
    }

    public function delete_banner($id)
    {
        // Get banner data to unlink file if needed
        $banner = $this->db->get_where('tb_lp_banner', ['id' => $id])->row();
        if ($banner && !empty($banner->banner_source)) {
            $file_path = FCPATH . $banner->banner_source;
            if (file_exists($file_path)) {
                @unlink($file_path);
            }
        }
        return $this->db->where('id', $id)->delete('tb_lp_banner');
    }

    public function insert_produk($data)
    {
        return $this->db->insert('tb_lp_produk', $data);
    }

    public function get_produk()
    {
        return $this->db->get('tb_lp_produk')->result();
    }

    public function get_produk_by_id($id)
    {
        return $this->db->get_where('tb_lp_produk', ['id' => $id])->row();
    }

    public function update_produk($id, $data)
    {
        return $this->db->where('id', $id)->update('tb_lp_produk', $data);
    }

    public function delete_produk($id)
    {
        $produk = $this->db->get_where('tb_lp_produk', ['id' => $id])->row();
        if ($produk && !empty($produk->produk_img)) {
            $file_path = FCPATH . $produk->produk_img;
            if (file_exists($file_path)) {
                @unlink($file_path);
            }
        }
        return $this->db->where('id', $id)->delete('tb_lp_produk');
    }

    public function insert_config($data)
    {
        return $this->db->insert('tb_lp_config', $data);
    }

    public function get_configs()
    {
        return $this->db->get('tb_lp_config')->result();
    }

    public function delete_config($id)
    {
        return $this->db->where('id', $id)->delete('tb_lp_config');
    }

}

/* End of file LpConfig_model.php */
/* Location: ./application/models/LpConfig_model.php */