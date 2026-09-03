<?php
$payload = isset($row->data_payload) ? json_decode($row->data_payload) : null;
$bgOverlay = isset($payload->bg_overlay) ? $payload->bg_overlay : 'bg-navy/85';
$btnText = isset($row->btn_text) && !empty($row->btn_text) ? $row->btn_text : 'Gabung Sekarang';
$btnUrl = isset($row->btn_url) && !empty($row->btn_url) ? $row->btn_url : '#contact';
$bgImage = isset($row->image) && !empty($row->image) ? base_url($row->image) : base_url('assets/img/gallery/body_card1.png');
?>

<!-- Banner Section Start with Full Screen / Container Overlay -->
<section class="banner-area position-relative overflow-hidden py-5 my-4">
    <div class="container-fluid px-0">
        <div class="banner-wrapper position-relative py-5 text-center" style="background: url('<?= $bgImage; ?>') center/cover no-repeat;">
            <!-- Dark/Color Overlay covering the screen section -->
            <div class="position-absolute inset-0 <?= $bgOverlay; ?> z-10" style="top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(15, 23, 42, 0.85);"></div>
            
            <div class="container position-relative z-20 py-5">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="banner-content text-white">
                            <?php if (!empty($row->subtitle)): ?>
                                <span class="d-block text-uppercase font-weight-bold letter-spacing-2 mb-2 text-warning"><?= $row->subtitle; ?></span>
                            <?php endif; ?>
                            
                            <h2 class="text-white mb-3 font-weight-bold display-5"><?= isset($row->title) ? $row->title : ''; ?></h2>
                            
                            <?php if (!empty($row->content)): ?>
                                <p class="lead mb-4 text-light"><?= $row->content; ?></p>
                            <?php endif; ?>
                            
                            <?php if (!empty($row->btn_text) || !empty($btnText)): ?>
                                <div class="banner-btn">
                                    <a href="<?= $btnUrl; ?>" class="btn btn-primary btn-lg px-4 py-2 font-weight-bold shadow-sm"><?= $btnText; ?></a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Banner Section End -->