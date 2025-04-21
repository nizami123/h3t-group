<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Nota Penjualan</title>
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
            <td style="width: 60%;">
                <strong>PT. SAMUDERA SURI</strong><br>
                JL. SIMO TAMBAAN NO. 120-122<br>
                SURABAYA - JAWA TIMUR<br>
                NO TELEPON : 031-99150068
            </td>
            <td style="width: 40%; text-align: right;">
                <table>
                    <tr>
                        <td><strong>No. Faktur</strong></td>
                        <td>: <?= $header->kode_penjualan ?></td>
                    </tr>
                    <tr>
                        <td><strong>Tanggal</strong></td>
                        <td>: <?= date('d M Y', strtotime($header->tanggal)) ?></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <hr>
    <h4 style="text-align:center;">NOTA PENJUALAN</h4>
</div>

<div class="info-pelanggan">
    <strong>Kepada Yth:</strong><br>
    <?= $header->nama_plg ?><br>
    <?= nl2br($header->alamat) ?>
</div>

<table class="item-table" style="margin-top:10px;">
    <thead>
        <tr>
        <th style="width:5%;">No</th>
            <th>Nama Barang</th>
            <th style="width:10%;">Qty</th>
            <th style="width:15%;">Harga</th>
            <th style="width:15%;">Diskon</th>
            <th style="width:15%;">Subtotal</th>
        </tr>
    </thead>
    <tbody>
    <?php
    $no = 1;
    $subtotal = 0;
    foreach ($items as $item):
        $diskon_rp = ($item['diskon'] ?? 0);
        $harga_asli = $item['hrg_jual'];
        $harga_akhir = $harga_asli - $diskon_rp;
        $total_item = $harga_akhir * $item['jml'];
        $subtotal += $total_item;
    ?>
    <tr>
        <td style="text-align: center;"><?= $no++ ?></td>
        <td><?= $item['nama_brg'] ?></td>
        <td style="text-align: center;"><?= $item['jml'] ?></td>
        <td style="text-align: right;"><?= number_format($harga_asli, 0, ',', '.') ?></td>
        <td style="text-align: right;"><?= number_format($diskon_rp, 0, ',', '.') ?></td>
        <td style="text-align: right;"><?= number_format($total_item, 0, ',', '.') ?></td>
    </tr>
    <?php if (!empty($item['keterangan'])): ?>
    <tr>
        <td></td>
        <td colspan="5" style="font-style: italic; font-size: 11px; color: #555;">
            <?= nl2br($item['keterangan']) ?>
        </td>
    </tr>
    <?php endif; ?>
    <?php endforeach; ?>
</tbody>

</table>

<table class="total-section" style="margin-top:10px;">
    <tr>
        <td style="text-align:right;"><strong>Subtotal:</strong></td>
        <td style="text-align:right; width: 30%;">
            <?= number_format($header->subtotal, 0, ',', '.') ?>
        </td>
    </tr>
    <tr>
        <td style="text-align:right;"><strong>Diskon:</strong></td>
        <td style="text-align:right;">
            - <?= number_format($header->diskon, 0, ',', '.') ?>
        </td>
    </tr>
    <tr>
        <td style="text-align:right;"><strong>Total:</strong></td>
        <td style="text-align:right;"><strong>
            <?= number_format($header->total, 0, ',', '.') ?>
        </strong></td>
    </tr>
</table>

<script>
    window.print();
</script>

</body>
</html>
