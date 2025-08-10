<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DashboarCab_model extends CI_Model {
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
    $this->currentDay = date('d', strtotime($this->currentDate));
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
  public function countlaba($cab) {
    $this->db->select([
        "(SUM(harga_jual) + SUM(DISTINCT jml_donasi) - SUM(harga_diskon) - SUM(harga_cashback)) - SUM(hrg_hpp) as laba_kotor, tgl_transaksi",
        "SUM(harga_jual) as total_pen",
        "SUM(harga_diskon) as total_disk",
        "SUM(harga_cashback) as total_cb",
        "SUM(hrg_hpp) as total_hpp",
        "COALESCE(SUM(DISTINCT jml_donasi), 0) as total_jasa",
				"DATE_FORMAT(DATE_ADD(LAST_DAY(DATE_SUB(CURRENT_DATE, INTERVAL 1 MONTH)), INTERVAL -3 DAY), '%Y-%m-28') AS start_date",
				"DATE_FORMAT(DATE_ADD(LAST_DAY(DATE_SUB(CURRENT_DATE, INTERVAL 0 MONTH)), INTERVAL -4 DAY), '%Y-%m-27') AS end_date",
        "nama_toko"
    ]);
    $this->db->from('vpenjualan');
    $this->db->where_in('status', [1, 2]);
    $this->db->where('id_toko', $cab);
    $this->db->where('DATE(tgl_transaksi) >=', $this->startDateFormatted);
    $this->db->where('DATE(tgl_transaksi) <=', $this->endDateFormatted);
    
    $query = $this->db->get();
    return $query->result_array();    
  }
  public function filtercountlaba($cab,$start,$end){
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
    $this->db->where('id_toko', $cab);
    $this->db->where('DATE(tgl_transaksi) >=', $start);
    $this->db->where('DATE(tgl_transaksi) <=', $end);
    $query = $this->db->get();
    return $query->result_array();
  }
  public function countTopSales($cab){
    $this->db->select([
      "SUM(DISTINCT harga_bayar) + SUM(DISTINCT jml_donasi) as total_jual, id_ksr, nama_ksr"
    ]);
    $this->db->from('vpenjualan');
    $this->db->where('DATE(tgl_transaksi) >=', $this->startDateFormatted);
    $this->db->where('DATE(tgl_transaksi) <=', $this->endDateFormatted);
    $this->db->where('id_toko', $cab);
    $this->db->where_in('status',[1,2]);
    $this->db->group_by('id_ksr');
    $this->db->order_by('total_jual','desc');
    $this->db->limit(5);
    $query = $this->db->get();
    return $query->result_array();
  }
  public function countasset($cab){
    $this->db->select([
      "SUM(hrg_hpp) AS total_hpp"
    ]);
    $this->db->from('vbarangkeluar');
    $this->db->where('id_toko',$cab);
    $this->db->where_in('status',[2]);
    $query = $this->db->get();
    return $query->result_array();
  }
  public function countpenjualan($cab){
    $this->db->select([
      "(SUM(harga_jual) + SUM(DISTINCT jml_donasi) - SUM(harga_diskon) - SUM(harga_cashback))AS total_penjualan",
      "(SUM(harga_jual) - SUM(harga_diskon) - SUM(harga_cashback))AS total_penjualan_no_jasa",
      "COALESCE(SUM(DISTINCT jml_donasi),0) as total_jasa"
    ]);
    $this->db->from('vpenjualan');
    $this->db->where_in('status',[1,2]);
    $this->db->where('id_toko', $cab);
    $this->db->where('DATE(tgl_transaksi) >=', $this->startDateFormatted);
    $this->db->where('DATE(tgl_transaksi) <=', $this->endDateFormatted);
    $query = $this->db->get();
    return $query->result_array();
  }
  public function countdiskon($cab){
    $this->db->select([
      "SUM(harga_diskon) as total_diskon"
    ]);
    $this->db->from('vpenjualan');
    $this->db->where_in('status',[1,2]);
    $this->db->where('id_toko', $cab);
    $this->db->where('DATE(tgl_transaksi) >=', $this->startDateFormatted);
    $this->db->where('DATE(tgl_transaksi) <=', $this->endDateFormatted);
    $query = $this->db->get();
    return $query->result_array();
  }
  public function countcb($cab){
    $this->db->select([
      "SUM(harga_cashback) as total_cashback","DATE_FORMAT(DATE_ADD(LAST_DAY(DATE_SUB(CURRENT_DATE, INTERVAL 1 MONTH)), INTERVAL -3 DAY), '%Y-%m-28') AS start_date",
				"DATE_FORMAT(DATE_ADD(LAST_DAY(DATE_SUB(CURRENT_DATE, INTERVAL 0 MONTH)), INTERVAL -4 DAY), '%Y-%m-27') AS end_date","nama_toko"
    ]);
    $this->db->from('vpenjualan');
    $this->db->where_in('status',[1,2]);
    $this->db->where('id_toko', $cab);
    $this->db->where('DATE(tgl_transaksi) >=', $this->startDateFormatted);
    $this->db->where('DATE(tgl_transaksi) <=', $this->endDateFormatted);
    $query = $this->db->get();
    return $query->result_array();
  }
  public function filtercountcb($cab,$start,$end){
    $this->db->select([
      "COALESCE(SUM(harga_cashback), 0) as total_cashback"
    ]);
    $this->db->from('vpenjualan');
    $this->db->where_in('status',[1,2]);
    $this->db->where('id_toko', $cab);
    $this->db->where('DATE(tgl_transaksi) >=', $start);
    $this->db->where('DATE(tgl_transaksi) <=', $end);
    $query = $this->db->get();
    return $query->result_array();
  }
  public function barangCabang($cab){
    $this->db->select(['id_toko', 'nama_toko']);
    $this->db->from('tb_toko');
    $this->db->where('id_toko',$cab);
    $query = $this->db->get();
    return $query->result_array();
  }
}

/* End of file DashboarCab_model.php */
/* Location: ./application/models/DashboarCab_model.php */
