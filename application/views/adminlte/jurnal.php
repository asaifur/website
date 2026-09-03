<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><?= $title; ?></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('dashboard/navigasi'); ?>">Home</a></li>
                    <li class="breadcrumb-item active"><?= $title; ?></li>
                </ol>
            </div>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary card-outline shadow-sm">
                    <div class="card-header">
                        <h3 class="card-title font-weight-bold pt-1">Tabel <?= $title; ?></h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-primary btn-sm" id="btnAddJurnal">
                                <i class="fas fa-plus mr-1"></i> Tambah Jurnal
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="tableJurnal" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr class="text-center">
                                    <th style="width: 5%;">No</th>
                                    <th>Judul Artikel</th>
                                    <th>Penulis</th>
                                    <th>ISSN</th>
                                    <th>Subjek</th>
                                    <th>Tanggal Terbit</th>
                                    <th style="width: 15%;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- DataTables dynamic loading -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal XL untuk Form Action -->
<div class="modal fade" id="modal-xl" tabindex="-1" role="dialog" aria-labelledby="modalXlLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content" id="modalAction">
            <!-- AJAX Content -->
        </div>
    </div>
</div>

<!-- DataTables & Plugins CSS -->
<?php $this->load->view('template/scriptes'); ?>

<script>
    var tableJurnal;
    $(document).ready(function() {
        tableJurnal = $('#tableJurnal').DataTable({
            "responsive": true,
            "processing": true,
            "serverSide": true,
            "autoWidth": false,
            "order": [],
            "ajax": {
                "url": "<?= base_url('dashboard/view_jurnal'); ?>",
                "type": "POST",
                "data": function(data) {
                    data.id_domain = "<?= $id_domain; ?>";
                }
            },
            "columns": [{
                    "data": "no",
                    "className": "text-center align-middle"
                },
                {
                    "data": "title",
                    "className": "align-middle"
                },
                {
                    "data": "authors",
                    "className": "align-middle"
                },
                {
                    "data": "issn",
                    "className": "text-center align-middle"
                },
                {
                    "data": "subject",
                    "className": "text-center align-middle"
                },
                {
                    "data": "publication_date",
                    "className": "text-center align-middle"
                },
                {
                    "data": "aksi",
                    "orderable": false,
                    "searchable": false,
                    "className": "text-center align-middle"
                }
            ]
        });

        // Event Klik Tombol Tambah Jurnal
        $('#btnAddJurnal').on('click', function() {
            $.ajax({
                url: "<?= base_url('dashboard/addJournal/insert'); ?>",
                type: "POST",
                data: {
                    id_domain: "<?= $id_domain; ?>"
                },
                beforeSend: function() {
                    $('#modalAction').html(`
                        <div class="modal-body text-center p-5">
                            <i class="fas fa-spinner fa-spin fa-2x text-primary"></i>
                            <p class="mt-2 mb-0">Memuat form...</p>
                        </div>
                    `);
                    $('#modal-xl').modal('show');
                },
                success: function(response) {
                    $('#modalAction').html(response);
                },
                error: function() {
                    $('#modalAction').html(`
                        <div class="modal-body text-center p-4 text-danger">
                            <i class="fas fa-exclamation-triangle fa-2x mb-2"></i>
                            <p>Gagal memuat form tambah jurnal.</p>
                        </div>
                    `);
                }
            });
        });

        // Event Klik Tombol Edit/Update Jurnal
        $('#tableJurnal').on('click', '.btn-update', function() {
            let id = $(this).data('id');

            $.ajax({
                url: "<?= base_url('dashboard/addJournal/update'); ?>",
                type: "POST",
                data: {
                    id: id,
                    id_domain: "<?= $id_domain; ?>"
                },
                beforeSend: function() {
                    $('#modalAction').html(`
                        <div class="modal-body text-center p-5">
                            <i class="fas fa-spinner fa-spin fa-2x text-primary"></i>
                            <p class="mt-2 mb-0">Memuat form edit...</p>
                        </div>
                    `);
                    $('#modal-xl').modal('show');
                },
                success: function(response) {
                    $('#modalAction').html(response);
                },
                error: function() {
                    $('#modalAction').html(`
                        <div class="modal-body text-center p-4 text-danger">
                            <i class="fas fa-exclamation-triangle fa-2x mb-2"></i>
                            <p>Gagal memuat form edit jurnal.</p>
                        </div>
                    `);
                }
            });
        });

        // Event Klik Tombol Delete Jurnal dengan Konfirmasi SweetAlert
        $('#tableJurnal').on('click', '.btn-delete', function() {
            let id = $(this).data('id');

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data jurnal yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "<?= base_url('dashboard/addJurnalAction/delete'); ?>",
                        type: "POST",
                        data: {
                            id: id,
                            id_domain: "<?= $id_domain; ?>"
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.status === 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Terhapus!',
                                    text: response.message,
                                    timer: 1500,
                                    showConfirmButton: false
                                });
                                tableJurnal.ajax.reload(null, false);
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal!',
                                    text: response.message
                                });
                            }
                        },
                        error: function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Server Error',
                                text: 'Terjadi kesalahan saat menghapus data.'
                            });
                        }
                    });
                }
            });
        });

    });
</script>