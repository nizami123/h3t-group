        <!-- Begin Content -->
        <div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-6">
                  <h4>Data Master Kustomer</h4>
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?=base_url()?>">                                       
                        <svg class="stroke-icon">
                          <use href="<?=base_url()?>assets/svg/icon-sprite.svg#stroke-home"></use>
                        </svg></a></li>
                    <li class="breadcrumb-item"> Home</li>
                    <li class="breadcrumb-item"> Data Master</li>
                    <li class="breadcrumb-item active"> Master Kustomer</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <!-- Form Tambah Supplier -->
            <div class="row">
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-body">
                    <form class="row g-3 needs-validation custom-input" novalidate="" method="post" action="<?=base_url()?>master-kustomer/simpan-data">
                    <!-- ID Kustomer -->
                    <div class="col-md-6 position-relative">
                        <label class="form-label" for="FormIDKustomer">ID Kustomer</label>
                        <input class="form-control" id="FormIDKustomer" name="id" value="<?= $newID ?>" type="text" placeholder="ID KUSTOMER TERISI OTOMATIS" required="" readonly>
                        <div class="valid-tooltip">Looks good!</div>
                        </div>
                    <!-- Nama Kustomer -->
                    <div class="col-md-6 position-relative">
                        <label class="form-label" for="FormNamaKustomer">Nama Kustomer</label>
                        <input class="form-control" id="FormNamaKustomer" name="nama" type="text" placeholder="Masukkan Nama Kustomer" required="">
                        <div class="valid-tooltip">Looks good!</div>
                    </div>
                    <!-- Alamat Email Kustomer -->
                    <div class="col-md-6 position-relative">
                        <label class="form-label" for="FormEmailKustomer">Email Kustomer</label>
                        <input class="form-control" id="FormEmailKustomer" name="email" type="email" placeholder="alamat@email.com">
                        <div class="valid-tooltip">Looks good!</div>
                    </div>
                    <!-- Kontak Kustomer -->
                    <div class="col-md-6 position-relative">
                        <label class="form-label" for="FormNomorKustomer">Kontak Kustomer</label>
                        <input class="form-control" id="FormNomorKustomer" name="wa" type="text" oninput="formatPhoneNumber(this)" placeholder="ex: 081220812206">
                        <div class="valid-tooltip">Looks good!</div>
                    </div>
                    <!-- Detai Alamat Kustomer -->
                    <div class="col-md-12 position-relative">
                        <label class="form-label" for="FormDetailAlamatKustomer">Detail Alamat Kustomer</label>
                        <input class="form-control" id="FormDetailAlamatKustomer" name="alamat" type="text" placeholder="contoh: Jl. Tamtama No 19">
                        <div class="valid-tooltip">Looks good!</div>
                    </div>
                    <!-- Button Tambah Kustomer Baru -->
                    <div class="col-12">
                        <button class="btn btn-primary" type="submit">Tambah Kustomer</button>
                    </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <!-- End Form Tambah Kustomer -->
            <!-- Listing Kustomer -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header pb-0 card-no-border">
                            <h4>List Data Kustomer</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="display" id="table-kustomer">
                                    <thead>
                                    <tr>
                                        <th>ID KUSTOMER</th>
                                        <th>NAMA</th>
                                        <th>KONTAK</th>
                                        <th>EMAIL</th>
                                        <th>ALAMAT</th>
                                        <th>TANGGAL LAHIR</th>
                                        <th>AGAMA</th>
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
            <!-- End Listing Kustomer -->
            <!-- Modal Edit Data Master -->
            <div class="modal fade" id="EditMasterKustomerModal" tabindex="-1" role="dialog" aria-labelledby="EditMasterKustomerModal" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content dark-sign-up">
                    <div class="modal-body social-profile text-start">
                      <div class="modal-toggle-wrapper">
                        <h3>Edit Kustomer</h3>
                        <form class="row g-3">
                        <!-- ID Supplier -->
                        <div class="col-md-6 position-relative">
                            <label class="form-label" for="FormIDKustomer">ID Kustomer</label>
                            <input class="form-control" id="eid" name="eid" type="text" placeholder="H3TSUPP-0001" disabled>
                        </div>
                        <!-- Nama Kustomer -->
                        <div class="col-md-6 position-relative">
                            <label class="form-label" for="FormNamaKustomer">Nama Kustomer</label>
                            <input class="form-control" id="enama" name="enama" type="text" placeholder="Masukkan Namma Kustomer">
                        </div>
                        <!-- Email Kustomer -->
                        <div class="col-md-6 position-relative">
                            <label class="form-label" for="FormPICKustomer">Email Kustomer</label>
                            <input class="form-control" id="emailkus" name="emailkus" type="email" placeholder="Masukkan Email Kustomer" required="">
                        </div>
                        <!-- Kontak Kustomer -->
                        <div class="col-md-6 position-relative">
                            <label class="form-label" for="FormNomorKustomer">Kontak Kustomer</label>
                            <input class="form-control" id="ekontak" name="ekontak" type="text" oninput="formatPhoneNumber(this)" placeholder="ex: 081220812206" required="">
                        </div>
                        <!-- Detai Alamat Kustomer -->
                        <div class="col-md-12 position-relative">
                            <label class="form-label" for="FormDetailAlamatKustomer">Detail Alamat Kustomer</label>
                            <input class="form-control" id="ealamat" name="ealamat" type="text" placeholder="contoh: Jl. Tamtama No 19" required="">
                        </div>
                        <!-- Button Simpan -->
                          <div class="col-12">
                            <button class="btn btn-primary" type="button" id="update" data-bs-dismiss="modal">Simpan Perubahan</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>
        <!-- End Content -->