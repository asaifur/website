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
    'primary_color' => '#E63946',
    'navy_color' => '#0B132B'
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
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- SEO Meta Tags -->
    <title><?= !empty($page->meta_title) ? $page->meta_title : ($domain->meta_title ?? $domain->title ?? 'Portal Berita Terkini'); ?></title>
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
    <meta name="ICBM" content="<?= !empty($domain->geo_icbm) ? $domain->geo_icbm : '-6.4025, 106.8186'; ?>">

    <?php
    $primary_color = function_exists('get_color') ? get_color('primary') : (!empty($domain->primary_color) ? $domain->primary_color : '#E63946');
    $navy_color = function_exists('get_color') ? get_color('navy') : (!empty($domain->navy_color) ? $domain->navy_color : '#0B132B');
    ?>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?= base_url('assets/uploads/img/') . (is_object($domain) ? ($domain->favicon ?? $domain->logo) : ($domain['favicon'] ?? $domain['logo'])); ?>">

    <!-- Google Site Verification -->
    <?php if (!empty($domain->meta_google_site_verification)) : ?>
        <meta name="google-site-verification" content="<?= $domain->meta_google_site_verification; ?>">
    <?php endif; ?>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '<?= $primary_color; ?>',
                        navy: '<?= $navy_color; ?>',
                        darkGray: '#1e293b',
                        steel: '#475569',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <!-- Google Web Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/themify/themify-icons/themify-icons.css">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

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

        .reveal {
            opacity: 0;
            visibility: hidden;
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

<body class="bg-slate-50 text-slate-800 font-sans antialiased">

    <!-- Header / Navbar dengan Menu Dinamis dari Database -->
    <header class="bg-white border-b border-slate-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex-shrink-0">
                    <a href="<?= base_url(); ?>" class="text-2xl font-black text-navy uppercase tracking-wider">
                        <?= is_object($domain) ? explode('.', $domain->domain_name)[0] : 'News'; ?><span class="text-primary">Portal </span>
                    </a>
                </div>
                <nav class="hidden md:flex space-x-8 text-sm font-semibold uppercase tracking-wider text-slate-600">
                    <?php
                    // Mengambil menu dinamis dari database jika variabel $menus tersedia, atau fallback default
                    $nav_menus = isset($menus) && is_array($menus) ? $menus : [
                        ['title' => 'Beranda', 'slug' => ''],
                        ['title' => 'Nasional', 'slug' => 'nasional'],
                        ['title' => 'Teknologi', 'slug' => 'teknologi'],
                        ['title' => 'Bisnis', 'slug' => 'bisnis'],
                        ['title' => 'Gaya Hidup', 'slug' => 'gaya-hidup']
                    ];

                    foreach ($nav_menus as $menu):
                        $menu_label = is_array($menu) ? $menu['nama_menu'] : $menu->label;
                        $menu_url = is_array($menu) ? $menu['slug'] : $menu->url;
                        $is_active = ($current_url == trim(parse_url($menu_url, PHP_URL_PATH), '/')) ? 'text-primary' : 'hover:text-primary';
                    ?>
                        <a href="<?= $menu_url; ?>" class="<?= $is_active; ?> transition-colors"><?= $menu_label; ?></a>
                    <?php endforeach; ?>
                </nav>
                <div class="flex items-center space-x-4">
                    <span class="text-xs font-bold bg-primary/10 text-primary px-3 py-1.5 rounded-full"><i class="fa-regular fa-calendar mr-1"></i> <?= date('D, d M Y'); ?></span>
                </div>
            </div>
        </div>
    </header>