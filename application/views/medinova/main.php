<?php
$current_url = uri_string();
$slug = $this->uri->segment(1);
$domain = $domain ?? [
    'logo' => 'default.png',
    'favicon' => 'default.png',
    'meta_author' => 'Solusi Dapur Restoran',
    'meta_og_image' => 'default.png',
    'robots_index' => 'index,follow'
];
$status = http_response_code();
$robots = ($status == 404) ? 'noindex,follow' : 'index,follow';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">

    <!-- Title -->
    <title><?= $domain['meta_title'] ?></title>

    <!-- Viewport -->
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- Primary SEO -->
    <meta name="keywords" content="<?= $domain['keywords'] ?>">

    <meta name="description" content="<?= $pages['description'] ?>">

    <meta name="author" content="<?= $domain['meta_author'] ?>">

    <meta name="robots" content="<?= $robots; ?>">



    <!-- Canonical -->
    <link rel="canonical" href="<?= $current_url; ?>">

    <!-- Open Graph (Facebook / WhatsApp) -->
    <meta property="og:title" content="<?= $domain['meta_title'] ?>">
    <meta property="og:description" content="<?= $pages['description'] ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= $current_url; ?>">
    <meta property="og:image" content="<?= base_url('assets/uploads/img/') . $domain['image_domain']; ?>">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <!-- Viewport -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Primary SEO -->
    <meta name="title" content="<?= $domain['meta_title'];  ?>">

    <meta name="description" content="<?= $domain['meta_description']; ?>">

    <meta name="keywords" content="<?= $domain['meta_keywords']; ?>">

    <meta name="author" content="<?= $domain['meta_title']; ?>">
    <meta name="robots" content="index, follow">
    <meta name="language" content="Indonesian">
    <meta name="revisit-after" content="7 days">

    <!-- Canonical -->
    <link rel="canonical" href="<?= $current_url; ?>">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?= base_url('assets/uploads/img/') . $domain['image_domain']; ?>">

    <!-- Open Graph (Facebook / WhatsApp / LinkedIn) -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= $current_url; ?>">
    <meta property="og:title" content="<?= $domain['meta_title']; ?>">
    <meta property="og:description" content="<?= $domain['meta_description']  ?>">
    <meta property="og:image" content="<?= base_url('assets/uploads/img/') . $domain['image_domain']; ?>">
    <meta property="og:site_name" content="<?= $domain['meta_title'];  ?>">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="<?= $current_url; ?>">
    <meta name="twitter:title" content="<?= $domain['meta_title']; ?>">
    <meta name="twitter:description" content="<?= $domain['meta_description']; ?>">
    <meta name="twitter:image" content="<?= base_url('assets/uploads/img/') . $domain['image_domain']; ?>">

    <!-- Geo Tag Indonesia SEO -->
    <meta name="geo.placename" content="<?= $domain['geo_placename'] ?>">
    <meta name="geo.position" content="<?= $domain['geo_position']; ?>">

    <!-- Mobile / App Meta -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="<?= $domain['meta_title'] ?>">

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <!-- Google Site Verification (Isi jika ada) -->
    <meta name="google-site-verification" content="<?= $domain['meta_google_site_verification']; ?>">

    <!-- Bing Verification -->
    <link href="<?= base_url('assets/uploads/img/') . $domain['image_domain'] ?>" rel="icon">

    <!-- Google Web Fonts -->
    <!-- Google Font Montserrat -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="<?= base_url('assets/medinova/lib/owlcarousel/assets/owl.carousel.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/medinova/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') ?>" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?= base_url('assets/medinova/css/bootstrap.min.css') ?>" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="<?= base_url('assets/medinova/css/style.css') ?>" rel="stylesheet">
</head>


<body>
    <!-- Topbar Start -->
    <div class="container-fluid py-2 border-bottom d-none d-lg-block">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-lg-start mb-2 mb-lg-0">
                    <div class="d-inline-flex align-items-center">
                        <a class="text-decoration-none text-body pe-3" href="<?= $domain['wa_link'] ?>"><i
                                class="bi bi-telephone me-2"></i><?= $domain['telepon'] ?></a>
                        <span class="text-body">|</span>
                        <a class="text-decoration-none text-body px-3" href="#!"><i
                                class="bi bi-envelope me-2"></i><?= $domain['email'] ?></a>
                    </div>
                </div>
                <div class="col-md-6 text-center text-lg-end">
                    <div class="d-inline-flex align-items-center">
                        <a class="text-body px-2" href="#!">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a class="text-body px-2" href="#!">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a class="text-body px-2" href="#!">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a class="text-body px-2" href="#!">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a class="text-body ps-2" href="#!">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid sticky-top bg-white shadow-sm">
        <div class="container">
            <nav class="navbar navbar-expand-lg bg-white navbar-light py-3 py-lg-0">
                <?php if ($image_title == 1) { ?>

                <?php } else { ?>
                    <a href="<?= base_url() ?>" class="navbar-brand">
                        <h1 class="m-0 text-uppercase text-primary"><?= $domain['meta_title'] ?></h1>
                    </a>
                <?php } ?>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0">


                        <?php
                        foreach ($menu_header_utama_website->result_array() as $menu):

                            $url = !empty($menu['slug'])
                                ? base_url($menu['slug'])
                                : base_url();

                            $active = ($current_url == $menu['slug']) ? 'active' : '';

                            $target = $menu['target'] ?? '_self';
                        ?>

                            <?php if ($menu['have_child'] == 1) { ?>
                                <div class="nav-item dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                        <?= $menu['nama_menu'] ?>
                                    </a>

                                    <div class="dropdown-menu m-0">
                                        <?php
                                        $menu_child = $this->Menu_model->fetch_data(
                                            'table_menu_navigasi',
                                            [
                                                'parent_id' => $menu['id'],
                                                'url_id'    => $this->domain_id
                                            ]
                                        )->result();
                                        ?>

                                        <?php foreach ($menu_child as $child): ?>
                                            <a href="<?= base_url($child->slug) ?>" class="dropdown-item">
                                                <?= $child->nama_menu ?>
                                            </a>
                                        <?php endforeach; ?>
                                    </div>
                                </div>

                            <?php } else { ?>

                                <a href="<?= $url ?>"
                                    target="<?= $target ?>"
                                    class="nav-item nav-link <?= $active ?>">
                                    <?= $menu['nama_menu'] ?>
                                </a>

                            <?php } ?>

                        <?php endforeach; ?>

                    </div>
                </div>

            </nav>
        </div>
    </div>
    <!-- Navbar End -->
    <div id="contents" class="content">
        <?= $contents ?>

    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('assets/medinova/lib/') ?>easing/easing.min.js"></script>
    <script src="<?= base_url('assets/medinova/lib/') ?>waypoints/waypoints.min.js"></script>
    <script src="<?= base_url('assets/medinova/lib/') ?>owlcarousel/owl.carousel.min.js"></script>
    <script src="<?= base_url('assets/medinova/lib/') ?>tempusdominus/js/moment.min.js"></script>
    <script src="<?= base_url('assets/medinova/lib/') ?>tempusdominus/js/moment-timezone.min.js"></script>
    <script src="<?= base_url('assets/medinova/lib/') ?>tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="<?= base_url('assets/medinova/js/') ?>main.js"></script>
</body>

</html>