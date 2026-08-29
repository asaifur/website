<?php
$current = uri_string();
?>

<body class="antialiased overflow-x-hidden">
    <!-- Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <?php if (!empty($domain->image_domain)) : ?>
                        <img src="<?= base_url('assets/uploads/img/') . $domain->image_domain; ?>" alt="Logo Preloader" class="max-h-16 w-auto">
                    <?php else : ?>
                        <img src="<?= base_url('assets/news/') ?>assets/img/logo/logo.png" alt="Default Logo">
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader Start -->

    <header>
        <!-- Header Start -->
        <div class="header-area">
            <div class="main-header ">

                <!-- Top Bar (Contact Info & Socials) -->
                <div class="header-top black-bg d-none d-md-block">
                    <div class="container">
                        <div class="col-xl-12">
                            <div class="row d-flex justify-content-between align-items-center">
                                <div class="header-info-left">
                                    <ul>
                                        <?php if (!empty($domain->telepon)) : ?>
                                            <li><i class="fa-solid fa-phone text-primary mr-2"></i> <?= $domain->telepon ?></li>
                                        <?php endif; ?>
                                        <?php if (!empty($domain->email)) : ?>
                                            <li><i class="fa-solid fa-envelope text-primary mr-2"></i> <?= $domain->email ?></li>
                                        <?php endif; ?>
                                        <li><i class="fa-solid fa-clock text-primary mr-2"></i> Respon Darurat & Layanan 24/7</li>
                                    </ul>
                                </div>
                                <div class="header-info-right">
                                    <ul class="header-social">
                                        <?php if (!empty($domain->link_instagram)) : ?>
                                            <li><a href="<?= $domain->link_instagram ?>" target="_blank"><i class="fab fa-instagram"></i></a></li>
                                        <?php endif; ?>
                                        <?php if (!empty($domain->link_facebook)) : ?>
                                            <li><a href="<?= $domain->link_facebook ?>" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                        <?php endif; ?>
                                        <?php if (!empty($domain->link_youtube)) : ?>
                                            <li><a href="<?= $domain->link_youtube ?>" target="_blank"><i class="fab fa-youtube"></i></a></li>
                                        <?php endif; ?>
                                        <?php if (!empty($domain->link_twitter)) : ?>
                                            <li><a href="<?= $domain->link_twitter ?>" target="_blank"><i class="fab fa-twitter"></i></a></li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mid Bar (Logo & Banner) -->
                <div class="header-mid gray-bg">
                    <div class="container">
                        <div class="row d-flex align-items-center">
                            <!-- Logo -->
                            <div class="col-xl-3 col-lg-3 col-md-3 d-none d-md-block">
                                <div class="logo">
                                    <?php if (!empty($domain->image_domain)) : ?>
                                        <a href="<?= base_url(); ?>">
                                            <img src="<?= base_url('assets/uploads/img/') . $domain->image_domain; ?>" alt="Logo" class="max-h-20 w-auto object-contain">
                                        </a>
                                    <?php else : ?>
                                        <a href="<?= base_url(); ?>" class="flex items-center gap-2 group">
                                            <div class="w-12 h-12 bg-primary flex items-center justify-center rounded text-white font-black text-2xl tracking-tighter shadow-md group-hover:bg-primaryDark transition">
                                                SDR
                                            </div>
                                            <div>
                                                <span class="text-xl font-extrabold tracking-tight text-navy block leading-none">SOLUSI DAPUR</span>
                                                <span class="text-xs font-semibold text-primary tracking-widest uppercase">RESTORAN INDONESIA</span>
                                            </div>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <!-- Banner Header (Optional) -->
                            <div class="col-xl-9 col-lg-9 col-md-9">
                                <div class="header-banner f-right ">
                                    <img src="<?= base_url('assets/news/') ?>assets/img/gallery/header_card.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bottom Bar (Main Navigation & Sticky) -->
                <div class="header-bottom header-sticky">
                    <div class="container">
                        <div class="row align-items-center">
                            <!-- Desktop Menu -->
                            <div class="col-xl-10 col-lg-10 col-md-12 header-flex">
                                <!-- Sticky Logo (Visible when sticky) -->
                                <div class="sticky-logo">
                                    <?php if (!empty($domain->image_domain)) : ?>
                                        <a href="<?= base_url(); ?>">
                                            <img src="<?= base_url('assets/uploads/img/') . $domain->image_domain; ?>" alt="Sticky Logo" class="max-h-12 w-auto">
                                        </a>
                                    <?php endif; ?>
                                </div>
                                <!-- Main Menu (Dynamic from $menus) -->
                                <div class="main-menu d-none d-md-block">
                                    <nav>
                                        <ul id="navigation">
                                            <?php if (!empty($menus)) : ?>
                                                <?php foreach ($menus as $menu) :
                                                    $menuSlug = is_array($menu) ? $menu['slug'] : $menu->slug;
                                                    $menuName = is_array($menu) ? $menu['nama_menu'] : $menu->nama_menu;
                                                    $children = is_array($menu) ? ($menu['children'] ?? []) : ($menu->children ?? []);

                                                    $isActiveParent = ($current == $menuSlug || $current == trim($menuSlug, '/'));
                                                    $isChildActive = false;

                                                    if (!empty($children)) {
                                                        foreach ($children as $child) {
                                                            $childSlug = is_array($child) ? $child['slug'] : $child->slug;
                                                            if ($current == $childSlug || $current == trim($childSlug, '/')) {
                                                                $isChildActive = true;
                                                                break;
                                                            }
                                                        }
                                                    }
                                                ?>
                                                    <li class="<?= !empty($children) ? 'has-megamenu' : ''; ?>">
                                                        <a href="<?= base_url($menuSlug); ?>" class="<?= ($isActiveParent || $isChildActive) ? 'active' : ''; ?>">
                                                            <?= ucwords(strtolower($menuName)); ?>
                                                        </a>

                                                        <?php if (!empty($children)) : ?>
                                                            <ul class="submenu">
                                                                <?php foreach ($children as $child) :
                                                                    $childSlug = is_array($child) ? $child['slug'] : $child->slug;
                                                                    $childName = is_array($child) ? $child['nama_menu'] : $child->nama_menu;
                                                                    $isThisChildActive = ($current == $childSlug || $current == trim($childSlug, '/'));
                                                                ?>
                                                                    <li>
                                                                        <a href="<?= base_url($childSlug); ?>" class="<?= $isThisChildActive ? 'active' : ''; ?>">
                                                                            <?= ucwords(strtolower($childName)); ?>
                                                                        </a>
                                                                    </li>
                                                                <?php endforeach; ?>
                                                            </ul>
                                                        <?php endif; ?>
                                                    </li>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </ul>
                                    </nav>
                                </div>
                            </div>

                            <!-- Right Side (Search & CTA) -->
                            <div class="col-xl-2 col-lg-2 col-md-2">
                                <div class="header-right f-right d-none d-lg-flex items-center gap-4">
                                    <!-- Search Nav -->
                                    <div class="nav-search search-switch">
                                        <i class="fa fa-search text-navy cursor-pointer hover:text-primary transition"></i>
                                    </div>
                                    <!-- CTA Button -->
                                    <a href="<?= !empty($domain->wa_link) ? $domain->wa_link : '#konsultasi'; ?>" target="_blank" class="bg-primary hover:bg-primaryDark text-white px-4 py-2 rounded font-semibold text-xs shadow-md transition duration-200 flex items-center gap-1.5 whitespace-nowrap">
                                        <i class="fa-solid fa-calculator"></i> Konsultasi
                                    </a>
                                </div>
                            </div>

                            <!-- Mobile Menu Toggle (Visible on Mobile) -->
                            <div class="col-12">
                                <div class="mobile_menu d-block d-md-none mt-2 mb-2"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header End -->
    </header>
    <main>
        <!-- Hero Section / Breaking News Scroller -->
        <?php
        if (!empty($sections)) {
            foreach ($sections as $section) {
                $type = strtolower($section->section);
                $payload = !empty($section->data_payload) ? json_decode($section->data_payload, true) : [];

                $data_render = [
                    'section' => $section,
                    'payload' => $payload,
                    'domain'  => $domain
                ];
                // Memuat view partial (misal: application/views/sections/hero.php)
                $this->load->view('news/' . $type, $data_render);
            }
        }
        ?>

    </main>