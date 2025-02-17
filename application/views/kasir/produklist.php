        <!-- Begin Content -->
        <div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-6">
                  <h4>Produk List</h4>
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?=base_url()?>">                                       
                        <svg class="stroke-icon">
                          <use href="<?=base_url()?>assets/svg/icon-sprite.svg#stroke-home"></use>
                        </svg></a>
                    </li>
                    <li class="breadcrumb-item"> Home</li>
                    <li class="breadcrumb-item"> Applications</li>
                    <li class="breadcrumb-item"> Penjualan</li>
                    <li class="breadcrumb-item active"> Produk List</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <!-- Listing Produk -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header pb-0 card-no-border">
                            <div class="row">
                                <div class="col-md-4 position-relative">
                                    <select class="form-select" id="tipe" name="tipe" required="">
                                        <option selected="" value="0">Semua Tipe</option>
                                    </select>
                                </div>
                                <div class="col-md-4 position-relative">
                                    <select class="form-select" id="kondisi" name="kondisi" required="">
                                        <option selected="" value="0">Semua Kondisi</option>
                                    </select>
                                </div>
                                <div class="col-md-4 position-relative">
                                    <select class="form-select" id="cab" name="cab" required="">
                                        <option selected="" value="0">Semua Cabang</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="display" id="table-pl">
                                    <thead>
                                        <tr>
                                            <th style="min-width: 160px;"><span class="f-light f-w-600">SN PRODUK</span></th>
                                            <th style="min-width: 200px;"><span class="f-light f-w-600">NAMA PRODUK</span></th>
                                            <th style="min-width: 80px;"><span class="f-light f-w-600">KONDISI</span></th>
                                            <th style="min-width: 200px;"><span class="f-light f-w-600">CABANG</span></th>
                                            <th style="min-width: 200px;"><span class="f-light f-w-600">HARGA HPP</span></th>
                                            <th style="min-width: 160px;"><span class="f-light f-w-600">HARGA JUAL</span></th>
                                            <th style="min-width: 80px;"><span class="f-light f-w-600">STATUS</span></th>
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
                              <!-- <li class="list-group-item d-flex justify-content-between align-items-center">
                                  <span>Supplier</span>
                                  <strong id="H3TSUPP"></strong>
                              </li> -->
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
                              <!-- <li class="list-group-item d-flex justify-content-between align-items-center">
                                  <span>Tanggal Register</span>
                                  <strong id="dhdreg"></strong>
                              </li> -->
                              <!-- Waktu Register -->
                              <!-- <li class="list-group-item d-flex justify-content-between align-items-center">
                                  <span>Waktu Register</span>
                                  <strong id="dhtreg"></strong>
                              </li> -->
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
          </div>
          <!-- Container-fluid Ends-->
        </div>
        <!-- End Content -->