<?php
// 1. Instansiasi CI untuk Query Database
$ci = &get_instance();

// 2. Parsing payload JSON untuk pengaturan feed berita
$payload = [];
if (!empty($section->data_payload)) {
    $payload = is_array($section->data_payload) ? $section->data_payload : json_decode($section->data_payload, true);
}

// 3. Konfigurasi Feed dari Payload
$category_id = $payload['category_id'] ?? '3'; // Ganti ID sesuai kategori Blog/Berita di tabel Anda
$limit       = $payload['limit_items'] ?? 3;
$anim        = $payload['animate_items'] ?? 'animate__fadeInUp';

// 4. Query langsung ke table_pages (Kategori Blog/Berita)
$domain_id = $domain->id ?? 1;
$news_feed = $ci->db->select('id_page, title, slug, image_features, meta_description, created_at')
    ->where('id_domain', $domain_id)
    ->where('category', $category_id)
    ->order_by('id_page', 'DESC') // Ambil yang paling baru
    ->limit($limit)
    ->get('table_pages')
    ->result();

// 5. Data Teks Statis Section Fallback
$dom_id   = !empty($section->span) ? $section->span : (!empty($section->section_id_dom) ? $section->section_id_dom : 'berita');
$tagline  = !empty($section->subtitle) ? $section->subtitle : 'Berita Terbaru';
$title    = !empty($section->title) ? $section->title : 'Artikel & Tips Dapur Komersial';
$btn_text = !empty($section->btn_text) ? $section->btn_text : 'Lihat Semua Artikel';
$btn_url  = !empty($section->btn_url) ? $section->btn_url : base_url('');
?>

<section id="<?= $dom_id; ?>" class="py-20 bg-slate-50 border-t border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-16 space-y-3 reveal" data-animate="animate__fadeInDown">
            <?php if (!empty($tagline)) : ?>
                <span class="text-xs font-bold text-primary uppercase tracking-widest"><?= $tagline; ?></span>
            <?php endif; ?>

            <h2 class="text-3xl sm:text-4xl font-black text-navy uppercase"><?= $title; ?></h2>
            <div class="w-16 h-1 bg-primary mx-auto"></div>

            <?php if (!empty($section->content)) : ?>
                <p class="text-sm text-gray-500 mt-3"><?= nl2br($section->content); ?></p>
            <?php endif; ?>
        </div>

        <!-- News / Blog Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <?php if (!empty($news_feed)) : ?>
                <?php foreach ($news_feed as $news) :
                    // Fallback gambar jika tidak ada featured image
                    $img_src = !empty($news->image_features)
                        ? base_url('assets/uploads/img/' . $news->image_features)
                        : 'https://kitchentools.id/uploads/img/6d14fb972f20e77e66b815af9056044e.jpg';

                    // Format Tanggal (misal: 25 Aug 2026)
                    $tgl_post = !empty($news->created_at) ? date('d M Y', strtotime($news->created_at)) : date('d M Y');
                ?>
                    <!-- Blog Card -->
                    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden group hover:shadow-xl transition-all duration-300 reveal flex flex-col" data-animate="<?= $anim; ?>">

                        <!-- Image Container -->
                        <a href="<?= base_url($news->slug); ?>" class="block relative h-56 overflow-hidden">
                            <img src="<?= $img_src; ?>" alt="<?= html_escape($news->title); ?>" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            <!-- Overlay Kategori (Opsional) -->
                            <div class="absolute top-4 left-4 bg-primary text-white text-[10px] font-bold uppercase tracking-wider px-3 py-1 rounded shadow-md">
                                Tips & Trik
                            </div>
                        </a>

                        <!-- Content Body -->
                        <div class="p-6 flex-1 flex flex-col">
                            <!-- Meta Info -->
                            <div class="flex items-center text-xs text-slate-400 mb-3 space-x-4">
                                <span class="flex items-center"><i class="fa-regular fa-calendar mr-1.5 text-primary"></i> <?= $tgl_post; ?></span>
                                <span class="flex items-center"><i class="fa-regular fa-user mr-1.5 text-primary"></i> Admin</span>
                            </div>

                            <!-- Title -->
                            <a href="<?= base_url($news->slug); ?>" class="block group-hover:text-primary transition-colors">
                                <h3 class="text-lg font-bold text-navy leading-tight mb-3 line-clamp-2">
                                    <?= $news->title; ?>
                                </h3>
                            </a>

                            <!-- Excerpt -->
                            <p class="text-sm text-slate-600 line-clamp-3 mb-5 flex-1">
                                <?= !empty($news->meta_description) ? $news->meta_description : character_limiter(strip_tags($news->content ?? ''), 100); ?>
                            </p>

                            <!-- Read More Link -->
                            <div class="mt-auto">
                                <a href="<?= base_url($news->slug); ?>" class="inline-flex items-center text-xs font-bold text-primary uppercase tracking-wider hover:text-primaryDark transition">
                                    Baca Selengkapnya <i class="fa-solid fa-arrow-right ml-1.5 transition-transform group-hover:translate-x-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- Tombol Call To Action Bawah (Opsional) -->
        <?php if (!empty($btn_text) && !empty($btn_url)) : ?>
            <div class="mt-12 text-center reveal" data-animate="animate__fadeInUp">
                <a href="<?= (strpos($btn_url, 'http') === 0 || strpos($btn_url, '#') === 0) ? $btn_url : base_url($btn_url); ?>" class="inline-flex items-center gap-2 border-2 border-primary text-primary hover:bg-primary hover:text-white px-8 py-3 rounded font-bold text-sm tracking-wider uppercase transition">
                    <?= $btn_text; ?>
                </a>
            </div>
        <?php endif; ?>

    </div>
</section>