<?php
$action = isset($action) ? $action : 'insert';
$readonly = '';
$disabled = '';
if ($action == "view") {
    $readonly = "readonly";
    $disabled = "disabled";
}
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.min.css">
<div class="modal-header">
    <h4 class="modal-title text-uppercase" style="text-decoration: dashed; text-transform: uppercase;"><?= $action ?> Kegiatan</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<form id="actionFormKegiatan" enctype="multipart/form-data">
    <div class="modal-body">
        <?php foreach ($format as $kolom):
            $value = isset($dtKolom->{$kolom->code})
                ? $dtKolom->{$kolom->code}
                : "";
        ?>
            <div class="form-group">
                <?php if ($kolom->type == "HIDDEN"): ?>
                    <input type="hidden" value="<?= $value; ?>" name="<?= $kolom->code ?>" id="<?= $kolom->code ?>">
                <?php endif; ?>

                <?php if ($kolom->type == "RST") : ?>
                    <label><?= $kolom->name; ?></label>
                    <input <?= $readonly; ?> type="text" value="<?= $value; ?>" name="<?= $kolom->code ?>" id="<?= $kolom->code ?>" class="form-control" placeholder="<?= $kolom->placeholder ?>">
                <?php endif; ?>

                <?php if ($kolom->type == "NUM") : ?>
                    <label><?= $kolom->name; ?></label>
                    <input <?= $readonly; ?> type="text" value="<?= $value; ?>" name="<?= $kolom->code ?>" id="<?= $kolom->code ?>" class="form-control hanya-angka" placeholder="<?= $kolom->placeholder ?>">
                <?php endif; ?>

                <?php if ($kolom->type == "TIME") : ?>
                    <label><?= $kolom->name; ?></label>
                    <div class="input-group">
                        <input <?= $readonly; ?> type="text" value="<?= $value; ?>" name="<?= $kolom->code ?>" id="<?= $kolom->code ?>" class="form-control timepicker" placeholder="<?= $kolom->placeholder ?>" autocomplete="off">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="far fa-clock"></i></span>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if ($kolom->type == "DATE") : ?>
                    <label><?= $kolom->name; ?></label>
                    <div class="input-group">
                        <input <?= $readonly; ?> type="text" value="<?= $value; ?>" name="<?= $kolom->code ?>" id="<?= $kolom->code ?>" class="form-control datepicker" placeholder="<?= $kolom->placeholder ?>" autocomplete="off">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if ($kolom->type == "IS_ACTIVE") : ?>
                    <label><?= $kolom->name; ?></label>
                    <select <?= $disabled; ?> name="<?= $kolom->code ?>" id="<?= $kolom->code ?>" class="form-control">
                        <option value="0" <?= ($value == '0') ? 'selected' : ''; ?>>Tidak Aktif</option>
                        <option value="1" <?= ($value == '1' || $value == '') ? 'selected' : ''; ?>>Aktif</option>
                    </select>

                    <?php if ($action == "view") : ?>
                        <input type="hidden" name="<?= $kolom->code ?>" value="<?= $value; ?>">
                    <?php endif; ?>
                <?php endif; ?>
            </div>

            <?php if ($kolom->type == "FILE") : ?>
                <div class="form-group">
                    <label>Upload File</label>
                    <input <?= $readonly; ?> type="file" name="file" id="file" class="form-control">

                    <?php if (!empty($value)) : ?>
                        <small class="text-success d-block mt-2">
                            File saat ini :
                            <a href="<?= base_url('assets/uploads/') . $value; ?>" target="_blank"><?= $value; ?></a>
                        </small>

                        <?php
                        $ext = pathinfo($value, PATHINFO_EXTENSION);
                        $img_ext = ['jpg', 'jpeg', 'png'];
                        if (in_array(strtolower($ext), $img_ext)) : ?>
                            <img src="<?= base_url('assets/uploads/') . $value; ?>" class="img-thumbnail mt-2" style="max-height:150px;">
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

        <?php endforeach; ?>
    </div>

    <?php if ($action == "view") {
        echo '<div class="modal-footer text-muted">Tidak ada Aksi (Mode Lihat)</div>';
    } else { ?>
        <input type="hidden" name="action" value="<?= $action ?>">
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-info" id="btn-simpan"><?= $action; ?></button>
        </div>
    <?php } ?>
</form>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js"></script>
<script>
    $(document).ready(function() {
        // 1. VALIDASI HANYA ANGKA (Untuk Type NUM)
        $('.hanya-angka').on('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '');
        });

        // Cek apakah user sedang dalam mode view, jika ya, matikan plugin input picker
        <?php if ($action !== 'view'): ?>

            // 2. JQUERY DATEPICKER (Menggunakan Bootstrap Datepicker bawaan AdminLTE)
            if ($.fn.datepicker) {
                $('.datepicker').datepicker({
                    format: 'yyyy-mm-dd',
                    autoclose: true,
                    todayHighlight: true
                });
            } else {
                // Fallback ke HTML5 jika plugin tidak ter-load
                $('.datepicker').attr('type', 'date');
            }

            // 3. JQUERY TIMEPICKER
            if ($.fn.timepicker) {
                $('.timepicker').timepicker({
                    showInputs: false,
                    showMeridian: false, // Format 24 Jam
                    minuteStep: 5
                });
            } else {
                // Fallback ke HTML5 jika plugin tidak ter-load
                $('.timepicker').attr('type', 'time');
            }

        <?php else: ?>
            // PERBAIKAN: Selector digabungkan dengan benar menggunakan koma di dalam satu string
            $('.datepicker, .timepicker').attr('readonly', true);
        <?php endif; ?>


        $('#actionFormKegiatan').on('submit', function(e) {
            e.preventDefault(); // Mencegah reload halaman
            var action = "<?= $action ?>";

            // Menggunakan FormData untuk menangani upload file
            var formData = new FormData(this);

            $.ajax({
                url: "<?= base_url('Kegiatan/insertKegiatanAction/');  ?>", // Arahkan ke method controller
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,

                success: function(response) {
                    var res = jQuery.parseJSON(response);

                    if (res.status == true) {

                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: res.message,
                            showConfirmButton: false,
                            timer: 2000
                        }).then(function() {

                            $('#actionFormKegiatan')[0].reset(); // Reset form
                            $('#modalTambah').modal('hide'); // Tutup modal

                            if ($.fn.DataTable.isDataTable('#myTable')) {
                                $('#myTable').DataTable().ajax.reload(null, false);
                            }

                        });

                    } else {

                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: res.message
                        });

                    }
                },

                error: function() {
                    alert("Terjadi kesalahan pada server.");
                },
                complete: function() {
                    $('#btn-simpan').attr('disabled', false).html('Simpan');
                }
            });
        });
    });
</script>