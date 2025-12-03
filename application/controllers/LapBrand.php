<?php
defined('BASEPATH') or exit('No direct script access allowed');
include_once(APPPATH . 'controllers/Auth.php');
class LapBrand extends Auth
{
    
  public function __construct()
  {
    parent::__construct();
  }

  public function index(){
    $cab = $this->session->userdata('id_toko');
    $data['barangcabang'] = $this->second->barangCabang($cab);
    $data['setcabang'] = $this->first->getCabang();
    $data['content'] = $this->load->view('kasir/laporanbrand', '', true);
    $data['modal'] = '';
    $data['css'] = '<link rel="stylesheet" type="text/css" href="'.base_url('assets/css/vendors/datatables.css').'">
    <link rel="stylesheet" type="text/css" href="' . base_url('assets/css/vendors/select2.css') . '">
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
        .select2-container{
          margin-bottom :-6%;
        }
    </style>';
    $data['js'] = '<script>var base_url = "' . base_url() . '";</script>
    <script src="' . base_url('assets/js/additional-js/lbrand.js?v='.time().'') . '"></script>
    <script src="' . base_url('assets/js/select2/select2.full.min.js') . '"></script>
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
    <script src="' . base_url('assets/js/flat-pickr/flatpickr.js') . '"></script>
    ';
    $this->load->view('layout/base', $data);
  }
  public function laporanlist(){
    $this->load->library('datatables');
    $jns = $this->input->post('jns'); 
    $kond = $this->input->post('kond'); 
    $cab = $this->input->post('cab');
    $this->datatables->select('
      category_summary,
      sales_id,
      sales_name,
      outlet_name,
      supervisor_name,
      outlet_code,
      invoice_number,
      invoice_date,
      invoice_year,
      invoice_month,
      payment_method,
      tanggal_input,
      serial_number,
      brand,
      imei,
      product_name,
      product_category,
      cost_price,
      cogs,
      final_price,
      kondisi
    ');
    $this->datatables->from('vlaporanbrand');
    if (!empty($jns) && $jns !== 'all') {
      $this->datatables->where('product_category', $jns);
    }
    if (!empty($kond) && $kond !== 'all') {
      $this->datatables->where('kondisi', $kond);
    }
    if (!empty($cab) && $cab !== 'AllCab') {
      $this->datatables->where('outlet_code', $cab);
    }
    if (!empty($this->input->post('fdinv'))) {
      $dateRange = explode(' to ', $this->input->post('fdinv'));
      if (count($dateRange) === 2) {
          $startDate = date('Y-m-d', strtotime($dateRange[0]));
          $endDate = date('Y-m-d', strtotime($dateRange[1]));
          $this->datatables->where("DATE(invoice_date) BETWEEN '$startDate' AND '$endDate'");
      }
    }
    if (!empty($this->input->post('fdipt'))) {
      $dateRange = explode(' to ', $this->input->post('fdipt'));
      if (count($dateRange) === 2) {
          $startDate = date('Y-m-d', strtotime($dateRange[0]));
          $endDate = date('Y-m-d', strtotime($dateRange[1]));
          $this->datatables->where("DATE(tanggal_input) BETWEEN '$startDate' AND '$endDate'");
      }
    }
    if (!empty($this->input->post('catsum')) && $this->input->post('catsum') != '0') {
        $this->datatables->where('category_summary', $this->input->post('catsum'));
    }
    return print_r($this->datatables->generate());
  }

}


/* End of file LapBrand.php */
/* Location: ./application/controllers/LapBrand.php */