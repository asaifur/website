<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/codemirror/codemirror.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/codemirror/theme/monokai.css">

<div class="modal-header bg-primary text-white">
    <h4 class="modal-title font-weight-bold"><i class="fas fa-edit mr-1"></i> <?= ucfirst($action) ?> Jurnal</h4>
    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<form id="formTambahPages" enctype="multipart/form-data">

    <div class="modal-body">
        <div class="card card-primary card-outline shadow-none mb-0">
            <div class="card-header">
                <h3 class="card-title font-weight-bold">Form Input Metadata Jurnal</h3>
            </div>

            <div class="card-body">
                <div class="row">

                    <?php foreach ($format as $kolom):

                        $val = $kolom->code;
                        $value = '';

                        if ($action <> 'insert' && isset($dtKolom->$val)) {
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
                                        <?= $kolom->name ?> <?= ($kolom->r == 1) ? '<span class="text-danger">*</span>' : '' ?>
                                    </label>

                                    <input type="text"
                                        class="form-control"
                                        name="<?= $kolom->code ?>"
                                        id="<?= $kolom->code ?>"
                                        placeholder="<?= $kolom->placeholder ?>"
                                        value="<?= $value ?>"
                                        <?= ($kolom->r == 1) ? "required" : "" ?>>
                                </div>
                            </div>
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

                                        <?php if (in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'webp', 'pdf'])): ?>
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
                            <input type="hidden" value="<?= date("Y-m-d H:i:s"); ?>" id="<?= $kolom->code ?>" name="<?= $kolom->code ?>">
                        <?php endif; ?>

                        <?php if ($kolom->type == "NUMBER"): ?>
                            <div class="<?= $kolom->lebar ?> ">
                                <div class="form-group">
                                    <label><?= $kolom->name ?></label>
                                    <input type="number" class="form-control" id="<?= $kolom->code ?>" name="<?= $kolom->code ?>" value="<?= $value ?>">
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
            <i class="fas fa-times mr-1"></i> Close
        </button>
        <button type="submit" class="btn btn-primary" id="btnSaveJurnal">
            <i class="fas fa-save mr-1"></i> <?= ucfirst($action) ?> Changes
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

        $(document).off('submit', '#formTambahPages').on('submit', '#formTambahPages', function(e) {
            e.preventDefault();

            let action = "<?= $action ?>";
            let formData = new FormData(this);

            $.ajax({
                url: "<?= base_url('Dashboard/addJurnalAction/') ?>" + action,
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                dataType: "json",
                beforeSend: function() {
                    $('#btnSaveJurnal').prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i> Menyimpan...');
                    Swal.fire({
                        title: 'Menyimpan Data...',
                        text: 'Mohon tunggu sebentar',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                },
                success: function(response) {
                    Swal.close();
                    $('#btnSaveJurnal').prop('disabled', false).html('<i class="fas fa-save mr-1"></i> <?= ucfirst($action) ?> Changes');

                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: response.message,
                            timer: 2000,
                            showConfirmButton: false
                        });

                        $('#modal-xl').modal('hide');

                        if (typeof tableJurnal !== 'undefined' && tableJurnal !== null) {
                            tableJurnal.ajax.reload(null, false);
                        } else if ($.fn.DataTable.isDataTable('#tableJurnal')) {
                            $('#tableJurnal').DataTable().ajax.reload(null, false);
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
                    $('#btnSaveJurnal').prop('disabled', false).html('<i class="fas fa-save mr-1"></i> <?= ucfirst($action) ?> Changes');

                    Swal.fire({
                        icon: 'error',
                        title: 'Server Error',
                        text: 'Terjadi kesalahan saat memproses data pada server.'
                    });
                    console.log(xhr.responseText);
                }
            });
        });
    });
</script>