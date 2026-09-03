<div class="card">
    <div class="card-header">
        <h4> Table <?= $title ?></h4>
    </div>
    <div class="card-body">

        <table class="table table-striped table-bordered" id="myTable">
            <thead>
                <tr>
                    <th> No. </th>
                    <th> Nama User </th>
                    <th> Email</th>
                    <th> No Telepon</th>
                    <th> Aksi </th>
                </tr>
            </thead>


            <tbody></tbody>
        </table>
    </div>
</div>


<div class="modal fade" id="modal-xl">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-content" id="modalAction">
                <!-- AJAX CONTENT -->
            </div>
        </div>
    </div>
</div>


<?php $this->load->view('template/scriptes.php') ?>
<script>
    $(document).ready(function() {


        // Mengubah input menjadi uppercase saat user mengetik
        $('input[type="text"]').on('input', function() {
            this.value = this.value.toUpperCase();
        });

        // Jika Anda ingin mengecualikan email (email biasanya lowercase)
        $('input[type="email"]').on('input', function() {
            this.value = this.value.toLowerCase();
        });
        // 1. Inisialisasi DataTable
        var tableTransaksi; // Gunakan satu nama variabel yang konsisten

        tableTransaksi = $('#myTable').DataTable({
            "scrollX": true,
            "processing": true,
            "autoWidth": false,
            "serverSide": true,
            "order": [],
            "paging": true,
            "pageLength": 10,
            "lengthChange": false,
            "searching": true,
            "info": true,
            "ajax": {
                "url": "<?= base_url('dashboard/view_all_user_access'); ?>",
                "type": "POST",
                "data": function(data) {
                    // Parameter tambahan jika diperlukan oleh backend
                    data.id_domain = "<?= isset($domain['id']) ? $domain['id'] : 1; ?>";
                }
            },
            "columns": [{
                    "data": "id_users",
                    "render": function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    "data": "username"
                },
                {
                    "data": "email"
                },
                {
                    "data": "noTelepon"
                },
                {
                    "data": "aksi",
                    "orderable": false,
                    "searchable": false
                }
            ]
        });
        $('#myTable').on('click', '.btn-view', function() {
            let id = $(this).data('id');

            $.ajax({
                url: "<?= base_url('Dashboard/addMasterAkses/'); ?>",
                type: "POST",
                data: {
                    id: id,
                    action: 'view'
                },
                beforeSend: function() {
                    $('#modalAction').html(`
                <div class="modal-body text-center p-5">
                    <i class="fas fa-spinner fa-spin fa-2x"></i>
                    <p>Loading...</p>
                </div>
            `);
                    $('#modal-xl').modal('show');
                },
                success: function(response) {
                    $('#modalAction').html(response);
                },
                error: function() {
                    alert('Gagal memuat form');
                }
            });

        })
        $('#myTable').on('click', '.btn-update-akses', function() {
            let id = $(this).data('id');

            $.ajax({
                url: "<?= base_url('Dashboard/addMasterAkses/update'); ?>",
                type: "POST",
                data: {
                    id: id
                },
                beforeSend: function() {
                    $('#modalAction').html(`
                <div class="modal-body text-center p-5">
                    <i class="fas fa-spinner fa-spin fa-2x"></i>
                    <p>Loading...</p>
                </div>
            `);
                    $('#modal-xl').modal('show');
                },
                success: function(response) {
                    $('#modalAction').html(response);
                },
                error: function() {
                    alert('Gagal memuat form');
                }
            });

        })
        $('#myTable').on('click', '.btn-update', function() {
            let id = $(this).data('id');

            $.ajax({
                url: "<?= base_url('Dashboard/addMasterAkses/update'); ?>",
                type: "POST",
                data: {
                    id: id
                },
                beforeSend: function() {
                    $('#modalAction').html(`
                <div class="modal-body text-center p-5">
                    <i class="fas fa-spinner fa-spin fa-2x"></i>
                    <p>Loading...</p>
                </div>
            `);
                    $('#modal-xl').modal('show');
                },
                success: function(response) {
                    $('#modalAction').html(response);
                },
                error: function() {
                    alert('Gagal memuat form');
                }
            });
        });


    });
</script>