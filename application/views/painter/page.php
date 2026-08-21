<body>

    <?= $domain->link_google_analitycs ?? '' ?>

    <!-- Topbar Start -->
    <div class="container-fluid bg-primary d-none d-lg-block">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-lg-start mb-2 mb-lg-0">
                    <div class="d-inline-flex align-items-center">
                        <?php if (!empty($domain->telepon)) : ?>
                            <a class="text-dark py-2 pe-3 border-end border-white" href="<?= $domain->wa_link ?? '#'; ?>">
                                <i class="bi bi-telephone text-secondary me-2"></i><?= $domain->telepon; ?>
                            </a>
                        <?php endif; ?>
                        <?php if (!empty($domain->email)) : ?>
                            <a class="text-dark py-2 px-3" href="mailto:<?= $domain->email; ?>">
                                <i class="bi bi-envelope text-secondary me-2"></i><?= $domain->email; ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-6 text-center text-lg-end">
                    <div class="d-inline-flex align-items-center">
                        <?php if (!empty($domain->link_facebook)) : ?>
                            <a class="text-body py-2 px-3 border-end border-white" href="<?= $domain->link_facebook; ?>" target="_blank">
                                <i class="fab fa-facebook-f text-secondary"></i>
                            </a>
                        <?php endif; ?>
                        <?php if (!empty($domain->link_twitter)) : ?>
                            <a class="text-body py-2 px-3 border-end border-white" href="<?= $domain->link_twitter; ?>" target="_blank">
                                <i class="fab fa-twitter text-secondary"></i>
                            </a>
                        <?php endif; ?>
                        <?php if (!empty($domain->link_instagram)) : ?>
                            <a class="text-body py-2 px-3 border-end border-white" href="<?= $domain->link_instagram; ?>" target="_blank">
                                <i class="fab fa-instagram text-secondary"></i>
                            </a>
                        <?php endif; ?>
                        <?php if (!empty($domain->link_youtube)) : ?>
                            <a class="text-body py-2 ps-3" href="<?= $domain->link_youtube; ?>" target="_blank">
                                <i class="fab fa-youtube text-secondary"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark shadow-sm px-5 py-3 py-lg-0">
        <?php if (!empty($domain->image_domain)) : ?>
            <a href="<?= base_url(); ?>" class="navbar-brand p-0">
                <img class="img-thumbnail img-preview" src="<?= base_url('assets/uploads/img/') . $domain->image_domain; ?>" alt="<?= $domain->meta_title ?? 'Logo'; ?>" style="max-height: 60px; width: auto;">
            </a>
        <?php else : ?>
            <a href="<?= base_url(); ?>" class="navbar-brand p-0">
                <h1 class="m-0 text-uppercase text-primary">
                    <i class="fa fa-paint-roller text-secondary me-3"></i><?= $domain->meta_title ?? 'Painter'; ?>
                </h1>
            </a>
        <?php endif; ?>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto py-0 pe-4 border-end border-5 border-primary">
                <?php
                $current = uri_string();
                ?>
                <?php if (!empty($menus) && is_array($menus)) : ?>
                    <?php foreach ($menus as $menu) : ?>
                        <?php
                        $url = base_url($menu['slug']);
                        $active = ($current == $menu['slug']) ? 'active' : '';
                        ?>

                        <?php if (!empty($menu['children'])) : ?>
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle <?= $active; ?>" data-bs-toggle="dropdown">
                                    <?= ucwords(strtolower($menu['nama_menu'])); ?>
                                </a>
                                <div class="dropdown-menu m-0">
                                    <?php foreach ($menu['children'] as $child) : ?>
                                        <?php
                                        $childActive = ($current == $child['slug']) ? 'active' : '';
                                        ?>
                                        <a href="<?= base_url($child['slug']); ?>" class="dropdown-item <?= $childActive; ?>">
                                            <?= ucwords(strtolower($child['nama_menu'])); ?>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php else : ?>
                            <a href="<?= $url; ?>" class="nav-item nav-link <?= $active; ?>">
                                <?= ucwords(strtolower($menu['nama_menu'])); ?>
                            </a>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <?php if (!empty($domain->telepon)) : ?>
                <div class="d-none d-lg-flex align-items-center ps-4">
                    <i class="fa fa-2x fa-mobile-alt text-secondary me-3"></i>
                    <div>
                        <h5 class="text-primary mb-1"><small>Call Now</small></h5>
                        <h6 class="text-light m-0"><?= $domain->telepon; ?></h6>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </nav>
    <!-- Navbar End -->

    <!-- Hero Start -->
    <div class="container-fluid bg-primary py-5 bg-hero" style="margin-bottom: 90px;">
        <div class="container py-5">
            <div class="row justify-content-start">
                <div class="col-lg-8 text-center text-lg-start">
                    <h1 class="display-1 text-dark">Solusi Tata Udara & Peralatan Dapur Komersial</h1>
                    <p class="fs-4 text-dark mb-4">Spesialis instalasi ducting exhaust, sistem fresh air, serta fabrikasi kitchen equipment stainless steel berstandar industri dan restoran.</p>
                    <div class="pt-2">
                        <a href="<?= $domain->wa_link ?? '#'; ?>" target="_blank" class="btn btn-secondary rounded-pill py-md-3 px-md-5 mx-2">Konsultasi Gratis</a>
                        <a href="<?= base_url('contact'); ?>" class="btn btn-outline-secondary rounded-pill py-md-3 px-md-5 mx-2">Hubungi Kami</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->


    <!-- About Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row gx-0 mb-3 mb-lg-0">
                <div class="col-lg-6 my-lg-5 py-lg-5">
                    <div class="about-start bg-primary p-5">
                        <h1 class="display-5 mb-4">CV Kitchen Tera Sentosa</h1>
                        <p>Kami adalah mitra fabrikasi dan kontraktor kitchen system terpercaya. Melayani perancangan dan pengerjaan instalasi exhaust hood, ducting BJLS/stainless, blower fan, serta penyediaan peralatan dapur restoran berkualitas tinggi untuk hotel, resto, cafe, dan katering.</p>
                        <a href="<?= $domain->wa_link ?? '#'; ?>" target="_blank" class="btn btn-secondary rounded-pill py-md-3 px-md-5 mt-4">Hubungi Kami</a>
                    </div>
                </div>
                <div class="col-lg-6" style="min-height: 400px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 h-100" src="<?= base_url('assets/painter/img/about-1.jpg'); ?>" style="object-fit: cover;" alt="Ducting Exhaust System">
                    </div>
                </div>
            </div>
            <div class="row gx-0">
                <div class="col-lg-6" style="min-height: 400px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 h-100" src="<?= base_url('assets/painter/img/about-2.jpg'); ?>" style="object-fit: cover;" alt="Kitchen Equipment">
                    </div>
                </div>
                <div class="col-lg-6 my-lg-5 py-lg-5">
                    <div class="about-end bg-primary p-5">
                        <h1 class="display-5 mb-4">Mengapa Memilih Kami?</h1>
                        <p>Didukung oleh teknisi berpengalaman, perhitungan aliran udara (CFM/static pressure) yang presisi, material stainless steel anti-karat food grade, dan pengerjaan rapi bergaransi demi kenyamanan serta keamanan operasional dapur Anda.</p>
                        <a href="<?= $domain->wa_link ?? '#'; ?>" target="_blank" class="btn btn-secondary rounded-pill py-md-3 px-md-5 mt-4">Minta Penawaran</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Services Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="text-center mx-auto mb-5" style="max-width: 600px;">
                <h1 class="display-5">Layanan & Produk Unggulan</h1>
                <hr class="w-25 mx-auto text-primary" style="opacity: 1;">
            </div>
            <div class="row gy-4 gx-3">
                <div class="col-lg-4 col-md-6 pt-5">
                    <div class="service-item d-flex flex-column align-items-center justify-content-center text-center p-5 pt-0">
                        <div class="service-icon p-3">
                            <div><i class="fa fa-2x fa-wind"></i></div>
                        </div>
                        <h3 class="mt-5">Instalasi Ducting Exhaust</h3>
                        <p class="mt-2">Pemasangan jalur pembuangan asap dan uap panas dapur menggunakan hood stainless & blower centrifugal.</p>
                        <a class="btn shadow-none text-secondary" href="<?= base_url('services'); ?>">Lihat Detail<i class="bi bi-arrow-right ms-1"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 pt-5">
                    <div class="service-item d-flex flex-column align-items-center justify-content-center text-center p-5 pt-0">
                        <div class="service-icon p-3">
                            <div><i class="fa fa-2x fa-fan"></i></div>
                        </div>
                        <h3 class="mt-5">Sistem Fresh Air</h3>
                        <p class="mt-2">Sirkulasi udara segar untuk menjaga temperatur, tekanan udara, dan kenyamanan area kerja dapur.</p>
                        <a class="btn shadow-none text-secondary" href="<?= base_url('services'); ?>">Lihat Detail<i class="bi bi-arrow-right ms-1"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 pt-5">
                    <div class="service-item d-flex flex-column align-items-center justify-content-center text-center p-5 pt-0">
                        <div class="service-icon p-3">
                            <div><i class="fa fa-2x fa-fire"></i></div>
                        </div>
                        <h3 class="mt-5">Kwali Range & Kompor</h3>
                        <p class="mt-2">Fabrikasi kompor komersial heavy duty, single/double kwali range, stock pot, dan burner berkualitas SNI.</p>
                        <a class="btn shadow-none text-secondary" href="<?= base_url('services'); ?>">Lihat Detail<i class="bi bi-arrow-right ms-1"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 pt-5">
                    <div class="service-item d-flex flex-column align-items-center justify-content-center text-center p-5 pt-0">
                        <div class="service-icon p-3">
                            <div><i class="fa fa-2x fa-sink"></i></div>
                        </div>
                        <h3 class="mt-5">Stainless Sink & Table</h3>
                        <p class="mt-2">Meja kerja stainless steel, grease trap, dan custom single/double sink anti karat food-grade.</p>
                        <a class="btn shadow-none text-secondary" href="<?= base_url('services'); ?>">Lihat Detail<i class="bi bi-arrow-right ms-1"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 pt-5">
                    <div class="service-item d-flex flex-column align-items-center justify-content-center text-center p-5 pt-0">
                        <div class="service-icon p-3">
                            <div><i class="fa fa-2x fa-boxes"></i></div>
                        </div>
                        <h3 class="mt-5">Cabinet & Rak Stainless</h3>
                        <p class="mt-2">Penyimpanan higienis dengan wall shelf, sliding cabinet, dan solid tier rack kustom sesuai dimensi dapur.</p>
                        <a class="btn shadow-none text-secondary" href="<?= base_url('services'); ?>">Lihat Detail<i class="bi bi-arrow-right ms-1"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 pt-5">
                    <div class="service-item d-flex flex-column align-items-center justify-content-center text-center p-5 pt-0">
                        <div class="service-icon p-3">
                            <div><i class="fa fa-2x fa-tools"></i></div>
                        </div>
                        <h3 class="mt-5">Maintenance & Service</h3>
                        <p class="mt-2">Perawatan berkala, cleaning exhaust hood, pembersihan ducting grease, serta balancing blower fan.</p>
                        <a class="btn shadow-none text-secondary" href="<?= base_url('services'); ?>">Lihat Detail<i class="bi bi-arrow-right ms-1"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Services End -->


    <!-- Quote Start -->
    <div class="container-fluid bg-primary bg-quote py-5" style="margin: 90px 0;">
        <div class="container py-5">
            <div class="row g-0 justify-content-start">
                <div class="col-lg-6">
                    <div class="bg-white text-center p-5">
                        <h1 class="mb-4">Minta Penawaran Harga</h1>
                        <form action="<?= base_url('contact/send'); ?>" method="post">
                            <div class="row g-3">
                                <div class="col-12 col-sm-6">
                                    <input type="text" name="nama" class="form-control bg-light border-0" placeholder="Nama Anda / Perusahaan" style="height: 55px;" required>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <input type="tel" name="telepon" class="form-control bg-light border-0" placeholder="Nomor WhatsApp" style="height: 55px;" required>
                                </div>
                                <div class="col-12">
                                    <input type="text" name="kebutuhan" class="form-control bg-light border-0" placeholder="Jenis Kebutuhan (Ducting / Equipment / Service)" style="height: 55px;" required>
                                </div>
                                <div class="col-12">
                                    <textarea name="pesan" class="form-control bg-light border-0 py-3" rows="3" placeholder="Detail Proyek / Ukuran Lokasi"></textarea>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary w-100 py-3" type="submit">Kirim Permintaan Estimasi</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Quote End -->


    <!-- Call To Action Start -->
    <div class="container-fluid bg-primary bg-call-to-action py-5" style="margin-top: 90px;">
        <div class="container py-5">
            <div class="row g-0 justify-content-start">
                <div class="col-lg-7">
                    <h1 class="display-5 mb-4">Rencanakan Dapur Komersial Standar Profesional</h1>
                    <p class="fs-4 fw-normal">Dapatkan konsultasi tata letak dapur dan rancang bangun sistem exhaust blower yang efisien, hemat daya, serta minim polusi udara.</p>
                    <a href="<?= $domain->wa_link ?? '#'; ?>" target="_blank" class="btn btn-secondary rounded-pill py-md-3 px-md-5 mt-4">Hubungi Teknisi Kami</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Call To Action End -->


    <!-- Footer Start -->
    <div class="container-fluid bg-dark bg-footer text-light py-5">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-4 col-md-6">
                    <h4 class="text-primary"><?= $domain->meta_title ?? 'CV Kitchen Tera Sentosa'; ?></h4>
                    <hr class="w-25 text-secondary mb-4" style="opacity: 1;">
                    <p class="mb-4"><?= $domain->meta_description ?? 'Kontraktor spesialis perancangan tata udara dapur komersial, instalasi exhaust ducting, fresh air, dan fabrikasi kitchen stainless steel.'; ?></p>
                    <?php if (!empty($domain->alamat)) : ?>
                        <p class="mb-2"><i class="fa fa-map-marker-alt text-primary me-3"></i><?= $domain->alamat; ?></p>
                    <?php endif; ?>
                    <?php if (!empty($domain->email)) : ?>
                        <p class="mb-2"><i class="fa fa-envelope text-primary me-3"></i><?= $domain->email; ?></p>
                    <?php endif; ?>
                    <?php if (!empty($domain->telepon)) : ?>
                        <p class="mb-0"><i class="fa fa-phone-alt text-primary me-3"></i><?= $domain->telepon; ?></p>
                    <?php endif; ?>
                </div>
                <div class="col-lg-4 col-md-6">
                    <h4 class="text-primary">Layanan Kami</h4>
                    <hr class="w-25 text-secondary mb-4" style="opacity: 1;">
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-light mb-2" href="#"><i class="fa fa-angle-right me-2"></i>Instalasi Exhaust Ducting</a>
                        <a class="text-light mb-2" href="#"><i class="fa fa-angle-right me-2"></i>Sistem Fresh Air & Make-up Air</a>
                        <a class="text-light mb-2" href="#"><i class="fa fa-angle-right me-2"></i>Fabrikasi Single/Double Kwali Range</a>
                        <a class="text-light mb-2" href="#"><i class="fa fa-angle-right me-2"></i>Kitchen Stainless Work Table & Sink</a>
                        <a class="text-light mb-2" href="#"><i class="fa fa-angle-right me-2"></i>Grease Trap & Hood Filter</a>
                        <a class="text-light" href="#"><i class="fa fa-angle-right me-2"></i>Cleaning & Maintenance Ducting</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <h4 class="text-primary">Menu Navigasi</h4>
                    <hr class="w-25 text-secondary mb-4" style="opacity: 1;">
                    <div class="d-flex flex-column justify-content-start">
                        <?php if (!empty($menus) && is_array($menus)) : ?>
                            <?php foreach ($menus as $menu) : ?>
                                <a class="text-light mb-2" href="<?= base_url($menu['slug']); ?>"><i class="fa fa-angle-right me-2"></i><?= ucwords(strtolower($menu['nama_menu'])); ?></a>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <a class="text-light mb-2" href="<?= base_url(); ?>"><i class="fa fa-angle-right me-2"></i>Beranda</a>
                            <a class="text-light mb-2" href="<?= base_url('about'); ?>"><i class="fa fa-angle-right me-2"></i>Tentang Kami</a>
                            <a class="text-light mb-2" href="<?= base_url('services'); ?>"><i class="fa fa-angle-right me-2"></i>Layanan</a>
                            <a class="text-light" href="<?= base_url('contact'); ?>"><i class="fa fa-angle-right me-2"></i>Kontak</a>
                        <?php endif; ?>
                    </div>
                    <h6 class="text-primary mt-4 mb-3">Media Sosial</h6>
                    <div class="d-flex">
                        <?php if (!empty($domain->link_twitter)) : ?>
                            <a class="btn btn-lg btn-primary btn-lg-square rounded-circle me-2" href="<?= $domain->link_twitter; ?>" target="_blank"><i class="fab fa-twitter"></i></a>
                        <?php endif; ?>
                        <?php if (!empty($domain->link_facebook)) : ?>
                            <a class="btn btn-lg btn-primary btn-lg-square rounded-circle me-2" href="<?= $domain->link_facebook; ?>" target="_blank"><i class="fab fa-facebook-f"></i></a>
                        <?php endif; ?>
                        <?php if (!empty($domain->link_instagram)) : ?>
                            <a class="btn btn-lg btn-primary btn-lg-square rounded-circle me-2" href="<?= $domain->link_instagram; ?>" target="_blank"><i class="fab fa-instagram"></i></a>
                        <?php endif; ?>
                        <?php if (!empty($domain->link_youtube)) : ?>
                            <a class="btn btn-lg btn-primary btn-lg-square rounded-circle" href="<?= $domain->link_youtube; ?>" target="_blank"><i class="fab fa-youtube"></i></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-primary text-dark py-4">
        <div class="container">
            <div class="row g-0">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-md-0">&copy; <?= date('Y'); ?> <a class="text-dark fw-bold" href="<?= base_url(); ?>"><?= $domain->domain_name ?? 'CV Kitchen Tera Sentosa'; ?></a>. All Rights Reserved.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <p class="mb-0">Spesialis Ducting Exhaust & Commercial Kitchen Equipment</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->