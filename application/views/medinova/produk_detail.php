<div class="container py-5">

    <h1><?= $detail['nama_produk']; ?></h1>

    <img src="<?= base_url('uploads/produk/' . $detail['gambar']); ?>"
        class="img-fluid mb-4">

    <h3>Harga: Rp <?= number_format($detail['harga']); ?></h3>

    <div>
        <?= $detail['deskripsi']; ?>
    </div>

</div>