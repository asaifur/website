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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= $page->meta_title; ?></title>

    <meta name="description" content="<?= $page->meta_description; ?>">
    <meta name="keywords" content="<?= $page->keywords; ?>">
    <meta name="author" content="<?= $page->meta_author; ?>">
    <meta name="robots" content="<?= $robots; ?>">
    <meta name="language" content="Indonesian">

    <link rel="canonical" href="<?= $current_url; ?>">

    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?= $domain->meta_title; ?>">
    <meta property="og:description" content="<?= $domain->meta_description; ?>">
    <meta property="og:url" content="<?= $current_url; ?>">
    <meta property="og:image" content="<?= base_url('assets/uploads/img/') . $page->og_image; ?>">
    <meta property="og:site_name" content="<?= $domain->meta_title; ?>">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= $page->meta_title; ?>">
    <meta name="twitter:description" content="<?= $page->meta_description; ?>">
    <meta name="twitter:image" content="<?= $page->og_image; ?>">

    <!-- Geo Tag -->
    <meta name="geo.placename" content="<?= $domain->geo_placename ?>">
    <meta name="geo.position" content="<?= $domain->geo_position; ?>">


    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@300;700&family=Work+Sans:wght@400;600&display=swap"
        rel="stylesheet">
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="<?= base_url('assets/posify/') ?>lib/animate/animate.css" rel="stylesheet">
    <link href="<?= base_url('assets/posify/') ?>lib/lightbox/css/lightbox.css" rel="stylesheet">
    <link href="<?= base_url('assets/posify/') ?>lib/owlcarousel/assets/owl.carousel.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?= base_url('assets/posify/') ?>css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="<?= base_url('assets/posify/') ?>css/style.css" rel="stylesheet">

</head>