<!-- START SECTION TOP -->
<section class="section-top" style="background-image: url('<?= base_url('assets/monoline/assets/img/bg/section-top.png'); ?>'); background-size: cover; background-position: center center;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12 col-xs-12 text-center">
                <div class="section-top-title">
                    <h1><?= isset($title) ? $title : '404 Error Page'; ?></h1>
                </div>
            </div><!--- END COL -->
        </div><!--- END ROW -->
    </div><!--- END CONTAINER -->
</section>
<!-- END SECTION TOP -->

<!-- START 404 -->
<section class="zero_area section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12 col-xs-12 text-center">
                <div class="error_page">
                    <img src="<?= base_url('assets/monoline/assets/img/error.png'); ?>" class="img-fluid" alt="404 error" />
                </div>
                <div class="mt-4">
                    <h3>Halaman Tidak Ditemukan</h3>
                    <p>Maaf, halaman yang Anda cari tidak tersedia atau telah dipindahkan.</p>
                    <a href="<?= base_url(); ?>" class="btn btn-primary mt-3">Kembali ke Beranda</a>
                </div>
            </div><!--- END COL -->
        </div><!--- END ROW -->
    </div><!--- END CONTAINER -->
</section>
<!-- END 404 -->