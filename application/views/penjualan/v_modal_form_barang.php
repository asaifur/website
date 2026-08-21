<?php
$action = isset($action) ? $action : 'insert';
$readonly = '';
if ($action == "view") {
    $readonly = "readonly disabled";
}

// Menentukan warna background header berdasarkan aksi
$header_bg = 'bg-success';
if ($action == 'update') {
    $header_bg = 'bg-warning';
}
if ($action == 'view') {
    $header_bg = 'bg-info';
}
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.26.17/dist/sweetalert2.min.css">

<div class="modal-header <?= $header_bg; ?> text-white">
    <h5 class="modal-title" style="text-transform: capitalize;"><i class="fas fa-boxes"></i> <?= $action; ?> Data Master Barang </h5>
    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
        <span>&times;</span>
    </button>
</div>

<form id="form-master-barang-dinamis" enctype="multipart/form-data">
    <div class="modal-body" style="max-height: calc(100vh - 200px); overflow-y: auto;">
        <div class="row">

            <?php
            foreach ($format_master_barang as $kolom):

                $value = isset($dtKolom->{$kolom->code})
                    ? $dtKolom->{$kolom->code}
                    : "";

            ?>
                <?php if ($kolom->type == "hidden"): ?>
                    <input type="hidden" value="<?= $value; ?>" name="<?= $kolom->code ?>" id="<?= $kolom->code ?>">
                <?php endif; ?> <!-- Menutup tag if -->

                <?php if ($kolom->type == "text"): ?>
                    <div class="col-md-<?= $kolom->col ?>">
                        <div class="form-group">
                            <label for="<?= $kolom->code ?>"><?= $kolom->name ?></label>
                            <input type="text" class="form-control" value="<?= $value; ?>" name="<?= $kolom->code ?>" id="<?= $kolom->code ?>" <?= $readonly; ?>>
                        </div>
                    </div>
                <?php endif; ?> <!-- Menutup tag if -->
                <?php if ($kolom->type == "number"): ?>
                    <div class="col-md-<?= $kolom->col ?>">
                        <div class="form-group">
                            <label for="<?= $kolom->code ?>"><?= $kolom->name ?></label>
                            <input type="number" class="form-control" value="<?= $value; ?>" name="<?= $kolom->code ?>" id="<?= $kolom->code ?>" <?= $readonly; ?>>
                        </div>
                    </div>
                <?php endif; ?> <!-- Menutup tag if -->
                <?php if ($kolom->type == "textarea"): ?>
                    <div class="col-md-<?= $kolom->col ?>">
                        <div class="form-group">
                            <label for="<?= $kolom->code ?>"><?= $kolom->name ?></label>
                            <textarea class="form-control" name="<?= $kolom->code ?>" id="<?= $kolom->code ?>" <?= $readonly; ?>><?= $value; ?></textarea>
                        </div>
                    </div>
                <?php endif; ?> <!-- Menutup tag if -->
                <?php if ($kolom->type == "select"): ?>
                    <div class="col-md-<?= $kolom->col ?>">
                        <div class="form-group">
                            <label for="<?= $kolom->code ?>"><?= $kolom->name ?></label>
                            <select class="form-control" name="<?= $kolom->code ?>" id="<?= $kolom->code ?>" <?= $readonly; ?>>
                                <?php foreach ($kolom->options as $option): ?>
                                    <option value="<?= $option['value'] ?>" <?= ($value == $option['value']) ? 'selected' : ''; ?>><?= $option['label'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                <?php endif; ?> <!-- Menutup tag if -->

                <?php if ($kolom->type == "file"): ?>
                    <div class="col-md-<?= $kolom->col ?>">
                        <div class="form-group">
                            <label for="<?= $kolom->code ?>"><?= $kolom->name ?></label>
                            <input type="file" class="form-control-file" name="<?= $kolom->code ?>" id="<?= $kolom->code ?>" <?= $readonly; ?>>
                            <?php if (!empty($value)): ?>
                                <small>File saat ini: <a href="<?= base_url('uploads/' . $value); ?>" target="_blank"><?= $value; ?></a></small>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?> <!-- Menutup tag if -->

                <?php if ($kolom->type == "date"): ?>
                    <div class="col-md-<?= $kolom->col ?>">
                        <div class="form-group">
                            <label for="<?= $kolom->code ?>"><?= $kolom->name ?></label>
                            <input type="date" class="form-control" value="<?= $value; ?>" name="<?= $kolom->code ?>" id="<?= $kolom->code ?>" <?= $readonly; ?>>
                        </div>
                    </div>
                <?php endif; ?> <!-- Menutup tag if -->
                <?php if ($kolom->type == "datetime"): ?>
                    <div class="col-md-<?= $kolom->col ?>">
                        <div class="form-group">
                            <label for="<?= $kolom->code ?>"><?= $kolom->name ?></label>
                            <input type="datetime-local" class="form-control" value="<?= $value; ?>" name="<?= $kolom->code ?>" id="<?= $kolom->code ?>" <?= $readonly; ?>>
                        </div>
                    </div>
                <?php endif; ?> <!-- Menutup tag if -->
                <?php if ($kolom->type == "checkbox"): ?>
                    <div class="col-md-<?= $kolom->col ?>">
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" name="<?= $kolom->code ?>" id="<?= $kolom->code ?>" value="1" <?= ($value) ? 'checked' : ''; ?> <?= $readonly; ?>>
                            <label class="form-check-label" for="<?= $kolom->code ?>"><?= $kolom->name ?></label>
                        </div>
                    </div>
                <?php endif; ?> <!-- Menutup tag if -->
                <?php if ($kolom->type == "radio"): ?>
                    <div class="col-md-<?= $kolom->col ?>">
                        <div class="form-group">
                            <label><?= $kolom->name ?></label><br>
                            <?php foreach ($kolom->options as $option): ?>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="<?= $kolom->code ?>" id="<?= $kolom->code . '_' . $option['value'] ?>" value="<?= $option['value'] ?>" <?= ($value == $option['value']) ? 'checked' : ''; ?> <?= $readonly; ?>>
                                    <label class="form-check-label" for="<?= $kolom->code . '_' . $option['value'] ?>"><?= $option['label'] ?></label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?> <!-- Menutup tag if -->

                <?php if ($kolom->type == "color"): ?>
                    <div class="col-md-<?= $kolom->col ?>">
                        <div class="form-group">
                            <label for="<?= $kolom->code ?>"><?= $kolom->name ?></label>
                            <input type="color" class="form-control" value="<?= $value; ?>" name="<?= $kolom->code ?>" id="<?= $kolom->code ?>" <?= $readonly; ?>>
                        </div>
                    </div>
                <?php endif; ?> <!-- Menutup tag if -->
                <?php if ($kolom->type == "RST"): ?>
                    <div class="col-md-<?= $kolom->col ?>">
                        <div class="form-group">
                            <label for="<?= $kolom->code ?>"><?= $kolom->name ?></label>
                            <input type="url" class="form-control" value="<?= $value; ?>" name="<?= $kolom->code ?>" id="<?= $kolom->code ?>" <?= $readonly; ?>>
                        </div>
                    </div>
                <?php endif; ?> <!-- Menutup tag if -->

                <div class="col-md-<?= $kolom->col ?>">
                    <div class="form-group">
                        <label for="<?= $kolom->code ?>"><?= $kolom->name ?></label>
                        <input type="url" class="form-control" value="<?= $value; ?>" name="<?= $kolom->code ?>" id="<?= $kolom->code ?>" <?= $readonly; ?>>
                    </div>
                </div>
                <?php if ($kolom->type == "RSH"): ?>
                    <input type="hidden" class="form-control" value="<?= $value; ?>" name="<?= $kolom->code ?>" id="<?= $kolom->code ?>" <?= $readonly; ?>>

                <?php endif; ?>
            <?php endforeach; ?> <!-- Menutup tag foreach -->

        </div>
    </div>
</form>