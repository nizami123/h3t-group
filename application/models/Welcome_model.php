<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome_model extends CI_Model {

  private $currentDate;
  private $currentYear;
  private $currentMonth;
  private $currentDay;
  private $startDateFormatted;
  private $endDateFormatted;	

  public function __construct() {
    $this->currentDate = date('Y-m-d');
    $this->currentYear = date('Y', strtotime($this->currentDate));
    $this->currentMonth = date('m', strtotime($this->currentDate));
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
  public function countTerjual($id = null) {
    $this->db->select([
      "REPLACE(REPLACE(FORMAT(SUM(vj.harga_bayar), 0), ',', '.'), '.', '.') as total_jual",
        "stores.id_toko", "stores.nama_toko"
    ]);
    $this->db->from('tb_toko AS stores');
    $this->db->join('vbarangkeluar AS v', 'stores.id_toko = v.id_toko', 'LEFT');
    $this->db->join('vpenjualan AS vj', 'v.id_keluar = vj.id_keluar', 'LEFT');
		$this->db->where('DATE(vj.tgl_transaksi) >=', $this->startDateFormatted);
    $this->db->where('DATE(vj.tgl_transaksi) <=', $this->endDateFormatted);
    $this->db->where_in('vj.status',[1,2]);
    $this->db->group_by('stores.id_toko');
    if ($id) {
        $this->db->group_start();
        $this->db->like('stores.id_toko', $id);
        $this->db->group_end();
    }
    $query = $this->db->get();
    return $query->result_array();
  }
  public function countlaba() {
    $this->db->select([
      "(SUM(harga_jual) + SUM(DISTINCT jml_donasi) - SUM(harga_diskon) - SUM(harga_cashback)) - SUM(hrg_hpp) as laba_kotor, tgl_transaksi,
      SUM(harga_jual) as total_pen, SUM(harga_diskon) as total_disk, SUM(harga_cashback) total_cb, SUM(hrg_hpp) as total_hpp",
      "COALESCE(SUM(DISTINCT jml_donasi),0) as total_jasa",
      "DATE_FORMAT(DATE_ADD(LAST_DAY(DATE_SUB(CURRENT_DATE, INTERVAL 1 MONTH)), INTERVAL -3 DAY), '%Y-%m-15') AS start_date",
			"DATE_FORMAT(DATE_ADD(LAST_DAY(DATE_SUB(CURRENT_DATE, INTERVAL 0 MONTH)), INTERVAL -4 DAY), '%Y-%m-14') AS end_date"
    ]);
    $this->db->from('vpenjualan');
    $this->db->where_in('status',[1,2]);
		$this->db->where('DATE(tgl_transaksi) >=', $this->startDateFormatted);
    $this->db->where('DATE(tgl_transaksi) <=', $this->endDateFormatted);
    $query = $this->db->get();
    return $query->result_array();
  }
  public function filtercountlaba($start,$end){
    $this->db->select([
      "COALESCE((SUM(harga_jual) + SUM(DISTINCT jml_donasi) - SUM(harga_diskon) - SUM(harga_cashback)) - SUM(hrg_hpp),0) as laba_kotor, 
      tgl_transaksi,
      COALESCE(SUM(harga_jual),0) as total_pen, 
      COALESCE(SUM(harga_diskon),0) as total_disk, 
      COALESCE(SUM(harga_cashback),0) total_cb, 
      COALESCE(SUM(hrg_hpp),0) as total_hpp,
      COALESCE(SUM(DISTINCT jml_donasi),0) as total_jasa",
    ]);
    $this->db->from('vpenjualan');
    $this->db->where_in('status',[1,2]);
    $this->db->where('DATE(tgl_transaksi) >=', $start);
    $this->db->where('DATE(tgl_transaksi) <=', $end);
    $query = $this->db->get();
    return $query->result_array();
  }
  public function countasset(){
    $this->db->select([
      "SUM(hrg_hpp) AS total_hpp"
    ]);
    $this->db->from('vbarangkeluar');
    $this->db->where_in('status',[2]);
    $query = $this->db->get();
    return $query->result_array();
  }
  public function countpenjualan(){
    $this->db->select([
      "(SUM(harga_jual) + SUM(DISTINCT jml_donasi) - SUM(harga_diskon) - SUM(harga_cashback))AS total_penjualan",
      "(SUM(harga_jual) - SUM(harga_diskon) - SUM(harga_cashback))AS total_penjualan_no_jasa",
      "COALESCE(SUM(DISTINCT jml_donasi),0) as total_jasa"
    ]);
    $this->db->from('vpenjualan');
    $this->db->where_in('status',[1,2]);
		$this->db->where('DATE(tgl_transaksi) >=', $this->startDateFormatted);
    $this->db->where('DATE(tgl_transaksi) <=', $this->endDateFormatted);
    $query = $this->db->get();
    return $query->result_array();
  }
  public function countdiskon(){
    $this->db->select([
      "SUM(harga_diskon) as total_diskon"
    ]);
    $this->db->from('vpenjualan');
    $this->db->where_in('status',[1,2]);
		$this->db->where('DATE(tgl_transaksi) >=', $this->startDateFormatted);
    $this->db->where('DATE(tgl_transaksi) <=', $this->endDateFormatted);
    $query = $this->db->get();
    return $query->result_array();
  }
  public function countcust(){
    $this->db->select([
      "COUNT(id_plg) as total_customer"
    ]);
    $this->db->from('tb_pelanggan');
    $query = $this->db->get();
    return $query->result_array();
  }
  public function countcb(){
    $this->db->select([
      "SUM(harga_cashback) as total_cashback",
			"DATE_FORMAT(DATE_ADD(LAST_DAY(DATE_SUB(CURRENT_DATE, INTERVAL 1 MONTH)), INTERVAL -3 DAY), '%Y-%m-15') AS start_date",
			"DATE_FORMAT(DATE_ADD(LAST_DAY(DATE_SUB(CURRENT_DATE, INTERVAL 0 MONTH)), INTERVAL -4 DAY), '%Y-%m-14') AS end_date"
    ]);
    $this->db->from('vpenjualan');
    $this->db->where_in('status',[1,2]);
		$this->db->where('DATE(tgl_transaksi) >=', $this->startDateFormatted);
    $this->db->where('DATE(tgl_transaksi) <=', $this->endDateFormatted);
    $query = $this->db->get();
    return $query->result_array();
  }
  public function filtercountcb($start,$end){
    $this->db->select([
      "COALESCE(SUM(harga_cashback), 0) as total_cashback"
    ]);
    $this->db->from('vpenjualan');
    $this->db->where_in('status',[1,2]);
    $this->db->where('DATE(tgl_transaksi) >=', $start);
    $this->db->where('DATE(tgl_transaksi) <=', $end);
    $query = $this->db->get();
    return $query->result_array();
  }
  public function countTopSales(){
    $this->db->select([
      "SUM(harga_bayar) + SUM(DISTINCT jml_donasi) as total_jual", 
      "id_ksr",
      "nama_ksr"
  ]);
    $this->db->from('vpenjualan');
    $this->db->where_in('status',[1,2]);
		$this->db->where('DATE(tgl_transaksi) >=', $this->startDateFormatted);
    $this->db->where('DATE(tgl_transaksi) <=', $this->endDateFormatted);
    $this->db->group_by(['id_ksr', 'nama_ksr']);
    $this->db->order_by('total_jual','desc');
    $this->db->limit(5);
    $query = $this->db->get();
    return $query->result_array();
  }
  public function countStockCab(){
    $this->db->select(['id_toko', 'nama_toko','COUNT(id_keluar) as total_produk_toko']);
    $this->db->from('vbarangkeluar');
    $this->db->where_in('status',[2]);
    $this->db->group_by('id_toko');
    $query = $this->db->get();
    return $query->result_array();
  }
  public function countuser() {
    $this->db->select([
      "COUNT(id_user) as total_user"
    ]);
    $this->db->from('tb_user');
    $query = $this->db->get();
    return $query->result_array();
  }
  public function countsupp() {
    $this->db->select([
      "COUNT(id_supplier) as total_supplier"
    ]);
    $this->db->from('tb_supplier');
    $query = $this->db->get();
    return $query->result_array();
  }
  public function countservice() {
    $this->db->select([
      "COUNT(id_masuk) as total_supplier"
    ]);
    $this->db->from('listservice');
    $this->db->where('status = 1');
    $query = $this->db->get();
    return $query->result_array();
  }
  public function countpiutang() {
    $this->db->select([
      "sum(total) as total_supplier"
    ]);
    $this->db->from('v_penjualancus');
    $this->db->where('status in (0,1)');
    $query = $this->db->get();
    return $query->result_array();
  }
  public function updatekar($id, $data) {
    $this->db->where('id_admin', $id);
    $this->db->update('tb_admin', $data);
    // $this->db->update_batch('tb_brg_keluar', $data);
	}

}

/* End of file Welcome_model.php */
/* Location: ./application/models/Welcome_model.php */
