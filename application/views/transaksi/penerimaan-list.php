        <!-- Begin Content -->
        <div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-6">
                  <h4>Laporan Penerimaan</h4>
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
                    <li class="breadcrumb-item"> Transaksi</li>
                    <li class="breadcrumb-item active"> Laporan Penerimaan</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <!-- Laporan Penerimaan -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                            <h4>Laporan Penerimaan </h4>
                                <div class="d-flex align-items-center">
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="display" id="table-penerimaan">
                                <thead>
                                    <tr>
                                        <th style="min-width: 20%; width: 20%;"><span class="f-light f-w-600">TANGGAL</span></th>
                                        <th style="min-width: 20%; width: 20%;"><span class="f-light f-w-600">NO FAKTUR</span></th>
                                        <th style="min-width: 20%; width: 20%;"><span class="f-light f-w-600">NAMA SUPPLIER</span></th>
                                        <th style="min-width: 30%; width: 30%;"><span class="f-light f-w-600">ALAMAT</span></th>
                                        <th style="min-width: 20%; width: 20%;"><span class="f-light f-w-600">NAMA PENERIMA</span></th>
                                        <th style="min-width: 10%; width: 10%;"><span class="f-light f-w-600">AKSI</span></th>
                                        <!-- <th style="min-width: 40%; width: 40%;"><span class="f-light f-w-600">DETAIL</span></th> -->
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
          <!-- Container-fluid Ends-->
        </div>
        <!-- End Content -->
         <!-- Modal  -->
         <div class="modal fade bd-example-modal-xl" id="DetailPenerimaan" tabindex="-1" role="dialog" aria-labelledby="DetailPenerimaan" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content dark-sign-up">
                        <div class="modal-body social-profile text-start" style="max-height: 90vh; overflow-y: auto;">
                        <div class="modal-toggle-wrapper">
                          <div class="modal-header mb-4">
                              <h3>Detail Penerimaan Barang</h3>
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
                                                  <th>KONDISI</th>
                                                  <th>STATUS</th>
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