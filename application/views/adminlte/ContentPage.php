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
                                <?php foreach ($list_page as $row):  ?>
                                    <option value="<?= $row->id_page ?>"><?= $row->slug ?></option>
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
                                    <th>Page Id</th>
                                    <th>Title</th>
                                    <th>Span</th>
                                    <th>Subtitle</th>
                                    <th>Content</th>
                                    <th>Image</th>
                                    <th>Section</th>
                                    <th>Urutan</th>
                                    <th>Aktif</th>
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
        // 1. Inisialisasi DataTable Server-Side
        let tableTransaksi = $('#myTable').DataTable({
            "scrollX": true,
            "processing": true,
            "autoWidth": false,
            "serverSide": true,
            "searching": false,
            "order": [
                [8, "asc"]
            ],
            "ajax": {
                "url": "<?= base_url('Dashboard/view_contents'); ?>",
                "type": "POST",
                "data": function(d) {
                    d.page_id = $('#filterPage').val();
                }
            },
            "columns": [{
                    "data": "id",
                    "render": (data, type, row, meta) => meta.row + meta.settings._iDisplayStart + 1
                },
                {
                    "data": "page_id"
                },
                {
                    "data": "title"
                },
                {
                    "data": "span"
                },
                {
                    "data": "subtitle"
                },
                {
                    "data": "content"
                },
                {
                    "data": "image"
                },
                {
                    "data": "section"
                },
                {
                    "data": "urutan"
                },
                {
                    "data": "is_active",
                    "render": (data) => (data == 1) ?
                        '<span class="badge badge-success">Aktif</span>' : '<span class="badge badge-danger">Nonaktif</span>'
                },
                {
                    "data": "aksi"
                }
            ]
        });

        // 2. Filter Page Event
        $('#filterPage').change(function() {
            tableTransaksi.ajax.reload();
        });

        // 3. Modal Tambah Section
        $('#btnTambahContent').on('click', function(e) {
            e.preventDefault();
            $('#modalContent').modal('show');
            $('#isiModalContent').html('<div class="p-5 text-center"><i class="fas fa-spinner fa-spin fa-2x"></i></div>');

            $.get("<?= base_url('Dashboard/addTambahContent/insert'); ?>", function(res) {
                $('#isiModalContent').html(res);
            });
        });

        // 4. Modal Edit Section
        $('#myTable').on('click', '.btn-update', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            $('#modalContent').modal('show');
            $('#isiModalContent').html('<div class="p-5 text-center"><i class="fas fa-spinner fa-spin fa-2x"></i></div>');

            $.get("<?= base_url('Dashboard/addTambahContent/update/'); ?>" + id, function(res) {
                $('#isiModalContent').html(res);
            });
        });

        // 5. Submit Form AJAX (Insert / Update)
        $(document).on('submit', '#formContentSection', function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            let btn = $('#btnSaveSubmit');

            btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Menyimpan...');

            $.ajax({
                url: "<?= base_url('Dashboard/save_content'); ?>",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(response) {
                    btn.prop('disabled', false).html('<i class="fas fa-save mr-1"></i> Simpan Section');
                    if (response.status === 'success') {
                        $('#modalContent').modal('hide');
                        tableTransaksi.ajax.reload(null, false);
                    } else {
                        alert(response.message);
                    }
                },
                error: function() {
                    btn.prop('disabled', false).html('<i class="fas fa-save mr-1"></i> Simpan Section');
                    alert('Terjadi kesalahan server saat menyimpan data.');
                }
            });
        });

        // 6. Modal Hapus Section
        $('#myTable').on('click', '.btn-delete', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            $('#modalContent').modal('show');
            $('#isiModalContent').html('<div class="p-5 text-center"><i class="fas fa-spinner fa-spin fa-2x"></i></div>');

            $.get("<?= base_url('Dashboard/addTambahContent/delete/'); ?>" + id, function(res) {
                $('#isiModalContent').html(res);
            });
        });

        // 7. Eksekusi Hapus AJAX
        $(document).on('click', '#btnConfirmDelete', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            let btn = $(this);

            btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Menghapus...');

            $.getJSON("<?= base_url('Dashboard/execute_delete/'); ?>" + id, function(res) {
                $('#modalContent').modal('hide');
                tableTransaksi.ajax.reload(null, false);
            });
        });
    });
</script>