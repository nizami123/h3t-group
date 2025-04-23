
        <div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-6">
                  <h4>Selamat Datang Founder !</h4>
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?=base_url()?>">
                        <svg class="stroke-icon">
                            <use href="<?=base_url()?>assets/svg/icon-sprite.svg#stroke-home"></use>
                        </svg>
                        </a>
                    </li>
                    <li class="breadcrumb-item">Dashboard</li>
                    <li class="breadcrumb-item active">General</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row size-column">
              <div class="col-xxl-10 col-md-12 box-col-8 grid-ed-12">
                <div class="row">
                  <!-- Gross Profits -->
                  <div class=" col-md-7 box-col-7">
                    <div class="row"> 
                      <div class="col-sm-12">
                        <a href="#" class="cardlaba" data-bs-toggle="modal" data-bs-target="#DetailLaba" data-total_laba="" data-total_hpp="" data-total_pen="" data-total_disk="" data-total_cashb="" data-bulanlb="" data-tahunlb="">
                          <div class="card o-hidden">  
                            <div class="card-body balance-widget">
                              <span class="f-w-500 f-light">Laba Bersih Bulan Ini</span>
                              <br>
                              <div class="spinner-border text-primary d-none" role="status" id="spinner">
                                <span class="visually-hidden">Memuat...</span>
                              </div>
                              <h4 class="mb-3 mt-1 f-w-500 mb-0 f-22 laba" id="laba"></h4>
                              <div class="d-flex gap-1 align-items-center flex-wrap pt-xxl-0 pt-4">
                                <p class="text-muted">Update Hari ini</p>
                              </div>      
                              <div class="mobile-right-img"><img class="left-mobile-img" src="<?=base_url()?>assets/images/dashboard-2/widget-img.png" alt=""><img class="mobile-img" src="<?=base_url()?>assets/images/dashboard-2/mobile.gif" alt="mobile with coin"></div>
                            </div>
                          </div>
                        </a>
                      </div>
                      <!-- Asset Produk Semua Cabang -->
                      <div class="col-6">
                        <a href="#" class="cap" data-bs-toggle="modal" data-bs-target="#DetailAssetProduk" data-total_asset="">
                          <div class="card small-widget"> 
                            <div class="card-body primary"> <span class="f-light">Total Asset Tersedia H3T</span>
                              <div class="d-flex align-items-end gap-1">
                                <div class="spinner-border text-primary d-none" role="status" id="spintp">
                                  <span class="visually-hidden">Memuat...</span>
                                </div>
                                <h4 id="cardtp"></h4></span>
                              </div>
                              <div class="bg-gradient"> 
                                <svg class="stroke-icon svg-fill">
                                  <use href="<?=base_url()?>assets/svg/icon-sprite.svg#new-order"></use>
                                </svg>
                              </div>
                            </div>
                          </div>
                        </a>
                      </div>
                      <!-- Total Penjualan -->
                      <div class="col-6"> 
                        <a href="#" class="cp" data-bs-toggle="modal" data-bs-target="#DetailSales" data-total_sales="">
                          <div class="card small-widget"> 
                            <div class="card-body success"><span class="f-light">Total Penjualan Bulan Ini</span>
                              <div class="d-flex align-items-end gap-1">
                                <div class="spinner-border text-primary d-none" role="status" id="spinp">
                                  <span class="visually-hidden">Memuat...</span>
                                </div>
                                <h4 id="cardp"></h4></span>
                              </div>
                              <div class="bg-gradient"> 
                                <svg class="stroke-icon svg-fill">
                                  <use href="<?=base_url()?>assets/svg/icon-sprite.svg#profit"></use>
                                </svg>
                              </div>
                            </div>
                          </div>
                        </a>
                      </div>
                      <!-- Total Diskon Penjualan -->
                      <div class="col-6"> 
                        <a href="#" class="cdp" data-bs-toggle="modal" data-bs-target="#DetailDiskon" data-diskon_sales="">
                          <div class="card small-widget"> 
                            <div class="card-body secondary"><span class="f-light">Total Diskon Bulan Ini</span>
                              <div class="d-flex align-items-end gap-1">
                                <div class="spinner-border text-primary d-none" role="status" id="spindp">
                                  <span class="visually-hidden">Memuat...</span>
                                </div>
                                <h4 id="carddp"></h4></span>
                              </div>
                              <div class="bg-gradient"> 
                                <svg class="stroke-icon svg-fill">
                                  <use href="<?=base_url()?>assets/svg/icon-sprite.svg#sale"></use>
                                </svg>
                              </div>
                            </div>
                          </div>
                        </a>
                      </div>
                      <!-- Total Cashback -->
                      <div class="col-6"> 
                        <a href="#" class="ctc" data-bs-toggle="modal" data-bs-target="#DetailCashback" data-total_cba="" data-bulancb="" data-tahuncb="">
                          <div class="card small-widget"> 
                            <div class="card-body warning"><span class="f-light">Total Cashback Bulan Ini</span>
                              <div class="d-flex align-items-end gap-1">
                                <div class="spinner-border text-primary d-none" role="status" id="spintc">
                                  <span class="visually-hidden">Memuat...</span>
                                </div>                                
                                <h4 id="cardtc"></h4></span>
                              </div>
                              <div class="bg-gradient"> 
                                <svg class="stroke-icon svg-fill">
                                  <use href="<?=base_url()?>assets/svg/icon-sprite.svg#sale"></use>
                                </svg>
                              </div>
                            </div>
                          </div>
                        </a>
                      </div>
                    </div>
                  </div>
                  <!-- Sales -->
                  <div class=" col-md-5 col-sm-6 box-col-5">
                    <div class="rwow"></div>
                    <div class="appointment">
                      <div class="card">
                        <div class="card-header card-no-border">
                          <div class="header-top">
                            <h5 class="m-0">Top Sales Bulan Ini🌟</h5>
                          </div>
                        </div>
                        <div class="card-body pt-0">
                          <div class="appointment-table customer-table table-responsive">
                            <table class="table table-bordernone">
                              <tbody id="topSalesTableBody">
                                
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <!-- asset hpp -->
                    <?php foreach ($hpp as $sc) { ?>
                        <div class="col-md-4 col-sm-6">
                            <a href="#" class="cardhpp" data-bs-toggle="modal" data-bs-target="#DetailAssetProdukCab" data-id="<?=$sc['id_toko']?>" data-total="<?=$sc['total_asset']?>" data-cabang="<?=$sc['nama_toko']?>">
                              <div class="card widget-hover overflow-hidden">
                                  <div class="card-header card-no-border pb-2">
                                      <h5 id="id_toko" data-id="<?=$sc['id_toko']?>">Asset Tersedia <?=$sc['nama_toko']?></h5>
                                  </div>
                                  <div class="card-body pt-0 count-student">
                                      <div class="school-wrapper"> 
                                          <div class="school-header" data-id="<?=$sc['id_toko']?>">
                                              <div class="spinner-border text-primary d-none" role="status" id="spinhpp-<?=$sc['id_toko']?>">
                                                  <span class="visually-hidden">Memuat...</span>
                                              </div>
                                              <h4 class="txt-success counting" id="counthpp-<?=$sc['id_toko']?>">Rp <?=$sc['total_asset']?></h4>
                                              <div class="d-flex gap-1 align-items-center flex-wrap pt-xxl-0 pt-2">
                                                  <p class="text-muted">Update Hari ini</p>
                                              </div>                          
                                          </div>
                                          <div class="school-body"> <img src="<?=base_url()?>assets/images/inventoriassets/assetstore.png" alt="store-produk-dh">
                                              <div class="right-line"><img src="<?=base_url()?>assets/images/inventoriassets/line.png" alt="line"></div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                            </a>
                        </div>
                    <?php } ?>
                    <?php foreach ($hj as $sc) { ?>
                        <div class="col-md-4 col-sm-6">
                            <a href="#" class="cardhj" data-bs-toggle="modal" data-bs-target="#DetailSalesProdukCab" data-id="<?=$sc['id_toko']?>" data-total="<?=$sc['total_jual']?>" data-cabang="<?=$sc['nama_toko']?>">
                              <div class="card widget-hover overflow-hidden">
                                  <div class="card-header card-no-border pb-2">
                                      <h5 id="id_toko" data-id="<?=$sc['id_toko']?>">Asset Terjual <?=$sc['nama_toko']?></h5>
                                  </div>
                                  <div class="card-body pt-0 count-student">
                                      <div class="school-wrapper"> 
                                          <div class="school-header" data-id="<?=$sc['id_toko']?>">
                                              <div class="spinner-border text-primary d-none" role="status" id="spinhj-<?=$sc['id_toko']?>">
                                                  <span class="visually-hidden">Memuat...</span>
                                              </div>
                                              <h4 class="txt-success counting" id="counthj-<?=$sc['id_toko']?>">Rp <?=$sc['total_jual']?></h4>
                                              <div class="d-flex gap-1 align-items-center flex-wrap pt-xxl-0 pt-2">
                                                  <p class="text-muted">Update Hari ini</p>
                                              </div>                          
                                          </div>
                                          <div class="school-body"> <img src="<?=base_url()?>assets/images/inventoriassets/assetstore.png" alt="store-produk-dh">
                                              <div class="right-line"><img src="<?=base_url()?>assets/images/inventoriassets/line.png" alt="line"></div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                            </a>
                        </div>
                    <?php } ?>
                  </div>
                  <!-- Total Karyawan -->
                  <div class="col-md-6 col-sm-6">
                    <a href="#" class="ctu" data-bs-toggle="modal" data-bs-target="#DetailUser" data-total_usr="">
                      <div class="card widget-hover overflow-hidden">
                        <div class="card-header card-no-border pb-2">
                          <h5>Total Karyawan</h5>
                        </div>
                        <div class="card-body pt-0 count-student">
                          <div class="school-wrapper"> 
                            <div class="school-header">
                              <div class="spinner-border text-primary d-none" role="status" id="spintu">
                                <span class="visually-hidden"></span>
                              </div>
                              <h4 class="text-warning" id="counttu"></h4>
                              <div class="d-flex gap-1 align-items-center flex-wrap pt-xxl-0 pt-2">
                                  <p class="text-muted">Realtime Updated</p>
                              </div>
                            </div>
                            <div class="school-body"><img src="<?=base_url()?>assets/images/karyawan/karyawans.png" alt="dh-karyawan">
                              <div class="right-line"><img src="<?=base_url()?>assets/images/inventoriassets/line.png" alt="line"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </a>
                  </div>                  
                  <!-- Total Supplier -->
                  <div class="col-md-6 col-sm-6">
                    <a href="#" class="cts" data-bs-toggle="modal" data-bs-target="#DetailSupplier" data-total_supp="">
                      <div class="card widget-hover overflow-hidden">
                        <div class="card-header card-no-border pb-2">
                          <h5>Total Supplier</h5>
                        </div>
                        <div class="card-body pt-0 count-student">
                          <div class="school-wrapper"> 
                            <div class="school-header">
                              <div class="spinner-border text-primary d-none" role="status" id="spints">
                                <span class="visually-hidden"></span>
                              </div>
                              <h4 class="text-warning" id="countts"></h4>
                              <div class="d-flex gap-1 align-items-center flex-wrap pt-xxl-0 pt-2">
                                  <p class="text-muted">Realtime Updated</p>
                              </div>
                            </div>
                            <div class="school-body"><img src="<?=base_url()?>assets/images/inventoriassets/supplier.png" alt="dh-karyawan">
                              <div class="right-line"><img src="<?=base_url()?>assets/images/inventoriassets/line.png" alt="line"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </a>
                  </div>                  
                  <!-- Card Barang Masuk -->
                  <div class="col-md-4 col-sm-6">
                    <a href="#" id="cardpmg">
                      <div class="card widget-hover overflow-hidden">
                        <div class="card-header card-no-border pb-2">
                            <h5>Barang Gudang</h5>
                        </div>
                        <div class="card-body pt-0 count-student">
                            <div class="school-wrapper"> 
                              <div class="school-header">
                                  <div class="spinner-border text-primary d-none" role="status" id="spinnpmg">
                                      <span class="visually-hidden"></span>
                                  </div>
                                  <h4 class="txt-primary" id="pm"></h4>
                                  <div class="d-flex gap-1 align-items-center flex-wrap pt-xxl-0 pt-2">
                                      <p class="text-muted">Realtime Updated</p>
                                  </div>
                              </div>
                              <div class="school-body"> <img src="<?=base_url()?>assets/images/inventoriassets/icon-produk-masuk.png" alt="produk-dh-masuk">
                                  <div class="right-line"><img src="<?=base_url()?>assets/images/inventoriassets/line.png" alt="line"></div>
                              </div>
                            </div>
                        </div>
                      </div>
                    </a>
                  </div>
                  <!-- Card Barang Keluar -->
                  <div class="col-md-4 col-sm-6">
                    <a href="#" id="cardpk">
                      <div class="card widget-hover overflow-hidden">
                        <div class="card-header card-no-border pb-2">
                          <h5>Barang Cabang</h5>
                        </div>
                        <div class="card-body pt-0 count-student">
                          <div class="school-wrapper"> 
                            <div class="school-header">
                              <div class="spinner-border text-primary d-none" role="status" id="spinpk">
                                  <span class="visually-hidden"></span>
                              </div>
                              <h4 class="txt-primary" id="pk"></h4>
                              <div class="d-flex gap-1 align-items-center flex-wrap pt-xxl-0 pt-2">
                                  <p class="text-muted">Realtime Updated</p>
                              </div>
                            </div>
                            <div class="school-body"> <img src="<?=base_url()?>assets/images/inventoriassets/icon-produk-keluar.png" alt="produk-dh-keluar">
                              <div class="right-line"><img src="<?=base_url()?>assets/images/inventoriassets/line.png" alt="line"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </a>
                  </div>
                  <!-- Card Total Barang -->
                  <div class="col-md-4 col-sm-6">
                    <a href="#" id="cardtpp">
                      <div class="card widget-hover overflow-hidden">
                        <div class="card-header card-no-border pb-2">
                          <h5>Total Barang Gudang</h5>
                        </div>
                        <div class="card-body pt-0 count-student">
                          <div class="school-wrapper"> 
                            <div class="school-header">
                              <div class="spinner-border text-primary d-none" role="status" id="spintpp">
                                  <span class="visually-hidden"></span>
                              </div>
                              <h4 class="txt-primary" id="tp"></h4>
                              <div class="d-flex gap-1 align-items-center flex-wrap pt-xxl-0 pt-2">
                                  <p class="text-muted">Realtime Updated</p>
                              </div>
                            </div>
                            <div class="school-body"> <img src="<?=base_url()?>assets/images/inventoriassets/icon-total-produk.png" alt="total-produk-dh">
                              <div class="right-line"><img src="<?=base_url()?>assets/images/inventoriassets/line.png" alt="line"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </a>
                  </div>
                  <?php foreach ($setcabang as $sc) { ?>
                    <div class="col-md-4 col-sm-6">
                      <a href="#" class="cardLink" data-bs-toggle="modal" data-bs-target="#DetailProdukCab" data-id="<?=$sc['id_toko']?>" data-cabang="<?=$sc['nama_toko']?>">
                        <div class="card widget-hover overflow-hidden">
                          <div class="card-header card-no-border pb-2">
                            <h5 id="id_toko" data-id="<?=$sc['id_toko']?>">Barang Cabang <?=$sc['nama_toko']?></h5>
                          </div>
                          <div class="card-body pt-0 count-student">
                            <div class="school-wrapper"> 
                              <div class="school-header" data-id="<?=$sc['id_toko']?>">
                                  <div class="spinner-border text-primary d-none spinst" role="status" id="spinst-<?=$sc['id_toko']?>">
                                      <span class="visually-hidden">Memuat...</span>
                                  </div>
                                  <h4 class="txt-primary counting counst" id="counst-<?=$sc['id_toko']?>"></h4>
                                  <div class="d-flex gap-1 align-items-center flex-wrap pt-xxl-0 pt-2">
                                      <p class="text-muted"><?=$sc['id_toko']?></p>
                                  </div>
                              </div>
                              <div class="school-body"> <img src="<?=base_url()?>assets/images/inventoriassets/store.png" alt="store-produk-dh">
                                <div class="right-line"><img src="<?=base_url()?>assets/images/inventoriassets/line.png" alt="line"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </a>
                    </div>
                  <?php } ?>
                </div>
              </div>
            </div>
            <div class="modal fade bd-example-modal-xl" id="DetailLaba" tabindex="-1" role="dialog" aria-labelledby="DetailLaba" aria-hidden="true">
              <div class="modal-dialog modal-xl" role="document">
                  <div class="modal-content dark-sign-up">
                      <div class="modal-body social-profile text-start" style="max-height: 95vh; overflow-y: auto;">
                          <div class="modal-toggle-wrapper">
                              <div class="modal-header mb-4">
                                  <h3>Detail Laba Bersih Bulan Ini</h3>
                                  <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <!-- Isi Konten -->
                              <ul class="list-group">
                                  <!-- Total -->
                                  <li class="list-group-item d-flex justify-content-between align-items-center">
                                      <strong><span>Filter Data</span></strong>
                                      <!-- <strong><input type="month" class="form-control digits" id="fdlb" name="fdlb" min="2024-01" /></strong> -->
                                      <strong><input class="form-control" id="fdlb" type="date" style="width: 100%;"></strong>
                                  </li>
                                  <li class="list-group-item d-flex justify-content-between align-items-center">
                                      <strong><span>Total Laba Bersih</span></strong>
                                      <strong id="tlk">-</strong>
                                  </li>
                                  <li class="list-group-item d-flex justify-content-between align-items-center">
                                      <strong><span>Total Harga HPP</span></strong>
                                      <strong id="tlh">-</strong>
                                  </li>
                                  <li class="list-group-item d-flex justify-content-between align-items-center">
                                      <strong><span>Total Penjualan</span></strong>
                                      <strong id="tlp">-</strong>
                                  </li>
                                  <li class="list-group-item d-flex justify-content-between align-items-center">
                                      <strong><span>Total Pendapatan Jasa</span></strong>
                                      <strong id="tpj">-</strong>
                                  </li>                                  
                                  <li class="list-group-item d-flex justify-content-between align-items-center">
                                      <strong><span>Total Diskon</span></strong>
                                      <strong id="tld">-</strong>
                                  </li>
                                  <li class="list-group-item d-flex justify-content-between align-items-center">
                                      <strong><span>Total Cashback</span></strong>
                                      <strong id="tlc">-</strong>
                                  </li>
                              </ul>
                              <!-- Data Table -->
                              <div class="col-lg-12"> 
                                  <div class="card"> 
                                      <div class="card-body">
                                      <div class="table-responsive">
                                          <table class="display" id="table-laba">
                                              <thead>
                                                  <tr>
                                                      <th><span class="f-light f-w-600">INVOICE</span></th>
                                                      <th><span class="f-light f-w-600">SN PRODUK</span></th>
                                                      <th><span class="f-light f-w-600">NAMA PRODUK</span></th>
                                                      <th><span class="f-light f-w-600">HARGA HPP</span></th>
                                                      <th><span class="f-light f-w-600">HARGA JUAL</span></th>
                                                      <th><span class="f-light f-w-600">DISKON</span></th>
                                                      <th><span class="f-light f-w-600">CASHBACK</span></th>
                                                      <th><span class="f-light f-w-600">LABA UNIT</span></th>
                                                  </tr>
                                              </thead>
                                              <tbody>
                                              </tbody>
                                          </table>
                                          </div>                                            
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
            </div>
            <div class="modal fade bd-example-modal-xl" id="DetailProdukCab" tabindex="-1" role="dialog" aria-labelledby="DetailProdukCab" aria-hidden="true">
              <div class="modal-dialog modal-xl" role="document">
                  <div class="modal-content dark-sign-up">
                      <div class="modal-body social-profile text-start" style="max-height: 95vh; overflow-y: auto;">
                          <div class="modal-toggle-wrapper">
                              <div class="modal-header mb-4">
                                  <h3>Detail Produk <span id="dpcab"></span></h3>
                                  <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <!-- Isi Konten -->
                              <ul class="list-group">
                                  <!-- Total -->
                                  <li class="list-group-item d-flex justify-content-between align-items-center">
                                      <strong><span>Total Produk</span></strong>
                                      <strong id="tpc">-</strong>
                                  </li>
                              </ul>
                              <!-- Data Table -->
                              <div class="col-lg-12"> 
                                  <div class="card"> 
                                      <div class="card-body">
                                      <div class="table-responsive">
                                          <table class="display" id="table-prodc">
                                              <thead>
                                                  <tr>
                                                      <th><span class="f-light f-w-600">SN PRODUK</span></th>
                                                      <th><span class="f-light f-w-600">NAMA PRODUK</span></th>
                                                      <th><span class="f-light f-w-600">MERK</span></th>
                                                      <th><span class="f-light f-w-600">JENIS</span></th>
                                                      <th style="text-align:center;"><span class="f-light f-w-600">KONDISI</span></th>
                                                  </tr>
                                              </thead>
                                              <tbody>
                                              </tbody>
                                          </table>
                                          </div>                                            
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
            </div>            
            <div class="modal fade bd-example-modal-xl" id="DetailAssetProduk" tabindex="-1" role="dialog" aria-labelledby="DetailAssetProduk" aria-hidden="true">
              <div class="modal-dialog modal-xl" role="document">
                  <div class="modal-content dark-sign-up">
                      <div class="modal-body social-profile text-start" style="max-height: 95vh; overflow-y: auto;">
                          <div class="modal-toggle-wrapper">
                              <div class="modal-header mb-4">
                                  <h3>Detail Asset Produk</h3>
                                  <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <!-- Isi Konten -->
                              <ul class="list-group">
                                  <!-- Total -->
                                  <li class="list-group-item d-flex justify-content-between align-items-center">
                                      <strong><span>Total Asset Produk</span></strong>
                                      <strong id="tap">-</strong>
                                  </li>
                              </ul>
                              <!-- Data Table -->
                              <div class="col-lg-12"> 
                                  <div class="card"> 
                                      <div class="card-body">
                                      <div class="table-responsive">
                                          <table class="display" id="table-asset">
                                              <thead>
                                                  <tr>
                                                      <th><span class="f-light f-w-600">SN PRODUK</span></th>
                                                      <th><span class="f-light f-w-600">NAMA PRODUK</span></th>
                                                      <th><span class="f-light f-w-600">HPP PRODUK</span></th>
                                                      <th><span class="f-light f-w-600">CABANG</span></th>
                                                  </tr>
                                              </thead>
                                              <tbody>
                                              </tbody>
                                          </table>
                                          </div>                                            
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
            </div>
            <div class="modal fade bd-example-modal-xl" id="DetailAssetProdukCab" tabindex="-1" role="dialog" aria-labelledby="DetailAssetProdukCab" aria-hidden="true">
              <div class="modal-dialog modal-xl" role="document">
                  <div class="modal-content dark-sign-up">
                      <div class="modal-body social-profile text-start" style="max-height: 95vh; overflow-y: auto;">
                          <div class="modal-toggle-wrapper">
                              <div class="modal-header mb-4">
                                  <h3>Detail Asset Produk Tersedia <span id="dapc"></span></h3>
                                  <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <!-- Isi Konten -->
                              <ul class="list-group">
                                  <!-- Total -->
                                  <li class="list-group-item d-flex justify-content-between align-items-center">
                                      <strong><span>Total Asset Produk Tersedia</span></strong>
                                      <strong id="tapc">-</strong>
                                  </li>
                              </ul>
                              <!-- Data Table -->
                              <div class="col-lg-12"> 
                                  <div class="card"> 
                                      <div class="card-body">
                                      <div class="table-responsive">
                                          <table class="display" id="table-assetc">
                                              <thead>
                                                  <tr>
                                                      <th><span class="f-light f-w-600">SN PRODUK</span></th>
                                                      <th><span class="f-light f-w-600">NAMA PRODUK</span></th>
                                                      <th><span class="f-light f-w-600">HPP PRODUK</span></th>
                                                      <th><span class="f-light f-w-600">CABANG</span></th>
                                                  </tr>
                                              </thead>
                                              <tbody>
                                              </tbody>
                                          </table>
                                          </div>                                            
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
            </div>            
            <div class="modal fade bd-example-modal-xl" id="DetailSales" tabindex="-1" role="dialog" aria-labelledby="DetailSales" aria-hidden="true">
              <div class="modal-dialog modal-xl" role="document">
                  <div class="modal-content dark-sign-up">
                      <div class="modal-body social-profile text-start" style="max-height: 95vh; overflow-y: auto;">
                          <div class="modal-toggle-wrapper">
                              <div class="modal-header mb-4">
                                  <h3>Detail Penjualan Bulan Ini</h3>
                                  <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <!-- Isi Konten -->
                              <ul class="list-group">
                                  <!-- Total -->
                                  <li class="list-group-item d-flex justify-content-between align-items-center">
                                      <strong><span>Total Penjualan</span></strong>
                                      <strong id="totp">-</strong>
                                  </li>
                                  <li class="list-group-item d-flex justify-content-between align-items-center">
                                      <strong><span>Total Pendapatan Jasa</span></strong>
                                      <strong id="totj">-</strong>
                                  </li>
                              </ul>
                              <!-- Data Table -->
                              <div class="col-lg-12"> 
                                  <div class="card"> 
                                      <div class="card-body">
                                      <div class="table-responsive">
                                          <table class="display" id="table-sales">
                                              <thead>
                                                  <tr>
                                                      <th><span class="f-light f-w-600">INVOICE</span></th>
                                                      <th><span class="f-light f-w-600">SN PRODUK</span></th>
                                                      <th><span class="f-light f-w-600">NAMA PRODUK</span></th>
                                                      <th><span class="f-light f-w-600">HARGA JUAL</span></th>
                                                      <th><span class="f-light f-w-600">DISKON</span></th>
                                                      <th><span class="f-light f-w-600">CASHBACK</span></th>
                                                      <th><span class="f-light f-w-600">HARGA RILL</span></th>
                                                      <th><span class="f-light f-w-600">CABANG</span></th>
                                                  </tr>
                                              </thead>
                                              <tbody>
                                              </tbody>
                                          </table>
                                          </div>                                            
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
            </div>
            <div class="modal fade bd-example-modal-xl" id="DetailSalesProdukCab" tabindex="-1" role="dialog" aria-labelledby="DetailSalesProdukCab" aria-hidden="true">
              <div class="modal-dialog modal-xl" role="document">
                  <div class="modal-content dark-sign-up">
                      <div class="modal-body social-profile text-start" style="max-height: 95vh; overflow-y: auto;">
                          <div class="modal-toggle-wrapper">
                              <div class="modal-header mb-4">
                                  <h3>Detail Asset Produk Terjual <span id="datc"></h3>
                                  <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <!-- Isi Konten -->
                              <ul class="list-group">
                                  <!-- Total -->
                                  <li class="list-group-item d-flex justify-content-between align-items-center">
                                      <strong><span>Total Asset Produk Terjual</span></strong>
                                      <strong id="tapt">-</strong>
                                  </li>
                              </ul>
                              <!-- Data Table -->
                              <div class="col-lg-12"> 
                                  <div class="card"> 
                                      <div class="card-body">
                                      <div class="table-responsive">
                                          <table class="display" id="table-salesc">
                                              <thead>
                                                  <tr>
                                                      <th><span class="f-light f-w-600">SN PRODUK</span></th>
                                                      <th><span class="f-light f-w-600">NAMA PRODUK</span></th>
                                                      <th><span class="f-light f-w-600">HARGA JUAL</span></th>
                                                      <th><span class="f-light f-w-600">DISKON</span></th>
                                                      <th><span class="f-light f-w-600">CASHBACK</span></th>
                                                      <th><span class="f-light f-w-600">HARGA RILL</span></th>
                                                      <th><span class="f-light f-w-600">CABANG</span></th>
                                                  </tr>
                                              </thead>
                                              <tbody>
                                              </tbody>
                                          </table>
                                          </div>                                            
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
            </div>
            <div class="modal fade bd-example-modal-xl" id="DetailDiskon" tabindex="-1" role="dialog" aria-labelledby="DetailDiskon" aria-hidden="true">
              <div class="modal-dialog modal-xl" role="document">
                  <div class="modal-content dark-sign-up">
                      <div class="modal-body social-profile text-start" style="max-height: 95vh; overflow-y: auto;">
                          <div class="modal-toggle-wrapper">
                              <div class="modal-header mb-4">
                                  <h3>Detail Diskon Bulan Ini</h3>
                                  <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <!-- Isi Konten -->
                              <ul class="list-group">
                                  <!-- Total -->
                                  <li class="list-group-item d-flex justify-content-between align-items-center">
                                      <strong><span>Total Diskon</span></strong>
                                      <strong id="td">-</strong>
                                  </li>
                              </ul>
                              <!-- Data Table -->
                              <div class="col-lg-12"> 
                                  <div class="card"> 
                                      <div class="card-body">
                                      <div class="table-responsive">
                                          <table class="display" id="table-diskon">
                                              <thead>
                                                  <tr>
                                                  <th><span class="f-light f-w-600">SN PRODUK</span></th>
                                                    <th><span class="f-light f-w-600">NAMA PRODUK</span></th>
                                                    <th><span class="f-light f-w-600">DISKON</span></th>
                                                    <th><span class="f-light f-w-600">CABANG</span></th>
                                                  </tr>
                                              </thead>
                                              <tbody>
                                              </tbody>
                                          </table>
                                          </div>                                            
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
            </div>
            <div class="modal fade bd-example-modal-xl" id="DetailCust" tabindex="-1" role="dialog" aria-labelledby="DetailCust" aria-hidden="true">
              <div class="modal-dialog modal-xl" role="document">
                  <div class="modal-content dark-sign-up">
                      <div class="modal-body social-profile text-start" style="max-height: 95vh; overflow-y: auto;">
                          <div class="modal-toggle-wrapper">
                              <div class="modal-header mb-4">
                                  <h3>Detail Kustomer</h3>
                                  <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <!-- Isi Konten -->
                              <ul class="list-group">
                                  <!-- Total -->
                                  <li class="list-group-item d-flex justify-content-between align-items-center">
                                      <strong><span>Total Kustomer</span></strong>
                                      <strong id="tk">-</strong>
                                  </li>
                              </ul>
                              <!-- Data Table -->
                              <div class="col-lg-12"> 
                                  <div class="card"> 
                                      <div class="card-body">
                                      <div class="table-responsive">
                                          <table class="display" id="table-cust">
                                              <thead>
                                                  <tr>
                                                    <th><span class="f-light f-w-600">ID KUSTOMER</span></th>
                                                    <th><span class="f-light f-w-600">NAMA KUSTOMER</span></th>
                                                    <th><span class="f-light f-w-600">KONTAK KUSTOMER</span></th>
                                                    <th><span class="f-light f-w-600">EMAIL KUSTOMER</span></th>
                                                    <th><span class="f-light f-w-600">ALAMAT KUSTOMER</span></th>
                                                  </tr>
                                              </thead>
                                              <tbody>
                                              </tbody>
                                          </table>
                                          </div>                                            
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
            </div>
            <div class="modal fade bd-example-modal-xl" id="DetailCashback" tabindex="-1" role="dialog" aria-labelledby="DetailCashback" aria-hidden="true">
              <div class="modal-dialog modal-xl" role="document">
                  <div class="modal-content dark-sign-up">
                      <div class="modal-body social-profile text-start" style="max-height: 95vh; overflow-y: auto;">
                          <div class="modal-toggle-wrapper">
                              <div class="modal-header mb-4">
                                  <h3>Detail Cashback</h3>
                                  <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <!-- Isi Konten -->
                              <ul class="list-group">
                                  <!-- Total -->
                                  <li class="list-group-item d-flex justify-content-between align-items-center">
                                      <strong><span>Filter Data</span></strong>
                                      <!-- <strong><input type="month" class="form-control digits" id="fdcb" name="fdcb" min="2024-01" /></strong> -->
                                      <strong><input class="form-control" id="fdcb" type="date" style="width: 100%;"></strong>
                                  </li>
                                  <li class="list-group-item d-flex justify-content-between align-items-center">
                                      <strong><span>Total Cashback</span></strong>
                                      <strong id="tca">-</strong>
                                  </li>
                              </ul>
                              <!-- Data Table -->
                              <div class="col-lg-12"> 
                                  <div class="card"> 
                                      <div class="card-body">
                                      <div class="table-responsive">
                                          <table class="display" id="table-cb">
                                              <thead>
                                                  <tr>
                                                    <th><span class="f-light f-w-600">SN PRODUK</span></th>
                                                    <th><span class="f-light f-w-600">NAMA PRODUK</span></th>
                                                    <th><span class="f-light f-w-600">CASHBACK</span></th>
                                                    <th><span class="f-light f-w-600">SUPPLIER</span></th>
                                                  </tr>
                                              </thead>
                                              <tbody>
                                              </tbody>
                                          </table>
                                          </div>                                            
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
            </div>            
            <div class="modal fade bd-example-modal-xl" id="DetailUser" tabindex="-1" role="dialog" aria-labelledby="DetailUser" aria-hidden="true">
              <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content dark-sign-up">
                  <div class="modal-body social-profile text-start" style="max-height: 95vh; overflow-y: auto;">
                      <div class="modal-toggle-wrapper">
                          <div class="modal-header mb-4">
                              <h3>Detail Karyawan</h3>
                              <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <!-- Isi Konten -->
                          <ul class="list-group">
                              <!-- Total -->
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                  <strong><span>Total Karyawan</span></strong>
                                  <strong id="ttk">-</strong>
                              </li>
                          </ul>
                          <!-- Data Table -->
                          <div class="col-lg-12"> 
                              <div class="card"> 
                                  <div class="card-body">
                                  <div class="table-responsive">
                                      <table class="display" id="table-kar">
                                          <thead>
                                              <tr>
                                                  <th><span class="f-light f-w-600">ID KARYAWAN</span></th>
                                                  <th><span class="f-light f-w-600">NAMA KARYAWAN</span></th>
                                                  <th><span class="f-light f-w-600">CABANG</span></th>
                                              </tr>
                                          </thead>
                                          <tbody>
                                          </tbody>
                                      </table>
                                      </div>                                            
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
