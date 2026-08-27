<?php
// 1. Parsing payload JSON untuk list keunggulan
$items = [];
if (!empty($section->data_payload)) {
    $items = is_array($section->data_payload) ? $section->data_payload : json_decode($section->data_payload, true);
}

// 2. Data Fallback (Jika database belum diset/kosong)
$dom_id   = !empty($section->span) ? $section->span : (!empty($section->section_id_dom) ? $section->section_id_dom : 'keunggulan');
$tagline  = !empty($section->subtitle) ? $section->subtitle : 'Keunggulan Kami';
$title    = !empty($section->title) ? $section->title : 'Standar Mutu Presisi & Aman';
$content  = !empty($section->content) ? $section->content : 'Mengapa ratusan pengusaha kuliner mempercayakan dapur komersial mereka kepada kami.';

if (empty($items)) {
    $items = [
        [
            'icon' => 'fa-medal',
            'title' => 'Material Berkualitas Tinggi',
            'desc' => 'Kami hanya menggunakan stainless steel SUS 304 anti karat, pipa gas seamless sch40 standar migas, dan motor blower tahan panas tinggi.',
            'animate' => 'animate__fadeInLeft'
        ],
        [
            'icon' => 'fa-drafting-compass',
            'title' => 'Alur Dapur Simetris & Ergonomis',
            'desc' => 'Perhitungan presisi memastikan hood sejajar dengan kompor, jalur ducting minim sudut tajam, dan pembuangan asap tidak mengorbankan estetika gedung.',
            'animate' => 'animate__fadeInUp'
        ],
        [
            'icon' => 'fa-headset',
            'title' => 'After-Sales & Garansi Resmi',
            'desc' => 'Dukungan teknis pasca-instalasi, garansi kebocoran pipa gas, serta tim siap siaga untuk perawatan berkala sistem exhaust dapur Anda.',
            'animate' => 'animate__fadeInRight'
        ]
    ];
}
?>

<section id="<?= $dom_id; ?>" class="py-20 bg-darkGray text-white relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header Text -->
        <div class="text-center max-w-3xl mx-auto mb-16 space-y-3 reveal" data-animate="animate__fadeInDown">
            <?php if (!empty($tagline)) : ?>
                <span class="text-xs font-bold text-primary uppercase tracking-widest"><?= $tagline; ?></span>
            <?php endif; ?>

            <h2 class="text-3xl sm:text-4xl font-black uppercase" style="color:black"><?= $title; ?></h2>
            <div class="w-16 h-1 bg-navy mx-auto"></div>

            <?php if (!empty($content)) : ?>
                <p class="text-gray-300 text-sm" style="color:black"><?= nl2br($content); ?></p>
            <?php endif; ?>
        </div>

        <!-- Features Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <?php foreach ($items as $item) :
                $anim = $item['animate'] ?? 'animate__fadeInUp';
            ?>
                <!-- Feature Card -->
                <div class="bg-navy/80 p-8 rounded-lg border border-slate-700 reveal" data-animate="<?= $anim; ?>">
                    <i class="fa-solid <?= $item['icon'] ?? 'fa-medal'; ?> text-4xl text-primary mb-4"></i>
                    <h3 class="text-lg font-bold mb-2"><?= $item['title']; ?></h3>
                    <p class="text-sm text-gray-400 leading-relaxed">
                        <?= $item['desc']; ?>
                    </p>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>