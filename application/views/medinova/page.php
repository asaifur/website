<body>

    <?= $domain->link_google_analitycs ?? '' ?>
    <!-- Topbar Start -->
    <div class="container-fluid py-2 border-bottom d-none d-lg-block">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-lg-start mb-2 mb-lg-0">
                    <div class="d-inline-flex align-items-center">
                        <a class="text-decoration-none text-body pe-3" href="<?= $domain->wa_link; ?>"><i
                                class="bi bi-telephone me-2"></i><?= $domain->telepon; ?></a>
                        <span class="text-body">|</span>
                        <a class="text-decoration-none text-body px-3" href="mailto:<?= $domain->email ?>"><i
                                class="bi bi-envelope me-2"></i><?= $domain->email; ?></a>
                    </div>
                </div>
                <div class="col-md-6 text-center text-lg-end">
                    <div class="d-inline-flex align-items-center">
                        <a class="text-body px-2" href="<?= $domain->link_facebook; ?>">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a class="text-body px-2" href="<?= $domain->link_twitter; ?>">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a class="text-body px-2" href="<?= $domain->link_instagram ?>">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a class="text-body ps-2" href="<?= $domain->link_youtube; ?>">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid sticky-top bg-white shadow-sm">
        <div class="container">
            <nav class="navbar navbar-expand-lg bg-white navbar-light py-3 py-lg-0">
                <?php if ($domain->image_domain != null) { ?>
                    <img class="img-thumbnail img-preview" src="<?= base_url('assets/uploads/img/') . $domain->image_domain; ?>" style="max-width:150px;
    height:auto;">
                <?php } else { ?>
                    <a href="<?= base_url() ?>" class="navbar-brand">
                        <h1 class="m-0 text-uppercase text-primary"><?= $domain->meta_title ?></h1>
                    </a>
                <?php } ?>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0">

                        <?php
                        $current = uri_string();
                        ?>

                        <?php foreach ($menus as $menu): ?>

                            <?php
                            $url = base_url($menu['slug']);
                            $active = ($current == $menu['slug']) ? 'active' : '';
                            ?>

                            <?php if (!empty($menu['children'])): ?>

                                <div class="nav-item dropdown">

                                    <a href="#"
                                        class="nav-link dropdown-toggle <?= $active ?>"
                                        data-bs-toggle="dropdown">

                                        <?= ucwords(strtolower($menu['nama_menu'])) ?>

                                    </a>

                                    <div class="dropdown-menu m-0">

                                        <?php foreach ($menu['children'] as $child): ?>

                                            <?php
                                            $childActive = ($current == $child['slug']) ? 'active' : '';
                                            ?>

                                            <a href="<?= base_url($child['slug']) ?>"
                                                class="dropdown-item <?= $childActive ?>">

                                                <?= ucwords(strtolower($child['nama_menu'])) ?>

                                            </a>

                                        <?php endforeach; ?>

                                    </div>

                                </div>

                            <?php else: ?>

                                <a href="<?= $url ?>"
                                    class="nav-item nav-link <?= $active ?>">

                                    <?= ucwords(strtolower($menu['nama_menu'])) ?>

                                </a>

                            <?php endif; ?>

                        <?php endforeach; ?>

                    </div>
                </div>

            </nav>
        </div>
    </div>
    <?php
    // cekvar($sections);
    if (!empty($sections)): ?>

        <?php foreach ($sections as $sec): ?>

            <?php if ($sec->section == "TEAM_START_MEDINOVA"): ?>

            <?php endif; ?>
            <?php if ($sec->section == "HERO"): ?>
                <style>
                    .animated-title {
                        animation: fadeSlideGlow 4s ease-in-out infinite;
                    }

                    @keyframes fadeSlideGlow {
                        0% {
                            opacity: 0.7;
                            transform: translateY(20px);
                            text-shadow: 0 0 0px rgba(255, 255, 255, 0);
                        }

                        50% {
                            opacity: 1;
                            transform: translateY(0px);
                            text-shadow: 0 0 20px rgba(255, 255, 255, 0.8);
                        }

                        100% {
                            opacity: 0.7;
                            transform: translateY(20px);
                            text-shadow: 0 0 0px rgba(255, 255, 255, 0);
                        }
                    }

                    .text-shadow {
                        color: #fff;
                        text-shadow: 3px 3px 10px rgba(0, 0, 0, 0.8);
                    }
                </style>
                <div class="container-fluid py-5"
                    style="background-image:url('<?= base_url("assets/uploads/img/" . $sec->image) ?>');
