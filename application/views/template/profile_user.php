<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle" src="<?= base_url('assets/uploads/img/' . (!empty($user['image']) ? $user['image'] : 'user4-128x128.jpg')); ?>" alt="User profile picture">
                        </div>
                        <h3 class="profile-username text-center"><?= $user['username']; ?></h3>
                        <p class="text-muted text-center">Member</p>
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Status</b> <span class="float-right text-success">Active</span>
                            </li>
                            <li class="list-group-item">
                                <b>Member Since</b> <span class="float-right"><?= date('d M Y', strtotime($user['date_created'])); ?></span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Update Profile</a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="settings">
                                <form id="updateProfileForm" class="form-horizontal" enctype="multipart/form-data">
                                    <div class="form-group row">
                                        <label for="inputPhoto" class="col-sm-2 col-form-label">Profile Picture</label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="inputPhoto" name="profile_image" accept="image/png, image/jpeg, image/jpg">
                                                    <label class="custom-file-label" for="inputPhoto">Pilih file foto...</label>
                                                </div>
                                            </div>
                                            <small class="text-muted">Format: JPG, JPEG, PNG. Maksimal 2MB.</small>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Full Name dan Gelar</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputName" name="username" value="<?= $user['username']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="inputEmail" name="email" value="<?= $user['email']; ?>" readonly>
                                            <small class="text-muted">Email tidak dapat diubah.</small>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputInstitution" class="col-sm-2 col-form-label">Institution</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="institusi" name="institusi" value="<?= $user['institusi']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputField" class="col-sm-2 col-form-label">Bidang Ilmu</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputField" name="bidang_ilmu" value="<?= $user['bidang_ilmu']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPassword" class="col-sm-2 col-form-label">New Password</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Kosongkan jika tidak ingin mengubah password">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <button type="submit" class="btn btn-danger">Simpan Perubahan</button>
                                            <button type="button" class="btn btn-primary ml-2" data-toggle="modal" data-target="#modalKartuAnggota">
                                                <i class="fas fa-id-card mr-1"></i> View Kartu Anggota
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="modalKartuAnggota" tabindex="-1" role="dialog" aria-labelledby="modalKartuAnggotaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalKartuAnggotaLabel">Kartu Tanda Anggota (KTA) PDPTN</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Modal Body Preview Kartu Anggota (Presisi Sesuai Referensi Visual) -->
            <div class="modal-body text-center bg-light">
                <div id="ktaCardPreview" style="width: 100%; max-width: 680px; height: 410px; margin: 0 auto; background: #ffffff; border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.25); position: relative; overflow: hidden; text-align: left; font-family: 'Source Sans Pro', Arial, sans-serif; border: 1px solid #dcdcdc;">

                    <!-- 1. TOP RIGHT HEADER BRANDING & ACCENTS (Skewed Shapes & Logo) -->
                    <div style="position: absolute; top: 0; right: 0; width: 340px; height: 35px; background: #dc3545; transform: skewX(-32deg); transform-origin: top right; z-index: 1;"></div>
                    <div style="position: absolute; top: 35px; right: 0; width: 380px; height: 18px; background: #002D62; transform: skewX(-32deg); transform-origin: top right; z-index: 1;"></div>
                    <div style="position: absolute; top: 12px; right: 25px; text-align: right; z-index: 2;">
                        <h3 style="color: #002D62; font-weight: 900; font-size: 24px; letter-spacing: 1.5px; margin: 0; font-family: 'Arial Black', sans-serif;"><?= $this->domain->title; ?></h3>
                    </div>
                    <div style="position: absolute; top: 55px; left: 0; right: 0; height: 4px; background: #e50914; z-index: 2;"></div>

                    <!-- 2. LEFT SIDE BACKGROUND GEOMETRIC SHAPES (Purple/Blue & Red V-Chevron) -->
                    <div style="position: absolute; top: 0; left: 0; width: 195px; height: 100%; background: #6367FF; z-index: 1;"></div>
                    <div style="position: absolute; top: 0; left: 0; width: 155px; height: 100%; background: #002D62; z-index: 2;"></div>

                    <!-- Bottom Diagonal Red/Purple Chevron Layers -->
                    <div style="position: absolute; bottom: 0; left: 0; width: 280px; height: 130px; background: #4b52e0; transform: skewY(22deg); z-index: 3;"></div>
                    <div style="position: absolute; bottom: -20px; left: 0; width: 260px; height: 90px; background: #dc3545; transform: skewY(28deg); z-index: 4;"></div>

                    <!-- 3. PHOTO CONTAINER WITH DUAL BORDER FRAME -->
                    <div style="position: absolute; top: 40px; left: 25px; width: 125px; height: 165px; background: #002D62; border: 4px solid #ffffff; box-shadow: 0 6px 15px rgba(0,0,0,0.4); z-index: 5; border-radius: 4px; padding: 4px;">
                        <div style="width: 100%; height: 100%; border: 2px solid #b8860b; background: #fff; overflow: hidden; border-radius: 2px;">
                            <img src="<?= base_url('assets/uploads/img/' . (!empty($user['image']) ? $user['image'] : 'user4-128x128.jpg')); ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="Foto Anggota">
                        </div>
                    </div>

                    <!-- 4. MEMBER INFO CONTENT -->
                    <div style="position: absolute; top: 75px; left: 195px; right: 25px; z-index: 5;">
                        <!-- Nomor Anggota -->
                        <div style="font-size: 20px; font-weight: 900; color: #b8860b; letter-spacing: 1.5px; margin-bottom: 4px; font-family: monospace;">
                            <?= date('Ymd', strtotime($user['date_created'])) . '000' . $user['id_users']; ?>
                        </div>
                        <!-- Nama Lengkap -->
                        <div style="font-size: 15px; font-weight: 900; color: #000000; text-transform: uppercase; line-height: 1.25; margin-bottom: 6px;">
                            <?= $user['username']; ?>
                        </div>
                        <!-- Bidang Ilmu -->
                        <div style="font-size: 11px; color: #222; margin-bottom: 2px; text-transform: uppercase; letter-spacing: 0.5px;">
                            <strong><?= !empty($user['bidang_ilmu']) ? $user['bidang_ilmu'] : 'ILMU KEPENDIDIKAN'; ?></strong>
                        </div>
                        <!-- Institusi -->
                        <div style="font-size: 13px; font-weight: 700; color: #111; margin-bottom: 10px;">
                            <?= !empty($user['institusi']) ? $user['institusi'] : 'Institut Ilmu Kesehatan (IIK) Strada Indonesia'; ?>
                        </div>
                        <!-- Kontak & Alamat -->
                        <div style="font-size: 10.5px; color: #333; line-height: 1.4; font-weight: 500;">
                            <div style="margin-bottom: 2px;">
                                <span style="font-weight: bold;"><?= !empty($user['noTelepon']) ? $user['noTelepon'] : '+62813-3637-3242'; ?></span>
                                &nbsp;&nbsp;|&nbsp;&nbsp;
                                <span><?= $user['email']; ?></span>
                            </div>
                            <div><?= !empty($user['address']) ? $user['address'] : 'Jl. Letjen Suparman No 80 Kediri, JAWA TIMUR'; ?></div>
                        </div>
                    </div>

                    <!-- 5. FOOTER LEGAL TEXT & BARCODE -->
                    <div style="position: absolute; bottom: 12px; left: 18px; font-size: 8px; color: #ffffff; z-index: 6; font-weight: bold; letter-spacing: 0.3px;">
                        SK KemenkumHAM RI nomor : AHU-0010575.AH.01.07.TAHUN 2019
                    </div>

                    <!-- Barcode Container -->
                    <div style="position: absolute; bottom: 10px; right: 20px; background: #ffffff; padding: 3px 8px; border-radius: 3px; z-index: 5; box-shadow: 0 2px 5px rgba(0,0,0,0.2);">
                        <?= generate_member_barcode($user['date_created'], $user['id_users']); ?>
                    </div>

                    <!-- Bottom Right Corner Red Geometric Accent -->
                    <div style="position: absolute; bottom: 0; right: 0; width: 0; height: 0; border-style: solid; border-width: 0 0 35px 45px; border-color: transparent transparent #dc3545 transparent; z-index: 5;"></div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <a href="<?= base_url('dashboard/download_kta_pdf'); ?>" target="_blank" class="btn btn-success">
                    <i class="fas fa-file-pdf mr-1"></i> Download PDF KTA
                </a>
            </div>
        </div>
    </div>
</div>

<!-- jQuery (Pastikan dimuat sebelum script yang menggunakan simbol $) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('assets/plugins'); ?>/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- bs-custom-file-input -->
<script src="<?= base_url('assets/'); ?>plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets/dist/'); ?>js/adminlte.min.js"></script>
<script>
    $(document).ready(function() {
        bsCustomFileInput.init();

        $('#updateProfileForm').on('submit', function(e) {
            e.preventDefault();

            let formData = new FormData(this);

            $.ajax({
                url: "<?= base_url('dashboard/update_profile_user'); ?>",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function(response) {
                    if (response.status == 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.message,
                            timer: 1500,
                            showConfirmButton: false
                        }).then(() => {
                            location.reload();
                        });
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
    });
</script>