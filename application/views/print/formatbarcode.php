<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export Barcode</title>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+3:wght@200&display=swap" rel="stylesheet">
    <style>
        @page {
            size: 33mm 15mm;
            margin: 0;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Source Sans 3', sans-serif; /* Set the default font */
        }

        table {
            width: 100%;
            height: 100%;
            border-collapse: collapse;
        }

        td {
            width: 33mm;
            height: 15mm;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 2px; /* Adjusted padding */
            box-sizing: border-box;
            text-align: center; /* Center text within the cell */
        }

        h6 {
            margin: 0;
            font-size: 4pt;
            font-family: 'Source Sans 3', sans-serif; 
            font-weight: 600;
            font-style: normal;
            word-wrap: break-word;
            text-transform: uppercase;
            width: 100%;
            height: auto;
        }

        img {
            width: 88px;
            height: 38px;
            object-fit: contain;
        }
    </style>
    <script>
        window.onafterprint = window.close;
        window.print();
  </script>
</head>
<body>
    <table>
        <?php foreach ($products as $product): ?>
            <tr>
                <td>
                    <h6><?php echo $product['nama_brg']; ?></h6>
                    <img src="<?= base_url() ?>assets/dhdokumen/snbarcode/<?php echo $product['sn_brg']; ?>.jpg" alt="Product Image">
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
