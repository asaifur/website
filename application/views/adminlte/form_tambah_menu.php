<div class="modal-content">

    <div class="modal-header bg-success">
        <h5 class="modal-title" style="text-transform: capitalize;">
            <i class="fas fa-plus"></i> <?= $action ?> Menu Navigasi
        </h5>
        <button type="button" class="close" data-dismiss="modal">
            <span>&times;</span>
        </button>
    </div>

    <form id="formTambahMenu">

        <div class="modal-body">
            <?php foreach ($format as $kolom) : ?>
                <?php $kolomCode = $kolom->code;
                if ($action <> "insert") {
                    $dt = $dtKolom->$kolomCode;
                }
                ?>
                <?php if ($kolom->type == "RST") :
                ?>
                    <div class="form-group">
                        <label><?= $kolom->name; ?></label>
                        <input type="text" name="<?= $kolom->code ?>" class="form-control" id="<?= $kolom->code ?>" <?= ($kolom->r == 1) ? "required" : "" ?> value="<?= ($action <> "insert") ? $dt : "" ?>">
                    </div>
                <?php endif; ?>

                <?php if ($kolom->type == "PARENT"): ?>
                    <div class="form-group">
                        <label><?= $kolom->name ?></label>

                        <select name="<?= $kolom->code ?>"
                            id="<?= $kolom->code ?>"
                            class="form-control"
                            <?= ($kolom->r == 1) ? "required" : "" ?>>
                            <option value="0"
                                <?= ($action != "insert" && $dt == "0") ? "selected" : "" ?>>
                                No
                            </option>
                            <?php foreach ($parent as $row): ?>

                                <?php
                                $selected = '';
                                if ($action != "insert") {
                                    $selected = ($dt == $row->id) ? 'selected' : '';
                                }
                                ?>

                                <option value="<?= $row->id ?>" <?= $selected ?>>
                                    <?= $row->nama_menu ?>
                                </option>

                            <?php endforeach; ?>

                        </select>
                    </div>
                <?php endif; ?>
                <?php if ($kolom->type == "SELECT_SLUG"): ?>
                    <div class="form-group">
                        <label><?= $kolom->name ?></label>

                        <select name="<?= $kolom->code ?>"
                            id="<?= $kolom->code ?>"
                            class="form-control"
                            <?= ($kolom->r == 1) ? "required" : "" ?>>
                            <option value="0" <?php
                                                $selected = '';
                                                if ($action != "insert") {
                                                    $selected = ($dt == '0') ? 'selected' : '';
                                                }
                                                ?>> 0 </option>
                            <?php foreach ($pages as $row): ?>

                                <?php
                                $selected = '';
                                if ($action != "insert") {
                                    $selected = ($dt == $row->slug) ? 'selected' : '';
                                }
                                ?>

                                <option value="<?= $row->slug ?>" <?= $selected ?>>
                                    <?= $row->slug ?>
                                </option>

                            <?php endforeach; ?>

                        </select>
                    </div>
                <?php endif; ?>
                <?php if ($kolom->type == "SELECT_ACTIVE"): ?>
                    <div class="form-group">
                        <label><?= $kolom->name ?></label>

                        <select name="<?= $kolom->code ?>"
                            id="<?= $kolom->code ?>"
                            class="form-control"
                            <?= ($kolom->r == 1) ? "required" : "" ?>>

                            <option value="0"
                                <?= ($action != "insert" && $dt == "0") ? "selected" : "" ?>>
                                No
                            </option>

                            <option value="1"
                                <?= ($action != "insert" && $dt == "1") ? "selected" : "" ?>>
                                Yes
                            </option>

                        </select>
                    </div>
                <?php endif; ?>
                <?php if ($kolom->type == "SELECT_POSISI"): ?>
                    <div class="form-group">
                        <label><?= $kolom->name ?></label>

                        <select name="<?= $kolom->code ?>"
                            id="<?= $kolom->code ?>"
                            class="form-control"
                            <?= ($kolom->r == 1) ? "required" : "" ?>>
                            <?php
                            $table_posisi = $this->Menu_model->fetch_data('table_posisi_navigasi')->result();
                            foreach ($table_posisi as $row): ?>
                                <option value="<?= $row->name ?>"><?= $row->name ?></option>
                            <?php endforeach; ?>


                        </select>
                    </div>
                <?php endif; ?>
                <?php if ($kolom->type == "URUTAN"): ?>
                    <div class="form-group">
                        <label><?= $kolom->name ?></label>
                        <input type="number" name="<?= $kolom->code ?>" class="form-control" id="<?= $kolom->code ?>" <?= ($kolom->r == 1) ? "required" : "" ?> value="<?= ($action <> "insert") ? $dt : "" ?>">

                    </div>
                <?php endif; ?>
                <?php if ($kolom->type == "HIDDEN"): ?>
                    <input type="hidden" name="<?= $kolom->code ?>" class="form-control" id="<?= $kolom->code ?>" <?= ($kolom->r == 1) ? "required" : "" ?> value="<?= ($action <> "insert") ? $dt : "" ?>">
                <?php endif; ?>
            <?php endforeach; ?>

        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                Batal
            </button>
            <button type="submit" class="btn btn-success">
                <i class="fas fa-save"></i> <?= $action ?>
            </button>
        </div>

    </form>

</div>
<script>
    $(document).on('submit', '#formTambahMenu', function(e) {
        e.preventDefault();
        let action = "<?= $action ?>";
        $.ajax({
            url: "<?= base_url('dashboard/simpan_menu/'); ?>" + action,
            type: "POST",
            data: $(this).serialize(),
            dataType: "json",
            success: function(response) {

                if (response.status == 'success') {

                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.message
                    });

                    $('#modalTambahMenu').modal('hide');

                    location.reload();

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: response.message
                    });
                }

            }
        });

    });
</script>