        <!-- Begin Content -->
        <div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-6">
                  <h4>Servis</h4>
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
                    <li class="breadcrumb-item active"> Servis</li>
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
                        <ul class="nav nav-tabs" id="servis-tab" role="tablist">
                          <li class="nav-item"><a class="nav-link active txt-primary" id="listservis-tab" data-bs-toggle="tab" href="#listservis" role="tab" aria-controls="listservis" aria-selected="true"><i class="fa fa-list-alt"></i>List Servis</a></li>
                        </ul>
                        <div class="tab-content" id="icon-tabContent">
                          <div class="tab-pane fade show active" id="listservis" role="tabpanel" aria-labelledby="listservis-tab">
                              <div class="dt-ext table-responsive mt-2">
                                <table class="display" id="table-listservis"></table>
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