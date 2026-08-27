<?php
// Parsing payload JSON
$payload = [];
if (!empty($section->data_payload)) {
    $payload = is_array($section->data_payload) ? $section->data_payload : json_decode(html_entity_decode($section->data_payload, ENT_QUOTES, 'UTF-8'), true);
}

$dom_id   = !empty($section->span) ? $section->span : 'service-detail';
$tagline  = !empty($section->subtitle) ? $section->subtitle : 'Spesifikasi Layanan';
$title    = !empty($section->title) ? $section->title : 'Detail Layanan';
$content  = !empty($section->content) ? $section->content : '';
$btn_text = !empty($section->btn_text) ? $section->btn_text : '';
$btn_url  = !empty($section->btn_url) ? $section->btn_url : '';

// Gambar Layanan
$img_url = !empty($section->image) ? (filter_var($section->image, FILTER_VALIDATE_URL) ? $section->image : base_url('assets/uploads/img/' . $section->image)) : '';

$features   = $payload['features'] ?? [];
$anim_img   = $payload['animate_img'] ?? 'animate__fadeInRight';
$anim_text  = $payload['animate_text'] ?? 'animate__fadeInLeft';
?>

<section id="<?= $dom_id; ?>" class="py-20 lg:py-28 bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center">

            <!-- Area Teks (Kiri) -->
            <div class="space-y-6 reveal" data-animate="<?= $anim_text; ?>">
                <?php if (!empty($tagline)): ?>
                    <span class="text-xs font-bold text-primary uppercase tracking-widest border-l-2 border-primary pl-2"><?= $tagline; ?></span>
                <?php endif; ?>

                <h2 class="text-3xl sm:text-4xl font-black text-navy uppercase leading-tight">
                    <?= $title; ?>
                </h2>

                <div class="prose prose-slate prose-sm sm:prose-base max-w-none text-slate-600 leading-relaxed">
                    <?= nl2br($content); ?>
                </div>

                <!-- Spesifikasi Teknis (Checklists) -->
                <?php if (!empty($features) && is_array($features)): ?>
                    <div class="bg-slate-50 p-6 rounded-xl border border-slate-100 mt-6">
                        <h4 class="font-bold text-navy mb-4 uppercase tracking-wider text-sm">Spesifikasi Teknis:</h4>
                        <ul class="space-y-3">
                            <?php foreach ($features as $feat): ?>
                                <li class="flex items-start gap-3">
                                    <i class="fa-solid fa-circle-check text-primary mt-1 shrink-0"></i>
                                    <span class="text-sm font-medium text-slate-700"><?= $feat; ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <?php if (!empty($btn_text) && !empty($btn_url)): ?>
                    <div class="pt-4">
                        <a href="<?= $btn_url; ?>" target="_blank" class="inline-flex items-center gap-2 bg-navy hover:bg-slate-900 text-white px-6 py-3 rounded-lg font-bold text-sm tracking-wider uppercase transition shadow-lg">
                            <i class="fa-brands fa-whatsapp text-emerald-400 text-lg"></i> <?= $btn_text; ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Area Visual (Kanan) -->
            <div class="relative reveal order-first lg:order-last mb-10 lg:mb-0" data-animate="<?= $anim_img; ?>">
                <div class="relative rounded-2xl overflow-hidden shadow-2xl aspect-square lg:aspect-[4/5] z-10 border-4 border-white">
                    <img src="<?= $img_url; ?>" class="w-full h-full object-cover" alt="<?= strip_tags($title); ?>">
                    <div class="absolute inset-0 bg-gradient-to-tr from-navy/40 to-transparent"></div>
                </div>
                <!-- Elemen Dekoratif Grid Dots -->
                <div class="absolute -top-8 -right-8 w-32 h-32 bg-[radial-gradient(#dc2626_2px,transparent_2px)] [background-size:16px_16px] opacity-20 z-0"></div>
                <div class="absolute -bottom-8 -left-8 w-40 h-40 bg-[radial-gradient(#0f172a_2px,transparent_2px)] [background-size:16px_16px] opacity-10 z-0"></div>
            </div>

        </div>
    </div>
</section>