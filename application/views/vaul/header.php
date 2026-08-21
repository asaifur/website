<?php
$current_url = uri_string();
$slug = $this->uri->segment(1);
$domain = $domain ?? [
    'logo' => 'default.png',
    'favicon' => 'default.png',
    'meta_author' => 'optima digital solution',
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
    <?php if (!empty($domain->meta_google_site_verification)) : ?>
        <meta name="google-site-verification" content="<?= $domain->meta_google_site_verification; ?>">
    <?php endif; ?>
    <!-- Geo Tag -->
    <meta name="geo.placename" content="<?= $domain->geo_placename ?>">
    <meta name="geo.position" content="<?= $domain->geo_position; ?>">


    <title><?= $page->meta_title; ?></title>
    <!-- Google Font: Open Sans -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="icon" href="<?= base_url('assets/uploads/img/') . $domain->logo; ?>">
    <link rel="stylesheet" href="<?= base_url('assets/vaul/') ?>style.css">
    <link rel="stylesheet" href="<?= base_url('assets/vaul/') ?>css/custom-override.css">
    <!-- Owl Carousel CSS -->
    <link href='https://fonts.googleapis.com/css?family=Lato:300,400,700,400italic,300italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>/assets/css/docs.theme.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/fontawesome.min.css">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <!-- Owl Stylesheets -->
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>assets/owlcarousel/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>assets/owlcarousel/assets/owl.theme.default.min.css">
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />


    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


    <style>
        /* Overlay background */
        .popup-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.75);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            opacity: 0;
            visibility: hidden;
            transition: 0.3s ease-in-out;
        }

        /* Show class */
        .popup-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        /* Popup content */
        .popup-content {
            position: relative;
            max-width: 90%;
            max-height: 90%;
            animation: zoomIn 0.3s ease;
        }

        .popup-content img {
            width: 100%;
            height: auto;
            border-radius: 10px;
        }

        /* Close button */
        .close-btn {
            position: absolute;
            top: -15px;
            right: -15px;
            background: white;
            color: black;
            font-size: 24px;
            width: 35px;
            height: 35px;
            border-radius: 50%;
            text-align: center;
            line-height: 35px;
            cursor: pointer;
            font-weight: bold;
        }

        /* Animation */
        @keyframes zoomIn {
            from {
                transform: scale(0.8);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
        }
    </style>


</head>