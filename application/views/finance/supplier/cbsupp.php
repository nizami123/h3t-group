        <!-- Begin Content -->
        <div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-6">
                  <h4>CASHBACK SUPPLIER</h4>
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
                    <li class="breadcrumb-item active"> Cashback Supplier</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <!-- Listing Cashback -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header pb-0 card-no-border">
                            <h4>Data Cashback Supplier</h4>
                        </div>
                      <div class="card-body">
                        <div class="table-responsive">
                          <table class="display" id="table-cb">
                            <thead>
                                <tr>
                                    <th style="min-width: 100px;"><span class="f-light f-w-600">SUPPLIER ID</span></th>
                                    <th style="min-width: 250px;"><span class="f-light f-w-600">NAMA SUPPLIER</span></th>
                                    <th style="min-width: 180px;"><span class="f-light f-w-600">TOTAL CASHBACK</span></th>
                                    <th style="min-width: 50px;"><span class="f-light f-w-600">AKSI</span></th>
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
            <!-- End Listing Cashback -->
            <!-- Modal Daftar Cashback -->
            <div class="modal fade bd-example-modal-xl" id="InfoDetail" tabindex="-1" role="dialog" aria-labelledby="InfoDetail" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content dark-sign-up">
                        <div class="modal-body social-profile text-start" style="max-height: 90vh; overflow-y: auto;">
                        <div class="modal-toggle-wrapper">
                          <div class="modal-header mb-4">
                              <h3>Detail Produk Cashback</h3>
                              <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="display" id="table-detailcb">
                                                <thead>
                                                    <tr>
                                                        <th style="min-width: 20px;">#</th>
                                                        <!-- <th style="min-width: 20px;">BARCODE</th> -->
                                                        <th style="min-width: 100px;">SN PRODUK</th>
                                                        <th style="min-width: 180px;">NAMA PRODUK</th>
                                                        <th style="min-width: 50px;">KONDISI</th>
                                                        <th style="min-width: 100px;">CASHBACK</th>
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
            <!-- Modal List Produk -->
            <div class="modal fade bd-example-modal-xl" id="ListProduk" tabindex="-1" role="dialog" aria-labelledby="ListProduk" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content dark-sign-up">
                        <div class="modal-body social-profile text-start" style="max-height: 90vh; overflow-y: auto;">
                        <div class="modal-toggle-wrapper">
                          <div class="modal-header mb-4">
                              <h3>List Produk DH Tech</h3>
                              <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="display" id="table-detail">
                                                <thead>
                                                    <tr>
                                                        <th style="min-width: 20px;">#</th>
                                                        <!-- <th style="min-width: 20px;">BARCODE</th> -->
                                                        <th style="min-width: 100px;">SN PRODUK</th>
                                                        <th style="min-width: 180px;">NAMA PRODUK</th>
                                                        <th style="min-width: 50px;">KONDISI</th>
                                                        <th style="min-width: 100px;">CASHBACK</th>
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
            <!-- End Modal Daftar Cashback -->
          </div>
          <!-- Container-fluid Ends-->
        </div>
        <!-- End Content -->