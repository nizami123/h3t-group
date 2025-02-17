
<!DOCTYPE html>
<html>
<head>
    <?php foreach ($get_id as $gsk) { ?>
    <title>Surat Keluar - <?=$gsk['no_surat_keluar']?></title>
    <?php } ?>
    <style>
    body{font-family:Arial,Helvetica,sans-serif}.container_box{position:relative}.container_box .row h3{line-height:25px;font-size:20px;margin:0px 0 10px;text-transform:uppercase}.container_box .text-center{text-align:center}.container_box .content_box{position:relative;margin-top:50px;}.container_box .content_box .des_info{margin:20px 0;text-align:right}.container_box h3{font-size:30px}table.customTable{width:100%;background-color:#fff;border-collapse:collapse;border-width:0px;border-color:#b3b3b3;border-style:solid;color:#000}table.customTable td,table.customTable th{border-width:0px;border-color:#b3b3b3;border-style:solid;padding:2px;text-align:left}table.customTable thead{background-color:#f6f3f8}.text-center{text-align:center}
    .label {display: inline;padding: .2em .6em .3em;font-size: 75%;font-weight: 700;line-height: 1;color: #fff;text-align: center;white-space: nowrap; vertical-align: baseline;border-radius: .25em;}
    .label-success{background-color: #00a65a !important;}.label-warning {background-color: #f0ad4e;}.label-info {background-color: #5bc0de;}.label-danger{background-color: #dd4b39 !important;}
    p{line-height:20px;padding:0px;margin: 5px;}.pull-right{float:right}
    .name-ttd{
      font-weight:bold;
      text-align:center;
      text-decoration: underline;
      margin-top:70px;
      text-transform:uppercase
    }
    hr{
      border-top: 1px solid black;
    }

    @media print {
      a[href]:after { content: none !important; }
      @page { margin: 0; }
      body  { margin: 1cm; }
    }
        </style>
  <script>
     window.onafterprint = window.close;
         window.print();
  </script>
</head>
<body>

<section class="container_box">
    <div class="row">
        <h3 class="text-center">CV. DHTECH</h3>
        <p class="text-center">Jl Bratang Gede V . A Ngagelrejo Wonokromo Surabaya</p>
        <hr>
        <table class="table customTable" style="border: 1px solid black; border-collapse: collapse; width:100%;">
            <tbody>
                <tr>
                    <td><h4 class="text-center">Surat Pengeluaran Barang</h4></td>
                </tr>
            </tbody>
        </table>
        
        <table class="table customTable" style="border: 1px solid black; border-collapse: collapse; width:100%;">
            <tbody>
                <?php 
                    $formatter = new IntlDateFormatter('id_ID', IntlDateFormatter::LONG, IntlDateFormatter::NONE);
                ?>
                <?php foreach ($get_id as $gsk) { ?>                
                    <tr>
                        <td width="200">Nomor Surat</td>
                        <td>: <?=$gsk['no_surat_keluar']?></td>
                        <td rowspan="6" style="vertical-align: top; text-align: right;">
                            <img style="margin:12px;" src="<?=base_url()?>assets/dhdokumen/suratkeluarbarcode/<?=$gsk['no_surat_keluar']?>.jpg" alt="">
                        </td>
                    </tr>
                    <tr>
                        <td>Tanggal Surat</td>
                        <td>: <?= $formatter->format(new DateTime($gsk['tgl_keluar'])) ?></td>
                    </tr>
                    <tr>
                        <td>Cabang</td>
                        <td>: <?=$gsk['nama_toko']?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <table style="border: 1px solid black; border-collapse: collapse; width:100%;">
            <thead>
                <tr>
                    <th style="border: 1px solid black;">SN Produk</th>
                    <th style="border: 1px solid black;">Nama Produk</th>
                    <th style="border: 1px solid black;">Jenis</th>
                    <th style="border: 1px solid black;">Merk</th>
                    <th style="border: 1px solid black;">Spesifikasi</th>
                    <th style="border: 1px solid black;">Kondisi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($detail as $dtl) { ?>
                    <tr>
                        <td class="text-center" style="border: 1px solid black;"><?=$dtl['sn_brg']?></td>
                        <td class="text-center" style="border: 1px solid black;"><?=$dtl['nama_brg']?></td>
                        <td class="text-center" style="border: 1px solid black;"><?=$dtl['jenis']?></td>
                        <td class="text-center" style="border: 1px solid black;"><?=$dtl['merk']?></td>
                        <td class="text-center" style="border: 1px solid black; text-align: left;">
                            <?php echo isset($dtl['spek']) ? nl2br($dtl['spek']) : ''; ?>
                        </td>
                        <td class="text-center" style="border: 1px solid black;"><?=$dtl['kondisi']?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</section>