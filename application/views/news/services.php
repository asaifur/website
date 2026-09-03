<?php
$payload = isset($row->data_payload) ? json_decode($row->data_payload) : null;
$tabs = isset($payload->tabs) ? $payload->tabs : ['Lifestyle', 'Travel', 'Fashion', 'Sports', 'Technology'];
$featured = isset($payload->featured_post) ? $payload->featured_post : [
    'title' => 'Secretart for Economic Air plane that looks like',
    'author' => 'Alice cloe',
    'date' => 'Jun 19, 2020',
    'image' => 'assets/img/gallery/whats_news_details1.png',
    'excerpt' => 'Struggling to sell one multi-million dollar home currently on the market won’t stop actress and singer Jennifer Lopez.'
];
?>

<!-- Whats New Start -->
<section class="whats-news-area pt-50 pb-20 gray-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="whats-news-wrapper">
                    <!-- Heading & Nav Button -->
                    <div class="row justify-content-between align-items-end mb-15">
                        <div class="col-xl-4">
                            <div class="section-tittle mb-30">
                                <h3><?= isset($row->title) ? $row->title : 'Whats New'; ?></h3>
                            </div>
                        </div>
                        <div class="col-xl-8 col-md-9">
                            <div class="properties__button">
                                <!-- Nav Button -->
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <?php foreach ($tabs as $index => $tab):
                                            $slug = strtolower(str_replace(' ', '-', $tab));
                                            $activeClass = ($index === 0) ? 'active' : '';
                                            $ariaSelected = ($index === 0) ? 'true' : 'false';
                                        ?>
                                            <a class="nav-item nav-link <?= $activeClass; ?>" id="nav-<?= $slug; ?>-tab" data-toggle="tab" href="#nav-<?= $slug; ?>" role="tab" aria-controls="nav-<?= $slug; ?>" aria-selected="<?= $ariaSelected; ?>"><?= $tab; ?></a>
                                        <?php endforeach; ?>
                                    </div>
                                </nav>
                                <!-- End Nav Button -->
                            </div>
                        </div>
                    </div>
                    <!-- Tab content -->
                    <div class="row">
                        <div class="col-12">
                            <!-- Nav Card -->
                            <div class="tab-content" id="nav-tabContent">
                                <?php foreach ($tabs as $index => $tab):
                                    $slug = strtolower(str_replace(' ', '-', $tab));
                                    $showActive = ($index === 0) ? 'show active' : '';
                                ?>
                                    <div class="tab-pane fade <?= $showActive; ?>" id="nav-<?= $slug; ?>" role="tabpanel" aria-labelledby="nav-<?= $slug; ?>-tab">
                                        <div class="row">
                                            <!-- Left Details Caption -->
                                            <div class="col-xl-6 col-lg-12">
                                                <div class="whats-news-single mb-40">
                                                    <div class="whates-img">
                                                        <img src="<?= base_url(isset($featured['image']) ? $featured['image'] : 'assets/img/gallery/whats_news_details1.png'); ?>" alt="">
                                                    </div>
                                                    <div class="whates-caption">
                                                        <h4><a href="<?= base_url('latest_news'); ?>"><?= isset($featured['title']) ? $featured['title'] : ''; ?></a></h4>
                                                        <span>oleh <?= isset($featured['author']) ? $featured['author'] : ''; ?> - <?= isset($featured['date']) ? $featured['date'] : ''; ?></span>
                                                        <p><?= isset($featured['excerpt']) ? $featured['excerpt'] : ''; ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Right single caption -->
                                            <div class="col-xl-6 col-lg-12">
                                                <div class="row">
                                                    <div class="col-xl-12 col-lg-6 col-md-6 col-sm-10">
                                                        <div class="whats-right-single mb-20">
                                                            <div class="whats-right-img">
                                                                <img src="<?= base_url('assets/img/gallery/whats_right_img1.png'); ?>" alt="">
                                                            </div>
                                                            <div class="whats-right-cap">
                                                                <span class="colorb"><?= strtoupper($tab); ?></span>
                                                                <h4><a href="<?= base_url('latest_news'); ?>">Portrait of group of friends ting eat. market in.</a></h4>
                                                                <p>Jun 19, 2020</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 col-lg-6 col-md-6 col-sm-10">
                                                        <div class="whats-right-single mb-20">
                                                            <div class="whats-right-img">
                                                                <img src="<?= base_url('assets/img/gallery/whats_right_img2.png'); ?>" alt="">
                                                            </div>
                                                            <div class="whats-right-cap">
                                                                <span class="colorb"><?= strtoupper($tab); ?></span>
                                                                <h4><a href="<?= base_url('latest_news'); ?>">Portrait of group of friends ting eat. market in.</a></h4>
                                                                <p>Jun 19, 2020</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 col-lg-6 col-md-6 col-sm-10">
                                                        <div class="whats-right-single mb-20">
                                                            <div class="whats-right-img">
                                                                <img src="<?= base_url('assets/img/gallery/whats_right_img3.png'); ?>" alt="">
                                                            </div>
                                                            <div class="whats-right-cap">
                                                                <span class="colorg"><?= strtoupper($tab); ?></span>
                                                                <h4><a href="<?= base_url('latest_news'); ?>">Portrait of group of friends ting eat. market in.</a></h4>
                                                                <p>Jun 19, 2020</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 col-lg-6 col-md-6 col-sm-10">
                                                        <div class="whats-right-single mb-20">
                                                            <div class="whats-right-img">
                                                                <img src="<?= base_url('assets/img/gallery/whats_right_img4.png'); ?>" alt="">
                                                            </div>
                                                            <div class="whats-right-cap">
                                                                <span class="colorr"><?= strtoupper($tab); ?></span>
                                                                <h4><a href="<?= base_url('latest_news'); ?>">Portrait of group of friends ting eat. market in.</a></h4>
                                                                <p>Jun 19, 2020</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <!-- End Nav Card -->
                        </div>
                    </div>
                </div>
                <!-- Banner -->
                <div class="banner-one mt-20 mb-30">
                    <img src="<?= base_url('assets/img/gallery/body_card1.png'); ?>" alt="">
                </div>
            </div>
            <!-- Sidebar / Right Content -->
            <div class="col-lg-4">
                <!-- Flow Social -->
                <div class="single-follow mb-45">
                    <div class="single-box">
                        <div class="follow-us d-flex align-items-center">
                            <div class="follow-social">
                                <a href="#"><img src="<?= base_url('assets/img/news/icon-fb.png'); ?>" alt=""></a>
                            </div>
                            <div class="follow-count">
                                <span>8,045</span>
                                <p>Fans</p>
                            </div>
                        </div>
                        <div class="follow-us d-flex align-items-center">
                            <div class="follow-social">
                                <a href="#"><img src="<?= base_url('assets/img/news/icon-tw.png'); ?>" alt=""></a>
                            </div>
                            <div class="follow-count">
                                <span>8,045</span>
                                <p>Fans</p>
                            </div>
                        </div>
                        <div class="follow-us d-flex align-items-center">
                            <div class="follow-social">
                                <a href="#"><img src="<?= base_url('assets/img/news/icon-ins.png'); ?>" alt=""></a>
                            </div>
                            <div class="follow-count">
                                <span>8,045</span>
                                <p>Fans</p>
                            </div>
                        </div>
                        <div class="follow-us d-flex align-items-center">
                            <div class="follow-social">
                                <a href="#"><img src="<?= base_url('assets/img/news/icon-yo.png'); ?>" alt=""></a>
                            </div>
                            <div class="follow-count">
                                <span>8,045</span>
                                <p>Fans</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Most Recent Area -->
                <div class="most-recent-area">
                    <div class="small-tittle mb-20">
                        <h4>Most Recent</h4>
                    </div>
                    <div class="most-recent mb-40">
                        <div class="most-recent-img">
                            <img src="<?= base_url('assets/img/gallery/most_recent.png'); ?>" alt="">
                            <div class="most-recent-cap">
                                <span class="bgbeg">Vogue</span>
                                <h4 class="text-white"><a href="<?= base_url('latest_news'); ?>">What to Wear: 9+ Cute Work Outfits to Wear This.</a></h4>
                                <p>Jhon | 2 hours ago</p>
                            </div>
                        </div>
                    </div>
                    <div class="most-recent-single">
                        <div class="most-recent-images">
                            <img src="<?= base_url('assets/img/gallery/most_recent1.png'); ?>" alt="">
                        </div>
                        <div class="most-recent-capt">
                            <h4><a href="<?= base_url('latest_news'); ?>">Scarlett’s disappointment at latest accolade</a></h4>
                            <p>Jhon | 2 hours ago</p>
                        </div>
                    </div>
                    <div class="most-recent-single">
                        <div class="most-recent-images">
                            <img src="<?= base_url('assets/img/gallery/most_recent2.png'); ?>" alt="">
                        </div>
                        <div class="most-recent-capt">
                            <h4><a href="<?= base_url('latest_news'); ?>">Most Beautiful Things to Do in Sidney with Your BF</a></h4>
                            <p>Jhon | 3 hours ago</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Whats New End -->