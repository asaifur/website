<?php
$current_url = uri_string();
$slug = $this->uri->segment(1);

// Menyiapkan fallback gambar Open Graph
$default_og_image = !empty($domain->logo) ? $domain->logo : (!empty($domain->image_domain) ? $domain->image_domain : 'default.png');
$og_image_url = !empty($page->og_image) ? $page->og_image : ($domain->meta_og_image ?? $default_og_image);

// Logika Favicon (Prioritas: images_pages -> favicon -> logo -> default.png)
$favicon_img = !empty($pages->images_pages)
    ? $pages->images_pages
    : (!empty($domain->favicon) ? $domain->favicon : (!empty($domain->logo) ? $domain->logo : 'default.png'));

$status = http_response_code();
$robots = ($status == 404) ? 'noindex,follow' : ($domain->robots_index ?? 'index,follow');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= !empty($page->meta_title) ? $page->meta_title : ($domain->meta_title ?? 'WELDORK - Welding Services'); ?></title>

    <meta name="description" content="<?= $page->meta_description ?? ($domain->meta_description ?? ''); ?>">
    <meta name="keywords" content="<?= $page->keywords ?? ($domain->meta_keywords ?? ''); ?>">
    <meta name="author" content="<?= $domain->domain_name ?? ($domain->meta_author ?? 'Weldork'); ?>">
    <meta name="robots" content="<?= $robots; ?>">
    <meta name="language" content="Indonesian">

    <link rel="canonical" href="<?= base_url($current_url); ?>">

    <!-- Open Graph / Facebook -->
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

    <!-- Geo Tags -->
    <?php if (!empty($domain->geo_placename)) : ?>
        <meta name="geo.placename" content="<?= $domain->geo_placename; ?>">
    <?php endif; ?>
    <?php if (!empty($domain->geo_position)) : ?>
        <meta name="geo.position" content="<?= $domain->geo_position; ?>">
    <?php endif; ?>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?= base_url('assets/uploads/img/' . $favicon_img); ?>">

    <!-- Google Site Verification -->
    <?php if (!empty($domain->meta_google_site_verification)) : ?>
        <meta name="google-site-verification" content="<?= $domain->meta_google_site_verification; ?>">
    <?php endif; ?>

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Roboto:wght@700;800&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">

    <!-- Libraries Stylesheet -->
    <link href="<?= base_url('assets/weldork/lib/animate/animate.min.css'); ?>" rel="stylesheet">
    <link href="<?= base_url('assets/weldork/lib/owlcarousel/assets/owl.carousel.min.css'); ?>" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?= base_url('assets/weldork/css/bootstrap.min.css'); ?>" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="<?= base_url('assets/weldork/css/style.css'); ?>" rel="stylesheet">

    <?= !empty($domain->link_google_tag) ? $domain->link_google_tag : ''; ?>
    <?= !empty($domain->link_google_analytics) ? $domain->link_google_analytics : ''; ?>
    <?= !empty($domain->link_event_snippet) ? $domain->link_event_snippet : ''; ?>

    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "WebSite",
            "url": "<?= base_url(); ?>",
            "name": "<?= $domain->meta_title ?? ($domain->domain_name ?? 'Weldork'); ?>",
            "potentialAction": {
                "@type": "SearchAction",
                "target": "<?= base_url('search?q={search_term_string}'); ?>",
                "query-input": "required name=search_term_string"
            }
        }
    </script>
</head>