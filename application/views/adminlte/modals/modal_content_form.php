<div class="modal-header bg-primary">
    <h5 class="modal-title text-white font-weight-bold">
        <i class="fas fa-edit mr-1"></i> <?= empty($row) ? 'Tambah Section Baru' : 'Edit Section: ' . $row->section; ?>
    </h5>
    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<form id="formContentSection" enctype="multipart/form-data">
    <div class="modal-body p-4">
        <input type="hidden" name="id" value="<?= $row->id ?? ''; ?>">
        <input type="hidden" name="id_domain" value="<?= $domain['id']; ?>">

        <div class="row">
            <div class="col-md-4 form-group">
                <label>Pilih Halaman (Page Slug) <span class="text-danger">*</span></label>
                <select name="page_slug" class="form-control select2" required>
                    <?php foreach ($pages as $p): ?>
                        <option value="<?= $p->slug; ?>" <?= (!empty($row) && $row->page_slug == $p->slug) ? 'selected' : ''; ?>>
                            <?= $p->slug; ?> (<?= $p->title ?? $p->slug; ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-4 form-group">
                <label>Tipe Section <span class="text-danger">*</span></label>
                <select name="section" class="form-control" required>
                    <?php foreach ($sections as $sec): ?>
                        <option value="<?= $sec->section; ?>" <?= (!empty($row) && $row->section == $sec->section) ? 'selected' : ''; ?>>
                            <?= $sec->section; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-4 form-group">
                <label>DOM ID Anchor (#)</label>
                <input type="text" name="section_id_dom" class="form-control" placeholder="Contoh: beranda, layanan, kontak" value="<?= $row->section_id_dom ?? ''; ?>">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 form-group">
                <label>Judul Utama (Title)</label>
                <input type="text" name="title" class="form-control" placeholder="Headline section..." value="<?= htmlspecialchars($row->title ?? ''); ?>">
            </div>

            <div class="col-md-6 form-group">
                <label>Sub-Judul / Badge (Subtitle)</label>
                <input type="text" name="subtitle" class="form-control" placeholder="Sub-headline / slogan..." value="<?= htmlspecialchars($row->subtitle ?? ''); ?>">
            </div>
        </div>

        <div class="form-group">
            <label>Konten Paragraf / Deskripsi</label>
            <textarea name="content" rows="3" class="form-control" placeholder="Deskripsi isi section..."><?= $row->content ?? ''; ?></textarea>
        </div>

        <div class="row">
            <div class="col-md-6 form-group">
                <label>Gambar / Media</label>
                <input type="file" name="image" class="form-control-file">
                <?php if (!empty($row->image)): ?>
                    <small class="form-text text-muted">File saat ini: <?= $row->image; ?></small>
                <?php endif; ?>
            </div>

            <div class="col-md-3 form-group">
                <label>Urutan Tampil (Sort Order)</label>
                <input type="number" name="urutan" class="form-control" value="<?= $row->urutan ?? 1; ?>" min="1">
            </div>

            <div class="col-md-3 form-group">
                <label>Status Aktif</label>
                <select name="is_active" class="form-control">
                    <option value="1" <?= (!empty($row) && $row->is_active == 1) ? 'selected' : ''; ?>>Aktif (Tampil)</option>
                    <option value="0" <?= (!empty($row) && $row->is_active == 0) ? 'selected' : ''; ?>>Nonaktif (Draft)</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 form-group">
                <label>Label Tombol CTA (Optional)</label>
                <input type="text" name="btn_text" class="form-control" placeholder="Contoh: Hubungi Kami" value="<?= $row->btn_text ?? ''; ?>">
            </div>
            <div class="col-md-6 form-group">
                <label>URL Tombol CTA (Optional)</label>
                <input type="text" name="btn_url" class="form-control" placeholder="Contoh: https://wa.me/... atau #kontak" value="<?= $row->btn_url ?? ''; ?>">
            </div>
        </div>

        <div class="form-group">
            <label>Data Payload (JSON Array / Repeater Items)</label>
            <textarea name="data_payload" rows="4" class="form-control font-monospace" placeholder='[{"name": "Item 1", "icon": "fa-check"}]'><?= $row->data_payload ?? ''; ?></textarea>
            <small class="form-text text-muted">Gunakan format JSON valid untuk menampung item list, cards, testimonial, atau counters.</small>
        </div>
    </div>

    <div class="modal-footer bg-light">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary font-weight-bold" id="btnSaveSubmit">
            <i class="fas fa-save mr-1"></i> Simpan Section
        </button>
    </div>
</form>