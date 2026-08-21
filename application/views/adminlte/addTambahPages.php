<div class="modal-header">
    <h4 class="modal-title"><?= $action ?> Pages</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<form id="formTambahPages" enctype="multipart/form-data">

    <div class="modal-body">
        <div class="card card-danger">
            <div class="card-header">
                <h3 class="card-title">Input Pages</h3>
            </div>

            <div class="card-body">
                <div class="row">

                    <?php foreach ($format as $kolom):

                        $val = $kolom->code;
                        $value = '';

                        if ($action <> 'insert') {
                            $value = $dtKolom->$val;
                        }

                    ?>
                        <?php if ($kolom->type == "HIDDEN"): ?>
                            <input type="hidden" id="<?= $kolom->code ?>" name="<?= $kolom->code ?>" value="<?= $value ?>">
                        <?php endif; ?>

                        <?php if ($kolom->type == "FILE"): ?>
                            <div class="<?= $kolom->lebar ?> ">
                                <label for="<?= $kolom->code ?>"><?= $kolom->name ?></label>

                                <?php if (!empty($value)): ?>
                                    <div class="mb-2">
                                        <?php
                                        $ext = pathinfo($value, PATHINFO_EXTENSION);
                                        $fileUrl = base_url('assets/uploads/img/' . $value);
                                        ?>

                                        <?php if (in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'webp'])): ?>
                                            <img src="<?= $fileUrl ?>"
                                                class="img-fluid mb-2"
                                                style="max-height:150px; border-radius:8px;">
                                        <?php else: ?>
                                            <a href="<?= $fileUrl ?>" target="_blank" class="btn btn-sm btn-info">
                                                <i class="fas fa-file"></i> Lihat File
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>

                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file"
                                            class="custom-file-input"
                                            id="<?= $kolom->code ?>"
                                            name="<?= $kolom->code ?>">
                                        <label class="custom-file-label"
                                            for="<?= $kolom->code ?>">
                                            <?= !empty($value) ? 'Ganti file...' : 'Choose file' ?>
                                        </label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text">Upload</span>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="old_<?= $kolom->code ?>" value="<?= $value ?>">
                        <?php endif; ?>
                        <?php if ($kolom->type == "RST") : ?>

                            <div class=" <?= $kolom->lebar ?>">
                                <div class="form-group">
                                    <label for="<?= $kolom->code ?>">
                                        <?= $kolom->name ?>
                                    </label>

                                    <input type="text"
                                        class="form-control"
                                        name="<?= $kolom->code ?>"
                                        id="<?= $kolom->code ?>"
                                        placeholder="<?= $kolom->placeholder ?>"
                                        value="<?= $value ?>">
                                </div>
                            </div>

                        <?php endif; ?>
                        <?php if ($kolom->type == "DATE") : ?>
                            <input type="hidden" value="<?php date("Y-m-d H:i:s"); ?>" id="<?= $kolom->code ?>" name="<?= $kolom->code ?>">
                        <?php endif; ?>

                        <?php if ($kolom->type == "SELECT_CATEGORY"): ?>
                            <div class="<?= $kolom->lebar ?>">
                                <div class="form-group">

                                    <label><?= $kolom->name ?></label>

                                    <select class="form-control"
                                        name="<?= $kolom->code ?>"
                                        id="<?= $kolom->code ?>"
                                        <?= ($kolom->required == 1) ? "required" : "" ?>>

                                        <?php foreach ($select_category as $row): ?>

                                            <option value="<?= $row->id ?>"
                                                <?= ($value == $row->id) ? "selected" : "" ?>>

                                                <?= $row->name ?>

                                            </option>

                                        <?php endforeach; ?>

                                    </select>

                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if ($kolom->type == "SELECT_ACTIVE") : ?>

                            <div class="<?= $kolom->lebar ?>">
                                <div class="form-group">

                                    <label><?= $kolom->name ?></label>

                                    <select class="form-control"
                                        name="<?= $kolom->code ?>"
                                        id="<?= $kolom->code ?>"
                                        <?= ($kolom->required == 1) ? "required" : "" ?>>

                                        <?php foreach ($aktif as $row): ?>

                                            <option value="<?= $row->id ?>"
                                                <?= ($value == $row->id) ? "selected" : "" ?>>

                                                <?= $row->name ?>

                                            </option>

                                        <?php endforeach; ?>

                                    </select>

                                </div>
                            </div>

                        <?php endif; ?>




                    <?php endforeach; ?>

                </div>
            </div>

        </div>
    </div>


    <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">
            Close
        </button>

        <button type="submit" class="btn btn-primary">
            Save Changes
        </button>
    </div>

</form>

<script>
    $(document).ready(function() {
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
        $('#formTambahPages').on('submit', function(e) {
            e.preventDefault();

            let action = "<?= $action ?>";
            let formData = new FormData(this);

            $.ajax({
                url: "<?= base_url('Dashboard/save_pages/') ?>" + action,
                type: "POST",
                data: formData,
                processData: false, // WAJIB
                contentType: false, // WAJIB
                dataType: "json",
                beforeSend: function() {
                    Swal.fire({
                        title: 'Menyimpan Data...',
                        text: 'Mohon tunggu',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading()
                        }
                    });
                },
                success: function(response) {

                    if (response.status == 'success') {

                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: response.message,
                            timer: 2000,
                            showConfirmButton: false
                        });

                        $('#modalContent').modal('hide');
                        $('#myTable').DataTable().ajax.reload();

                    } else {

                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: response.message
                        });

                    }

                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Terjadi kesalahan pada server'
                    });
                }

            });

        });

    });
</script>