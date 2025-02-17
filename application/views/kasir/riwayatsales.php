        <!-- Begin Content -->
        <div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-6">
                  <h4>Riwayat Penjualan</h4>
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
                    <li class="breadcrumb-item"> Penjualan</li>
                    <li class="breadcrumb-item active"> Riwayat Penjualan</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <!-- Riwayat Penjualan -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                            <h4>Laporan Penjualan </h4>
                                <div class="d-flex align-items-center">
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="display" id="table-jual">
                                <thead>
                                    <tr>
                                        <th style="min-width: 30%; width: 30%;"><span class="f-light f-w-600">INVOICE</span></th>
                                        <th style="min-width: 20%; width: 20%;"><span class="f-light f-w-600">TANGGAL & JAM</span></th>
                                        <th style="min-width: 30%; width: 30%;"><span class="f-light f-w-600">CABANG</span></th>
                                        <th style="min-width: 30%; width: 30%;"><span class="f-light f-w-600">KASIR</span></th>
                                        <th style="min-width: 40%; width: 40%;"><span class="f-light f-w-600">GRAND TOTAL</span></th>
                                        <th style="min-width: 20%; width: 20%;"><span class="f-light f-w-600">STATUS</span></th>
                                        <th style="min-width: 10%; width: 10%;"><span class="f-light f-w-600">DETAIL</span></th>
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
            <!-- Produk Terjual -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                            <h4>Laporan Produk Terjual </h4>
                                <div class="d-flex align-items-center">
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="display" id="table-prdj">
                                <thead>
                                    <tr>
                                        <th style="min-width: 100px;"><span class="f-light f-w-600">SN PRODUK</span></th>
                                        <th style="min-width: 200px;"><span class="f-light f-w-600">NAMA PRODUK</span></th>
                                        <th style="min-width: 100px;"><span class="f-light f-w-600">HARGA JUAL</span></th>
                                        <th style="min-width: 100px;"><span class="f-light f-w-600">DISKON</span></th>
                                        <th style="min-width: 100px;"><span class="f-light f-w-600">CASHBACK</span></th>
                                        <th style="min-width: 100px;"><span class="f-light f-w-600">HARGA RILL</span></th>
                                        <th style="min-width: 100px;"><span class="f-light f-w-600">HARGA HPP</span></th>
                                        <th style="min-width: 100px;"><span class="f-light f-w-600">LABA UNIT</span></th>
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
            <!-- Penjualan Sales -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                            <h4>Laporan Penjualan Sales</h4>
                                <div class="d-flex align-items-center">
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="display" id="table-sales">
                                <thead>
                                    <tr>
                                        <th style="min-width: 30%; width: 20%;"><span class="f-light f-w-600">SALES</span></th>
                                        <th style="min-width: 40%; width: 30%;"><span class="f-light f-w-600">TOTAL HARGA JUAL</span></th>
                                        <th style="min-width: 40%; width: 30%;"><span class="f-light f-w-600">TOTAL JASA</span></th>
                                        <th style="min-width: 40%; width: 30%;"><span class="f-light f-w-600">TOTAL DISKON</span></th>
                                        <th style="min-width: 40%; width: 30%;"><span class="f-light f-w-600">TOTAL CASHBACK</span></th>
                                        <th style="min-width: 40%; width: 40%;"><span class="f-light f-w-600">TOTAL PENJUALAN</span></th>
                                        <th style="min-width: 10%; width: 10%;"><span class="f-light f-w-600">DETAIL</span></th>
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
            <div class="modal fade bd-example-modal-xl" id="DetailLapPenjualan" tabindex="-1" role="dialog" aria-labelledby="DetailLapPenjualan" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content dark-sign-up">
                        <div class="modal-body social-profile text-start" style="max-height: 95vh; overflow-y: auto;">
                            <div class="modal-toggle-wrapper">
                                <div class="modal-header mb-4">
                                    <h3>Detail Invoice <span id="ttdi">-</span></h3>
                                    <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <!-- Isi Konten -->
                                <ul class="list-group">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <strong><span>Customer</span></strong>
                                        <strong id="ttcs">-</strong>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <strong><span>Tipe Pembayaran</span></strong>
                                        <strong id="tp">-</strong>
                                    </li>
                                    <li id="banktf" class="list-group-item d-flex justify-content-between align-items-center">
                                        <strong><span>Bank Penerima Transfer</span></strong>
                                        <strong id="bp">-</strong>
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
                                        <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                                            <h5 id="ttsales">-</h5>
                                        </div>
                                        <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="display" id="table-dtpn">
                                                <thead>
                                                    <tr>
                                                        <th style="min-width: 100px;"><span class="f-light f-w-600">SN PRODUK</span></th>
                                                        <th style="min-width: 200px;"><span class="f-light f-w-600">NAMA PRODUK</span></th>
                                                        <th style="min-width: 100px;"><span class="f-light f-w-600">HARGA JUAL</span></th>
                                                        <th style="min-width: 100px;"><span class="f-light f-w-600">DISKON</span></th>
                                                        <th style="min-width: 100px;"><span class="f-light f-w-600">CASHBACK</span></th>
                                                        <th style="min-width: 100px;"><span class="f-light f-w-600">HARGA RILL</span></th>
                                                        <th style="min-width: 100px;"><span class="f-light f-w-600">HARGA HPP</span></th>
                                                        <th style="min-width: 100px;"><span class="f-light f-w-600">LABA UNIT</span></th>
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
                                    <!-- Total -->
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <strong><span>Total Harga Jual</span></strong>
                                        <strong id="tthj">-</strong>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <strong>Keterangan : <span id="ketjasa"></span></strong>
                                        <strong id="nomjasa">-</strong>
                                    </li>                                    
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <strong><span>Total Diskon</span></strong>
                                        <strong id="ttds">-</strong>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <strong><span>Total Cashback</span></strong>
                                        <strong id="ttcb">-</strong>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <strong><span>Grand Total</span></strong>
                                        <strong id="ttgt">-</strong>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <strong><span>Total Laba Bersih</span></strong>
                                        <strong id="ttlb">-</strong>
                                    </li>                                    
                                </ul>
                                <div class="mt-4 text-center">
                                    <?php if ($this->session->userdata('jabatan')=='OWNER' || $this->session->userdata('jabatan')=='Finance') { ?>
                                    <button class="btn btn-primary" type="button" id="canceltrans" data-id="">Batalkan Transaksi</button>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade bd-example-modal-xl" id="DetailPenjualan" tabindex="-1" role="dialog" aria-labelledby="DetailPenjualan" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content dark-sign-up">
                        <div class="modal-body social-profile text-start" style="max-height: 95vh; overflow-y: auto;">
                            <div class="modal-toggle-wrapper">
                                <div class="modal-header mb-4">
                                    <h3>Detail Penjualan Sales</h3>
                                    <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <!-- Isi Konten -->
                                <ul class="list-group">
                                    <!-- Total Harga Jual -->
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <strong><span>Total Harga Jual</span></strong>
                                        <strong id="tthjs">-</strong>
                                    </li>
                                    <!-- Total Diskon -->
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <strong><span>Total Diskon</span></strong>
                                        <strong id="ttdis">-</strong>
                                    </li>
                                    <!-- Total Cashback -->
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <strong><span>Total Cashback</span></strong>
                                        <strong id="ttcbs">-</strong>
                                    </li>
                                    <!-- Subtotal -->
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <strong><span>Subtotal</span></strong>
                                        <strong id="ttst">-</strong>
                                    </li>                                    
                                    <!-- Total Jasa -->
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <strong><span>Total Jasa</span></strong>
                                        <strong id="ttjs">-</strong>
                                    </li>                                    
                                    <!-- Total Penjualan -->
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <strong><span>Total Penjualan</span></strong>
                                        <strong id="ttdh">-</strong>
                                    </li>
                                </ul>
                                <!-- Data Table -->
                                <div class="col-lg-12"> 
                                    <div class="card"> 
                                        <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                                            <h5 id="saldh">-</h5>
                                        </div>
                                        <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="display" id="table-dt">
                                                <thead>
                                                    <tr>
                                                        <th><span class="f-light f-w-600">INVOICE</span></th>
                                                        <th><span class="f-light f-w-600">SN PRODUK</span></th>
                                                        <th><span class="f-light f-w-600">NAMA PRODUK</span></th>
                                                        <th><span class="f-light f-w-600">HARGA JUAL</span></th>
                                                        <th><span class="f-light f-w-600">DISKON</span></th>
                                                        <th><span class="f-light f-w-600">CASHBACK</span></th>
                                                        <th><span class="f-light f-w-600">HARGA RILL</span></th>
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
            <div class="modal fade" id="InfoDetail" tabindex="-1" role="dialog" aria-labelledby="InfoDetail" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content dark-sign-up">
                      <div class="modal-body social-profile text-start" style="border-radius:5%; max-height: 90vh; overflow-y: auto;">
                      <div class="modal-toggle-wrapper">
                        <div class="modal-header mb-4">
                            <h3>Detail Info Produk</h3>
                            <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                          <ul class="list-group">
                              <!-- Cabang -->
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                  <span>Cabang</span>
                                  <strong id="prdcab"></strong>
                              </li>
                              <!-- Invoice -->
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                  <span>Invoice</span>
                                  <strong id="prdiv"></strong>
                              </li>
                              <!-- Tanggal -->
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                  <span>Tanggal</span>
                                  <strong id="prdtgl"></strong>
                              </li>
                              <!-- Kasir -->
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                  <span>Kasir</span>
                                  <strong id="prdks"></strong>
                              </li>
                              <!-- Sales -->
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                  <span>Sales</span>
                                  <strong id="prdsl"></strong>
                              </li>
                              <!-- Customer -->
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                  <span>Customer</span>
                                  <strong id="prdcst"></strong>
                              </li>
                          </ul>
                      </div>
                    </div>
                  </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>
        <!-- End Content -->