<?php
$payload = isset($row->data_payload) ? json_decode($row->data_payload) : null;
$slider_items = isset($payload->slider_items) ? $payload->slider_items : [];
$sidebar_items = isset($payload->sidebar_items) ? $payload->sidebar_items : [];
?>

<div class="trending-area fix pt-25 gray-bg" id="<?= isset($row->span) && !empty($row->span) ? $row->span : 'trending-section'; ?>">
    <div class="container">
        <div class="trending-main">
            <div class="row">
                <!-- Left Slider Content -->
                <div class="col-lg-8">
                    <div class="slider-active">
                        <?php if (!empty($slider_items)): ?>
                            <?php foreach ($slider_items as $slide): ?>
                                <div class="single-slider">
                                    <div class="trending-top mb-30">
                                        <div class="trend-top-img">
                                            <img src="<?= base_url(isset($slide->image) ? $slide->image : 'assets/img/trending/trending_top2.jpg'); ?>" alt="<?= isset($slide->title) ? $slide->title : ''; ?>">
                                            <div class="trend-top-cap">
                                                <span class="bgr" data-animation="fadeInUp" data-delay=".2s" data-duration="1000ms"><?= isset($slide->category) ? $slide->category : 'News'; ?></span>
                                                <h2><a href="<?= isset($slide->link) ? $slide->link : base_url('latest_news'); ?>" data-animation="fadeInUp" data-delay=".4s" data-duration="1000ms"><?= isset($slide->title) ? $slide->title : ''; ?></a></h2>
                                                <p data-animation="fadeInUp" data-delay=".6s" data-duration="1000ms">oleh <?= isset($slide->author) ? $slide->author : 'Admin'; ?> - <?= isset($slide->date) ? $slide->date : ''; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <!-- Fallback default slider item from row properties -->
                            <div class="single-slider">
                                <div class="trending-top mb-30">
                                    <div class="trend-top-img">
                                        <img src="<?= base_url(!empty($row->image) ? $row->image : 'assets/img/trending/trending_top2.jpg'); ?>" alt="<?= isset($row->title) ? $row->title : ''; ?>">
                                        <div class="trend-top-cap">
                                            <span class="bgr" data-animation="fadeInUp" data-delay=".2s" data-duration="1000ms"><?= isset($row->subtitle) ? $row->subtitle : 'Business'; ?></span>
                                            <h2><a href="<?= !empty($row->link) ? $row->link : base_url('latest_news'); ?>" data-animation="fadeInUp" data-delay=".4s" data-duration="1000ms"><?= isset($row->title) ? $row->title : ''; ?></a></h2>
                                            <p data-animation="fadeInUp" data-delay=".6s" data-duration="1000ms"><?= isset($row->content) ? $row->content : ''; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Right Sidebar Content -->
                <div class="col-lg-4">
                    <div class="row">
                        <?php if (!empty($sidebar_items)): ?>
                            <?php foreach ($sidebar_items as $side): ?>
                                <div class="col-lg-12 col-md-6 col-sm-6">
                                    <div class="trending-top mb-30">
                                        <div class="trend-top-img">
                                            <img src="<?= base_url(isset($side->image) ? $side->image : 'assets/img/trending/trending_top3.jpg'); ?>" alt="<?= isset($side->title) ? $side->title : ''; ?>">
                                            <div class="trend-top-cap trend-top-cap2">
                                                <span class="<?= isset($side->badge_class) ? $side->badge_class : 'bgb'; ?>"><?= isset($side->category) ? $side->category : 'FASHION'; ?></span>
                                                <h2><a href="<?= isset($side->link) ? $side->link : base_url('latest_news'); ?>"><?= isset($side->title) ? $side->title : ''; ?></a></h2>
                                                <p>oleh <?= isset($side->author) ? $side->author : 'Admin'; ?> - <?= isset($side->date) ? $side->date : ''; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <!-- Fallback static right items -->
                            <div class="col-lg-12 col-md-6 col-sm-6">
                                <div class="trending-top mb-30">
                                    <div class="trend-top-img">
                                        <img src="<?= base_url('assets/img/trending/trending_top3.jpg'); ?>" alt="">
                                        <div class="trend-top-cap trend-top-cap2">
                                            <span class="bgb">FASHION</span>
                                            <h2><a href="<?= base_url('latest_news'); ?>">Secretart for Economic Air plane that looks like</a></h2>
                                            <p>by Alice cloe - Jun 19, 2020</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-6 col-sm-6">
                                <div class="trending-top mb-30">
                                    <div class="trend-top-img">
                                        <img src="<?= base_url('assets/img/trending/trending_top4.jpg'); ?>" alt="">
                                        <div class="trend-top-cap trend-top-cap2">
                                            <span class="bgg">TECH</span>
                                            <h2><a href="<?= base_url('latest_news'); ?>">Secretart for Economic Air plane that looks like</a></h2>
                                            <p>by Alice cloe - Jun 19, 2020</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if (!empty($row->btn_text) && !empty($row->btn_url)): ?>
    <div class="container text-center pb-3">
        <a href="<?= $row->btn_url; ?>" class="btn btn-primary px-4 py-2 font-weight-bold shadow-sm"><?= $row->btn_text; ?></a>
    </div>
<?php endif; ?>