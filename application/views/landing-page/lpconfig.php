        <!-- Begin Content -->
        <div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-6">
                  <h4>Landing Page</h4>
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
                    <li class="breadcrumb-item"> Applications</li>
                    <li class="breadcrumb-item active"> Landing Page</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
              <!-- <div class="row">
                  <div class="col-lg-12">
                      <div class="card">
                          <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                              <h4>List Servis </h4>
                                  <div class="d-flex align-items-center">
                              </div>
                          </div>
                          <div class="card-body">
                              <div class="table-responsive">
                                  <table class="display" id="table-servis">
                                  <thead>
                                      <tr>
                                          <th style="min-width: 10%; width: 10%;"><span class="f-light f-w-600">SN Produk</span></th>
                                          <th style="min-width: 30%; width: 20%;"><span class="f-light f-w-600">IMEI</span></th>
                                          <th style="min-width: 20%; width: 20%;"><span class="f-light f-w-600">Nama Barang</span></th>
                                          <th style="min-width: 30%; width: 30%;"><span class="f-light f-w-600">Merk</span></th>
                                          <th style="min-width: 30%; width: 30%;"><span class="f-light f-w-600">Aksi</span></th>
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
              <div class="modal fade bd-example-modal-xl" id="modalsView" tabindex="-1" role="dialog" aria-labelledby="modalsView" aria-hidden="true">
                <div class="modal-dialog modal-fullscreen" role="document">
                  <div class="modal-content dark-sign-up">
                      <div class="modal-header social-profile text-start">
                          <h3 id="titleMod"></h3>
                          <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body social-profile text-start">

                      </div>
                      <div class="modal-footer social-profile text-start">
                      </div>
                  </div>
                </div>
              </div> -->
              <!-- NEW SERVIS -->
              <div class="row">
                <div class="col-md-12">
                  <div class="card">
                    <div class="m-2">
                        <ul class="nav nav-tabs" id="icon-tab" role="tablist">
                            <li class="nav-item"><a class="nav-link active txt-primary" id="banner-tab" data-bs-toggle="tab" href="#banner" role="tab" aria-controls="banner" aria-selected="true"><i class="icofont icofont-archive"></i>Banner Website</a></li>
                            <li class="nav-item"><a class="nav-link txt-primary" id="produk-tab" data-bs-toggle="tab" href="#produk" role="tab" aria-controls="produk" aria-selected="false"><i class="icofont icofont-archive"></i>Produk</a></li>
                            <li class="nav-item"><a class="nav-link txt-primary" id="config-tab" data-bs-toggle="tab" href="#config" role="tab" aria-controls="config" aria-selected="false"><i class="icofont icofont-archive"></i>Konfigurasi Website</a></li>
                        </ul>
                        <div class="tab-content" id="icon-tabContent">
                          <div class="tab-pane fade show active" id="banner" role="tabpanel" aria-labelledby="banner-tab">
                              <div class="row">
                                <div class="col-md-12 position-relative mt-2">
                                  <label>Nama Banner</label>
                                  <input class="form-control" type="text" id="banner_name" name="banner_name" placeholder="Nama Banner">
                                </div>
                                <div class="col-md-12 position-relative mt-2">
                                  <label>Banner</label>
                                  <input class="form-control" type="file" id="banner_image" name="banner_image" placeholder="Gambar Banner" accept="image/*">
                                  <div class="mt-2">
                                    <img
                                        id="imagePreview"
                                        class="img-thumbnail"
                                        style="
                                            display:none;
                                            width:100%;
                                            height:50%;
                                            object-fit:cover;
                                        "
                                    >
                                  </div>
                                </div>
                                <div class="col-md-12 position-relative mt-2">
                                  <button class="btn btn-primary" id="btnAddBanner">Tambah Banner</button>
                                </div>
                                <div class="col-md-12 position-relative dt-ext mt-2">
                                  <div class="table-responsive">
                                    <table class="display table table-striped table-bordered w-100" id="table-lpbanner" style="white-space: normal !important; word-wrap: break-word;"></table>
                                  </div>
                                </div>
                              </div>
                          </div>
                          <div class="tab-pane fade" id="produk" role="tabpanel" aria-labelledby="produk-tab">
	                          <div class="row">
	                            <input type="hidden" id="produk_id" name="produk_id" value="">
	                            <div class="col-md-6 position-relative mt-2">
	                              <label>Nama Produk</label>
	                              <input class="form-control" type="text" id="produk_name" name="produk_name" placeholder="Nama Produk">
	                            </div>
	                            <div class="col-md-6 position-relative mt-2">
	                              <label>Harga Produk</label>
	                              <input class="form-control" type="text" id="produk_price" name="produk_price" placeholder="Harga Produk" onkeyup="formatRupiah(this)">
	                            </div>
	                            <div class="col-md-12 position-relative mt-2">
	                              <label>Deskripsi Produk</label>
	                              <textarea class="form-control" id="produk_description" name="produk_description" placeholder="Deskripsi Produk"></textarea>
	                            </div>
	                            <div class="col-md-12 position-relative mt-2">
	                              <label>Whatsapp Deskripsi</label>
	                              <textarea class="form-control" id="wa_desc" name="wa_desc" placeholder="Whatsapp Deskripsi"></textarea>
	                            </div>
	                            <div class="col-md-12 position-relative mt-2">
	                              <label>Produk</label>
	                              <input class="form-control" type="file" id="produk_image" name="produk_image" placeholder="Gambar Produk" accept="image/*">
	                              <div class="mt-2">
	                                <img
	                                    id="prdPreview"
	                                    class="img-thumbnail"
	                                    style="
	                                        display:none;
	                                        width:25%;
	                                        object-fit:cover;
	                                    "
	                                >
	                              </div>
	                            </div>
	                            <div class="col-md-12 position-relative mt-2">
	                              <button class="btn btn-primary" id="btnAddProduk">Tambah Produk</button>
	                              <button class="btn btn-secondary ms-2" id="btnCancelProduk" type="button" style="display:none;">Batal</button>
	                            </div>
	                            <div class="col-md-12 position-relative dt-ext mt-2">
	                              <div class="table-responsive">
	                                <table class="display table table-striped table-bordered w-100" id="table-lpproduk" style="white-space: normal !important; word-wrap: break-word;"></table>
	                              </div>
	                            </div>
	                          </div>
                          </div>
                          <div class="tab-pane fade" id="config" role="tabpanel" aria-labelledby="config-tab">
                          	<div class="row">
	                            <div class="col-md-12 position-relative mt-2">
	                              <label>Nama Config</label>
	                              <input class="form-control" type="text" id="config_name" name="config_name" placeholder="Nama Config">
	                            </div>
	                            <div class="col-md-12 position-relative mt-2">
	                              <label>Detail Config</label>
	                              <div class="mb-2">
	                                <div class="form-check form-check-inline radio radio-primary">
	                                  <input class="form-check-input" type="radio" name="inputTypeSwitch" id="radioInput" value="input" checked>
	                                  <label class="form-check-label mb-0" for="radioInput">Input</label>
	                                </div>
	                                <div class="form-check form-check-inline radio radio-primary">
	                                  <input class="form-check-input" type="radio" name="inputTypeSwitch" id="radioTextarea" value="textarea">
	                                  <label class="form-check-label mb-0" for="radioTextarea">Textarea</label>
	                                </div>
	                              </div>
	                              <div id="inputContainer">
	                                  <input class="form-control" type="text" id="detail_config_input" name="detail_config" placeholder="Detail Config (Input)">
	                              </div>
	                              <div id="textareaContainer" style="display: none;">
	                                  <textarea class="form-control" id="detail_config_textarea" name="detail_config" rows="3" placeholder="Detail Config (Textarea)"></textarea>
	                              </div>
	                            </div>
	                            <div class="col-md-12 position-relative mt-2">
	                              <button class="btn btn-primary" id="btnAddConfig">Tambah Config</button>
	                            </div>
	                            <div class="col-md-12 position-relative dt-ext mt-2">
	                              <div class="table-responsive">
	                                <table class="display table table-striped table-bordered w-100" id="table-lpconfig" style="white-space: normal !important; word-wrap: break-word;"></table>
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
          <!-- Container-fluid Ends-->
        </div>
        <!-- End Content -->
