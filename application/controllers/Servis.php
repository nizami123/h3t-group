<?php
defined('BASEPATH') or exit('No direct script access allowed');
include_once(APPPATH . 'controllers/Auth.php');
class Servis extends Auth
{
    
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Mkustomer_model');
  }

  public function index()
  {
    $cab = $this->session->userdata('id_toko');
    $data['barangcabang'] = $this->second->barangCabang($cab);
    $data['setcabang'] = $this->first->getCabang();
    $data['content'] = $this->load->view('servis/servis', '', true);
    $data['modal'] = '';
    $data['css'] = '<link rel="stylesheet" type="text/css" href="'.base_url('assets/css/vendors/datatables.css').'">
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
    </style>';
    $data['js'] = '<script>var base_url = "' . base_url() . '";
		const userRole = "'.$this->session->userdata('role_user').'";</script>
    <script src="' . base_url('assets/js/additional-js/servis.js?v='.time().'') . '"></script>
    <script src="' . base_url('assets/js/select2/select2.full.min.js') . '"></script>
    <script src="' . base_url('assets/js/modalpage/validation-modal.js') . '"></script>
    <script src="' . base_url('assets/js/sweet-alert/sweetalert.min.js').'"></script>
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
    <!-- DAYJS & TIMEZONE -->
    <script src="https://cdn.jsdelivr.net/npm/dayjs@1/dayjs.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/dayjs@1/plugin/utc.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/dayjs@1/plugin/timezone.js"></script>
    <script>
      dayjs.extend(dayjs_plugin_utc);
      dayjs.extend(dayjs_plugin_timezone);
    </script>
    ';
    $this->load->view('layout/base', $data);
  }
  // NEWSERVIS
  private function generateid() {
    $data['lastID'] = $this->Mkustomer_model->getLastID();
    if (!empty($data['lastID'])) {
        preg_match('/(\d+)$/', $data['lastID'][0]['id_plg'], $matches);
        $numericPart = isset($matches[1]) ? $matches[1] : '0000';
        $incrementedNumericPart = sprintf('%04d', intval($numericPart) + 1);
        $data['newID'] = 'H3TCUS-' . $incrementedNumericPart;
    } else {
        $data['newID'] = 'H3TCUS-0001';
    }
    return $data;
  }

  public function saveFormServis() {
    if ($this->input->is_ajax_request()) {

        // Get JSON input
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        if (empty($data)) {
            echo json_encode(['status' => 'error', 'message' => 'Data tidak valid.']);
            return;
        }

        // --- Generate new pelanggan ID ---
        $idData = $this->generateid();
        $id_plg = $idData['newID'];

        // --- Insert pelanggan (nama_cst & no_telp) ---
        $insert_pelanggan = [
            'id_plg'     => $id_plg,
            'nama_plg'   => trim($data['nama_cst']),
            'no_ponsel'    => trim($data['no_telp']),
            'alamat'   => trim($data['alamat_cst'])
        ];
        $this->db->insert('tb_pelanggan', $insert_pelanggan);

        // --- Insert data ke tb_servis ---
        $servis_data = [
            'tgl_servis'   => $data['tgl_servis'],
            'id_plg'       => $id_plg,
            'id_cabang'      => $data['scabang'],
            'pic_penerima' => $data['pic_penerima'],
            'data_servis'  => json_encode($data['items']), // store items as JSON
            'status' => 'Belum Proses',
            'created_at'   => date('Y-m-d H:i:s'),
            'id_user_create'      => $this->session->userdata('id_user')
        ];

        $insert = $this->db->insert('tb_servis', $servis_data);

        if ($insert) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan data servis.']);
        }

    } else {
        show_404();
    }
  }
  
  public function updateServis($id){
      if ($this->input->is_ajax_request()) {

          // Get JSON input
          $json = file_get_contents('php://input');
          $data = json_decode($json, true);

          if (empty($data) || !isset($data['id'])) {
              echo json_encode(['status' => 'error', 'message' => 'Data tidak valid.']);
              return;
          }

          $plg_data = [
              'nama_plg'   => trim($data['nama_cst']),
              'no_ponsel'    => trim($data['no_telp']),
              'alamat'   => trim($data['alamat_cst'])
          ];
          // Update tb_pelanggan
          $this->db->where('id_plg', $data['id_plg']);
          $this->db->update('tb_pelanggan', $plg_data);

          // --- Data to update only from tb_servis ---
          $servis_data = [
              'tgl_servis'   => $data['tgl_servis'],
              'id_cabang'    => $data['scabang'],
              'pic_penerima' => $data['pic_penerima'],
              'data_servis'  => json_encode($data['items']),
          ];

          // Update tb_servis
          $this->db->where('id', $data['id']);
          $update = $this->db->update('tb_servis', $servis_data);

          if ($update) {
              echo json_encode(['status' => 'success', 'message' => 'Data servis berhasil diperbarui.']);
          } else {
              echo json_encode(['status' => 'error', 'message' => 'Gagal memperbarui data servis.']);
          }

      } else {
          show_404();
      }
  }

  public function deleteServis($id) {
    if ($this->input->is_ajax_request()) {
        // Hapus data dari tb_servis berdasarkan ID
        $this->db->where('id', $id);
        $delete = $this->db->delete('tb_servis');

        if ($delete) {
            echo json_encode(['status' => 'success', 'message' => 'Data servis berhasil dihapus.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus data servis.']);
        }
    } else {
        show_404();
    }
  }

  public function cancelServis($id){
      if (!$this->input->is_ajax_request()) {
          show_404();
          return;
      }

      $cu = $this->input->post('cu');
      $ct = $this->input->post('ct');
      $keterangan = $this->input->post('keterangan_cancel');

      $status = $cu=='true' ? 'Cancel User' : ($ct ? 'Cancel Teknisi' : null);

      if (!$status) {
          echo json_encode(['status' => 'error', 'message' => 'Parameter tidak valid.']);
          return;
      }

      $this->db->where('id', $id);
      $update = $this->db->update('tb_servis', [
          'status' => $status,
          'keterangan_cancel' => $keterangan
      ]);

      if ($update) {
          echo json_encode(['status' => 'success', 'message' => 'Data servis berhasil dibatalkan.']);
      } else {
          echo json_encode(['status' => 'error', 'message' => 'Gagal membatalkan data servis.']);
      }
  }

  public function prosesChecker($id) {
    if ($this->input->is_ajax_request()) {

        // Get JSON input
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        if (empty($data)) {
            echo json_encode(['status' => 'error', 'message' => 'Data tidak valid.']);
            return;
        }

        $tgl_checker = $data['tgl_checker'];
        $pic_checker = $data['pic_checker'];
        $items_checker = $data['items_checker'];
        $id_user = $this->session->userdata('id_user');
        $created_at = date('Y-m-d H:i:s');
        
        $payload = [
            'id_servis' => $id,
            'tgl_checker' => $tgl_checker,
            'pic_checker' => $pic_checker,
            'data_checker' => $items_checker,
            'id_user_create' => $id_user,
            'created_at' => $created_at
        ];

        $json_payload = json_encode($payload, JSON_UNESCAPED_UNICODE);

        $servis_data = [
            'status'        => 'Pengecekan',
            'data_checker'  => $json_payload
        ];

        $this->db->where('id', $id);
        $update = $this->db->update('tb_servis', $servis_data);

        if ($update) {
            echo json_encode(['status' => 'success','message' => 'Data servis berhasil dicek.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal memperbarui data servis.']);
        }

    } else {
        show_404();
    }
  }

  public function tableservis(){
    $this->load->library('datatables');
    $this->datatables->select('
        id,
        servis_id,
        data_servis,
        barang,
        id_pelanggan,
        nama_pelanggan,
        alamat,
        no_ponsel,
        tgl_servis,
        user_created,
        pic_penerima,
        id_cabang,
        toko_penerima,
        keterangan_cancel,
        data_checker,
        status
    ');
    $this->datatables->from('vlist_servis');
    return print_r($this->datatables->generate());
  }
  // NEWSERVIS
  public function tabledetailservis($id){
    $this->load->library('datatables');
    $this->datatables->select('id_masuk,sn_item,item,merk, jenis, keterangan, tgl_servis,nominal_teknisi,nama_lengkap');
    $this->datatables->from('vdetailservice');
    $this->datatables->where('id_masuk', $id);
    return print_r($this->datatables->generate());
  }
  public function getItemServis() {
    $searchTerm = $this->input->get('searchTerm');

    // Build query: search by SN or item name
    $this->db->select('id_masuk, sn_brg, nama_brg, merk,jenis');
    $this->db->from('vbarangready');
    if (!empty($searchTerm)) {
        $this->db->like('sn_brg', $searchTerm);
        $this->db->or_like('nama_brg', $searchTerm);
    }
    $this->db->where('tipe', 'Accesoris'); // Only items with status 1
    $query = $this->db->get();

    echo json_encode($query->result());
  }
  public function getTeknisiServis() {
    $searchTerm = $this->input->get('searchTerm');

    // Build query: search by SN or item name
    $this->db->select('id_user, nama_lengkap, role_user, jabatan');
    $this->db->from('tb_user');
    if (!empty($searchTerm)) {
        $this->db->like('nama_lengkap', $searchTerm);
    }
    $this->db->where('role_user', 'TEKNISI');
    $this->db->where('jabatan', 'TEKNISI');
    $query = $this->db->get();

    echo json_encode($query->result());
  }
  public function addDetailServis(){
    if ($this->input->is_ajax_request()) {
       $postData = $this->input->post();
       
      $sn_brg = $this->input->post('sn_brg');
      $items = $this->input->post('items'); // JSON
      $keterangan = $this->input->post('keterangan');
      $id_user = $this->session->userdata('id_user');
			$tgl_servis = $this->input->post('tgl_servis');
			$teknisi = $this->input->post('sel_mekanik');
      $nominal = str_replace('.', '', $this->input->post('nominal'));

     

      // Pastikan tidak null
      $decodedItems = json_decode($items, true);
      if (!is_array($decodedItems)) {
          echo json_encode(['status' => 'error', 'message' => 'Invalid items format']);
          return;
      }

      $list_tumbal = implode(',', array_column($decodedItems, 'id'));

      if (!$sn_brg || !$list_tumbal) {
          echo json_encode(['status' => 'error', 'message' => 'Missing required data']);
          return;
      }
      // Jalankan stored procedure
      $sql = "CALL proses_service_baru(?, ?, ?, ?, ?, ?, ?)";
      $this->db->query($sql, array($sn_brg, $list_tumbal, $keterangan, $id_user, $tgl_servis, $teknisi, $nominal));

      // Cek apakah prosedur berhasil (jika pakai RETURN bisa dikembangkan)
       echo json_encode(['status' => 'success', 'message' => 'Service process completed']);
    }else{
      show_404();
    }
  }
  public function approveData(){
    if ($this->input->is_ajax_request()) {
      $id = $this->input->post('id');
      $this->db->where('id_masuk', $id);
      $this->db->update('tb_pengecekan', ['status_cek' => '1']);
      echo json_encode(['status' => 'success', 'message' => 'Service approved successfully']);
    }else{
      show_404();
    }
  }


}


/* End of file Servis.php */
/* Location: ./application/controllers/Servis.php */