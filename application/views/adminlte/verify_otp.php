<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $domain['meta_title'] ?> - Verifikasi OTP</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets/dist/'); ?>css/adminlte.min.css">
    <style>
        body.login-page {
            background-image: url('<?= base_url('assets/img/') ?>bc.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
        }

        .login-box .card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(5px);
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <h2><?= $domain['meta_title'] ?></h2>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Masukkan 6 digit kode OTP yang dikirim ke <b><?= $email; ?></b></p>

                <form id="verifyOtpForm">
                    <input type="hidden" name="email" id="email" value="<?= $email; ?>">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control text-center font-weight-bold" name="otp" placeholder="______" maxlength="6" style="letter-spacing: 8px; font-size: 22px;" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-key"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Verifikasi Akun</button>
                        </div>
                    </div>
                </form>

                <div class="text-center mt-3">
                    <button type="button" id="resendOtpBtn" class="btn btn-link btn-sm p-0">Kirim Ulang OTP</button>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url('assets/plugins'); ?>/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('assets/dist/'); ?>js/adminlte.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#verifyOtpForm').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: "<?= base_url('admin/verify_otp_proses'); ?>",
                    type: "POST",
                    data: $(this).serialize(),
                    dataType: "JSON",
                    success: function(response) {
                        if (response.status == 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.message,
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                window.location.href = response.redirect;
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

            $('#resendOtpBtn').on('click', function(e) {
                e.preventDefault();
                let email = $('#email').val();

                $.ajax({
                    url: "<?= base_url('admin/resend_otp'); ?>",
                    type: "POST",
                    data: {
                        email: email
                    },
                    dataType: "JSON",
                    success: function(response) {
                        if (response.status == 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Terkirim',
                                text: response.message,
                                timer: 2000,
                                showConfirmButton: false
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
</body>

</html>