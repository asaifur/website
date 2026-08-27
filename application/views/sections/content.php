<?php
// 1. Parsing payload JSON untuk konfigurasi styling tambahan
$payload = [];
if (!empty($section->data_payload)) {
    $payload = is_array($section->data_payload) ? $section->data_payload : json_decode(html_entity_decode($section->data_payload, ENT_QUOTES, 'UTF-8'), true);
}

// Konfigurasi Variabel dari Objek Section
$dom_id    = !empty($section->span) ? $section->span : 'section-content';
$title     = $section->title ?? '';
$subtitle  = $section->subtitle ?? '';
$content   = $section->content ?? '';
$image     = $section->image ?? '';
$anim      = $payload['animate'] ?? 'animate__fadeInUp';
$bg_color  = $payload['bg_color'] ?? 'bg-white';
?>

<section id="<?= $dom_id; ?>" class="py-16 lg:py-24 <?= $bg_color; ?>">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">

            <!-- Kolom Teks / Konten Utama -->
            <div class="<?= !empty($image) ? 'lg:col-span-7' : 'lg:col-span-12 max-w-4xl mx-auto text-center'; ?> space-y-6 reveal" data-animate="<?= $anim; ?>">

                <?php if (!empty($subtitle)): ?>
                    <span class="inline-block text-xs font-bold text-primary uppercase tracking-widest bg-primary/10 px-3 py-1.5 rounded-full">
                        <?= htmlspecialchars($subtitle); ?>
                    </span>
                <?php endif; ?>

                <?php if (!empty($title)): ?>
                    <h2 class="text-3xl sm:text-4xl font-black text-navy uppercase leading-tight">
                        <?= htmlspecialchars($title); ?>
                    </h2>
                    <div class="w-16 h-1 bg-primary <?= empty($image) ? 'mx-auto' : ''; ?>"></div>
                <?php endif; ?>

                <div class="text-slate-600 text-base sm:text-lg leading-relaxed space-y-4">
                    <?= nl2br($content); ?>
                </div>

                <?php if (!empty($section->btn_text) && !empty($section->btn_url)): ?>
                    <div class="pt-4">
                        <a href="<?= $section->btn_url; ?>" class="inline-flex items-center gap-2 bg-primary hover:bg-primary/90 text-white font-bold uppercase text-xs tracking-wider px-6 py-3.5 rounded-lg transition-colors shadow-lg shadow-primary/20">
                            <?= htmlspecialchars($section->btn_text); ?> <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                <?php endif; ?>

            </div>

            <!-- Kolom Gambar (Opsional jika kolom image di database terisi) -->
            <?php if (!empty($image)): ?>
                <div class="lg:col-span-5 reveal" data-animate="animate__fadeInRight">
                    <div class="relative rounded-2xl overflow-hidden shadow-xl border border-slate-100 group">
                        <img src="<?= filter_var($image, FILTER_VALIDATE_URL) ? $image : base_url('assets/uploads/img/' . $image); ?>" alt="<?= htmlspecialchars($title); ?>" class="w-full h-auto object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-navy/10 pointer-events-none"></div>
                    </div>
                </div>
            <?php endif; ?>

        </div>

    </div>
</section>