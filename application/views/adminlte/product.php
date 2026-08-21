<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-box"></i> Data Produk</h3>
                        <div class="card-tools d-flex">
                            <!-- Filter Status (bisa diganti kategori/brand sesuai kebutuhan) -->
                            <select id="filterStatus" class="form-control form-control-sm mr-2" style="width:160px;">
                                <option value="">Semua Status</option>
                                <option value="active">Active</option>
                                <option value="draft">Draft</option>
                                <option value="out_of_stock">Out of Stock</option>
                                <option value="archived">Archived</option>
                            </select>

                            <button class="btn btn-sm btn-success" id="btnTambahProduct">
                                <i class="fas fa-plus"></i> Tambah Produk
                            </button>
                        </div>
                    </div>

                    <div class="card-body table-responsive">
                        <table id="tableProduct" class="table table-bordered table-striped table-hover" style="width:100%;">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>ID</th>
                                    <th>Nama Produk</th>
                                    <th>SKU</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>Status</th>
                                    <th>Featured</th>
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal Container -->
<div class="modal fade" id="modalProduct">
    <div class="modal-dialog modal-xl">
        <div class="modal-content" id="isiModalProduct"></div>
    </div>
</div>

<?php $this->load->view('template/scriptes'); ?>

<script>
    $(document).ready(function() {
        // Reload saat filter berubah
        $('#filterStatus').change(function() {
            tableProduct.ajax.reload();
        });

        // Inisialisasi DataTables Server-Side
        tableProduct = $('#tableProduct').DataTable({
            "scrollX": true,
            "processing": true,
            "serverSide": true,
            "order": [
                [1, "desc"]
            ], // Default sort by ID DESC
            ajax: {
                url: "<?= base_url('Dashboard/view_products'); ?>",
                type: "POST",
                data: function(d) {
                    d.filter_status = $('#filterStatus').val();
                    d.id_domain = "<?= $id_domain ?? '' ?>";
                }
            },
            columns: [{
                    "data": "id",
                    "render": function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    "data": "id"
                },
                {
                    "data": "name",
                    "render": function(data, type, row) {
                        return `<strong>${data}</strong><br><small class="text-muted">${row.slug || '-'}</small>`;
                    }
                },
                {
                    "data": "sku"
                },
                {
                    "data": "price",
                    "render": function(data, type, row) {
                        let price = Number(data).toLocaleString('id-ID');
                        let html = `Rp ${price}`;
                        if (row.discount_price && row.discount_price > 0) {
                            let disc = Number(row.discount_price).toLocaleString('id-ID');
                            html += ` <span class="text-danger d-block"><small><del>Rp ${disc}</del></small></span>`;
                        }
                        return html;
                    }
                },
                {
                    "data": "stock_quantity",
                    "render": function(data, type, row) {
                        let badge = 'badge-success';
                        let text = data;
                        if (data <= 0) {
                            badge = 'badge-danger';
                            text = 'Habis';
                        } else if (data <= 10) {
                            badge = 'badge-warning';
                        }
                        return `<span class="badge ${badge}">${text}</span>`;
                    }
                },
                {
                    "data": "status",
                    "render": function(data, type, row) {
                        const map = {
                            'active': 'badge-success',
                            'draft': 'badge-secondary',
                            'out_of_stock': 'badge-warning',
                            'archived': 'badge-dark'
                        };
                        const cls = map[data] || 'badge-secondary';
                        const label = data.replace(/_/g, ' ').toUpperCase();
                        return `<span class="badge ${cls}">${label}</span>`;
                    }
                },
                {
                    "data": "is_featured",
                    "render": function(data, type, row) {
                        return data == 1 ? '<span class="badge badge-info">⭐ Ya</span>' : '<span class="text-muted">-</span>';
                    }
                },
                {
                    "data": null,
                    "render": function(data, type, row) {
                        return `
                        <button class="btn btn-sm btn-warning btn-edit" data-id="${row.id}" title="Edit"><i class="fas fa-edit"></i></button>
                        <button class="btn btn-sm btn-danger btn-delete" data-id="${row.id}" title="Hapus"><i class="fas fa-trash"></i></button>
                    `;
                    }
                }
            ]
        });

        // 🔹 Helper: Load Modal via AJAX
        function loadModal(url) {
            $('#modalProduct').modal('show');
            $('#isiModalProduct').html(`
            <div class="modal-body text-center p-5">
                <i class="fas fa-spinner fa-spin fa-2x"></i>
                <p class="mt-2">Memuat data...</p>
            </div>
        `);
            $.get(url, function(res) {
                $('#isiModalProduct').html(res);
            }).fail(function() {
                $('#isiModalProduct').html(`
                <div class="modal-body text-center text-danger p-4">
                    <i class="fas fa-exclamation-triangle fa-2x"></i>
                    <p class="mt-2">Gagal memuat data</p>
                </div>
            `);
            });
        }

        // 🔹 Event Listeners
        $('#btnTambahProduct').on('click', function(e) {
            e.preventDefault();
            loadModal("<?= base_url('Dashboard/add_product/insert'); ?>");
        });

        $('#tableProduct').on('click', '.btn-edit', function(e) {
            e.preventDefault();
            loadModal("<?= base_url('Dashboard/add_product/'); ?>" + $(this).data('id'));
        });

        $('#tableProduct').on('click', '.btn-delete', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            if (confirm('Yakin ingin menghapus produk ini? Data yang dihapus tidak dapat dikembalikan.')) {
                loadModal("<?= base_url('Dashboard/add_product/'); ?>" + id);
            }
        });
    });
</script>