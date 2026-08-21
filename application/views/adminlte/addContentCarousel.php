<style>
    .select2-container {
        width: 100% !important;
    }

    .select2-container--open {
        z-index: 9999 !important;
    }
</style>
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/codemirror/codemirror.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/codemirror/theme/monokai.css">

<!-- SELECT2 CSS -->


<div class="modal-header">
    <h4 class="modal-title"><?= $action ?> Carousel </h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<form id="formTambahCarousel" enctype="multipart/form-data">

    <div class="modal-body">
        <div class="card card-danger">
            <div class="card-header">
                <h3 class="card-title">Input Carousel</h3>
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

                        <?php if ($kolom->type == "SPAN"): ?>
                            <div class="<?= $kolom->lebar ?> ">
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
                        <?php endif;
                        ?>
                        <?php if ($kolom->type == "GET_IMAGE"): ?>
                            <div class="<?= $kolom->lebar ?>">
                                <div class="form-group">

                                    <label><?= $kolom->name ?></label>

                                    <select class="form-control get-image-select select2"
                                        name="<?= $kolom->code ?>"
                                        id="<?= $kolom->code ?>"
                                        <?= ($kolom->r == 1) ? "required" : "" ?>>

                                        <?php foreach ($get_image as $row): ?>

                                            <option value="<?= $row->file_name ?>"
                                                <?= ($value == $row->file_name) ? "selected" : "" ?>>

                                                <?= $row->caption ?>

                                            </option>

                                        <?php endforeach; ?>

                                    </select>

                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if ($kolom->type == "PAGE"): ?>
                            <div class="<?= $kolom->lebar ?>">
                                <div class="form-group">

                                    <label><?= $kolom->name ?></label>

                                    <select class="form-control"
                                        name="<?= $kolom->code ?>"
                                        id="<?= $kolom->code ?>"
                                        <?= ($kolom->r == 1) ? "required" : "" ?>>

                                        <?php foreach ($get_page as $row): ?>

                                            <option value="<?= $row->id_page ?>"
                                                <?= ($value == $row->id_page) ? "selected" : "" ?>>

                                                <?= $row->slug ?>

                                            </option>

                                        <?php endforeach; ?>

                                    </select>

                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if ($kolom->type == "CONTENT"): ?>

                            <div class="<?= $kolom->lebar ?> ">
                                <div class="form-group">

                                    <label><?= $kolom->name ?></label>

                                    <textarea
                                        class="form-control content-editor"
                                        name="<?= $kolom->code ?>"
                                        id="<?= $kolom->code ?>"
                                        rows="10"><?= $value ?></textarea>

                                </div>
                            </div>

                        <?php endif; ?>
                        <?php if ($kolom->type == "RST") : ?>

                            <div class="<?= $kolom->lebar ?> ">
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


                        <?php if ($kolom->type == "SELECT_ACTIVE") : ?>

                            <div class="<?= $kolom->lebar ?>">
                                <div class="form-group">

                                    <label><?= $kolom->name ?></label>

                                    <select class="form-control"
                                        name="<?= $kolom->code ?>"
                                        id="<?= $kolom->code ?>"
                                        <?= ($kolom->r == 1) ? "required" : "" ?>>

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
                        <?php if ($kolom->type == "LEBAR"): ?>
                            <div class="<?= $kolom->lebar ?>">
                                <div class="form-group">

                                    <label><?= $kolom->name ?></label>

                                    <select class="form-control"
                                        name="<?= $kolom->code ?>"
                                        id="<?= $kolom->code ?>"
                                        <?= ($kolom->r == 1) ? "required" : "" ?>>

                                        <?php foreach ($lebar as $row): ?>

                                            <option value="<?= $row->name ?>"
                                                <?= ($value == $row->name) ? "selected" : "" ?>>

                                                <?= $row->name ?>

                                            </option>

                                        <?php endforeach; ?>

                                    </select>

                                </div>
                            </div>

                        <?php endif; ?>

                        <?php if ($kolom->type == "SELECT_SECTION"): ?>
                            <div class="<?= $kolom->lebar ?>">
                                <div class="form-group">

                                    <label><?= $kolom->name ?></label>

                                    <select class="form-control trigger-sections"
                                        name="<?= $kolom->code ?>"
                                        id="<?= $kolom->code ?>"
                                        <?= ($kolom->r == 1) ? "required" : "" ?>>

                                        <?php foreach ($sections as $row): ?>

                                            <option value="<?= $row->id ?>"
                                                <?= ($value == $row->id) ? "selected" : "" ?>>

                                                <?= $row->title . '|' . $row->id ?>

                                            </option>

                                        <?php endforeach; ?>

                                    </select>

                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if ($kolom->type == "SECTIONS") : ?>
                            <div class="<?= $kolom->lebar ?>">
                                <div class="form-group">

                                    <label><?= $kolom->name ?></label>

                                    <select class="form-control trigger-sections"
                                        name="<?= $kolom->code ?>"
                                        id="<?= $kolom->code ?>"
                                        <?= ($kolom->r == 1) ? "required" : "" ?>>

                                        <?php foreach ($sections as $row): ?>

                                            <option value="<?= $row->section ?>"
                                                <?= ($value == $row->section) ? "selected" : "" ?>>

                                                <?= $row->section ?>

                                            </option>

                                        <?php endforeach; ?>

                                    </select>

                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if ($kolom->type == "NUMBER"): ?>
                            <div class="<?= $kolom->lebar ?> ">
                                <div class="form-group">

                                    <label><?= $kolom->name ?></label>
                                    <input type="number" class="form-control" id="<?= $kolom->code ?>" name="<?= $kolom->code ?>" value="<?= $value ?>">

                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if ($kolom->type == "SELECT_MENU_PAGES") : ?>

                            <div class="<?= $kolom->lebar ?>">
                                <div class="form-group">

                                    <label><?= $kolom->name ?></label>

                                    <select class="form-control"
                                        name="<?= $kolom->code ?>"
                                        id="<?= $kolom->code ?>"
                                        <?= ($kolom->r == 1) ? "required" : "" ?>>

                                        <?php foreach ($get_menu as $row): ?>

                                            <option value="<?= $row->slug ?>"
                                                <?= ($value == $row->slug) ? "selected" : "" ?>>

                                                <?= $row->slug ?>

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
            <?= $action ?> Changes
        </button>
    </div>

