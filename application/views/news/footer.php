<?php
// Memanggil fungsi helper warna jika tersedia
$primary_color = function_exists('get_color') ? get_color('primary') : (!empty($domain->primary_color) ? $domain->primary_color : '#b91c1c');
$navy_color    = function_exists('get_color') ? get_color('navy') : (!empty($domain->navy_color) ? $domain->navy_color : '#0f172a');
?>

<!-- Floating Contact WhatsApp & Call (Left Floating) -->
<style>
    .floating-contact {
        position: fixed;
        left: 15px;
        bottom: 25px;
        z-index: 9999;
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .float-btn {
        display: flex;
        align-items: center;
        background: #ffffff;
        border-radius: 50px;
        padding: 5px 12px 5px 5px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        text-decoration: none;
        transition: all 0.3s ease;
        animation: floatBounce 2.5s infinite;
    }

    .float-btn img {
        width: 46px;
        height: 46px;
        object-fit: contain;
    }

    .float-btn .label {
        margin-left: 8px;
        font-size: 13px;
        font-weight: 700;
        color: #1e293b;
    }

    .float-btn:hover {
        transform: translateY(-3px) scale(1.03);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
    }

    @keyframes floatBounce {

        0%,
        20%,
        50%,
        80%,
        100% {
            transform: translateY(0);
        }

        40% {
            transform: translateY(-6px);
        }

        60% {
            transform: translateY(-3px);
        }
    }

    @media (max-width: 768px) {
        .float-btn {
            padding: 5px;
        }

        .float-btn img {
            width: 42px;
            height: 42px;
        }

        .float-btn .label {
            display: none;
        }
    }
</style>

<div class="floating-contact">
    <!-- WhatsApp Button -->
    <?php
    $wa_link = !empty($domain->wa_link) ? $domain->wa_link : (!empty($this->domain->wa_link) ? $this->domain->wa_link : '');
    if (!empty($wa_link)) :
    ?>
        <a href="<?= $wa_link; ?>" target="_blank" class="float-btn" title="Chat WhatsApp">
            <img src="<?= base_url('assets/uploads/img/fd14d9811e056a03b44e7c3e043b2476.png'); ?>" alt="WhatsApp">
            <span class="label">Chat WhatsApp</span>
        </a>
    <?php endif; ?>

    <!-- Phone Call Button -->
    <?php
    $telepon = !empty($domain->telepon) ? $domain->telepon : (!empty($this->domain->telepon) ? $this->domain->telepon : '');
    if (!empty($telepon)) :
    ?>
        <a href="tel:<?= $telepon; ?>" class="float-btn" title="Telepon Kami">
            <img src="<?= base_url('assets/uploads/img/b06f39c95463db9183a5d3fa912777ee.png'); ?>" alt="Telepon">
            <span class="label">Hubungi Kami</span>
        </a>
    <?php endif; ?>
</div>

<footer>
    <!-- Footer Start-->
    <div class="footer-main footer-bg" style="background-color: <?= $navy_color; ?> !important; color: #94a3b8;">
        <div class="footer-area footer-padding">
            <div class="container">
                <div class="row d-flex justify-content-between">

                    <!-- Column 1: Logo & Company Desc -->
                    <div class="col-xl-3 col-lg-3 col-md-5 col-sm-8">
                        <div class="single-footer-caption mb-50">
                            <div class="single-footer-caption mb-30">
                                <div class="footer-logo">
                                    <?php
                                    $logoImg = !empty($this->domain->image_domain) ? $this->domain->image_domain : (!empty($domain->logo) ? $domain->logo : 'default.png');
                                    ?>
                                    <?php if (!empty($logoImg) && $logoImg !== 'default.png') : ?>
                                        <a href="<?= base_url(); ?>"><img src="<?= base_url('assets/uploads/img/') . $logoImg; ?>" alt="Logo" style="max-height: 50px; width: auto; object-fit: contain;"></a>
                                    <?php else : ?>
                                        <a href="<?= base_url(); ?>"><img src="<?= base_url('assets/news/') ?>assets/img/logo/logo2_footer.png" alt=""></a>
                                    <?php endif; ?>
                                </div>
                                <div class="footer-tittle">
                                    <div class="footer-pera">
                                        <p class="info1">
                                            <?= !empty($this->domain->meta_description) ? $this->domain->meta_description : (!empty($domain->meta_description) ? $domain->meta_description : 'Perusahaan kontraktor spesialis kitchen equipment, fabrikasi stainless kustom, instalasi ducting exhaust, sistem fresh air, dan jaringan gas restoran profesional.'); ?>
                                        </p>
                                        <p class="info2">
                                            <i class="fa-solid fa-location-dot text-danger mr-1"></i>
                                            <?= !empty($domain->alamat) ? $domain->alamat : 'Jl. Raya Industri Komersial No. 88, Jabodetabek, Indonesia'; ?>
                                        </p>
                                        <p class="info2">
                                            Phone: <?= !empty($domain->telepon) ? $domain->telepon : (!empty($this->domain->telepon) ? $this->domain->telepon : '+62 812-3456-7890'); ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Column 2: Dynamic Articles & Blog / Popular Posts -->
                    <div class="col-xl-4 col-lg-4 col-md-5 col-sm-7">
                        <div class="single-footer-caption mb-50">
                            <div class="footer-tittle">
                                <h4 style="color: #ffffff; border-left: 3px solid <?= $primary_color; ?>; padding-left: 10px;">Artikel & Berita</h4>
                            </div>
                            <?php
                            $domain_id = isset($this->domain->id) ? $this->domain->id : (!empty($domain->id) ? $domain->id : null);
                            if ($domain_id && isset($this->Menu_model)) {
                                $artikel = $this->Menu_model->fetch_data_pages_by_limit_order('table_pages', ['id_domain' => $domain_id, 'category' => '2'], 3)->result();
                            } else {
                                $artikel = [];
                            }
                            ?>
                            <?php if (!empty($artikel)) : ?>
                                <?php foreach ($artikel as $row) : ?>
                                    <div class="whats-right-single mb-20">
                                        <div class="whats-right-cap">
                                            <h4><a href="<?= base_url('/') . $row->slug; ?>" style="color: #cbd5e1;"><?= $row->title; ?></a></h4>
                                            <p><?= isset($row->created_at) ? date('d M Y', strtotime($row->created_at)) : 'Update Terbaru'; ?></p>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <div class="whats-right-single mb-20">
                                    <div class="whats-right-cap">
                                        <h4><a href="#jasa-gas" style="color: #cbd5e1;">Panduan Standar Pipa Gas Komersial</a></h4>
                                        <p>Teknis & K3</p>
                                    </div>
                                </div>
                                <div class="whats-right-single mb-20">
                                    <div class="whats-right-cap">
                                        <h4><a href="#jasa-exhaust" style="color: #cbd5e1;">Perhitungan Kapasitas Blower Exhaust</a></h4>
                                        <p>Ventilasi Dapur</p>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Column 3: Dynamic Navigasi Menu & Office Info -->
                    <div class="col-xl-3 col-lg-3 col-md-5 col-sm-7">
                        <div class="single-footer-caption mb-50">
                            <div class="footer-tittle">
                                <h4 style="color: #ffffff; border-left: 3px solid <?= $primary_color; ?>; padding-left: 10px;">Navigasi Utama</h4>
                            </div>
                            <ul class="space-y-2" style="list-style: none; padding: 0;">
                                <?php if (!empty($menus)) : ?>
                                    <?php foreach ($menus as $menu) : ?>
                                        <li style="margin-bottom: 8px;">
                                            <a href="<?= base_url('') . (is_array($menu) ? $menu['slug'] : $menu->slug); ?>" style="color: #cbd5e1; text-decoration: none;" class="hover:text-white transition">
                                                <i class="fa-solid fa-angle-right text-xs mr-2" style="color: <?= $primary_color; ?>;"></i>
                                                <?= is_array($menu) ? $menu['nama_menu'] : $menu->nama_menu; ?>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <li style="margin-bottom: 8px;"><a href="#beranda" style="color: #cbd5e1;">Beranda</a></li>
                                    <li style="margin-bottom: 8px;"><a href="#tentang" style="color: #cbd5e1;">Tentang Kami</a></li>
                                    <li style="margin-bottom: 8px;"><a href="#layanan" style="color: #cbd5e1;">Layanan & Jasa</a></li>
                                    <li style="margin-bottom: 8px;"><a href="#produk" style="color: #cbd5e1;">Fabrikasi Stainless</a></li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- footer-bottom area -->
        <div class="footer-bottom-area footer-bg" style="border-top: 1px solid #1e293b; padding: 20px 0;">
            <div class="container">
                <div class="footer-border">
                    <div class="row d-flex align-items-center">
                        <div class="col-xl-12">
                            <div class="footer-copy-right text-center">
                                <p style="color: #64748b; font-size: 13px;">
                                    Copyright &copy;<script>
                                        document.write(new Date().getFullYear());
                                    </script>
                                    <?= !empty($domain->title) ? $domain->title : (!empty($domain->meta_title) ? $domain->meta_title : 'PT Solusi Dapur Restoran'); ?>.
                                    All rights reserved | Powered by
                                    <a href="<?= base_url(); ?>" style="color: #94a3b8;" target="_blank"><?= !empty($domain->domain_name) ? $domain->domain_name : 'solusidapurrestoran.com'; ?></a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End-->
</footer>

<!-- Search model Begin -->
<div class="search-model-box">
    <div class="d-flex align-items-center h-100 justify-content-center">
        <div class="search-close-btn">+</div>
        <form class="search-model-form">
            <input type="text" id="search-input" placeholder="Searching key.....">
        </form>
    </div>
</div>
<!-- Search model end -->

<!-- JS here -->
<script src="<?= base_url('assets/news'); ?>/assets/js/vendor/modernizr-3.5.0.min.js"></script>
<!-- Jquery, Popper, Bootstrap -->
<script src="<?= base_url('assets/news'); ?>/assets/js/vendor/jquery-1.12.4.min.js"></script>
<script src="<?= base_url('assets/news'); ?>/assets/js/popper.min.js"></script>
<script src="<?= base_url('assets/news'); ?>/assets/js/bootstrap.min.js"></script>
<!-- Jquery Mobile Menu -->
<script src="<?= base_url('assets/news'); ?>/assets/js/jquery.slicknav.min.js"></script>

<!-- Jquery Slick , Owl-Carousel Plugins -->
<script src="<?= base_url('assets/news'); ?>/assets/js/owl.carousel.min.js"></script>
<script src="<?= base_url('assets/news'); ?>/assets/js/slick.min.js"></script>
<!-- Date Picker -->
<script src="<?= base_url('assets/news'); ?>/assets/js/gijgo.min.js"></script>
<!-- One Page, Animated-HeadLin -->
<script src="<?= base_url('assets/news'); ?>/assets/js/wow.min.js"></script>
<script src="<?= base_url('assets/news'); ?>/assets/js/animated.headline.js"></script>
<script src="<?= base_url('assets/news'); ?>/assets/js/jquery.magnific-popup.js"></script>

<!-- Scrollup, nice-select, sticky -->
<script src="<?= base_url('assets/news'); ?>/assets/js/jquery.scrollUp.min.js"></script>
<script src="<?= base_url('assets/news'); ?>/assets/js/jquery.nice-select.min.js"></script>
<script src="<?= base_url('assets/news'); ?>/assets/js/jquery.sticky.js"></script>

<!-- contact js -->
<script src="<?= base_url('assets/news'); ?>/assets/js/contact.js"></script>
<script src="<?= base_url('assets/news'); ?>/assets/js/jquery.form.js"></script>
<script src="<?= base_url('assets/news'); ?>/assets/js/jquery.validate.min.js"></script>
<script src="<?= base_url('assets/news'); ?>/assets/js/mail-script.js"></script>
<script src="<?= base_url('assets/news'); ?>/assets/js/jquery.ajaxchimp.min.js"></script>

<!-- Jquery Plugins, main Jquery -->
<script src="<?= base_url('assets/news'); ?>/assets/js/plugins.js"></script>
<script src="<?= base_url('assets/news'); ?>/assets/js/main.js"></script>

<style>
    .bg-primary {
        background-color: <?= $primary_color; ?> !important;
    }

    .text-primary {
        color: <?= $primary_color; ?> !important;
    }

    .border-primary {
        border-color: <?= $primary_color; ?> !important;
    }
</style>

</body>

</html>