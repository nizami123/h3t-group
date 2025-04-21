        <!-- Begin Content -->
        <div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-6">
                  <h4>List Pembelian</h4>
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
                    <li class="breadcrumb-item"> Transaksi</li>
                    <li class="breadcrumb-item active"> Penjualan</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <!-- Motifikasi -->
            <!-- Card Form Data Masuk Bekas Baru -->
            <div class="row">
                <!-- Form Barang -->
                <div class="col-xl-12">
                  <div class="card height-equal">
                      <div class="card-body custom-input col-xl-12">
                        <!-- Isi Form Konten-->
                        <div class="tab-content" id="icon-tabContent">
                          <!-- Tambah Data Barang Baru -->
                          <div class="tab-pane fade show active" id="barang-baru" role="tabpanel" aria-labelledby="barang-baru-tab">
                              <div class="pt-3 mb-0">
                                <form class="row g-3">
                                  <!-- Tanggal Catatan -->
                                  <div class="col-4 position-relative"> 
                                    <label class="form-label" for="tanggalwaktubarang">Tanggal Waktu</label>
                                    <input class="form-control digits" id="tglbaru" name="tglbaru" type="datetime-local" readonly>
                                  </div>

                                  <!-- Supplier -->
                                  <div class="col-4 position-relative"> 
                                    <label class="form-label" for="FormIDSupplier">Customer</label>
                                    <select class="form-select" id="suppbaru" name="suppbaru" required="">
                                        <option selected="" disabled="" value="0">Pilih Customer</option>
                                    </select>
                                  </div>

                                  <!-- Faktur Barang -->
                                  <div class="col-4 position-relative"> 
                                    <label class="form-label" for="fakturbarang">No Faktur Barang</label>
                                    <input class="form-control" id="fakturbarang" name="nofakbaru" type="text" placeholder="Masukkan Nomor Faktur Barang" aria-label="fakturbarang" required="">
                                  </div>

                                  <!-- Nama Produk -->
                                  <div class="col-8 position-relative">
                                      <label class="form-label" for="NamaProduk">Nama Produk</label>
                                      <select class="form-select" id="prodbaru" name="prodbaru" required="">
                                        <option selected="" disabled="" value="0">Pilih Produk</option>
                                    </select>
                                  </div>                                                             

                                  <div class="col-4 position-relative"> 
                                    <label class="form-label" for="hjProduk">Harga Jual</label>
                                    <input class="form-control" id="hjbaru" type="text" name="hjbaru" placeholder="Masukkan Harga Jual" aria-label="hjProduk" onkeyup="formatRupiah(this)" required="">
                                  </div>
                                  <div class="col-2 position-relative"> 
                                    <label class="form-label" for="jumlah">Jumlah</label>
                                    <input class="form-control" id="jumlah" type="number" name="jumlah" placeholder="jumlah" value="1" aria-label="jumlah" required="">
                                  </div>
                                  <div class="col-4 position-relative"> 
                                    <label class="form-label" for="diskon">Diskon</label>
                                    <input class="form-control" id="diskon" type="text" name="diskon" placeholder="Masukkan Diskon" aria-label="diskon" onkeyup="formatRupiah(this)" required="">
                                  </div>
                                  <div class="col-6 position-relative"> 
                                    <label class="form-label" for="keterangan">Keterangan</label>
                                    <input class="form-control" id="keterangan" type="text" name="keterangan" placeholder="Masukkan Keterangan" aria-label="keterangan" required="">
                                  </div>
                                  <!-- Submit Barang -->
                                  <div class="col-12 mt-3">
                                    <button class="btn btn-primary" type="button" id="tambahbaru">Tambah Produk</button>
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
                <div class="col-md-12">
                    <div class="card">
                      <div class="card-header pb-0 card-no-border">
                        <h4>History Penjualan</h4>
                      </div>
                      <div class="card-body">
                        <div class="dt-ext table-responsive">
                          <table class="display" id="table-bm">
                            <thead>
                              <tr>
                                <th>TANGGAL</th>
                                <th>NO FAKTUR</th>
                                <th>CUSTOMER</th>
                                <th>NAMA PRODUK</th>
                                <th>HARGA JUAL</th>
                                <th>DISKON</th>
                                <th>JUMLAH</th>
                                <th>TOTAL</th>
                                <th>KETERANGAN</th>
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
            </div>
            <!-- End Listing Inventori-->
          </div>
          <!-- Container-fluid Ends-->
        </div>
        <!-- End Content -->