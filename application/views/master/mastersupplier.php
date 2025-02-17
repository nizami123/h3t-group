        <!-- Begin Content -->
        <div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-6">
                  <h4>Data Master Supplier</h4>
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?=base_url()?>">                                       
                        <svg class="stroke-icon">
                          <use href="<?=base_url()?>assets/svg/icon-sprite.svg#stroke-home"></use>
                        </svg></a></li>
                    <li class="breadcrumb-item"> Home</li>
                    <li class="breadcrumb-item"> Data Master</li>
                    <li class="breadcrumb-item active"> Master Supplier</li>
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
                    <form class="row g-3 needs-validation custom-input" novalidate="" method="post" action="<?=base_url()?>master-supplier/simpan-data">
                    <!-- ID Supplier-->
                    <div class="col-md-6 position-relative">
                        <label class="form-label" for="FormIDSupplier">ID Supplier</label>
                        <input class="form-control" id="id" name="id" type="text" value="<?=$newID?>" placeholder="ID SUPPLIER TERISI OTOMATIS" required="" readonly>
                        <div class="valid-tooltip">Looks good!</div>
                        </div>
                    <!-- Nama Supplier -->
                    <div class="col-md-6 position-relative">
                        <label class="form-label" for="FormNamaSupplier">Nama Supplier</label>
                        <input class="form-control" id="ns" name="ns" type="text" placeholder="Masukkan Nama Supplier" required="">
                        <div class="valid-tooltip">Looks good!</div>
                    </div>
                    <!-- PIC Supplier -->
                    <div class="col-md-6 position-relative">
                        <label class="form-label" for="FormPICSupplier">PIC Supplier</label>
                        <input class="form-control" id="pic" name="pic" type="text" placeholder="Masukkan Nama PIC Supplier" required="">
                        <div class="valid-tooltip">Looks good!</div>
                    </div>
                    <!-- Kontak Supplier -->
                    <div class="col-md-6 position-relative">
                        <label class="form-label" for="FormNomorSupplier">Kontak Supplier</label>
                        <input class="form-control" id="wa" name="wa" type="text" placeholder="ex: 081220812206" oninput="formatPhoneNumber(this)" required="">
                        <div class="valid-tooltip">Looks good!</div>
                    </div>
                    <!-- Provinsi Supplier -->
                    <div class="col-md-4 position-relative">
                    <label class="form-label" for="FormProvinsiSupplier">Provinsi Supplier</label>
                    <select class="form-select" id="province" name="prov" required="">
                        <option selected="" disabled="" value="">Pilih Provinsi ...</option>
                    </select>
                    <div class="invalid-tooltip">Silahkan Pilih Provinsi Supplier.</div>
                    <input class="form-control" type="hidden" name="prov_name" id="prov_name">
                    </div>
                    <!-- Kabupaten / Kota -->
                    <div class="col-md-4 position-relative">
                    <label class="form-label" for="FormKotaKabSupplier">Kota / Kabupaten Supplier</label>
                    <select class="form-select" id="kabupaten" name="kab" required="">
                        <option selected="" disabled="" value="">Pilih Kota / Kab ...</option>
                    </select>
                    <div class="invalid-tooltip">Silahkan Pilih Kota / Kab Supplier.</div>
                    <input class="form-control" type="hidden" name="kab_name" id="kab_name">
                    </div>
                    <!-- Kecamatan -->
                    <div class="col-md-4 position-relative">
                    <label class="form-label" for="FormKecamatanSupplier">Kecamatan Supplier</label>
                    <select class="form-select" id="kecamatan" name="kec" required="">
                        <option selected="" disabled="" value="">Pilih Kecamatan ...</option>
                    </select>
                    <div class="invalid-tooltip">Silahkan Pilih Kecamatan Supplier.</div>
                    <input class="form-control" type="hidden" name="kec_name" id="kec_name">
                    </div>
                    <!-- Detai Alamat Supplier -->
                    <div class="col-md-12 position-relative">
                        <label class="form-label" for="FormDetailAlamatSupplier">Detail Alamat Supplier</label>
                        <input class="form-control" id="alamat" name="alamat" type="text" placeholder="contoh: Jl. Tamtama No 19" required="">
                        <div class="valid-tooltip">Looks good!</div>
                    </div>
                    <!-- Button Tambah Supplier Baru -->
                    <div class="col-12">
                    <button class="btn btn-primary" type="submit">Tambah Supplier</button>
                    </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <!-- End Form Tambah Cabang-->
            <!-- Listing Cabang -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                      <div class="card-header pb-0 card-no-border">
                        <h4>List Data Supplier</h4>
                      </div>
                      <div class="card-body">
                        <div class="table-responsive">
                          <table class="display" id="table-supplier">
                            <thead>
                              <tr>
                                <th style="min-width: 100px;">ID SUPPLIER</th>
                                <th style="min-width: 180px;">NAMA SUPPLIER</th>
                                <th style="min-width: 100px;">PIC SUPPLIER</th>
                                <th style="min-width: 150px;">KONTAK SUPPLIER</th>
                                <th>PROVINSI</th>
                                <th style="min-width: 100px;">KAB / KOTA</th>
                                <th>KECAMATAN</th>
                                <th style="min-width: 200px;">DETAIL ALAMAT</th>
                                <th>STATUS</th>
                                <th style="text-align: center;">AKSI</th>
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
            <!-- End Listing Supplier -->
            <!-- Modal Edit Data Master -->
            <div class="modal fade" id="EditMasterSupplierModal" tabindex="-1" role="dialog" aria-labelledby="EditMasterSupplierModal" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content dark-sign-up">
                    <div class="modal-body social-profile text-start">
                      <div class="modal-toggle-wrapper">
                        <h3>Edit Master Data</h3>
                        <form class="row g-3">
                        <!-- ID Supplier -->
                        <div class="col-md-6 position-relative">
                            <label class="form-label" for="FormIDSupplier">ID Supplier</label>
                            <input class="form-control" id="eid" name="eid" type="text" placeholder="H3TSUPP-0001" disabled>
                        </div>
                        <!-- Nama Supplier -->
                        <div class="col-md-6 position-relative">
                            <label class="form-label" for="FormNamaSupplier">Nama Supplier</label>
                            <input class="form-control" id="enama" name="enama" type="text" placeholder="Masukkan Namma Supplier">
                        </div>
                        <!-- PIC Supplier -->
                        <div class="col-md-6 position-relative">
                            <label class="form-label" for="FormPICSupplier">PIC Supplier</label>
                            <input class="form-control" id="epic" name="epic" type="text" placeholder="Masukkan Nama PIC Supplier" required="">
                        </div>
                        <!-- Kontak Supplier -->
                        <div class="col-md-6 position-relative">
                            <label class="form-label" for="FormNomorSupplier">Kontak Supplier</label>
                            <input class="form-control" id="ekontak" name="ekontak" type="text" placeholder="ex: 081220812206" oninput="formatPhoneNumber(this)" required="">
                        </div>
                        <!-- Provinsi Supplier -->
                        <div class="col-md-6 position-relative">
                            <label class="form-label" for="FormProvinsiSupplier">Provinsi Supplier</label>
                            <input class="form-control" id="eprov" name="eprov" type="text" required="">
                        </div>
                        <!-- Kabupaten / Kota -->
                        <div class="col-md-6 position-relative">
                            <label class="form-label" for="FormKotaKabSupplier">Kota / Kabupaten Supplier</label>
                            <input class="form-control" id="ekot" name="ekot" type="text" required="">
                        </div>
                        <!-- Kecamatan -->
                        <div class="col-md-12 position-relative">
                            <label class="form-label" for="FormKecamatanSupplier">Kecamatan Supplier</label>
                            <input class="form-control" id="ekec" name="ekec" type="text" required="">
                        </div>
                        <!-- Detai Alamat Supplier -->
                        <div class="col-md-12 position-relative">
                            <label class="form-label" for="FormDetailAlamatSupplier">Detail Alamat Supplier</label>
                            <input class="form-control" id="ealamat" name="ealamat" type="text" placeholder="contoh: Jl. Tamtama No 19" required="">
                        </div>
                        <!-- Status Supplier -->
                        <div class="col-md-12 position-relative">
                            <label class="form-label" for="StatusSupplier">Status Supplier</label>
                            <select class="form-select" id="estatus" name="estatus" required="">
                                <option value="1">Aktif</option>
                                <option value="2">Tidak Aktif</option>
                            </select>
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