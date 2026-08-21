<section class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="col-12">
                <div class="card card-primary">

                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-bars"></i> Data Menu Pages
                        </h3>

                        <div class="card-tools">
                            <button class="btn btn-sm btn-success"
                                id="btnTambahMenu">
                                <i class="fas fa-plus"></i> Tambah Pages
                            </button>
                        </div>
                    </div>

                    <div class="card-body table-responsive">

                        <table id="myTable"
                            class="table table-bordered table-striped table-hover">

                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Page ID</th>
                                    <th>Nama Title</th>
                                    <th>Slug</th>
                                    <th>Meta Title</th>
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
    </div>
</section>

<div class="modal fade" id="modalContent">
    <div class="modal-dialog modal-xl">
        <div class="modal-content" id="isiModalContent">
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<?php $this->load->view('template/scriptes'); ?>


<script>
    $(document).ready(function() {

        tableTransaksi = $('#myTable').DataTable({
            "scrollX": true,
            "processing": true,
            "autoWidth": false,
            "serverSide": true,
            "order": [],

            ajax: {
                url: "<?= base_url('Dashboard/view_pages'); ?>",
                type: "POST",
                data: function(d) {

                    d.id_domain = "<?= $domain['id'] ?>"
                }
            },

            "columns": [{
                    "data": "id_page",
                    "render": function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    "data": "id_page",
                },
                {
                    "data": "title",
                },
                {
                    "data": "slug",
                },
                {
                    "data": "meta_title",
                },
                {
                    "data": "status",
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

        $('#myTable').on('click', '.btn-update', function(e) {
            e.preventDefault();

            let id = $(this).data('id');

            $.ajax({
                url: "<?= base_url('Dashboard/addTambahPages/update/'); ?>" + id,
                type: "GET",

                beforeSend: function() {

                    $('#modalContent').modal('show');

                    $('#isiModalContent').html(`
                <div class="modal-body text-center p-5">
                    <i class="fas fa-spinner fa-spin fa-2x"></i>
                    <p class="mt-2">Loading...</p>
                </div>
            `);

                },

                success: function(response) {

                    $('#isiModalContent').html(response);

                },

                error: function() {

                    $('#isiModalContent').html(`
                <div class="modal-body text-center text-danger p-4">
                    <i class="fas fa-exclamation-triangle fa-2x"></i>
                    <p class="mt-2">Gagal memuat data</p>
                </div>
            `);

                }

            });

        });
        $('#myTable').on('click', '.btn-delete', function(e) {
            e.preventDefault();

            let id = $(this).data('id');

            $.ajax({
                url: "<?= base_url('Dashboard/addTambahPages/delete/'); ?>" + id,
                type: "GET",

                beforeSend: function() {

                    $('#modalContent').modal('show');

                    $('#isiModalContent').html(`
                <div class="modal-body text-center p-5">
                    <i class="fas fa-spinner fa-spin fa-2x"></i>
                    <p class="mt-2">Loading...</p>
                </div>
            `);

                },

                success: function(response) {

                    $('#isiModalContent').html(response);

                },

                error: function() {

                    $('#isiModalContent').html(`
                <div class="modal-body text-center text-danger p-4">
                    <i class="fas fa-exclamation-triangle fa-2x"></i>
                    <p class="mt-2">Gagal memuat data</p>
                </div>
            `);

                }

            });

        });

        $('#btnTambahMenu').on('click', function(e) {
            e.preventDefault();

            $.ajax({
                url: "<?= base_url('Dashboard/addTambahPages/insert'); ?>",
                type: "GET",
                beforeSend: function() {
                    $('#modalContent').modal('show');
                    $('#isiModalContent').html(`
                <div class="modal-body text-center p-5">
                    <i class="fas fa-spinner fa-spin"></i> Loading...
                </div>
            `);
                },
                success: function(response) {
                    $('#isiModalContent').html(response);
                },
                error: function() {
                    $('#isiModalContent').html(`
                <div class="modal-body text-center text-danger">
                    Gagal memuat data
                </div>
            `);
                }
            });

        });
    });
</script>