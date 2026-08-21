<div class="container py-5">

    <h1><?= $detail['nama_layanan']; ?></h1>

    <img src="<?= base_url('uploads/layanan/' . $detail['gambar']); ?>"
        class="img-fluid mb-4">

    <div>
        <?= $detail['deskripsi']; ?>
    </div>

</div>