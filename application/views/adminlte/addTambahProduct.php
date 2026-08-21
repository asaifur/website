<div class="modal-header">
    <h4 class="modal-title"><?= $action == 'insert' ? 'Tambah' : 'Edit' ?> Produk</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<form id="formProduct" enctype="multipart/form-data">
    <div class="modal-body">
        <!-- Hidden Fields -->
        <?php foreach ($format as $kolom):
            if ($kolom->type == "HIDDEN"):
                $val = $kolom->code;
                $value = ($action != 'insert' && isset($dtKolom->$val)) ? $dtKolom->$val : '';
        ?>
                <input type="hidden" id="<?= $kolom->code ?>" name="<?= $kolom->code ?>" value="<?= $value ?>">
        <?php
            endif;
        endforeach; ?>

        <div class="row">
            <!-- 🔹 KOLOM KIRI: Informasi Utama -->
            <div class="col-md-8">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Informasi Produk</h3>
                    </div>
                    <div class="card-body">
                        <?php foreach ($format as $kolom):
                            $val = $kolom->code;
                            $value = '';
                            if ($action != 'insert' && isset($dtKolom->$val)) {
                                $value = $dtKolom->$val;
                            }
                        ?>

                            <!-- TEXT / TEXTAREA -->
                            <?php if (in_array($kolom->type, ['RST', 'TEXTAREA'])): ?>
                                <div class="<?= $kolom->lebar ?? 'col-md-12' ?> mb-3">
                                    <label><?= $kolom->name ?> <?= $kolom->required ? '<span class="text-danger">*</span>' : '' ?></label>
                                    <?php if ($kolom->type == 'TEXTAREA'): ?>
                                        <textarea class="form-control" name="<?= $kolom->code ?>" id="<?= $kolom->code ?>"
                                            placeholder="<?= $kolom->placeholder ?? '' ?>" rows="3"><?= htmlspecialchars($value) ?></textarea>
                                    <?php else: ?>
                                        <input type="text" class="form-control" name="<?= $kolom->code ?>" id="<?= $kolom->code ?>"
                                            placeholder="<?= $kolom->placeholder ?? '' ?>" value="<?= htmlspecialchars($value) ?>">
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>

                            <!-- SELECT CATEGORY -->
                            <?php if ($kolom->type == "SELECT_CATEGORY"): ?>
                                <div class="<?= $kolom->lebar ?? 'col-md-12' ?> mb-3">
                                    <label><?= $kolom->name ?> <?= $kolom->required ? '<span class="text-danger">*</span>' : '' ?></label>
                                    <select class="form-control select2" name="<?= $kolom->code ?>" id="<?= $kolom->code ?>">
                                        <option value="">-- Pilih Kategori --</option>
                                        <?php foreach ($select_category ?? [] as $row): ?>
                                            <option value="<?= $row->id ?>" <?= ($value == $row->id) ? 'selected' : '' ?>>
                                                <?= $row->name ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            <?php endif; ?>

                            <!-- SELECT BRAND -->
                            <?php if ($kolom->type == "SELECT_BRAND"): ?>
                                <div class="<?= $kolom->lebar ?? 'col-md-12' ?> mb-3">
                                    <label><?= $kolom->name ?></label>
                                    <select class="form-control select2" name="<?= $kolom->code ?>" id="<?= $kolom->code ?>">
                                        <option value="">-- Tanpa Brand --</option>
                                        <?php foreach ($select_brand ?? [] as $row): ?>
                                            <option value="<?= $row->id ?>" <?= ($value == $row->id) ? 'selected' : '' ?>>
                                                <?= $row->name ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            <?php endif; ?>

                            <!-- PRICE & DISCOUNT -->
                            <?php if ($kolom->code == 'price' || $kolom->code == 'discount_price'): ?>
                                <div class="<?= $kolom->lebar ?? 'col-md-6' ?> mb-3">
                                    <label><?= $kolom->name ?> <?= $kolom->required ? '<span class="text-danger">*</span>' : '' ?></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp</span>
                                        </div>
                                        <input type="number" class="form-control" name="<?= $kolom->code ?>" id="<?= $kolom->code ?>"
                                            placeholder="0" min="0" step="0.01" value="<?= $value ?>">
                                    </div>
                                </div>
                            <?php endif; ?>

                            <!-- STOCK & WEIGHT -->
                            <?php if (in_array($kolom->code, ['stock_quantity', 'weight_kg'])): ?>
                                <div class="<?= $kolom->lebar ?? 'col-md-6' ?> mb-3">
                                    <label><?= $kolom->name ?></label>
                                    <input type="number" class="form-control" name="<?= $kolom->code ?>" id="<?= $kolom->code ?>"
                                        placeholder="0" min="0" step="<?= $kolom->code == 'weight_kg' ? '0.001' : '1' ?>" value="<?= $value ?>">
                                </div>
                            <?php endif; ?>

                            <!-- STATUS ENUM -->
                            <?php if ($kolom->code == 'status'): ?>
                                <div class="<?= $kolom->lebar ?? 'col-md-6' ?> mb-3">
                                    <label><?= $kolom->name ?></label>
                                    <select class="form-control" name="<?= $kolom->code ?>" id="<?= $kolom->code ?>">
                                        <?php $statuses = ['draft' => 'Draft', 'active' => 'Active', 'out_of_stock' => 'Out of Stock', 'archived' => 'Archived']; ?>
                                        <?php foreach ($statuses as $k => $v): ?>
                                            <option value="<?= $k ?>" <?= ($value == $k) ? 'selected' : '' ?>><?= $v ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            <?php endif; ?>

                            <!-- IS FEATURED -->
                            <?php if ($kolom->code == 'is_featured'): ?>
                                <div class="<?= $kolom->lebar ?? 'col-md-6' ?> mb-3">
                                    <label><?= $kolom->name ?></label>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="<?= $kolom->code ?>" id="<?= $kolom->code ?>"
                                            value="1" <?= ($value == 1) ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="<?= $kolom->code ?>">Tampilkan di halaman utama</label>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <!-- JSON FIELDS: Dimensions & Attributes -->
                            <?php if (in_array($kolom->code, ['dimensions', 'attributes'])): ?>
                                <div class="<?= $kolom->lebar ?? 'col-md-12' ?> mb-3">
                                    <label><?= $kolom->name ?> <small class="text-muted">(Format JSON)</small></label>
                                    <textarea class="form-control font-monospace" name="<?= $kolom->code ?>" id="<?= $kolom->code ?>"
                                        rows="4" placeholder='{"key": "value"}'><?= htmlspecialchars($value) ?></textarea>
                                    <small class="text-muted">
                                        Contoh dimensions: <code>{"length":30,"width":20,"height":5,"unit":"cm"}</code><br>
                                        Contoh attributes: <code>{"material":"Cotton","warranty":"1 tahun"}</code>
                                    </small>
                                </div>
                            <?php endif; ?>

                            <!-- SEO FIELDS -->
                            <?php if (in_array($kolom->code, ['seo_title', 'seo_description'])): ?>
                                <div class="<?= $kolom->lebar ?? 'col-md-12' ?> mb-3">
                                    <label><?= $kolom->name ?></label>
                                    <input type="text" class="form-control" name="<?= $kolom->code ?>" id="<?= $kolom->code ?>"
                                        placeholder="<?= $kolom->placeholder ?? '' ?>" value="<?= htmlspecialchars($value) ?>" maxlength="<?= $kolom->code == 'seo_title' ? 200 : 500 ?>">
                                </div>
                            <?php endif; ?>

                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- 🔹 KOLOM KANAN: Gambar & SKU -->
            <div class="col-md-4">
                <!-- SKU & SLUG -->
                <div class="card card-secondary mb-3">
                    <div class="card-header">
                        <h3 class="card-title">Identitas</h3>
                    </div>
                    <div class="card-body">
                        <?php foreach ($format as $kolom):
                            if (in_array($kolom->code, ['sku', 'slug'])):
                                $val = $kolom->code;
                                $value = ($action != 'insert' && isset($dtKolom->$val)) ? $dtKolom->$val : '';
                        ?>
                                <div class="form-group">
                                    <label><?= $kolom->name ?></label>
                                    <input type="text" class="form-control" name="<?= $kolom->code ?>" id="<?= $kolom->code ?>"
                                        value="<?= htmlspecialchars($value) ?>" placeholder="<?= $kolom->placeholder ?? '' ?>">
                                </div>
                        <?php endif;
                        endforeach; ?>

                        <!-- Auto Generate Slug from Name -->
                        <div class="form-group">
                            <label><small>Auto-slug dari nama produk</small></label>
                            <button type="button" class="btn btn-xs btn-outline-secondary" id="btnGenerateSlug">
                                <i class="fas fa-magic"></i> Generate Slug
                            </button>
                        </div>
                    </div>
                </div>

                <!-- PRODUCT IMAGES -->
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Gambar Produk</h3>
                    </div>
                    <div class="card-body">
                        <!-- Preview Existing Images -->
                        <?php if (!empty($product_images)): ?>
                            <div class="mb-3">
                                <label class="d-block mb-2">Gambar Saat Ini:</label>
                                <?php foreach ($product_images as $img): ?>
                                    <div class="d-inline-block position-relative mr-2 mb-2">
                                        <img src="<?= base_url('assets/uploads/products/' . $img->image_url) ?>"
                                            class="img-thumbnail" style="width:80px;height:80px;object-fit:cover;">
                                        <button type="button" class="btn btn-sm btn-danger remove-image position-absolute"
                                            style="top:-5px;right:-5px;border-radius:50%;width:20px;height:20px;padding:0;line-height:1;"
                                            data-id="<?= $img->id ?>" title="Hapus gambar">&times;</button>
                                        <input type="hidden" name="existing_images[]" value="<?= $img->image_url ?>">
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                        <!-- Upload New Images -->
                        <div class="form-group">
                            <label>Tambah Gambar Baru</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="product_images[]" id="productImages"
                                    accept="image/*" multiple>
                                <label class="custom-file-label" for="productImages">Pilih file...</label>
                            </div>
                            <small class="text-muted">Bisa pilih multiple file. Maksimal 5 gambar.</small>
                        </div>

                        <!-- Image Preview Container -->
                        <div id="imagePreview" class="d-flex flex-wrap mt-2"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i> Simpan Produk
        </button>
    </div>
