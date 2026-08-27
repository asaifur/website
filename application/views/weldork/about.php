<?php
// 1. Parsing payload JSON
$payload = [];
if (!empty($section->data_payload)) {
    $payload = is_array($section->data_payload) ? $section->data_payload : json_decode($section->data_payload, true);
}

// 2. Fallback Data Standar (Jika database kosong)
$dom_id  = !empty($section->span) ? $section->span : (!empty($section->section_id_dom) ? $section->section_id_dom : 'about');
$title   = !empty($section->title) ? $section->title : 'Ultimate Welding and Quality Metal Solutions';
$content = !empty($section->content) ? $section->content : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur tellus augue, iaculis id elit eget, ultrices pulvinar tortor.';

// Resolve Image URL
$image = !empty($section->image)
    ? (filter_var($section->image, FILTER_VALIDATE_URL) ? $section->image : base_url('assets/uploads/img/' . $section->image))
    : base_url('assets/weldork/img/about.jpg');

// Resolving Arrays from Payload
$features = $payload['features'] ?? [
    ['icon' => 'fa-users-cog', 'title' => 'Certified Expert & Team'],
    ['icon' => 'fa-tachometer-alt', 'title' => 'Fast & Reliable Services']
];

$checklists = $payload['checklists'] ?? [
    'Many variations of passages of lorem ipsum',
    'Many variations of passages of lorem ipsum',
    'Many variations of passages of lorem ipsum'
];

$highlight_box = $payload['highlight_box'] ?? 'We’re Good in All Metal Works Using Quality Welding Tools';
?>

<!-- About Start -->
<div id="<?= $dom_id; ?>" class="container-fluid pt-6 pb-6">
    <div class="container">
        <div class="row g-5">

            <!-- Left Column: Image -->
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                <div class="about-img">
                    <img class="img-fluid w-100" src="<?= $image; ?>" alt="<?= strip_tags($title); ?>">
                </div>
            </div>

            <!-- Right Column: Content -->
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                <h1 class="display-6 text-uppercase mb-4"><?= $title; ?></h1>

                <p class="mb-4 text-muted"><?= nl2br($content); ?></p>

                <!-- Dynamic Features Grid -->
                <div class="row g-5 mb-4">
                    <?php foreach ($features as $feat) : ?>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 btn-xl-square bg-light me-3">
                                    <i class="fa <?= $feat['icon'] ?? 'fa-users-cog'; ?> fa-2x text-primary"></i>
                                </div>
                                <h5 class="lh-base text-uppercase mb-0"><?= $feat['title']; ?></h5>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Dynamic Checklists -->
                <?php if (!empty($checklists) && is_array($checklists)) : ?>
                    <?php foreach ($checklists as $check) : ?>
                        <p><i class="fa fa-check-square text-primary me-3"></i><?= $check; ?></p>
                    <?php endforeach; ?>
                <?php endif; ?>

                <!-- Highlight Box -->
                <?php if (!empty($highlight_box)) : ?>
                    <div class="border border-5 border-primary p-4 text-center mt-4">
                        <h4 class="lh-base text-uppercase mb-0"><?= $highlight_box; ?></h4>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>
<!-- About End -->