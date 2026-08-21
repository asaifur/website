<style>
    /* Overlay hitam */
    .hero-overlay::before {
        content: "";
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0.7);
        /* Ubah 0.7 sesuai tingkat gelap */
        z-index: 1;
    }

    /* Pastikan isi tetap di atas overlay */
    .hero-overlay>* {
        position: relative;
        z-index: 2;
    }
</style>
<!-- Hero Start -->

<?php if (isset($page)) : ?>
    <h1><?= $page->nama_halaman ?></h1>
    <?= $page->content ?>
<?php endif; ?>
</div>