</form>

<script src="<?= base_url() ?>assets/plugins/codemirror/codemirror.js"></script>
<script src="<?= base_url() ?>assets/plugins/codemirror/mode/xml/xml.js"></script>
<script src="<?= base_url() ?>assets/plugins/codemirror/mode/javascript/javascript.js"></script>
<script src="<?= base_url() ?>assets/plugins/codemirror/mode/css/css.js"></script>
<script src="<?= base_url() ?>assets/plugins/codemirror/mode/htmlmixed/htmlmixed.js"></script>

<script>
    $(document).ready(function() {
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });

        $(document).on('change', '.get-image-select', function() {

            var caption = $(this).find('option:selected').text().trim();

            $('#title').val(caption);

        });


        $('.content-editor').each(function() {

            CodeMirror.fromTextArea(this, {
                mode: "htmlmixed",
                theme: "monokai",
                lineNumbers: true,
                autoCloseTags: true,
                autoCloseBrackets: true,
                lineWrapping: true
            });

        });
        // Trigger ketika dropdown SECTIONS berubah
        // Jika dropdown SECTIONS berubah


        $(document).off('submit', '#formTambahCarousel').on('submit', '#formTambahCarousel', function(e) {

            e.preventDefault();

            let action = "<?= $action ?>";
            let formData = new FormData(this);

            $.ajax({
                url: "<?= base_url('Dashboard/save_carousel/') ?>" + action,
                type: "POST",
                data: formData,
                processData: false, // WAJIB untuk upload file
                contentType: false, // WAJIB untuk upload file
                cache: false,
                dataType: "json",

                beforeSend: function() {
                    $('#formTambahCarousel button[type="submit"]').prop('disabled', true);
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

                    Swal.close();

                    if (response.status == 'success') {
                        $('#formTambahCarousel button[type="submit"]').prop('disabled', false);
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: response.message,
                            timer: 2000,
                            showConfirmButton: false
                        });

                        $('#modalContent').modal('hide');

                        if ($.fn.DataTable.isDataTable('#myTable')) {
                            $('#myTable').DataTable().ajax.reload(null, false);
                        }

                    } else {

                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: response.message
                        });

                    }

                },

                error: function(xhr) {

                    Swal.close();

                    Swal.fire({
                        icon: 'error',
                        title: 'Server Error',
                        text: 'Terjadi kesalahan pada server'
                    });

                    console.log(xhr.responseText);

                }

            });

        });
        $('#modalContent').on('shown.bs.modal', function() {
            $('.select2').select2({
                width: '100%',
                dropdownParent: $('#modalContent'),
                placeholder: 'Pilih Gambar...',
                allowClear: true
            });
        });
    });
</script>