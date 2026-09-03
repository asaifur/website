<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Kartu Tanda Anggota - <?= $user['username']; ?></title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f0f2f5;
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
        }

        .kta-container {
            width: 85.6mm;
            height: 54mm;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
            position: relative;
            overflow: hidden;
            margin: 20px auto;
            border: 1px solid #dcdcdc;
            box-sizing: border-box;
        }

        /* Top Right Styling */
        .kta-brand {
            position: absolute;
            top: 10px;
            right: 15px;
            text-align: right;
            z-index: 5;
        }

        .kta-brand h3 {
            margin: 0;
            font-size: 16px;
            font-weight: 900;
            color: #002D62;
            letter-spacing: 1px;
        }

        .kta-header-red {
            position: absolute;
            top: 0;
            right: 0;
            width: 180px;
            height: 25px;
            background: #dc3545;
            transform: skewX(-30deg);
            transform-origin: top right;
        }

        .kta-header-blue {
            position: absolute;
            top: 25px;
            right: 0;
            width: 210px;
            height: 12px;
            background: #002D62;
            transform: skewX(-30deg);
            transform-origin: top right;
        }

        /* Left Side Shapes */
        .kta-bg-blue-light {
            position: absolute;
            top: 0;
            left: 0;
            width: 110px;
            height: 100%;
            background: #6367FF;
            z-index: 1;
        }

        .kta-bg-blue-dark {
            position: absolute;
            top: 0;
            left: 0;
            width: 85px;
            height: 100%;
            background: #002D62;
            z-index: 2;
        }

        .kta-bg-red {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 150px;
            height: 70px;
            background: #dc3545;
            transform: skewY(20deg);
            z-index: 3;
        }

        /* Photo Frame */
        .kta-photo-box {
            position: absolute;
            top: 25px;
            left: 15px;
            width: 65px;
            height: 85px;
            background: #fff;
            border: 3px solid #fff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
            z-index: 4;
            border-radius: 3px;
            overflow: hidden;
        }

        .kta-photo-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Member Info */
        .kta-info {
            position: absolute;
            top: 45px;
            left: 115px;
            right: 15px;
            z-index: 4;
        }

        .kta-number {
            font-size: 11px;
            font-weight: bold;
            color: #b8860b;
            letter-spacing: 0.5px;
            margin-bottom: 2px;
        }

        .kta-name {
            font-size: 10px;
            font-weight: 800;
            color: #000000;
            text-transform: uppercase;
            line-height: 1.1;
            margin-bottom: 4px;
        }

        .kta-field {
            font-size: 8px;
            color: #333;
            margin-bottom: 1px;
        }

        .kta-institution {
            font-size: 9px;
            font-weight: 600;
            color: #222;
            margin-bottom: 4px;
        }

        .kta-contact {
            font-size: 7px;
            color: #444;
            line-height: 1.3;
        }

        /* Footer & Barcode */
        .kta-footer-text {
            position: absolute;
            bottom: 8px;
            left: 12px;
            font-size: 6px;
            color: #ffffff;
            z-index: 5;
            font-weight: bold;
        }

        .kta-barcode {
            position: absolute;
            bottom: 8px;
            right: 15px;
            background: #fff;
            padding: 1px 6px;
            border-radius: 2px;
            z-index: 4;
            font-family: monospace;
            font-size: 10px;
            font-weight: bold;
            letter-spacing: 1px;
            color: #000;
        }

        /* Print Action Styling */
        @media print {
            body {
                background: transparent;
            }

            .no-print {
                display: none;
            }

            .kta-container {
                margin: 0;
                box-shadow: none;
                border: none;
            }
        }
    </style>
</head>

<body>

    <div style="text-align: center; margin-top: 20px;" class="no-print">
        <button onclick="window.print()" style="padding: 10px 20px; background: #007bff; color: #fff; border: none; border-radius: 5px; cursor: pointer; font-weight: bold;">
            <i class="fas fa-print"></i> Cetak / Simpan PDF
        </button>
    </div>

    <div class="kta-container">
        <!-- Top Accents -->
        <div class="kta-header-red"></div>
        <div class="kta-header-blue"></div>
        <div class="kta-brand">
            <h3 style="color: #ffffff; font-weight: bold;"><?= $this->domain->title; ?></h3>
        </div>

        <!-- Left Background Layers -->
        <div class=" kta-bg-blue-light">
        </div>
        <div class="kta-bg-blue-dark"></div>
        <div class="kta-bg-red"></div>

        <!-- Photo -->
        <div class="kta-photo-box">
            <img src="<?= base_url('assets/uploads/img/' . (!empty($user['image']) ? $user['image'] : 'user4-128x128.jpg')); ?>" alt="Foto Anggota">
        </div>

        <!-- Data Content -->
        <div class="kta-info">
            <div class="kta-number"> <?= date('Ymd', strtotime($user['date_created'])) . '000' . $user['id_users']; ?></div>
            <div class="kta-name"><?= $user['username']; ?></div>
            <div class="kta-field"><strong><?= !empty($user['bidang_ilmu']) ? $user['bidang_ilmu'] : 'ILMU KEPENDIDIKAN'; ?></strong></div>
            <div class="kta-institution"><?= !empty($user['institusi']) ? $user['institusi'] : 'Perguruan Tinggi Nusantara'; ?></div>
            <div class="kta-contact">
                <div><?= !empty($user['phone']) ? $user['phone'] : '+62813-3637-3242'; ?> &nbsp;|&nbsp; <?= $user['email']; ?></div>
                <div><?= !empty($user['address']) ? $user['address'] : 'Jl. Letjen Suparman No 80, Jawa Barat'; ?></div>
            </div>
        </div>

        <!-- Footer -->
        <div class="kta-footer-text">SK KemenkumHAM RI nomor : AHU-0010575.AH.01.07.TAHUN 2019</div>
        <div class="kta-barcode"> <?= generate_member_barcode($user['date_created'], $user['id_users']); ?></div>
    </div>

</body>

</html>