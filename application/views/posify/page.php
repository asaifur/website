<body>
    <!-- Spinner Start -->
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg navbar-dark px-lg-5">
            <?php if ($domain->image_domain != null) { ?>
                <img class="img-thumbnail img-preview" src="<?= base_url('assets/uploads/img/') . $domain->image_domain; ?>" style="max-width:150px;
    height:auto;">
            <?php } else { ?>
                <a href="<?= base_url() ?>" class="navbar-brand">
                    <h1 class="m-0 text-uppercase text-primary"><?= $domain->meta_title ?></h1>
                </a>
            <?php } ?>
            <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse"
                data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <?php
            $current = uri_string();
            ?>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav mx-auto p-4 p-lg-0">
                    <?php foreach ($menus as $menu): ?>
                        <?php
                        $url = base_url($menu['slug']);
                        $active = ($current == $menu['slug']) ? 'active' : '';
                        ?>
                        <?php if (!empty($menu['children'])): ?>
                            <!-- <a href="index.html" class="nav-item nav-link active">Home</a>
                    <a href="about.html" class="nav-item nav-link">About</a>
                    <a href="service.html" class="nav-item nav-link">Services</a> -->

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
    <?php if ($page->has_carousel == 1) { ?>
        <?php
        $where = ['carousel_page' => $page->carousel_id];
        $data = $this->Page_model->getCarousel('table_carousel', $where)->result();
        $this->load->view('posify/carousel', $data); ?>
    <?php } ?>
    </div>
    <!-- Header End -->


    <!-- About Start -->
    <?php
    //  cekvar($sections);
    if (!empty($sections)): ?>
        <?php foreach ($sections as $sec): ?>

            <?php if ($sec->section == "ABOUT"): ?>
                <div class="container-fluid bg-secondary">
                    <div class="container">
                        <div class="row g-5 align-items-center">
                            <div class="col-lg-7 pb-0 pb-lg-5 py-5">
                                <div class="pb-0 pb-lg-5 py-5">
                                    <div class="title wow fadeInUp" data-wow-delay="0.1s">
                                        <div class="title-left">
                                            <h5><?= $sec->title; ?></h5>
                                            <h1><?= $sec->subtitle; ?></h1>
                                        </div>
                                    </div>
                                    <div class="animate__animated animate__backInLeft"> <?= $sec->content; ?> </div>

                                </div>
                            </div>
                            <div class="col-lg-5 wow fadeInUp" data-wow-delay="0.5s">
                                <img class="img-fluid" src="<?= base_url('assets/uploads/img/') . $sec->image; ?>" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ($sec->section == "HERO"): ?>
                <div class="container-fluid py-5"
                    style="background-image:url('<?= base_url("assets/uploads/img/" . $sec->image) ?>');
