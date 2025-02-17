            <!-- Modal Tambah Posisi Baru -->
            <div class="modal fade" id="TambahJabatanBaru" tabindex="-1" role="dialog" aria-labelledby="TambahJabatanBaru" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content dark-sign-up">
                  <div class="modal-body social-profile text-start">
                    <div class="modal-toggle-wrapper">
                      <h3>Tambah Jabatan Baru</h3>
                      <form class="row g-3">
                        <!-- Role Baru -->
                        <div class="col-md-12 position-relative">
                            <label class="form-label" for="FormJabatanKaryawan">Jabatan Karyawan</label>
                            <input class="form-control" id="jabkar" name="jabkar" type="text" placeholder="Input Jabatan Karyawan">
                        </div>
                        <!-- Button Simpan -->
                        <div class="col-12">
                          <button class="btn btn-primary" type="button" id="tambahjab">Simpan Perubahan</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Modal Tambah Role Baru -->
            <div class="modal fade" id="TambahRoleBaru" tabindex="-1" role="dialog" aria-labelledby="TambahRoleBaru" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content dark-sign-up">
                    <div class="modal-body social-profile text-start">
                      <div class="modal-toggle-wrapper">
                        <h3>Tambah Role Baru</h3>
                        <form class="row g-3">
                          <!-- Role Baru -->
                          <div class="col-md-12 position-relative">
                              <label class="form-label" for="FormRoleKaryawan">Role Karyawan</label>
                              <input class="form-control" id="rolekar" name="rolekar" type="text" placeholder="Input Role Karyawan">
                          </div>
                          <!-- Button Simpan -->
                          <div class="col-12">
                            <button class="btn btn-primary" type="button" id="tambahrole">Simpan Perubahan</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
            <!-- Modal Edit Karyawan -->
            <div class="modal fade bd-example-modal-xl" id="EditMasterKaryawan" tabindex="-1" role="dialog" aria-labelledby="EditMasterKaryawan" aria-hidden="true">
              <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                <div class="modal-content dark-sign-up">
                  <div class="modal-body social-profile text-start">
                    <div class="modal-toggle-wrapper">
                      <div class="modal-header mb-4">
                          <h3>Edit Master Data Karyawan</h3>
                          <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <form class="row g-3">
                        <!-- ID Karyawan -->
                        <div class="col-md-6 position-relative">
                          <label class="form-label" for="FormIDKaryawan">ID Karyawan</label>
                          <input class="form-control" id="e_id" name="e_id" type="text" placeholder="H3TEMP-0001" required="" readonly>
                          <div class="valid-tooltip">Looks good!</div>
                        </div>
                        <!-- Nama Karyawan -->
                        <div class="col-md-6 position-relative">
                            <label class="form-label" for="FormNamaKaryawan">Nama Karyawan</label>
                            <input class="form-control" id="e_nl" name="e_nl" type="text" placeholder="Masukkan Nama Karyawan" required="">
                        </div>
                        <!-- Tanggal Lahir -->
                        <div class="col-md-6 position-relative">
                          <label class="form-label" for="FormTanggalLahirKaryawan">Tanggal Lahir</label>
                          <input class="form-control digits" id="e_tl" name="e_tl" type="date">
                        </div>
                        <!-- Jenis Kelamin -->
                        <div class="col-md-6 position-relative">
                          <label class="form-label" for="FormJenisKelaminKaryawan">Jenis Kelamin</label>
                            <select class="form-select" id="e_jk" name="e_jk" required="">
                                <option selected="" disabled="" value="">Pilih Jenis Kelamin ...</option>
                                <option value="Laki - Laki">Laki - Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <!-- Alamat Email Karyawan -->
                        <div class="col-md-6 position-relative">
                          <label class="form-label" for="FormAlamatEmailKaryawan">Alamat Email</label>
                          <input class="form-control" id="e_email" name="e_email" type="email" placeholder="ex : karyawan@email.com" required="">
                        </div>
                        <!-- Alamat Password Karyawan -->
                        <div class="col-md-6 position-relative">
                          <label class="form-label" for="FormAlamatPasswordKaryawan">Password Akses</label>
                          <input class="form-control" id="e_password" name="e_password" type="text" placeholder="Buat Password Karyawan" required="">
                        </div>
                        <!-- Provinsi -->
                        <div class="col-md-6 position-relative">
                          <label class="form-label" for="FormProvinsi">Provinsi </label>
                          <input class="form-control" id="ex_prov" name="ex_prov" type="text"required="">
                        </div>
                        <!-- Kabupaten / Kota -->
                        <div class="col-md-6 position-relative">
                          <label class="form-label" for="FormKotaKab">Kota / Kabupaten</label>
                          <input class="form-control" id="ex_kab" name="ex_kab" type="text"required="">
                        </div>
                        <!-- Kecamatan -->
                        <div class="col-md-6 position-relative">
                          <label class="form-label" for="FormKecamatan">Kecamatan</label>
                          <input class="form-control" id="ex_kec" name="ex_kec" type="text" required="">
                        </div>
                        <!-- Kode Pos -->
                        <div class="col-md-6 position-relative">
                            <label class="form-label" for="FormKodePos">Kode Pos </label>
                            <input class="form-control" id="e_kode" name="e_kode" type="number" placeholder="contoh: 60293">
                            <div class="invalid-tooltip">Isi Kode Pos</div>
                        </div>
                        <!-- Detai Alamat -->
                        <div class="col-md-12 position-relative">
                          <label class="form-label" for="FormDetailAlamat">Detail Alamat</label>
                          <input class="form-control" id="e_alamat" name="e_alamat" type="text" placeholder="contoh: Jl. Tamtama No 19"  required="">
                        </div>
                        <!-- Nomor Telpone -->
                        <div class="col-md-6 position-relative">
                          <label class="form-label" for="FormNoTelp">Nomor Whatsapp</label>
                          <div class="input-group has-validation">
                              <input class="form-control is-invalid" id="e_wa" name="e_wa" type="text" oninput="formatPhoneNumber(this)" placeholder="contoh: +6281220812206" required="">
                          </div>
                        </div>
                        <!-- Upload CV -->
                        <div class="col-md-6 position-relative"> 
                            <input class="form-control" type="hidden" id="oldfile" name="oldfile" readonly>
                            <label class="form-label" for="formFile">Upload Curiculum Vitae</label>
                            <input class="form-control" id="e_filecv" name="e_filecv" type="file" accept=".pdf">
                            <a id="filecv_filename" href="#" target="_blank">
                              <span id="filecv"></span>
                            </a>
                          <div class="valid-tooltip">Max ukuran 10Mb</div>
                        </div>
                        <!-- Pilih Posisi -->
                        <div class="col-md-6 position-relative">
                          <label class="form-label" for="FormJabatanKaryawan">Jabatan Karyawan</label>
                          <select class="form-select" id="e_jabatan" name="e_jabatan" required="">
                            <option selected="" disabled="">Pilih Jabatan Karyawan ...</option>
                          </select>
                        </div>
                        <!-- Pilih Role -->
                        <div class="col-md-6 position-relative">
                          <label class="form-label" for="FormRoleKaryawan">Role Karyawan</label>
                          <select class="form-select" id="e_role" name="e_role" required="">
                            <option selected="" disabled="">Pilih Role Karyawan ...</option>
                          </select>
                        </div>
                        <!-- Masukkan Gaji Karyawan -->
                        <div class="col-md-12 position-relative">
                          <label class="form-label" for="GajiKaryawan">Gaji Karyawan</label>
                          <div class="input-group has-validation">
                              <span class="input-group-text">Rp</span>
                              <input class="form-control is-invalid" id="e_gaji" name="e_gaji" type="text" onkeyup="formatRupiah(this)" required="">
                          </div>
                        </div>
                        <!-- Status Karyawan -->
                        <div class="col-md-12 position-relative">
                            <label class="form-label" for="StatusKaryawan">Status Karyawan</label>
                            <select class="form-select" id="e_status" name="e_status" required="">
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