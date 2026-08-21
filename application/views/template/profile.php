<form id="formupdateprofile" enctype="multipart/form-data">

    <div class="row">


        <?php foreach ($format as $row):
            $val = $row->code;
            $value = '';

            if ($action <> 'insert') {
                $value = $domain[$val];
            }

        ?>
            <?php if ($row->type == "RST") : ?>
                <div class="<?= $row->lebar ?> mb-3">
                    <label><?= $row->name ?></label>
                    <input type="text" class="form-control" name="<?= $val ?>"
                        value="<?= $value ?>" <?= ($row->r == 1) ? "readonly" : "" ?>>
                </div>
            <?php endif; ?>

            <?php if ($row->type == "TEXTAREA"): ?>
                <div class="<?= $row->lebar ?> mb-3">
                    <label><?= $row->name ?></label>
                    <textarea class="form-control" name="<?= $val ?>"><?= $value ?></textarea>
                </div>
            <?php endif; ?>
            <?php if ($row->type == "HIDDEN"): ?>
                <input type="hidden" name="<?= $val ?>" value="<?= $value; ?>">
            <?php endif; ?>
            <?php if ($row->type == "FILE"): ?>
                <div class="col-md-12 mb-3">
                    <label for="<?= $val ?>"><?= $row->name ?></label>

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
                                id="<?= $val ?>"
                                name="<?= $val ?>">
                            <label class="custom-file-label"
                                for="<?= $val ?>">
                                <?= !empty($value) ? 'Ganti file...' : 'Choose file' ?>
                            </label>
                        </div>
                        <div class="input-group-append">
                            <span class="input-group-text">Upload</span>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="old_<?= $val ?>" value="<?= $value ?>">
            <?php endif; ?>
            <?php if ($row->type == "THEME"): ?>
                <div class="<?= $row->lebar ?> mb-3">
                    <label><?= $row->name ?></label>
                    <select class="form-control"
                        name="<?= $val ?>"
                        id="<?= $val ?>"
                        <?= ($row->r == 1) ? "required" : "" ?>>

                        <?php foreach ($theme as $row): ?>

                            <option value="<?= $row->theme ?>"
                                <?= ($value == $row->theme) ? "selected" : "" ?>>

                                <?= $row->theme ?>

                            </option>

                        <?php endforeach; ?>

                    </select>
                </div>
            <?php endif; ?>

        <?php endforeach; ?>

        <div class="col-md-12 mb-3 text-end">
            <button type="submit" class="btn btn-primary">
                Update Profile
            </button>
        </div>

    </div>

</form>
<?php $this->load->view('template/scriptes'); ?><script>
    $(document).ready(function() {
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });

        $(document).off('submit', '#formupdateprofile').on('submit', '#formupdateprofile', function(e) {

            e.preventDefault();

            let action = "<?= $action ?>";
            let formData = new FormData(this);

            $.ajax({
                url: "<?= base_url('Dashboard/update_profile/') ?>",
                type: "POST",
                data: formData,
                processData: false, // WAJIB untuk upload file
                contentType: false, // WAJIB untuk upload file
                cache: false,
                dataType: "json",

                beforeSend: function() {
                    $('#formTambahPages button[type="submit"]').prop('disabled', true);
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
                        $('#formTambahPages button[type="submit"]').prop('disabled', false);
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

    });
</script>