<?php
// 1. Parsing payload JSON
$payload = [];
if (!empty($section->data_payload)) {
    $payload = is_array($section->data_payload) ? $section->data_payload : json_decode($section->data_payload, true);
}

// 2. Data Fallback Default
$dom_id   = !empty($section->span) ? $section->span : (!empty($section->section_id_dom) ? $section->section_id_dom : 'kontak-kami');
$tagline  = !empty($section->subtitle) ? $section->subtitle : 'Hubungi Kami';
$title    = !empty($section->title) ? $section->title : 'Mari Diskusikan Proyek Dapur Anda';
$content  = !empty($section->content) ? $section->content : 'Tim ahli kami siap memberikan konsultasi dan estimasi biaya gratis.';
$btn_text = !empty($section->btn_text) ? $section->btn_text : 'Kirim Pesan via WhatsApp';

$default_maps = "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.207431111!2d106.82715!3d-6.3855!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwMjMnOC44IlMgMTA2wrA0OSwzNy44IkU!5e0!3m2!1sen!2sid!4v1234567890";

$maps_raw = $payload['maps_iframe_src'] ?? ($domain->iframe ?? $default_maps);

// If database stores an entire <iframe> HTML tag instead of just the URL, extract the src
if (str_contains($maps_raw, '<iframe')) {
    preg_match('/src="([^"]+)"/', $maps_raw, $match);
    $maps_src = $match[1] ?? $default_maps;
} else {
    $maps_src = !empty(trim($maps_raw)) ? $maps_raw : $default_maps;
}

// Default Info Cards
$info_cards = $payload['info_cards'] ?? [
    ['icon' => 'fa-location-dot', 'title' => 'Workshop Kami', 'desc' => $domain->alamat ?? 'Depok, Jawa Barat'],
    ['icon' => 'fa-phone-volume', 'title' => 'Telepon / WA', 'desc' => $domain->telepon ?? '+62 812-3456-7890'],
    ['icon' => 'fa-envelope-open-text', 'title' => 'Email', 'desc' => $domain->email ?? 'info@solusidapurrestoran.com']
];
?>

<section id="<?= $dom_id; ?>" class="py-20 bg-slate-50 relative overflow-hidden">
    <!-- Dekorasi Background -->
    <div class="absolute top-0 right-0 w-64 h-64 bg-primary/5 rounded-full blur-3xl"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        <!-- Header Halaman Kontak -->
        <div class="text-center max-w-3xl mx-auto mb-16 space-y-3 reveal" data-animate="animate__fadeInDown">
            <span class="text-xs font-bold text-primary uppercase tracking-widest"><?= $tagline; ?></span>
            <h2 class="text-3xl sm:text-4xl font-black text-navy uppercase"><?= $title; ?></h2>
            <div class="w-16 h-1 bg-primary mx-auto"></div>
            <p class="text-gray-600 text-sm"><?= nl2br($content); ?></p>
        </div>

        <!-- Info Cards 3 Kolom -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12 reveal" data-animate="animate__fadeInUp">
            <?php foreach ($info_cards as $card): ?>
                <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm flex flex-col items-center text-center hover:shadow-lg hover:border-primary/30 transition-all group">
                    <div class="w-14 h-14 bg-red-50 text-primary rounded-full flex items-center justify-center text-xl mb-4 group-hover:bg-primary group-hover:text-white transition-colors duration-300">
                        <i class="fa-solid <?= $card['icon']; ?>"></i>
                    </div>
                    <h4 class="font-bold text-navy mb-2"><?= $card['title']; ?></h4>
                    <p class="text-sm text-slate-500"><?= $card['desc']; ?></p>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Grid Form & Maps -->
        <div class="bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden reveal" data-animate="animate__fadeInUp">
            <div class="grid grid-cols-1 lg:grid-cols-2">

                <!-- Kiri: Form Pesan -->
                <div class="p-8 lg:p-12">
                    <h3 class="text-2xl font-black text-navy uppercase mb-2">Tinggalkan Pesan</h3>
                    <p class="text-sm text-slate-500 mb-8">Isi formulir di bawah ini dan representatif kami akan segera menghubungi Anda kembali.</p>

                    <form id="contactPageForm" class="space-y-5">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Nama Lengkap *</label>
                                <input type="text" id="cp_name" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-primary focus:border-primary outline-none transition" required>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Nomor WhatsApp *</label>
                                <input type="tel" id="cp_phone" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-primary focus:border-primary outline-none transition" required>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Topik / Kebutuhan *</label>
                            <select id="cp_topic" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-primary focus:border-primary outline-none transition cursor-pointer">
                                <option>Konsultasi & Estimasi Harga (RAB)</option>
                                <option>Permintaan Jadwal Survei Lokasi</option>
                                <option>Perawatan / Service Peralatan</option>
                                <option>Penawaran Kerjasama / Tender</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Pesan Lengkap *</label>
                            <textarea id="cp_message" rows="4" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-primary focus:border-primary outline-none transition" required placeholder="Tuliskan rincian kebutuhan Anda..."></textarea>
                        </div>

                        <button type="submit" class="w-full bg-primary hover:bg-primaryDark text-white py-3.5 rounded-lg font-bold text-sm tracking-wider uppercase shadow-lg shadow-red-900/20 hover:shadow-red-900/40 transition flex items-center justify-center gap-2">
                            <i class="fa-brands fa-whatsapp text-lg"></i> <?= $btn_text; ?>
                        </button>
                    </form>
                </div>

                <!-- Kanan: Google Maps Iframe -->
                <div class="h-[400px] lg:h-auto w-full bg-slate-200 relative">
                    <iframe
                        src="<?= filter_var($maps_src, FILTER_SANITIZE_URL); ?>"
                        class="absolute inset-0 w-full h-full border-0"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>

            </div>
        </div>

    </div>
</section>

<!-- Script Redirect Form Kontak ke WhatsApp -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const contactForm = document.getElementById('contactPageForm');
        if (contactForm) {
            contactForm.addEventListener('submit', function(e) {
                e.preventDefault();

                const name = document.getElementById('cp_name').value.trim();
                const phone = document.getElementById('cp_phone').value.trim();
                const topic = document.getElementById('cp_topic').value;
                const message = document.getElementById('cp_message').value.trim();

                // Ambil nomor WA target (pastikan membuang karakter non-angka)
                let targetPhone = "<?= preg_replace('/[^0-9]/', '', $domain->telepon ?? '6281234567890'); ?>";

                const waText = `*FORM KONTAK WEBSITE*\n\n` +
                    `• *Nama:* ${name}\n` +
                    `• *No. WA:* ${phone}\n` +
                    `• *Topik:* ${topic}\n` +
                    `• *Pesan:* ${message}\n\n` +
                    `Mohon segera direspon. Terima kasih.`;

                const finalUrl = `https://wa.me/${targetPhone}?text=${encodeURIComponent(waText)}`;
                window.open(finalUrl, '_blank');
            });
        }
    });
</script>