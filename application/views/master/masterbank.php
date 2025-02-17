        <!-- Begin Content -->
        <div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-6">
                  <h4>Data Master Bank</h4>
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?=base_url()?>">                                       
                        <svg class="stroke-icon">
                          <use href="<?=base_url()?>assets/svg/icon-sprite.svg#stroke-home"></use>
                        </svg></a></li>
                    <li class="breadcrumb-item"> Home</li>
                    <li class="breadcrumb-item"> Data Master</li>
                    <li class="breadcrumb-item active"> Master Bank</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
              <!-- Form Tambah Bank -->
              <div class="row">
                  <!-- Form Bank -->
                  <div class="col-sm-12">
                      <div class="card">
                          <div class="card-body">
                              <form class="row g-2 needs-validation">
                                  <!-- Bank -->
                                  <div class="col-md-4 position-relative"> 
                                      <label class="form-label" for="bank">Bank</label>
                                      <select class="form-select" id="bank" name="nama_bank" required="">
                                          <option selected="" disabled="" value="0">Pilih Bank</option>
                                      </select>
                                  </div>
                                  <!-- Nomor Rekening -->
                                  <div class="col-md-4 position-relative"> 
                                      <label class="form-label" for="no_rek">Nomor Rekening</label>
                                      <input class="form-control" id="no_rek" name="no_rek" type="number" aria-label="no_rek" required>
                                  </div>
                                  <!-- Nama Rekening -->
                                  <div class="col-md-4 position-relative"> 
                                      <label class="form-label" for="nama_rek">Nama Rekening</label>
                                      <input class="form-control" id="nama_rek" name="nama_rek" type="text" aria-label="nama_rek" required>
                                  </div>
                                  <!-- Submit Bank -->
                                  <div class="col-md-12 position-relative">
                                      <button class="btn btn-primary" id="tambah" type="button">Tambah Bank</button>
                                  </div>
                              </form>
                          </div>
                      </div>
                  </div>
              </div>
              <!-- End Form Tambah Bank-->
              <!-- Data Listing Bank -->
              <div class="row">
                  <div class="col-sm-12">
                      <div class="card">
                        <div class="card-header pb-0 card-no-border">
                          <h4>List Data Bank</h4>
                        </div>
                        <div class="card-body">
                          <div class="table-responsive">
                            <table class="display" id="table-bank">
                              <thead>
                                <tr>
                                    <th>NO REKENING</th>
                                    <th>NAMA BANK</th>
                                    <th>NAMA REKENING</th>
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
              <!-- End Listing Bank -->
          </div>
        <!-- Container-fluid Ends-->
        </div>
        <!-- End Content -->