background-size:cover;
background-position:center;
background-repeat:no-repeat;">

                    <div class="container text-center text-white">

                        <h1 class="display-3"><?= $sec->title ?></h1>

                        <p><?= $sec->subtitle ?></p>

                        <?= $sec->content ?>

                    </div>

                </div>
            <?php endif; ?>

            <?php if ($sec->section == "SERVICES"): ?>
                <div class="container-fluid py-5">
                    <div class="container py-5">
                        <div class="text-center">
                            <div class="title wow fadeInUp" data-wow-delay="0.1s">
                                <div class="title-center">
                                    <h5><?= $sec->title; ?></h5>
                                    <h1><?= $sec->subtitle ?></h1>
                                </div>
                            </div>
                        </div>
                        <div class="service-item service-item-left">
                            <div class="row g-0 align-items-center">
                                <div class="col-md-5">
                                    <div class="service-img p-5 wow fadeInRight" data-wow-delay="0.2s">
                                        <img class="img-fluid rounded-circle" src="<?= base_url(" assets/uploads/img/" . $sec->image); ?>" alt="">
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <?= $sec->content; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ($sec->section == "PORTFOLIO"): ?>

            <?php endif; ?>

            <?php if ($sec->section == "CAROUSEL"): ?>

            <?php endif; ?>

            <?php if ($sec->section == "CONTACT"): ?>

            <?php endif; ?>

            <?php if ($sec->section == "LASTFOOTER"): ?>

            <?php endif; ?>

            <?php if ($sec->section == "BANNER"): ?>
                <div class="container-fluid py-5 bg-secondary">
                    <div class="container py-5">
                        <div class="row g-0 justify-content-center">
                            <div class="col-lg-7 text-center">
                                <div class="title mx-5 px-5 wow fadeInUp" data-wow-delay="0.1s">
                                    <div class="title-center">
                                        <h5>Casting</h5>
                                        <h1>Want to be a Model?</h1>
                                    </div>
                                </div>
                                <p class="fs-5 mb-5 wow fadeInUp" data-wow-delay="0.2s">Lorem ipsum dolor sit amet, consectetur
                                    adipiscing elit. Sed erat lectus, venenatis sit amet egestas eget, aliquet a nisl.</p>
                                <div class="position-relative wow fadeInUp" data-wow-delay="0.3s">
                                    <input class="form-control border-0 bg-dark rounded-pill w-100 py-4 ps-4 pe-5" type="text"
                                        placeholder="Your email">
                                    <button type="button" class="btn btn-primary py-3 px-4 position-absolute top-0 end-0 me-2"
                                        style="margin-top: 7px;">SignUp</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ($sec->section == "TEAM"): ?>
                <div class="container-fluid py-5">
                    <div class="container py-5">
                        <div class="text-center">
                            <div class="title wow fadeInUp" data-wow-delay="0.1s">
                                <div class="title-center">
                                    <h5>Models</h5>
                                    <h1>Meet Our Models</h1>
                                </div>
                            </div>
                        </div>
                        <div class="row g-4">
                            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                                <div class="team-item">
                                    <div class="team-body">
                                        <div class="team-before">
                                            <span>Age</span>
                                            <span>Height</span>
                                            <span>Weight</span>
                                            <span>Bust</span>
                                            <span>Waist</span>
                                            <span>Hips</span>
                                        </div>
                                        <img class="img-fluid" src="img/team-1.jpg" alt="">
                                        <div class="team-after">
                                            <span>22</span>
                                            <span>185</span>
                                            <span>55</span>
                                            <span>79</span>
                                            <span>59</span>
                                            <span>89</span>
                                        </div>
                                    </div>
                                    <a class="team-name" href="#">
                                        <h5 class="text-uppercase mb-0">Naomy Olsen</h5>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                                <div class="team-item">
                                    <div class="team-body">
                                        <div class="team-before">
                                            <span>Age</span>
                                            <span>Height</span>
                                            <span>Weight</span>
                                            <span>Bust</span>
                                            <span>Waist</span>
                                            <span>Hips</span>
                                        </div>
                                        <img class="img-fluid" src="img/team-2.jpg" alt="">
                                        <div class="team-after">
                                            <span>22</span>
                                            <span>185</span>
                                            <span>55</span>
                                            <span>79</span>
                                            <span>59</span>
                                            <span>89</span>
                                        </div>
                                    </div>
                                    <a class="team-name" href="#">
                                        <h5 class="text-uppercase mb-0">Pamela Torney</h5>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                                <div class="team-item">
                                    <div class="team-body">
                                        <div class="team-before">
                                            <span>Age</span>
                                            <span>Height</span>
                                            <span>Weight</span>
                                            <span>Bust</span>
                                            <span>Waist</span>
                                            <span>Hips</span>
                                        </div>
                                        <img class="img-fluid" src="img/team-3.jpg" alt="">
                                        <div class="team-after">
                                            <span>22</span>
                                            <span>185</span>
                                            <span>55</span>
                                            <span>79</span>
                                            <span>59</span>
                                            <span>89</span>
                                        </div>
                                    </div>
                                    <a class="team-name" href="#">
                                        <h5 class="text-uppercase mb-0">Joanne Irwin</h5>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.7s">
                                <div class="team-item">
                                    <div class="team-body">
                                        <div class="team-before">
                                            <span>Age</span>
                                            <span>Height</span>
                                            <span>Weight</span>
                                            <span>Bust</span>
                                            <span>Waist</span>
                                            <span>Hips</span>
                                        </div>
                                        <img class="img-fluid" src="img/team-4.jpg" alt="">
                                        <div class="team-after">
                                            <span>22</span>
                                            <span>185</span>
                                            <span>55</span>
                                            <span>79</span>
                                            <span>59</span>
                                            <span>89</span>
                                        </div>
                                    </div>
                                    <a class="team-name" href="#">
                                        <h5 class="text-uppercase mb-0">Gillian Rowe</h5>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                                <div class="team-item">
                                    <div class="team-body">
                                        <div class="team-before">
                                            <span>Age</span>
                                            <span>Height</span>
                                            <span>Weight</span>
                                            <span>Bust</span>
                                            <span>Waist</span>
                                            <span>Hips</span>
                                        </div>
                                        <img class="img-fluid" src="img/team-5.jpg" alt="">
                                        <div class="team-after">
                                            <span>22</span>
                                            <span>185</span>
                                            <span>55</span>
                                            <span>79</span>
                                            <span>59</span>
                                            <span>89</span>
                                        </div>
                                    </div>
                                    <a class="team-name" href="#">
                                        <h5 class="text-uppercase mb-0">Naomy Olsen</h5>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                                <div class="team-item">
                                    <div class="team-body">
                                        <div class="team-before">
                                            <span>Age</span>
                                            <span>Height</span>
                                            <span>Weight</span>
                                            <span>Bust</span>
                                            <span>Waist</span>
                                            <span>Hips</span>
                                        </div>
                                        <img class="img-fluid" src="img/team-6.jpg" alt="">
                                        <div class="team-after">
                                            <span>22</span>
                                            <span>185</span>
                                            <span>55</span>
                                            <span>79</span>
                                            <span>59</span>
                                            <span>89</span>
                                        </div>
                                    </div>
                                    <a class="team-name" href="#">
                                        <h5 class="text-uppercase mb-0">Pamela Torney</h5>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                                <div class="team-item">
                                    <div class="team-body">
                                        <div class="team-before">
                                            <span>Age</span>
                                            <span>Height</span>
                                            <span>Weight</span>
                                            <span>Bust</span>
                                            <span>Waist</span>
                                            <span>Hips</span>
                                        </div>
                                        <img class="img-fluid" src="img/team-7.jpg" alt="">
                                        <div class="team-after">
                                            <span>22</span>
                                            <span>185</span>
                                            <span>55</span>
                                            <span>79</span>
                                            <span>59</span>
                                            <span>89</span>
                                        </div>
                                    </div>
                                    <a class="team-name" href="#">
                                        <h5 class="text-uppercase mb-0">Joanne Irwin</h5>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.7s">
                                <div class="team-item">
                                    <div class="team-body">
                                        <div class="team-before">
                                            <span>Age</span>
                                            <span>Height</span>
                                            <span>Weight</span>
                                            <span>Bust</span>
                                            <span>Waist</span>
                                            <span>Hips</span>
                                        </div>
                                        <img class="img-fluid" src="img/team-8.jpg" alt="">
                                        <div class="team-after">
                                            <span>22</span>
                                            <span>185</span>
                                            <span>55</span>
                                            <span>79</span>
                                            <span>59</span>
                                            <span>89</span>
                                        </div>
                                    </div>
                                    <a class="team-name" href="#">
                                        <h5 class="text-uppercase mb-0">Gillian Rowe</h5>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ($sec->section == "TESTIMONIALS"): ?>
                <div class="container-fluid py-5 bg-secondary">
                    <div class="container py-5">
                        <div class="text-center">
                            <div class="title wow fadeInUp" data-wow-delay="0.1s">
                                <div class="title-center">
                                    <h5>Testimonial</h5>
                                    <h1>Our Clients Say</h1>
                                </div>
                            </div>
                        </div>
                        <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.3s">
                            <div class="testimonial-item text-center"
                                data-dot="<img class='img-fluid' src='img/testimonial-1.jpg' alt=''>">
                                <p class="fs-5">Clita clita tempor justo dolor ipsum amet kasd amet duo justo duo duo labore sed
                                    sed. Magna ut diam sit et amet stet eos sed clita erat magna elitr erat sit sit erat at rebum
                                    justo sea clita.</p>
                                <h5 class="text-uppercase">Joanne Irwin</h5>
                                <span class="text-primary">Profession</span>
                            </div>
                            <div class="testimonial-item text-center"
                                data-dot="<img class='img-fluid' src='img/testimonial-2.jpg' alt=''>">
                                <p class="fs-5">Clita clita tempor justo dolor ipsum amet kasd amet duo justo duo duo labore sed
                                    sed. Magna ut diam sit et amet stet eos sed clita erat magna elitr erat sit sit erat at rebum
                                    justo sea clita.</p>
                                <h5 class="text-uppercase">Lana Anderson</h5>
                                <span class="text-primary">Profession</span>
                            </div>
                            <div class="testimonial-item text-center"
                                data-dot="<img class='img-fluid' src='img/testimonial-3.jpg' alt=''>">
                                <p class="fs-5">Clita clita tempor justo dolor ipsum amet kasd amet duo justo duo duo labore sed
                                    sed. Magna ut diam sit et amet stet eos sed clita erat magna elitr erat sit sit erat at rebum
                                    justo sea clita.</p>
                                <h5 class="text-uppercase">Pamela Torney</h5>
                                <span class="text-primary">Profession</span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>



        <?php endforeach; ?>

    <?php endif; ?>

    <!-- Back to Top -->
    <a href="#" class="btn btn-outline-primary border-2 btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>