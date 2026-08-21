<div class="content-wrapper" style="margin-left: 0px !important; padding: 20px;">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><i class="fas fa-box"></i> Manajemen Master Barang</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <button type="button" class="btn btn-success" onclick="tambahBarangModal()">
                        <i class="fas fa-plus-circle"></i> Tambah Produk Baru
                    </button>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-outline card-primary">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover w-100" id="table-barang">
                            <thead>
                                <tr>
                                    <th style="width: 50px;" class="text-center">No</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Harga Jual</th>
                                    <th style="width: 150px;" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($barang)): $no = 1;
                                    foreach ($barang as $b): ?>
                                        <tr>
                                            <td class="text-center"><?= $no++; ?></td>
                                            <td><span class="badge badge-secondary font-weight-bold"><?= $b['kode_barang']; ?></span></td>
                                            <td><?= $b['nama_barang']; ?></td>
                                            <td class="font-weight-bold">Rp <?= number_format($b['harga_jual'], 0, ',', '.'); ?></td>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-warning" onclick="editBarang('<?= $b['kode_barang']; ?>')">
                                                    <i class="fas fa-edit"></i> Edit
                                                </button>
                                                <button class="btn btn-sm btn-danger" onclick="hapusBarang('<?= $b['kode_barang']; ?>')">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>
                                            </td>
                                        </tr>
                                <?php endforeach;
                                endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="modal-default">
    <div class="modal-dialog modal-xl">
        <div class="modal-content" id="isiModalSedang">
        </div>
    </div>
</div>

<script src="<?= base_url('assets/plugins/') ?>jquery/jquery.js"></script>
<script src="<?= base_url('assets/plugins/') ?>bootstrap/js/bootstrap.bundle.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.26.18/dist/sweetalert2.all.min.js"></script>
<script src="<?= base_url('assets/') ?>plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url('assets/') ?>plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>

<script>
    const bUrl = "<?= site_url('penjualan/') ?>";

    $(document).ready(function() {
        $('#table-barang').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });

    // Pemicu Modal Tambah
    function tambahBarangModal() {
        $('#isiModalSedang').html('');
        Swal.fire({
            icon: 'info',
            title: 'Pemberitahuan',
            text: 'Sedang memuat form tambah data...',
            showConfirmButton: false,
            allowOutsideClick: false
        });

        $.ajax({
            url: "<?= base_url('Penjualan/addMasterBarang/'); ?>",
            method: "POST",
            data: {
                id: '',
                'action': 'insert'
            },
            success: function(htmlResponse) {
                Swal.close();
                $('#isiModalSedang').html(htmlResponse);
                $('#modal-default').modal('show');
            },
            error: function() {
                Swal.fire('Error!', 'Gagal memuat form komponen modal dari server.', 'error');
            }
        });
    }

    // Pemicu Modal Edit
    function editBarang(kode_barang) {
        $('#isiModalSedang').html('');
        Swal.fire({
            icon: 'info',
            title: 'Pemberitahuan',
            text: 'Sedang mengambil data produk...',
            showConfirmButton: false,
            allowOutsideClick: false
        });

        $.ajax({
            url: "<?= base_url('Penjualan/addMasterBarang/'); ?>",
            method: "POST",
            data: {
                id: kode_barang,
                'action': 'update'
            },
            success: function(htmlResponse) {
                Swal.close();
                $('#isiModalSedang').html(htmlResponse);
                $('#modal-default').modal('show');
            },
            error: function() {
                Swal.fire('Error!', 'Gagal memuat komponen data dari server.', 'error');
            }
        });
    }

    // Fungsi Hapus Produk Master
    function hapusBarang(kode_barang) {
        Swal.fire({
            title: 'Apakah Anda Yakin?',
            text: "Produk dengan kode " + kode_barang + " akan dihapus permanen dari data master!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Memproses...',
                    text: 'Sedang menghapus data produk',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                $.ajax({
                    url: "<?= base_url('Penjualan/hapus_master_produk/'); ?>" + kode_barang,
                    type: 'GET',
                    dataType: 'JSON',
                    success: function(response) {
                        Swal.close();
                        if (response.status) {
                            Swal.fire('Berhasil!', response.msg, 'success').then(() => {
                                window.location.reload();
                            });
                        } else {
                            Swal.fire('Gagal!', response.msg, 'error');
                        }
                    },
                    error: function() {
                        Swal.fire('Error!', 'Gagal menghubungi server untuk menghapus data.', 'error');
                    }
                });
            }
        });
    }
</script>