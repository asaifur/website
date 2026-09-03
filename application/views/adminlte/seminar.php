<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary card-outline shadow-sm">
                    <div class="card-header">
                        <h3 class="card-title font-weight-bold pt-1">Kelola <?= $title; ?></h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-primary btn-sm" id="btnAddEvent">
                                <i class="fas fa-plus mr-1"></i> Tambah Event
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="tableEvent" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr class="text-center">
                                    <th style="width: 5%;">No</th>
                                    <th>Judul Event</th>
                                    <th>Kategori</th>
                                    <th>Pembicara</th>
                                    <th>Tanggal & Waktu</th>
                                    <th>Tipe & Lokasi</th>
                                    <th>Status</th>
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
    var tableEvent;
    $(document).ready(function() {
        tableEvent = $('#tableEvent').DataTable({
            "responsive": true,
            "processing": true,
            "serverSide": true,
            "autoWidth": false,
            "order": [],
            "ajax": {
                "url": "<?= base_url('dashboard/view_seminar'); ?>",
                "type": "POST",
                "data": function(data) {
                    data.id_domain = "<?= isset($id_domain) ? $id_domain : 1; ?>";
                }
            },
            "columns": [{
                    "data": "no",
                    "className": "text-center align-middle"
                },
                {
                    "data": "event_title",
                    "className": "align-middle"
                },
                {
                    "data": "event_category",
                    "className": "text-center align-middle"
                },
                {
                    "data": "speaker_name",
                    "className": "align-middle"
                },
                {
                    "data": "event_date",
                    "className": "text-center align-middle"
                },
                {
                    "data": "event_location",
                    "className": "text-center align-middle"
                },
                {
                    "data": "status",
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

        // Event Klik Tombol Tambah Event
        $('#btnAddEvent').on('click', function() {
            $.ajax({
                url: "<?= base_url('Dashboard/addSeminar/insert'); ?>",
                type: "POST",
                data: {
                    id_domain: "<?= isset($id_domain) ? $id_domain : 1; ?>"
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
                            <p>Gagal memuat form tambah event.</p>
                        </div>
                    `);
                }
            });
        });

        // Event Klik Tombol Edit/Update Event
        $('#tableEvent').on('click', '.btn-update', function() {
            let id = $(this).data('id');

            $.ajax({
                url: "<?= base_url('dashboard/addSeminar/update'); ?>",
                type: "POST",
                data: {
                    id: id,
                    id_domain: "<?= isset($id_domain) ? $id_domain : 1; ?>"
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
                            <p>Gagal memuat form edit event.</p>
                        </div>
                    `);
                }
            });
        });

        // Event Klik Tombol Delete Event dengan Konfirmasi SweetAlert
        $('#tableEvent').on('click', '.btn-delete', function() {
            let id = $(this).data('id');

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data event yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "<?= base_url('dashboard/addSeminarAction/delete'); ?>",
                        type: "POST",
                        data: {
                            id: id,
                            id_domain: "<?= isset($id_domain) ? $id_domain : 1; ?>"
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
                                tableEvent.ajax.reload(null, false);
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