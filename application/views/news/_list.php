<?php if (!empty($news)): ?>
    <?php foreach ($news as $row): ?>
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="<?= base_url('assets/uploads/img/') . $row->image_features ?>" class="card-img-top">
                <div class="card-body">
                    <a href="<?= base_url('') . $row->slug ?>">
                        <h5><?= $row->title ?></h5>
                    </a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <div class="col-12">
        <p>No articles found.</p>
    </div>
<?php endif; ?>