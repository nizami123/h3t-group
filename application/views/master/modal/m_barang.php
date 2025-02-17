                <!-- Modal Tambah Sub Kategori Baru -->
                <div class="modal fade" id="TambahSubKategoriItem" tabindex="-1" role="dialog" aria-labelledby="SubKategoriItem" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content dark-sign-up">
                        <div class="modal-body social-profile text-start">
                            <div class="modal-toggle-wrapper">
                                <div class="modal-header mb-4">
                                    <h3>Tambah Sub Kategori</h3>
                                    <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form class="row g-3">
                                <!-- Nama Supplier -->
                                <div class="col-md-12 position-relative">
                                    <label class="form-label" for="SubKategoriItem">Sub Kategori</label>
                                    <input class="form-control" id="SubKategoriItem" type="text" placeholder="Masukkan Item Baru">
                                </div>
                                <!-- Button Simpan -->
                                <div class="col-12">
                                    <button class="btn btn-primary" id="tambahkat" type="button">Tambah Baru</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                <!-- Modal Edit Data Master -->
                <div class="modal fade bd-example-modal-xl" id="EditBarang" tabindex="-1" role="dialog" aria-labelledby="EditBarang" aria-hidden="true">
                  <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                    <div class="modal-content dark-sign-up">
                      <div class="modal-body social-profile text-start">
                        <div class="modal-toggle-wrapper">
                            <div class="modal-header mb-4">
                                <h3>Edit Master Data Barang</h3>
                                <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form class="row g-2 needs-validation">
                                <!-- ID Produk -->
                                <div class="col-md-2 position-relative"> 
                                    <label class="form-label" for="idproduk">Product ID</label>
                                    <input class="form-control" id="e_id_brg" name="e_id_brg"  type="text" aria-label="idproduk" required readonly>
                                </div>
                                <!-- Nama Produk -->
                                <div class="col-md-10 position-relative">
                                    <label class="form-label" for="NamaProduk">Nama Produk</label>
                                    <input class="form-control" id="e_nama_brg" name="e_nama_brg" type="text" placeholder="Silahkan Masukkan Nama Produk" required>
                                </div>                                
                                <!-- Brand Product -->
                                <div class="col-md-6 position-relative"> 
                                    <label class="form-label" for="brandproduk">Merek</label>
                                    <select class="form-select" id="e_merk" name="e_merk" required="">
                                        <option selected="" disabled="" value="0">Pilih Merek</option>
                                    </select>
                                </div>
                                <!-- Jenis Product -->
                                <div class="col-md-6 position-relative"> 
                                    <label class="form-label" for="jenisproduk">Jenis</label>
                                    <select class="form-select" id="e_jenis" name="e_jenis" required="">
                                        <option selected="" disabled="" value="0">Pilih Jenis</option>
                                    </select>
                                </div>
                                <!-- Submit Barang -->
                                <div class="col-md-12 position-relative mt-4">
                                    <button class="btn btn-primary" id="edit" type="button">Edit Barang</button>
                                </div>
                            </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>