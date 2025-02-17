        <!-- Begin Content -->
        <div class="page-body">
            <div class="container-fluid">
                <div class="page-title">
                    <div class="row">
                        <div class="col-6">
                            <h4>Penerimaan</h4>
                        </div>
                        <div class="col-6">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="<?=base_url()?>">                                       
                                        <svg class="stroke-icon">
                                            <use href="<?=base_url()?>assets/svg/icon-sprite.svg#stroke-home"></use>
                                        </svg>
                                    </a>
                                </li>
                                <li class="breadcrumb-item"> Home</li>
                                <li class="breadcrumb-item"> Applications</li>
                                <li class="breadcrumb-item"> Transaksi</li>
                                <li class="breadcrumb-item active"> Penerimaan</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Main Menu Penerimaan -->
            <div class="container-fluid">
                <!-- Menu Etalase -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header pb-0 card-no-border">
                                <div class="row">
                                <form class="row g-3 needs-validation custom-input">
                                    <!-- Nama Kustomer -->
                                    <div class="col-md-6 position-relative">
                                        <label class="form-label" for="no_faktur">No Faktur</label>
                                        <input class="form-control" id="no_faktur" name="no_faktur" type="text" placeholder="Masukkan No Faktur" required="">
                                        <div class="valid-tooltip">Looks good!</div>
                                    </div>
                                    <!-- Alamat Tanggal -->
                                    <div class="col-md-6 position-relative">
                                        <label class="form-label" for="FormEmailKustomer">Tanggal</label>
                                        <input class="form-control" id="FormEmailKustomer" name="tanggal" type="date" placeholder="alamat@email.com" required="">
                                        <div class="valid-tooltip">Looks good!</div>
                                    </div>
                                    <!-- Button Tambah Kustomer Baru -->
                                    <div class="col-12">
                                        <button class="btn btn-primary" id="generate" type="button">Generate</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="display" id="table-etalase">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th style="min-width: 150px;"><span class="f-light f-w-600">SN PRODUK</span></th>
                                            <th style="min-width: 200px;"><span class="f-light f-w-600">NAMA PRODUK</span></th>
                                            <th style="min-width: 100px;"><span class="f-light f-w-600">MERK</span></th>
                                            <th style="min-width: 100px;"><span class="f-light f-w-600">JENIS</span></th>
                                            <th style="min-width: 180px;"><span class="f-light f-w-600">NO IMEI</span></i></th>
                                            <th style="min-width: 80px;"><span class="f-light f-w-600">KONDISI</span></i></th>
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
        <!-- End Content -->