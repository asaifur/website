        <div class="container-fluid">

            <?= $this->session->flashdata('message'); ?>

            <div class="card card-primary card-outline text-sm" id="box-kegiatan">
                <div class="card-header">
                    <h3 class="card-title">Daftar Agenda Kegiatan</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-sm btn-primary" id="btn-tambah">
                            <i class="fas fa-plus mr-1"></i> Tambah Kegiatan
                        </button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover m-0" id="myTable">
                            <thead>
                                <tr>
                                    <th style=" width: 50px;" class="text-center">No</th>
                                    <th>Nama Kegiatan</th>
                                    <th>Tanggal</th>
                                    <th>Lokasi</th>
                                    <th>Kuota / Keterangan</th>
                                    <th>Status</th>
                                    <th style="width: 120px;" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($kegiatan)) : ?>
                                    <?php $no = 1;
                                    foreach ($kegiatan as $kg) : ?>
                                        <tr>
                                            <td class="text-center"><?= $no++; ?></td>
                                            <td><strong><?= $kg->nama_kegiatan; ?></strong></td>
                                            <td><i class="far fa-calendar-alt text-muted mr-1"></i> <?= date('d M Y', strtotime($kg->tanggal)); ?></td>
                                            <td><?= $kg->lokasi; ?></td>
                                            <td><?= $kg->kuota; ?></td>
                                            <td>
                                                <?php if ($kg->status == 'Segera Hadir') : ?>
                                                    <span class="badge badge-warning">Segera Hadir</span>
                                                <?php elseif ($kg->status == 'Pendaftaran Dibuka') : ?>
                                                    <span class="badge badge-success">Pendaftaran Dibuka</span>
                                                <?php else : ?>
                                                    <span class="badge badge-secondary">Selesai</span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center">
                                                <button class="btn btn-xs btn-info btn-edit" id="btn-update"
                                                    data-id=" <?= $kg->id_kegiatan; ?>"

                                                    title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <a href="<?= base_url('kegiatan/hapus/' . $kg->id_kegiatan); ?>" class="btn btn-xs btn-danger" onclick="return confirm('Yakin ingin menghapus kegiatan ini?');" title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="7" class="text-center p-4 text-muted">Belum ada data kegiatan.</td>
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
            <div class="modal-dialog">
                <div class="modal-content" id="isiModalTambah">
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalEdit">
            <div class="modal-dialog">
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
                        '<?= base_url("Kegiatan/tambahKegiatan/insert"); ?>', {}, // Parameter kosong jika tidak ada data yang dikirim awal
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