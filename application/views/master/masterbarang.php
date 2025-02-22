        <!-- Begin Content -->
        <div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-6">
                  <h4>Data Master Barang</h4>
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?=base_url()?>">                                       
                        <svg class="stroke-icon">
                          <use href="<?=base_url()?>assets/svg/icon-sprite.svg#stroke-home"></use>
                        </svg></a></li>
                    <li class="breadcrumb-item"> Home</li>
                    <li class="breadcrumb-item"> Data Master</li>
                    <li class="breadcrumb-item active"> Master Barang</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
              <!-- Form Tambah Barang -->
              <div class="row">
                  <!-- Form Barang -->
                  <div class="col-sm-12">
                      <div class="card">
                          <div class="card-body">
                              <form class="row g-2 needs-validation">
                                  <!-- ID Produk -->
                                  <div class="col-md-2 position-relative"> 
                                      <label class="form-label" for="idproduk">Product ID</label>
                                      <input class="form-control" id="idproduk" name="id_brg" value="<?=$newID?>" type="text" aria-label="idproduk" required readonly>
                                  </div>
                                  
                                  <!-- Nama Produk -->
                                  <div class="col-md-10 position-relative">
                                      <label class="form-label" for="NamaProduk">Nama Produk</label>
                                      <input class="form-control" id="NamaProduk" name="nama_brg" type="text" placeholder="Silahkan Masukkan Nama Produk" required>
                                  </div>

                                  <!-- Brand Product -->
                                  <div class="col-md-3 position-relative"> 
                                      <label class="form-label" for="brandproduk">Merek</label>
                                      <select class="form-select" id="brandproduk" name="merk" required="">
                                          <option selected="" disabled="" value="0">Pilih Merek</option>
                                      </select>
                                  </div>
                                  
                                  <!-- Button Tambah -->
                                  <div class="col-md-1 position-relative">
                                      <label class="form-label text-center" for="shortcuttambahdata">Add New</label>
                                      <div class="button d-grid">
                                          <a class="btn badge-light-primary f-w-500" type="button" data-type="MRK" data-bs-toggle="modal" data-bs-target="#TambahSubKategoriItem" onclick="changeInputName('SubKategoriItem', 'newmerk')"><i class="fa fa-plus"></i></a>
                                      </div>
                                  </div>

                                  <!-- Jenis Product -->
                                  <div class="col-md-3 position-relative"> 
                                      <label class="form-label" for="jenisproduk">Jenis</label>
                                      <select class="form-select" id="jenisproduk" name="jenis" required="">
                                          <option selected="" disabled="" value="0">Pilih Jenis</option>
                                      </select>
                                  </div>
                                  <!-- Button Tambah -->
                                  <div class="col-md-1 position-relative">
                                      <label class="form-label" for="shortcuttambahdata">Add New</label>
                                      <div class="button d-grid">
                                          <a class="btn badge-light-primary f-w-500" type="button" data-type="JNS" data-bs-toggle="modal" data-bs-target="#TambahSubKategoriItem" onclick="changeInputName('SubKategoriItem', 'newjenis')"><i class="fa fa-plus"></i></a>
                                      </div>
                                  </div>

                                   <!-- Jenis Product -->
                                   <div class="col-md-3 position-relative"> 
                                      <label class="form-label" for="warnaproduk">warna</label>
                                      <select class="form-select" id="warnaproduk" name="warna" required="">
                                          <option selected="" disabled="" value="0">Pilih Warna</option>
                                      </select>
                                  </div>
                                  <!-- Button Tambah -->
                                  <div class="col-md-1 position-relative">
                                      <label class="form-label" for="shortcuttambahdata">Add New</label>
                                      <div class="button d-grid">
                                          <a class="btn badge-light-primary f-w-500" type="button" data-type="WRN" data-bs-toggle="modal" data-bs-target="#TambahSubKategoriItem" onclick="changeInputName('SubKategoriItem', 'newwarna')"><i class="fa fa-plus"></i></a>
                                      </div>
                                  </div>
                                  
                                  <!-- Submit Barang -->
                                  <div class="col-md-12 position-relative">
                                      <button class="btn btn-primary" id="tambah" type="button">Tambah Produk</button>
                                  </div>
                              </form>
                          </div>
                      </div>
                  </div>
              </div>
              <!-- End Form Tambah Cabang-->
              <!-- Data Listing Barang -->
              <div class="row">
                  <div class="col-sm-12">
                      <div class="card">
                        <div class="card-header pb-0 card-no-border">
                          <h4>List Data Barang</h4>
                        </div>
                        <div class="card-body">
                          <div class="table-responsive">
                            <table class="display" id="table-barang">
                              <thead>
                                <tr>
                                  <th>ID PRODUK</th>
                                  <th>MEREK</th>
                                  <th>JENIS</th>
                                  <th>NAMA PRODUK</th>
                                  <th>WARNA</th>
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
              <!-- End Listing Supplier -->
          </div>
          <!-- Container-fluid Ends-->
        </div>
        <!-- End Content -->