        <div class="container-fluid">

            <?= $this->session->flashdata('message'); ?>

            <div class="card card-primary card-outline text-sm" id="box-kegiatan">
                <div class="card-header">
                    <h3 class="card-title">Daftar UMKM </h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-sm btn-primary" id="btn-tambah">
                            <i class="fas fa-plus mr-1"></i> Tambah UMKM
                        </button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover m-0" id="myTable">
                            <thead>
                                <tr class="text-nowrap">
                                    <th style="width: 50px;" class="text-center">No</th>
                                    <th>Nama Usaha</th>
                                    <th>Nama Pemilik</th>
                                    <th>Alamat Usaha</th>
                                    <th>No. Telp Usaha</th>
                                    <th>No. Telp Pemilik</th>
                                    <th>Kategori Usaha</th>
                                    <th>No. Izin PIRT</th>
                                    <th>Sertifikat Halal</th>
                                    <th>No. HAKI</th>
                                    <th>Status</th>
                                    <th style="width: 100px;" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($umkm)) : ?>
                                    <?php $no = 1;
                                    foreach ($umkm as $u) : ?>
                                        <tr>
                                            <td class="text-center"><?= $no++; ?></td>
                                            <td><strong><?= $u->nama_usaha; ?></strong></td>
                                            <td><?= $u->nama_pemilik; ?></td>
                                            <td class="text-truncate" style="max-width: 180px;"><?= $u->alamat_usaha; ?></td>
                                            <td><?= $u->no_telp_usaha ? $u->no_telp_usaha : '-'; ?></td>
                                            <td><?= $u->no_telp_pemilik; ?></td>
                                            <td><span class="badge badge-info"><?= $u->nama_kategori; ?></span></td>
                                            <td><?= $u->no_pirt ? $u->no_pirt : '<span class="text-muted">-</span>'; ?></td>
                                            <td><?= $u->no_halal ? $u->no_halal : '<span class="text-muted">-</span>'; ?></td>
                                            <td><?= $u->no_haki ? $u->no_haki : '<span class="text-muted">-</span>'; ?></td>
                                            <td class="text-nowrap"><i class="far fa-calendar-alt text-muted mr-1"></i> <?= date('d M Y', strtotime($u->tanggal_berdiri)); ?></td>
                                            <td>
                                                <?php if ($u->status == 'Aktif') : ?>
                                                    <span class="badge badge-success">Aktif</span>
                                                <?php else : ?>
                                                    <span class="badge badge-danger">Tidak Aktif</span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-xs btn-info" id="btn-update" data-id="<?= $u->id_umkm; ?>" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <a href="<?= base_url('umkm/hapus/' . $u->id_umkm); ?>" class="btn btn-xs btn-danger" onclick="return confirm('Yakin ingin menghapus data UMKM ini?');" title="Hapus">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="13" class="text-center p-5 text-muted">
                                            <i class="fas fa-store-slash fa-2x mb-2 d-block"></i>
                                            Belum ada data UMKM yang terdaftar.
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        </section>
        </div>

        <div class="modal fade" id="modalTambah">
            <div class="modal-dialog modal-xl">
                <div class="modal-content" id="isiModalTambah">
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalEdit">
            <div class="modal-dialog modal-xl">
                <div class="modal-content" id="isiModalEdit">
                </div>
            </div>
        </div>


        <?php $this->load->view('template/scriptes.php') ?>

        <script src="<?= base_url('assets/plugins/jquery/jquery.min.js') ?>"></script>

        <script src="<?= base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="<?= base_url('assets/dist/js/adminlte.min.js') ?>"></script>
        <script>
            $(document).ready(function() {
                // Efek slow motion transisi saat table pertama kali load
                $('#box-kegiatan').hide().fadeIn(1000);

                // Event handler tombol Edit untuk mengambil data atribut dan dilempar ke dalam Modal Edit
                // ==========================================
                $('#btn-tambah').on('click', function() {
                    // Bersihkan isi modal sebelumnya
                    $('#isiModalTambah').html('');

                    Swal.fire({
                        icon: 'info',
                        title: 'Pemberitahuan',
                        text: 'Sedang memuat form tambah data...',
                        showConfirmButton: false,
                        allowOutsideClick: false
                    });

                    $.post(
                        '<?= base_url("Umkm/tambahUmkm/insert"); ?>', {}, // Parameter kosong jika tidak ada data yang dikirim awal
                        function(data) {
                            // Masukkan komponen HTML form ke target ID yang benar
                            $('#isiModalTambah').html(data);
                            Swal.close();

                            // Munculkan modalTambah yang benar
                            $('#modalTambah').modal({
                                backdrop: 'static',
                                keyboard: false,
                                show: true
                            });
                        },
                        'html'
                    ).fail(function() {
                        Swal.fire('Error', 'Gagal memuat form tambah data.', 'error');
                    });
                });
                $('#myTable').on('click', '#btn-update', function() {
                    var id = $(this).data('id');
                    $('#isiModalTambah').html('');
                    Swal.fire({
                        icon: 'info',
                        title: 'Pemberitahuan',
                        text: 'Sedang memuat form tambah data...',
                        showConfirmButton: false
                    });

                    $.post(
                        '<?= base_url("Kegiatan/tambahKegiatan/update/");
                            ?>', {
                            id: id
                        }, // Kirim ID ke server dengan nama variabel 'id_kegiatan'
                        function(data) {
                            // Masukkan komponen HTML form ke target ID yang benar
                            $('#isiModalTambah').html(data);
                            Swal.close();

                            // Munculkan modalTambah yang benar
                            $('#modalTambah').modal({
                                backdrop: 'static',
                                keyboard: false,
                                show: true
                            });
                        },
                        'html'
                    ).fail(function() {
                        Swal.fire('Error', 'Gagal memuat form tambah data.', 'error');
                    });
                });

            });
        </script>