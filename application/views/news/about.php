<?php
$payload = isset($row->data_payload) ? json_decode($row->data_payload) : null;
$title = isset($row->title) && !empty($row->title) ? $row->title : 'Here come the moms in space';
$subtitle = isset($row->subtitle) && !empty($row->subtitle) ? $row->subtitle : '';
$content = isset($row->content) && !empty($row->content) ? $row->content : 'Moms are like…buttons? Moms are like glue. Moms are like pizza crusts. Moms are the ones who make sure things happen—from birth to school lunch.';
$image = isset($row->image) && !empty($row->image) ? base_url($row->image) : base_url('assets/img/trending/trending_top.jpg');
?>

<div class="about-area2 gray-bg pt-60 pb-60">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <!-- Trending Tittle -->
                <div class="about-right mb-90">
                    <div class="about-img">
                        <img src="<?= $image; ?>" alt="<?= $title; ?>">
                    </div>
                    <div class="heading-news mb-30 pt-30">
                        <h3><?= $title; ?></h3>
                    </div>
                    <div class="about-prea">
                        <p class="about-pera1 mb-25"><?= $content; ?></p>
                        <?php if (!empty($subtitle)): ?>
                            <p class="about-pera1 mb-25"><?= $subtitle; ?></p>
                        <?php endif; ?>

                        <?php if (isset($payload->paragraphs) && is_array($payload->paragraphs)): ?>
                            <?php foreach ($payload->paragraphs as $para): ?>
                                <p class="about-pera1 mb-25"><?= $para; ?></p>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="about-pera1 mb-25">My hero when I was a kid was my mom. Same for everyone I knew. Moms are untouchable. They’re elegant, smart, beautiful, kind…everything we want to be. At 29 years old, my favorite compliment is being told that I look like my mom. Seeing myself in her image, like this daughter up top, makes me so proud of how far I’ve come, and so thankful for where I come from.</p>
                        <?php endif; ?>
                    </div>

                    <?php if (isset($payload->extra_heading) && !empty($payload->extra_heading)): ?>
                        <div class="section-tittle mb-30 pt-30">
                            <h3><?= $payload->extra_heading; ?></h3>
                        </div>
                        <div class="about-prea">
                            <p class="about-pera1 mb-25"><?= isset($payload->extra_content) ? $payload->extra_content : ''; ?></p>
                        </div>
                    <?php endif; ?>

                    <div class="social-share pt-30">
                        <div class="section-tittle">
                            <h3 class="mr-20">Share:</h3>
                            <ul>
                                <li><a href="#"><img src="<?= base_url('assets/img/news/icon-ins.png'); ?>" alt="Instagram"></a></li>
                                <li><a href="#"><img src="<?= base_url('assets/img/news/icon-fb.png'); ?>" alt="Facebook"></a></li>
                                <li><a href="#"><img src="<?= base_url('assets/img/news/icon-tw.png'); ?>" alt="Twitter"></a></li>
                                <li><a href="#"><img src="<?= base_url('assets/img/news/icon-yo.png'); ?>" alt="Youtube"></a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- From / Contact Form -->
                <div class="row">
                    <div class="col-lg-8">
                        <form class="form-contact contact_form mb-80" action="<?= base_url('contact_process'); ?>" method="post" id="contactForm" novalidate="novalidate">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <textarea class="form-control w-100 error" name="message" id="message" cols="30" rows="9" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Message'" placeholder="Enter Message"></textarea>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input class="form-control error" name="name" id="name" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your name'" placeholder="Enter your name">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input class="form-control error" name="email" id="email" type="email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'" placeholder="Email">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <input class="form-control error" name="subject" id="subject" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Subject'" placeholder="Enter Subject">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <button type="submit" class="button button-contactForm boxed-btn boxed-btn2">Send</button>
                            </div>
                        </form>
                    </div>
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
                <!-- New Poster -->
                <div class="news-poster d-none d-lg-block">
                    <img src="<?= base_url('assets/img/news/news_card.jpg'); ?>" alt="">
                </div>
            </div>
        </div>
    </div>
</div>