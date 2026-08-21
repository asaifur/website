<body data-spy="scroll" data-offset="80">

    <div class="site-mobile-menu site-navbar-target">
        <div class="site-mobile-menu-header">
            <div class="site-mobile-menu-close mt-3">
                <span class="icon-close2 js-menu-toggle"></span>
            </div>
        </div>
        <div class="site-mobile-menu-body"></div>
    </div>

    <header class="site-navbar js-sticky-header site-navbar-target" role="banner">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-6 col-xl-2">
                    <?php if ($domain->image_domain != null) { ?>
                        <img class="img-thumbnail img-preview" src="<?= base_url('assets/uploads/img/') . $domain->image_domain; ?>" style="max-width:150px;
    height:auto;">
                    <?php } else { ?>
                        <a href="<?= base_url() ?>" class="navbar-brand">
                            <h1 class="mb-0 site-logo"><a href="<?= base_url(); ?>"><?= $domain->meta_title ?></a></h1>
                        </a>
                    <?php } ?>
                </div>
                <div class="col-12 col-md-10 d-none d-xl-block">
                    <nav class="site-navigation position-relative text-right" role="navigation">
                        <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">

                            <?php
                            $current = uri_string();
                            ?>

                            <?php foreach ($menus as $menu): ?>

                                <?php
                                $isActiveParent = ($current == $menu['slug']);
                                ?>

                                <?php if (!empty($menu['children'])): ?>

                                    <?php
                                    // Cek apakah salah satu child aktif
                                    $isChildActive = false;
                                    foreach ($menu['children'] as $child) {
                                        if ($current == $child['slug']) {
                                            $isChildActive = true;
                                            break;
                                        }
                                    }
                                    ?>

                                    <li class="has-children <?= ($isActiveParent || $isChildActive) ? 'active' : '' ?>">
                                        <a href="<?= base_url($menu['slug']) ?>" class="nav-link">
                                            <?= ucwords(strtolower($menu['nama_menu'])) ?>
                                        </a>

                                        <ul class="dropdown">
                                            <?php foreach ($menu['children'] as $child): ?>

                                                <li class="<?= ($current == $child['slug']) ? 'active' : '' ?>">
                                                    <a href="<?= base_url($child['slug']) ?>" class="nav-link">
                                                        <?= ucwords(strtolower($child['nama_menu'])) ?>
                                                    </a>
                                                </li>

                                            <?php endforeach; ?>
                                        </ul>
                                    </li>

                                <?php else: ?>

                                    <li class="<?= $isActiveParent ? 'active' : '' ?>">
                                        <a href="<?= base_url($menu['slug']) ?>" class="nav-link">
                                            <?= ucwords(strtolower($menu['nama_menu'])) ?>
                                        </a>
                                    </li>

                                <?php endif; ?>

                            <?php endforeach; ?>

                        </ul>
                    </nav>
                </div>

                <!-- Mobile Toggle -->
                <div class="col-6 d-inline-block d-xl-none ml-md-0 py-3" style="position: relative; top: 3px;">
                    <a href="#" class="site-menu-toggle js-menu-toggle float-right">
                        <span class="icon-menu h3"></span>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <?php if (!empty($sections)): ?>
        <?php foreach ($sections as $sec): ?>
            <?php if ($sec->section == "HERO_2"): ?>
                <section id="home" class="home_video html-video">
                    <video class="text-center" muted="" autoplay="" loop="">
                        <source type="video/mp4" src="<?= base_url('assets/uploads/img/') . $sec->image; ?>">
                        Your browser does not support the video tag.
                    </video>
                    <div class="hero-text slider-caption text-center">
                        <h2><?= $sec->title; ?></h2>
                        <p><?= $sec->subtitle; ?></p>
                        <a href="<?= $sec->link ?>" class="page-scroll btn btn-default btn_one">Selengkapnya</a>
                    </div>
                </section>
            <?php endif; ?>

            <?php if ($sec->section == "HERO"): ?>
                <div id="kenburns_061"
                    class="carousel slide ps_indicators_txt_icon ps_control_txt_icon kbrns_zoomInOut thumb_scroll_x swipe_x ps_easeOutQuart"
                    data-bs-ride="carousel"
                    data-bs-interval="10000">
                    <?php if ($sec->has_carousel == 1):

                        $get_carousel = $this->Menu_model->fetch_data('tbl_carousel', [
                            'section_id' => $sec->id,
                            'url_id' => $this->domain->id
                        ])->result();

                        if (!empty($get_carousel)):
                    ?>
                            <div class="carousel-inner" role="listbox">
                                <?php $no = 0;
                                foreach ($get_carousel as $row): ?>
                                    <div class="carousel-item <?= ($no == 0) ? 'active' : ''; ?>">
                                        <img src="<?= base_url('assets/uploads/img/') . $row->image; ?>"
                                            alt="<?= htmlspecialchars($row->title); ?>"
                                            class="d-block w-100">
                                        <div class="kenburns_061_slide kenburns_061_slide_center text-center"
                                            data-animation="animated fadeInDown">
                                            <?php if ($no == 0): ?>
                                                <h1><?= htmlspecialchars($row->title); ?></h1>
                                            <?php else: ?>
                                                <h2><?= htmlspecialchars($row->title); ?></h2>
                                            <?php endif; ?>
                                            <?php if (!empty($row->subtitle)): ?>
                                                <h3><?= htmlspecialchars($row->subtitle); ?></h3>
                                            <?php endif; ?>
                                            <?php if (!empty($row->alt_text)): ?>
                                                <p><?= htmlspecialchars($row->alt_text); ?></p>
                                            <?php endif; ?>
                                            <div class="mt-4">
                                                <?php if (!empty($row->link)): ?>
                                                    <a href="<?= $row->link; ?>" class="btn btn-primary me-2">Konsultasi Sekarang</a>
                                                <?php endif; ?>
                                                <?php if (!empty($row->facebook_link)): ?>
                                                    <a href="<?= $row->facebook_link; ?>" target="_blank" class="btn btn-outline-light me-2">Selengkapnya</a>
                                                <?php endif; ?>
                                                <?php if (!empty($row->instagram_link)): ?>
                                                    <a href="<?= $row->instagram_link; ?>" target="_blank" class="btn btn-success">Details</a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php $no++;
                                endforeach; ?>
                            </div>
                            <!-- Controls -->
                            <button class="carousel-control-prev" type="button" data-bs-target="#kenburns_061" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#kenburns_061" data-bs-slide="next">
                                <span class="carousel-control-next-icon"></span>
                            </button>
                        <?php endif; ?>

                </div>
            <?php endif; ?>

            <div class="container">
                <div class="row">
                    <?= !empty($sec->content) ? $sec->content : ''; ?>
                </div>
            </div>
        <?php endif; ?>
        <!-- ================= SERVICES SECTION ================= -->
        <?php if ($sec->section == "SERVICES"): ?>
            <section class="feature_area">
                <div class="container">
                    <div class="row feature_bg">
                        <div class="section-title text-center">
                            <h2><?= !empty($sec->title) ? htmlspecialchars($sec->title) : 'Layanan Kami'; ?></h2>
                            <p><?= !empty($sec->subtitle) ? htmlspecialchars($sec->subtitle) : ''; ?></p>
                        </div>
                        <!-- Render content services (icon + deskripsi) di sini -->
                        <?= !empty($sec->content) ? $sec->content : ''; ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>
        <!-- ================= COUNTER / STATS SECTION ================= -->
        <?php if ($sec->section == "LATEST"): ?>
            <section data-stellar-background-ratio="0.3" class="counter_feature section-padding">
                <div class="container">
                    <div class="row text-center">
                        <?= $sec->content ?>
                    </div>
                    <?php if (!empty($sec->image)): ?>
                        <div class="row text-center">
                            <div class="col-lg-8 offset-lg-2 col-sm-12 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0">
                                <div class="video_btn" style="background-image: url(<?= base_url('assets/uploads/img/') . $sec->image ?>);  background-size:cover; background-position: center center;">
                                    <a class="video-play" href="<?= $sec->link ?>"><i class="ti-video-clapper"></i></a>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

            </section>
        <?php endif; ?>

        <?php if ($sec->section == "ABOUT"): ?>
            <style>
                /* Cursor effect */
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

            <section class="section-top" style="background-image: url(<?= base_url('assets/uploads/img/') . $sec->image ?>);background-size:cover; background-position: center center;">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-xs-12 text-center">
                            <div class="section-top-title">
                                <h1 id="typing-text"><?= $sec->title; ?></h1>
                            </div>
                        </div><!--- END COL -->
                    </div><!--- END ROW -->
                </div><!--- END CONTAINER -->
            </section>
            <!-- END SECTION TOP -->

            <!-- START CASE STUDY TOP CONTENT -->
            <section class="case_content_top_area section-padding">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-sm-12 col-xs-12">
                            <div class="case_content_top">
                                <h2><?= $sec->h2 ?></h2>
                                <?= $sec->content; ?>
                            </div>
                        </div><!--- END COL -->
                        <div class="col-lg-6 col-sm-12 col-xs-12">
                            <div class="case_content_top_img">
                                <img src="<?= base_url('assets/uploads/img/') . $sec->image ?>" class="img-fluid" alt="<?= $sec->title; ?>" />
                            </div>
                        </div><!--- END COL -->
                    </div><!--- END ROW -->
                </div><!--- END CONTAINER -->
            </section>


            <script>
                const texts = [
                    "<?= $sec->title; ?>",
                    "<?= $sec->subtitle; ?>"
                ];
                let textIndex = 0;
                let charIndex = 0;
                let isDeleting = false;
                const typingElement = document.getElementById("typing-text");

                function typeEffect() {
                    const currentText = texts[textIndex];

                    if (!isDeleting) {
                        typingElement.textContent = currentText.substring(0, charIndex + 1);
                        charIndex++;

                        if (charIndex === currentText.length) {
                            setTimeout(() => isDeleting = true, 1500);
                        }
                    } else {
                        typingElement.textContent = currentText.substring(0, charIndex - 1);
                        charIndex--;

                        if (charIndex === 0) {
                            isDeleting = false;
                            textIndex = (textIndex + 1) % texts.length;
                        }
                    }

                    setTimeout(typeEffect, isDeleting ? 40 : 80);
                }

                typeEffect();
            </script>
        <?php endif; ?>
        <!-- ================= WHY CHOOSE US / ABOUT ================= -->
        <?php if ($sec->section == "COUNTERS"): ?>

            <section class="why_choose_area section-padding">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-sm-12 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s" data-wow-offset="0">
                            <div class="single_why_choose">
                                <h2><?= $sec->title ?></h2>
                                <p><?= $sec->subtitle ?></p>
                                <?= !empty($sec->content) ? $sec->content : ''; ?>
                                <?php if (!empty($sec->link)): ?>
                                    <a class="btn_one" href="<?= $sec->link ?>">Selengkapnya</a>
                                <?php endif; ?>
                            </div>
                        </div><!--- END COL -->
                        <div class="col-lg-6 col-sm-12 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s" data-wow-offset="0">
                            <div class="single_why_choose_img">
                                <img src="<?= base_url('assets/uploads/img/') . $sec->image ?>" class="img-fluid" alt="<?= $sec->title; ?>" />
                            </div>
                        </div><!--- END COL -->
                    </div><!--- END ROW -->
                </div><!--- END CONTAINER -->
            </section>
        <?php endif; ?>


        <?php if ($sec->section == "GAMBAR"): ?>
            <div class="section-title text-center">
                <h2><?= $sec->title ?></h2>
                <p><?= $sec->subtitle ?></p>
            </div>

            <div class="row">
                <?php $gambars = $this->Menu_model->fetch_data('table_media', ['domain_id' => $this->domain->id])->result();
                foreach ($gambars as $gambar): ?>
                    <div class="col-lg-4 col-sm-6 col-xs-12">
                        <img src="<?= base_url('assets/uploads/img/') . $gambar->file_name ?>" class="img-fluid" alt="<?= $gambar->alt_text ?>" caption="<?= $gambar->caption ?>">
                    </div><!-- End Col -->
                <?php endforeach; ?>
            </div><!-- End Col -->

        <?php endif; ?>

        <?php if ($sec->section == "PORTFOLIO"): ?>

            <section id="portfolio" class="portfolio_area section-padding">
                <div class="container-fluid">

                    <div class="section-title text-center">
                        <h2><?= $sec->title ?></h2>
                        <p><?= $sec->subtitle ?></p>
                    </div>

                    <!-- SEARCH BOX -->
                    <div class="row mb-4 justify-content-center">
                        <div class="col-md-6">
                            <input type="text"
                                class="form-control"
                                id="live_search"
                                placeholder="Cari artikel..."
                                autocomplete="off">
                        </div>
                    </div>

                    <!-- DEFAULT ARTICLE LIST -->
                </div>
                <div class="container">
                    <div class="row" id="default_result">
                        <?php
                        $artikel = $this->Menu_model->fetch_data('table_pages', ['category' => '2', 'id_domain' => $this->domain->id])->result();
                        foreach ($artikel as $art): ?>
                            <div class="col-lg-4 col-md-6 mb-4 article-item">

                                <div class="home_single_blog">

                                    <img src="<?= base_url('assets/uploads/img/') . $art->image_features; ?>"
                                        class="img-fluid"
                                        alt="<?= htmlspecialchars($art->title); ?>" />

                                    <div class="home_blog_content">

                                        <div class="blog_title_info">
                                            <h2>
                                                <a href="<?= base_url('/' . $art->slug); ?>">
                                                    <?= htmlspecialchars($art->title); ?>
                                                </a>
                                            </h2>

                                            <span>
                                                <?= date('d F Y', strtotime($art->created_at)); ?>
                                            </span>

                                            <span>
                                                <?= htmlspecialchars($art->category_name ?? 'Artikel'); ?>
                                            </span>
                                        </div>

                                        <p><?= $art->meta_description; ?></p>

                                        <a class="home_b_btn"
                                            href="<?= base_url('/' . $art->slug); ?>">
                                            Baca Selengkapnya
                                        </a>

                                    </div>
                                </div>

                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- SEARCH RESULT -->
                    <div class="row" id="search_result" style="display:none;"></div>

                </div>
            </section>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                $(document).ready(function() {

                    $("#live_search").keyup(function() {

                        let keyword = $(this).val();

                        if (keyword.length > 0) {
                            $.ajax({
                                url: "<?= base_url('Welcome/live_search_artikel'); ?>",
                                method: "POST",
                                data: {
                                    keyword: keyword
                                },
                                success: function(data) {
                                    $("#default_result").hide();
                                    $("#search_result").show();
                                    $("#search_result").html(data);
                                }
                            });
                        } else {
                            $("#search_result").hide();
                            $("#default_result").show();
                        }

                    });

                });
            </script>
        <?php endif; ?>

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
            <!-- START SECTION TOP -->
            <section class="section-top" style="background-image: url(<?= base_url('assets/monoline/assets/img/bg/section-top.png') ?>);background-size:cover; background-position: center center;">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-xs-12 text-center">
                            <div class="section-top-title">
                                <h1 id="typing-text"><?= ($sec->title) . '-' . $sec->subtitle ?></h1>
                            </div>
                        </div><!--- END COL -->
                    </div><!--- END ROW -->
                </div><!--- END CONTAINER -->
            </section>
            <!-- END SECTION TOP -->
            <section class="blog-page section-padding">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-sm-12 col-xs-12">
                            <div class="post-slide-blog">
                                <div class="blog-img bc_bottom">
                                    <img src="<?= base_url('assets/uploads/img/') . $sec->image ?>" class="img-fluid" alt="<?= $sec->title ?>" />
                                </div>
                                <?= $sec->content; ?>
                            </div><!--- END COMMENT FORM -->
                        </div><!-- END COL-->
                        <div class="col-lg-4 col-sm-12 col-xs-12">
                            <div class="latest_blog wow fadeInRight">
                                <h4 class="blog_sidebar_title">Blog Lainnya</h4>
                                <?php
                                $blogs = $this->Menu_model->fetch_data_pages_by_limit_order('table_pages', ['category' => '2', 'id_domain' => $this->domain->id])->result();
                                foreach ($blogs as $blog): ?>
                                    <div class="single_latest_blog">

                                        <a href="<?= base_url('/' . $blog->slug) ?>">
                                            <h4><?= $blog->title ?>.</h4>
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="categories">
                                <h4 class="blog_sidebar_title">Search</h4>

                                <input type="text"
                                    class="form-control"
                                    id="live_search"
                                    placeholder="Cari artikel..."
                                    autocomplete="off">

                                <div id="search_result"></div>
                            </div>
                        </div><!--- END COL -->
                    </div><!-- END ROW-->
                </div><!-- END CONTAINER-->
            </section>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                const texts = [
                    "<?= $sec->title; ?>",
                    "<?= $sec->subtitle; ?>"
                ];
                let textIndex = 0;
                let charIndex = 0;
                let isDeleting = false;
                const typingElement = document.getElementById("typing-text");

                function typeEffect() {
                    const currentText = texts[textIndex];

                    if (!isDeleting) {
                        typingElement.textContent = currentText.substring(0, charIndex + 1);
                        charIndex++;

                        if (charIndex === currentText.length) {
                            setTimeout(() => isDeleting = true, 1500);
                        }
                    } else {
                        typingElement.textContent = currentText.substring(0, charIndex - 1);
                        charIndex--;

                        if (charIndex === 0) {
                            isDeleting = false;
                            textIndex = (textIndex + 1) % texts.length;
                        }
                    }

                    setTimeout(typeEffect, isDeleting ? 40 : 80);
                }

                typeEffect();
            </script>
            <script>
                $(document).ready(function() {

                    $("#live_search").keyup(function() {

                        var query = $(this).val();

                        if (query.length >= 2) {
                            $.ajax({
                                url: "<?= base_url('Welcome/live_search'); ?>",
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
        <?php if ($sec->section == "NEWS_ALL"): ?>
            <section class="blog_area section-padding">
                <div class="container">

                    <!-- Section Title -->
                    <div class="section-title text-center mb-5">
                        <h2><?= htmlspecialchars($sec->title); ?></h2>
                        <p><?= htmlspecialchars($sec->subtitle); ?></p>
                    </div>

                    <div class="row">

                        <?php
                        $artikel = $this->Menu_model->fetch_data_pages_by_limit_order('table_pages', ['category' => '2', 'id_domain' => $this->domain->id])->result();

                        ?>

                        <?php foreach ($artikel as $art): ?>
                            <div class="col-lg-4 col-md-6 mb-4 wow fadeInUp"
                                data-wow-duration="1s"
                                data-wow-delay="0.1s">

                                <div class="home_single_blog">

                                    <img src="<?= base_url('assets/uploads/img/') . $art->image_features; ?>"
                                        class="img-fluid"
                                        alt="<?= htmlspecialchars($art->title); ?>" />

                                    <div class="home_blog_content">

                                        <div class="blog_title_info">
                                            <h2>
                                                <a href="<?= base_url('/' . $art->slug); ?>">
                                                    <?= htmlspecialchars($art->title); ?>
                                                </a>
                                            </h2>

                                            <span>
                                                <?= date('d F Y', strtotime($art->created_at)); ?>
                                            </span>

                                            <span>
                                                <a href="#">
                                                    <?= htmlspecialchars($art->category_name ?? 'Artikel'); ?>
                                                </a>
                                            </span>
                                        </div>

                                        <p>
                                            <?= $art->meta_description; ?>
                                        </p>

                                        <a class="home_b_btn"
                                            href="<?= base_url('/' . $art->slug); ?>">
                                            Baca Selengkapnya
                                        </a>

                                    </div>
                                </div>

                            </div>
                        <?php endforeach; ?>

                    </div>
                    <a href="<?= $sec->link ?>" class="page-scroll btn btn-default btn_one">More </a>
                </div>
            </section>
        <?php endif; ?>
        <?php if ($sec->section == "TESTIMONIALS"): ?>
            <div class="testimonial_area section-padding">
                <div class="container">
                    <div class="section-title text-center">
                        <h2><?= !empty($sec->title) ? htmlspecialchars($sec->title) : 'Dari Klien Kami'; ?></h2>
                        <p><?= !empty($sec->subtitle) ? htmlspecialchars($sec->subtitle) : ''; ?></p>
                    </div>
                    <div class="row">
                        <div class="col-lg-10 offset-lg-1 col-sm-12 col-xs-12">
                            <div class="row">
                                <?= !empty($sec->content) ? $sec->content : ''; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <?php if ($sec->section == "MARQUEE"): ?>
            <div class="partner-logo section-padding">
                <div class="container">
                    <div class="row text-center">
                        <h2><?= !empty($sec->title) ? htmlspecialchars($sec->title) : 'Dari Klien Kami'; ?></h2>
                        <p><?= !empty($sec->subtitle) ? htmlspecialchars($sec->subtitle) : ''; ?></p>
                    </div>
                    <br>
                    <div class="row text-center">
                        <?php if (!empty($sec->has_carousel) && $sec->has_carousel == 1): ?>

                            <?php
                            $get_carousel = $this->Menu_model->fetch_data('tbl_carousel', [
                                'section_id' => $sec->id,
                            ])->result();
                            ?>

                            <?php if (!empty($get_carousel)): ?>
                                <?php foreach ($get_carousel as $row): ?>

                                    <div class="col-lg-2 col-sm-4 col-6 no-padding wow fadeInUp"
                                        data-wow-duration="1s"
                                        data-wow-delay="0.1s"
                                        data-wow-offset="0">

                                        <div class="single_logo">
                                            <a href="<?= !empty($row->instagram_link) ? htmlspecialchars($row->instagram_link) : '#' ?>"
                                                target="_blank">

                                                <img src="<?= base_url('assets/uploads/img/' .  $row->image); ?>"
                                                    alt="<?= $row->title; ?>"
                                                    class="img-fluid"
                                                    loading="lazy" />
                                            </a>
                                        </div>

                                    </div><!-- END COL -->

                                <?php endforeach; ?>
                            <?php endif; ?>

                        <?php endif; ?>
                    </div><!--- END ROW -->
                </div><!--- END CONTAINER -->
            </div>
        <?php endif; ?>


        <?php if ($sec->section == "CATEGORIES"): ?>
            <section id="portfolio" class="portfolio_area section-padding">
                <div class="container-fluid">
                    <div class="section-title text-center">
                        <h2><?= $sec->title; ?> – <?= $sec->subtitle; ?></h2>
                        <?= $sec->content ?>
                    </div>
                    <div class="col-lg-12 text-center">
                        <div class="portfolio_filter">
                            <ul>
                                <li class="active filter" data-filter="all">All</li>
                                <li class="filter" data-filter=".cooking">Cooking Equipment</li>
                                <li class="filter" data-filter=".stainless">Stainless Equipment</li>
                                <li class="filter" data-filter=".refrigeration">Refrigeration</li>
                                <li class="filter" data-filter=".installation">Installation System</li>
                            </ul>
                        </div>
                    </div>
                    <div class="portfolio-grid">
                        <div class="row">
                            <?php $categories = $this->Menu_model->fetch_data('categories')->result();; ?>
                            <!-- Cooking Equipment -->
                            <?php foreach ($categories as $row): ?>
                                <?php if ($row->slug == 'cooking-equipment'): ?>
                                    <div class="col-lg-4 col-sm-6 col-xs-12 portfolio-item mix cooking">
                                        <div class="single-gallery">
                                            <img src="<?= $row->image; ?>" class="img-fluid" alt="<?= $row->title ?>">
                                            <a href="assets/img/product/kwali-range.jpg" class="gallery_enlarge_icon"><i class="ti-eye"></i></a>
                                            <h4><a href="#"><?= $row->title ?></a></h4>
                                            <?= $row->content ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div><!-- END ROW -->
                    </div>
                </div><!-- END CONTAINER -->
            </section>
        <?php endif; ?>

        <?php if ($sec->section == "CONTACT"): ?>
            <section class="section-top" style="background-image: url(<?= $sec->image; ?>);background-size:cover; background-position: center center;">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-xs-12 text-center">
                            <div class="section-top-title">
                                <h1><?= $sec->title ?></h1>
                            </div>
                        </div><!--- END COL -->
                    </div><!--- END ROW -->
                </div><!--- END CONTAINER -->
            </section>
            <!-- END SECTION TOP -->

            <!-- START ADDRESS -->
            <section class="address_area section-padding">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-xs-12 text-center">
                            <div class="single_address">
                                <h4><?= $this->domain->title; ?></h4>
                                <p class="mr_20"><?= $this->domain->alamat ?> <br /> </p>
                                <p><a href="tel:<?= $this->domain->telepon ?>"><?= $this->domain->telepon ?></a></p>
                                <p><a href="mailto:<?= $this->domain->email; ?>"><?= $this->domain->email; ?></a></p>
                            </div>
                        </div><!--- END COL -->
                    </div><!--- END ROW -->
                </div><!--- END CONTAINER -->
            </section>
            <div class="map">
                <?= $this->domain->iframe; ?>"
            </div>
            <!-- END ADDRESS -->
        <?php endif; ?>
    <?php endforeach; ?>
<?php endif; ?>