        <!-- Begin Content -->
        <div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-6">
                  <h4>Aplikasi Stock Opname</h4>
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
                    <li class="breadcrumb-item"> Data Barang</li>
                    <li class="breadcrumb-item active"> Stock Opname</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <!-- Card Status Data Barang -->
            <div class="row">
                <!-- Card Barang Masuk -->
                <div class="col-md-4 col-sm-6">
                  <a href="#" id="cardLink">
                    <div class="card widget-hover overflow-hidden">
                      <div class="card-header card-no-border pb-2">
                          <h5>Produk Masuk Gudang</h5>
                      </div>
                      <div class="card-body pt-0 count-student">
                          <div class="school-wrapper"> 
                            <div class="school-header">
                                <div class="spinner-border text-primary d-none" role="status" id="spinner">
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
                        <h5>Produk Keluar Gudang</h5>
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
                  <a href="#" id="cardtp">
                    <div class="card widget-hover overflow-hidden">
                      <div class="card-header card-no-border pb-2">
                        <h5>Total Produk</h5>
                      </div>
                      <div class="card-body pt-0 count-student">
                        <div class="school-wrapper"> 
                          <div class="school-header">
                            <div class="spinner-border text-primary d-none" role="status" id="spintp">
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
                <!-- Card Cabang -->
                <?php foreach ($setcabang as $sc) { ?>
                    <div class="col-md-4 col-sm-6">
                        <a href="#" class="cardLink" data-id="<?=$sc['id_toko']?>">
                            <div class="card widget-hover overflow-hidden">
                                <div class="card-header card-no-border pb-2">
                                <h5 id="id_toko" data-id="<?=$sc['id_toko']?>"><?=$sc['id_toko']?></h5>
                                </div>
                                <div class="card-body pt-0 count-student">
                                <div class="school-wrapper"> 
                                    <div class="school-header" data-id="<?=$sc['id_toko']?>">
                                        <div class="spinner-border text-primary d-none" role="status" id="spinner-<?=$sc['id_toko']?>">
                                            <span class="visually-hidden">Memuat...</span>
                                        </div>
                                        <h4 class="txt-primary counting" id="counting-<?=$sc['id_toko']?>"></h4>
                                        <div class="d-flex gap-1 align-items-center flex-wrap pt-xxl-0 pt-2">
                                            <p class="text-muted"><?=$sc['nama_toko']?></p>
                                        </div>
                                    </div>
                                    <div class="school-body"> <img src="<?=base_url()?>assets/images/inventoriassets/store-dh.png" alt="store-produk-dh">
                                    <div class="right-line"><img src="<?=base_url()?>assets/images/inventoriassets/line.png" alt="line"></div>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php } ?>
            </div>
            <!-- Listing Stock Opname -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                            <h4>Riwayat Stock Opname</h4>
                            <div class="d-flex align-items-center">
                                <a href="<?=base_url()?>stock-opname/tambah-stock-opname" class="btn btn-primary" target="_blank">
                                    <i class="fa fa-cubes"></i> Stock Opname Baru
                                </a>
                            </div>
                        </div>
                      <div class="card-body">
                        <div class="row mb-2">
                          <div class="col-md-6">
                            <label for="ftgl">Filter Tanggal Opname</label>
                            <input type="date" id="ftgl" class="form-control">
                          </div>
                        </div>
                        <div class="table-responsive">
                          <table class="display" id="table-ro">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>TANGGAL</th>
                                    <th>AUDITOR</th>
                                    <th>JABATAN</th>
                                    <th>NAMA CABANG</th>
                                    <th>PRODUK</th>
                                    <th>AKSI</th>
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
            <!-- End Listing Stock Opname -->
            <!-- Modal  -->
            <div class="modal fade bd-example-modal-xl" id="DetailStockopname" tabindex="-1" role="dialog" aria-labelledby="DetailStockopname" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content dark-sign-up">
                        <div class="modal-body social-profile text-start" style="max-height: 90vh; overflow-y: auto;">
                        <div class="modal-toggle-wrapper">
                          <div class="modal-header mb-4">
                              <h3>Detail Stockopname</h3>
                              <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="row">
                              <div class="col-lg-12">
                                  <div class="card">
                                      <div class="card-body">
                                      <div class="table-responsive">
                                          <table class="display" id="table-do">
                                          <thead>
                                              <tr>
                                                  <th>SN PRODUK</th>
                                                  <th>NAMA PRODUK</th>
                                                  <th>MEREK PRODUK</th>
                                                  <th>JENIS PRODUK</th>
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
            <!-- End Modal -->
          </div>
          <!-- Container-fluid Ends-->
        </div>
        <!-- End Content -->