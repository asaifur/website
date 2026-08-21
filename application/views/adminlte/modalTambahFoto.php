<div class="modal-header bg-primary">
    <h5 class="modal-title">
        <i class="fas fa-image"></i> Tambah Media
    </h5>
    <button type="button" class="close" data-dismiss="modal">
        <span>&times;</span>
    </button>
</div>

<form id="formTambahFoto" enctype="multipart/form-data">

    <div class="modal-body">

        <div class="form-group">
            <label>Upload Gambar</label>
            <input type="file"
                name="file"
                class="form-control"
                accept="image/*"
                required>
        </div>

        <div class="form-group">
            <label>Alt Text</label>
            <input type="text"
                name="alt_text"
                class="form-control"
                placeholder="Deskripsi gambar untuk SEO">
        </div>

        <div class="form-group">
            <label>Kategori</label>
            <select name="media_category"
                class="form-control">
                <option value="hero">Hero</option>
                <option value="galeri">Galeri</option>
                <option value="blog">Blog</option>
            </select>
        </div>

    </div>

    <div class="modal-footer">
        <button type="button"
            class="btn btn-secondary"
            data-dismiss="modal">
            Batal
        </button>

        <button type="submit"
            class="btn btn-primary">
            Simpan
        </button>
    </div>

</form>

</div>