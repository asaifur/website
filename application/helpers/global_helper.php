<?php

// function pre($exit = null){
// 	$CI = &get_instance();
// 	echo "<pre><hr>";
// 	print_r($CI->db->last_query());
// 	echo "<hr></pre>";
// 	// exit();
// }


function cekvar($var)
{
	$CI = &get_instance();
	echo "<pre>";
	print_r($var);
	echo "</pre>";
	exit();
}
function cekarray($var)
{
	$CI = &get_instance();
	echo "<pre>";
	print_r($var->result());
	echo "</pre>";

	exit();
}
function cekarray2($var)
{
	$CI = &get_instance();
	echo "<pre>";
	print_r($var);
	echo "</pre>";

	exit();
}
function cekdb()
{
	$CI = &get_instance();
	echo "<pre>";
	print_r($CI->db->last_query());
	echo "</pre>";
	exit();
}

function hitung_umur($tgl)
{
	if (!$tgl || $tgl == '0000-00-00') {
		return 'Tanggal tidak valid';
	}

	$birthDate = new DateTime($tgl);
	$today = new DateTime('today');
	$diff = $today->diff($birthDate);

	return $diff->y . ' Tahun ' . $diff->m . ' Bulan ' . $diff->d . ' Hari';
}
function akses_rol()
{
	// Anggap Role ID: 1 = Admin, 2 = Manager, 3 = Staff
	$menus = [
		[
			'title' => 'Dashboard',
			'icon' => 'fas fa-tachometer-alt',
			'link' => 'dashboard',
			'roles' => [1, 2, 3] // Semua bisa lihat
		],
		[
			'title' => 'User Management',
			'icon' => 'fas fa-users',
			'link' => 'users',
			'roles' => [1] // Hanya Admin
		],
		[
			'title' => 'Laporan Keuangan',
			'icon' => 'fas fa-money-bill',
			'link' => 'reports/finance',
			'roles' => [1, 2] // Admin & Manager
		],
		[
			'title' => 'Input Data',
			'icon' => 'fas fa-edit',
			'link' => 'entry/data',
			'roles' => [1, 3] // Admin & Staff
		]
	];
}

if (!function_exists('check_data_or_404')) {
	/**
	 * Memeriksa apakah data ada, jika tidak maka lempar halaman 404
	 * 
	 * @param mixed $data
	 * @return mixed
	 */
	function check_data_or_404($data)
	{
		if (empty($data)) {
			// Jika menggunakan CodeIgniter
			if (function_exists('show_404')) {
				show_404();
			} else {
				// Fallback jika PHP murni
				header("HTTP/1.0 404 Not Found");
				include('errors/html/error_404.php'); // Sesuaikan path file 404 Anda
				exit;
			}
		}
		return $data;
	}
}



if (!function_exists('get_color')) {
	/**
	 * Mengambil warna kustom tema domain dari database
	 * 
	 * @param string $type Tipe warna ('primary' atau 'navy')
	 * @return string Kode Hex Warna
	 */
	function get_color($type = 'primary')
	{
		$CI = &get_instance();

		// Ambil host domain yang sedang diakses saat ini
		$raw_host = $_SERVER['HTTP_HOST'] ?? 'localhost';
		$host = parse_url('http://' . $raw_host, PHP_URL_HOST);

		// Ambil data domain dari database
		$domain = $CI->db->get_where('table_domain', ['url_domain' => $host])->row();

		if ($domain) {
			if ($type == 'primary') {
				return !empty($domain->primary_color) ? $domain->primary_color : '#b91c1c';
			} elseif ($type == 'navy') {
				return !empty($domain->navy_color) ? $domain->navy_color : '#0f172a';
			}
		}

		// Fallback default jika domain tidak ditemukan di database
		return ($type == 'primary') ? '#b91c1c' : '#0f172a';
	}
}
