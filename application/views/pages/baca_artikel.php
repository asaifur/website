<?php
// Normalisasi data artikel (Mendukung bentuk Object maupun Array dari Database)
$is_obj = is_object($post);

$title       = $is_obj ? ($post->title ?? 'Detail Artikel') : ($post['title'] ?? 'Detail Artikel');
$content     = $is_obj ? ($post->content ?? '') : ($post['content'] ?? '');
$category    = $is_obj ? ($post->category ?? 'Edukasi') : ($post['category'] ?? 'Edukasi');
$created_at  = $is_obj ? ($post->created_at ?? date('Y-m-d H:i:s')) : ($post['created_at'] ?? date('Y-m-d H:i:s'));
$image       = $is_obj ? ($post->image_features ?? '') : ($post['image_features'] ?? '');

// Format Tanggal
$formatted_date = date('d M Y', strtotime($created_at));

// Resolve Image URL
if (empty($image)) {
    $img_url = 'https://images.unsplash.com/photo-1556910103-1c02745aae4d?q=80&w=1200&auto=format&fit=crop';
} else {
    $img_url = filter_var($image, FILTER_VALIDATE_URL) ? $image : base_url('assets/uploads/img/' . $image);
}
?>

<!-- Header / Breadcrumb Section -->
<div class="bg-navy pt-32 pb-12 text-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumbs -->
        <nav class="flex items-center space-x-2 text-xs text-slate-400 mb-4">
            <a href="<?= base_url(); ?>" class="hover:text-primary transition">Beranda</a>
            <i class="fa-solid fa-chevron-right text-[9px]"></i>
            <a href="<?= base_url('artikel-blog'); ?>" class="hover:text-primary transition">Artikel & Blog</a>
            <i class="fa-solid fa-chevron-right text-[9px]"></i>
            <span class="text-slate-200 truncate max-w-xs"><?= htmlspecialchars($title); ?></span>
        </nav>

        <!-- Kategori & Judul Utama -->
        <div class="space-y-3">
            <span class="inline-block bg-primary text-white text-xs font-bold uppercase tracking-wider px-3 py-1 rounded shadow-md">
                <?= htmlspecialchars($category); ?>
            </span>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-white leading-tight uppercase tracking-tight">
                <?= htmlspecialchars($title); ?>
            </h1>
        </div>

        <!-- Meta Author & Date -->
        <div class="flex items-center gap-6 text-xs text-slate-300 mt-6 pt-6 border-t border-slate-800">
            <span class="flex items-center gap-2"><i class="fa-regular fa-calendar text-primary"></i> <?= $formatted_date; ?></span>
            <span class="flex items-center gap-2"><i class="fa-solid fa-user-pen text-primary"></i> Tim Redaksi</span>
            <span class="flex items-center gap-2"><i class="fa-regular fa-clock text-primary"></i> 3 Menit Baca</span>
        </div>
    </div>
</div>

<!-- Main Content Article Section -->
<section class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Featured Image -->
        <?php if (!empty($img_url)): ?>
            <div class="mb-10 rounded-2xl overflow-hidden shadow-xl aspect-video max-h-[480px] w-full">
                <img src="<?= $img_url; ?>" alt="<?= htmlspecialchars($title); ?>" class="w-full h-full object-cover">
            </div>
        <?php endif; ?>

        <!-- Article Body Content -->
        <!-- Menggunakan class 'prose' dari Tailwind typography untuk merapikan heading, paragraf, list, dll secara otomatis -->
        <article class="prose prose-slate prose-lg max-w-none text-slate-700 leading-relaxed space-y-6">
            <?= $content; ?>
        </article>

        <!-- Share & Back Navigation Box -->
        <div class="mt-16 pt-8 border-t border-slate-200 flex flex-col sm:flex-row items-center justify-between gap-4">
            <!-- Tombol Kembali -->
            <a href="<?= base_url('artikel-blog'); ?>" class="inline-flex items-center gap-2 text-xs font-bold text-navy uppercase tracking-wider hover:text-primary transition">
                <i class="fa-solid fa-arrow-left-long"></i> Kembali ke Daftar Artikel
            </a>

            <!-- Tombol Bagikan Sederhana -->
            <div class="flex items-center gap-3">
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Bagikan:</span>
                <a href="https://api.whatsapp.com/send?text=<?= urlencode($title . ' ' . current_url()); ?>" target="_blank" class="w-9 h-9 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center hover:bg-emerald-600 hover:text-white transition shadow-sm">
                    <i class="fa-brands fa-whatsapp"></i>
                </a>
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode(current_url()); ?>" target="_blank" class="w-9 h-9 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center hover:bg-blue-600 hover:text-white transition shadow-sm">
                    <i class="fa-brands fa-facebook-f"></i>
                </a>
            </div>
        </div>

    </div>
</section>