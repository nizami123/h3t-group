<?php
defined('BASEPATH') or exit('No direct script access allowed');
include_once(APPPATH . 'controllers/Auth.php');
class LpConfig extends Auth
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('LpConfig_model');
  }

  public function index()
  {
    $cab = $this->session->userdata('id_toko');
    $data['barangcabang'] = $this->second->barangCabang($cab);
    $data['setcabang'] = $this->first->getCabang();
    $data['content'] = $this->load->view('landing-page/lpconfig', '', true);
    $data['modal'] = '';
    $data['css'] = '<link rel="stylesheet" type="text/css" href="'.base_url('assets/css/vendors/datatables.css').'">
    <link rel="stylesheet" type="text/css" href="' . base_url('assets/css/vendors/select2.css') . '">
    <link rel="stylesheet" type="text/css" href="'.base_url('assets/css/vendors/sweetalert2.css').'">
    <link rel="stylesheet" type="text/css" href="' . base_url('assets/css/vendors/feather-icon.css') . '">
    <link rel="stylesheet" type="text/css" href="'.base_url('assets/css/vendors/flatpickr/flatpickr.min.css').'">
    <link rel="stylesheet" type="text/css" href="' . base_url('assets/css/vendors/date-picker.css') . '">
    <link rel="stylesheet" type="text/css" href="' . base_url('assets/css/vendors/dropzone.css') . '">
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
    $data['js'] = '
    <script>
        var base_url = "' . base_url() . '";
		const userRole = "'.$this->session->userdata('role_user').'";
        const jabatan = "'.$this->session->userdata('jabatan').'";
    </script>
    <script src="' . base_url('assets/js/additional-js/lpconfig.js?v='.time().'') . '"></script>
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
    <script src="' . base_url('assets/js/datepicker/date-picker/datepicker.js') . '"></script>
    <script src="' . base_url('assets/js/datepicker/date-picker/datepicker.en.js') . '"></script>
    <script src="' . base_url('assets/js/datepicker/date-picker/datepicker.custom.js') . '"></script>
    <script src="' . base_url('assets/js/dropzone/dropzone.js') . '"></script>
    <script src="' . base_url('assets/js/dropzone/dropzone-script.js') . '"></script>
    <script src="' . base_url('assets/js/typeahead/handlebars.js') . '"></script>
    <script src="' . base_url('assets/js/typeahead/typeahead.bundle.js') . '"></script>
    <script src="' . base_url('assets/js/typeahead/typeahead.custom.js') . '"></script>
    <script src="' . base_url('assets/js/typeahead-search/handlebars.js') . '"></script>
    <script src="' . base_url('assets/js/typeahead-search/typeahead-custom.js') . '"></script>
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

  public function insert_banner()
  {
      // Use FCPATH to ensure absolute path from web root
      $file_path = FCPATH . 'assets/dhdokumen/banner_lp';

      // Create directory if it does not exist
      if (!is_dir($file_path)) {
          mkdir($file_path, 0777, TRUE);
      }

      $config['upload_path']   = $file_path;
      $config['allowed_types'] = 'gif|jpg|png|jpeg|webp';
      $config['max_size']      = 5120; // 5MB max
      $config['encrypt_name']  = FALSE;

      $this->load->library('upload', $config);

      if (!$this->upload->do_upload('banner_file')) {
          $error = $this->upload->display_errors('', '');
          if ($this->input->is_ajax_request()) {
              return $this->output
                  ->set_content_type('application/json')
                  ->set_output(json_encode(['status' => false, 'message' => $error]));
          } else {
              $this->session->set_flashdata('error', $error);
              redirect('LpConfig');
          }
      } else {
          $upload_data = $this->upload->data();
          $banner_name = $upload_data['file_name'];
          $banner_source = 'assets/dhdokumen/banner_lp/' . $banner_name;

          $data = [
              'banner_name'   => $this->input->post('banner_name'),
              'banner_source' => $banner_source,
              'banner_type'   => 'img'
          ];

          $insert = $this->LpConfig_model->insert_banner($data);

          if ($this->input->is_ajax_request()) {
              if ($insert) {
                  return $this->output
                      ->set_content_type('application/json')
                      ->set_output(json_encode(['status' => true, 'message' => 'Banner successfully uploaded and saved.']));
              } else {
                  return $this->output
                      ->set_content_type('application/json')
                      ->set_output(json_encode(['status' => false, 'message' => 'Failed to save to database.']));
              }
          } else {
              if ($insert) {
                  $this->session->set_flashdata('success', 'Banner successfully uploaded and saved.');
              } else {
                  $this->session->set_flashdata('error', 'Failed to save to database.');
              }
              redirect('LpConfig');
          }
      }
  }

  public function get_banners()
  {
      $banners = $this->LpConfig_model->get_banners();
      echo json_encode(['data' => $banners]);
  }

  public function delete_banner($id)
  {
      $delete = $this->LpConfig_model->delete_banner($id);
      if ($this->input->is_ajax_request()) {
          if ($delete) {
              echo json_encode(['status' => true, 'message' => 'Banner berhasil dihapus.']);
          } else {
              echo json_encode(['status' => false, 'message' => 'Gagal menghapus banner.']);
          }
      } else {
          redirect('LpConfig');
      }
  }

  public function insert_produk()
  {
      $file_path = FCPATH . 'assets/dhdokumen/produk_lp';
        
      if (!is_dir($file_path)) {
          mkdir($file_path, 0777, TRUE);
      }

      $config['upload_path']   = $file_path;
      $config['allowed_types'] = 'gif|jpg|png|jpeg|webp';
      $config['max_size']      = 5120; // 5MB max
      $config['encrypt_name']  = TRUE;

      $this->load->library('upload', $config);

      if (!$this->upload->do_upload('produk_file')) {
          $error = $this->upload->display_errors('', '');
          if ($this->input->is_ajax_request()) {
              return $this->output
                  ->set_content_type('application/json')
                  ->set_output(json_encode(['status' => false, 'message' => $error]));
          } else {
              $this->session->set_flashdata('error', $error);
              redirect('LpConfig');
          }
      } else {
          $upload_data = $this->upload->data();
          $file_name = $upload_data['file_name'];
          $produk_img = 'assets/dhdokumen/produk_lp/' . $file_name;

          $data = [
              'produk_name'   => $this->input->post('produk_name'),
              'produk_price'  => $this->input->post('produk_price'),
              'produk_desc'   => $this->input->post('produk_desc'),
              'wa_desc'       => $this->input->post('wa_desc'),
              'produk_img'    => $produk_img,
              'is_active'     => 'yes'
          ];

          $insert = $this->LpConfig_model->insert_produk($data);

          if ($this->input->is_ajax_request()) {
              if ($insert) {
                  return $this->output
                      ->set_content_type('application/json')
                      ->set_output(json_encode(['status' => true, 'message' => 'Produk berhasil ditambahkan.']));
              } else {
                  return $this->output
                      ->set_content_type('application/json')
                      ->set_output(json_encode(['status' => false, 'message' => 'Gagal menyimpan ke database.']));
              }
          } else {
              if ($insert) {
                  $this->session->set_flashdata('success', 'Produk berhasil ditambahkan.');
              } else {
                  $this->session->set_flashdata('error', 'Gagal menyimpan ke database.');
              }
              redirect('LpConfig');
          }
      }
  }

  public function get_produk()
  {
      $produk = $this->LpConfig_model->get_produk();
      echo json_encode(['data' => $produk]);
  }

  public function get_produk_by_id($id)
  {
      $produk = $this->LpConfig_model->get_produk_by_id($id);
      if ($produk) {
          echo json_encode(['status' => true, 'data' => $produk]);
      } else {
          echo json_encode(['status' => false, 'message' => 'Produk tidak ditemukan.']);
      }
  }

  public function update_produk()
  {
      $id = $this->input->post('produk_id');
      $existing = $this->LpConfig_model->get_produk_by_id($id);

      if (!$existing) {
          return $this->output
              ->set_content_type('application/json')
              ->set_output(json_encode(['status' => false, 'message' => 'Produk tidak ditemukan.']));
      }

      $data = [
          'produk_name'   => $this->input->post('produk_name'),
          'produk_price'  => $this->input->post('produk_price'),
          'produk_desc'   => $this->input->post('produk_desc'),
          'wa_desc'       => $this->input->post('wa_desc')
      ];

      // Check if new image is uploaded
      if (!empty($_FILES['produk_file']['name'])) {
          $file_path = FCPATH . 'assets/dhdokumen/produk_lp';
          if (!is_dir($file_path)) {
              mkdir($file_path, 0777, TRUE);
          }

          $config['upload_path']   = $file_path;
          $config['allowed_types'] = 'gif|jpg|png|jpeg|webp';
          $config['max_size']      = 5120; // 5MB max
          $config['encrypt_name']  = TRUE;

          $this->load->library('upload', $config);

          if (!$this->upload->do_upload('produk_file')) {
              $error = $this->upload->display_errors('', '');
              return $this->output
                  ->set_content_type('application/json')
                  ->set_output(json_encode(['status' => false, 'message' => $error]));
          } else {
              $upload_data = $this->upload->data();
              $file_name = $upload_data['file_name'];
              $data['produk_img'] = 'assets/dhdokumen/produk_lp/' . $file_name;

              // Unlink previous image
              if (!empty($existing->produk_img)) {
                  $old_file = FCPATH . $existing->produk_img;
                  if (file_exists($old_file)) {
                      @unlink($old_file);
                  }
              }
          }
      }

      $update = $this->LpConfig_model->update_produk($id, $data);

      if ($this->input->is_ajax_request()) {
          if ($update) {
              return $this->output
                  ->set_content_type('application/json')
                  ->set_output(json_encode(['status' => true, 'message' => 'Produk berhasil diperbarui.']));
          } else {
              return $this->output
                  ->set_content_type('application/json')
                  ->set_output(json_encode(['status' => false, 'message' => 'Gagal memperbarui data.']));
          }
      } else {
          if ($update) {
              $this->session->set_flashdata('success', 'Produk berhasil diperbarui.');
          } else {
              $this->session->set_flashdata('error', 'Gagal memperbarui data.');
          }
          redirect('LpConfig');
      }
  }

  public function delete_produk($id)
  {
      $delete = $this->LpConfig_model->delete_produk($id);
      if ($this->input->is_ajax_request()) {
          if ($delete) {
              echo json_encode(['status' => true, 'message' => 'Produk berhasil dihapus.']);
          } else {
              echo json_encode(['status' => false, 'message' => 'Gagal menghapus produk.']);
          }
      } else {
          redirect('LpConfig');
      }
  }

  public function insert_config()
  {
      $cname = $this->input->post('cname');
      $cdetail = $this->input->post('cdetail');

      if (empty($cname) || empty($cdetail)) {
          return $this->output
              ->set_content_type('application/json')
              ->set_output(json_encode(['status' => false, 'message' => 'Nama Config dan Detail Config harus diisi.']));
      }

      $data = [
          'cname'     => $cname,
          'cdetail'   => $cdetail,
          'is_active' => 'yes'
      ];

      $insert = $this->LpConfig_model->insert_config($data);

      if ($this->input->is_ajax_request()) {
          if ($insert) {
              return $this->output
                  ->set_content_type('application/json')
                  ->set_output(json_encode(['status' => true, 'message' => 'Konfigurasi berhasil ditambahkan.']));
          } else {
              return $this->output
                  ->set_content_type('application/json')
                  ->set_output(json_encode(['status' => false, 'message' => 'Gagal menyimpan konfigurasi.']));
          }
      } else {
          redirect('LpConfig');
      }
  }

  public function get_configs()
  {
      $configs = $this->LpConfig_model->get_configs();
      echo json_encode(['data' => $configs]);
  }

  public function delete_config($id)
  {
      $delete = $this->LpConfig_model->delete_config($id);
      if ($this->input->is_ajax_request()) {
          if ($delete) {
              echo json_encode(['status' => true, 'message' => 'Konfigurasi berhasil dihapus.']);
          } else {
              echo json_encode(['status' => false, 'message' => 'Gagal menghapus konfigurasi.']);
          }
      } else {
          redirect('LpConfig');
      }
  }

}

/* End of file LpConfig.php */
/* Location: ./application/controllers/LpConfig.php */
