        <!-- Begin Content -->
        <div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-6">
                  <h4>Pemindahan Barang</h4>
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
                    <li class="breadcrumb-item active"> Pindah </li>
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
                            <h4>Form Pemindahan Barang</h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-0">
                                <form class="row g-3">
                                    <!-- No Surat Pemindahan -->
                                    <div class="col-6"> 
                                        <label class="form-label" for="no_sp">Nomor Surat Pemindahan</label>
                                        <input class="form-control" id="no_sp" name="no_sp" type="text" placeholder="TERISI OTOMATIS" aria-label="no_sp" readonly>
                                    </div>
                                    <!-- Tanggal -->
                                    <div class="col-6"> 
                                        <label class="form-label" for="tanggalwaktubarang">Tanggal Waktu</label>
                                        <input class="form-control digits" id="tanggalwaktubarang" name="tanggalwaktubarang" type="datetime-local" readonly>
                                    </div>
                                    <!-- Pilih Cabang Awal -->
                                    <div class="col-6"> 
                                        <label class="form-label" for="pilihcabang">Dari Cabang</label>
                                        <select class="form-select" id="f_cabang" name="f_cabang" required="">
                                            <option selected="" disabled="" value="0">Pilih Cabang</option>
                                        </select>
                                    </div>
                                    <!-- Pilih Cabang Penerima -->
                                    <div class="col-6"> 
                                        <label class="form-label" for="pilihcabang">Kepada Cabang</label>
                                        <select class="form-select" id="t_cabang" name="t_cabang" required="">
                                            <option selected="" disabled="" value="0">Pilih Cabang</option>
                                        </select>
                                    </div>                                
                                    <!-- Submit -->
                                    <div class="col-12 mt-3">
                                        <button class="btn btn-primary" id="addpindah" type="button">Submit Data</button>
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
                    <h4>Daftar Surat Pemindahan Barang</h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                        <table class="display" id="table-sp">
                        <thead>
                            <tr>
                                <th><span class="f-light f-w-600">TANGGAL</span></th>
                                <th><span class="f-light f-w-600">NOMOR SURAT</span</th>
                                <th><span class="f-light f-w-600">DARI CABANG</span></th>
                                <th><span class="f-light f-w-600">KEPADA CABANG</span></th>
                                <th><span class="f-light f-w-600">STATUS</span></th>
                                <th class="text-center" style="min-width: 70px;"><span class="f-light f-w-600">AKSI</span></th>
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
            <!-- history barang -->
            <div class="row">
              <div class="col-lg-12">
                <div class="card">
                  <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                    <h4>History Barang Pindah</h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                        <table class="display" id="table-brsp">
                        <thead>
                            <tr>
                                <th><span class="f-light f-w-600">SN BARANG</span></th>
                                <th><span class="f-light f-w-600">NAMA BARANG</span</th>
                                <th><span class="f-light f-w-600">JENIS</span></th>
                                <th><span class="f-light f-w-600">MERK</span></th>
                                <th><span class="f-light f-w-600">STATUS TERAKHIR</span></th>
                                <th class="text-center" style="min-width: 70px;"><span class="f-light f-w-600">AKSI</span></th>
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
            <div class="modal fade bd-example-modal-lg" id="PindahBarang" tabindex="-1" role="dialog" aria-labelledby="PindahBarang" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content dark-sign-up">
                        <div class="modal-body social-profile text-start" style="max-height: 95vh; overflow-y: auto;">
                            <div class="modal-toggle-wrapper">
                                <div class="modal-header mb-4">
                                    <h3>Detail Surat Pindah</h3>
                                    <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <!-- Isi Konten -->
                                <ul class="list-group">
                                  <!-- NOMOR SURAT -->
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>NOMOR SURAT</span>
                                        <strong id="ns">-</strong>
                                    </li>
                                    <!-- DARI CABANG -->
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>DARI CABANG</span>
                                        <strong id="dc">-</strong>
                                    </li>
                                    <!-- KEPADA CABANG -->
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>KEPADA CABANG</span>
                                        <strong id="kc">-</strong>
                                    </li>
                                    <!-- CARISN -->
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <input class="form-control" id="carisnacc" name="carisnacc" type="text" placeholder="Scan serial number produk" aria-label="carisn">
                                    </li>
                                    <!-- PRODUK -->
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <form class="row g-3">
                                            <div class="col-6 position-relative">
                                                <label class="form-label" for="hsnacc">Nama Produk</label>
                                                <input class="form-control" id="hsnacc" name="hsnacc" type="text" placeholder="TERISI OTOMATIS" readonly>
                                                <input class="form-control" id="idk" name="idk" type="hidden">
                                            </div>
                                            <!-- Brand Product -->
                                            <div class="col-3 position-relative"> 
                                                <label class="form-label" for="brandproduk">Merek</label>
                                                <input class="form-control" id="merk" name="merk" type="text" placeholder="TERISI OTOMATIS" aria-label="brandproduk" readonly>
                                            </div>

                                            <!-- Jenis Product -->
                                            <div class="col-3 position-relative"> 
                                                <label class="form-label" for="jenisproduk">Jenis</label>
                                                <input class="form-control" id="jenis" name="jenis" type="text" placeholder="TERISI OTOMATIS" aria-label="jenisproduk" readonly>
                                            </div>

                                            <div class="col-md-12 position-relative"> 
                                                <label class="form-label" for="exampleFormControlTextarea1">Spesifikasi Lengkap</label>
                                                <textarea class="form-control" style="resize: none;" name="spek" id="spek" rows="3" placeholder="TERISI OTOMATIS" readonly></textarea>
                                            </div>                                                               
                                            <!-- Submit -->
                                            <div class="col-12 mt-3">
                                                <button class="btn btn-primary" id="tambahdata" type="button">Tambah Data</button>
                                            </div>
                                        </form>
                                    </li>
                                </ul>
                                <!-- Data Table -->
                                <div class="col-lg-12"> 
                                    <div class="card"> 
                                        <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                                            <h5>Produk List</h5>
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
            <div class="modal fade bd-example-modal-xl" id="HistoryBarang" tabindex="-1" role="dialog" aria-labelledby="HistoryBarang" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content dark-sign-up">
                        <div class="modal-body social-profile text-start" style="max-height: 95vh; overflow-y: auto;">
                            <div class="modal-toggle-wrapper">
                                <div class="modal-header mb-4">
                                    <h3>Detail Barang Pindah</h3>
                                    <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <!-- Isi Konten -->
                                <ul class="list-group">
                                  <!-- SN BARANG -->
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>SN BARANG</span>
                                        <strong id="snb">-</strong>
                                    </li>
                                    <!-- NAMA BARANG -->
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>NAMA BARANG</span>
                                        <strong id="nmb">-</strong>
                                    </li>
                                    <!-- MERK -->
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>MERK</span>
                                        <strong id="mrk">-</strong>
                                    </li>
                                    <!-- JENIS -->
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>JENIS</span>
                                        <strong id="jns">-</strong>
                                    </li>
                                </ul>
                                <!-- Data Table -->
                                <div class="col-lg-12"> 
                                    <div class="card"> 
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="display" id="table-hbrsp">
                                                    <thead>
                                                        <tr>
                                                            <th>NOMOR SURAT</th>
                                                            <th>TANGGAL</th>
                                                            <th>DARI CABANG</th>
                                                            <th>KEPADA CABANG</th>
                                                            <th>STATUS</th>
                                                            <th>USER</th>
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
            <!-- End Modal -->
          </div>
          <!-- Container-fluid Ends-->
        </div>
        <!-- End Content -->