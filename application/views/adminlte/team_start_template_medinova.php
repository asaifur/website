<section class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="col-12">
                <div class="card card-primary">

                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-bars"></i> Data <?= $title ?>
                        </h3>

                        <div class="card-tools d-flex">

                            <select id="filterPage" class="form-control form-control-sm mr-2" style="width:200px;">
                                <option value="">Semua Page</option>
                                <?php foreach ($list_page as $row): ?>
                                    <option value="<?= $row->slug ?>"><?= $row->slug ?></option>
                                <?php endforeach; ?>
                            </select>

                            <button class="btn btn-sm btn-success" id="btnTambahContent">
                                <i class="fas fa-plus"></i> Tambah <?= $title ?>
                            </button>

                        </div>
                    </div>

                    <div class="card-body table-responsive">

                        <table id="myTable"
                            class="table table-bordered table-striped table-hover">

                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>title</th>
                                    <th>subtitle</th>
                                    <th>id_domain</th>
                                    <th>content_page_id</th>
                                    <th>name_team</th>
                                    <th>image_team</th>
                                    <th>subtitle_name_team</th>
                                    <th>content</th>
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
        $('#filterPage').change(function() {
            tableTransaksi.ajax.reload();
        });
        tableTransaksi = $('#myTable').DataTable({
            "scrollX": true,
            "processing": true,
            "autoWidth": false,
            "serverSide": true,
            "order": [],

            ajax: {
                url: "<?= base_url('Dashboard/view_contents_team_start'); ?>",
                type: "POST",
                data: function(d) {

                    d.page_id = $('#filterPage').val();

                }
            },

            "columns": [{
                    "data": "id",
                    "render": function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    "data": "page_id",
                },
                {
                    "data": "title",
                },
                {
                    "data": "subtitle",
                },
                {
                    "data": "content",
                },
                {
                    "data": "image",
                },
                {
                    "data": "section",
                },
                {
                    "data": "urutan",
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

        $('#myTable').on('click', '.btn-update', function(e) {
            e.preventDefault();

            let id = $(this).data('id');

            $.ajax({
                url: "<?= base_url('Dashboard/addTambahContent/update/'); ?>" + id,
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
                url: "<?= base_url('Dashboard/addTambahContent/delete/'); ?>" + id,
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

        $('#btnTambahContent').on('click', function(e) {
            e.preventDefault();

            $.ajax({
                url: "<?= base_url('Dashboard/addTambahContentTeamStartMedinova/insert'); ?>",
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