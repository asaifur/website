<footer class="ve-footer">
    <div class="container">
        <div class="row">

            <!-- Col 1: Brand -->
            <div class="col-12 col-sm-6 col-lg-4 mb-50">
                <div class="ve-footer-brand">
                    <a href="<?= base_url(); ?>" class="ve-footer-logo">
                        <span class="ve-logo-text"><?= $domain->title; ?></strong></span>
                    </a>
                    <p>
                        <?= $domain->meta_description; ?>
                    </p>
                    <div class="ve-social">
                        <?= $domain->iframe; ?>
                    </div>
                </div>
            </div>

            <!-- Col 2: Navigasi -->
            <div class="col-12 col-sm-6 col-lg-2 mb-50">
                <h5 class="ve-footer-title">Navigasi</h5>
                <ul class="ve-footer-links">
                    <?php $menu_nav =  $this->Menu_model->getMenuTree($this->domain->id);
                    ?>
                    <?php foreach ($menu_nav as $kolom): ?>
                        <li> <i class="fa fa-chevron-right"></i><a href="<?= base_url('/') .  $kolom['slug']; ?>"><?= $kolom['nama_menu'] ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Col 3: Layanan -->
            <div class="col-12 col-sm-6 col-lg-3 mb-50">
                <h5 class="ve-footer-title">Artikel Lainnya</h5>
                <ul class="ve-footer-links">
                    <?php
                    $where_note = ['id_domain' => $domain->id, 'category' => '2'];
                    $menu_nav = $this->Menu_model->fetch_data_pages_by_limit_order('table_pages', $where_note)->result();
                    ?>
                    <?php foreach ($menu_nav as $kolom): ?>
                        <li class="text-capitalize"><a href="<?= base_url('/' . $kolom->slug); ?>"><?= $kolom->title ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Col 4: Kontak -->
            <div class="col-12 col-sm-6 col-lg-3 mb-50">
                <h5 class="ve-footer-title">Hubungi Kami</h5>
                <ul class="ve-footer-contact">
                    <li><i class="fa fa-map-marker"></i> Alamat <?= $domain->alamat; ?></li>
                    <li><i class="fa fa-phone"></i> <?= $domain->telepon; ?></li>
                    <li><i class="fa fa-envelope"></i> <?= $domain->email ?></li>
                </ul>
            </div>

        </div>
    </div>

    <!-- Footer Bottom Bar -->
    <div class="ve-footer-bottom">
        <div class="container">
            <div class="ve-footer-bottom-inner">
                <p>
                    &copy; <script>
                        document.write(new Date().getFullYear());
                    </script>
                    <?= $domain->meta_title ?>. All Rights Reserved.
                </p>
            </div>
        </div>
    </div>
</footer>
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

    /* tombol utama */
    .float-btn {
        display: flex;
        align-items: center;
        background: white;
        border-radius: 50px;
        padding: 5px 12px 5px 5px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);

        text-decoration: none;
        transition: all .3s ease;
        animation: bounce 2s infinite;
    }

    /* icon */
    .float-btn img {
        width: 50px;
        height: auto;
    }

    /* label */
    .float-btn .label {
        margin-left: 8px;
        font-size: 14px;
        font-weight: 600;
        color: #333;
    }

    /* hover */
    .float-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
    }

    /* bounce animation */
    @keyframes bounce {

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

    /* responsive */
    @media(max-width:768px) {

        .float-btn img {
            width: 45px;
        }

        .float-btn .label {
            display: none;
        }

    }
</style>

<div class="floating-contact">

    <!-- WhatsApp -->
    <a href="<?= $domain->wa_link; ?>"
        target="_blank"
        class="float-btn wa">

        <img src="<?= base_url('assets/uploads/img/') ?>fd14d9811e056a03b44e7c3e043b2476.png">

    </a>

    <!-- Call -->
    <a href="tel:<?= $domain->telepon; ?>"
        class="float-btn call">

        <img src="<?= base_url('assets/uploads/img/') ?>b06f39c95463db9183a5d3fa912777ee.png">

    </a>

</div>
<script src="<?= base_url('assets/vaul/'); ?>js/bootstrap/popper.min.js"></script>
<script src="<?= base_url('assets/vaul/'); ?>js/bootstrap/bootstrap.min.js"></script>
<script src="<?= base_url('assets/vaul/'); ?>js/plugins/plugins.js"></script>
<script src="<?= base_url('assets/vaul/'); ?>js/active.js"></script>
<script src="<?= base_url('assets/vaul/'); ?>js/vaultedge.js"></script>
<!-- jQuery -->
<!-- Owl Carousel JS -->
<script src="<?= base_url('assets/'); ?>assets/owlcarousel/owl.carousel.min.js"></script>

<script src="<?= base_url('assets/'); ?>assets/vendors/highlight.js"></script>
<script src="<?= base_url('assets/'); ?>assets/js/app.js"></script>
<script>
    $(document).ready(function() {


        $('.owl-carousel').owlCarousel({
            items: 1,
            loop: true,
            margin: 0,
            nav: false,
            dots: true,
            autoplay: true,
            autoplayTimeout: 4000, // 4 detik
            autoplayHoverPause: true,
            smartSpeed: 800,
            animateOut: 'fadeOut',
            animateIn: 'fadeIn',
            responsive: {
                0: {
                    items: 1
                },
                768: {
                    items: 1
                },
                1000: {
                    items: 1
                }
            }
        });

    });
</script>
</body>

</html>