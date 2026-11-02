        <!-- Begin Content -->
        <div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-6">
                  <h4>Data Master PPN</h4>
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?=base_url()?>">
                        <svg class="stroke-icon">
                          <use href="<?=base_url()?>assets/svg/icon-sprite.svg#stroke-home"></use>
                        </svg></a></li>
                    <li class="breadcrumb-item"> Home</li>
                    <li class="breadcrumb-item"> Data Master</li>
                    <li class="breadcrumb-item active"> Master PPN</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
              <!-- Form Tambah PPN -->
              <div class="row">
                  <div class="col-sm-12">
                      <div class="card">
                          <div class="card-body">
                              <form class="row g-2 needs-validation" id="form-ppn">
                                  <input type="hidden" id="ppn_id" name="ppn_id">
                                  <!-- Nama -->
                                  <div class="col-md-6 position-relative">
                                      <label class="form-label" for="nama">Nama PPN</label>
                                      <input class="form-control" id="nama" name="nama" type="text" placeholder="Masukkan Nama PPN" required>
                                  </div>
                                  <!-- Nilai -->
                                  <div class="col-md-6 position-relative">
                                      <label class="form-label" for="nilai">Nilai (%)</label>
                                      <input class="form-control" id="nilai" name="nilai" type="number" min="0" max="100" placeholder="0 - 100" required>
                                  </div>
                                  <!-- Submit PPN -->
                                  <div class="col-md-12 position-relative mt-3">
                                      <button class="btn btn-primary" id="tambah" type="button">Tambah PPN</button>
                                      <button class="btn btn-secondary ms-2" id="batal" type="button" style="display: none;">Batal</button>
                                  </div>
                              </form>
                          </div>
                      </div>
                  </div>
              </div>
              <!-- End Form Tambah PPN-->
              <!-- Data Listing PPN -->
              <div class="row">
                  <div class="col-sm-12">
                      <div class="card">
                        <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                          <h4>List Data PPN</h4>
                        </div>
                        <div class="card-body">
                          <div class="table-responsive">
                            <table class="display" id="table-ppn">
                              <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>NAMA</th>
                                    <th>NILAI</th>
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
              <!-- End Listing PPN -->
          </div>
        <!-- Container-fluid Ends-->
        </div>
        <!-- End Content -->
