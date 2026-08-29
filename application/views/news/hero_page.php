<?php
$payload = !empty($section->data_payload) ? (is_array($section->data_payload) ? $section->data_payload : json_decode($section->data_payload, true)) : [];

$dom_id   = !empty($section->span) ? $section->span : 'header-page';
$title    = !empty($section->title) ? $section->title : 'Judul Halaman';
$content  = !empty($section->content) ? $section->content : '';
$bg_img   = !empty($section->image) ? (filter_var($section->image, FILTER_VALIDATE_URL) ? $section->image : base_url('assets/uploads/img/' . $section->image)) : base_url('assets/news/assets/img/trending/trending_top2.jpg');

$breadcrumbs = $payload['breadcrumbs'] ?? [];
$subtitle    = !empty($section->subtitle) ? $section->subtitle : 'Informasi Terbaru';
?>

<!-- Trending Area / Hero Page Dynamic Start -->
<div class="trending-area fix pt-25 pb-30 gray-bg" id="<?= htmlspecialchars($dom_id); ?>">
    <div class="container">
        <!-- Breadcrumbs bar opsional jika ada di payload -->
        <?php if (!empty($breadcrumbs) && is_array($breadcrumbs)): ?>
            <div class="row mb-3">
                <div class="col-xl-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent p-0 m-0">
                            <?php foreach ($breadcrumbs as $idx => $bc): ?>
                                <li class="breadcrumb-item <?= ($idx == count($breadcrumbs) - 1) ? 'active' : ''; ?>">
                                    <?php if (!empty($bc['url']) && $idx < count($breadcrumbs) - 1): ?>
                                        <a href="<?= htmlspecialchars($bc['url']); ?>" class="text-primary"><?= htmlspecialchars($bc['label']); ?></a>
                                    <?php else: ?>
                                        <span><?= htmlspecialchars($bc['label']); ?></span>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                        </ol>
                    </nav>
                </div>
            </div>
        <?php endif; ?>

        <div class="trending-main">
            <div class="row">
                <!-- Kolom Utama Slider / Hero Banner -->
                <div class="col-lg-8">
                    <div class="slider-active">
                        <div class="single-slider">
                            <div class="trending-top mb-30">
                                <div class="trend-top-img" style="position: relative; overflow: hidden; border-radius: 8px;">
                                    <img src="<?= htmlspecialchars($bg_img); ?>" alt="<?= htmlspecialchars($title); ?>" style="width: 100%; height: 420px; object-fit: cover;">
                                    <div class="trend-top-cap" style="background: linear-gradient(to top, rgba(0,0,0,0.85) 0%, rgba(0,0,0,0.4) 60%, transparent 100%); position: absolute; bottom: 0; left: 0; right: 0; padding: 30px;">
                                        <span class="bgr bg-primary" data-animation="fadeInUp" data-delay=".2s" data-duration="1000ms" style="padding: 4px 12px; font-size: 11px; font-weight: bold; text-transform: uppercase; border-radius: 4px; color: #fff; background-color: var(--primary, #b91c1c); display: inline-block; margin-bottom: 10px;">
                                            <?= htmlspecialchars($subtitle); ?>
                                        </span>
                                        <h2 style="margin-bottom: 10px;">
                                            <a href="#" data-animation="fadeInUp" data-delay=".4s" data-duration="1000ms" style="color: #ffffff; text-decoration: none; font-size: 24px; line-height: 1.3; font-weight: 800;">
                                                <?= htmlspecialchars($title); ?>
                                            </a>
                                        </h2>
                                        <?php if (!empty($content)): ?>
                                            <p data-animation="fadeInUp" data-delay=".6s" data-duration="1000ms" style="color: #cbd5e1; font-size: 14px; margin: 0; line-height: 1.5;">
                                                <?= strip_tags($content); ?>
                                            </p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Side Content / Informasi Pendukung -->
                <div class="col-lg-4">
                    <div class="row">
                        <!-- Sisi Kanan 1 -->
                        <div class="col-lg-12 col-md-6 col-sm-6">
                            <div class="trending-top mb-30">
                                <div class="trend-top-img" style="position: relative; overflow: hidden; border-radius: 8px;">
                                    <img src="<?= base_url('assets/news/') ?>assets/img/trending/trending_top3.jpg" alt="Featured Article" style="width: 100%; height: 195px; object-fit: cover;">
                                    <div class="trend-top-cap trend-top-cap2" style="position: absolute; bottom: 0; left: 0; right: 0; padding: 20px; background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);">
                                        <span class="bgb" style="background: #2563eb; color: #fff; padding: 2px 8px; font-size: 10px; border-radius: 3px; font-weight: bold;">STANDAR K3</span>
                                        <h2 style="font-size: 16px; margin: 6px 0 4px 0;">
                                            <a href="#" style="color: #fff; text-decoration: none;">Instalasi Pipa Gas Komersial SNI & Keamanan Dapur</a>
                                        </h2>
                                        <p style="font-size: 11px; color: #94a3b8; margin: 0;">Solusi Dapur Restoran</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Sisi Kanan 2 -->
                        <div class="col-lg-12 col-md-6 col-sm-6">
                            <div class="trending-top mb-30">
                                <div class="trend-top-img" style="position: relative; overflow: hidden; border-radius: 8px;">
                                    <img src="<?= base_url('assets/news/') ?>assets/img/trending/trending_top4.jpg" alt="Featured Article" style="width: 100%; height: 195px; object-fit: cover;">
                                    <div class="trend-top-cap trend-top-cap2" style="position: absolute; bottom: 0; left: 0; right: 0; padding: 20px; background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);">
                                        <span class="bgg" style="background: #059669; color: #fff; padding: 2px 8px; font-size: 10px; border-radius: 3px; font-weight: bold;">FABRIKASI</span>
                                        <h2 style="font-size: 16px; margin: 6px 0 4px 0;">
                                            <a href="#" style="color: #fff; text-decoration: none;">Tren Desain Dapur Stainless Steel Anti Karat Modern</a>
                                        </h2>
                                        <p style="font-size: 11px; color: #94a3b8; margin: 0;">Kitchen Tools Indonesia</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Trending Area End -->