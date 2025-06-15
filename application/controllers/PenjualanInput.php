<?php
defined('BASEPATH') or exit('No direct script access allowed');
include_once(APPPATH . 'controllers/Auth.php');
class PenjualanInput extends Auth
{
    
  public function __construct()
  {
    parent::__construct();
    $this->load->model('InventoriStok_model');
    $this->load->library('zend');
  }

  public function loadsupp(){
    $searchTerm = $this->input->get('q');
    $results = $this->InventoriStok_model->getCus($searchTerm);
    header('Content-Type: application/json');
    echo json_encode($results);
  }

  public function loadbrg() {
    $searchTerm = $this->input->get('q');
    $results = $this->InventoriStok_model->getJual($searchTerm);
    header('Content-Type: application/json');
    echo json_encode($results);    
  }
  public function loadacc() {
    $searchTerm = $this->input->get('q');
    $results = $this->InventoriStok_model->getAcc($searchTerm);
    header('Content-Type: application/json');
    echo json_encode($results);    
  }


  public function loadbm(){
    $this->load->library('datatables');
    $this->datatables->select('*');
    $this->datatables->from('v_detailpenjualancus');
    return print_r($this->datatables->generate());    
  }
  public function gensnacc(){
    $data['lastID'] = $this->InventoriStok_model->getLastKode();
    $numericPart = isset($data['lastID'][0]['sn_brg']) ? preg_replace('/[^0-9]/', '', $data['lastID'][0]['sn_brg']) : '';
    $incrementedNumericPart = sprintf('%04d', intval($numericPart) + 1);
    $data['newID'] = 'ACC-' . $incrementedNumericPart;
    $data['defID'] = 'ACC-0001';
    $this->output->set_content_type('application/json')->set_output(json_encode($data));
  }

  public function index() {
    $cab = $this->session->userdata('id_toko');
    $data['barangcabang'] = $this->second->barangCabang($cab);
    $data['setcabang'] = $this->first->getCabang();
    $data['content'] = $this->load->view('transaksi/penjualan-input', '', true);
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
          margin-top:-2%; !important;
        }
        .select2-selection__arrow {
            height: 37px !important;
        }
        .select2-container{
          margin-bottom :-6%;
        }
    </style>
    ';
    $data['js'] = '
    <script>var base_url = "' . base_url() . '";</script>
    <script src="' . base_url('assets/js/sweet-alert/sweetalert.min.js').'"></script>
    <script src="' . base_url('assets/js/select2/select2.full.min.js') . '"></script>
    <script src="' . base_url('assets/js/additional-js/penjualan_input.js') . '"></script>
    <script src="' . base_url('assets/js/additional-js/id.js') . '"></script>
    <script src="' . base_url('assets/js/modalpage/validation-modal.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatables/jquery.dataTables.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatables/datatable.custom.js') . '"></script>
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

  public function barcode($sn) {
    $this->zend->load('Zend/Barcode');

    // Opsi untuk barcode
    $options = array(
        'text' => $sn,
        'drawText' => true,
        'factor' => 2, // Konversi eksplisit ke integer
        'dpi' => 500,
        'stretchText' => true,
    );

    // Menentukan jalur ke file font yang diunduh
    $fontPath = FCPATH . 'assets/fonts/SourceSans3-Regular.ttf'; // Sesuaikan dengan nama file font

    if (file_exists($fontPath)) {
        $options['font'] = $fontPath;
        $options['fontSize'] = 8; // Pastikan ini integer
    }

    // Opsi renderer (output)
    $rendererOptions = array(
        'imageType' => 'jpg',
    );

    // Membuat resource gambar barcode
    $imageResource = Zend_Barcode::factory('code128', 'image', $options, $rendererOptions)->draw();

    // Menentukan jalur penyimpanan gambar berdasarkan lingkungan
    if ($_SERVER['SERVER_NAME'] == 'localhost') {
        $imagePath = './assets/dhdokumen/snbarcode/';
    } else if ($_SERVER['SERVER_NAME'] == 'live.akira.id') {
        $imagePath = $_SERVER['DOCUMENT_ROOT'] . '/h3tgroup/assets/dhdokumen/snbarcode/';
    } else {
        $imagePath = $_SERVER['DOCUMENT_ROOT'] . '/assets/dhdokumen/snbarcode/';
    }

    // Nama file gambar
    $imageName = $sn . '.jpg';

    // Menyimpan gambar
    imagepng($imageResource, $imagePath . $imageName);
    imagedestroy($imageResource); // Menghancurkan resource gambar untuk membebaskan memori
  }

  public function addmb() {
    if ($this->input->is_ajax_request()) {
      $total = ($this->input->post('hjbaru') * $this->input->post('jumlah')) - $this->input->post('diskon');
      $data = [
        'id_pelanggan'      => $this->input->post('suppbaru'),
        'id_brg'      => $this->input->post('prodbaru'),
        'kode_penjualan'      => $this->input->post('nofakbaru'),
        'tanggal'      => $this->input->post('tglbaru'),
        'hrg_jual'      => $this->input->post('hjbaru'),
        'keterangan'      => $this->input->post('ket'),
        'jml'      => $this->input->post('jumlah'),
        'diskon'      => $this->input->post('diskon'),
        'tempo'      => $this->input->post('tempo'),
        'total'     => $total,
        'status'      => '0',
      ];
      $inserted = $this->db->insert('tb_penjualan_cus', $data);
      if ($inserted) {
        echo json_encode(['status' => 'success']);
      } else {
        echo json_encode(['status' => 'exists']);
      }
    } else {
      redirect('penjualan-input');
    }
  }

  public function deletepost($id) {
    // Get the 'sn_brg' value from the database
    $getsn = $this->db->select('sn_brg')->from('tb_brg_masuk')->where('id_masuk', $id)->get();
    $result = $getsn->row(); // Fetch the single row
    $sn_brg = $result->sn_brg; // Extract the 'sn_brg' value
    $deleteResult = $this->InventoriStok_model->delete($id);
    $imagePath = './assets/dhdokumen/snbarcode/';
    $fileName = $imagePath . $sn_brg . '.jpg';
    if (file_exists($fileName)) {
        unlink($fileName);
    }
    echo json_encode($deleteResult);
  }

  public function check(){
    echo $_SERVER['SERVER_NAME']; 
  }

}


/* End of file InventoriStok.php */
/* Location: ./application/controllers/InventoriStok.php */