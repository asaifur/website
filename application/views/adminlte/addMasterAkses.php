<!-- Form View & Update Modal Content untuk addMasterAkses -->
<form id="formMasterAkses" class="form-horizontal">
    <div class="modal-header bg-primary text-white">
        <h4 class="modal-title font-weight-bold">
            <?php
            if ($action == 'view') echo 'Detail Akses User: ';
            elseif ($action == 'update') echo 'Edit Akses User: ';
            else echo 'Kelola Akses User: ';
            ?>
            <?= isset($dtKolom->username) ? $dtKolom->username : ''; ?>
        </h4>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <div class="modal-body">
        <!-- Hidden User ID -->
        <input type="hidden" name="id_users" value="<?= isset($dtKolom->id_users) ? $dtKolom->id_users : ''; ?>">

        <div class="row mb-3">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Nama Pengguna</label>
                    <input type="text" class="form-control" value="<?= isset($dtKolom->username) ? $dtKolom->username : ''; ?>" readonly>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" value="<?= isset($dtKolom->email) ? $dtKolom->email : ''; ?>" readonly>
                </div>
            </div>
        </div>

        <hr>
        <h5 class="font-weight-bold mb-3"><i class="fas fa-shield-alt mr-1"></i> Hak Akses Menu Navigasi</h5>

        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <thead class="bg-light text-center">
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th class="text-left">Nama Menu</th>
                        <th style="width: 15%;">Create / Insert</th>
                        <th style="width: 15%;">Read</th>
                        <th style="width: 15%;">Update</th>
                        <th style="width: 15%;">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($menu_navigasi)): ?>
                        <?php $no = 1;
                        foreach ($menu_navigasi as $menu): ?>
                            <?php
                            $m_id = isset($menu->id) ? $menu->id : (isset($menu->menu_id) ? $menu->menu_id : $no);

                            // Cek status akses dari database untuk menu ini
                            $has_insert = isset($user_access[$m_id]['insert']) && $user_access[$m_id]['insert'] == 1 ? 'checked' : '';
                            $has_read   = isset($user_access[$m_id]['read']) && $user_access[$m_id]['read'] == 1 ? 'checked' : '';
                            $has_update = isset($user_access[$m_id]['update']) && $user_access[$m_id]['update'] == 1 ? 'checked' : '';
                            $has_delete = isset($user_access[$m_id]['delete']) && $user_access[$m_id]['delete'] == 1 ? 'checked' : '';

                            $is_disabled = ($action == 'view') ? 'disabled' : '';
                            ?>
                            <tr>
                                <td class="text-center align-middle"><?= $no++; ?></td>
                                <td class="align-middle font-weight-bold">
                                    <?= isset($menu->title) ? $menu->title : (isset($menu->menu_name) ? $menu->menu_name : 'Menu #' . $m_id); ?>
                                    <input type="hidden" name="menu_id[]" value="<?= $m_id; ?>">
                                </td>
                                <td class="text-center align-middle">
                                    <div class="custom-control custom-checkbox d-inline-block">
                                        <input type="checkbox" class="custom-control-input" id="insert_<?= $m_id; ?>" name="access[<?= $m_id; ?>][insert]" value="1" <?= $has_insert; ?> <?= $is_disabled; ?>>
                                        <label class="custom-control-label" for="insert_<?= $m_id; ?>"></label>
                                    </div>
                                </td>
                                <td class="text-center align-middle">
                                    <div class="custom-control custom-checkbox d-inline-block">
                                        <input type="checkbox" class="custom-control-input" id="read_<?= $m_id; ?>" name="access[<?= $m_id; ?>][read]" value="1" <?= $has_read; ?> <?= $is_disabled; ?>>
                                        <label class="custom-control-label" for="read_<?= $m_id; ?>"></label>
                                    </div>
                                </td>
                                <td class="text-center align-middle">
                                    <div class="custom-control custom-checkbox d-inline-block">
                                        <input type="checkbox" class="custom-control-input" id="update_<?= $m_id; ?>" name="access[<?= $m_id; ?>][update]" value="1" <?= $has_update; ?> <?= $is_disabled; ?>>
                                        <label class="custom-control-label" for="update_<?= $m_id; ?>"></label>
                                    </div>
                                </td>
                                <td class="text-center align-middle">
                                    <div class="custom-control custom-checkbox d-inline-block">
                                        <input type="checkbox" class="custom-control-input" id="delete_<?= $m_id; ?>" name="access[<?= $m_id; ?>][delete]" value="1" <?= $has_delete; ?> <?= $is_disabled; ?>>
                                        <label class="custom-control-label" for="delete_<?= $m_id; ?>"></label>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted">Tidak ada menu navigasi tersedia untuk domain ini.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal-footer justify-content-between bg-light">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <?php if ($action != 'view'): ?>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i> Simpan Perubahan Akses</button>
        <?php endif; ?>
    </div>
</form>

<script>
    $(document).ready(function() {
        $('#formMasterAkses').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: "<?= base_url('dashboard/save_master_akses'); ?>",
                type: "POST",
                data: $(this).serialize(),
                dataType: "JSON",
                beforeSend: function() {
                    Swal.fire({
                        title: 'Menyimpan...',
                        text: 'Mohon tunggu sebentar.',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                },
                success: function(response) {
                    if (response.status == 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.message,
                            timer: 1500,
                            showConfirmButton: false
                        }).then(() => {
                            $('#modal-xl').modal('hide');
                            if (typeof tableTransaksi !== 'undefined') {
                                tableTransaksi.ajax.reload(null, false);
                            } else {
                                location.reload();
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: response.message
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Kesalahan Sistem',
                        text: 'Terjadi kesalahan saat menyimpan data.'
                    });
                }
            });
        });
    });
</script>