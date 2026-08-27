<?php
// 1. Parsing payload JSON utama
$payload = [];
if (!empty($section->data_payload)) {
    $payload = is_array($section->data_payload) ? $section->data_payload : json_decode($section->data_payload, true);
}

// 2. Ekstrak HANYA array 'catalog_items' atau 'items' dari dalam payload
$items = $payload['catalog_items'] ?? ($payload['items'] ?? []);

// Ekstrak animasi dari payload (jika ada)
$anim_header = $payload['animate_header'] ?? 'animate__fadeIn';
$anim_items_default = $payload['animate_items'] ?? 'animate__zoomIn';

// 3. Data Fallback untuk Teks
$dom_id   = !empty($section->span) ? $section->span : (!empty($section->section_id_dom) ? $section->section_id_dom : 'portofolio');
$tagline  = !empty($section->subtitle) ? $section->subtitle : 'Portofolio Kami';
$title    = !empty($section->title) ? $section->title : 'Instalasi & Proyek Terbaru';
$btn_text = !empty($section->btn_text) ? $section->btn_text : 'Lihat Semua Proyek';
$btn_url  = !empty($section->btn_url) ? $section->btn_url : '#kontak';

// 4. Fallback items jika database kosong atau array catalog_items tidak ada
if (empty($items)) {
    $items = [
        ['icon' => 'fa-building', 'title' => 'Restoran Fine Dining', 'desc' => 'Full Exhaust Hood & Island Cooking Setup', 'animate' => 'animate__zoomIn'],
        ['icon' => 'fa-hotel', 'title' => 'Hotel Bintang 4', 'desc' => 'Instalasi Central Gas & Manifold System', 'animate' => 'animate__zoomIn'],
        ['icon' => 'fa-utensils', 'title' => 'Central Kitchen', 'desc' => 'Ducting Rooftop Blower & Fresh Air', 'animate' => 'animate__zoomIn'],
        ['icon' => 'fa-store', 'title' => 'Food Court Mall', 'desc' => 'Custom Fabrikasi Meja Stainless & Sink', 'animate' => 'animate__zoomIn']
    ];
}
?>

<section id="<?= $dom_id; ?>" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header & Top CTA -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-12 reveal" data-animate="<?= $anim_header; ?>">
            <div>
                <?php if (!empty($tagline)) : ?>
                    <span class="text-xs font-bold text-primary uppercase tracking-widest"><?= $tagline; ?></span>
                <?php endif; ?>

                <h2 class="text-3xl font-black text-navy uppercase mt-1"><?= $title; ?></h2>
            </div>

            <?php if (!empty($btn_url) && !empty($btn_text)) : ?>
                <a href="<?= $btn_url; ?>" class="mt-4 md:mt-0 text-sm font-bold text-primary hover:text-primaryDark flex items-center gap-2 transition">
                    <?= $btn_text; ?> <i class="fa-solid fa-arrow-right"></i>
                </a>
            <?php endif; ?>
        </div>

        <!-- Portfolio Item Grid -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
            <?php foreach ($items as $item) :
                // Ambil animasi dari JSON item individu, jika kosong gunakan default dari parent
                $anim = $item['animate'] ?? $anim_items_default;
            ?>
                <!-- Item Card -->
                <div class="p-5 bg-gray-50 rounded-lg border border-gray-200 hover:border-primary transition group reveal" data-animate="<?= $anim; ?>">

                    <div class="w-16 h-16 bg-red-100 text-primary mx-auto rounded-full flex items-center justify-center text-2xl mb-4 group-hover:bg-primary group-hover:text-white transition">
                        <i class="fa-solid <?= $item['icon'] ?? 'fa-building'; ?>"></i>
                    </div>

                    <h4 class="font-bold text-navy text-sm sm:text-base">
                        <?= $item['title'] ?? ''; ?>
                    </h4>

                    <?php if (!empty($item['desc'])) : ?>
                        <p class="text-xs text-gray-500 mt-1">
                            <?= $item['desc']; ?>
                        </p>
                    <?php endif; ?>

                </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>