        <!-- Begin Content -->
        <div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-6">
                  <h4>Stock Opname Baru</h4>
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
                    <li class="breadcrumb-item active"> Stock Opname</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <!-- Card Status Data Barang -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Informasi Audit</h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-0">
                                <form class="row g-3">
                                <!-- ID StockOpname -->
                                <div class="col-6"> 
                                    <label class="form-label" for="idstockopname">ID STOCK OPNAME</label>
                                    <input class="form-control" id="idstockopname" name="idstockopname" type="text" placeholder="TERISI OTOMATIS" aria-label="idproduk" readonly>
                                </div>
                                <!-- Tanggal Catatan -->
                                <div class="col-6"> 
                                    <label class="form-label" for="tanggalwaktubarang">Tanggal Waktu</label>
                                    <input class="form-control digits" id="tanggalwaktubarang" name="tanggalwaktubarang" type="datetime-local" readonly>
                                </div>
                                <!-- Pilih Cabang -->
                                <div class="col-6"> 
                                    <label class="form-label" for="pilihcabang">CABANG</label>
                                    <select class="form-select" id="cabang" name="cabang" required="">
                                        <option selected="" disabled="" value="0">Pilih Cabang</option>
                                    </select>
                                </div>
                                <!-- Pilih Auditor -->
                                <div class="col-6"> 
                                    <label class="form-label" for="pilihauditor">AUDITOR</label>
                                    <select class="form-select" id="auditor" name="auditor" required="">
                                        <option selected="" disabled="" value="0">Pilih Auditor</option>
                                    </select>
                                </div>
                                <!-- Submit -->
                                <div class="col-12 mt-3">
                                    <button class="btn btn-primary" id="addauditor" type="button">Submit Data</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Listing Stock Opname -->
            <div class="row">
              <div class="col-lg-12">
                <div class="card">
                  <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                    <h4>Opname List</h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                        <table class="display" id="table-ol">
                        <thead>
                            <tr>
                                <th>ID OPNAME</th>
                                <th>TANGGAL OPNAME</th>
                                <th>AUDITOR</th>
                                <th>CABANG</th>
                                <th style="text-align:center;">AKSI</th>
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
            <!-- End Listing Stock Opname -->
            <!-- Modal  -->
            <div class="modal fade bd-example-modal-xl" id="CariBarang" tabindex="-1" role="dialog" aria-labelledby="CariBarang" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content dark-sign-up">
                        <div class="modal-body social-profile text-start" style="max-height: 95vh; overflow-y: auto;">
                            <div class="modal-toggle-wrapper">
                                <div class="modal-header mb-4">
                                    <h3>Tambah Detail Stock Opname Unit</h3>
                                    <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <!-- Isi Konten -->
                                <ul class="list-group">
                                    <!-- ID OPNAME -->
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>ID OPNAME</span>
                                        <strong id="ido">-</strong>
                                    </li>
                                    <!-- Nama Auditor -->
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>NAMA AUDITOR</span>
                                        <strong id="aud">-</strong>
                                    </li>
                                    <!-- NAMA CABANG -->
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>DETAIL CABANG</span>
                                        <strong id="cab">-</strong>
                                    </li>
                                    <!-- TANGGAL & WAKTU -->
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>TANGGAL</span>
                                        <strong id="dtgl">-</strong>
                                    </li>
                                    <!-- TOTAL PRODUK -->
                                    <!-- <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>TOTAL PRODUK</span>
                                        <strong id="cprod">0</strong>
                                    </li> -->
                                    <!-- add produk opname -->
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <form class="row g-3">
                                            <div class="col-4 position-relative"> 
                                                <label class="form-label" for="carisn">Scan Produk</label>
                                                <input class="form-control" id="carisn" name="carisn" type="text" placeholder="Scan serial number produk" aria-label="carisn">
                                            </div>
                                            <!-- SN Product -->
                                            <div class="col-4 position-relative"> 
                                                <label class="form-label" for="brandproduk">Serial Number</label>
                                                <input class="form-control" id="hsn" name="hsn" type="text" placeholder="TERISI OTOMATIS" aria-label="brandproduk" readonly>
                                            </div>
                                            <!-- Brand Product -->
                                            <div class="col-2 position-relative"> 
                                                <label class="form-label" for="brandproduk">Merek</label>
                                                <input class="form-control" id="merk" name="merk" type="text" placeholder="TERISI OTOMATIS" aria-label="brandproduk" readonly>
                                            </div>

                                            <!-- Jenis Product -->
                                            <div class="col-2 position-relative"> 
                                                <label class="form-label" for="jenisproduk">Jenis</label>
                                                <input class="form-control" id="jenis" name="jenis" type="text" placeholder="TERISI OTOMATIS" aria-label="jenisproduk" readonly>
                                            </div>

                                            <div class="col-md-12 position-relative"> 
                                                <label class="form-label" for="exampleFormControlTextarea1">Spesifikasi Lengkap</label>
                                                <textarea class="form-control" style="resize: none;" name="spek" id="spek" rows="3" placeholder="TERISI OTOMATIS" readonly></textarea>
                                            </div>                                                               
                                            <!-- Submit -->
                                            <!-- <div class="col-12 mt-3">
                                                <button class="btn btn-primary" id="tambahdata" type="button">Tambah Data</button>
                                            </div> -->
                                        </form>
                                    </li>
                                </ul>
                                <br>
                                <!-- Produk List -->
                                <div class="col-lg-12"> 
                                    <div class="card"> 
                                        <div class="card-header pb-0 card-no-border">
                                            <div class="row">
                                                <div class="col-md-8 position-relative">
                                                    <h5>Data Produk Tersedia</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="display" id="table-pr">
                                                    <thead>
                                                        <tr>
                                                            <th>SN PRODUK</th>
                                                            <th>NAMA PRODUK</th>
                                                            <th>MERK</th>
                                                            <th>JENIS</th>
                                                            <th>STATUS</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>                                            
                                        </div>
                                    </div>
                                </div>
                                <!-- data opname -->
                                <div class="col-lg-12"> 
                                    <div class="card"> 
                                        <div class="card-header pb-0 card-no-border">
                                            <div class="row">
                                                <div class="col-md-8 position-relative">
                                                    <h5>Data Produk Opname</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="display" id="table-prop">
                                                    <thead>
                                                        <tr>
                                                            <th>SN PRODUK</th>
                                                            <th>NAMA PRODUK</th>
                                                            <th>MERK</th>
                                                            <th>JENIS</th>
                                                            <th>STATUS</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>                                            
                                        </div>
                                    </div>
                                </div>
                                <!-- data opname -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade bd-example-modal-xl" id="CariBarangAcc" tabindex="-1" role="dialog" aria-labelledby="CariBarangAcc" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content dark-sign-up">
                        <div class="modal-body social-profile text-start" style="max-height: 95vh; overflow-y: auto;">
                            <div class="modal-toggle-wrapper">
                                <div class="modal-header mb-4">
                                    <h3>Tambah Detail Stock Opname Aksesoris</h3>
                                    <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <!-- Isi Konten -->
                                <ul class="list-group">
                                    <!-- ID OPNAME -->
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>ID OPNAME</span>
                                        <strong id="idoacc">-</strong>
                                    </li>
                                    <!-- Nama Auditor -->
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>NAMA AUDITOR</span>
                                        <strong id="audacc">-</strong>
                                    </li>
                                    <!-- NAMA CABANG -->
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>DETAIL CABANG</span>
                                        <strong id="cabacc">-</strong>
                                    </li>
                                    <!-- TANGGAL & WAKTU -->
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>TANGGAL</span>
                                        <strong id="dtglacc">-</strong>
                                    </li>
                                    <!-- TOTAL PRODUK -->
                                    <!-- <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>TOTAL PRODUK</span>
                                        <strong id="cprod">0</strong>
                                    </li> -->
                                    <!-- add produk opname -->
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <form class="row g-3">
                                            <div class="col-4 position-relative"> 
                                                <label class="form-label" for="carisnacc">Scan Produk</label>
                                                <input class="form-control" id="carisnacc" name="carisnacc" type="text" placeholder="Scan serial number produk" aria-label="carisn">
                                            </div>
                                            <!-- SN Product -->
                                            <div class="col-4 position-relative"> 
                                                <label class="form-label" for="hsnacc">Serial Number</label>
                                                <input class="form-control" id="hsnacc" name="hsnacc" type="text" placeholder="TERISI OTOMATIS" aria-label="hsnacc" readonly>
                                            </div>
                                            <!-- Brand Product -->
                                            <div class="col-2 position-relative"> 
                                                <label class="form-label" for="merkacc">Merek</label>
                                                <input class="form-control" id="merkacc" name="merkacc" type="text" placeholder="TERISI OTOMATIS" aria-label="merkacc" readonly>
                                            </div>

                                            <!-- Jenis Product -->
                                            <div class="col-2 position-relative"> 
                                                <label class="form-label" for="jenisacc">Jenis</label>
                                                <input class="form-control" id="jenisacc" name="jenisacc" type="text" placeholder="TERISI OTOMATIS" aria-label="jenisacc" readonly>
                                            </div>
                                                          
                                            <!-- Submit -->
                                            <!-- <div class="col-12 mt-3">
                                                <button class="btn btn-primary" id="tambahdata" type="button">Tambah Data</button>
                                            </div> -->
                                        </form>
                                    </li>
                                </ul>
                                <br>
                                <!-- Produk List -->
                                <div class="col-lg-12"> 
                                    <div class="card"> 
                                        <div class="card-header pb-0 card-no-border">
                                            <div class="row">
                                                <div class="col-md-8 position-relative">
                                                    <h5>Data Produk Tersedia</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="display" id="table-pracc">
                                                    <thead>
                                                        <tr>
                                                            <th>SN PRODUK</th>
                                                            <th>NAMA PRODUK</th>
                                                            <th>MERK</th>
                                                            <th>JENIS</th>
                                                            <th>STATUS</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>                                            
                                        </div>
                                    </div>
                                </div>
                                <!-- data opname -->
                                <div class="col-lg-12"> 
                                    <div class="card"> 
                                        <div class="card-header pb-0 card-no-border">
                                            <div class="row">
                                                <div class="col-md-8 position-relative">
                                                    <h5>Data Produk Opname</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="display" id="table-propacc">
                                                    <thead>
                                                        <tr>
                                                            <th>SN PRODUK</th>
                                                            <th>NAMA PRODUK</th>
                                                            <th>MERK</th>
                                                            <th>JENIS</th>
                                                            <th>STATUS</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>                                            
                                        </div>
                                    </div>
                                </div>
                                <!-- data opname -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>            
            <!-- End Modal -->
          </div>
          <!-- Container-fluid Ends-->
        </div>
        <!-- End Content -->