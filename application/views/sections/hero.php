<?php
// 1. Parsing payload JSON database (Mendukung bentuk string JSON maupun array)
$payload = [];
if (!empty($section->data_payload)) {
    $payload = is_array($section->data_payload) ? $section->data_payload : json_decode(html_entity_decode($section->data_payload, ENT_QUOTES, 'UTF-8'), true);
}

// 2. Setup Data Dinamis dengan Fallback dari tabel contents pages & payload
$dom_id     = !empty($section->span) ? $section->span : (!empty($section->section_id_dom) ? $section->section_id_dom : 'beranda');
$badge_icon = $payload['badge_icon'] ?? 'fa-shield-halved';
$badge_text = !empty($section->subtitle) ? $section->subtitle : 'Standar SNI & Food Grade SUS 304';
$hero_title = !empty($section->title) ? $section->title : 'Mitra Terpercaya <span class="text-primary">Instalasi & Fabrikasi</span> Dapur Komersial';
$hero_desc  = !empty($section->content) ? $section->content : 'Spesialis Ducting Exhaust System, Fresh Air, Jaringan Gas Komersial, dan Fabrikasi Stainless Steel Kustom untuk Restoran, Hotel, Catering, dan Cloud Kitchen.';

// Bullet points dari payload JSON
$bullet_points = $payload['bullet_points'] ?? [
    'Jaringan Gas Komersil & Dapur Restoran',
    'Fabrikasi Stainless Steel Kustom',
    'Instalasi Pipa Gas Komersil',
    'Jasa Instalasi & Fabrikasi Ducting Exhaust',
    'Jasa Instalasi & Fabrikasi Fresh Air',
    'Layout 3D dan Estimasi Biaya',
];

// Tombol Aksi Utama
$btn_explore_text = !empty($section->btn_text) ? $section->btn_text : 'Eksplor Layanan';
$btn_explore_url  = !empty($section->btn_url) ? $section->btn_url : '#layanan';

// WhatsApp CTA (Prioritas Payload -> Domain WA -> Default)
$wa_url = $payload['whatsapp_cta']['url'] ?? (!empty($domain->wa_link) ? $domain->wa_link : 'https://wa.me/6281239602788');
$wa_label = $payload['whatsapp_cta']['label'] ?? 'Chat WhatsApp';

// Form Dinamis (Lead Form Config)
$form_tagline  = $payload['lead_form']['tagline'] ?? 'Mulai Proyek Anda';
$form_title    = $payload['lead_form']['title'] ?? 'Konsultasi & Estimasi';
$form_sub      = $payload['lead_form']['subtitle'] ?? 'Dapatkan layout awal dan estimasi kebutuhan dapur Anda.';
$form_btn      = $payload['lead_form']['submit_btn_text'] ?? 'Kirim Permintaan Konsultasi';
$form_services = $payload['lead_form']['services'] ?? [
    'Jasa Instalasi Gas Komersil',
    'Instalasi & Fabrikasi Ducting Exhaust',
    'Instalasi & Fabrikasi Fresh Air',
    'Peralatan Custom Dapur Restoran',
    'Paket Full Kitchen Setup (Desain & Pasang)',
    'Maintenance & Emergency Repair'
];

// Resolusi Gambar Background Hero
$hero_image = !empty($section->image)
    ? (filter_var($section->image, FILTER_VALIDATE_URL) ? $section->image : base_url('assets/uploads/img/' . $section->image))
    : 'https://images.unsplash.com/photo-1556910103-1c02745aae4d?q=80&w=1920&auto=format&fit=crop';
?>

