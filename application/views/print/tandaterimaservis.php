<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Tanda Terima Servis</title>
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
                        <td style="border: 1px dashed black;"><strong>TANDA TERIMA SERVICE</strong></td>
                    </tr>
                    <tr>
                        <td style="border: 1px dashed black;"><strong>NO SERVICE : <?= $items->servis_id ?></strong></td>
                    </tr>
                </table>

            </td>
        </tr>
    </table>
</div>

<div class="info-pelanggan">
    <?php
        $bulan = [
            1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        $tanggal = date('j', strtotime($items->tgl_servis));
        $bulanNum = date('n', strtotime($items->tgl_servis));
        $tahun = date('Y', strtotime($items->tgl_servis));

        $formatIndo = $tanggal . ' ' . $bulan[$bulanNum] . ' ' . $tahun;
    ?>
    <table style="border: 1px solid black; border-collapse: collapse;">
        <tr class="row-padding">
            <td style="width: 15%;">Kepada Yth</td>
            <td style="width: 1%;">:</td>
            <td><?= $items->nama_pelanggan ?></td>
        </tr>
        <tr class="row-padding">
            <td style="width: 15%;">Alamat</td>
            <td style="width: 1%;">:</td>
            <td><?= $items->alamat ?></td>
        </tr>
        <tr class="row-padding">
            <td style="width: 15%;">No. Telp</td>
            <td style="width: 1%;">:</td>
            <td><?= $items->no_ponsel ?></td>
        </tr>
        <tr class="row-padding">
            <td style="width: 15%;">Tanggal Servis</td>
            <td style="width: 1%;">:</td>
            <td><?= $formatIndo ?></td>
        </tr>
    </table>
</div>

<table class="item-table" style="margin-top:10px;">
    <tbody>
        <tr>
            <td colspan="4"><h3 style="text-align:center; margin: 2px;">DATA SERVIS</h3></td>
        </tr>
        <?php
        $detail = json_decode($items->data_servis, true); 
        foreach ($detail as $item): ?>
            <tr>
                <td style="width: 20%;" colspan="2">
                    <?= strtoupper(htmlspecialchars($item['key'])) ?>
                </td>
                <td style="width: 80%;" colspan="2">
                    <?= strtoupper(htmlspecialchars($item['value'])) ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>

</table>

<table style="margin-top: 10px; width: 100%;">
    <tr>
        <td style="width: 80%; vertical-align: top;">
            <strong>Keterangan:</strong><br>
            <span>
                1. BARANG YANG TELAH DISERVICE DAN TIDAK DIAMBIL DALAM WAKTU 1 (SATU) BULAN PIHAK KAMI TIDAK BERTANGGUNG JAWAB ATAS KEHILANGAN / RUSAKNYA BARANG TERSEBUT <br>
                2. HARAP PERIKSA KELENGKAPAN SEBELUM MENINGGALKAN TEMPAT KAMI <br>
            </span>
        </td>
        <td style="width: 20%;">

            <!-- Tanda Tangan -->
            <table style="width: 100%; text-align: center;">
                <tr>
                    <td style="width: 100%;">
                        PIC Penerima
                        <br><br><br><br> <!-- Ruang untuk tanda tangan -->
                        <?= $items->pic_penerima ?>
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
