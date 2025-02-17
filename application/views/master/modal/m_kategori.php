              <!-- Modal Tambah Kategori Baru -->
              <div class="modal fade bd-example-modal-xl" id="TambahMasterKategoriModal" tabindex="-1" role="dialog" aria-labelledby="MasterKategroiModal" aria-hidden="true">
                  <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                  <div class="modal-content dark-sign-up">
                      <div class="modal-body social-profile text-start">
                          <div class="modal-toggle-wrapper">
                              <div class="modal-header mb-4">
                                  <h3>Tambah Kategori Baru</h3>
                                  <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <form class="row g-3">
                              <!-- Nama Supplier -->
                              <div class="col-md-12 position-relative">
                                  <label class="form-label" for="TambahKategoriBaru">Main Kategori</label>
                                  <input class="form-control" id="TambahKategoriBaru" type="text" placeholder="Masukkan Nama Kategori">
                              </div>
                              <!-- Button Simpan -->
                              <div class="col-12">
                                  <button class="btn btn-primary" type="submit" data-bs-dismiss="modal">Tambah Baru</button>
                              </div>
                              </form>
                          </div>
                      </div>
                  </div>
                  </div>
              </div>
              <!-- Modal Edit Kategori -->
              <div class="modal fade" id="EditKategoriItem" tabindex="-1" role="dialog" aria-labelledby="EditKategori" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content dark-sign-up">
                      <div class="modal-body social-profile text-start">
                          <div class="modal-toggle-wrapper">
                              <div class="modal-header mb-4">
                                  <h3>Edit Kategori</h3>
                                  <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <form class="row g-3">
                              <!-- Kategori 1 -->
                              <div class="col-md-12 position-relative">
                                  <label class="form-label" for="FormKategori1">Kategori 1</label>
                                  <input class="form-control" id="FormKategori1" type="text" placeholder="Merek">
                              </div>
                              <!-- Button Simpan -->
                              <div class="col-12">
                                  <button class="btn btn-primary" type="submit" data-bs-dismiss="modal">Simpan Perubahan</button>
                              </div>
                              </form>
                          </div>
                      </div>
                  </div>
                  </div>
              </div>
              <!-- Modal Listing Kategori Konten -->
              <div class="modal fade bd-example-modal-xl" id="SubKategoriItem" tabindex="-1" role="dialog" aria-labelledby="KontenSubKategori" aria-hidden="true">
                  <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                  <div class="modal-content dark-sign-up">
                      <div class="modal-body social-profile text-start">
                          <div class="modal-toggle-wrapper">
                              <div class="modal-header mb-4">
                                  <h3>Sub Kategori</h3>
                                  <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <form class="row g-3">
                              <!-- Table Sub -->
                              <div class="card-block row">
                                  <div class="col-sm-12 col-lg-12 col-xl-12">
                                    <div class="table-responsive">
                                      <table class="display" id="table-kategori">
                                        <thead>
                                          <tr>
                                            <th scope="col">Id</th>
                                            <th scope="col">Kategori</th>
                                            <th scope="col">Aksi</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                      </table>
                                    </div>
                                  </div>
                                </div>
                              <!-- Button Simpan -->
                              </form>
                          </div>
                      </div>
                  </div>
                  </div>
              </div>