        <!-- Begin Content -->
        <div class="page-body">
            <div class="container-fluid">
                <div class="page-title">
                    <div class="row">
                        <div class="col-6">
                            <h4>Etalase Toko</h4>
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
                                <li class="breadcrumb-item active"> Etalase Toko</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Main Menu Etalase Toko -->
            <div class="container-fluid">
                <!-- Menu Etalase -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header pb-0 card-no-border">
                                <div class="row">
                                    <!-- filter -->
                                    <div class="col-md-4 position-relative">
                                        <select class="form-select" id="tipe" name="tipe" required="">
                                            <option selected="" disabled="" value="0">Pilih Tipe</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 position-relative">
                                        <select class="form-select" id="cabr" name="cabr" required="">
                                            <option selected="" disabled="" value="0">Pilih Cabang</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 position-relative">
                                        <select class="form-select" id="cab" name="cab" required="">
                                            <option selected="" disabled="" value="0">Pilih Supplier</option>
                                        </select>
                                    </div>
                                    <!-- filter -->
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="display" id="table-etalase">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th style="min-width: 150px;"><span class="f-light f-w-600">SN PRODUK</span></th>
                                            <th style="min-width: 200px;"><span class="f-light f-w-600">NAMA PRODUK</span></th>
                                            <th style="min-width: 200px;"><span class="f-light f-w-600">CABANG</span></th>
                                            <th style="min-width: 100px;"><span class="f-light f-w-600">SUPPLIER</span></th>
                                            <th style="min-width: 180px;"><span class="f-light f-w-600">COGS</span> <i class="fa fa-money"></i></th>
                                            <th style="min-width: 180px;"><span class="f-light f-w-600">PUB COST</span> </span> <i class="fa fa-money"></i></th>
                                            <th style="min-width: 100px;"><span class="f-light f-w-600">MARGIN %</span></th>
                                            <th style="min-width: 180px;"><span class="f-light f-w-600">CASHBACK</span> </span> <i class="fa fa-money"></i></th>
                                            <th class="text-center" style="min-width: 70px;"><span class="f-light f-w-600">INFO</span></th>
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
            <!-- Modal Detail Produk -->
            <div class="modal fade" id="InfoDetail" tabindex="-1" role="dialog" aria-labelledby="InfoDetail" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content dark-sign-up">
                      <div class="modal-body social-profile text-start" style="border-radius:5%; max-height: 90vh; overflow-y: auto;">
                      <div class="modal-toggle-wrapper">
                        <div class="modal-header mb-4">
                            <h3>Detail Info Barang</h3>
                            <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                          <ul class="list-group">
                              <!-- Barcode Produk -->
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                  <span>Barcode Produk</span>
                                  <strong>
                                    <div style="font-size:0;position:relative;width:90px;height:35px;">
                                        <img id="bardh" src="" alt="barcode-dh">
                                    </div>
                                  </strong>
                              </li>
                              <!-- SN Produk -->
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                  <span>SN Produk</span>
                                  <strong id="dhsn"></strong>
                              </li>
                              <!-- Suplier -->
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                  <span>Supplier</span>
                                  <strong id="H3TSUPP"></strong>
                              </li>
                              <!-- Nama Produk -->
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                  <span>Nama Produk</span>
                                  <strong id="dhnm"></strong>
                              </li>
                              <!-- Kondisi Produk -->
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                  <span>Kondisi Produk</span>
                                  <strong id="dhkon"></strong>
                              </li>
                              <!-- Merek Produk -->
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                  <span>Merek Produk</span>
                                  <strong id="dhmerk"></strong>
                              </li>
                              <!-- Jenis Produk -->
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                  <span>Jenis Produk</span>
                                  <strong id="dhjen"></strong>
                              </li>
                              <!-- Spesifikasi -->
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                  <span>Spesifikasi</span>
                                  <strong id="spek"></strong>
                              </li>
                              <!-- Tanggal Registrasi -->
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                  <span>Tanggal Register</span>
                                  <strong id="dhdreg"></strong>
                              </li>
                              <!-- Waktu Register -->
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                  <span>Waktu Register</span>
                                  <strong id="dhtreg"></strong>
                              </li>
                              <!-- Posisi Barang -->
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                  <span>Posisi Produk</span>
                                  <strong id="dhcab"></strong>
                              </li>
                          </ul>
                      </div>
                    </div>
                  </div>
              </div>
            </div>
            <!-- Modal Detail Produk Bekas -->
            <div class="modal fade" id="DetailProdukBekas" tabindex="-1" role="dialog" aria-labelledby="DetailProdukBekas" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content dark-sign-up">
                      <div class="modal-body social-profile text-start" style="border-radius:5%; max-height: 90vh; overflow-y: auto;">
                      <div class="modal-toggle-wrapper">
                          <div class="modal-header mb-4">
                              <h3>Detail Info Barang</h3>
                              <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <ul class="list-group">
                              <!-- Barcode Produk -->
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                  <span>Barcode Produk</span>
                                  <strong>
                                      <div style="font-size:0;position:relative;width:90px;height:35px;">
                                          <div style="background-color:black;width:2px;height:35px;position:absolute;left:0px;top:0">&nbsp;</div>
                                          <div style="background-color:black;width:1px;height:35px;position:absolute;left:3px;top:0">&nbsp;</div>
                                          <div style="background-color:black;width:1px;height:35px;position:absolute;left:6px;top:0">&nbsp;</div>
                                          <div style="background-color:black;width:1px;height:35px;position:absolute;left:11px;top:0">&nbsp;</div>
                                          <div style="background-color:black;width:4px;height:35px;position:absolute;left:13px;top:0">&nbsp;</div>
                                          <div style="background-color:black;width:1px;height:35px;position:absolute;left:19px;top:0">&nbsp;</div>
                                          <div style="background-color:black;width:1px;height:35px;position:absolute;left:22px;top:0">&nbsp;</div>
                                          <div style="background-color:black;width:1px;height:35px;position:absolute;left:27px;top:0">&nbsp;</div>
                                          <div style="background-color:black;width:2px;height:35px;position:absolute;left:30px;top:0">&nbsp;</div>
                                          <div style="background-color:black;width:1px;height:35px;position:absolute;left:33px;top:0">&nbsp;</div>
                                          <div style="background-color:black;width:4px;height:35px;position:absolute;left:35px;top:0">&nbsp;</div>
                                          <div style="background-color:black;width:1px;height:35px;position:absolute;left:41px;top:0">&nbsp;</div>
                                          <div style="background-color:black;width:1px;height:35px;position:absolute;left:44px;top:0">&nbsp;</div>
                                          <div style="background-color:black;width:1px;height:35px;position:absolute;left:49px;top:0">&nbsp;</div>
                                          <div style="background-color:black;width:2px;height:35px;position:absolute;left:52px;top:0">&nbsp;</div>
                                          <div style="background-color:black;width:1px;height:35px;position:absolute;left:55px;top:0">&nbsp;</div>
                                          <div style="background-color:black;width:2px;height:35px;position:absolute;left:57px;top:0">&nbsp;</div>
                                          <div style="background-color:black;width:1px;height:35px;position:absolute;left:63px;top:0">&nbsp;</div>
                                          <div style="background-color:black;width:2px;height:35px;position:absolute;left:66px;top:0">&nbsp;</div>
                                          <div style="background-color:black;width:1px;height:35px;position:absolute;left:70px;top:0">&nbsp;</div>
                                          <div style="background-color:black;width:1px;height:35px;position:absolute;left:75px;top:0">&nbsp;</div>
                                          <div style="background-color:black;width:2px;height:35px;position:absolute;left:77px;top:0">&nbsp;</div>
                                          <div style="background-color:black;width:3px;height:35px;position:absolute;left:82px;top:0">&nbsp;</div>
                                          <div style="background-color:black;width:1px;height:35px;position:absolute;left:86px;top:0">&nbsp;</div>
                                          <div style="background-color:black;width:2px;height:35px;position:absolute;left:88px;top:0">&nbsp;</div>
                                      </div>
                                  </strong>
                              </li>
                              <!-- ID Produk -->
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                  <span>ID Produk</span>
                                  <strong>H3T010201020503001</strong>
                              </li>
                              <!-- SN Produk -->
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                  <span>SN Produk</span>
                                  <strong>350944540625782</strong>
                              </li>
                              <!-- Suplier -->
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                  <span>Supplier</span>
                                  <strong>H3TSUPP-0002 | (TAM) Teletama Artha Mandiri</strong>
                              </li>
                              <!-- Nama Produk -->
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                  <span>Nama Produk</span>
                                  <strong>Iphone 12 Pro Max</strong>
                              </li>
                              <!-- Kondisi Produk -->
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                  <span>Kondisi Produk</span>
                                  <strong>BARU</strong>
                              </li>
                              <!-- Merek Produk -->
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                  <span>Merek Produk</span>
                                  <strong>Apple</strong>
                              </li>
                              <!-- Jenis Produk -->
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                  <span>Jenis Produk</span>
                                  <strong>Handphone</strong>
                              </li>
                              <!-- Penyimpanan -->
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                  <span>Penyimpanan</span>
                                  <strong>256 Gb</strong>
                              </li>
                              <!-- Variant Warna -->
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                  <span>Variant Warna</span>
                                  <strong>Midnight Blue</strong>
                              </li>
                              <!-- Tanggal Registrasi -->
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                  <span>Tanggal Register</span>
                                  <strong>23/01/2024</strong>
                              </li>
                              <!-- Waktu Register -->
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                  <span>Waktu Register</span>
                                  <strong>18:39:59</strong>
                              </li>
                              <!-- Posisi Barang -->
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                  <span>Posisi Produk</span>
                                  <strong>H3T-0001 | WTC Store</strong>
                              </li>
                              <!-- Catatan Tambahan -->
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                  <span class="accordion-item accordion-wrapper">
                                      <h2 class="accordion-header" id="outlineaccordionthree">
                                      <button class="accordion-button collapsed accordion-light-primary txt-danger" type="button" data-bs-toggle="collapse" data-bs-target="#left-collapseThree" aria-expanded="false" aria-controls="left-collapseThree">
                                          <strong>Catatan Tambahan Produk</strong>
                                      </button>
                                      </h2>
                                      <div class="accordion-collapse collapse" id="left-collapseThree" aria-labelledby="outlineaccordionthree" data-bs-parent="#outlineaccordion">
                                      <div class="accordion-body">
                                          <ul class="d-flex flex-column gap-3 accordions-content">
                                              <li>---------------------------------------------------------</li>
                                              <li>Kondisi Fisik 98%</li>
                                              <li>Lightning Cable Tidak Ada</li>
                                              <li>Setiap Enter nanti ganti paragraf</li>
                                              <li>Outputnya Kayak Gini Mas....</li>
                                          </ul>
                                      </div>
                                      </div>
                                  </span>
                              </li>
                          </ul>
                      </div>
                      </div>
                  </div>
              </div>
            </div>
        </div>
        <!-- End Content -->