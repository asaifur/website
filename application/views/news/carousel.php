<!-- views/sections/carousel.php -->
<?php
$payload = !empty($section->data_payload) ? json_decode($section->data_payload, true) : [];

$dom_id   = !empty($section->span) ? $section->span : (!empty($section->section_id_dom) ? $section->section_id_dom : 'carousel-slider-section');
$title    = !empty($section->title) ? $section->title : 'Sorotan Berita & Artikel';
$subtitle = !empty($section->subtitle) ? $section->subtitle : 'Informasi Pilihan Terkini';
$anim     = $payload['animate_section'] ?? ($payload['animate'] ?? 'animate__fadeInUp');

// Data Slides Carousel / Slider
$slides = $payload['slides'] ?? $payload['carousel_items'] ?? [
    [
        'category' => 'Teknologi',
        'title' => 'Transformasi Digital Sektor Industri dan Layanan Publik',
        'desc' => 'Standar baru perancangan sistem dan infrastruktur digital modern.',
        'author' => 'Tim Redaksi',
        'date' => '2026',
        'image' => 'https://images.unsplash.com/photo-1504711434969-e33886168f5c?q=80&w=1200&auto=format&fit=crop',
        'url' => '#'
    ],
    [
        'category' => 'Bisnis',
        'title' => 'Strategi Pengembangan Ekosistem Kreatif Regional',
        'desc' => 'Perluasan jejaring kolaborasi dan peningkatan kapasitas usaha.',
        'author' => 'Admin',
        'date' => '2026',
        'image' => 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?q=80&w=1200&auto=format&fit=crop',
        'url' => '#'
    ]
];
?>

<section id="<?= $dom_id; ?>" class="py-16 bg-slate-50 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <?php if (!empty($title)): ?>
            <div class="text-center max-w-3xl mx-auto mb-12 space-y-2 reveal" data-animate="<?= $anim; ?>">
                <?php if (!empty($subtitle)): ?>
                    <span class="inline-block text-xs font-bold text-primary uppercase tracking-widest bg-primary/10 px-3 py-1 rounded-full">
                        <?= $subtitle; ?>
                    </span>
                <?php endif; ?>
                <h2 class="text-3xl font-black text-navy uppercase tracking-tight"><?= $title; ?></h2>
                <div class="w-16 h-1 bg-primary mx-auto"></div>
            </div>
        <?php endif; ?>

        <!-- Carousel Wrapper with Tailwind & Alpine.js / Pure CSS Scroll Snap Support -->
        <div class="relative reveal" data-animate="<?= $anim; ?>" x-data="{ activeSlide: 0, totalSlides: <?= count($slides); ?> }">

            <div class="overflow-hidden rounded-3xl shadow-lg border border-slate-100 bg-navy">
                <div class="flex transition-transform duration-700 ease-in-out" :style="'transform: translateX(-' + (activeSlide * 100) + '%)'">

                    <?php foreach ($slides as $index => $slide):
                        $slide_img = filter_var($slide['image'] ?? '', FILTER_VALIDATE_URL) ? $slide['image'] : base_url('assets/uploads/img/' . ($slide['image'] ?? ''));
                    ?>
                        <div class="w-full flex-shrink-0 relative h-[420px] sm:h-[480px] flex items-end">
                            <img src="<?= $slide_img; ?>" alt="<?= htmlspecialchars($slide['title'] ?? ''); ?>" class="absolute inset-0 w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-navy/95 via-navy/50 to-transparent"></div>

                            <div class="relative p-8 sm:p-12 space-y-4 z-10 max-w-3xl">
                                <?php if (!empty($slide['category'])): ?>
                                    <span class="bg-primary text-white text-xs font-bold uppercase tracking-wider px-3.5 py-1.5 rounded-full shadow-md">
                                        <?= $slide['category']; ?>
                                    </span>
                                <?php endif; ?>

                                <h3 class="text-2xl sm:text-4xl font-black text-white leading-tight">
                                    <a href="<?= $slide['url'] ?? '#'; ?>" class="hover:text-slate-200 transition-colors"><?= $slide['title'] ?? ''; ?></a>
                                </h3>

                                <?php if (!empty($slide['desc'])): ?>
                                    <p class="text-slate-300 text-sm sm:text-base leading-relaxed">
                                        <?= $slide['desc']; ?>
                                    </p>
                                <?php endif; ?>

                                <div class="text-xs text-slate-400 font-semibold pt-2">
                                    oleh <?= $slide['author'] ?? 'Admin'; ?> - <?= $slide['date'] ?? date('Y'); ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                </div>
            </div>

            <!-- Navigation Controls (Previous / Next Buttons) -->
            <?php if (count($slides) > 1): ?>
                <button @click="activeSlide = (activeSlide === 0) ? totalSlides - 1 : activeSlide - 1" class="absolute left-4 top-1/2 -translate-y-1/2 w-12 h-12 rounded-full bg-white/80 hover:bg-white text-navy flex items-center justify-center shadow-lg transition hover:scale-110 focus:outline-none z-20">
                    <i class="fa-solid fa-chevron-left text-sm"></i>
                </button>
                <button @click="activeSlide = (activeSlide === totalSlides - 1) ? 0 : activeSlide + 1" class="absolute right-4 top-1/2 -translate-y-1/2 w-12 h-12 rounded-full bg-white/80 hover:bg-white text-navy flex items-center justify-center shadow-lg transition hover:scale-110 focus:outline-none z-20">
                    <i class="fa-solid fa-chevron-right text-sm"></i>
                </button>

                <!-- Pagination Dots -->
                <div class="flex justify-center space-x-2 mt-6">
                    <?php for ($i = 0; $i < count($slides); $i++): ?>
                        <button @click="activeSlide = <?= $i; ?>" :class="activeSlide === <?= $i; ?> ? 'bg-primary w-8' : 'bg-slate-300 w-2.5'" class="h-2.5 rounded-full transition-all duration-300 focus:outline-none"></button>
                    <?php endfor; ?>
                </div>
            <?php endif; ?>

        </div>

    </div>
</section>

<!-- Alpine.js CDN for Carousel Interactivity -->
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>