<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once(APPPATH . 'controllers/Auth.php');

class Welcome extends Auth {
	private $currentDay;
	private $startDateFormatted;
	private $endDateFormatted;
	public function __construct(){
		parent::__construct();
		$this->load->model('Welcome_model');
		$this->load->model('BarangKeluar_model');
		$this->load->model('PenList_model');
		$this->currentDay = 14;
		$today = new DateTime();
		if ($today->format('d') > 14) {
			$startDate = (clone $today)->setDate($today->format('Y'), $today->format('m'), 15);
					$endDate = (clone $today)->modify('first day of next month')->setDate($today->format('Y'), $today->format('m') + 1, 14);
		} else {
			$startDate = (clone $today)->modify('first day of last month')->setDate($today->format('Y'), $today->format('m') - 1, 15);
					$endDate = (clone $today)->modify('first day of next month')->setDate($today->format('Y'), $today->format('m'), 14);
		}
		$this->startDateFormatted = $startDate->format('Y-m-d');
		$this->endDateFormatted = $endDate->format('Y-m-d');
	}
	public function index(){
		$data['hpp'] = $this->PenList_model->countHJ();
		$data['hj'] = $this->Welcome_model->countTerjual();
		$data['chart_years'] = $this->Welcome_model->get_chart_years();
		$data['chart_years_asset'] = $this->Welcome_model->get_chart_years_asset();
		$data['setcabang'] = $this->BarangKeluar_model->getCabang();
		$data['content'] = $this->load->view('dashboard/index', $data, true);
		$data['modal'] = '';
		$data['css'] = '<link rel="stylesheet" type="text/css" href="'.base_url('assets/css/vendors/datatables.css').'">
		<link rel="stylesheet" type="text/css" href="' . base_url('assets/css/vendors/select2.css') . '">
		<link rel="stylesheet" type="text/css" href="'.base_url('assets/css/vendors/sweetalert2.css').'">
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
		$data['js'] = '<script>var base_url = "' . base_url() . '";</script>
			<script src="' . base_url() . 'assets/js/counter/jquery.waypoints.min.js"></script>
			<script src="' . base_url() . 'assets/js/counter/jquery.counterup.min.js"></script>
			<script src="' . base_url() . 'assets/js/counter/counter-custom.js"></script>
			<script src="' . base_url('assets/js/select2/select2.full.min.js') . '"></script>
			<script src="' . base_url('assets/js/additional-js/id.js') . '"></script>
			<script src="' . base_url('assets/js/sweet-alert/sweetalert.min.js').'"></script>
			<script src="' . base_url() . 'assets/js/animation/wow/wow.min.js"></script>
			<script src="' . base_url('assets/js/additional-js/dashboard.js?v='.time()) . '"></script>
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
		   	<script src="' . base_url('assets/js/chart/apex-chart/apex-chart.js') . '"></script>
		    <script src="' . base_url('assets/js/chart/apex-chart/stock-prices.js') . '"></script>
			<script>new WOW().init();</script>';
		$this->load->view('layout/base', $data);
	}
	public function labakotor() {
		if (isset($_POST['lbval'])) {
			if ($this->input->is_ajax_request()) {
				$start = $this->input->post('start');
				$end = $this->input->post('end');
				$results = $this->Welcome_model->filtercountlaba($start,$end);
				header('Content-Type: application/json');
				echo json_encode($results);
                return;
			}else {
                header('Content-Type: application/json');
                echo json_encode(array('error' => 'Invalid request'));
                return;
            }
		}else{
			$results = $this->Welcome_model->countlaba();
			header('Content-Type: application/json');
			echo json_encode($results);
		}
	}
	public function tpenjualan() {
		$results = $this->Welcome_model->countpenjualan();
		header('Content-Type: application/json');
		echo json_encode($results);
	}
	public function tsalescab($id){
		$results = $this->Welcome_model->countTerjual($id);
		header('Content-Type: application/json');
		echo json_encode($results);
	}
	public function tdiskon() {
		$results = $this->Welcome_model->countdiskon();
		header('Content-Type: application/json');
		echo json_encode($results);
	}
	public function tcust() {
		$results = $this->Welcome_model->countcust();
		header('Content-Type: application/json');
		echo json_encode($results);
	}
	public function tkomisiTR(){
		$results = $this->Welcome_model->countkomisiTR();
		header('Content-Type: application/json');
		echo json_encode($results);
	}
	public function tcb() {
		if (isset($_POST['cbval'])) {
			if ($this->input->is_ajax_request()) {
				$start = $this->input->post('start');
				$end = $this->input->post('end');
				$results = $this->Welcome_model->filtercountcb($start,$end);
				header('Content-Type: application/json');
				echo json_encode($results);
                return;
			}else {
                header('Content-Type: application/json');
                echo json_encode(array('error' => 'Invalid request'));
                return;
            }
		}else{
			$results = $this->Welcome_model->countcb();
			header('Content-Type: application/json');
			echo json_encode($results);
		}
	}
	public function tuser() {
		$results = $this->Welcome_model->countuser();
		header('Content-Type: application/json');
		echo json_encode($results);
	}
	public function tsupp() {
		$results = $this->Welcome_model->countsupp();
		header('Content-Type: application/json');
		echo json_encode($results);
	}
	public function tservice() {
		$results = $this->Welcome_model->countservice();
		header('Content-Type: application/json');
		echo json_encode($results);
	}
	public function tpiutang() {
		$results = $this->Welcome_model->countpiutang();
		header('Content-Type: application/json');
		echo json_encode($results);
	}
	public function topsales() {
		$results = $this->Welcome_model->countTopSales();
		header('Content-Type: application/json');
		echo json_encode($results);
	}
	public function tproduk() {
		$results = $this->Welcome_model->countasset();
		header('Content-Type: application/json');
		echo json_encode($results);
	}
	public function detaillabak($start,$end){
		$this->load->library('datatables');
		$this->datatables->select('kode_penjualan,sn_brg,nama_brg,hrg_hpp,harga_jual,
		diskon,harga_cashback,
		COALESCE((harga_bayar - hrg_hpp),0) as laba_unit,
		COALESCE(harga_diskon, 0) AS nilai,harga_bayar as bayar,
		status,tipe_penjualan,nama_toko');
		$this->datatables->from('vpenjualan');
		$this->datatables->where_in('status',[1,2]);
		$this->datatables->where('DATE(tgl_transaksi) >=', $start);
		$this->datatables->where('DATE(tgl_transaksi) <=', $end);
		return print_r($this->datatables->generate());
	}
	public function detailasset(){
		$this->load->library('datatables');
		$this->datatables->select('sn_brg,nama_brg,hrg_hpp,nama_toko');
		$this->datatables->from('vbarangkeluar');
		$this->datatables->where_in('status',[2]);
		return print_r($this->datatables->generate());
	}
	public function detailassetcabang($id){
		$this->load->library('datatables');
		$this->datatables->select('sn_brg,nama_brg,hrg_hpp,nama_toko');
		$this->datatables->from('vbarangkeluar');
		$this->datatables->where('id_toko',$id);
		$this->datatables->where_in('status',[2]);
		return print_r($this->datatables->generate());
	}
	public function detailprodcabang($id){
		$this->load->library('datatables');
		$this->datatables->select('sn_brg,nama_brg,merk,jenis,kondisi');
		$this->datatables->from('vbarangkeluar');
		$this->datatables->where('id_toko',$id);
		$this->datatables->where_in('status',[2]);
		return print_r($this->datatables->generate());
	}
	public function detailsales(){
		$this->load->library('datatables');
		$this->datatables->select('kode_penjualan,sn_brg,nama_brg,harga_jual,harga_diskon,harga_cashback,harga_bayar,nama_toko');
		$this->datatables->from('vpenjualan');
		$this->datatables->where_in('status',[1,2]);
		$this->datatables->where('DATE(tgl_transaksi) >=', $this->startDateFormatted);
		$this->datatables->where('DATE(tgl_transaksi) <=', $this->endDateFormatted);
		return print_r($this->datatables->generate());
	}
	public function detailsalescabang($id){
		$this->load->library('datatables');
		$this->datatables->select('kode_penjualan,sn_brg,nama_brg,harga_jual,harga_diskon,harga_cashback,harga_bayar,nama_toko');
		$this->datatables->from('vpenjualan');
		$this->datatables->where('id_toko',$id);
		$this->datatables->where_in('status',[1,2]);
		$this->datatables->where('DATE(tgl_transaksi) >=', $this->startDateFormatted);
		$this->datatables->where('DATE(tgl_transaksi) <=', $this->endDateFormatted);
		return print_r($this->datatables->generate());
	}
	public function detaildiskon(){
		$this->load->library('datatables');
		$this->datatables->select('sn_brg,nama_brg,nama_toko,total_diskon');
		$this->datatables->from('vtotaldiskon');
		return print_r($this->datatables->generate());
	}
	public function detailcashback($start,$end){
		$this->load->library('datatables');
		$this->datatables->select('sn_brg,nama_brg,cbd,nama_supplier');
		$this->datatables->from('vtotalcashback');
		$this->datatables->where('DATE(tgl_transaksi) >=', $start);
		$this->datatables->where('DATE(tgl_transaksi) <=', $end);
		return print_r($this->datatables->generate());
	}
	public function detailcust(){
		$this->load->library('datatables');
		$this->datatables->select('id_plg,nama_plg,no_ponsel,email,alamat');
		$this->datatables->from('tb_pelanggan');
		return print_r($this->datatables->generate());
	}
	public function detailksr(){
		$this->load->library('datatables');
		$this->datatables->select('kode_penjualan,sn_brg,nama_brg,harga_jual,harga_diskon as diskon,harga_bayar as harga_ril');
		$this->datatables->from('vpenjualan');
		$this->datatables->where_in('status',[1,2]);
		$this->datatables->where('id_ksr',$id);
		$this->datatables->where('DATE(tgl_transaksi) >=', $this->startDateFormatted);
		$this->datatables->where('DATE(tgl_transaksi) <=', $this->endDateFormatted);
		return print_r($this->datatables->generate());
	}
	public function detailkomtr(){
		$endDateObj = new DateTime($this->endDateFormatted);
		$year = $endDateObj->format('Y');
		$monthNum = (int)$endDateObj->format('n');
		$indonesianMonths = [
			1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
			5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
			9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
		];
		$monthName = $indonesianMonths[$monthNum];

		$this->load->library('datatables');
		$this->datatables->select('id_user,nama_lengkap,komisi_tr');
		$this->datatables->from('vtrkomisi');
		$this->datatables->where('tahun', $year);
		$this->datatables->where('bulan', $monthName);
		return print_r($this->datatables->generate());
	}
	public function detailkar(){
		$this->load->library('datatables');
		$this->datatables->select('id_user as id_admin,nama_lengkap as nama_admin,id_toko,nama_toko');
		$this->datatables->from('vkartoko');
		return print_r($this->datatables->generate());
	}
	public function updatekar(){
		if ($this->input->is_ajax_request()) {
			$ids = $this->input->post('ids');
			$cab = $this->input->post('cab');

			$data = array(
				'id_toko' => $cab,
			);
			$this->Welcome_model->updatekar($ids, $data);

			echo json_encode(['status' => 'success']);
		} else {
			redirect('pindah-barang');
		}
	}
	public function asset_chart_data() {
		if ($this->input->is_ajax_request()) {
			$selected_year = $this->input->post('year', true) ?: date('Y');
			$years = [$selected_year - 2, $selected_year - 1, (int)$selected_year]; // e.g. 2024, 2025, 2026
			$months = [
				'01' => 'Jan', '02' => 'Feb', '03' => 'Mar', '04' => 'Apr',
				'05' => 'Mei', '06' => 'Jun', '07' => 'Jul', '08' => 'Agu',
				'09' => 'Sep', '10' => 'Okt', '11' => 'Nov', '12' => 'Des'
			];

			$categories = array_values($months);
			$categories[] = 'Total'; // Add Total column at the end

			$series = [];

			foreach ($years as $y) {
				$year_data = [];
				$annual_total = 0;
				foreach ($months as $m_num => $m_name) {
					$start_date = "$y-$m_num-01";
					$end_date = date("Y-m-t", strtotime($start_date));

					$this->db->select("COALESCE(SUM(hrg_hpp), 0) as total_asset");
					$this->db->from('vbarangkeluar');
					$this->db->where('DATE(tgl_penerimaan) >=', $start_date);
					$this->db->where('DATE(tgl_penerimaan) <=', $end_date);
					$this->db->where_in('status', [2]);
					$q = $this->db->get()->row();

					$val = (float)($q->total_asset ?? 0);
					$year_data[] = $val;
					$annual_total += $val;
				}
				// Append annual total as the 13th data point
				$year_data[] = $annual_total;

				$series[] = [
					'name' => (string)$y,
					'data' => $year_data
				];
			}

			echo json_encode([
				'status' => true,
				'categories' => $categories,
				'series' => $series
			]);
		} else {
			redirect('welcome');
		}
	}

	public function laba_chart_data() {
		if ($this->input->is_ajax_request()) {
			$selected_year = $this->input->post('year', true) ?: date('Y');
			$years = [$selected_year - 2, $selected_year - 1, (int)$selected_year]; // e.g. 2024, 2025, 2026
			$months = [
				'01' => 'Jan', '02' => 'Feb', '03' => 'Mar', '04' => 'Apr',
				'05' => 'Mei', '06' => 'Jun', '07' => 'Jul', '08' => 'Agu',
				'09' => 'Sep', '10' => 'Okt', '11' => 'Nov', '12' => 'Des'
			];

			$categories = array_values($months);
			$series = [];

			foreach ($years as $y) {
				$year_data = [];
				foreach ($months as $m_num => $m_name) {
					// Use 15th of previous month to 14th of current month cycle calculation matching Welcome_model
					$target_date = new DateTime("$y-$m_num-15");
					$start_date = (clone $target_date)->modify('first day of last month')->setDate($y, $m_num - 1, 15)->format('Y-m-d');
					if ($m_num == 1) {
						$start_date = ($y - 1) . '-12-15';
					}
					$end_date = "$y-$m_num-14";

					$this->db->select("COALESCE((SUM(harga_jual) - SUM(harga_diskon) - SUM(harga_cashback)) - SUM(hrg_hpp), 0) as total_laba");
					$this->db->from('vpenjualan');
					$this->db->where_in('status', [1, 2]);
					$this->db->where('DATE(tgl_transaksi) >=', $start_date);
					$this->db->where('DATE(tgl_transaksi) <=', $end_date);
					$q = $this->db->get()->row();

					$year_data[] = (float)($q->total_laba ?? 0);
				}
				$series[] = [
					'name' => (string)$y,
					'type' => 'line',
					'data' => $year_data
				];
			}

			echo json_encode([
				'status' => true,
				'categories' => $categories,
				'series' => $series
			]);
		} else {
			redirect('welcome');
		}
	}
}
