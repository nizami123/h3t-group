        <!-- Begin Content -->
        <div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-6">
                  <h4>Down Payment Supplier</h4>
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                      <a href="index.html">
                        <svg class="stroke-icon">
                          <use href="<?=base_url()?>assets/svg/icon-sprite.svg#stroke-home"></use>
                        </svg>
                      </a>
                    </li>
                    <li class="breadcrumb-item"> Home</li>
                    <li class="breadcrumb-item"> Applications</li>
                    <li class="breadcrumb-item"> Akuntansi</li>
                    <li class="breadcrumb-item active"> DP Supplier</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <!-- FORMULIR DP SUPPLIER -->
          <div class="container-fluid">
            <!-- Formulir Downpayment Baru -->
            <div class="row">
                <div class="col-sm-12">
                  <div class="card">
                    <div class="card-body">
                        <form class="row g-3" id="form_dp">
                            <!-- Tanggal Awal Tagihan -->
                            <div class="col-md-3 position-relative"> 
                              <label class="form-label" for="TanggalAwalTagihan">TANGGAL AWAL TAGIHAN</label>
                              <input class="form-control digits" id="tgl_tg" name="tgl_tg" type="date">
                            </div>
                            <!-- INVOICE DP -->
                            <div class="col-md-3 position-relative"> 
                              <label class="form-label" for="InvDPSupp">INVOICE DP</label>
                              <input class="form-control" id="invdp" type="text" placeholder="TERISI OTOMATIS" aria-label="InvDPSupp" readonly>
                            </div>
                            <!-- ID TRANSAKSI -->
                            <div class="col-md-3 position-relative"> 
                              <label class="form-label" for="TransaksiID">ID TRANSAKSI</label>
                              <input class="form-control" id="transid" type="text" placeholder="TERISI OTOMATIS" aria-label="TransaksiID" readonly>
                            </div>
                            <!-- NO MUTASI -->
                            <div class="col-md-3 position-relative"> 
                              <label class="form-label" for="MutasiID">NO MUTASI</label>
                              <input class="form-control" id="no_m" type="text" placeholder="Masukkan nomor mutasi bank" aria-label="no_m" required>
                            </div>
                            <!-- Supplier -->
                            <div class="col-md-6 position-relative"> 
                              <label class="form-label" for="H3TSUPPlier">DAFTAR SUPPLIER</label>
                              <select class="form-select" id="dh_supp" required="">
                                  <option selected="" disabled="" value="0">Pilih Supplier</option>
                              </select>
                            </div>
                            <!-- PILIH BANK -->
                            <div class="col-md-6 position-relative">
                                <label class="form-label" for="AkunBank">AKUN BANK</label>
                                <select class="form-select" id="bank_acc" required="">
                                    <option selected="" disabled="" value="0">Pilih Akun Bank Digunakan</option>
                                </select>
                            </div>
                            <!-- Nominal DP -->
                            <div class="col-md-12 position-relative">
                                <label class="form-label" for="NominalDPSupplier">NOMINAL DOWNPAYMENT</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text">Rp</span>
                                    <input class="form-control" id="nominal_dp" type="text" onkeyup="formatRupiah(this)" required>
                                </div>
                            </div>
                            <!-- KETERANGAN -->
                            <div class="col-md-12 position-relative">
                                <label class="form-label" for="CatatanTransaksi">KETERANGAN</label>
                                <div class="form-floating">
                                    <textarea class="form-control" id="cat_trans" placeholder="Leave a comment here" required></textarea>
                                    <label for="CatatanTransaksi">CATATAN</label>
                                </div>
                            </div>
                            <!-- Submit Transaksi -->
                            <div class="col-12 mt-3">
                                <button class="btn btn-primary" type="submit" id="save">Submit Downpayment</button>
                            </div>
                        </form>
                    </div>
                  </div>
                </div>
            </div>
            <!-- Data Table Downpayment -->
            <div class="row">
              <div class="col-lg-12">
                  <div class="card">
                      <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                          <h4>Daftar DP Supplier</h4>
                              <div class="d-flex align-items-center">
                          </div>
                      </div>
                      <div class="card-body">
                          <div class="dt-ext table-responsive">
                              <table class="display" id="table-dp">
                              <thead>
                                <tr>
                                  <th style="min-width: 100px;"><span class="f-light f-w-600">SUPPLIER ID</span></th>
                                  <th style="min-width: 180px;"><span class="f-light f-w-600">NAMA SUPPLIER</span></th>
                                  <th><span class="f-light f-w-600">TOTAL DP</span></th>
                                  <th><span class="f-light f-w-600">AKSI</span></th>
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
            <div class="modal fade bd-example-modal-xl" id="DetailDPSupp" tabindex="-1" role="dialog" aria-labelledby="DetailDPSupp" aria-hidden="true">
              <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content dark-sign-up">
                  <div class="modal-body social-profile text-start" style="max-height: 90vh; overflow-y: auto;">
                    <div class="modal-toggle-wrapper">
                      <div class="modal-header mb-4">
                          <h3>Detail DP Supplier</h3>
                          <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <ul class="list-group">
                          <!-- Supplier ID -->
                          <li class="list-group-item d-flex justify-content-between align-items-center">
                              <span>Supplier ID</span>
                              <strong id="dsi">-</strong>
                          </li>
                          <!-- Nama Supplier -->
                          <li class="list-group-item d-flex justify-content-between align-items-center">
                              <span>Nama Supplier</span>
                              <strong id="dnm">-</strong>
                          </li>
                          <!-- Total DP -->
                          <li class="list-group-item d-flex justify-content-between align-items-center">
                              <span>Total DP</span>
                              <strong id="dtdp">-</strong>
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
                                        <th><span class="f-light f-w-600">TANGGAL</span></th>
                                        <th style="min-width: 100px;"><span class="f-light f-w-600">INVOICE DP</span></th>
                                        <th style="min-width: 120px;"><span class="f-light f-w-600">TRANSAKSI ID</span></th>
                                        <th><span class="f-light f-w-600">NOMINAL</span></th>
                                        <th style="min-width: 190px;"><span class="f-light f-w-600">AKUN BANK</span></th>
                                        <th style="min-width: 180px;"><span class="f-light f-w-600">KETERANGAN</span></th>
                                        <th style="min-width: 50px;"><span class="f-light f-w-600">AKSI</span></th>
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