<div class="modal-header bg-danger text-white">
    <h5 class="modal-title font-weight-bold"><i class="fas fa-exclamation-triangle mr-1"></i> Konfirmasi Hapus</h5>
    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
</div>
<div class="modal-body text-center p-4">
    <p class="mb-1">Apakah Anda yakin ingin menghapus section ini?</p>
    <h5 class="font-weight-bold text-navy">[<?= $row->section; ?>] <?= $row->title ?: 'Tanpa Judul'; ?></h5>
    <small class="text-muted">Halaman: <?= $row->page_slug; ?> | Urutan: <?= $row->urutan; ?></small>
</div>
<div class="modal-footer bg-light justify-content-center">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
    <button type="button" class="btn btn-danger font-weight-bold" id="btnConfirmDelete" data-id="<?= $row->id; ?>">
        <i class="fas fa-trash mr-1"></i> Ya, Hapus Sekarang
    </button>
</div>