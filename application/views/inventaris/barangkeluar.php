        <!-- Page Sidebar Ends-->
        <!-- Begin Content -->
        <div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-6">
                  <h4>Daftar Barang Cabang</h4>
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?=base_url()?>">                      
                        <svg class="stroke-icon">
                          <use href="<?=base_url()?>assets/svg/icon-sprite.svg#stroke-home"></use>
                        </svg></a>
                    </li>
                    <li class="breadcrumb-item"> Home</li>
                    <li class="breadcrumb-item"> Applications</li>
                    <li class="breadcrumb-item"> Data Barang</li>
                    <li class="breadcrumb-item active"> Cabang</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <!-- Card Status Data Barang -->
            <div class="row">
                <?php foreach ($setcabang as $sc) { ?>
                    <div class="col-md-4 col-sm-6">
                        <a href="#" class="cardLink" data-id="<?=$sc['id_toko']?>">
                            <div class="card widget-hover overflow-hidden">
                                <div class="card-header card-no-border pb-2">
                                <h5 id="id_toko" data-id="<?=$sc['id_toko']?>"><?=$sc['id_toko']?></h5>
                                </div>
                                <div class="card-body pt-0 count-student">
                                <div class="school-wrapper"> 
                                    <div class="school-header" data-id="<?=$sc['id_toko']?>">
                                        <div class="spinner-border text-primary d-none" role="status" id="spinner-<?=$sc['id_toko']?>">
                                            <span class="visually-hidden">Memuat...</span>
                                        </div>
                                        <h4 class="txt-primary counting" id="counting-<?=$sc['id_toko']?>"></h4>
                                        <div class="d-flex gap-1 align-items-center flex-wrap pt-xxl-0 pt-2">
                                            <p class="text-muted"><?=$sc['nama_toko']?></p>
                                        </div>
                                    </div>
                                    <div class="school-body"> <img src="<?=base_url()?>assets/images/inventoriassets/store-dh.png" alt="store-produk-dh">
                                    <div class="right-line"><img src="<?=base_url()?>assets/images/inventoriassets/line.png" alt="line"></div>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php } ?>
            </div>
            <!-- Card Form Data Keluar Bekas Baru -->
            <div class="row">
              <!-- Form Barang -->
              <div class="col-sm-12">
                  <div class="card height-equal">
                      <div class="card-header">
                          <h4>Formulir Barang Cabang</h4>
                      </div>
                      <div class="card-body custom-input col-xl-12">
                        <!-- Menu Tab Barang Baru & Bekas -->
                        <ul class="nav nav-tabs" id="icon-tab" role="tablist">
                          <li class="nav-item"><a class="nav-link active txt-primary" id="barang-baru-tab" data-bs-toggle="tab" href="#barang-baru" role="tab" aria-controls="barang-baru" aria-selected="true"><i class="icofont icofont-archive"></i>Barang Baru</a></li>
                          <li class="nav-item"><a class="nav-link txt-primary" id="barang-bekas-tab" data-bs-toggle="tab" href="#barang-bekas" role="tab" aria-controls="barang-bekas" aria-selected="false"><i class="icofont icofont-archive"></i>Barang Bekas</a></li>
                          <li class="nav-item"><a class="nav-link txt-primary" id="barang-acc-tab" data-bs-toggle="tab" href="#barang-acc" role="tab" aria-controls="barang-acc" aria-selected="false"><i class="icofont icofont-archive"></i>Barang Aksesoris</a></li>
                        </ul>
                        <!-- Isi Form Konten-->
                        <div class="tab-content" id="icon-tabContent">
                          <!-- Tambah Data Barang Baru -->
                          <div class="tab-pane fade show active" id="barang-baru" role="tabpanel" aria-labelledby="barang-baru-tab">
                              <div class="pt-3 mb-0">
                                <form class="row g-3">
                                    <!-- Tanggal Catatan -->
                                    <div class="col-4 position-relative"> 
                                        <label class="form-label" for="tglbaru">Tanggal Waktu</label>
                                        <input class="form-control digits" id="tglbaru" name="tglbaru" type="datetime-local" readonly>
                                    </div>

                                    <!-- Cabang -->
                                    <div class="col-4 position-relative"> 
                                        <label class="form-label" for="cabangbaru">Cabang</label>
                                        <select class="form-select" id="cabangbaru" name="cabangbaru" required="">
                                            <option selected="" disabled="" value="0">Pilih Cabang</option>
                                        </select>
                                    </div>

                                    <!-- No Surat Keluar -->
                                    <div class="col-4 position-relative"> 
                                        <label class="form-label" for="nosuratb">No Surat Keluar</label>
                                        <input class="form-control" id="nosuratb" name="nosuratb" type="text" placeholder="Masukkan Nomor Surat Keluar" aria-label="nosuratb" required="">
                                    </div>

                                    <!-- Nama Produk -->
                                    <div class="col-6 position-relative">
                                        <label class="form-label" for="prodbaru">Nama Produk</label>
                                        <select class="form-select" id="prodbaru" name="prodbaru" required="">
                                            <option selected="" disabled="" value="0">Pilih Produk</option>
                                        </select>
                                    </div>

                                    <!-- Brand Product -->
                                    <div class="col-3"> 
                                        <label class="form-label" for="merkbaru">Merek</label>
                                        <input class="form-control" id="merkbaru" name="merkbaru" type="text" placeholder="TERISI OTOMATIS" aria-label="merkbaru" readonly>
                                    </div>

                                    <!-- Jenis Product -->
                                    <div class="col-3"> 
                                        <label class="form-label" for="jenisbaru">Jenis</label>
                                        <input class="form-control" id="jenisbaru" name="jenisbaru" type="text" placeholder="TERISI OTOMATIS" aria-label="jenisbaru" readonly>
                                    </div>

                                    <div class="col-md-12 position-relative"> 
                                        <label class="form-label" for="spekbaru">Spesifikasi Lengkap</label>
                                        <textarea class="form-control" style="resize: none;" name="spekbaru" id="spekbaru" placeholder="TERISI OTOMATIS" rows="3" readonly></textarea>
                                    </div>
                                    <!-- Submit Barang -->
                                    <div class="col-12 mt-3">
                                        <button class="btn btn-primary" type="button" id="tambahbaru">Tambah Produk Cabang</button>
                                    </div>
                                </form>
                              </div>
                          </div>
                          <!-- Tambah Data Barang Bekas -->
                          <div class="tab-pane fade" id="barang-bekas" role="tabpanel" aria-labelledby="barang-bekas-tab">
                            <div class="pt-3 mb-0">
                                <form class="row g-3">
                                  <!-- Tanggal Catatan -->
                                  <div class="col-4 position-relative"> 
                                    <label class="form-label" for="tglbekas">Tanggal Waktu</label>
                                    <input class="form-control digits" id="tglbekas" name="tglbekas" type="datetime-local" readonly>
                                  </div>
                                  
                                  <!-- Cabang -->
                                  <div class="col-4 position-relative"> 
                                        <label class="form-label" for="cabangbekas">Cabang</label>
                                        <select class="form-select" id="cabangbekas" name="cabangbekas" required="">
                                            <option selected="" disabled="" value="0">Pilih Cabang</option>
                                        </select>
                                  </div>

                                  <!-- No Surat Keluar -->
                                  <div class="col-4 position-relative"> 
                                        <label class="form-label" for="nosuratk">No Surat Keluar</label>
                                        <input class="form-control" id="nosuratk" name="nosuratk" type="text" placeholder="Masukkan Nomor Surat Keluar" aria-label="nosuratk" required="">
                                  </div>

                                  <!-- Nama Produk -->
                                  <div class="col-6 position-relative">
                                      <label class="form-label" for="prodbekas">Nama Produk</label>
                                      <select class="form-select" id="prodbekas" name="prodbekas" required="">
                                        <option selected="" disabled="" value="0">Pilih Produk</option>
                                    </select>
                                  </div>

                                    <!-- Brand Product -->
                                    <div class="col-3 position-relative"> 
                                        <label class="form-label" for="merkbekas">Merek</label>
                                        <input class="form-control" id="merkbekas" name="merkbekas" type="text" placeholder="TERISI OTOMATIS" aria-label="merkbekas" readonly>
                                    </div>

                                    <!-- Jenis Product -->
                                    <div class="col-3 position-relative"> 
                                        <label class="form-label" for="jenisbekas">Jenis</label>
                                        <input class="form-control" id="jenisbekas" name="jenisbekas" type="text" placeholder="TERISI OTOMATIS" aria-label="jenisbekas" readonly>
                                    </div>

                                    <div class="col-md-12 position-relative"> 
                                        <label class="form-label" for="spekbekas">Spesifikasi Lengkap</label>
                                        <textarea class="form-control" style="resize: none;" name="spekbekas" placeholder="TERISI OTOMATIS" id="spekbekas" rows="3"readonly></textarea>
                                    </div>
                                    <!-- Submit Barang -->
                                    <div class="col-12 mt-3">
                                        <button class="btn btn-primary" type="button" id="tambahbekas">Tambah Produk Cabang</button>
                                    </div>
                                </form>
                            </div>
                          </div>
                          <!-- Tambah Data Barang Aksesoris -->
                          <div class="tab-pane fade" id="barang-acc" role="tabpanel" aria-labelledby="barang-acc-tab">
                            <div class="pt-3 mb-0">
                                <form class="row g-3">
                                    <!-- Tanggal Catatan -->
                                    <div class="col-4 position-relative"> 
                                        <label class="form-label" for="tglacc">Tanggal Waktu</label>
                                        <input class="form-control digits" id="tglacc" name="tglacc" type="datetime-local" readonly>
                                    </div>
                                    
                                    <!-- Cabang -->
                                    <div class="col-4 position-relative"> 
                                        <label class="form-label" for="cabangacc">Cabang</label>
                                        <select class="form-select" id="cabangacc" name="cabangacc" required="">
                                            <option selected="" disabled="" value="0">Pilih Cabang</option>
                                        </select>
                                    </div>

                                    <!-- No Surat Keluar -->
                                    <div class="col-4 position-relative"> 
                                        <label class="form-label" for="nosuratacc">No Surat Keluar</label>
                                        <input class="form-control" id="nosuratacc" name="nosuratacc" type="text" placeholder="Masukkan Nomor Surat Keluar" aria-label="nosuratacc" readonly>
                                    </div>
                                    <div class="col-6 position-relative"> 
                                        <label class="form-label" for="prodacc">Nama Produk</label>
                                        <select class="form-select" id="prodacc" name="prodacc" required="">
                                            <option selected="" disabled="" value="0">Pilih Produk</option>
                                        </select>
                                    </div>
                                    <div class="col-6 position-relative"> 
                                        <label class="form-label" for="merkacc">Merk</label>
                                        <select class="form-select" id="merkacc" name="merkacc" required="">
                                            <option selected="" disabled="" value="0">Pilih Merk</option>
                                        </select>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="display" id="table-prdacc">
                                            <thead>
                                                <tr>
                                                    <th><input type="checkbox" id="select-all"></th>
                                                    <th>SN PRODUK</th>
                                                    <th>PRODUK</th>
                                                    <th>MERK</th>
                                                    <th>JENIS</th>
                                                    <th>HARGA HPP</th>
                                                    <th>HARGA JUAL</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- Submit Barang -->
                                    <div class="col-12 mt-3">
                                        <button class="btn btn-primary" type="button" id="tambahacc">Tambah Produk Cabang</button>
                                    </div>
                                </form>
                            </div>
                          </div>
                        </div>
                      </div>
                  </div>
              </div>
            </div>
            <!-- Listing Inventori -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header pb-0 card-no-border">
                            <h4>Daftar Surat Keluar</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="display" id="table-sk">
                                <thead>
                                    <tr>
                                    <th>TANGGAL</th>
                                    <th>NOMOR SURAT KELUAR</th>
                                    <th>CABANG</th>
                                    <th>STATUS</th>
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
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header pb-0 card-no-border">
                            <h4>History Barang Cabang</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="display" id="table-bk">
                                <thead>
                                    <tr>
                                    <th>TANGGAL</th>
                                    <th>NOMOR SURAT KELUAR</th>
                                    <th>CABANG</th>
                                    <th>SN PRODUK</th>
                                    <th>NAMA PRODUK</th>
                                    <th>SPESIFIKASI</th>
                                    <th>KONDISI</th>
                                    <th>STATUS</th>
                                    <th>BARCODE</th>
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
            <!-- End Listing Inventori-->
            <!-- Modal Catatan -->
            <div class="modal fade bd-example-modal-lg" id="ModalCatatanKondisi" tabindex="-1" role="dialog" aria-labelledby="ModalCatatanKondisi" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                  <div class="modal-content dark-sign-up">
                    <div class="modal-body social-profile text-start">
                      <div class="modal-toggle-wrapper">
                        <div class="modal-header mb-4">
                            <h3>Catatan Kondisi Barang</h3>
                            <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form class="row g-3">
                            <!-- Catatan Barang -->
                            <div class="col-12"> 
                                <label class="form-label" for="exampleFormControlTextarea1">Catatan Kelengkapan Barang</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" readonly>1. Kondisi Fisik 98% 2. Lightning Cable Tidak Ada</textarea>
                            </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
            <div class="modal fade bd-example-modal-xl" id="DetailSuratKeluar" tabindex="-1" role="dialog" aria-labelledby="DetailSuratKeluar" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content dark-sign-up">
                        <div class="modal-body social-profile text-start" style="max-height: 90vh; overflow-y: auto;">
                        <div class="modal-toggle-wrapper">
                            <div class="modal-header mb-4">
                                <h3>Detail Surat Keluar</h3>
                                <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <ul class="list-group">
                                <!-- No Surat Keluar -->
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>No Surat Keluar</span>
                                    <strong id="dsk">-</strong>
                                </li>
                                <!-- Tanggal -->
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>Tanggal</span>
                                    <strong id="dtgl">-</strong>
                                </li>
                                <!-- Nama Cabang -->
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>Cabang</span>
                                    <strong id="dcab">-</strong>
                                </li>
                            </ul>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="display" id="table-detail">
                                            <thead>
                                                <tr>
                                                    <th>SN PRODUK</th>
                                                    <th>NAMA PRODUK</th>
                                                    <th>JENIS</th>
                                                    <th>MERK</th>
                                                    <th>SPESIFIKASI</th>
                                                    <th>KONDISI</th>
                                                    <th>STATUS</th>
                                                    <th>BARCODE</th>
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
                        </div>
                      </div>
                    </div>
                </div>
            </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>
        <!-- End Content -->