<body>
    <!-- Preloader -->


    <header class="ve-header" id="ve-sticky">
        <div class="container-fluid ve-nav-wrap">
            <!-- Logo -->

            <?php if ($domain->image_domain != null) { ?>
                <a href="<?= base_url('') ?>"> <img class="img-thumbnail img-preview" src="<?= base_url('assets/uploads/img/') . $domain->image_domain; ?>" style="max-width:150px;
    height:auto;"> </a>
            <?php } else { ?>
                <div class="ve-logo">
                    <a href="<?= base_url() ?>" class="navbar-brand">
                        <h1 class="m-0 text-uppercase text-primary"><?= $domain->meta_title ?></h1>
                    </a>
                </div>
            <?php } ?>

            <?php
            $current = uri_string();
            ?>
            <!-- Nav Links -->
            <nav class="ve-nav">
                <ul>

                    <?php
                    $current = uri_string();
                    ?>

                    <?php foreach ($menus as $menu): ?>

                        <?php
                        $url = base_url($menu['slug']);
                        $isParentActive = ($current == $menu['slug']) ? 'active' : '';

                        // cek apakah ada child yang aktif
                        if (!empty($menu['children'])) {
                            foreach ($menu['children'] as $child) {
                                if ($current == $child['slug']) {
                                    $isParentActive = 'active';
                                }
                            }
                        }
                        ?>

                        <?php if (!empty($menu['children'])): ?>

                            <li class="has-drop <?= $isParentActive ?>">
                                <a href="<?= $url ?>">
                                    <?= ucwords(strtolower($menu['nama_menu'])) ?>
                                    <i class="fa fa-angle-down"></i>
                                </a>

                                <ul class="ve-dropdown">

                                    <?php foreach ($menu['children'] as $child): ?>

                                        <?php
                                        $childActive = ($current == $child['slug']) ? 'active' : '';
                                        ?>

                                        <li>
                                            <a href="<?= base_url($child['slug']) ?>" class="<?= $childActive ?>">
                                                <?= ucwords(strtolower($child['nama_menu'])) ?>
                                            </a>
                                        </li>

                                    <?php endforeach; ?>

                                </ul>
                            </li>

                        <?php else: ?>

                            <li>
                                <a href="<?= $url ?>" class="<?= $isParentActive ?>">
                                    <?= ucwords(strtolower($menu['nama_menu'])) ?>
                                </a>
                            </li>

                        <?php endif; ?>

                    <?php endforeach; ?>

                </ul>
            </nav>

            <!-- CTA -->
            <div class="ve-nav-cta">
                <a href="<?= $domain->wa_link; ?>" class="ve-cta-btn">Kirim Pertanyaan <i class="fa fa-arrow-right"></i></a>
            </div>

            <!-- Mobile Toggle -->
            <button class="ve-toggler" id="ve-toggle">
                <span></span><span></span><span></span>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div class="ve-mobile-menu" id="ve-mobile-menu">
            <ul>

                <?php
                $current = uri_string();
                ?>

                <?php foreach ($menus as $menu): ?>

                    <?php
                    $url = base_url($menu['slug']);
                    $isActive = ($current == $menu['slug']) ? 'active' : '';

                    // cek apakah ada child aktif
                    if (!empty($menu['children'])) {
                        foreach ($menu['children'] as $child) {
                            if ($current == $child['slug']) {
                                $isActive = 'active';
                            }
                        }
                    }
                    ?>

                    <?php if (!empty($menu['children'])): ?>

                        <li class="<?= $isActive ?>">

                            <a href="<?= $url ?>">
                                <?= ucwords(strtolower($menu['nama_menu'])) ?>
                            </a>

                            <ul>

                                <?php foreach ($menu['children'] as $child): ?>

                                    <?php
                                    $childActive = ($current == $child['slug']) ? 'active' : '';
                                    ?>

                                    <li>
                                        <a href="<?= base_url($child['slug']) ?>" class="<?= $childActive ?>">
                                            <?= ucwords(strtolower($child['nama_menu'])) ?>
                                        </a>
                                    </li>

                                <?php endforeach; ?>

                            </ul>

                        </li>

                    <?php else: ?>

                        <li>
                            <a href="<?= $url ?>" class="<?= $isActive ?>">
                                <?= ucwords(strtolower($menu['nama_menu'])) ?>
                            </a>
                        </li>

                    <?php endif; ?>

                <?php endforeach; ?>

            </ul>
        </div>
    </header>

    <?php if (!empty($sections)): ?>

        <?php foreach ($sections as $sec): ?>

            <?php if ($sec->section == "HERO"): ?>
                <style>
                    #typing-text::after {
                        content: "|";
                        animation: blink 1s infinite;
                        margin-left: 5px;
                    }

                    @keyframes blink {

                        0%,
                        50%,
                        100% {
                            opacity: 1;
                        }

                        25%,
                        75% {
                            opacity: 0;
                        }
                    }
                </style>
                <section class="ve-page-hero animate__fadeInUp animate__animated" style="background-image: url('<?= base_url('assets/uploads/img/') . $sec->image; ?>');">
                    <div class="ve-page-hero-overlay "></div>
                    <div class="container animate__animated animate__fadeInBottomRight ve-page-hero-content">
                        <span class="ve-section-tag animate__fadeInRightBig animate__animated"><?= $sec->span ?></span>
                        <?php if (!empty($sec->title)): ?>
                            <h1 id="typing-text"><?= $sec->title ?></h1>
                        <?php endif; ?>
                        <?php if (!empty($sec->subtitle)): ?>
                            <h5 style="color: #eaeaea;"><?= $sec->subtitle ?> </h5>
                        <?php endif; ?>
                        <p><?= $sec->content; ?></p>
                        <?php if ($sec->link != null) { ?>
                            <div class="enterprise-buttons">
                                <?php if (!empty($sec->link)) { ?>
                                    <a href="<?= $sec->link ?>" class="ve-btn-primary animate__fadeIn animate__animated">
                                        Hubungi Kami
                                    </a>
                                <?php } else {
                                    echo '';
                                } ?>
                                <?php if (!empty($sec->link_profil)) { ?>

                                    <a href="<?= $sec->link_profil ?>" class="ve-btn-ghost animate__animated animate__fadeIn">
                                        Profil Perusahaan
                                    </a>
                                <?php } else {
                                    echo '';
                                } ?>
                            </div>
                        <?php } ?>
                    </div>
                </section>
                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        const text = "PT FAJAR FARMATAMA DISTRIBUTOR";
                        const typingElement = document.getElementById("typing-text");

                        let index = 0;
                        let isDeleting = false;

                        function typeEffect() {
                            if (!isDeleting) {
                                typingElement.innerHTML = text.substring(0, index++);
                                if (index > text.length) {
                                    isDeleting = true;
                                    setTimeout(typeEffect, 1500); // pause sebelum hapus
                                    return;
                                }
                            } else {
                                typingElement.innerHTML = text.substring(0, index--);
                                if (index === 0) {
                                    isDeleting = false;
                                }
                            }
                            setTimeout(typeEffect, isDeleting ? 50 : 100);
                        }

                        typeEffect();
                    });
                </script>
            <?php endif; ?>


            <!-- ===== MARQUEE TRUST BAR ===== -->
            <?php if ($sec->section == "MARQUEE"): ?>
                <style>
                    .ve-posisi-tag {
                        display: block;
                        /* supaya bisa full width */
                        text-align: center;
                        /* center horizontal */
                        margin: 0 auto 20px;
                        /* kasih jarak bawah */
                    }
                </style>
                <span class="ve-posisi-tag"><?= $sec->span ?></span>
                <div class="ve-trust-bar">
                    <div class="ve-trust-inner">
                        <?php
                        $getcarousel = $this->Menu_model
                            ->fetch_data('tbl_carousel', ['section_id' => $sec->id])
                            ->result();

                        if (!empty($getcarousel)):
                            foreach ($getcarousel as $row): ?>

                                <span>
                                    <img src="<?= base_url('assets/uploads/img/') . $row->image ?>"
                                        class="img-thumbnail"
                                        style="width: 50px;">
                                    <?= $row->title ?>
                                </span>

                        <?php endforeach;
                        endif; ?>
                    </div>
                </div>
            <?php endif; ?>


            <!-- ===== SERVICES GRID ===== -->
            <?php if ($sec->section == "SERVICES"): ?>
                <section class="ve-section ve-whyus-section">
                    <div class="container">
                        <div class="row align-items-center">

                            <!-- Image Side -->
                            <?php if ($sec->image != null) { ?>
                                <div class="col-12 col-lg-5">
                                    <div class="ve-whyus-img-wrap wow fadeInLeft" data-wow-delay="100ms">
                                        <div class="ve-whyus-img-main bg-img" style="background-image:url('<?= base_url('assets/uploads/img/') . $sec->image ?>');"></div>
                                        <?php if ($sec->title != null) { ?>
                                            <div class="ve-whyus-badge">
                                                <strong><?= $sec->title; ?></strong>
                                                <span><?= $sec->span; ?></span>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php } ?>

                            <!-- Content Side -->
                            <?= $sec->content; ?>

                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            <a href="<?= $sec->link ?>" class="ve-btn-primary btn-block"> Selengkapnya</a>
                        </div>
                    </div>
                </section>
            <?php endif; ?>
            <?php if ($sec->section == "ABOUT") { ?>
                <section class="ve-section">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-12 col-lg-6 wow fadeInLeft" data-wow-delay="100ms">
                                <div class="ve-about-img-stack">
                                    <div class="ve-about-img-1 bg-img" style="background-image:url('<?= base_url("assets/uploads/img/") . $sec->image ?>');"></div>
                                    <div class="ve-about-ribbon">
                                        <strong><?= $sec->strong ?></strong>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6 wow fadeInRight" data-wow-delay="200ms">
                                <div class="ve-about-text">
                                    <span class="ve-section-tag"><?= $sec->span ?></span>
                                    <h1><?= $sec->title ?></h1>
                                    <h2><?= $sec->h2 ?></h2>
                                    <?= $sec->content ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            <?php } ?>

            <!-- ===== WHY US ===== -->
            <?php if ($sec->section == "CAROUSEL_BOOTSTRAP"): ?>
                <style>
                    .partner-logo {
                        max-height: 150px;
                        object-fit: contain;
                        opacity: 0.9;
                        transition: all 0.3s ease;
                    }

                    .partner-logo:hover {

                        opacity: 1;
                        transform: scale(2.05);
                    }
                </style>

                <section class="ve-section bg-light">
                    <div class="container">
                        <div class="ve-section-header text-center">
                            <span class="ve-section-tag"><?= $sec->span; ?></span>
                            <h2><?= $sec->h2; ?> <span><?= $sec->subtitle; ?></span></h2>
                            <?= $sec->content; ?>
                        </div>

                        <div class="owl-carousel owl-theme" id="partner-carousel">
                            <?php
                            $partners = $this->Menu_model->fetch_data('tbl_carousel', ['section_id' => $sec->id])->result();
                            foreach ($partners as $row): ?>
                                <div class="item text-center">
                                    <img src="<?= base_url('assets/uploads/img/' . $row->image); ?>"
                                        class="img-fluid partner-logo"
                                        alt="<?= $row->title; ?>">
                                    <p><?= $row->title; ?></p>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </section>
            <?php endif; ?>


            <!-- ===== NEWS ===== -->
            <?php if ($sec->section == "NEWS"): ?>
                <style>
                    #search_result {
                        position: absolute;
                        width: 100%;
                        background: #fff;
                        border: 1px solid #ddd;
                        z-index: 999;
                        display: none;
                    }

                    .live-search-list {
                        list-style: none;
                        margin: 0;
                        padding: 0;
                    }

                    .live-search-list li {
                        padding: 10px;
                        border-bottom: 1px solid #eee;
                    }

                    .live-search-list li a {
                        text-decoration: none;
                        color: #333;
                        display: block;
                    }

                    .live-search-list li:hover {
                        background: #f5f5f5;
                    }

                    .no-result {
                        padding: 10px;
                        color: #999;
                    }

                    .white-text {
                        color: #ffffff !important;
                    }
                </style>
                <section class="ve-section">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-lg-8">
                                <article class="ve-article">
                                    <div class="ve-article-body">
                                        <h1><?= $sec->title ?></h1>
                                        <?= $sec->content ?>
                                    </div>
                                </article>
                            </div>
                            <div class="col-12 col-lg-4">
                                <div class="ve-sidebar">
                                    <div class="ve-sidebar-widget">
                                        <h5 class="ve-sidebar-title">Search</h5>
                                        <div class="ve-search-box">
                                            <input type="text"
                                                class="form-control"
                                                id="live_search"
                                                placeholder="Cari artikel..."
                                                autocomplete="off">

                                            <div id="search_result"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script>
                    $(document).ready(function() {

                        $("#live_search").keyup(function() {

                            var query = $(this).val();

                            if (query.length >= 2) {
                                $.ajax({
                                    url: "<?= base_url('Dashboard/live_search'); ?>",
                                    method: "POST",
                                    data: {
                                        query: query
                                    },
                                    success: function(data) {
                                        $("#search_result").html(data).fadeIn();
                                    }
                                });
                            } else {
                                $("#search_result").fadeOut();
                            }

                        });

                        // Klik di luar → sembunyikan hasil
                        $(document).click(function(e) {
                            if (!$(e.target).closest('#live_search').length) {
                                $("#search_result").fadeOut();
                            }
                        });

                    });
                </script>
            <?php endif; ?>
            <?php if ($sec->section == "LATEST"): ?>
                <section class="ve-section ve-insights-section">
                    <div class="container">
                        <div class="ve-section-header text-center">
                            <span class="ve-section-tag"><?= $sec->span; ?></span>
                            <h2><?= $sec->h2; ?> <span><?= $sec->subtitle ?></span></h2>
                            <?= $sec->content ?>
                        </div>

                        <div class="row">

                            <?php
                            $articles = $this->Menu_model->fetch_data_pages_by_limit_order('table_pages', ['category' => '2', 'id_domain' => $this->domain->id])->result();
                            if (!empty($articles)): ?>
                                <?php foreach ($articles as $baris): ?>

                                    <div class="col-12 col-md-4 wow fadeInUp">
                                        <div class="ve-insight-card">

                                            <div class="ve-insight-img bg-img"
                                                style="background-image:url('<?= base_url('assets/uploads/img/') . $baris->image_features; ?>');">
                                            </div>

                                            <div class="ve-insight-body">

                                                <span class="ve-insight-cat">
                                                    <?= $baris->keywords ?>
                                                </span>

                                                <h5>
                                                    <a href="<?= base_url('/') . $baris->slug ?>">
                                                        <?= $baris->title ?>
                                                    </a>
                                                </h5>

                                                <p>
                                                    <?= $baris->meta_description; ?>
                                                </p>

                                                <div class="ve-insight-meta">
                                                    <span>
                                                        <i class="fa fa-calendar"></i>
                                                        <?= date('d F Y', strtotime($baris->created_at)); ?>
                                                    </span>

                                                    <a href="<?= base_url('/' . $baris->slug) ?>">
                                                        Baca Selengkapnya <i class="fa fa-arrow-right"></i>
                                                    </a>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                <?php endforeach; ?>
                            <?php endif; ?>

                        </div>
                    </div>
                </section>
            <?php endif; ?>



            <!-- ===== TESTIMONIALS ===== -->
            <?php if (!empty($sec->testimonials)): ?>
                <section class="ve-testimonials">
                    <div class="container">
                        <h2>Testimoni Klien</h2>
                        <?php foreach ($sec->testimonials as $testi): ?>
                            <div class="testimonial-item">
                                <p>"<?= $testi->message ?>"</p>
                                <strong><?= $testi->name ?></strong>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </section>
            <?php endif; ?>
            <?php if ($sec->section == "BANNER"): ?>
                <div class="row">
                    <div class="col-md-12 col-md-12" style="text-align: center;">
                        <span class="ve-section-tag animate__fadeInRightBig animate__animated"> <?= $sec->title ?>

                        </span>
                    </div>

                </div>
                <?php if (!empty($sec->image)): ?>
                    <div class="container  ve-cta-content animate__fadeInUp animate__animated">
                        <div class="row">
                            <img src="<?= base_url('assets/uploads/img/') . $sec->image ?>" class="img-thumbnail" alt="<?= $sec->title; ?>">
                        </div>
                    </div>
                <?php endif; ?>

                <div class="container">
                    <div class="row">
                        <div class="col-12 col-lg-12 wow animate__fadeInRightBig animate__animated">
                            <?= $sec->content; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>


            <!-- ===== CTA ===== -->
            <?php if ($sec->section == "CTA"): ?>
                <section class="ve-cta-banner bg-img" style="background-image:url('<?= base_url('assets/uploads/img/') . $sec->image; ?>');">
                    <div class="ve-cta-overlay"></div>
                    <div class="container ve-cta-content">
                        <div class="row align-items-center">
                            <div class="col-12 col-lg-8">
                                <h2><?= $sec->h2 ?> <span><?= $sec->span ?></span></h2>
                                <?= $sec->content ?>
                            </div>
                            <div class="col-12 col-lg-4 text-lg-right">
                                <a href="<?= base_url('contact'); ?>" class="ve-btn-white">
                                    Hubungi Tim Kami
                                </a>
                            </div>
                        </div>
                    </div>
                </section>
            <?php endif; ?>
            <!-- ===== NEWSLETTER ===== -->
            <?php if ($sec->section == "newsletter"): ?>
                <section class="ve-newsletter">
                    <div class="container">
                        <h2><?= $sec->newsletter->title ?? 'Berlangganan Newsletter' ?></h2>
                    </div>
                </section>

            <?php endif; ?>

            <?php if ($sec->section == "PORTFOLIO"): ?>
                <?= $sec->content; ?>
            <?php endif; ?>
            <?php if ($sec->section == "POPUP"): ?>

                <div id="promoPopup" class="popup-overlay">
                    <div class="popup-content">
                        <span class="close-btn">&times;</span>
                        <img src="<?= base_url('assets/uploads/img/') . $sec->image ?>" alt="<?= $sec->title ?>">
                    </div>
                </div>
            <?php endif; ?>
            <?php if ($sec->section == "NEWS_ALL"): ?>

                <style>
                    .ve-pagination a {
                        display: inline-block;
                        padding: 8px 14px;
                        margin: 5px;
                        border: 1px solid #ddd;
                        text-decoration: none;
                        color: #333;
                        border-radius: 4px;
                    }

                    .ve-pagination a.active {
                        background: #0d6efd;
                        color: #fff;
                        border-color: #0d6efd;
                    }
                </style>
                <section class="ve-section">
                    <div class="container">
                        <p><?= $sec->title ?></p>

                        <div class="row">
                            <div class="col-12 col-lg-12">

                                <!-- SEARCH INPUT -->
                                <div class="mb-4">
                                    <input type="text" id="liveSearch" class="form-control" placeholder="Search articles...">
                                </div>

                                <!-- NEWS LIST -->
                                <div class="row" id="newsContainer">
                                    <!-- AJAX Load Here -->
                                </div>

                                <!-- PAGINATION -->
                                <div class="ve-pagination" id="paginationContainer"></div>

                            </div>
                        </div>
                    </div>
                </section>
                <script src="<?= base_url('') ?>assets/vaul/js/jquery/jquery-2.2.4.min.js"></script>

                <!-- 2️⃣ Bootstrap -->
                <script src="<?= base_url('') ?>assets/vaul/js/bootstrap/bootstrap.min.js"></script>

                <!-- 3️⃣ Baru script custom -->
                <script>
                    $(document).ready(function() {

                        var category = "posts";
                        var currentPage = 1;
                        var searchKeyword = "";

                        function loadNews(page = 1, keyword = "") {
                            $.ajax({
                                url: "<?= base_url('Home/ajax_list') ?>",
                                type: "GET",
                                data: {
                                    page: page,
                                    search: keyword,
                                },
                                dataType: "json",
                                success: function(response) {
                                    $("#newsContainer").html(response.html);
                                    $("#paginationContainer").html(response.pagination);
                                },
                                error: function() {
                                    $("#newsContainer").html("<p class='text-danger'>Failed to load data</p>");
                                }
                            });
                        }

                        loadNews(1, "");

                        var delayTimer;
                        $("#liveSearch").on("keyup", function() {

                            clearTimeout(delayTimer);
                            var value = $(this).val();

                            delayTimer = setTimeout(function() {
                                searchKeyword = value;
                                loadNews(1, value);
                            }, 500);

                        });

                        $(document).on("click", ".ve-pagination a", function(e) {
                            e.preventDefault();
                            var page = $(this).data("page");
                            loadNews(page, searchKeyword);
                        });

                    });
                </script>
            <?php endif; ?>


        <?php endforeach; ?>

    <?php endif; ?>