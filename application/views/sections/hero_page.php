<!-- views/sections/header_page.php -->
<?php
$payload = !empty($section->data_payload) ? json_decode($section->data_payload, true) : [];

$dom_id   = !empty($section->span) ? $section->span : (!empty($section->section_id_dom) ? $section->section_id_dom : 'header-page');
$title    = !empty($section->title) ? $section->title : 'Mitra Terpercaya Kontraktor Dapur Komersial';
$content  = !empty($section->content) ? $section->content : 'Spesialis Ducting Exhaust System, Fresh Air, Jaringan Gas Komersial, dan Fabrikasi Stainless Steel Kustom untuk Restoran dan Hotel.';
$bg_img   = !empty($section->image) ? (filter_var($section->image, FILTER_VALIDATE_URL) ? $section->image : base_url('assets/uploads/img/' . $section->image)) : 'https://images.unsplash.com/photo-1556910103-1c02745aae4d?q=80&w=1920&auto=format&fit=crop';

$breadcrumbs = $payload['breadcrumbs'] ?? [];
$overlay = $payload['bg_overlay'] ?? 'bg-navy/85';
?>

<section id="<?= $dom_id; ?>" class="relative pt-32 pb-20 lg:pt-40 lg:pb-28 overflow-hidden bg-navy bg-center bg-cover bg-fixed border-b-4 border-primary" style="background-image: url('<?= $bg_img; ?>');">
    <!-- Overlay Transparan -->
    <div class="absolute inset-0 <?= $overlay; ?>"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center reveal" data-animate="animate__fadeInDown">
        <div class="inline-flex items-center gap-2 bg-primary/20 border border-primary/40 px-3.5 py-1.5 rounded-full text-red-400 font-semibold text-xs tracking-wide uppercase mb-4">
            <i class="fa-solid fa-shield-halved"></i> Standar SNI & Food Grade SUS 304
        </div>

        <h1 class="text-3xl sm:text-4xl md:text-5xl font-black text-white uppercase tracking-tight max-w-4xl mx-auto mb-6 leading-tight">
            <?= $title; ?>
        </h1>

        <?php if (!empty($content)): ?>
            <p class="text-gray-300 text-sm sm:text-base max-w-2xl mx-auto mb-8 leading-relaxed">
                <?= $content; ?>
            </p>
        <?php endif; ?>

        <!-- Breadcrumbs -->
        <?php if (!empty($breadcrumbs) && is_array($breadcrumbs)): ?>
            <nav class="flex justify-center" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3 bg-white/10 px-4 py-2 rounded-full backdrop-blur-sm border border-white/20">
                    <?php foreach ($breadcrumbs as $idx => $bc): ?>
                        <li class="inline-flex items-center">
                            <a href="<?= $bc['url']; ?>" class="inline-flex items-center text-xs font-medium text-slate-300 hover:text-primary transition">
                                <?= $bc['label']; ?>
                            </a>
                        </li>
                        <?php if ($idx < count($breadcrumbs) - 1): ?>
                            <li><i class="fa-solid fa-chevron-right text-[10px] text-slate-400 mx-2"></i></li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ol>
            </nav>
        <?php endif; ?>
    </div>
</section>