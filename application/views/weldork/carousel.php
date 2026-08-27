<?php
// 1. Parsing payload JSON untuk list slides
$slides = [];
if (!empty($section->data_payload)) {
    $slides = is_array($section->data_payload) ? $section->data_payload : json_decode($section->data_payload, true);
}

// 2. Data Fallback (Jika database kosong)
if (empty($slides)) {
    $slides = [
        [
            'image' => 'img/carousel-1.jpg',
            'title' => 'Best Metalcraft Solutions',
            'btn_text' => 'Explore More',
            'btn_url' => '#'
        ],
        [
            'image' => 'img/carousel-2.jpg',
            'title' => 'Best Metalcraft Solutions',
            'btn_text' => 'Explore More',
            'btn_url' => '#'
        ]
    ];
}
?>

<!-- Carousel Start -->
<div class="container-fluid p-0 mb-6 wow fadeIn" data-wow-delay="0.1s">
    <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">

        <!-- Indicators -->
        <div class="carousel-indicators">
            <?php foreach ($slides as $index => $slide) :
                $img_url = filter_var($slide['image'], FILTER_VALIDATE_URL)
                    ? $slide['image']
                    : base_url('assets/uploads/img/' . $slide['image']);
            ?>
                <button type="button"
                    data-bs-target="#header-carousel"
                    data-bs-slide-to="<?= $index; ?>"
                    class="<?= ($index == 0) ? 'active' : ''; ?>"
                    <?= ($index == 0) ? 'aria-current="true"' : ''; ?>
                    aria-label="Slide <?= $index + 1; ?>">
                    <img class="img-fluid" src="<?= $img_url; ?>" alt="Indicator <?= $index + 1; ?>">
                </button>
            <?php endforeach; ?>
        </div>

        <!-- Carousel Inner Items -->
        <div class="carousel-inner">
            <?php foreach ($slides as $index => $slide) :
                $img_url = filter_var($slide['image'], FILTER_VALIDATE_URL)
                    ? $slide['image']
                    : base_url('assets/uploads/img/' . $slide['image']);
            ?>
                <div class="carousel-item <?= ($index == 0) ? 'active' : ''; ?>">
                    <img class="w-100" src="<?= $img_url; ?>" alt="<?= strip_tags($slide['title']); ?>" style="object-fit: cover; min-height: 60vh;">

                    <div class="carousel-caption">
                        <h1 class="display-1 text-uppercase text-white mb-4 animated zoomIn">
                            <?= $slide['title']; ?>
                        </h1>
                        <?php if (!empty($slide['btn_text'])) : ?>
                            <a href="<?= $slide['btn_url'] ?? '#'; ?>" class="btn btn-primary py-3 px-4 animated fadeInUp">
                                <?= $slide['btn_text']; ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</div>
<!-- Carousel End -->