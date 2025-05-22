<?php
defined('BASEPATH') or exit('No direct script access allowed');
include_once(APPPATH . 'controllers/Auth.php');
class Pengecekan extends Auth
{
    
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Pengecekan_model');
  }

  public function index(){
    $cab = $this->session->userdata('id_toko');
    $data['barangcabang'] = $this->second->barangCabang($cab);
    $data['setcabang'] = $this->first->getCabang();
    $data['content'] = $this->load->view('transaksi/pengecekan', '', true);
    $data['modal'] = '';
    $data['css'] = '<link rel="stylesheet" type="text/css" href="'.base_url('assets/css/vendors/datatables.css').'">
    <link rel="stylesheet" type="text/css" href="'.base_url('assets/css/vendors/sweetalert2.css').'">';
    $data['js'] = '<script>var base_url = "' . base_url() . '";</script>
    <script src="' . base_url('assets/js/additional-js/pengecekan.js?v='.time().'') . '"></script>
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
    $this->load->view('layout/base', $data);
  }
  public function tablecekdata(){
    $this->load->library('datatables');
    $this->datatables->select('no_fm, tanggal, nama_supplier, alamat, status_pem');
    $this->datatables->from('vpembelian');
    $this->datatables->where_in('status_pem',[1,2]);
    return print_r($this->datatables->generate());
  }
	public function tabledetailcekdata($nofm) {
		// $nofm = urldecode($this->input->post('no_fm'));
		$this->load->library('datatables');
		$this->datatables->select('*');
		$this->datatables->from('vdetailpembelian');
		$this->datatables->like('no_fm', $nofm);
    $this->datatables->where_in('kondisi', ['Bekas']);
		return print_r($this->datatables->generate());
	}
  public function addItem()
  {
    if ($this->input->is_ajax_request()) {
      $data = [
        'id_masuk' => $this->input->post('id'),
        'qty_cek' => $this->input->post('qty'),
        'keterangan_cek' => $this->input->post('ket'),
      ];
      $result = $this->Pengecekan_model->addItem($data);
      if ($result) {
        $response = [
          'status' => 'success',
          'message' => 'Data berhasil disimpan.',
        ];
      } else {
        $response = [
          'status' => 'failed',
          'message' => 'Data gagal disimpan.',
        ];
      }
      echo json_encode($response);
    } else {
      show_404();
    }
  }

}


/* End of file pengecekan.php */
/* Location: ./application/controllers/pengecekan.php */
