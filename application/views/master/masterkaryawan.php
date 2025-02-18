        <!-- Begin Content -->
        <div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-6">
                  <h4>Data Master Karyawan</h4>
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?=base_url()?>">                                       
                        <svg class="stroke-icon">
                          <use href="<?=base_url()?>assets/svg/icon-sprite.svg#stroke-home"></use>
                        </svg></a></li>
                    <li class="breadcrumb-item"> Home</li>
                    <li class="breadcrumb-item"> Data Master</li>
                    <li class="breadcrumb-item active"> Master Karyawan</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <!-- Form Tambah Karyawan -->
            <div class="row">
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-body">
                    <form id="formkar" action="<?=base_url()?>master-karyawan/simpan-data" method="POST" class="row g-3 needs-validation custom-input" novalidate="" enctype="multipart/form-data">
                      <!-- ID Karyawan -->
                      <div class="col-md-6 position-relative">
                        <label class="form-label" for="FormIDKaryawan">ID Karyawan</label>
                        <input class="form-control" id="id2" value="<?= $newID ?>" name="id" type="text" placeholder="ID KARYAWAN TERISI OTOMATIS" readonly>
                        <div class="valid-tooltip">Looks good!</div>
                      </div>
                      <!-- Nama Karyawan -->
                      <div class="col-md-6 position-relative">
                        <label class="form-label" for="FormNamaKaryawan">Nama Karyawan</label>
                        <input class="form-control" id="nl" name="nl" type="text" placeholder="Masukkan Nama Karyawan" required>
                        <div class="invalid-tooltip">Form nama tidak boleh kosong</div>
                      </div>
                      <!-- Tanggal Lahir -->
                      <div class="col-md-6 position-relative">
                        <label class="form-label" for="FormTanggalLahirKaryawan">Tanggal Lahir</label>
                        <input class="form-control digits" id="tl2" name="tl" type="date" required>
                        <div class="invalid-tooltip">Tanggal lahir tidak valid</div>
                      </div>
                      <!-- Jenis Kelamin -->
                      <div class="col-md-6 position-relative">
                        <label class="form-label" for="FormJenisKelaminKaryawan">Jenis Kelamin</label>
                        <select class="form-select" id="jk" name="jk" required>
                            <option selected="" disabled="" value="">Pilih Jenis Kelamin ...</option>
                            <option value="Laki - Laki">Laki - Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                        <div class="invalid-tooltip">Silahkan Pilih Jenis Kelamin</div>
                      </div>
                      <!-- Alamat Email Karyawan -->
                      <div class="col-md-6 position-relative">
                        <label class="form-label" for="FormAlamatEmailKaryawan">Alamat Email</label>
                        <input class="form-control" id="email" name="email" type="email" placeholder="contoh : karyawan@email.com" required>
                        <div class="invalid-tooltip">Form email tidak boleh kosong</div>
                      </div>
                      <!-- Alamat Password Karyawan -->
                      <div class="col-md-6 position-relative">
                        <label class="form-label" for="FormAlamatPasswordKaryawan">Password Akses</label>
                        <input class="form-control" id="password" name="password" type="password" placeholder="Buat Password Karyawan" required>
                        <div class="invalid-tooltip">Form password tidak boleh kosong</div>
                      </div>
                      <div class="card-header">
                        <h4>Informasi Alamat</h4>
                        <p class="f-m-light mt-1">
                        <code>Berikut adalah formulir detail informasi alamat karyawan.</code>
                        </p>
                      </div>
                      <!-- Provinsi -->
                      <div class="col-md-6 position-relative">
                      <label class="form-label" for="FormProvinsi">Provinsi </label>
                      <select class="form-select" id="province" name="prov" required>
                          <option selected="" disabled="" value="">Pilih Provinsi ...</option>
                      </select>
                      <input class="form-control" type="hidden" name="prov_name" id="prov_name">
                      <div class="invalid-tooltip">Silahkan Pilih Provinsi.</div>
                      </div>
                      <!-- Kabupaten / Kota -->
                      <div class="col-md-6 position-relative">
                      <label class="form-label" for="FormKotaKab">Kota / Kabupaten</label>
                      <select class="form-select" id="kabupaten" name="kab" required>
                          <option selected="" disabled="" value="">Pilih Kota / Kab ...</option>
                      </select>
                      <input class="form-control" type="hidden" name="kab_name" id="kab_name">
                      <div class="invalid-tooltip">Silahkan Pilih Kota / Kab.</div>
                      </div>
                      <!-- Kecamatan -->
                      <div class="col-md-6 position-relative">
                      <label class="form-label" for="FormKecamatan">Kecamatan</label>
                      <select class="form-select" id="kecamatan" name="kec" required>
                          <option selected="" disabled="" value="">Pilih Kecamatan ...</option>
                      </select>
                      <input class="form-control" type="hidden" name="kec_name" id="kec_name">
                      <div class="invalid-tooltip">Silahkan Pilih Kecamatan.</div>
                      </div>
                      <!-- Kode Pos -->
                      <div class="col-md-6 position-relative">
                      <label class="form-label" for="FormKodePos">Kode Pos </label>
                      <input class="form-control" id="kode_pos" name="kode_pos" type="number" placeholder="contoh: 60293">
                      <div class="invalid-tooltip">Isi Kode Pos</div>
                      </div>
                      <!-- Detai Alamat -->
                      <div class="col-md-12 position-relative">
                      <label class="form-label" for="FormDetailAlamat">Detail Alamat</label>
                      <input class="form-control" id="alamat2" name="alamat" type="text" placeholder="contoh: Jl. Tamtama No 19" required>
                      <div class="valid-tooltip">Looks good!</div>
                      </div>
                      <div class="card-header">
                        <h4>Informasi Lanjutan</h4>
                        <p class="f-m-light mt-1">
                        <code>Berikut adalah formulir detail informasi lanjutan karyawan.</code>
                        </p>
                      </div>
                      <!-- Nomor Telpone -->
                      <div class="col-md-6 position-relative">
                        <label class="form-label" for="FormNoTelp">Nomor Whatsapp</label>
                        <div class="input-group has-validation">
                            <input class="form-control is-invalid" id="wa" name="wa" type="text" oninput="formatPhoneNumber(this)" placeholder="contoh: +6281220812206" required>
                        </div>
                      </div>
                      <!-- Upload CV -->
                      <div class="col-md-6 position-relative"> 
                        <label class="form-label" for="formFile">Upload Curiculum Vitae</label>
                        <input class="form-control" id="file" type="file" name="cv" accept=".pdf">
                        <div class="valid-tooltip">Max ukuran 10Mb</div>
                      </div>
                      <!-- Pilih Posisi -->
                      <div class="col-md-5 position-relative">
                        <label class="form-label" for="FormJabatanKaryawan">Jabatan Karyawan</label>
                        <select class="form-select" id="jabatan" name="jabatan" required>
                          <option selected="" disabled="" value="">Pilih Jabatan Karyawan ...</option>
                        </select>
                        <div class="invalid-tooltip">Silahkan Pilih Jabatan.</div>
                      </div>
                      <!-- Button Tambah -->
                      <div class="col-1">
                        <label class="form-label" for="shortcuttambahdata">Add New</label>
                        <div class="button">
                            <a class="btn badge-light-primary f-w-500" type="button" data-bs-toggle="modal" data-bs-target="#TambahJabatanBaru" onclick="changeInputName('SubKategoriItem', 'newjab')"><i class="fa fa-plus"></i></a>
                        </div>
                      </div>
                      <!-- Pilih Role -->
                      <div class="col-md-5 position-relative">
                        <label class="form-label" for="FormRoleKaryawan">Role Karyawan</label>
                        <select class="form-select" id="role" name="role" required>
                          <option selected="" disabled="" value="">Pilih Role Karyawan ...</option>
                        </select>
                        <div class="invalid-tooltip">Silahkan Pilih Role Karyawan.</div>
                      </div>
                      <!-- Button Tambah -->
                      <div class="col-1">
                        <label class="form-label" for="shortcuttambahdata">Add New</label>
                        <div class="button">
                            <a class="btn badge-light-primary f-w-500" type="button" data-bs-toggle="modal" data-bs-target="#TambahRoleBaru" onclick="changeInputName('SubKategoriItem', 'newrole')"><i class="fa fa-plus"></i></a>
                        </div>
                      </div>
                      <!-- Masukkan Gaji Karyawan -->
                      <!-- <div class="col-md-12 position-relative">
                        <label class="form-label" for="GajiKaryawan">Gaji Karyawan</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text">Rp</span>
                            <input class="form-control is-invalid" id="gaji" name="gaji" type="text" onkeyup="formatRupiah(this)" required>
                        </div>
                      </div> -->
                      <!-- Button Tambah Karyawan Baru -->
                      <div class="col-12 position-relative mt-4">
                      <button class="btn btn-primary" type="submit" id="addkar">Tambah Karyawan</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <!-- End Form Tambah Karyawan-->
            <!-- Listing Karyawn -->
            <div class="row">
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header pb-0 card-no-border">
                    <h4>List Data Karyawan</h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="display" id="table-karyawan">
                        <thead>
                          <tr>
                            <th style="min-width: 120px;">ID KARYAWAN</th>
                            <th style="min-width: 150px;">NAMA KARYAWAN</th>
                            <th style="min-width: 180px;">JABATAN KARYAWAN</th>
                            <th style="min-width: 150px;">ROLE KARYAWAN</th>
                            <!-- <th style="min-width: 100px;">GAJI POKOK</th> -->
                            <th>DOC.KARYAWAN</th>
                            <th>CP.KARYAWAN</th>
                            <th style="min-width: 150px;">EMAIL KARYAWAN</th>
                            <th>PASSWORD</th>
                            <th>STATUS</th>
                            <th style="text-align: center;">Aksi</th>
                          </tr>
                        </thead>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- End Listing Karyawan -->
          </div>
          <!-- Container-fluid Ends-->
        </div>
        <!-- End Content -->