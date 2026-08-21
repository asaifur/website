<section class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">

                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Profile & Meta Domain</h3>
                    </div>

                    <form action="<?= base_url('admin/domain/update') ?>" method="post" enctype="multipart/form-data">

                        <div class="card-body">

                            <!-- ===== DATA DOMAIN ===== -->
                            <h5 class="mb-3 text-primary">Informasi Domain</h5>

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama Domain</label>
                                        <input type="text" name="nama_domain" class="form-control"
                                            value="<?= $domain->nama_domain ?>" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>URL Domain</label>
                                        <input type="text" name="url_domain" class="form-control"
                                            value="<?= $domain->url_domain ?>" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" name="email" class="form-control"
                                            value="<?= $domain->email ?>">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Telepon</label>
                                        <input type="text" name="telepon" class="form-control"
                                            value="<?= $domain->telepon ?>">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Alamat</label>
                                        <textarea name="alamat" class="form-control"><?= $domain->alamat ?></textarea>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>WhatsApp Link</label>
                                        <input type="text" name="wa_link" class="form-control"
                                            value="<?= $domain->wa_link ?>">
                                    </div>
                                </div>

                            </div>

                            <hr>

                            <!-- ===== LOGO & IMAGE ===== -->
                            <h5 class="mb-3 text-primary">Logo & Image</h5>

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Logo</label>
                                        <input type="file" name="logo" class="form-control">

                                        <img src="<?= base_url('uploads/domain/' . $domain->logo) ?>"
                                            width="120" class="mt-2">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Image OG / Favicon</label>
                                        <input type="file" name="image_domain" class="form-control">

                                        <img src="<?= base_url('uploads/domain/' . $domain->image_domain) ?>"
                                            width="120" class="mt-2">
                                    </div>
                                </div>

                            </div>

                            <hr>

                            <!-- ===== SEO META ===== -->
                            <h5 class="mb-3 text-primary">SEO Meta</h5>

                            <div class="form-group">
                                <label>Meta Title</label>
                                <input type="text" name="meta_title" class="form-control"
                                    value="<?= $domain->meta_title ?>">
                            </div>

                            <div class="form-group">
                                <label>Meta Description</label>
                                <textarea name="meta_description" class="form-control"
                                    rows="3"><?= $domain->meta_description ?></textarea>
                            </div>

                            <div class="form-group">
                                <label>Meta Keywords</label>
                                <textarea name="meta_keywords" class="form-control"
                                    rows="2"><?= $domain->meta_keywords ?></textarea>
                            </div>

                            <div class="form-group">
                                <label>Meta Author</label>
                                <input type="text" name="meta_author" class="form-control"
                                    value="<?= $domain->meta_author ?>">
                            </div>

                            <div class="form-group">
                                <label>Google Site Verification</label>
                                <input type="text" name="meta_google_site_verification"
                                    class="form-control"
                                    value="<?= $domain->meta_google_site_verification ?>">
                            </div>

                            <hr>

                            <!-- ===== GEO TAG ===== -->
                            <h5 class="mb-3 text-primary">Geo Location</h5>

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Geo Position</label>
                                        <input type="text" name="geo_position" class="form-control"
                                            value="<?= $domain->geo_position ?>">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Geo Placename</label>
                                        <input type="text" name="geo_placename" class="form-control"
                                            value="<?= $domain->geo_placename ?>">
                                    </div>
                                </div>

                            </div>

                            <hr>

                            <!-- ===== STATUS ===== -->
                            <div class="form-group">
                                <label>Status Domain</label>
                                <select name="is_active" class="form-control">
                                    <option value="1" <?= $domain->is_active == 1 ? 'selected' : '' ?>>Active</option>
                                    <option value="0" <?= $domain->is_active == 0 ? 'selected' : '' ?>>Non Active</option>
                                </select>
                            </div>

                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan Profile
                            </button>
                        </div>

                    </form>

                </div>

            </div>
        </div>
    </div>
</section>