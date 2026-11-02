<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once(APPPATH . 'controllers/Auth.php');

class MasterPPN extends Auth {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Masterppn_model');
    }

    public function index()
    {
        $cab = $this->session->userdata('id_toko');
        $data['barangcabang'] = $this->second->barangCabang($cab);
        $data['setcabang'] = $this->first->getCabang();
        $data['content'] = $this->load->view('master/masterppn', '', true);
        $data['modal'] ='';
        $data['css'] = '
        <link rel="stylesheet" type="text/css" href="' . base_url('assets/css/vendors/datatables.css') . '">
        <link rel="stylesheet" type="text/css" href="'.base_url('assets/css/vendors/sweetalert2.css').'">
        ';
        $data['js'] = '
        <script>var base_url = "' . base_url() . '";</script>
        <script src="' . base_url('assets/js/sweet-alert/sweetalert.min.js').'"></script>
        <script src="' . base_url('assets/js/datatable/datatables/jquery.dataTables.min.js') . '"></script>
        <script src="' . base_url('assets/js/datatable/datatables/datatable.custom.js') . '"></script>
        <script src="' . base_url('assets/js/datatable/datatable-extension/dataTables.buttons.min.js') . '"></script>
        <script src="' . base_url('assets/js/additional-js/mppn.js') . '"></script>
        ';
        $this->load->view('layout/base', $data);
    }

    public function loadppn()
    {
        $result = $this->Masterppn_model->get_all();
        $data = [];
        $no = 1;
        foreach ($result as $row) {
            $data[] = [
                'no' => $no++,
                'id' => $row->id,
                'nama' => $row->nama,
                'nilai' => $row->nilai . '%'
            ];
        }
        echo json_encode(['data' => $data]);
    }

    public function createpost()
    {
        if ($this->input->is_ajax_request()) {
            $nama = $this->input->post('nama', true);
            $nilai = $this->input->post('nilai', true);

            if (empty($nama) || $nilai === '' || !is_numeric($nilai)) {
                echo json_encode(['status' => false, 'message' => 'Nama dan Nilai PPN harus diisi dengan benar!']);
                return;
            }

            if ($nilai < 0 || $nilai > 100) {
                echo json_encode(['status' => false, 'message' => 'Nilai PPN harus antara 0 sampai 100!']);
                return;
            }

            $data = [
                'nama' => $nama,
                'nilai' => $nilai
            ];

            $insert = $this->Masterppn_model->insert($data);
            if ($insert) {
                echo json_encode(['status' => true, 'message' => 'Data PPN berhasil ditambahkan!']);
            } else {
                echo json_encode(['status' => false, 'message' => 'Gagal menambahkan data PPN!']);
            }
        } else {
            redirect('master-ppn');
        }
    }

    public function edit($id)
    {
        $row = $this->Masterppn_model->get_by_id($id);
        if ($row) {
            echo json_encode(['status' => true, 'data' => $row]);
        } else {
            echo json_encode(['status' => false, 'message' => 'Data tidak ditemukan!']);
        }
    }

    public function updatepost()
    {
        if ($this->input->is_ajax_request()) {
            $id = $this->input->post('id', true);
            $nama = $this->input->post('nama', true);
            $nilai = $this->input->post('nilai', true);

            if (empty($id) || empty($nama) || $nilai === '' || !is_numeric($nilai)) {
                echo json_encode(['status' => false, 'message' => 'Data tidak lengkap atau tidak valid!']);
                return;
            }

            if ($nilai < 0 || $nilai > 100) {
                echo json_encode(['status' => false, 'message' => 'Nilai PPN harus antara 0 sampai 100!']);
                return;
            }

            $data = [
                'nama' => $nama,
                'nilai' => $nilai
            ];

            $update = $this->Masterppn_model->update($id, $data);
            if ($update) {
                echo json_encode(['status' => true, 'message' => 'Data PPN berhasil diperbarui!']);
            } else {
                echo json_encode(['status' => false, 'message' => 'Gagal memperbarui data PPN!']);
            }
        } else {
            redirect('master-ppn');
        }
    }

    public function deletepost($id)
    {
        $delete = $this->Masterppn_model->delete($id);
        if ($delete) {
            echo json_encode(['status' => true, 'message' => 'Data PPN berhasil dihapus!']);
        } else {
            echo json_encode(['status' => false, 'message' => 'Gagal menghapus data PPN!']);
        }
    }

}

/* End of file MasterPPN.php */
/* Location: ./application/controllers/MasterPPN.php */
