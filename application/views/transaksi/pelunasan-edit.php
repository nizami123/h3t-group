        <!-- Begin Content -->
        <div class="page-body">
            <div class="container-fluid">
                <div class="page-title">
                    <div class="row">
                        <div class="col-6">
                            <h4>Pelunasan</h4>
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
                                <li class="breadcrumb-item active"> Pelunasan</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Main Menu Pelunasan -->
            <div class="container-fluid">
                <!-- Menu Etalase -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header pb-0 card-no-border">
                                <div class="row">
                                <form class="row g-3 needs-validation custom-input">
                                    <!-- Nama Kustomer -->
                                    <div class="col-md-4 position-relative">
                                        <label class="form-label" for="no_pelunasan">No Pelunasan</label>
                                        <input class="form-control" id="no_pelunasan" name="no_pelunasan" type="text" value="<?=$pelunasan->id_pelunasan?>" readonly="">
                                        <div class="valid-tooltip">Looks good!</div>
                                    </div>
                                    <div class="col-md-4 position-relative">
                                        <label class="form-label" for="no_faktur">No Faktur</label>
                                        <input class="form-control" id="no_faktur" name="no_faktur" type="text" value="<?=$pelunasan->no_faktur?>" placeholder="Masukkan No Faktur" readonly="">
                                        <div class="valid-tooltip">Looks good!</div>
                                    </div>
                                    <!-- Alamat Tanggal -->
                                    <div class="col-md-4 position-relative">
                                        <label class="form-label" for="tanggal">Tanggal Waktu</label>
                                        <input class="form-control digits" id="tanggal" name="tanggal" type="datetime-local" readonly>
                                        <div class="valid-tooltip">Looks good!</div>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-primary" id="generate" type="button">Generate</button>
                                    </div>
                                    <div class="col-md-4 position-relative">
                                        <label class="form-label" for="FormEmailKustomer">Nama Supplier</label>
                                        <input class="form-control" id="namasupplier" name="namasupplier" value="<?=$pelunasan->nama_supplier?>" type="text" placeholder="DIISI OTOMATIS" readonly="">
                                        <div class="valid-tooltip">Looks good!</div>
                                    </div>
                                    <div class="col-md-4 position-relative">
                                        <label class="form-label" for="FormEmailKustomer">Metode</label>
                                        <select name="metode" class="form-control" id="metode" >
                                            <option value="" <?= empty($pelunasan->metode) ? 'selected' : '' ?>>-- Pilih Metode --</option>
                                            <option value="Transfer" <?= ($pelunasan->metode == 'Transfer') ? 'selected' : '' ?>>Transfer</option>
                                            <option value="Tunai" <?= ($pelunasan->metode == 'Tunai') ? 'selected' : '' ?>>Tunai</option>
                                            <option value="CC" <?= ($pelunasan->metode == 'CC') ? 'selected' : '' ?>>CC</option>
                                            <option value="Voucher" <?= ($pelunasan->metode == 'Voucher') ? 'selected' : '' ?>>Voucher</option>
                                            <option value="Tempo" <?= ($pelunasan->metode == 'Tempo') ? 'selected' : '' ?>>Tempo</option>
                                        </select>
                                        <div class="valid-tooltip">Looks good!</div>
                                    </div>

                                    <div class="col-md-4 position-relative">
                                        <label class="form-label" for="FormEmailKustomer">No Rekening</label>
                                        <input class="form-control" id="norek" name="norek" value="<?=$pelunasan->no_rekening?>" type="text" required="">
                                        <div class="valid-tooltip">Looks good!</div>
                                    </div>
                                    <div class="col-md-4 position-relative">
                                        <label class="form-label" for="FormEmailKustomer">Nilai Tagihan</label>
                                        <input class="form-control" id="tagihan" name="tagihan" value="<?=$pelunasan->total_tagihan?>" type="text" onkeyup="formatRupiah(this)" placeholder="DIISI OTOMATIS" readonly="">
                                        <div class="valid-tooltip">Looks good!</div>
                                    </div>
                                    <div class="col-md-4 position-relative">
                                        <label class="form-label" for="FormEmailKustomer">Bayar</label>
                                        <input class="form-control" id="bayar" name="bayar" value="<?=$pelunasan->jumlah?>" type="text" onkeyup="formatRupiah(this)" required="">
                                        <div class="valid-tooltip">Looks good!</div>
                                    </div>
                                    <!-- Button Tambah Kustomer Baru -->
                                    <div class="col-12">
                                        <button class="btn btn-primary" id="simpan" type="button">Simpan</button>
                                        <button class="btn btn-success" id="post" type="button">Simpan & Post</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="EditBayarModal" tabindex="-1" role="dialog" aria-labelledby="EditBayarModal" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="EditBayarLabel">Edit Bayar</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="editBayarForm">
                                    <input type="hidden" id="editBayarId">
                                    <div class="mb-3">
                                        <label for="editBayarAmount" class="form-label">Bayar</label>
                                        <input type="text" class="form-control" id="editBayarAmount" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Content -->