<section id="<?= $dom_id; ?>" class="relative bg-darkGray text-white py-16 lg:py-24 overflow-hidden border-b-4 border-primary">
    <!-- Background Image & Gradient Overlay -->
    <div class="absolute inset-0 bg-cover bg-center opacity-85" style="background-image: url('<?= $hero_image; ?>');"></div>
    <div class="absolute inset-0 bg-gradient-to-r from-navy via-darkGray/50 toabsolute"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">

        <!-- Left Info Copy -->
        <div class="lg:col-span-7 space-y-6 text-center lg:text-left animate__animated animate__fadeInLeft">

            <?php if (!empty($badge_text)) : ?>
                <div class="inline-flex items-center gap-2 bg-primary/20 border border-primary/40 px-3 py-1.5 rounded-full text-red-400 font-semibold text-xs tracking-wide uppercase">
                    <i class="fa-solid <?= $badge_icon; ?>"></i>
                    <span><?= $badge_text; ?></span>
                </div>
            <?php endif; ?>

            <h1 class="text-3xl sm:text-4xl md:text-5xl font-black uppercase tracking-tight leading-tight">
                <?= $hero_title; ?>
            </h1>

            <p class="text-gray-300 text-base sm:text-lg max-w-2xl leading-relaxed">
                <?= nl2br($hero_desc); ?>
            </p>

            <!-- Quick Bullet Highlights -->
            <?php if (!empty($bullet_points) && is_array($bullet_points)) : ?>
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 pt-2 text-left">
                    <?php foreach ($bullet_points as $point) : ?>
                        <div class="flex items-center space-x-2 text-sm text-gray-200">
                            <i class="fa-solid fa-circle-check text-primary shrink-0"></i>
                            <span><?= $point; ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <!-- CTA Action Buttons -->
            <div class="pt-4 flex flex-wrap justify-center lg:justify-start gap-4">
                <?php if (!empty($btn_explore_text) && !empty($btn_explore_url)): ?>
                    <a href="<?= $btn_explore_url; ?>" class="border-2 border-white/80 hover:bg-white hover:text-navy text-white px-6 py-3 rounded font-bold text-sm tracking-wider uppercase transition">
                        <?= $btn_explore_text; ?>
                    </a>
                <?php endif; ?>

                <?php if (!empty($wa_url)): ?>
                    <a href="<?= $wa_url; ?>" target="_blank" class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-3 rounded font-bold text-sm tracking-wider uppercase transition flex items-center gap-2">
                        <i class="fa-brands fa-whatsapp text-lg"></i> <?= $wa_label; ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>

        <!-- Right Hero Lead Form -->
        <div id="konsultasi" class="lg:col-span-5 animate__animated animate__fadeInRight animate__delay-1s">
            <div class="bg-white rounded-lg p-6 sm:p-8 text-slate-800 shadow-2xl border-t-4 border-primary">

                <div class="mb-5">
                    <span class="text-xs font-bold uppercase tracking-wider text-primary"><?= $form_tagline; ?></span>
                    <h3 class="text-2xl font-black text-navy uppercase"><?= $form_title; ?></h3>
                    <p class="text-xs text-gray-500 mt-1"><?= $form_sub; ?></p>
                </div>

                <form id="heroLeadForm" class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Nama Lengkap / PIC *</label>
                        <input type="text" id="lead_name" placeholder="Contoh: Budi Santoso" class="w-full px-3 py-2.5 text-sm border border-gray-300 rounded focus:ring-2 focus:ring-primary focus:border-primary outline-none transition" required>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Nomor WhatsApp *</label>
                        <input type="tel" id="lead_phone" placeholder="0812-xxxx-xxxx" class="w-full px-3 py-2.5 text-sm border border-gray-300 rounded focus:ring-2 focus:ring-primary focus:border-primary outline-none transition" required>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Jenis Layanan / Kebutuhan *</label>
                        <select id="lead_service" class="w-full px-3 py-2.5 text-sm border border-gray-300 rounded focus:ring-2 focus:ring-primary focus:border-primary outline-none bg-white transition">
                            <?php foreach ($form_services as $service) : ?>
                                <option value="<?= $service; ?>"><?= $service; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Pesan </label>
                        <textarea id="lead_message" rows="3" placeholder="Deskripsikan Apa yang anda Carikan..." class="w-full px-3 py-2 text-sm border border-gray-300 rounded focus:ring-2 focus:ring-primary focus:border-primary outline-none transition"></textarea>
                    </div>

                    <button type="submit" class="w-full bg-primary hover:bg-primaryDark text-white py-3 rounded font-bold text-sm tracking-wider uppercase shadow-md hover:shadow-lg transition">
                        <?= $form_btn; ?>
                    </button>
                </form>

            </div>
        </div>

    </div>
</section>

<!-- Direct WhatsApp Handler Script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const heroForm = document.getElementById('heroLeadForm');
        if (heroForm) {
            heroForm.addEventListener('submit', function(e) {
                e.preventDefault();

                const name = document.getElementById('lead_name').value.trim();
                const phone = document.getElementById('lead_phone').value.trim();
                const service = document.getElementById('lead_service').value;
                const message = document.getElementById('lead_message').value.trim();

                // Ambil nomor telepon domain aktif dari database atau fallback
                let targetPhone = "<?= preg_replace('/[^0-9]/', '', is_object($domain) ? ($domain->telepon ?? '6281239602788') : ($domain['telepon'] ?? '6281239602788')); ?>";

                const waText = `*KONSULTASI Mengenai*\n\n` +
                    `• *Nama/PIC:* ${name}\n` +
                    `• *No. WhatsApp:* ${phone}\n` +
                    `• *Kebutuhan:* ${service}\n` +
                    `• *Lokasi/Catatan:* ${message || '-'}\n\n` +
                    `Halo tim ahli, mohon info estimasi biaya dan survei lokasi. Terima kasih.`;

                const finalUrl = `https://wa.me/${targetPhone}?text=${encodeURIComponent(waText)}`;
                window.open(finalUrl, '_blank');
            });
        }
    });
</script>