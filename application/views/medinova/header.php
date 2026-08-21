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
    <meta name="author" content="<?= $domain->domain_name; ?>">
    <meta name="robots" content="<?= $robots; ?>">
    <meta name="language" content="Indonesian">

    <link rel="canonical" href="<?= $current_url; ?>">

    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?= $page->meta_title; ?>">
    <meta property="og:description" content="<?= $page->meta_description; ?>">
    <meta property="og:url" content="<?= $current_url; ?>">
    <meta property="og:image" content="<?= base_url('assets/uploads/img/') . $page->og_image; ?>">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= $page->meta_title; ?>">
    <meta name="twitter:description" content="<?= $page->meta_description; ?>">
    <meta name="twitter:image" content="<?= $page->og_image; ?>">

    <!-- Geo Tag -->
    <meta name="geo.placename" content="<?= $domain->geo_placename ?>">
    <meta name="geo.position" content="<?= $domain->geo_position; ?>">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?= base_url('assets/uploads/img/') . $domain->logo; ?>">

    <!-- Google Verification -->
    <?php if (!empty($domain->meta_google_site_verification)) : ?>
        <meta name="google-site-verification" content="<?= $domain->meta_google_site_verification; ?>">
    <?php endif; ?>
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@400;700&family=Roboto:wght@400;700&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="<?= base_url('assets/medinova/') ?>lib/owlcarousel/assets/owl.carousel.css" rel="stylesheet">
    <link href="<?= base_url('assets/medinova/') ?>lib/tempusdominus/css/tempusdominus-bootstrap-4.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?= base_url('assets/medinova/') ?>css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="<?= base_url('assets/medinova/') ?>css/style.css" rel="stylesheet">
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "Organization",
            "name": "<?= $domain->meta_title; ?>",
            "url": "<?= base_url(); ?>",
            "logo": "<?= base_url('assets/uploads/img/') . $domain->logo; ?>",
            "sameAs": []
        }
    </script>

    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "WebSite",
            "url": "<?= base_url(); ?>",
            "name": "<?= $domain->meta_title; ?>",
            "potentialAction": {
                "@type": "SearchAction",
                "target": "<?= base_url(); ?>search?q={search_term_string}",
                "query-input": "required name=search_term_string"
            }
        }
    </script>
</head>