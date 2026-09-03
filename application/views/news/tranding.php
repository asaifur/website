<!-- views/sections/tranding.php -->
<?php
$payload = !empty($section->data_payload) ? json_decode($section->data_payload, true) : [];

$dom_id   = !empty($section->span) ? $section->span : (!empty($section->section_id_dom) ? $section->section_id_dom : 'trending-section');
$anim     = $payload['animate_section'] ?? ($payload['animate'] ?? 'animate__fadeInUp');

// Data untuk Main Hero / Slider Kiri
$main_hero = $payload['main_hero'] ?? [
    'category' => !empty($section->subtitle) ? $section->subtitle : 'Teknologi',
    'title'    => !empty($section->title) ? $section->title : 'Transformasi Digital Nasional Memasuki Babak Baru di Tahun 2026',
    'content'  => !empty($section->content) ? $section->content : 'oleh Tim Redaksi - 01 September 2026',
    'image'    => !empty($section->image) ? (filter_var($section->image, FILTER_VALIDATE_URL) ? $section->image : base_url('assets/uploads/img/' . $section->image)) : 'https://images.unsplash.com/photo-1504711434969-e33886168f5c?q=80&w=1200&auto=format&fit=crop',
    'url'      => !empty($section->btn_url) ? $section->btn_url : '#'
];

// Data untuk Sidebar Cards Kanan (Maksimal 2 item)
$sidebar_cards = $payload['sidebar_cards'] ?? [
    [
        'category' => 'Bisnis',
        'badge_bg' => 'bg-blue-600',
        'title'    => 'Strategi Pertumbuhan UMKM Kreatif di Jabodetabek',
        'meta'     => 'oleh Admin - 01 Sep',
        'image'    => 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?q=80&w=800&auto=format&fit=crop',
        'url'      => '#'
    ],
    [
        'category' => 'Edukasi',
        'badge_bg' => 'bg-emerald-600',
        'title'    => 'Peningkatan Mutu Publikasi Ilmiah Perguruan Tinggi',
        'meta'     => 'oleh Redaksi - 31 Agu',
        'image'    => 'https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?q=80&w=800&auto=format&fit=crop',
        'url'      => '#'
    ]
];
?>

<section id="<?= $dom_id; ?>" class="trending-area fix pt-6 pb-12 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="trending-main">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 reveal" data-animate="<?= $anim; ?>">

                <!-- Left Main Slider/Hero -->
                <div class="lg:col-span-8">
                    <div class="bg-navy rounded-2xl overflow-hidden shadow-lg relative group h-[450px] flex items-end">
                        <img src="<?= $main_hero['image']; ?>" alt="<?= htmlspecialchars($main_hero['title']); ?>" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-navy/90 via-navy/40 to-transparent"></div>
                        <div class="relative p-8 space-y-3 z-10">
                            <?php if (!empty($main_hero['category'])): ?>
                                <span class="bg-primary text-white text-xs font-bold uppercase tracking-wider px-3 py-1 rounded shadow-sm">
                                    <?= $main_hero['category']; ?>
                                </span>
                            <?php endif; ?>
                            <h1 class="text-2xl sm:text-3xl font-black text-white leading-tight hover:text-slate-200 transition-colors">
                                <a href="<?= $main_hero['url']; ?>"><?= $main_hero['title']; ?></a>
                            </h1>
                            <?php if (!empty($main_hero['content'])): ?>
                                <p class="text-slate-300 text-xs sm:text-sm"><?= $main_hero['content']; ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Right Sidebar Cards -->
                <div class="lg:col-span-4 flex flex-col justify-between space-y-6">
                    <?php foreach ($sidebar_cards as $card):
                        $card_bg = $card['badge_bg'] ?? 'bg-primary';
                        $card_img = filter_var($card['image'] ?? '', FILTER_VALIDATE_URL) ? $card['image'] : base_url('assets/uploads/img/' . ($card['image'] ?? ''));
                    ?>
                        <div class="bg-white rounded-2xl overflow-hidden shadow-sm border border-slate-100 relative group h-[213px] flex items-end">
                            <img src="<?= $card_img; ?>" alt="<?= htmlspecialchars($card['title'] ?? ''); ?>" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-navy/90 via-navy/30 to-transparent"></div>
                            <div class="relative p-5 space-y-1.5 z-10">
                                <?php if (!empty($card['category'])): ?>
                                    <span class="<?= $card_bg; ?> text-white text-[10px] font-bold uppercase tracking-wider px-2.5 py-0.5 rounded">
                                        <?= $card['category']; ?>
                                    </span>
                                <?php endif; ?>
                                <h2 class="text-base font-bold text-white leading-snug">
                                    <a href="<?= $card['url'] ?? '#'; ?>"><?= $card['title'] ?? ''; ?></a>
                                </h2>
                                <?php if (!empty($card['meta'])): ?>
                                    <p class="text-slate-300 text-[11px]"><?= $card['meta']; ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

            </div>
        </div>
    </div>
</section>