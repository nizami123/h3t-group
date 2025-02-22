<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['finansial']='welcome/finansial';
$route['produk']='welcome/produk';
$route['master-karyawan']='MasterKaryawan';
$route['master-karyawan/simpan-data']='MasterKaryawan/createpost';
$route['master-karyawan/jsonkar']='MasterKaryawan/jsonkar';
$route['master-karyawan/edit/(:any)']='MasterKaryawan/edit/$1';
$route['master-karyawan/update-data']='MasterKaryawan/updatepost';
$route['master-karyawan/hapus/(:any)'] = 'MasterKaryawan/deletepost/$1';
$route['master-cabang']='MasterCabang';
$route['master-cabang/simpan-data']='MasterCabang/createpost';
$route['master-cabang/jsoncab']='MasterCabang/jsoncab';
$route['master-cabang/edit/(:any)']='MasterCabang/edit/$1';
$route['master-cabang/update-data']='MasterCabang/updatepost';
$route['master-cabang/hapus/(:any)'] = 'MasterCabang/deletepost/$1';
$route['master-kustomer']='MasterKustomer';
$route['data-kustomer']='MasterKustomer/datacustomer';
$route['master-kustomer/simpan-data']='MasterKustomer/createpost';
$route['master-kustomer/jsonkus']='MasterKustomer/jsonkus';
$route['master-kustomer/edit/(:any)']='MasterKustomer/edit/$1';
$route['master-kustomer/update-data']='MasterKustomer/updatepost';
$route['master-kustomer/hapus/(:any)'] = 'MasterKustomer/deletepost/$1';
$route['master-supplier']='MasterSupplier';
$route['master-supplier/simpan-data']='MasterSupplier/createpost';
$route['master-supplier/jsonsup']='MasterSupplier/jsonsup';
$route['master-supplier/edit/(:any)']='MasterSupplier/edit/$1';
$route['master-supplier/update-data']='MasterSupplier/updatepost';
$route['master-supplier/hapus/(:any)'] = 'MasterSupplier/deletepost/$1';
$route['master-diskon']='MasterDiskon';
$route['master-diskon/simpan-data']='MasterDiskon/createpost';
$route['master-diskon/jsondis']='MasterDiskon/jsondis';
$route['master-diskon/edit/(:any)']='MasterDiskon/edit/$1';
$route['master-diskon/update-data']='MasterDiskon/updatepost';
$route['master-diskon/hapus/(:any)'] = 'MasterDiskon/deletepost/$1';
$route['master-kategori']='MasterKategori';
$route['master-kategori/simpan-data']='MasterKategori/createpost';
$route['master-kategori/addjenis']='MasterKategori/addjenis';
$route['master-kategori/addwarna']='MasterKategori/addwarna';
$route['master-kategori/addstorage']='MasterKategori/addstorage';
$route['master-kategori/addvariant']='MasterKategori/addvariant';
$route['master-kategori/jsonkat/(:any)'] = 'MasterKategori/jsonkat/$1';
$route['master-kategori/hapus/(:num)'] = 'MasterKategori/deletepost/$1';
$route['master-barang']='MasterBarang';
$route['master-barang/simpan-data']='MasterBarang/createpost';
$route['master-barang/update-data']='MasterBarang/updatepost';
$route['master-barang/loadbrg']='MasterBarang/loadbrg';
$route['master-barang/edit/(:any)'] = 'MasterBarang/edit/$1';
$route['master-barang/hapus/(:any)'] = 'MasterBarang/deletepost/$1';
$route['master-bank']='MasterBank';
$route['master-bank/loadbank']='MasterBank/loadbank';
$route['master-bank/simpan-data']='MasterBank/createpost';
$route['master-bank/update-data']='MasterBank/updatepost';
$route['master-bank/hapus/(:num)'] = 'MasterBank/deletepost/$1';
$route['master-bank/edit/(:num)'] = 'MasterBank/edit/$1';
$route['barang-masuk']='InventoriStok/bm';
$route['barang-masuk/loadbm']='InventoriStok/loadbm';
$route['barang-masuk/simpan-barang-baru']='InventoriStok/addmb';
$route['barang-masuk/simpan-barang-bekas']='InventoriStok/addmk';
$route['barang-masuk/simpan-acc']='InventoriStok/addacc';
$route['barang-masuk/hapus/(:num)'] = 'InventoriStok/deletepost/$1';
$route['pembelianinput/loadbm']='pembelianInput/loadbm';
$route['pembelianinput/simpan-barang-baru']='pembelianInput/addmb';
$route['pembelianinput/simpan-barang-bekas']='pembelianInput/addmk';
$route['pembelianinput/simpan-acc']='pembelianInput/addacc';
$route['pembelianinput/hapus/(:num)'] = 'pembelianInput/deletepost/$1';
$route['barang-keluar']='BarangKeluar';
$route['barang-keluar/stock/(:any)']='BarangKeluar/datacount/$1';
$route['barang-keluar/loadbk']='BarangKeluar/loadbk';
$route['barang-keluar/getsk/(:any)']='BarangKeluar/getsk/$1';
$route['barang-keluar/getdetailsk/(:any)']='BarangKeluar/getdetailsk/$1';
$route['barang-keluar/groupsk']='BarangKeluar/groupsk';
$route['barang-keluar/simpan-barang-baru']='BarangKeluar/addmb';
$route['barang-keluar/simpan-barang-bekas']='BarangKeluar/addmk';
$route['barang-keluar/simpan-acc']='BarangKeluar/addacc';
$route['barang-keluar/hapus/(:num)'] = 'BarangKeluar/deletepost/$1';
$route['barang-keluar/printsk/(:any)'] = 'BarangKeluar/formatsk/$1';
$route['barang-keluar/approve-sk/(:any)']='BarangKeluar/sendingsk/$1';
$route['terima-barang']='BarangTerima';
$route['terima-barang/groupsk']='BarangTerima/groupsk';
$route['terima-barang/groupsp']='BarangTerima/groupsp';
$route['terima-barang/filtersk/(:any)']='BarangTerima/filtersk/$1';
$route['terima-barang/filtersp/(:any)']='BarangTerima/filtersp/$1';
$route['terima-barang/approve']='BarangTerima/approve';
$route['terima-barang/approvesp']='BarangTerima/approvesp';
$route['pindah-barang']='BarangPindah/indexpemindahan';
$route['pindah-barang/loadbk']='BarangPindah/loadbk';
$route['pindah-barang/loadsp']='BarangPindah/loadsp';
$route['pindah-barang/load-detail/(:num)']='BarangPindah/loadtsp/$1';
$route['pindah-barang/hapus-brg/(:num)/(:num)']='BarangPindah/deletebrg/$1/$2';
$route['pindah-barang/buat-sp']='BarangPindah/createsp';
$route['pindah-barang/tambah-data']='BarangPindah/addbrg';
$route['pindah-barang/update']='BarangPindah/update';
$route['stock-opname']='StockOpname';
$route['stock-opname/riwayat-opname']='StockOpname/loadriwayat';
$route['stock-opname/detail-opname/(:num)']='StockOpname/loaddetail/$1';
$route['stock-opname/tambah-stock-opname']='StockOpname/addstockopname';
$route['stock-opname/simpan-data']='StockOpname/createpost';
$route['stock-opname/simpan-data-produk']='StockOpname/addpr';
$route['stock-opname/opname-list']='StockOpname/loadopnamelist';
$route['stock-opname/produk-list/(:any)/(:any)']='StockOpname/loadproduklist/$1/$2';
$route['stock-opname/approve']='StockOpname/approveopnm';
$route['stock-opname/hapus/(:num)']='StockOpname/deletepost/$1';
$route['stock-opname/getbarang/(:any)']='StockOpname/getbarang/$1';
$route['finance-supplier/dp-supplier']='FinSupp';
$route['finance-supplier/load-dp-supp']='FinSupp/dpsupp';
$route['finance-supplier/load-dp-detail/(:any)']='FinSupp/detaildp/$1';
$route['finance-supplier/tambah-dp']='FinSupp/createpost';
$route['finance-supplier/hapus/(:num)'] = 'FinSupp/deletepost/$1';
$route['finance-supplier/cashback-supplier'] = 'FinCb';
$route['finance-supplier/load-cb-supp']='FinCb/cbsupp';
$route['finance-supplier/load-cb-produk/(:any)']='FinCb/procb/$1';
$route['finance-supplier/load-cb-detail/(:any)']='FinCb/detailcb/$1';
$route['etalase-toko'] = 'PenEtalase';
$route['etalase-toko/produk-list'] = 'PenEtalase/loadproduk';
$route['etalase-toko/update-data']='PenEtalase/updatepost';
$route['etalase-toko/filter-supp/(:any)']='PenEtalase/filtersupp/$1';
$route['order-masuk'] = 'PenOrderIn';
$route['order-masuk/load-order'] = 'PenOrderIn/orderin';
$route['order-masuk/detail-penjualan/(:any)'] = 'PenOrderIn/detailsales/$1';
$route['order-masuk/filtercab/(:any)']='PenOrderIn/filtercab/$1';
$route['order-masuk/hrgj/(:any)']='PenOrderIn/datacountHJ/$1';
$route['order-masuk/approve']='PenOrderIn/approve';
$route['order-masuk/approve-gestun']='PenOrderIn/approvegestun';
$route['order-masuk/cancel']='PenOrderIn/cancel';
$route['order-masuk/detail-invoice'] = 'PenOrderIn/detailinv';
$route['riwayat-penjualan'] = 'PenRiwayat';
$route['riwayat-penjualan/laporan-penjualan'] = 'PenRiwayat/laporansales';
$route['riwayat-penjualan/laporan-jual'] = 'PenRiwayat/laporanjual';
$route['riwayat-penjualan/detail-laporan-jual'] = 'PenRiwayat/detaillapjual';
$route['riwayat-penjualan/laporan-detail-penjualan/(:any)'] = 'PenRiwayat/detailsales/$1';
$route['riwayat-penjualan/laporan-produk-jual'] = 'PenRiwayat/lapprdj';
$route['produk-list'] = 'PenList';
$route['produk-list/asset-store/(:any)'] = 'PenList/datacountHP/$1';
$route['produk-list/daftar'] = 'PenList/produklist';
$route['produk-list/detailbrg/(:num)'] = 'PenList/infoBrg/$1';
$route['produk-list/filtercab/(:any)']='PenList/filtercab/$1';
$route['produk-list/export-barcode/(:any)/(:any)/(:any)/(:any)'] = 'PenList/exportbarcode/$1/$2/$3/$4';
$route['produk-list/export-barcode-select/(:any)/(:any)/(:any)'] = 'PenList/exportbarcode/$1/$2/$3';
$route['detail-laba/(:any)/(:any)']='Welcome/detaillabak/$1/$2';
$route['detail-asset']='Welcome/detailasset';
$route['detail-asset-cabang/(:any)']='Welcome/detailassetcabang/$1';
$route['detail-produk-cabang/(:any)']='Welcome/detailprodcabang/$1';
$route['detail-sales']='Welcome/detailsales';
$route['detail-sales-cabang/(:any)']='Welcome/detailsalescabang/$1';
$route['total-sales-cabang/(:any)'] = 'Welcome/tsalescab/$1';
$route['detail-diskon']='Welcome/detaildiskon';
$route['detail-diskon-cab/(:any)']='DashboardCab/detaildiskon/$1';
$route['detail-cb/(:any)/(:any)']='Welcome/detailcashback/$1/$2';
$route['detail-customer']='Welcome/detailcust';
$route['cabang/(:any)']='DashboardCab/dashcab/$1';
$route['detail-laba-cab/(:any)/(:any)/(:any)']='DashboardCab/detaillabak/$1/$2/$3';
$route['detail-cashback-cab/(:any)/(:any)/(:any)']='DashboardCab/detailcashback/$1/$2/$3';
$route['login']='Login';
$route['logout']='Login/logout';
$route['cek-auth']='Login/aksi_login';
$route['registrasi']='Login/createpost';
