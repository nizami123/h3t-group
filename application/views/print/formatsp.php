
<!DOCTYPE html>
<html>
<head>
    <link rel="icon" href="<?=base_url()?>assets/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="<?=base_url()?>assets/images/favicon.png" type="image/x-icon">
    <?php foreach ($get_id as $gsk) { ?>
    <title>Surat Pindah - <?=$gsk['nosp']?></title>
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
        <h3 class="text-center">H3T GROUP</h3>
        <p class="text-center">Sidotopo Wetan Baru II No.33, RT.002/RW.006, Sidotopo Wetan, Kec. Kenjeran, Surabaya, Jawa Timur 60128</p>
        <hr>
        <table class="table customTable" style="border: 1px solid black; border-collapse: collapse; width:100%;">
            <tbody>
                <tr>
                    <td><h4 class="text-center">Surat Pemindahan Barang</h4></td>
                </tr>
            </tbody>
        </table>
        
        <table class="table customTable" style="border: 1px solid black; border-collapse: collapse; width:100%;">
            <tbody>
                <?php foreach ($get_id as $gsk) { ?>                
                    <tr>
                        <td width="200">Nomor Surat</td>
                        <td>: <?=$gsk['nosp']?></td>
                        <td rowspan="5" style="vertical-align: top; text-align: right;">
                            <img style="margin:12px;" src="<?=base_url()?>assets/dhdokumen/suratpindahbarcode/<?=$gsk['nosp']?>.jpg" alt="">
                        </td>
                    </tr>
                    <tr>
                        <td>Tanggal Surat Pemindahan</td>
                        <td>: <?= $gsk['tgl_pindah'] ?></td>
                    </tr>
                    <tr>
                        <td>Dari Cabang</td>
                        <td>: <?=$gsk['dari_cab']?></td>
                    </tr>
                    <tr>
                        <td>Kepada Cabang</td>
                        <td>: <?=$gsk['kpd_cab']?></td>
                    </tr>
                    <tr>
                        <td>Pengirim</td>
                        <td>: <?=$gsk['nama_lengkap']?></td>
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
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</section>