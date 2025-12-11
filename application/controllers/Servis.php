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
    <link rel="stylesheet" type="text/css" href="' . base_url('assets/css/vendors/feather-icon.css') . '">
    <link rel="stylesheet" type="text/css" href="'.base_url('assets/css/vendors/flatpickr/flatpickr.min.css').'">
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
        /*******************************
         TABLE CELL SPACING
        *******************************/
        .table-formcustom tbody td {
            padding: .0rem .0rem !important;
        }
        .table-formcustom thead th {
            padding: .35rem .5rem !important;
        }
        /*******************************
         VERTICAL ALIGN
        *******************************/
        .table-formcustom td {
            vertical-align: middle !important;
            padding-top: 8px !important;
            padding-bottom: 8px !important;
        }
        /*******************************
         BOOTSTRAP FORM CONTROL
        *******************************/
        .table-formcustom .form-control {
            height: 38px !important;
            padding: 6px 12px !important;
            font-size: .9rem;
            box-sizing: border-box;
            margin: 0 !important;
        }
        .table-formcustom input.form-control {
            border-radius: 0 !important;
        }

        .table-formcustom input.form-control:focus {
            outline: none !important;
            box-shadow: none !important;
            border-color: #ccc !important;
        }
        .table-formcustom .tt-menu {
            max-height: 250px; /* bebas, bisa 200–300px */
            overflow-y: auto;
        }
        /* CSS untuk efek kelap-kelip */
        @keyframes blink {
            0%, 50%, 100% { opacity: 1; }
            25%, 75% { opacity: 0; }
        }
        .blink {
            animation: blink 2s infinite;
        }        
        /* 🔥 Add at the bottom of your <style> */
        #table-listservis tbody tr.shown + tr > td {
            padding: 0 !important;
            margin: 0 !important;
        }
        #table-listservis tbody tr.shown + tr > td > div {
            padding: 0 !important;
            margin: 0 !important;
        }
        #table-listservis tbody tr.shown + tr table {
            margin: 0 !important;
        }
        #table-listservis tbody tr.shown + tr .mt-3 {
            margin-top: 0 !important;
        }
        .dropdown-menu .show{
            min-width: 200px !important; /* Adjust as needed */
        }
        .dropdown-item {
            width: auto !important;
        }
        .tgl-flip + .tgl-btn {
            padding: 2px;
            transition: all 0.2s ease;
            perspective: 100px;
        }
        .tgl-flip + .tgl-btn:after, .tgl-flip + .tgl-btn:before {
            display: inline-block;
            transition: all 0.4s ease;
            width: 100%;
            text-align: center;
            position: absolute;
            line-height: 2em;
            font-weight: bold;
            color: var(--white);
            position: absolute;
            top: 0;
            left: 0;
            backface-visibility: hidden;
            border-radius: 4px;
        }
        .tgl-flip + .tgl-btn:after {
            content: attr(data-tg-on);
            background: #FFAA05;
            transform: rotateY(-180deg);
        }
        .tgl-flip + .tgl-btn:before {
            background: #FC4438;
            content: attr(data-tg-off);
        }
        .tgl-flip + .tgl-btn:active:before {
            transform: rotateY(-20deg);
        }
        .tgl-flip:checked + .tgl-btn:before {
            transform: rotateY(180deg);
        }
        .tgl-flip:checked + .tgl-btn:after {
            transform: rotateY(0);
            left: 0;
            background: #54BA4A;
        }
        .tgl-flip:checked + .tgl-btn:active:after {
            transform: rotateY(20deg);
        }
        /* Make flip switch smaller */
        .tgl-flip + .tgl-btn {
            transform: scale(0.8);   /* smaller switch */
            transform-origin: left center; /* keeps alignment */
        }
        /* Only affects the Transfer Select2 */
        .transfer-select2 + .select2-selection__rendered {
            line-height: 35px !important;
        }

        .transfer-select2 + .select2-container .select2-selection--single {
            height: 38px !important;
            padding: 2px !important;
        }

        .transfer-select2 + .select2-container {
            height: 38px !important;
        }

        .transfer-select2 + .select2-dropdown--below {
            margin-top: -4% !important;
        }

        .transfer-select2 + .select2-selection__arrow {
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
    <script src="' . base_url('assets/js/icons/feather-icon/feather.min.js') . '"></script>
    <script src="' . base_url('assets/js/icons/feather-icon/feather-icon.js') . '"></script>
    <script src="' . base_url('assets/js/typeahead/typeahead.bundle.js') . '"></script>
    <script src="' . base_url('assets/js/flat-pickr/flatpickr.js') . '"></script>
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
            'tgl_dateline' => $data['tgl_dateline'],
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
              'tgl_dateline' => $data['tgl_dateline'],
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
  public function finishServis($id){
    if ($this->input->is_ajax_request()) {

        $this->db->where('id', $id);
        $update = $this->db->update('tb_servis', [
            'status' => 'Finish'
        ]);
        if ($update) {
            echo json_encode(['status' => 'success', 'message' => 'Data servis berhasil diselesaikan.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal menyelesaikan data servis.']);
        }

    } else {
        show_404();
    }
  }
  public function refundServis($id){
    if ($this->input->is_ajax_request()) {

        $this->db->where('id', $id);
        $update = $this->db->update('tb_servis', [
            'status' => 'Refund',
            'keterangan_cancel' => 'Refund Servis',
            'id_user_refund' => $this->session->userdata('id_user'),
        ]);
        if ($update) {
            echo json_encode(['status' => 'success', 'message' => 'Data servis berhasil direfund.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal menyelesaikan data servis.']);
        }

    } else {
        show_404();
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
        $nama_user = $this->session->userdata('nama_lengkap');
        $created_at = date('Y-m-d H:i:s');
        
        $payload = [
            'id_servis' => $id,
            'tgl_checker' => $tgl_checker,
            'pic_checker' => $pic_checker,
            'data_checker' => $items_checker,
            'id_user_create' => $id_user,
            'nama_user' => $nama_user,
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
  public function prosesTeknisi($id) {
    if ($this->input->is_ajax_request()) {

        // Get JSON input
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        if (empty($data)) {
            echo json_encode(['status' => 'error', 'message' => 'Data tidak valid.']);
            return;
        }

        $tgl_teknisi = $data['tgl_teknisi'];
        $pic_teknisi = $data['pic_teknisi'];
        $items_teknisi = $data['items_teknisi'];
        $id_user = $this->session->userdata('id_user');
        $nama_user = $this->session->userdata('nama_lengkap');
        $created_at = date('Y-m-d H:i:s');
        
        $payload = [
            'id_servis' => $id,
            'tgl_teknisi' => $tgl_teknisi,
            'pic_teknisi' => $pic_teknisi,
            'data_teknisi' => $items_teknisi,
            'id_user_create' => $id_user,
            'nama_user' => $nama_user,
            'created_at' => $created_at
        ];

        $json_payload = json_encode($payload, JSON_UNESCAPED_UNICODE);

        $servis_data = [
            'status'        => 'Proses Servis',
            'data_teknisi'  => $json_payload
        ];

        $this->db->where('id', $id);
        $update = $this->db->update('tb_servis', $servis_data);

        if ($update) {
            echo json_encode(['status' => 'success','message' => 'Data servis berhasil diproses teknisi.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal memperbarui data servis.']);
        }

    } else {
        show_404();
    }
  }
  public function prosesInvoice($id) {
    if ($this->input->is_ajax_request()) {

        // Get JSON input
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        if (empty($data)) {
            echo json_encode(['status' => 'error', 'message' => 'Data tidak valid.']);
            return;
        }

        $tgl_invoice = $data['tgl_invoice'];
        $no_invoice = $data['no_invoice'];
        $tipe = $data['tipe'];
        $detail_tipe = $data['detail_tipe'];
        $tgl_diambil = $data['tgl_diambil'];
        $keterangan = $data['keterangan'];
        $total_harga = $data['total_harga'];
        $items_invoice = $data['items_invoice'];
        $id_user = $this->session->userdata('id_user');
        $nama_user = $this->session->userdata('nama_lengkap');
        $created_at = date('Y-m-d H:i:s');
        
        $payload = [
            'id_servis' => $id,
            'tgl_invoice' => $tgl_invoice,
            'no_invoice' => $no_invoice,
            'tipe' => $tipe,
            'detail_tipe' => $detail_tipe,
            'keterangan' => $keterangan,
            'total_harga' => $total_harga,
            'data_invoice' => $items_invoice,
            'id_user_create' => $id_user,
            'nama_user' => $nama_user,
            'created_at' => $created_at
        ];

        $json_payload = json_encode($payload, JSON_UNESCAPED_UNICODE);

        $servis_data = [
            'tgl_diambil'        => $tgl_diambil ?? null,
            'data_invoice'  => $json_payload
        ];

        $this->db->where('id', $id);
        $update = $this->db->update('tb_servis', $servis_data);

        if ($update) {
            echo json_encode(['status' => 'success','message' => 'Data servis berhasil diproses invoice.']);
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
        deadline,
        tgl_dateline,
        user_created,
        pic_penerima,
        id_cabang,
        toko_penerima,
        keterangan_cancel,
        data_checker,
        data_teknisi,
        data_invoice,
        tgl_diambil,
        status,
        tgl_buat_form,
        teknisi,
        tipe,
        detail_tipe
    ');
    if (!empty($this->input->post('cab')) && $this->input->post('cab') !== 'AllCab') {
      $this->datatables->where('id_cabang', $this->input->post('cab'));
    }
    if (!empty($this->input->post('tkn')) && $this->input->post('tkn') !== 'all') {
        $tkn = $this->input->post('tkn');
        $this->datatables->where(
            "JSON_SEARCH(teknisi, 'one', " . $this->db->escape($tkn) . ", NULL, '$[*]') IS NOT NULL",
            null,
            false
        );
    }
    if (!empty($this->input->post('fdts'))) {
      $dateRange = explode(' to ', $this->input->post('fdts'));
      if (count($dateRange) === 2) {
          $startDate = date('Y-m-d', strtotime($dateRange[0]));
          $endDate = date('Y-m-d', strtotime($dateRange[1]));
          $this->datatables->where("DATE(tgl_servis) BETWEEN '$startDate' AND '$endDate'");
      }
    }
    if (!empty($this->input->post('fstat')) && $this->input->post('fstat') != '0') {
        $this->datatables->where('status', $this->input->post('fstat'));
    }
    if (!empty($this->input->post('ftipe')) && $this->input->post('ftipe') != 'Semua' && $this->input->post('ftipe') != 'Pilih Tipe Pembayaran') {
        $this->datatables->where('tipe', $this->input->post('ftipe'));
    }
    if (!empty($this->input->post('fdtf'))) {
        $this->datatables->where('detail_tipe', $this->input->post('fdtf'));
    }
    if (!empty($this->input->post('fdtmp'))) {
      $dateRange = explode(' to ', $this->input->post('fdtmp'));
      if (count($dateRange) === 2) {
          $startDate = date('Y-m-d', strtotime($dateRange[0]));
          $endDate = date('Y-m-d', strtotime($dateRange[1]));
          $this->datatables->where("DATE(detail_tipe) BETWEEN '$startDate' AND '$endDate'");
      }
    }
    $this->datatables->from('vlist_servis');
    return print_r($this->datatables->generate());
  }
  public function loadteknisi() {
    $searchTerm = $this->input->get('q');
    $this->db->select('id_user, nama_lengkap, role_user, jabatan');
    $this->db->group_start()
        ->where('role_user', 'Teknisi')
        ->or_where('jabatan', 'Teknisi')
        ->group_end();

    if (!empty($searchTerm)) {
        $this->db->like('nama_lengkap', $searchTerm);
    }

    $results = $this->db->get('tb_user')->result_array();

    header('Content-Type: application/json');
    echo json_encode($results);
  }
  public function loadbank() {
    $this->db->select('id_bank, nama_bank, no_rek');
    $results = $this->db->get('tb_bank')->result_array();
    header('Content-Type: application/json');
    echo json_encode($results);
  }
  public function cetaktandaterima($id) {
    $data['items'] = $this->db->query("select * from vlist_servis where id = '".$id."'")->row();
    
    $this->load->view('print/tandaterimaservis', $data);
  }
  public function cetakinvoice($id) {
    $data['items'] = $this->db->query("select * from vlist_servis where id = '".$id."'")->row();
    
    $this->load->view('print/invoiceservis', $data);
  }
  public function datateknisi(){
    $searchTerm = $this->input->get('q');

    $this->db->select('teknisi');
    $this->db->from('vteknisi_servis');

    if ($searchTerm) {
        $this->db->like('teknisi', $searchTerm);
    }

    $query = $this->db->get();
    echo json_encode($query->result_array());
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