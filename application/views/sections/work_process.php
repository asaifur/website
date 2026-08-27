<?php
// Parsing payload JSON
$payload = [];
if (!empty($section->data_payload)) {
    $payload = is_array($section->data_payload) ? $section->data_payload : json_decode(html_entity_decode($section->data_payload, ENT_QUOTES, 'UTF-8'), true);
}

$dom_id   = !empty($section->span) ? $section->span : 'proses-kerja';
$tagline  = !empty($section->subtitle) ? $section->subtitle : 'Tahapan Pengerjaan';
$title    = !empty($section->title) ? $section->title : 'Standar Operasional Prosedur';
$content  = !empty($section->content) ? $section->content : '';

$steps = $payload['steps'] ?? [];
$anim  = $payload['animate'] ?? 'animate__fadeInUp';
?>

<section id="<?= $dom_id; ?>" class="py-20 lg:py-28 bg-slate-50 border-t border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header Section -->
        <div class="text-center max-w-3xl mx-auto mb-16 reveal" data-animate="animate__fadeInDown">
            <span class="text-xs font-bold text-primary uppercase tracking-widest"><?= $tagline; ?></span>
            <h2 class="text-3xl sm:text-4xl font-black text-navy uppercase mt-2"><?= $title; ?></h2>
            <div class="w-16 h-1 bg-primary mx-auto mt-4 mb-4"></div>
            <?php if (!empty($content)): ?>
                <p class="text-slate-600 text-sm sm:text-base"><?= nl2br($content); ?></p>
            <?php endif; ?>
        </div>

        <!-- Steps Grid -->
        <?php if (!empty($steps) && is_array($steps)): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 reveal" data-animate="<?= $anim; ?>">
                <?php foreach ($steps as $idx => $step): ?>
                    <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100 hover:shadow-xl hover:-translate-y-2 transition-all duration-300 relative group">

                        <!-- Watermark Nomor Urut -->
                        <div class="absolute top-4 right-6 text-6xl font-black text-slate-50 opacity-50 group-hover:text-red-50 transition-colors z-0 pointer-events-none">
                            0<?= $idx + 1; ?>
                        </div>

                        <div class="relative z-10">
                            <!-- Icon -->
                            <div class="w-14 h-14 bg-red-50 text-primary rounded-xl flex items-center justify-center text-2xl mb-6 shadow-sm border border-red-100">
                                <i class="fa-solid <?= $step['icon'] ?? 'fa-check'; ?>"></i>
                            </div>

                            <h4 class="text-lg font-bold text-navy mb-3 uppercase tracking-wide">
                                <?= $step['title']; ?>
                            </h4>

                            <p class="text-sm text-slate-600 leading-relaxed">
                                <?= $step['desc']; ?>
                            </p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </div>
</section>