background-size:cover;
background-position:center;
background-repeat:no-repeat;">

                    <div class="container py-5 text-center text-white">
                        <div class="row justify-content-start">

                            <div class="col-lg-8 text-center text-lg-start">
                                <h5 class="d-inline-block text-primary text-uppercase border-bottom border-5"
                                    style="border-color: rgba(256, 256, 256, .3) !important;"><?= $sec->span ?>
                                </h5>
                                <h1 class="display-3 animated-title"><?= $sec->title ?></h1>
                                <p class="text-shadow"><?= $sec->subtitle ?></p>

                                <?php if (!empty($sec->link)) : ?>
                                    <div class="pt-2">
                                        <a href="<?= $sec->link ?>" class="btn btn-light rounded-pill py-md-3 px-md-5 mx-2">Selengkapnya</a>
                                        <a href="<?= $sec->link_profil ?>" class="btn btn-outline-light rounded-pill py-md-3 px-md-5 mx-2">Profile</a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>


                        <div> <?= $sec->content ?> </div>

                    </div>

                </div>
            <?php endif; ?>

            <?php if ($sec->section == "ABOUT"): ?>
                <div class="container-fluid py-5">
                    <div class="container">
                        <div class="row gx-5">
                            <?php if (!empty($sec->image)): ?>
                                <div class="col-lg-5 mb-5 mb-lg-0" style="min-height: 500px;">
                                    <div class="position-relative h-100">
                                        <img class="img-thumbnail" src="<?= base_url('assets/uploads/img/') . $sec->image; ?>"
                                            style="object-fit: cover;">
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="col-lg-7">
                                <div class="mb-4">
                                    <?php if (!empty($sec->span)): ?>
                                        <span><?= $sec->span; ?></span>
                                    <?php endif; ?>

                                    <?php if (!empty($sec->subtitle)): ?>
                                        <h5 class="d-inline-block text-primary text-uppercase border-bottom border-5"><?= $sec->subtitle; ?></h5>
                                    <?php endif; ?>
                                    <?php if (!empty($sec->title)): ?>
                                        <h1 class="display-4"><?= $sec->title; ?></h1>
                                    <?php endif; ?>
                                </div>
                                <?= $sec->content; ?>
                            </div>
                        </div>
                    </div>
                </div>

            <?php endif; ?>
            <!-- Services Start -->
            <?php if ($sec->section == "SERVICES"):  ?>
                <div class="container-fluid py-5">
                    <div class="container">
                        <div class="text-center mx-auto mb-5" style="max-width: 500px;">
                            <h5 class="d-inline-block text-primary text-uppercase border-bottom border-5"><?= $sec->span; ?></h5>
                            <h1 class="display-4"><?= $sec->title; ?></h1>
                        </div>
                        <?= $sec->content; ?>

                        <?php
                        if ($sec->has_carousel == "1") {
                            $where_carousel = ['url_id' => $this->domain->id, 'section_id' => $sec->id];
                            $carousel_services = $this->Menu_model->fetch_data('tbl_carousel', $where_carousel)->result();
                        ?>
                            <div class="owl-carousel price-carousel position-relative" style="padding: 0 45px 45px 45px;">
                                <div class="bg-light rounded text-center">
                                    <?php foreach ($carousel_services as $row): ?>
                                        <div class="position-relative">
                                            <img class="img-fluid rounded-top" src="img/price-1.jpg" alt="">
                                            <div class="position-absolute w-100 h-100 top-50 start-50 translate-middle rounded-top d-flex flex-column align-items-center justify-content-center"
                                                style="background: rgba(29, 42, 77, .8);">
                                                <h3 class="text-white"><?= $row->subtitle ?></h3>
                                                <h1 class="display-4 text-white mb-0">
                                                    <?= $row->title; ?>
                                                </h1>
                                            </div>
                                        </div>
                                        <?= $row->content ?>
                                </div>
                                <?php if (!empty($row->link)): ?>
                                    <a href="<?= $row->link ?>" class="btn btn-primary rounded-pill py-3 px-5 my-2">Lebih Detail</a>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    <?php } ?>

                    </div>
                </div>
            <?php endif; ?>
            <?php if ($sec->section == "BANNER"): ?>
                <div class="container-fluid bg-primary my-5 py-5">
                    <div class="container py-5">
                        <div class="row gx-5">
                            <div class="col-lg-6 mb-5 mb-lg-0">
                                <div class="mb-4">
                                    <h5 class="d-inline-block text-white text-uppercase border-bottom border-5"><?= $sec->span; ?></h5>
                                    <h1 class="display-4"><?= $sec->title; ?></h1>
                                </div>
                                <img src="<?= base_url('assets/img/uploads/') . $sec->image ?>" class="img-thumbnail">
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <?php if ($sec->section == "NEWS_ALL"): ?>
                <div class="container-fluid py-5">
                    <div class="container">
                        <div class="text-center mx-auto mb-5" style="max-width: 500px;">
                            <h5 class="d-inline-block text-primary text-uppercase border-bottom border-5"><?= $sec->subtitle; ?></h5>
                            <h1 class="display-4"><?= $sec->title; ?></h1>
                        </div>
                        <?= $sec->content; ?>
                        <?php if ($sec->has_carousel == "1") { ?>

                        <?php } ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ($sec->section == "LATEST"): ?>

                <div class="container-fluid bg-primary my-5 py-5">
                    <div class="container py-5">
                        <div class="text-center mx-auto mb-5 text-white" style="max-width: 700px;">
                            <h5 class="d-inline-block text-white text-uppercase border-bottom border-5">
                                <?= $sec->subtitle; ?>
                            </h5>
                            <h1 class="display-4 mb-4 text-white">
                                <?= $sec->title ?>
                            </h1>
                            <h5 class="text-white fw-normal">
                                <?= $sec->content ?>
                            </h5>
                        </div>

                        <div class="mx-auto" style="width: 100%; max-width: 700px;">
                            <div class="input-group">
                                <a href="<?= $sec->link ?>"
                                    class="btn btn-dark btn-block border-0 w-25 d-flex align-items-center justify-content-center">
                                    Konsultasi
                                </a>

                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <?php if ($sec->section == "CAROUSEL"): ?>
                <div class="container-fluid py-5">
                    <div class="container">
                        <div class="text-center mx-auto mb-5" style="max-width: 500px;">
                            <h5 class="d-inline-block text-primary text-uppercase border-bottom border-5"><?= $sec->subtitle ?></h5>
                            <h1 class="display-4"><?= $sec->title ?></h1>
                        </div>
                        <?= $sec->content; ?>
                        <?php if ($sec->has_carousel == "1") {

                            $where_carousel = ['url_id' => $this->domain->id, 'section_id' => $sec->id];
                            $carousel_services = $this->Menu_model->fetch_data('tbl_carousel', $where_carousel)->result();

                        ?>
                            <div class="owl-carousel team-carousel position-relative">
                                <?php foreach ($carousel_services as $row) : ?>
                                    <div class="team-item">
                                        <div class="row g-0 bg-light rounded overflow-hidden">
                                            <div class="col-12 col-sm-5 h-100">
                                                <img class="img-thumbnail" src="<?= base_url('assets/uploads/img/') . $row->image; ?>">
                                            </div>
                                            <div class="col-12 col-sm-7 h-100 d-flex flex-column">
                                                <div class="mt-auto p-4">
                                                    <h3><?= $row->title ?></h3>
                                                    <h6 class="fw-normal fst-italic text-primary mb-4"><?= $row->subtitle ?></h6>
                                                    <p class="m-0"><?= $row->content ?></p>
                                                </div>
                                                <div class="d-flex mt-auto border-top p-4">
                                                    <a class="btn btn-lg btn-primary btn-lg-square rounded-circle me-3" href="<?= $row->twitter_link ?>"><i
                                                            class="fab fa-twitter"></i></a>
                                                    <a class="btn btn-lg btn-primary btn-lg-square rounded-circle me-3" href="<?= $row->facebook_link ?>"><i
                                                            class="fab fa-facebook-f"></i></a>
                                                    <a class="btn btn-lg btn-primary btn-lg-square rounded-circle" href="<?= $row->instagram_link ?>"><i
                                                            class="fab fa-instagram"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                    </div>
                <?php } ?>
                </div>
                </div>
            <?php endif; ?>
            <?php if ($sec->section == "TESTIMONIALS"):

            ?>
                <div class="container-fluid py-5">
                    <div class="container">
                        <div class="text-center mx-auto mb-5" style="max-width: 500px;">
                            <h5 class="d-inline-block text-primary text-uppercase border-bottom border-5"><?= $sec->subtitle; ?></h5>
                            <h1 class="display-4"><?= $sec->title; ?></h1>
                        </div>
                        <?php if ($sec->has_carousel == "1"):
                            $where_testimonial = ['url_id' => $this->domain->id, 'section_id' => $sec->id];
                            $get_testimonial = $this->Menu_model->fetch_data('tbl_carousel', $where_testimonial)->result();
                        ?>
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <div class="owl-carousel testimonial-carousel">
                                        <?php foreach ($get_testimonial as $row) : ?>
                                            <div class="testimonial-item text-center">
                                                <div class="position-relative mb-5">
                                                    <img class="img-fluid rounded-circle mx-auto" src="<?= base_url('assets/uploads/img/') . $row->image ?>" alt="<?= $row->alt_text; ?>">
                                                    <div class="position-absolute top-100 start-50 translate-middle d-flex align-items-center justify-content-center bg-white rounded-circle"
                                                        style="width: 60px; height: 60px;">
                                                        <i class="fa fa-quote-left fa-2x text-primary"></i>
                                                    </div>
                                                </div>
                                                <p class="fs-4 fw-normal"><?= $row->content; ?></p>
                                                <hr class="w-25 mx-auto">
                                                <h3><?= $row->title ?></h3>
                                                <h6 class="fw-normal text-primary mb-3"><?= $row->subtitle; ?></h6>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>

            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>