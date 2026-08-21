<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            font-size: 12px;
            margin: 0;
            padding: 10px;
            width: 80mm;
            /* Ukuran standar kertas kasir/thermal 80mm */
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .line {
            border-bottom: 1px dashed #000;
            margin: 8px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td,
        th {
            padding: 3px 0;
            vertical-align: top;
        }

        .badge-tempo {
            font-weight: bold;
            text-transform: uppercase;
        }
    </style>
</head>

<body>

    <div class="text-center">
        <h3 style="margin: 0;">HTP Sinergi</h3>
        <p style="margin: 2px 0;">Jl. Raya Contoh No. 123<br>Telp: 0812-3456-7890</p>
    </div>

    <div class="line"></div>

    <table>
        <tr>
            <td>No. Faktur</td>
            <td>: <?= $penjualan->no_faktur ?></td>
        </tr>
        <tr>
            <td>Tanggal</td>
            <td>: <?= date('d/m/Y H:i', strtotime($penjualan->tanggal)) ?></td>
        </tr>
        <!-- INFORMASI JENIS TRANSAKSI & JATUH TEMPO -->
        <tr>
            <td>Pembayaran</td>
            <td class="badge-tempo">:
                <?php
                if ($penjualan->jenis_transaksi == 'tempo_2_minggu') {
                    echo 'TEMPO (2 MINGGU)';
                } else if ($penjualan->jenis_transaksi == 'tempo_1_bulan') {
                    echo 'TEMPO (1 BULAN)';
                } else {
                    echo 'CASH / TUNAI';
                }
                ?>
            </td>
        </tr>
        <?php if ($penjualan->jenis_transaksi != 'cash' && !empty($penjualan->jatuh_tempo)): ?>
            <tr>
                <td>Jatuh Tempo</td>
                <td>: <strong><?= date('d/m/Y', strtotime($penjualan->jatuh_tempo)) ?></strong></td>
            </tr>
        <?php endif; ?>
    </table>

    <div class="line"></div>

    <table>
        <thead>
            <tr>
                <th align="left">Item</th>
                <th align="center">Qty</th>
                <th align="right">Harga</th>
                <th align="right">Total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($detail as $item): ?>
                <tr>
                    <td><?= $item->nama_barang ?></td>
                    <td align="center"><?= $item->qty ?></td>
                    <td align="right"><?= number_format($item->harga, 0, ',', '.') ?></td>
                    <td align="right"><?= number_format($item->subtotal, 0, ',', '.') ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="line"></div>

    <table>
        <tr>
            <td><strong>TOTAL</strong></td>
            <td class="text-right"><strong>Rp <?= number_format($penjualan->total_bayar, 0, ',', '.') ?></strong></td>
        </tr>
        <?php if ($penjualan->jenis_transaksi == 'cash'): ?>
            <tr>
                <td>Bayar (Tunai)</td>
                <td class="text-right">Rp <?= number_format($penjualan->nominal_uang, 0, ',', '.') ?></td>
            </tr>
            <tr>
                <td>Kembali</td>
                <td class="text-right">Rp <?= number_format($penjualan->kembalian, 0, ',', '.') ?></td>
            </tr>
        <?php else: ?>
            <tr>
                <td>Bayar Awal/DP</td>
                <td class="text-right">Rp <?= number_format($penjualan->nominal_uang, 0, ',', '.') ?></td>
            </tr>
            <tr>
                <td>Sisa Piutang</td>
                <td class="text-right"><strong>Rp <?= number_format($penjualan->total_bayar - $penjualan->nominal_uang, 0, ',', '.') ?></strong></td>
            </tr>
        <?php endif; ?>
    </table>

    <div class="line"></div>

    <div class="text-center">
        <p style="margin: 5px 0;">-- Terima Kasih --<br>Barang yang sudah dibeli tidak dapat ditukar/dikembalikan.</p>
    </div>

</body>

</html>