<?php
// 1. Parsing payload JSON utama
$payload = [];
if (!empty($section->data_payload)) {
    $payload = is_array($section->data_payload) ? $section->data_payload : json_decode($section->data_payload, true);
}
// 2. Ekstrak array 'services' dan 'featured_post' dari dalam payload
$services = $payload['services'] ?? [];
$featured_post = $payload['featured_post'] ?? null;

// 3. Data Fallback / Header Section
$dom_id   = !empty($section->span) ? $section->span : (!empty($section->section_id_dom) ? $section->section_id_dom : 'menu-kopi');
$tagline  = !empty($section->subtitle) ? $section->subtitle : 'Menu Spesial';
$title    = !empty($section->title) ? $section->title : 'Pilihan Varian Kopi Terbaik Kami';
$content  = !empty($section->content) ? $section->content : 'Nikmati berbagai pilihan racikan kopi nusantara berkualitas tinggi.';
$anim     = $payload['animate_section'] ?? ($payload['animate'] ?? 'animate__fadeInUp');

// 4. Default URL WhatsApp Pesan Cepat
$default_wa = !empty($domain->wa_link) ? $domain->wa_link : 'https://wa.me/6281239602788';
$domain_name = is_object($domain) ? ($domain->domain_name ?? 'Amiraw Kopi') : ($domain['domain_name'] ?? 'Amiraw Kopi');
?>

