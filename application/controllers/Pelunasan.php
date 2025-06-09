<?php
defined('BASEPATH') or exit('No direct script access allowed');
include_once(APPPATH . 'controllers/Auth.php');
class Pelunasan extends Auth
{
    
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Pelunasan_model');
    $this->load->model('DashboarCab_model');
    $this->load->model('BarangKeluar_model');
    
  }

  public function index(){
    $cab = $this->session->userdata('id_toko');
    $data['content'] = $this->load->view('transaksi/pelunasan', '', true);
    $data['modal'] = '';
    $data['css'] = '
    <link rel="stylesheet" type="text/css" href="' . base_url('assets/css/vendors/datatables.css') . '">
    <link rel="stylesheet" type="text/css" href="' . base_url('assets/css/vendors/select2.css') . '">
    <link rel="stylesheet" type="text/css" href="'.base_url('assets/css/vendors/sweetalert2.css').'">
    <style>
        .select2-selection__rendered {
            line-height: 35px !important;
        }
        .select2-container .select2-selection--single {
            height: 38px !important;
            padding: 2px !important;
        }
        .select2-dropdown--below {
          margin-top:-2% !important;
        }
        .select2-selection__arrow {
            height: 37px !important;
        }
        .select2-container{
          margin-bottom :-6%;
        }
        table.dataTable input,
        table.dataTable select {
          border: 1px solid #efefef;
          height: 24px !important;
        }
    </style>
    ';
    $data['js'] = '
    <script>var base_url = "' . base_url() . '";</script>
    <script src="' . base_url('assets/js/sweet-alert/sweetalert.min.js').'"></script>
    <script src="' . base_url('assets/js/select2/select2.full.min.js') . '"></script>
    <script src="' . base_url('assets/js/additional-js/pelunasan.js?v='.time().'') . '"></script>
    <script src="' . base_url('assets/js/additional-js/id.js') . '"></script>
    <script src="' . base_url('assets/js/modalpage/validation-modal.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatables/jquery.dataTables.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/dataTables.buttons.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/jszip.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/buttons.colVis.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/vfs_fonts.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/dataTables.autoFill.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/dataTables.select.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/buttons.bootstrap4.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/buttons.html5.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/dataTables.bootstrap4.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/dataTables.responsive.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/responsive.bootstrap4.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/dataTables.keyTable.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/dataTables.colReorder.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/dataTables.fixedHeader.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/dataTables.scroller.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/custom.js') . '"></script>
    ';
    $this->load->view('layout/base', $data);
  }

  function generateid(){
    $data['lastID'] = $this->Pelunasan_model->getLastID();
    if (!empty($data['lastID'])) {
      preg_match('/(\d+)$/', $data['lastID'][0]['id_pelunasan'], $matches);
      $numericPart = isset($matches[1]) ? $matches[1] : '0000';
      $incrementedNumericPart = sprintf('%04d', intval($numericPart) + 1);
      $data['newID'] = 'H3TPEL-' . $incrementedNumericPart;
    }else {
      $data['newID'] = 'H3TPEL-0001';
    }
    return $data['newID'];
  }

  public function get_faktur() {
    $no_faktur = $this->input->post('no_faktur'); // Ambil data dari AJAX

    if ($no_faktur) {
        $data = $this->Pelunasan_model->getFakturByNo($no_faktur);
        if ($data) {
            echo json_encode(['success' => true, 'nama_supplier' => $data->nama_supplier, 'tagihan' => $data->tagihan]);
        } else {
            echo json_encode(['success' => false]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'No Faktur tidak boleh kosong']);
    }
}

  public function simpan()
  {
      // Ambil data dari form
      $no_pelunasan = $this->input->post('no_pelunasan');
      $no_faktur = $this->input->post('no_faktur');
      $tanggal = $this->input->post('tanggal');
      $nama_supplier = $this->input->post('nama_supplier');
      $metode = $this->input->post('metode');
      $norek = $this->input->post('norek');

      // Format angka ke integer untuk tagihan & bayar
      $tagihan = str_replace(',', '', $this->input->post('tagihan'));
      $bayar = str_replace(',', '', $this->input->post('bayar'));

      // Validasi: Bayar tidak boleh lebih besar dari Tagihan
      if ($bayar > $tagihan) {
          echo json_encode(['success' => false, 'message' => 'Jumlah Bayar tidak boleh lebih dari Nilai Tagihan!']);
          return;
      }

      // Data yang akan disimpan
      $data = [
          'id_pelunasan' => $no_pelunasan,
          'no_faktur' => $no_faktur,
          'tanggal' => $tanggal,
          'nama_supplier' => $nama_supplier,
          'metode' => $metode,
          'no_rekening' => $norek,
          'total_tagihan' => $tagihan,
          'jumlah' => $bayar,
          'ispost' => '0',
          'jenis_transaksi' => 'Pembelian',
          'id_user' => $this->session->userdata('id_user'),
          'created_on' => date('Y-m-d H:i:s')
      ];

      $existing = $this->db
        ->where('id_pelunasan', $data['id_pelunasan'])
        ->where('jenis_transaksi', 'Pembelian') // Ganti 'nama_jenis' dengan nilai yang sesuai
        ->get('tb_pelunasan')
        ->row();

      if ($existing) {
          // Jika no_pelunasan sudah ada, lakukan update
          $this->db->where('id_pelunasan', $data['id_pelunasan']);
          $update = $this->db->update('tb_pelunasan', $data);
          
          if ($update) {
              $status_pem = ($bayar == 0) ? 3 : (($bayar == $tagihan) ? 2 : 1);

              $this->db->set('status_pem', $status_pem)
                      ->where('no_fm', $no_faktur)
                      ->update('tb_brg_masuk');

              echo json_encode(['success' => true, 'message' => 'Data berhasil diperbarui']);
          } else {
              echo json_encode(['success' => false, 'message' => 'Gagal memperbarui data']);
          }
      } else {
          // Jika no_pelunasan belum ada, lakukan insert
          if ($this->db->insert('tb_pelunasan', $data)) {
              $status_pem = ($bayar == 0) ? 3 : (($bayar == $tagihan) ? 2 : 1);

              $this->db->set('status_pem', $status_pem)
                      ->where('no_fm', $no_faktur)
                      ->update('tb_brg_masuk');

              echo json_encode(['success' => true, 'message' => 'Data berhasil disimpan']);
          } else {
              echo json_encode(['success' => false, 'message' => 'Gagal menyimpan data']);
          }
      }
  }

  public function posting()
  {
      // Ambil data dari form
      $no_pelunasan = $this->input->post('no_pelunasan');
      $no_faktur = $this->input->post('no_faktur');
      $tanggal = $this->input->post('tanggal');
      $nama_supplier = $this->input->post('nama_supplier');
      $metode = $this->input->post('metode');
      $norek = $this->input->post('norek');

      // Format angka ke integer untuk tagihan & bayar
      $tagihan = str_replace(',', '', $this->input->post('tagihan'));
      $bayar = str_replace(',', '', $this->input->post('bayar'));

      // Validasi: Bayar tidak boleh lebih besar dari Tagihan
      if ($bayar > $tagihan) {
          echo json_encode(['success' => false, 'message' => 'Jumlah Bayar tidak boleh lebih dari Nilai Tagihan!']);
          return;
      }

      // Data yang akan disimpan
      $data = [
          'id_pelunasan' => $no_pelunasan,
          'no_faktur' => $no_faktur,
          'tanggal' => $tanggal,
          'nama_supplier' => $nama_supplier,
          'metode' => $metode,
          'no_rekening' => $norek,
          'total_tagihan' => $tagihan,
          'jumlah' => $bayar,
          'ispost' => '1',
          'jenis_transaksi' => 'Pembelian',
          'id_user' => $this->session->userdata('id_user'),
          'created_on' => date('Y-m-d H:i:s')
      ];

    // Cek apakah no_pelunasan sudah ada di database
        $existing = $this->db->get_where('tb_pelunasan', ['id_pelunasan' => $data['id_pelunasan'],])->row();

        if ($existing) {
            // Jika no_pelunasan sudah ada, lakukan update
            $this->db->where('id_pelunasan', $data['id_pelunasan']);
            $update = $this->db->update('tb_pelunasan', $data);
            
            if ($update) {
                $status_pem = ($bayar == 0) ? 3 : (($bayar == $tagihan) ? 2 : 1);

                $this->db->set('status_pem', $status_pem)
                        ->where('no_fm', $no_faktur)
                        ->update('tb_brg_masuk');

                echo json_encode(['success' => true, 'message' => 'Data berhasil diperbarui']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Gagal memperbarui data']);
            }
        } else {
            $insert = $this->db->insert('tb_pelunasan', $data);
            // Jika no_pelunasan belum ada, lakukan insert
            if ($insert) {
                $status_pem = ($bayar == 0) ? 3 : (($bayar == $tagihan) ? 2 : 1);

                $this->db->set('status_pem', $status_pem)
                        ->where('no_fm', $no_faktur)
                        ->update('tb_brg_masuk');

                echo json_encode(['success' => true, 'message' => 'Data berhasil disimpan']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Gagal menyimpan data']);
            }
        }

  }

  public function unpostData() {
    $id = $this->input->post('id');
    $keterangan = $this->input->post('keterangan');

    // Update data
    $updateData = [
        'ispost' => '0', // Misal update status ke 1 (terposting)
        'keterangan' => $keterangan,
        'updated_at' => date('Y-m-d H:i:s')
    ];

    $this->db->where('id_pelunasan', $id);
    $update = $this->db->update('tb_pelunasan', $updateData);

    if ($update) {
        echo json_encode(['success' => true, 'message' => 'Data berhasil diperbarui']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Gagal memperbarui data']);
    }
}


  public function input_pelunasan() {
    $data['id'] = $this->generateid();
    $cab = $this->session->userdata('id_toko');
    $data['barangcabang'] = $this->second->barangCabang($cab);
    $data['setcabang'] = $this->first->getCabang();
    $data['css'] = '
    <link rel="stylesheet" type="text/css" href="' . base_url('assets/css/vendors/datatables.css') . '">
    <link rel="stylesheet" type="text/css" href="' . base_url('assets/css/vendors/select2.css') . '">
    <link rel="stylesheet" type="text/css" href="'.base_url('assets/css/vendors/sweetalert2.css').'">
    <style>
        .select2-selection__rendered {
            line-height: 35px !important;
        }
        .select2-container .select2-selection--single {
            height: 38px !important;
            padding: 2px !important;
        }
        .select2-dropdown--below {
          margin-top:-2% !important;
        }
        .select2-selection__arrow {
            height: 37px !important;
        }
        .select2-container{
          margin-bottom :-6%;
        }
        table.dataTable input,
        table.dataTable select {
          border: 1px solid #efefef;
          height: 24px !important;
        }
    </style>
    ';
    $data['js'] = '
    <script>var base_url = "' . base_url() . '";</script>
    <script src="' . base_url('assets/js/sweet-alert/sweetalert.min.js').'"></script>
    <script src="' . base_url('assets/js/select2/select2.full.min.js') . '"></script>
    <script src="' . base_url('assets/js/additional-js/pelunasan.js?v='.time().'') . '"></script>
    <script src="' . base_url('assets/js/additional-js/id.js') . '"></script>
    <script src="' . base_url('assets/js/modalpage/validation-modal.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatables/jquery.dataTables.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/dataTables.buttons.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/jszip.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/buttons.colVis.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/vfs_fonts.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/dataTables.autoFill.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/dataTables.select.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/buttons.bootstrap4.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/buttons.html5.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/dataTables.bootstrap4.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/dataTables.responsive.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/responsive.bootstrap4.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/dataTables.keyTable.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/dataTables.colReorder.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/dataTables.fixedHeader.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/dataTables.scroller.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/custom.js') . '"></script>
    ';
    $this->load->view('layout/header', $data);
    $this->load->view('transaksi/pelunasan-input', $data);
    $this->load->view('layout/footer', $data);
  }

  public function edit_pelunasan($id) {
    $data['pelunasan'] = $this->Pelunasan_model->getLunas($id);
    $cab = $this->session->userdata('id_toko');
    $data['barangcabang'] = $this->DashboarCab_model->barangCabang($cab);
    $data['setcabang'] = $this->BarangKeluar_model->getCabang();
    $data['css'] = '
    <link rel="stylesheet" type="text/css" href="' . base_url('assets/css/vendors/datatables.css') . '">
    <link rel="stylesheet" type="text/css" href="' . base_url('assets/css/vendors/select2.css') . '">
    <link rel="stylesheet" type="text/css" href="'.base_url('assets/css/vendors/sweetalert2.css').'">
    <style>
        .select2-selection__rendered {
            line-height: 35px !important;
        }
        .select2-container .select2-selection--single {
            height: 38px !important;
            padding: 2px !important;
        }
        .select2-dropdown--below {
          margin-top:-2% !important;
        }
        .select2-selection__arrow {
            height: 37px !important;
        }
        .select2-container{
          margin-bottom :-6%;
        }
        table.dataTable input,
        table.dataTable select {
          border: 1px solid #efefef;
          height: 24px !important;
        }
    </style>
    ';
    $data['js'] = '
    <script>var base_url = "' . base_url() . '";</script>
    <script src="' . base_url('assets/js/sweet-alert/sweetalert.min.js').'"></script>
    <script src="' . base_url('assets/js/select2/select2.full.min.js') . '"></script>
    <script src="' . base_url('assets/js/additional-js/pelunasan.js?v='.time().'') . '"></script>
    <script src="' . base_url('assets/js/additional-js/id.js') . '"></script>
    <script src="' . base_url('assets/js/modalpage/validation-modal.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatables/jquery.dataTables.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/dataTables.buttons.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/jszip.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/buttons.colVis.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/vfs_fonts.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/dataTables.autoFill.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/dataTables.select.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/buttons.bootstrap4.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/buttons.html5.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/dataTables.bootstrap4.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/dataTables.responsive.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/responsive.bootstrap4.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/dataTables.keyTable.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/dataTables.colReorder.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/dataTables.fixedHeader.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/dataTables.scroller.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/custom.js') . '"></script>
    ';
    $this->load->view('layout/header', $data);
    $this->load->view('transaksi/pelunasan-edit', $data);
    $this->load->view('layout/footer', $data);
  }

  public function updateStatus() {
    $id = $this->input->post('id');

    if (!$id) {
        echo json_encode(['status' => 'error', 'message' => 'ID tidak ditemukan']);
        return;
    }

    $this->db->where('id_pelunasan', $id);
    $update = $this->db->update('tb_pelunasan', ['ispost' => '1']);

    if ($update) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Gagal mengupdate status']);
    }
  }

  // 🔹 Update Bayar (Edit Modal)
  public function updateBayar() {
      $id = $this->input->post('id');
      $bayar = $this->input->post('bayar');

      if (!$id || !$bayar) {
          echo json_encode(['status' => 'error', 'message' => 'Data tidak lengkap']);
          return;
      }

      $this->db->where('id_pelunasan', $id);
      $update = $this->db->update('tb_pelunasan', ['jumlah' => $bayar]);

      if ($update) {
          echo json_encode(['status' => 'success']);
      } else {
          echo json_encode(['status' => 'error', 'message' => 'Gagal mengupdate bayar']);
      }
  }

  // 🔹 Delete Data Pelunasan
  public function deleteData() {
      $id = $this->input->post('id');

      if (!$id) {
          echo json_encode(['status' => 'error', 'message' => 'ID tidak ditemukan']);
          return;
      }

      $this->db->where('id_pelunasan', $id);
      $delete = $this->db->delete('tb_pelunasan');

      if ($delete) {
          echo json_encode(['status' => 'success']);
      } else {
          echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus data']);
      }
  }

  public function loadproduk(){
    $this->load->library('datatables');
    $no_faktur = $this->input->post('no_faktur'); 
    $this->datatables->select('id_masuk,sn_brg,nama_brg ,merk ,jenis ,no_imei ,kondisi, status');
    $this->datatables->from('vbarangmasuk');
    $this->datatables->where('no_fm', $no_faktur);
    $this->datatables->where('status_pen', 0);
    return print_r($this->datatables->generate());
  }
  public function filtersupp($cab=null,$cabr=null, $tipe=null){
    $this->load->library('datatables');
    $this->datatables->select('id_keluar,sn_brg,nama_brg,jenis,id_supplier,nama_supplier,nama_toko,
    hrg_hpp,hrg_jual,margin,hrg_cashback,status');
    $this->datatables->from('vbarangkeluar');
    $this->datatables->where('status','2');
    $this->datatables->where('nama_supplier',$cab);
    $this->datatables->where('nama_toko',$cabr);
    $this->datatables->where('jenis',$tipe);
    return print_r($this->datatables->generate());    
  }
  public function infoBrg($id){
    $data['get_id']= $this->PenEtalase_model->getWhere($id);
    echo json_encode($data);
  }  
  public function pelunasan_list(){
    $this->load->library('datatables');
    $this->datatables->select('*');
    $this->datatables->from('vpelunasan');
    $this->datatables->where('jenis_transaksi','Pembelian');
    return print_r($this->datatables->generate());
  }
  public function terima_data() {
    if ($this->input->is_ajax_request()) {
        $json_data = $this->input->raw_input_stream;
        $checkedData = json_decode($json_data, true);
        if (!empty($checkedData)) {
            foreach ($checkedData as $data) {
                $idm = $data['idm'];
                $data = [
                  'status_pen' => 1, 
                  'status' => 1, 
                  'tgl_pelunasan' => date('Y-m-d H:i:s'), 
                  'id_user' => $this->session->userdata('id_user')
                ];
        
                $this->db->where('id_masuk', $idm);
                $this->db->update('tb_brg_masuk', $data);
            }
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No data received']);
        }
    } else {
        redirect('transaksi/pelunasan');
    }
  }

  public function detail_pelunasan($no_fm) {
    $this->load->library('datatables');
    $this->datatables->select('*');
    $this->datatables->from('vpelunasan_list');
    $this->datatables->where('no_fm',$no_fm);
    return print_r($this->datatables->generate());
  }   
}
