<?php
// 1. Parsing payload JSON untuk class animasi
$payload = [];
if (!empty($section->data_payload)) {
    $payload = is_array($section->data_payload) ? $section->data_payload : json_decode($section->data_payload, true);
}

// 2. Data Fallback
$dom_id   = !empty($section->span) ? $section->span : (!empty($section->section_id_dom) ? $section->section_id_dom : 'cta-footer');
$title    = !empty($section->title) ? $section->title : 'Siap Membangun Dapur Profesional Anda?';
$subtitle = !empty($section->subtitle) ? $section->subtitle : 'Dapatkan survei lokasi dan konsultasi teknis langsung dari ahli kami.';
$btn_text = !empty($section->btn_text) ? $section->btn_text : 'Hubungi Kami Sekarang';

// 3. Logika Prioritas Link URL (Prioritas: Section URL -> Domain WA -> Default)
$btn_url = 'https://wa.me/6281234567890'; // Default fallback
if (!empty($section->btn_url)) {
    $btn_url = $section->btn_url;
} elseif (!empty($domain->wa_link)) {
    $btn_url = $domain->wa_link;
}

// 4. Konfigurasi Animasi dari Payload
$anim_sec = $payload['animate_section'] ?? 'animate__fadeIn';
$anim_btn = $payload['animate_btn'] ?? 'animate__pulse animate__infinite';
?>

<section id="<?= $dom_id; ?>" class="bg-primary text-white py-12 reveal" data-animate="<?= $anim_sec; ?>">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between gap-6 text-center md:text-left">

        <div>
            <h3 class="text-2xl sm:text-3xl font-black uppercase"><?= $title; ?></h3>
            <?php if (!empty($subtitle)) : ?>
                <p class="text-red-100 text-sm mt-1"><?= $subtitle; ?></p>
            <?php endif; ?>
        </div>

        <a href="<?= $btn_url; ?>" target="_blank" class="bg-navy hover:bg-slate-900 text-white px-8 py-4 rounded font-bold text-sm tracking-wider uppercase shadow-xl transition whitespace-nowrap animate__animated <?= $anim_btn; ?>">
            <?= $btn_text; ?>
        </a>

    </div>
</section>