<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title><?= $title; ?></title>
    <meta name="robots" content="noindex,follow">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f8f9fa;
            text-align: center;
            padding: 80px;
        }

        h1 {
            font-size: 120px;
            margin: 0;
            color: #ff4d4f;
        }

        p {
            font-size: 20px;
            color: #555;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 25px;
            background: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }

        a:hover {
            background: #0056b3;
        }
    </style>

</head>

<body>

    <h1>404</h1>
    <p>Halaman tidak ditemukan</p>
    <p>URL yang Anda akses tidak tersedia.</p>

    <a href="<?= base_url(); ?>">Kembali ke Beranda</a>

</body>

</html>