        <!-- Begin Content -->
        <div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-6">
                  <h4>Laporan Brand</h4>
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
                    <li class="breadcrumb-item active"> Laporan Brand</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <!-- Listing Produk -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header pb-0 card-no-border">
                            <div class="row">
                                <div class="col-md-4 position-relative mt-2">
                                    <label>Filter Kategori Produk</label>
                                    <select class="form-select" id="tipe" name="tipe" required="">
                                        <option selected="" value="0">Semua Kategori</option>
                                    </select>
                                </div>
                                <div class="col-md-4 position-relative mt-2">
                                    <label>Filter Kondisi Produk</label>
                                    <select class="form-select" id="kondisi" name="kondisi" required="">
                                        <option selected="" value="0">Semua Kondisi</option>
                                    </select>
                                </div>
                                <div class="col-md-4 position-relative mt-2">
                                    <label>Filter Cabang</label>
                                    <select class="form-select" id="cab" name="cab" required="">
                                        <option selected="" value="0">Semua Cabang</option>
                                    </select>
                                </div>
                                <div class="col-md-4 position-relative mt-2">
                                    <label>Filter Summery Produk</label>
                                    <select class="form-select" id="catsum" name="catsum" required="">
                                        <option selected="" value="0">Semua Summery</option>
                                        <option value="Sell Out">Sell Out</option>
                                        <option value="Stock">Stock</option>
                                    </select>
                                </div>
                                <div class="col-md-4 position-relative mt-2">
                                    <label>Filter Tanggal Invoice</label>
                                    <input class="form-control flatpickr-input" id="fdinv" type="text" style="width: 100%;" readonly="readonly" placeholder="Pilih Tanggal">
                                </div>
                                <div class="col-md-4 position-relative mt-2">
                                    <label>Filter Tanggal Produk</label>
                                    <input class="form-control flatpickr-input" id="fdipt" type="text" style="width: 100%;" readonly="readonly" placeholder="Pilih Tanggal">
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="display" id="table-lapbr">
                                    <thead>
                                        <tr>
                                            <th><span class="f-light f-w-600">CATEGORY SUMMERY</span></th>
                                            <th><span class="f-light f-w-600">SALES ID</span></th>
                                            <th><span class="f-light f-w-600">SALES NAME</span></th>
                                            <th><span class="f-light f-w-600">SUPERVISOR NAME</span></th>
                                            <th><span class="f-light f-w-600">OUTLET NAME</span></th>
                                            <th><span class="f-light f-w-600">OUTLET CODE</span></th>
                                            <th><span class="f-light f-w-600">INVOICE NUMBER</span></th>
                                            <th><span class="f-light f-w-600">INVOICE DATE</span></th>
                                            <th><span class="f-light f-w-600">INVOICE YEAR</span></th>
                                            <th><span class="f-light f-w-600">INVOICE MONTH</span></th>
                                            <th><span class="f-light f-w-600">PAYMENT METHOD</span></th>
                                            <th><span class="f-light f-w-600">SUBMISSION DATE</span></th>
                                            <th><span class="f-light f-w-600">SERIAL NUMBER</span></th>
                                            <th><span class="f-light f-w-600">BRAND</span></th>
                                            <th><span class="f-light f-w-600">P/N, CN, MTM, SNID</span></th>
                                            <th><span class="f-light f-w-600">PRODUCT NAME</span></th>
                                            <th><span class="f-light f-w-600">PRODUCT CATEGORY</span></th>
                                            <th><span class="f-light f-w-600">COST PRICE</span></th>
                                            <th><span class="f-light f-w-600">COGS</span></th>
                                            <th><span class="f-light f-w-600">FINAL PRICE</span></th>
                                            <th><span class="f-light f-w-600">KONDISI</span></th>
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
          <!-- Container-fluid Ends-->
        </div>
        <!-- End Content -->