</form>

<!-- CSS Tambahan -->
<style>
    .font-monospace {
        font-family: monospace;
        font-size: 0.9em;
    }

    #imagePreview img {
        width: 60px;
        height: 60px;
        object-fit: cover;
        margin: 2px;
        border-radius: 4px;
        border: 1px solid #ddd;
    }
</style>

<script>
    $(document).ready(function() {
        // 🔹 Init Select2
        if ($.fn.select2) {
            $('.select2').select2({
                width: '100%',
                placeholder: 'Pilih...',
                allowClear: true
            });
        }

        // 🔹 Format Harga Rupiah (opsional, untuk UX)
        $('#price, #discount_price').on('keyup', function() {
            let val = $(this).val().replace(/[^0-9.]/g, '');
            if (val) $(this).val(parseFloat(val).toFixed(2));
        });

        // 🔹 Preview Image Upload
        $('#productImages').on('change', function() {
            const files = this.files;
            const preview = $('#imagePreview');
            preview.empty();

            for (let i = 0; i < files.length; i++) {
                if (files[i].type.match('image.*')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.append(`<img src="${e.target.result}" title="${files[i].name}">`);
                    }
                    reader.readAsDataURL(files[i]);
                }
            }
            // Update label
            let names = Array.from(files).map(f => f.name).join(', ');
            $(this).next('.custom-file-label').html(names || 'Pilih file...');
        });

        // 🔹 Generate Slug from Name
        $('#btnGenerateSlug').on('click', function() {
            let name = $('#name').val().trim();
            if (name) {
                let slug = name.toLowerCase()
                    .replace(/[^a-z0-9\s-]/g, '')
                    .replace(/[\s-]+/g, '-')
                    .replace(/^-+|-+$/g, '');
                $('#slug').val(slug);
            }
        });

        // 🔹 Hapus Existing Image
        $(document).on('click', '.remove-image', function() {
            if (confirm('Hapus gambar ini?')) {
                let id = $(this).data('id');
                $(this).closest('div').remove();
                // Tandai untuk dihapus di backend (opsional)
                $('<input>').attr({
                    type: 'hidden',
                    name: 'remove_images[]',
                    value: id
                }).appendTo('#formProduct');
            }
        });

        // 🔹 Submit Form dengan AJAX + FormData
        $('#formProduct').on('submit', function(e) {
            e.preventDefault();

            let formData = new FormData(this);
            let action = "<?= $action ?>";
            let productId = "<?= ($action != 'insert' && isset($dtKolom->id)) ? $dtKolom->id : '' ?>";

            // Validasi sederhana
            if (!$('#name').val().trim()) {
                Swal.fire('Error', 'Nama produk wajib diisi', 'error');
                return;
            }

            $.ajax({
                url: "<?= base_url('Dashboard/save_product/') ?>" + action + (productId ? '/' + productId : ''),
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                dataType: "json",
                beforeSend: function() {
                    Swal.fire({
                        title: 'Menyimpan...',
                        text: 'Mohon tunggu',
                        allowOutsideClick: false,
                        didOpen: () => Swal.showLoading()
                    });
                },
                success: function(res) {
                    if (res.status === 'success') {
                        Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: res.message,
                                timer: 1500,
                                showConfirmButton: false
                            })
                            .then(() => {
                                $('#modalProduct').modal('hide');
                                $('#tableProduct').DataTable().ajax.reload();
                            });
                    } else {
                        Swal.fire('Gagal', res.message || 'Terjadi kesalahan', 'error');
                    }
                },
                error: function(xhr, status, err) {
                    console.error(xhr.responseText);
                    Swal.fire('Error', 'Terjadi kesalahan server: ' + err, 'error');
                }
            });
        });
    });
</script>