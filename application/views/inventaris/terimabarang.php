        <div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-6">
                  <h4>Penerimaan Barang</h4>
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
                    <li class="breadcrumb-item active"> Terima</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <!-- Listing Inventori -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header pb-0 card-no-border">
                            <div class="row">
                                <div class="col-md-8 position-relative">
                                    <h4>Daftar Surat Keluar</h4>
                                </div>
                                <div class="col-md-4 position-relative">
                                    <select class="form-select" id="cab" name="cab" required="">
                                        <option selected="" disabled="" value="0">Pilih Cabang</option>
                                    </select>
                                </div>
                            </div>
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
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header pb-0 card-no-border">
                            <div class="row">
                                <div class="col-md-8 position-relative">
                                    <h4>Daftar Surat Pindah</h4>
                                </div>
                                <div class="col-md-4 position-relative">
                                    <select class="form-select" id="cabsp" name="cabsp" required="">
                                        <option selected="" disabled="" value="0">Pilih Cabang</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="display" id="table-sp">
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
            </div>            
            <!-- End Listing Inventori-->
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
            <div class="modal fade bd-example-modal-xl" id="DetailSuratPindah" tabindex="-1" role="dialog" aria-labelledby="DetailSuratPindah" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content dark-sign-up">
                        <div class="modal-body social-profile text-start" style="max-height: 90vh; overflow-y: auto;">
                        <div class="modal-toggle-wrapper">
                            <div class="modal-header mb-4">
                                <h3>Detail Surat Pindah</h3>
                                <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <ul class="list-group">
                                <!-- No Surat Keluar -->
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>No Surat Pindah</span>
                                    <strong id="dsp">-</strong>
                                </li>
                                <!-- Tanggal -->
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>Tanggal</span>
                                    <strong id="dtglp">-</strong>
                                </li>
                                <!-- Nama Cabang -->
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>Cabang</span>
                                    <strong id="dcabp">-</strong>
                                </li>
                            </ul>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="display" id="table-detailp">
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