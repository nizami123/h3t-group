<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice Servis</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 10px;
            width: 100%;
        }

        .header, .footer {
            width: 100%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .item-table th, .item-table td {
            border: 1px solid #000;
            padding: 5px;
        }

        .item-table th {
            background: #eee;
        }

        .info-pelanggan, .total-section {
            margin-top: 10px;
        }

        .total-section td {
            padding: 3px;
        }

        .footer {
            margin-top: 30px;
            display: flex;
            justify-content: space-between;
        }

        .terbilang {
            font-style: italic;
            margin-top: -30px;
        }

        .row-padding td {
            padding: 4px;
        }

        @media print {
            @page {
                size: A4 portrait;
                margin: 10mm;
            }

            body {
                width: 95%;
                height: 148mm; /* setengah dari A4 (297mm) */
                overflow: hidden;
            }
        }
    </style>
</head>
<body>
<?php 
    $detail = json_decode($items->data_invoice, true); 
    $detailteknisi = json_decode($items->data_teknisi, true);
?>
<div class="header">
    <table>
        <tr>
            <td style="width: 10%;">
                <img src="<?=base_url()?>assets/images/logo/logo-icon.png" alt="Logo" width="60" height="60">
            </td>
            <td style="width: 68%;">
                <strong><?= $items->toko_penerima ?></strong><br>
                <?= $items->alamat_toko ?><br>
                Email : h3h3h3@gmail.com<br>
                NO TELEPON : 03137390409, 081333466614 <br>
                http://www.h3tcomputer.com
            </td>
            <td style="width: 22%; text-align: center;">
                <table style="border: 1px dashed black; border-collapse: collapse;">
                    <tr>
                        <td style="border: 1px dashed black;"><strong>INVOICE SERVICE</strong></td>
                    </tr>
                    <tr>
                        <td style="border: 1px dashed black;"><strong><?= $detail['no_invoice'] ?></strong></td>
                    </tr>
                </table>

            </td>
        </tr>
    </table>
</div>

<div class="info-pelanggan">
    <?php
        function isDate($date, $format = 'Y-m-d') {
            if (!is_string($date) || trim($date) === '') {
                return false;
            }

            $d = DateTime::createFromFormat($format, $date);
            return $d && $d->format($format) === $date;
        }

        function indoDate($date) {
            $bulan = [
                1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
            ];

            $timestamp = strtotime($date);
            $day = date('j', $timestamp);
            $month = $bulan[date('n', $timestamp)];
            $year = date('Y', $timestamp);

            return "$day $month $year";
        }

        $formatIndo    = indoDate($items->tgl_servis);
        $tglInvoiceIndo = indoDate($detail['tgl_invoice']);
        $tglDiambilIndo = isset($items->tgl_diambil) ? indoDate($items->tgl_diambil) : null;
        $tglTempoIndo = isDate($detail['detail_tipe']) ? indoDate($detail['detail_tipe']) : null;

    ?>
    <table style="border: 1px solid black; border-collapse: collapse;">
        <tr class="row-padding">
            <td style="width: 15%;">Kepada Yth</td>
            <td style="width: 1%;">:</td>
            <td><?= $items->nama_pelanggan ?></td>
            <td style="width: 15%;">Tanggal Invoice</td>
            <td style="width: 1%;">:</td>
            <td><?= $tglInvoiceIndo ?></td>
        </tr>
        <tr class="row-padding">
            <td style="width: 15%;">Alamat</td>
            <td style="width: 1%;">:</td>
            <td><?= $items->alamat ?></td>
            <td style="width: 15%;">Tanggal Diambil</td>
            <td style="width: 1%;">:</td>
            <td><?= $tglDiambilIndo ?? '-' ?></td>
        </tr>
        <tr class="row-padding">
            <td style="width: 15%;">No. Telp</td>
            <td style="width: 1%;">:</td>
            <td><?= $items->no_ponsel ?></td>
            <td style="width: 15%;">Tipe Pembayaran</td>
            <td style="width: 1%;">:</td>
            <td><?= $detail['tipe'] == 'Tempo' ? $detail['tipe'].' '.$tglTempoIndo : ($detail['tipe'] == 'Tunai' ? $detail['tipe'] : $detail['tipe'] .' '.$detail['detail_tipe']) ?></td>
        </tr>
        <tr class="row-padding">
            <td style="width: 15%;">Tanggal Servis</td>
            <td style="width: 1%;">:</td>
            <td><?= $formatIndo ?></td>
            <td style="width: 15%;">Keterangan</td>
            <td style="width: 1%;">:</td>
            <td><?= $detail['keterangan'] ?? '-' ?></td>
        </tr>
        <tr class="row-padding">
            <td style="width: 15%;">Barang</td>
            <td style="width: 1%;">:</td>
            <td><?= strtoupper($items->barang) ?></td>
            <td style="width: 15%;">Garansi</td>
            <td style="width: 1%;">:</td>
            <td>30 Hari</td>
        </tr>
    </table>
</div>

<table class="item-table" style="margin-top:10px;">
    <tbody>
        <tr>
            <td colspan="4"><h2 style="text-align:center; margin: 2px;">DETAIL INVOICE</h2></td>
        </tr>
        <?php
        foreach ($detail['data_invoice'] as $item): ?>
            <tr>
                <td style="width: 50%;" colspan="2">
                    <?= strtoupper(htmlspecialchars($item['value'])) ?><br>
                    <?php foreach ($detailteknisi['data_teknisi'] as $teknisi): ?>
                        <small style="font-style: italic;"><?= $item['value'] == $teknisi['value'] ? strtoupper(htmlspecialchars('('.$teknisi['key'].')')) : '' ?></small>
                    <?php endforeach; ?>
                </td>
                <td style="width: 50%; text-align:right;" colspan="2">
                    <?= strtoupper(htmlspecialchars(number_format($item['harga'], 0, ',', '.'))) ?>
                </td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="3" style="text-align:left;"><h4 style="margin: 2px;">GRAND TOTAL</h4></td>
            <td style="text-align:right; font-style:bold;"><h4 style="margin: 2px;"><?= number_format($detail['total_harga'], 0, ',', '.') ?></h4></td>
        </tr>
    </tbody>

</table>

<table style="margin-top: 10px; width: 100%;">
    <tr>
        <td style="width: 70%; vertical-align: top;">
            <strong>Keterangan:</strong><br>
            <span>
                1. BARANG YANG TELAH DISERVICE DAN TIDAK DIAMBIL DALAM WAKTU 1 (SATU) BULAN PIHAK KAMI TIDAK BERTANGGUNG JAWAB ATAS KEHILANGAN / RUSAKNYA BARANG TERSEBUT <br>
                2. HARAP PERIKSA KELENGKAPAN SEBELUM MENINGGALKAN TEMPAT KAMI <br>
            </span>
        </td>
        <td style="width: 30%;">

            <!-- Tanda Tangan -->
            <table style="width: 100%; text-align: center;">
                <tr>
                    <td style="width: 50%;">
                        Customer,
                        <br><br><br><br> <!-- Ruang untuk tanda tangan -->
                        <?= $items->nama_pelanggan ?>
                    </td>
                    <td style="width: 50%;">
                        Hormat Kami,
                        <br><br><br><br> <!-- Ruang untuk tanda tangan -->
                        <?= $detail['nama_user'] ?>
                    </td>
                </tr>
            </table>
            <!-- End Tanda Tangan -->

        </td>
    </tr>
</table>


<script>
    window.print();
</script>

</body>
</html>
