<?php
$payload = !empty($section->data_payload) ? json_decode($section->data_payload, true) : [];

$dom_id   = !empty($section->span) ? $section->span : 'header-page';
$title    = !empty($section->title) ? $section->title : 'Judul Halaman';
$content  = !empty($section->content) ? $section->content : '';
$bg_img   = !empty($section->image) ? (filter_var($section->image, FILTER_VALIDATE_URL) ? $section->image : base_url('assets/uploads/img/' . $section->image)) : 'https://images.unsplash.com/photo-1556910103-1c02745aae4d?q=80&w=1920&auto=format&fit=crop';

$breadcrumbs = $payload['breadcrumbs'] ?? [];
$overlay = $payload['bg_overlay'] ?? 'bg-navy/80';
?>
<section id="<?= $dom_id; ?>" class="relative pt-32 pb-16 lg:pt-40 lg:pb-20 overflow-hidden bg-navy bg-center bg-cover bg-fixed" style="background-image: url('<?= $bg_img; ?>');">
    <!-- Overlay warna solid transparan tanpa efek gradasi -->
    <div class="absolute inset-0 <?= $overlay; ?>"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center reveal" data-animate="animate__fadeInDown">
        <h1 class="text-4xl md:text-5xl font-black text-white uppercase tracking-tight mb-4">
            <?= $title; ?>
        </h1>

        <?php if (!empty($content)): ?>
            <p class="text-slate-300 text-sm md:text-base max-w-2xl mx-auto mb-6">
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
                            <li><i class="fa-solid fa-chevron-right text-[10px] text-slate-500 mx-2"></i></li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ol>
            </nav>
        <?php endif; ?>
    </div>
</section>