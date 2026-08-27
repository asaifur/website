<?php
$current_url = uri_string();
$slug = $this->uri->segment(1);

// Menyiapkan fallback gambar default
$default_og_image = !empty($domain->logo) ? $domain->logo : (!empty($domain->image_domain) ? $domain->image_domain : 'default.png');
$og_image_url = !empty($page->og_image) ? $page->og_image : ($domain->meta_og_image ?? $default_og_image);

$status = http_response_code();
$robots = ($status == 404) ? 'noindex,follow' : ($domain->robots_index ?? 'index,follow');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= !empty($page->meta_title) ? $page->meta_title : ($domain->meta_title ?? 'Solusi Dapur Restoran'); ?></title>

    <meta name="description" content="<?= $page->meta_description ?? ($domain->meta_description ?? ''); ?>">
    <meta name="keywords" content="<?= $page->keywords ?? ($domain->meta_keywords ?? ''); ?>">
    <meta name="author" content="<?= $domain->domain_name ?? ($domain->meta_author ?? 'Solusi Dapur Restoran'); ?>">
    <meta name="robots" content="<?= $robots; ?>">
    <meta name="language" content="Indonesian">

    <link rel="canonical" href="<?= base_url($current_url); ?>">

    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?= !empty($page->meta_title) ? $page->meta_title : ($domain->meta_title ?? ''); ?>">
    <meta property="og:description" content="<?= $page->meta_description ?? ($domain->meta_description ?? ''); ?>">
    <meta property="og:url" content="<?= base_url($current_url); ?>">
    <meta property="og:image" content="<?= base_url('assets/uploads/img/' . $og_image_url); ?>">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= !empty($page->meta_title) ? $page->meta_title : ($domain->meta_title ?? ''); ?>">
    <meta name="twitter:description" content="<?= $page->meta_description ?? ($domain->meta_description ?? ''); ?>">
    <meta name="twitter:image" content="<?= base_url('assets/uploads/img/' . $og_image_url); ?>">

    <!-- Geo Tag -->
    <?php if (!empty($domain->geo_placename)) : ?>
        <meta name="geo.placename" content="<?= $domain->geo_placename; ?>">
    <?php endif; ?>
    <?php if (!empty($domain->geo_position)) : ?>
        <meta name="geo.position" content="<?= $domain->geo_position; ?>">
    <?php endif; ?>

    <!-- Favicon -->
    <!-- Favicon -->
    <?php
    $favicon_img = !empty($pages->images_pages)
        ? $pages->images_pages
        : (!empty($domain->favicon) ? $domain->favicon : (!empty($domain->logo) ? $domain->logo : 'default.png'));
    ?>
    <link rel="icon" type="image/png" href="<?= base_url('assets/uploads/img/' . $favicon_img); ?>">
    <!-- Google Verification -->
    <?php if (!empty($domain->meta_google_site_verification)) : ?>
        <meta name="google-site-verification" content="<?= $domain->meta_google_site_verification; ?>">
    <?php endif; ?>

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@400;700&family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="<?= base_url('assets/painter/lib/owlcarousel/assets/owl.carousel.min.css'); ?>" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?= base_url('assets/painter/css/bootstrap.min.css'); ?>" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="<?= base_url('assets/painter/css/style.css'); ?>" rel="stylesheet">
    <style>
        :root {
            --steel-dark: #121416;
            --steel-charcoal: #1f2428;
            --steel-base: #2b3035;
            --steel-silver: #8a9ba8;
            --steel-highlight: #d1d5db;
            --steel-light: #f3f4f6;
            --steel-gradient: linear-gradient(145deg, #2a2e33 0%, #15181b 100%);
            --metallic-plate: linear-gradient(135deg, #e5e7eb 0%, #9ca3af 50%, #4b5563 100%);
        }

        body {
            background-color: var(--steel-dark) !important;
            color: var(--steel-light) !important;
            background-image: radial-gradient(#2b3035 1px, transparent 1px);
            background-size: 20px 20px;
        }

        /* Card, Container, & Sidebar */
        .bg-light,
        .card,
        .navbar-light,
        .footer {
            background: var(--steel-gradient) !important;
            border-color: #3e444a !important;
            color: var(--steel-light) !important;
        }

        .bg-white {
            background-color: var(--steel-charcoal) !important;
            color: #ffffff !important;
        }

        /* Heading & Teks */
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            color: #ffffff !important;
            letter-spacing: 0.5px;
        }

        .text-muted {
            color: var(--steel-silver) !important;
        }

        /* Button Efek Stainless Steel */
        .btn-primary {
            background: linear-gradient(180deg, #6b7280 0%, #374151 100%) !important;
            border: 1px solid #9ca3af !important;
            color: #ffffff !important;
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 2px 4px rgba(0, 0, 0, 0.4);
        }

        .btn-primary:hover {
            background: linear-gradient(180deg, #4b5563 0%, #1f2937 100%) !important;
            border-color: #d1d5db !important;
            color: #f3f4f6 !important;
        }

        .btn-secondary {
            background: #1f2428 !important;
            border: 1px solid #4b5563 !important;
            color: var(--steel-highlight) !important;
        }

        /* Border & Garis Pembatas Metalik */
        hr,
        .border,
        .border-top,
        .border-bottom {
            border-color: #374151 !important;
        }

        /* Navbar & Nav-link */
        .navbar-light .navbar-nav .nav-link {
            color: var(--steel-highlight) !important;
        }

        .navbar-light .navbar-nav .nav-link:hover,
        .navbar-light .navbar-nav .nav-link.active {
            color: #ffffff !important;
            border-bottom: 2px solid var(--steel-silver);
        }
    </style>
    <!-- JSON-LD Schema Markup -->
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "Organization",
            "name": "<?= $domain->meta_title ?? ($domain->domain_name ?? ''); ?>",
            "url": "<?= base_url(); ?>",
            "logo": "<?= base_url('assets/uploads/img/' . ($domain->logo ?? ($domain->image_domain ?? 'default.png'))); ?>",
            "sameAs": []
        }
    </script>
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "WebSite",
            "url": "<?= base_url(); ?>",
            "name": "<?= $domain->meta_title ?? ($domain->domain_name ?? ''); ?>",
            "potentialAction": {
                "@type": "SearchAction",
                "target": "<?= base_url('search?q={search_term_string}'); ?>",
                "query-input": "required name=search_term_string"
            }
        }
    </script>
</head>