<section class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="col-12">
                <div class="card card-primary">

                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-bars"></i> Data <?= $title ?>
                        </h3>

                        <div class="card-tools">
                            <button class="btn btn-sm btn-success"
                                id="btnTambahMenu">
                                <i class="fas fa-plus"></i> Tambah Menu
                            </button>
                        </div>
                    </div>

                    <div class="card-body table-responsive">

                        <table id="myTable"
                            class="table table-bordered table-striped table-hover">

                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Nama Title</th>
                                    <th>Slug</th>
                                    <th>Parent</th>
                                    <th>Status</th>
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
</section>


<!-- Modal Tambah Menu -->
<div class="modal fade" id="modalTambahMenu" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div id="isiModalTambahMenu"></div>
    </div>
</div>

<?php $this->load->view('template/scriptes'); ?>

<script>
    $(document).ready(function() {
        $('#tableMenu').DataTable({
            responsive: true,
            autoWidth: false
        });
    });

    tableTransaksi = $('#myTable').DataTable({
        "scrollX": true,
        "processing": true,
        "autoWidth": false,
        "serverSide": true,
        "order": [],

        ajax: {
            url: "<?= base_url('Dashboard/view_menu'); ?>",
            type: "POST",
            data: function(d) {

                d.id_domain = "<?= $domain['id'] ?>"
            }
        },

        "columns": [{
                "data": "id",
                "render": function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {
                "data": "nama_menu",
            },
            {
                "data": "slug",
            },
            {
                "data": "parent_id",
            },
            {
                "data": "is_active",
                "render": function(data, type, row) {
                    if (data == 1) {
                        return '<span class="badge badge-success">Aktif</span>';
                    } else {
                        return '<span class="badge badge-danger">Tidak Aktif</span>';
                    }
                }
            }, {
                "data": "aksi",
            },
        ]
    });

    $(document).on('click', '#btnTambahMenu', function() {

        $.ajax({
            url: "<?= base_url('Dashboard/form_tambah_menu/insert'); ?>",
            type: "GET",
            beforeSend: function() {
                $('#isiModalTambahMenu').html(`
                <div class="modal-content">
                    <div class="modal-body text-center p-5">
                        <i class="fas fa-spinner fa-spin fa-2x"></i>
                        <p class="mt-2">Loading...</p>
                    </div>
                </div>
            `);
            },
            success: function(response) {
                $('#isiModalTambahMenu').html(response);
                $('#modalTambahMenu').modal('show');
            }
        });

    });

    $('#myTable').on('click', '.btn-delete', function() {
        let id = $(this).data('id');
        $.ajax({
            url: "<?= base_url('Dashboard/form_tambah_menu/delete/'); ?>" + id,
            type: "GET",
            beforeSend: function() {
                $('#isiModalTambahMenu').html(`
                <div class="modal-content">
                    <div class="modal-body text-center p-5">
                        <i class="fas fa-spinner fa-spin fa-2x"></i>
                        <p class="mt-2">Loading...</p>
                    </div>
                </div>
            `);
            },
            success: function(response) {
                $('#isiModalTambahMenu').html(response);
                $('#modalTambahMenu').modal('show');
            }
        });
    })
    $('#myTable').on('click', '.btn-update', function() {
        let id = $(this).data('id');
        $.ajax({
            url: "<?= base_url('Dashboard/form_tambah_menu/update/'); ?>" + id,
            type: "GET",
            beforeSend: function() {
                $('#isiModalTambahMenu').html(`
                <div class="modal-content">
                    <div class="modal-body text-center p-5">
                        <i class="fas fa-spinner fa-spin fa-2x"></i>
                        <p class="mt-2">Loading...</p>
                    </div>
                </div>
            `);
            },
            success: function(response) {
                $('#isiModalTambahMenu').html(response);
                $('#modalTambahMenu').modal('show');
            }
        });
    });
    $(document).on('click', '.btn-delete', function() {
        let id = $(this).data('id');
        $.ajax({
            url: "<?= base_url('Dashboard/form_tambah_menu/delete/'); ?>" + id,
            type: "GET",
            beforeSend: function() {
                $('#isiModalTambahMenu').html(`
                <div class="modal-content">
                    <div class="modal-body text-center p-5">
                        <i class="fas fa-spinner fa-spin fa-2x"></i>
                        <p class="mt-2">Loading...</p>
                    </div>
                </div>
            `);
            },
            success: function(response) {
                $('#isiModalTambahMenu').html(response);
                $('#modalTambahMenu').modal('show');
            }
        });
    });
</script>