<section id="<?= $dom_id; ?>" class="py-20 bg-slate-50 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-16 space-y-3 reveal" data-animate="<?= $anim; ?>">
            <?php if (!empty($tagline)) : ?>
                <span class="inline-block text-xs font-bold text-primary uppercase tracking-widest bg-primary/10 px-3 py-1 rounded-full">
                    <?= $tagline; ?>
                </span>
            <?php endif; ?>

            <h2 class="text-3xl sm:text-4xl font-black text-navy uppercase tracking-tight"><?= $title; ?></h2>
            <div class="w-16 h-1 bg-primary mx-auto"></div>

            <?php if (!empty($content)) : ?>
                <p class="text-slate-600 text-sm sm:text-base leading-relaxed"><?= nl2br($content); ?></p>
            <?php endif; ?>
        </div>

        <!-- Featured Post Banner (Jika ada di data_payload) -->
        <?php if (!empty($featured_post)) :
            $fp_title = $featured_post['title'] ?? '';
            $fp_excerpt = $featured_post['excerpt'] ?? ($featured_post['content'] ?? '');
            $fp_image = $featured_post['image'] ?? '';
            $fp_author = $featured_post['author'] ?? 'Admin';
            $fp_date = $featured_post['date'] ?? date('Y');
            $fp_url = $featured_post['url'] ?? '#';

            if (!empty($fp_image)) {
                $fp_img_url = filter_var($fp_image, FILTER_VALIDATE_URL) ? $fp_image : base_url('assets/uploads/img/' . $fp_image);
            }
        ?>
            <div class="mb-16 bg-white rounded-3xl overflow-hidden shadow-sm border border-slate-100 lg:flex items-center reveal" data-animate="<?= $anim; ?>">
                <?php if (!empty($fp_image)) : ?>
                    <div class="lg:w-1/2 h-64 lg:h-auto overflow-hidden relative">
                        <img src="<?= $fp_img_url; ?>" alt="<?= htmlspecialchars($fp_title); ?>" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                        <span class="absolute top-4 left-4 bg-navy text-white text-[10px] font-bold uppercase tracking-wider px-3.5 py-1.5 rounded-full shadow-md">
                            Featured Highlight
                        </span>
                    </div>
                <?php endif; ?>
                <div class="lg:w-1/2 p-8 lg:p-12 flex flex-col justify-center space-y-4">
                    <div class="flex items-center gap-3 text-xs text-slate-400 font-semibold uppercase tracking-wider">
                        <span><i class="fa-regular fa-user mr-1"></i> <?= $fp_author; ?></span>
                        <span>•</span>
                        <span><i class="fa-regular fa-calendar mr-1"></i> <?= $fp_date; ?></span>
                    </div>
                    <h3 class="text-2xl lg:text-3xl font-bold text-navy hover:text-primary transition-colors">
                        <a href="<?= $fp_url; ?>"><?= $fp_title; ?></a>
                    </h3>
                    <?php if (!empty($fp_excerpt)) : ?>
                        <p class="text-slate-600 text-sm sm:text-base leading-relaxed">
                            <?= $fp_excerpt; ?>
                        </p>
                    <?php endif; ?>
                    <div class="pt-2">
                        <a href="<?= $fp_url; ?>" class="inline-flex items-center gap-2 text-xs font-bold text-primary uppercase tracking-wider bg-primary/10 hover:bg-primary hover:text-white px-5 py-3 rounded-xl transition-colors">
                            Baca Selengkapnya <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- Services / Menu Grid -->
        <?php if (!empty($services) && is_array($services)) : ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 reveal" data-animate="<?= $anim; ?>">
                <?php foreach ($services as $srv) :
                    $menu_title = $srv['title'] ?? 'Layanan';

                    // Format pesan WhatsApp dinamis berdasarkan payload atau fallback otomatis
                    $custom_wa_msg = $srv['whatsapp_message'] ?? "Halo {$domain_name}, saya tertarik dengan layanan *{$menu_title}*. Mohon info detail dan ketersediaannya. Terima kasih.";
                    $wa_link_menu = "https://wa.me/" . preg_replace('/[^0-9]/', '', $default_wa) . "?text=" . urlencode($custom_wa_msg);

                    // Resolve Image URL
                    $has_image = !empty($srv['image']);
                    if ($has_image) {
                        $img_url = filter_var($srv['image'], FILTER_VALIDATE_URL) ? $srv['image'] : base_url('assets/uploads/img/' . $srv['image']);
                    }
                ?>
                    <!-- Card Item -->
                    <div class="bg-white rounded-2xl overflow-hidden shadow-sm border border-slate-100 hover:shadow-xl hover:-translate-y-2 transition-all duration-300 flex flex-col justify-between group relative">

                        <?php if ($has_image): ?>
                            <!-- Card Header Image -->
                            <div class="h-48 overflow-hidden relative">
                                <img src="<?= $img_url; ?>" alt="<?= htmlspecialchars($menu_title); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">

                                <!-- Badge Label di atas Gambar (Jika ada) -->
                                <?php if (!empty($srv['badge'])): ?>
                                    <span class="absolute top-4 right-4 bg-primary text-white text-[10px] font-bold uppercase tracking-wider px-3 py-1 rounded shadow-md">
                                        <?= $srv['badge']; ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <!-- Card Body -->
                        <div class="p-6 flex-1 flex flex-col justify-between">
                            <div>
                                <!-- Jika tidak ada gambar, tampilkan icon sebagai pengganti visual atas -->
                                <?php if (!$has_image && !empty($srv['icon'])): ?>
                                    <div class="w-12 h-12 rounded-xl bg-primary/10 text-primary flex items-center justify-center text-xl mb-4 group-hover:bg-primary group-hover:text-white transition-colors">
                                        <i class="fa-solid <?= $srv['icon']; ?>"></i>
                                    </div>
                                <?php endif; ?>

                                <!-- Badge jika tidak ada gambar -->
                                <?php if (!$has_image && !empty($srv['badge'])): ?>
                                    <span class="text-[10px] font-bold uppercase tracking-wider text-primary"><?= $srv['badge']; ?></span>
                                <?php endif; ?>

                                <!-- Title -->
                                <h3 class="text-xl font-bold text-navy mb-2 group-hover:text-primary transition-colors">
                                    <?= $menu_title; ?>
                                </h3>

                                <!-- Description -->
                                <p class="text-slate-600 text-sm leading-relaxed mb-6">
                                    <?= $srv['desc'] ?? ''; ?>
                                </p>
                            </div>

                            <!-- Footer (Harga / Tombol Aksi) -->
                            <div class="pt-4 border-t border-slate-100 flex items-center justify-between mt-auto">
                                <?php if (!empty($srv['price'])): ?>
                                    <span class="text-base font-black text-navy">
                                        <?= $srv['price']; ?>
                                    </span>
                                <?php else: ?>
                                    <span class="text-xs text-slate-400 font-semibold uppercase">Tersedia</span>
                                <?php endif; ?>

                                <a href="<?= $wa_link_menu; ?>" target="_blank" class="inline-flex items-center gap-1.5 text-xs font-bold text-primary uppercase tracking-wider hover:underline bg-primary/10 hover:bg-primary hover:text-white px-3.5 py-2 rounded-lg transition-colors">
                                    <i class="fa-brands fa-whatsapp text-sm"></i> <?= $srv['link_text'] ?? 'Pesan'; ?>
                                </a>
                            </div>

                        </div>

                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </div>
</section>