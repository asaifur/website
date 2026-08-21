<div class="container py-5">

    <h1><?= $detail['judul']; ?></h1>

    <img src="<?= base_url('uploads/blog/' . $detail['gambar']); ?>"
        class="img-fluid mb-4">

    <div>
        <?= $detail['content']; ?>
    </div>

</div>