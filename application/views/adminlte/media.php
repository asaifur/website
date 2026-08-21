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
                                id="btnTambahFoto">
                                <i class="fas fa-plus"></i> Tambah <?= $title ?>
                            </button>
                        </div>
                    </div>

                    <div class="card-body table-responsive">

                        <table id="myTable"
                            class="table table-bordered table-striped table-hover">

                            <thead>
                                <tr>
                                    <th width="5%"> No </th>
                                    <th>file_name </th>
                                    <th width="20%">File</th>
                                    <th>ALT TEXT </th>
                                    <th>CAPTION </th>
                                    <th>STATUS </th>
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>
                            </tbody>

                        </table>

                    </div>

                </div>
            </div>

        </div>
    </div>
</section>
<?php $this->load->view('template/scriptes'); ?>

<div class="modal fade" id="modalContent">
    <div class="modal-dialog modal-xl">
        <div class="modal-content" id="isiModalContent">
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script>
    $(document).ready(function() {

        $('#myTable').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?= base_url('Dashboard/view_data_media') ?>",
                "type": "POST",
                data: function(d) {
                    d.id_domain = "<?= $domain['id'] ?>";
                }
            },

            "columns": [{
                    "data": "id",
                    "render": function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },

                {
                    "data": "file_name",
                    "render": function(data, type, row) {

                        if (data) {
                            return '<?= base_url('assets/uploads/img/') ?>' + data;
                        } else {
                            return '-';
                        }

                    }
                },

                {
                    "data": "file_name",
                    "render": function(data) {

                        if (data) {
                            return '<img src="<?= base_url('assets/uploads/img/') ?>' + data + '" class="img-thumbnail" style="width:200%; height:200px; object-fit:cover;">';
                        } else {
                            return '-';
                        }

                    }
                },

                {
                    "data": "alt_text"
                },

                {
                    "data": "caption"
                },

                {
                    "data": "is_active",
                    "render": function(data) {
                        if (data == 1) {
                            return '<span class="badge badge-success">Aktif</span>';
                        } else {
                            return '<span class="badge badge-danger">Tidak Aktif</span>';
                        }
                    }
                },

                {
                    "data": "aksi"
                }
            ]

        });

    });

    $('#btnTambahFoto').on('click', function(e) {
        e.preventDefault();
        $.ajax({
            url: "<?= base_url('Dashboard/addTambahMedia/insert'); ?>",
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
    })
    $('#myTable').on('click', '.btn-delete', function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        $.ajax({
            url: "<?= base_url('Dashboard/addTambahMedia/delete/'); ?>" + id,
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
    })
    $('#myTable').on('click', '.btn-update', function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        $.ajax({
            url: "<?= base_url('Dashboard/addTambahMedia/update/'); ?>" + id,
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
    })
</script>