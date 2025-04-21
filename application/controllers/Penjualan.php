<?php
defined('BASEPATH') or exit('No direct script access allowed');
include_once(APPPATH . 'controllers/Auth.php');
class Penjualan extends Auth
{
    
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Penjualan_model');
    $this->load->library('zend');
  }

  public function index(){
    $cab = $this->session->userdata('id_toko');
    $data['barangcabang'] = $this->second->barangCabang($cab);
    $data['setcabang'] = $this->first->getCabang();
    $data['modal'] = '';
    $data['css'] = '<link rel="stylesheet" type="text/css" href="'.base_url('assets/css/vendors/datatables.css').'">
    <link rel="stylesheet" type="text/css" href="'.base_url('assets/css/vendors/sweetalert2.css').'">';
    $data['js'] = '<script>var base_url = "' . base_url() . '";</script>
    <script src="' . base_url('assets/js/additional-js/penjualan.js?v=1.1') . '"></script>
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
    ';
    $this->load->view('layout/header', $data);      
    $this->load->view('transaksi/penjualan', $data);      
    $this->load->view('layout/footer', $data);      
  }
  public function laporanpenjualan(){
    $this->load->library('datatables');
    $this->datatables->select('*');
    $this->datatables->from('v_penjualancus');
    return print_r($this->datatables->generate());
  }

  public function formatnota($id) {
    $data['header'] = $this->db->query('select * from v_penjualancus where kode_penjualan = '.$id)->row();
    $data['items'] = $this->db->query('select * from v_detailpenjualancus where kode_penjualan = '.$id)->result_array();
    
    $this->load->view('print/nota', $data);
  }

  public function detaillapjual() {
    $inv = $this->input->post('invid');
    $this->load->library('datatables');
    $this->datatables->select('kode_penjualan,sn_brg,nama_brg, hrg_hpp,
    harga_jual, harga_diskon ,harga_cashback,harga_bayar,COALESCE((harga_bayar - hrg_hpp),0) as laba_unit');
    $this->datatables->from('vpenjualan');
    $this->datatables->where_in('status',[1,2,3,9]);
    $this->datatables->where('kode_penjualan',$inv);
    return print_r($this->datatables->generate());
  }
  public function laporansales() {
    $this->load->library('datatables');
    $this->datatables->select('id_ksr, nama_ksr, CONCAT(id_ksr, " | ", nama_ksr) AS sales, total_penjualan, subtotal, total_diskon,total_jasa,total_harga_jual,total_harga_cb');
    $this->datatables->from('vsales');
    $this->datatables->where_in('status',[1,2]);
    $this->datatables->group_by('id_ksr');
    return print_r($this->datatables->generate());
  }
  public function detailsales($id) {
    $this->load->library('datatables');
    $this->datatables->select('kode_penjualan,sn_brg,nama_brg,harga_jual,harga_diskon as diskon,harga_bayar as harga_ril,harga_cashback');
    $this->datatables->from('vpenjualan');
    $this->datatables->where_in('status',[1,2]);
    $this->datatables->where('id_ksr',$id);
    return print_r($this->datatables->generate());
  }
  public function lapprdj() {
    $this->load->library('datatables');
    $this->datatables->select('kode_penjualan,sn_brg,nama_brg, hrg_hpp, nama_admin, nama_ksr, nama_toko, tgl_transaksi, id_plg,nama_plg,
    harga_jual, harga_diskon ,harga_cashback,harga_bayar,COALESCE((harga_bayar - hrg_hpp),0) as laba_unit');
    $this->datatables->from('vpenjualan');
    $this->datatables->where_in('status',[1,2,3]);
    return print_r($this->datatables->generate());
  }
  public function cancel($id) {
    
  }

}


/* End of file penjualan.php */
/* Location: ./application/controllers/penjualan.php */