        <!-- Begin Content -->
        <div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-6">
                  <h4>Order Masuk</h4>
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
                    <li class="breadcrumb-item"> Home</li>
                    <li class="breadcrumb-item"> Applications</li>
                    <li class="breadcrumb-item active"> Order Masuk</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
                <!-- Card Cabang -->
                <?php foreach ($setcabang as $sc) { ?>
                    <div class="col-md-4 col-sm-6">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#DetailPenjualan" class="cardLink" data-id="<?=$sc['id_toko']?>" data-total="<?=$sc['total_penjualan']?>" data-cabang="<?=$sc['nama_toko']?>">
                            <div class="card widget-hover overflow-hidden">
                                <div class="card-header card-no-border pb-2">
                                    <h5 id="id_toko" data-id="<?=$sc['id_toko']?>">Transaksi <?=$sc['nama_toko']?></h5>
                                </div>
                                <div class="card-body pt-0 count-student">
                                    <div class="school-wrapper"> 
                                        <div class="school-header" data-id="<?=$sc['id_toko']?>">
                                            <div class="spinner-border text-primary d-none" role="status" id="spinner-<?=$sc['id_toko']?>">
                                                <span class="visually-hidden">Memuat...</span>
                                            </div>
                                            <h4 class="txt-success counting" id="counting-<?=$sc['id_toko']?>">Rp <?=$sc['total_penjualan']?></h4>
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
            <!-- List Order Masuk -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header pb-0 card-no-border">
                            <div class="row">
                                <div class="col-md-8 position-relative">
                                    <h4>Daftar Order Masuk</h4>
                                </div>
                                <div class="col-md-4 position-relative">
                                    <select class="form-select" id="cab" name="cab" required="">
                                        <option selected="" disabled="" value="0">Semua Cabang</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="display" id="table-om">
                                    <thead>
                                        <tr>
                                            <th><span class="f-light f-w-600">INVOICE</span></th>
                                            <th><span class="f-light f-w-600">TGL & JAM</span></th>
                                            <th><span class="f-light f-w-600">KASIR</span></th>
                                            <th><span class="f-light f-w-600">CABANG</span></th>
                                            <th><span class="f-light f-w-600">TIPE</span></th>
                                            <th><span class="f-light f-w-600">PENJUALAN</span></th>
                                            <th><span class="f-light f-w-600">TOTAL</span></th>
                                            <th><span class="f-light f-w-600">AKSI</span></th>
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
          <div class="modal fade bd-example-modal-lg" id="DetailPenjualan" tabindex="-1" role="dialog" aria-labelledby="DetailPenjualan" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content dark-sign-up">
                    <div class="modal-body social-profile text-start" style="max-height: 95vh; overflow-y: auto;">
                        <div class="modal-toggle-wrapper">
                            <div class="modal-header mb-4">
                                <h3>Detail Transaksi Hari Ini</h3>
                                <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <!-- Isi Konten -->
                            <ul class="list-group">
                                <!-- Total -->
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <strong><span>Total Penjualan</span></strong>
                                    <strong id="odto">-</strong>
                                </li>
                            </ul>
                            <!-- Data Table -->
                            <div class="col-lg-12"> 
                                <div class="card"> 
                                    <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                                        <h5 id="cabdh">-</h5>
                                    </div>
                                    <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="display" id="table-dt">
                                            <thead>
                                                <tr>
                                                    <th><span class="f-light f-w-600">INVOICE</span></th>
                                                    <th><span class="f-light f-w-600">SN PRODUK</span></th>
                                                    <th><span class="f-light f-w-600">NAMA PRODUK</span></th>
                                                    <th><span class="f-light f-w-600">NOMINAL</span></th>
                                                    <th><span class="f-light f-w-600">JASA</span></th>
                                                    <th><span class="f-light f-w-600">KETERANGAN</span></th>
                                                    <th><span class="f-light f-w-600">PENJUALAN</span></th>
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
          <div class="modal fade bd-example-modal-xl" id="DetailInvoice" tabindex="-1" role="dialog" aria-labelledby="DetailInvoice" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content dark-sign-up">
                    <div class="modal-body social-profile text-start" style="max-height: 95vh; overflow-y: auto;">
                        <div class="modal-toggle-wrapper">
                            <div class="modal-header mb-4">
                                <h3>Detail Invoice <span id="noinv"></span></h3>
                                <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <strong><span>Kasir</span></strong>
                                    <strong id="adm">-</strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <strong><span>Sales</span></strong>
                                    <strong id="ksr">-</strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <strong><span>Customer</span></strong>
                                    <strong id="cst">-</strong>
                                </li>                                
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <strong><span>Tipe Pembayaran</span></strong>
                                    <strong id="tp">-</strong>
                                </li>
                                <li id="banktf" class="list-group-item d-flex justify-content-between align-items-center">
                                    <strong><span>Bank Penerima Transfer</span></strong>
                                    <strong id="bp">-</strong>
                                </li>
                                <li id="norektf" class="list-group-item d-flex justify-content-between align-items-center">
                                    <strong><span>Nomor Rekening</span></strong>
                                    <strong id="nr">-</strong>
                                </li>
                                <li id="tftn" class="list-group-item d-flex justify-content-between align-items-center">
                                    <strong><span>Nominal Tunai</span></strong>
                                    <strong id="tn">-</strong>
                                </li>
                                <li id="tftb" class="list-group-item d-flex justify-content-between align-items-center">
                                    <strong><span>Nominal Transfer</span></strong>
                                    <strong id="tb">-</strong>
                                </li>
                                <li id="tfkr" class="list-group-item d-flex justify-content-between align-items-center">
                                    <strong><span>Nominal Kredit</span></strong>
                                    <strong id="kr">-</strong>
                                </li>
                            </ul> 
                            <!-- Data Table -->
                            <div class="col-lg-12"> 
                                <div class="card"> 
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="display" id="table-dtiv">
                                                <thead>
                                                    <tr>
                                                        <th><span class="f-light f-w-600">SN PRODUK</span></th>
                                                        <th><span class="f-light f-w-600">NAMA PRODUK</span></th>
                                                        <th><span class="f-light f-w-600">KATEGORI</span></th>
                                                        <th><span class="f-light f-w-600">HARGA JUAL</span></th>
                                                        <th><span class="f-light f-w-600">DISKON</span></th>
                                                        <th><span class="f-light f-w-600">CASHBACK</span></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>                                            
                                    </div>
                                </div>
                            </div>
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <strong><span>Total Harga Jual</span></strong>
                                    <strong id="tt">-</strong>                                                           
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <strong>Jasa <span id="ketjasa"></span></strong>
                                    <strong id="nomjasa">-</strong>                                                           
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <strong><span>Total Diskon</span></strong>
                                    <strong id="di">-</strong>                                                              
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <strong><span>Total Cashback</span></strong>
                                    <strong id="cb">-</strong>                                                              
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <strong><span>Grand Total</span></strong>
                                    <strong id="gt">-</strong>                                                                        
                                </li>
                            </ul>                            
                        </div>
                    </div>
                </div>
            </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>
        <!-- End Content -->