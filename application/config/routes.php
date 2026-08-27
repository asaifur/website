<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/ // Reserved Routes$route['default_controller']   = 'Home';

// PASTIKAN BARIS INI ADA DAN KONTROLLER TERSEDIA
$route['default_controller']   = 'Home'; // Merujuk ke application/controllers/Home.php
$route['404_override']         = 'My404';
$route['translate_uri_dashes'] = FALSE;

// Admin & Auth Routes
$route['admin']                 = 'admin/index';
$route['admin/login']           = 'admin/index';
$route['admin/proses_login']    = 'admin/proses_login';
$route['admin/logout']          = 'admin/logout';
$route['admin/forgot_password'] = 'admin/forgot_password';
$route['verifikasi-otp']       = 'auth/verifikasi_otp_view';

// Dashboard Routes
$route['dashboard']             = 'dashboard/navigasi';
$route['dashboard/(:any)']      = 'dashboard/$1';


$route['home/ajax_list'] = 'home/ajax_list';


// Static Routes
$route['korra/projects']       = 'korra/projects';
$route['korra/submit_contact'] = 'korra/submit_contact';

// Dynamic Route (Wajib di Paling Bawah)
$route['(:any)']               = 'Home/index/$1';
// Mendukung akses /website?slug=amiraw// Menangani URL friendly: domain.com/website/amiraw
$route['website/(:any)'] = 'website/index/$1';

// Opsional: jika pengguna mengakses /website saja tanpa slug
$route['website'] = 'website/index';

// Routing halaman utama blog
$route['blog'] = 'blog/index';

// Routing pagination blog (contoh: /blog/index/6)
$route['blog/index/(:num)'] = 'blog/index/$1';

// Routing detail artikel (contoh: /blog/cara-instalasi-ducting)
$route['blog/(:any)'] = 'blog/read/$1';
