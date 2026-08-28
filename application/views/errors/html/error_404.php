<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>404 Halaman Tidak Ditemukan</title>
	<style>
		* {
			box-sizing: border-box;
			margin: 0;
			padding: 0;
		}

		body {
			background-color: #f4f6f9;
			font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
			display: flex;
			justify-content: center;
			align-items: center;
			height: 100vh;
			color: #333;
		}

		.error-container {
			text-align: center;
			background: #ffffff;
			padding: 40px 30px;
			border-radius: 12px;
			box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
			max-width: 450px;
			width: 90%;
		}

		.error-code {
			font-size: 80px;
			font-weight: bold;
			color: #e13300;
			line-height: 1;
			margin-bottom: 10px;
		}

		h1 {
			font-size: 22px;
			color: #222;
			margin-bottom: 15px;
			font-weight: 600;
		}

		p {
			font-size: 14px;
			color: #666;
			line-height: 1.6;
			margin-bottom: 25px;
		}

		.btn-home {
			display: inline-block;
			background-color: #007bff;
			color: #ffffff;
			padding: 12px 24px;
			font-size: 14px;
			font-weight: 600;
			text-decoration: none;
			border-radius: 6px;
			transition: background-color 0.2s ease;
		}

		.btn-home:hover {
			background-color: #0056b3;
		}
	</style>
</head>

<body>
	<div class="error-container">
		<div class="error-code">404</div>
		<h1><?php echo !empty($heading) ? $heading : 'Halaman Tidak Ditemukan'; ?></h1>
		<p><?php echo !empty($message) ? $message : 'Maaf, halaman atau artikel yang Anda cari tidak tersedia atau telah dipindahkan.'; ?></p>
		<a href="<?php echo config_item('base_url'); ?>" class="btn-home">Kembali ke Beranda</a>
	</div>
</body>

</html>