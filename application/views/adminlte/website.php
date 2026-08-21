<section class="content">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><?= $title ?></h1>
            </div>
            <div class="col-sm-6 text-right">
                <button class="btn btn-primary" data-toggle="modal" data-target="#modal-add">
                    <i class="fas fa-plus"></i> Tambah Konten
                </button>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= $this->session->flashdata('success'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Daftar Konten Domain: <strong><?= html_escape($domain['url_domain']); ?></strong></h3>
            </div>
            <div class="card-body">
                <table id="tableWebsite" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="25%">Slug Name</th>
                            <th>Content</th>
                            <th width="15%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($websites)): ?>
                            <?php $no = 1;
                            foreach ($websites as $row): ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><code><?= html_escape($row['slugname']); ?></code></td>
                                    <td><?= character_limiter(strip_tags($row['content']), 100); ?></td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-warning btn-edit"
                                            data-id="<?= $row['id']; ?>"
                                            data-slug="<?= html_escape($row['slugname']); ?>"
                                            data-content="<?= htmlspecialchars($row['content'], ENT_QUOTES, 'UTF-8'); ?>">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <a href="<?= base_url('website_delete/' . $row['id']); ?>"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-center text-muted">Belum ada data website untuk domain ini.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<!-- Modal Tambah -->
<div class="modal fade" id="modal-add">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="<?= base_url('dashboard/website_store'); ?>" method="post">
                <input type="hidden" name="id_domain" value="<?= $id_domain; ?>">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Konten Website</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Slug Name</label>
                        <input type="text" name="slugname" class="form-control" placeholder="contoh: tentang-kami" required>
                    </div>
                    <div class="form-group">
                        <label>Content (HTML Code)</label>
                        <textarea name="content" id="add-content" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="modal-edit">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="<?= base_url('dashboard/website_update'); ?>" method="post">
                <input type="hidden" name="id" id="edit-id">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Konten Website</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Slug Name</label>
                        <input type="text" name="slugname" id="edit-slug" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Content (HTML Code)</label>
                        <textarea name="content" id="edit-content" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-warning">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- CodeMirror CSS & Themes -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.16/codemirror.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.16/theme/monokai.min.css">

<?php $this->load->view('template/scriptes'); ?>

<!-- CodeMirror Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.16/codemirror.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.16/mode/xml/xml.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.16/mode/javascript/javascript.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.16/mode/css/css.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.16/mode/htmlmixed/htmlmixed.min.js"></script>

<script>
    $(document).ready(function() {
        // 1. DataTables
        $('#tableWebsite').DataTable({
            "responsive": true,
            "autoWidth": false
        });

        // 2. Opsi Standar CodeMirror
        var cmOptions = {
            lineNumbers: true,
            mode: "htmlmixed",
            theme: "monokai",
            lineWrapping: true,
            indentUnit: 4,
            tabSize: 4
        };

        // 3. Inisialisasi CodeMirror Tambah & Edit
        var editorAdd = CodeMirror.fromTextArea(document.getElementById("add-content"), cmOptions);
        var editorEdit = CodeMirror.fromTextArea(document.getElementById("edit-content"), cmOptions);

        editorAdd.setSize("100%", 350);
        editorEdit.setSize("100%", 350);

        // 4. Refresh CodeMirror saat Modal Terbuka (Mencegah tampilan blank/rusak)
        $('#modal-add').on('shown.bs.modal', function() {
            editorAdd.refresh();
        });

        $('#modal-edit').on('shown.bs.modal', function() {
            editorEdit.refresh();
        });

        // 5. Handle Tombol Edit
        $(document).on('click', '.btn-edit', function() {
            var id = $(this).data('id');
            var slug = $(this).data('slug');
            var content = $(this).data('content');

            $('#edit-id').val(id);
            $('#edit-slug').val(slug);

            editorEdit.setValue(content || '');

            $('#modal-edit').modal('show');
        });

        // 6. Reset Form Tambah saat Modal Ditutup
        $('#modal-add').on('hidden.bs.modal', function() {
            $(this).find('form')[0].reset();
            editorAdd.setValue('');
        });
    });
</script>