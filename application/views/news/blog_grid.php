<!-- views/sections/blog_grid.php -->
<?php
$payload = !empty($section->data_payload) ? json_decode($section->data_payload, true) : [];

$dom_id   = !empty($section->span) ? $section->span : (!empty($section->section_id_dom) ? $section->section_id_dom : 'blog-grid-section');
$title    = !empty($section->title) ? $section->title : 'Berita Terbaru';
$anim     = $payload['animate_section'] ?? ($payload['animate'] ?? 'animate__fadeInUp');

// Data Artikel dari payload atau menggunakan fallback statis bawaan
$articles = $payload['articles'] ?? [
    [
        'day' => '15',
        'month' => 'Jan',
        'category' => 'Teknologi, Bisnis',
        'comments' => '03 Komentar',
        'title' => 'Google Inks Pact for New 35-Storey Office Tower',
        'excerpt' => 'That dominion stars lights dominion divide years for fourth have don\'t stars is that he earth it first without heaven in place seed it second morning saying.',
        'image' => 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?q=80&w=600&auto=format&fit=crop',
        'url' => '#'
    ],
    [
        'day' => '16',
        'month' => 'Jan',
        'category' => 'Lifestyle',
        'comments' => '05 Komentar',
        'title' => 'Inovasi Arsitektur Ruang Kerja Modern yang Ergonomis',
        'excerpt' => 'Penerapan konsep ramah lingkungan dan sirkulasi udara optimal menjadi standar utama pembangunan gedung perkantoran masa kini.',
        'image' => 'https://images.unsplash.com/photo-1519389950473-47ba0277781c?q=80&w=600&auto=format&fit=crop',
        'url' => '#'
    ]
];

// Data Sidebar Kategori
$categories = $payload['categories'] ?? [
    ['name' => 'Teknologi', 'count' => '37', 'url' => '#'],
    ['name' => 'Bisnis & Kuliner', 'count' => '19', 'url' => '#'],
    ['name' => 'Gaya Hidup', 'count' => '11', 'url' => '#'],
    ['name' => 'Edukasi', 'count' => '24', 'url' => '#']
];

// Data Berita Populer Sidebar
$popular_posts = $payload['popular_posts'] ?? [
    [
        'title' => 'Tips Mengelola Keuangan Bisnis Kuliner Skala Kecil',
        'date' => '01 Sep 2026',
        'image' => 'https://images.unsplash.com/photo-1517841905240-472988babdf9?q=80&w=150&auto=format&fit=crop',
        'url' => '#'
    ],
    [
        'title' => 'Kolaborasi Antar Asosiasi Kreatif Regional',
        'date' => '31 Agu 2026',
        'image' => 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?q=80&w=150&auto=format&fit=crop',
        'url' => '#'
    ]
];
?>

<section id="<?= $dom_id; ?>" class="py-12 bg-white border-t border-slate-100 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 reveal" data-animate="<?= $anim; ?>">

            <!-- Blog List Container -->
            <div class="lg:col-span-8 space-y-8">
                <h3 class="text-xl font-black text-navy uppercase tracking-tight border-b-2 border-primary pb-3 inline-block">
                    <?= $title; ?>
                </h3>

                <?php foreach ($articles as $art):
                    $art_img = filter_var($art['image'] ?? '', FILTER_VALIDATE_URL) ? $art['image'] : base_url('assets/uploads/img/' . ($art['image'] ?? ''));
                ?>
                    <!-- Article Item -->
                    <article class="bg-white rounded-2xl overflow-hidden border border-slate-100 shadow-sm md:flex">
                        <div class="md:w-5/12 relative h-60 md:h-auto">
                            <img src="<?= $art_img; ?>" alt="<?= htmlspecialchars($art['title'] ?? ''); ?>" class="w-full h-full object-cover">
                            <div class="absolute top-4 left-4 bg-primary text-white text-center rounded-lg px-3 py-1 shadow-md">
                                <span class="block text-lg font-black leading-none"><?= $art['day'] ?? '15'; ?></span>
                                <span class="block text-[10px] uppercase font-bold tracking-wider"><?= $art['month'] ?? 'Jan'; ?></span>
                            </div>
                        </div>
                        <div class="md:w-7/12 p-6 flex flex-col justify-between">
                            <div>
                                <ul class="flex space-x-4 text-xs font-semibold text-slate-400 mb-2">
                                    <li><a href="#" class="hover:text-primary"><i class="fa fa-user mr-1"></i> <?= $art['category'] ?? 'Umum'; ?></a></li>
                                    <li><a href="#" class="hover:text-primary"><i class="fa fa-comments mr-1"></i> <?= $art['comments'] ?? '0 Komentar'; ?></a></li>
                                </ul>
                                <h2 class="text-xl font-bold text-navy hover:text-primary transition-colors mb-3">
                                    <a href="<?= $art['url'] ?? '#'; ?>"><?= $art['title'] ?? ''; ?></a>
                                </h2>
                                <p class="text-slate-600 text-sm leading-relaxed mb-4">
                                    <?= $art['excerpt'] ?? ''; ?>
                                </p>
                            </div>
                            <a href="<?= $art['url'] ?? '#'; ?>" class="inline-flex items-center text-xs font-bold text-primary uppercase tracking-wider hover:underline">
                                Baca Selengkapnya <i class="fa-solid fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </article>
                <?php endforeach; ?>

            </div>

            <!-- Right Sidebar Widget Area -->
            <div class="lg:col-span-4 space-y-6">

                <!-- Search Widget -->
                <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100">
                    <h4 class="text-sm font-bold text-navy uppercase tracking-wider mb-4">Pencarian</h4>
                    <form action="#" method="get" class="flex gap-2">
                        <input type="text" placeholder="Kata kunci..." class="w-full px-4 py-2.5 text-sm bg-white border border-slate-200 rounded-xl focus:outline-none focus:border-primary">
                        <button type="submit" class="bg-primary text-white px-4 py-2.5 rounded-xl font-bold text-sm"><i class="ti-search"></i></button>
                    </form>
                </div>

                <!-- Categories Widget -->
                <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100">
                    <h4 class="text-sm font-bold text-navy uppercase tracking-wider mb-4">Kategori</h4>
                    <ul class="space-y-3 text-sm font-medium text-slate-600">
                        <?php foreach ($categories as $cat): ?>
                            <li>
                                <a href="<?= $cat['url'] ?? '#'; ?>" class="flex justify-between hover:text-primary transition-colors">
                                    <span><?= $cat['name']; ?></span>
                                    <span class="bg-slate-200 text-slate-700 px-2 py-0.5 rounded text-xs"><?= $cat['count']; ?></span>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <!-- Popular Posts Widget -->
                <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100">
                    <h4 class="text-sm font-bold text-navy uppercase tracking-wider mb-4">Berita Populer</h4>
                    <div class="space-y-4">
                        <?php foreach ($popular_posts as $pop):
                            $pop_img = filter_var($pop['image'] ?? '', FILTER_VALIDATE_URL) ? $pop['image'] : base_url('assets/uploads/img/' . ($pop['image'] ?? ''));
                        ?>
                            <div class="flex items-center space-x-4">
                                <img src="<?= $pop_img; ?>" alt="Thumbnail" class="w-16 h-16 object-cover rounded-xl">
                                <div>
                                    <h5 class="text-xs font-bold text-navy hover:text-primary leading-snug">
                                        <a href="<?= $pop['url'] ?? '#'; ?>"><?= $pop['title']; ?></a>
                                    </h5>
                                    <p class="text-[11px] text-slate-400 mt-1"><?= $pop['date']; ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>