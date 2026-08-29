<?php
$current_url = uri_string();
$slug = $this->uri->segment(1);
$domain = $domain ?? (object) [
    'logo' => 'default.png',
    'favicon' => 'default.png',
    'meta_title' => '',
    'meta_author' => '',
    'domain_name' => 'solusidapurrestoran.com',
    'meta_og_image' => 'default.png',
    'robots_index' => 'index,follow',
    'geo_placename' => 'Indonesia',
    'geo_position' => '',
    'primary_color' => '#b91c1c',
    'navy_color' => '#0f172a'
];

$status = http_response_code();
$robots = ($status == 404) ? 'noindex,nofollow' : (!empty($domain->robots_index) ? $domain->robots_index : 'index,follow');

$og_image_url = '';
if (!empty($page->image_features)) {
    $og_image_url = filter_var($page->image_features, FILTER_VALIDATE_URL) ? $page->image_features : base_url('assets/uploads/img/') . $page->image_features;
} elseif (!empty($page->image)) {
    $og_image_url = filter_var($page->image, FILTER_VALIDATE_URL) ? $page->image : base_url('assets/uploads/img/') . $page->image;
} elseif (!empty($page->og_image)) {
    $og_image_url = base_url('assets/uploads/img/') . $page->og_image;
} else {
    $og_image_url = base_url('assets/uploads/img/') . (is_object($domain) ? $domain->logo : $domain['logo']);
}
?>
<!doctype html>
<html class="no-js" lang="id">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <!-- SEO Meta Tags -->
    <title><?= !empty($page->meta_title) ? $page->meta_title : ($domain->meta_title ?? $domain->title ?? ''); ?></title>
    <meta name="description" content="<?= !empty($page->meta_description) ? $page->meta_description : ($domain->meta_description ?? ''); ?>">
    <meta name="keywords" content="<?= !empty($page->keywords) ? $page->keywords : ($domain->keywords ?? ''); ?>">
    <meta name="author" content="<?= is_object($domain) ? ($domain->domain_name ?? $domain->meta_author ?? '') : ($domain['domain_name'] ?? ''); ?>">
    <meta name="robots" content="<?= $robots; ?>">
    <meta name="language" content="Indonesian">
    <meta name="geo.region" content="ID">

    <link rel="canonical" href="<?= base_url($current_url); ?>">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="article">
    <meta property="og:site_name" content="<?= is_object($domain) ? ($domain->domain_name ?? '') : ''; ?>">
    <meta property="og:title" content="<?= !empty($page->meta_title) ? $page->meta_title : ($domain->meta_title ?? ''); ?>">
    <meta property="og:description" content="<?= !empty($page->meta_description) ? $page->meta_description : ''; ?>">
    <meta property="og:url" content="<?= base_url($current_url); ?>">
    <meta property="og:image" content="<?= $og_image_url; ?>">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= !empty($page->meta_title) ? $page->meta_title : ($domain->meta_title ?? ''); ?>">
    <meta name="twitter:description" content="<?= !empty($page->meta_description) ? $page->meta_description : ''; ?>">
    <meta name="twitter:image" content="<?= $og_image_url; ?>">

    <!-- Geo Tag -->
    <?php if (!empty($domain->geo_placename)) : ?>
        <meta name="geo.placename" content="<?= $domain->geo_placename; ?>">
    <?php endif; ?>
    <?php if (!empty($domain->geo_position)) : ?>
        <meta name="geo.position" content="<?= $domain->geo_position; ?>">
    <?php endif; ?>

    <?php
    $primary_color = function_exists('get_color') ? get_color('primary') : (!empty($domain->primary_color) ? $domain->primary_color : '#b91c1c');
    $navy_color    = function_exists('get_color') ? get_color('navy') : (!empty($domain->navy_color) ? $domain->navy_color : '#0f172a');
    ?>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="<?= base_url('assets/uploads/img/') . (is_object($domain) ? ($domain->favicon ?? $domain->logo) : ($domain['favicon'] ?? $domain['logo'])); ?>">

    <!-- Google Site Verification -->
    <?php if (!empty($domain->meta_google_site_verification)) : ?>
        <meta name="google-site-verification" content="<?= $domain->meta_google_site_verification; ?>">
    <?php endif; ?>

    <!-- CSS here -->
    <link rel="stylesheet" href="<?= base_url('assets/news/') ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/news/') ?>assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/news/') ?>assets/css/ticker-style.css">
    <link rel="stylesheet" href="<?= base_url('assets/news/') ?>assets/css/flaticon.css">
    <link rel="stylesheet" href="<?= base_url('assets/news/') ?>assets/css/slicknav.css">
    <link rel="stylesheet" href="<?= base_url('assets/news/') ?>assets/css/animate.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/news/') ?>assets/css/magnific-popup.css">
    <link rel="stylesheet" href="<?= base_url('assets/news/') ?>assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/news/') ?>assets/css/themify-icons.css">
    <link rel="stylesheet" href="<?= base_url('assets/news/') ?>assets/css/slick.css">
    <link rel="stylesheet" href="<?= base_url('assets/news/') ?>assets/css/nice-select.css">
    <link rel="stylesheet" href="<?= base_url('assets/news/') ?>assets/css/style.css">

    <style>
        .bg-primary {
            background-color: <?= $primary_color; ?> !important;
        }

        .text-primary {
            color: <?= $primary_color; ?> !important;
        }

        .border-primary {
            border-color: <?= $primary_color; ?> !important;
        }

        .bg-navy {
            background-color: <?= $navy_color; ?> !important;
        }

        .text-navy {
            color: <?= $navy_color; ?> !important;
        }

        .border-navy {
            border-color: <?= $navy_color; ?> !important;
        }
    </style>

    <!-- Schema.org JSON-LD -->
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "WebPage",
            "name": "<?= !empty($page->meta_title) ? $page->meta_title : ''; ?>",
            "description": "<?= !empty($page->meta_description) ? $page->meta_description : ''; ?>",
            "url": "<?= base_url($current_url); ?>",
            "publisher": {
                "@type": "Organization",
                "name": "<?= is_object($domain) ? ($domain->domain_name ?? '') : ''; ?>",
                "logo": {
                    "@type": "ImageObject",
                    "url": "<?= base_url('assets/uploads/img/') . (is_object($domain) ? $domain->logo : $domain['logo']); ?>"
                }
            }
        }
    </script>

    <?= !empty($domain->link_google_tag) ? $domain->link_google_tag : ''; ?>
    <?= !empty($domain->link_google_analytics) ? $domain->link_google_analytics : ''; ?>
</head>