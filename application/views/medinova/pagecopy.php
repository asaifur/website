<body>
    <!-- Topbar Start -->
    <div class="container-fluid py-2 border-bottom d-none d-lg-block">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-lg-start mb-2 mb-lg-0">
                    <div class="d-inline-flex align-items-center">
                        <a class="text-decoration-none text-body pe-3" href="<?= $domain->wa_link; ?>"><i
                                class="bi bi-telephone me-2"></i><?= $domain->telepon; ?></a>
                        <span class="text-body">|</span>
                        <a class="text-decoration-none text-body px-3" href="#!"><i
                                class="bi bi-envelope me-2"></i><?= $domain->email; ?></a>
                    </div>
                </div>
                <div class="col-md-6 text-center text-lg-end">
                    <div class="d-inline-flex align-items-center">
                        <a class="text-body px-2" href="#!">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a class="text-body px-2" href="#!">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a class="text-body px-2" href="#!">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a class="text-body px-2" href="#!">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a class="text-body ps-2" href="#!">
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
                    <img class="img-thumbnail" src="<?= base_url('assets/uploads/img/') . $domain->image_domain; ?>">
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
                        $current_url = uri_string();
                        // cekvar($menu_header_utama_website);
                        foreach ($menu_header_utama_website->result_array() as $menu):

                            $url = !empty($menu['slug'])
                                ? base_url($menu['slug'])
                                : base_url();

                            $active = ($current_url == $menu['slug']) ? 'active' : '';

                            $target = $menu['target'] ?? '_self';
                        ?>

                            <?php if ($menu['have_child'] == 1) { ?>
                                <div class="nav-item dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                        <?= $menu['nama_menu'] ?>
                                    </a>

                                    <div class="dropdown-menu m-0">
                                        <?php
                                        $menu_child = $this->Menu_model->fetch_data(
                                            'table_menu_navigasi',
                                            [
                                                'parent_id' => $menu['id'],
                                                'url_id'    => $this->domain_id
                                            ]
                                        )->result();
                                        ?>

                                        <?php foreach ($menu_child as $child): ?>
                                            <a href="<?= base_url($child->slug) ?>" class="dropdown-item">
                                                <?= $child->nama_menu ?>
                                            </a>
                                        <?php endforeach; ?>
                                    </div>
                                </div>

                            <?php } else { ?>

                                <a href="<?= $url ?>"
                                    target="<?= $target ?>"
                                    class="nav-item nav-link <?= $active ?>">
                                    <?= $menu['nama_menu'] ?>
                                </a>

                            <?php } ?>

                        <?php endforeach; ?>

                    </div>
                </div>

            </nav>
        </div>
    </div>
    <?php
    $contents_page = $this->Page_model->getContents($page->id_page);
    $team = $this->Page_model->getSection($page->id_page, 'owl-carousel');
    ?>
    <?php if (!empty($contents_page)): ?>

        <?php foreach ($contents_page as $row): ?>

            <!-- HERO -->
            <?php if ($row->section == 'hero'): ?>

                <div class="container-fluid py-5"
                    style="background-image:url('<?= base_url("assets/uploads/img/" . $row->image) ?>');
background-size:cover;
background-position:center;
background-repeat:no-repeat;">

                    <div class="container text-center text-white">

                        <h1 class="display-3"><?= $row->title ?></h1>

                        <p><?= $row->subtitle ?></p>

                        <?= $row->content ?>

                    </div>

                </div>

            <?php endif; ?>


            <!-- ABOUT -->


            <!-- OWL CAROUSEL -->



            <!-- SERVICES -->
            <?php if ($row->section == 'services'): ?>

                <div class="container py-4">

                    <h3><?= $row->title ?></h3>

                    <?= $row->content ?>

                </div>

            <?php endif; ?>


            <!-- CONTACT -->



        <?php endforeach; ?>

    <?php endif; ?>
    <!-- Hero Start -->