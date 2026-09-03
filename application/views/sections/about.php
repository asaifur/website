<?php
// 1. Parsing payload JSON
$payload = [];
if (!empty($section->data_payload)) {
    $payload = is_array($section->data_payload) ? $section->data_payload : json_decode($section->data_payload, true);
}

// 2. Data Utama & Fallback
$dom_id   = !empty($section->span) ? $section->span : (!empty($section->section_id_dom) ? $section->section_id_dom : 'tentang');
$tagline  = !empty($section->subtitle) ? $section->subtitle : '';
$title    = !empty($section->title) ? $section->title : 'Tentang Kami';
$content  = !empty($section->content) ? $section->content : '';

$about_img = !empty($section->image)
    ? (filter_var($section->image, FILTER_VALIDATE_URL) ? $section->image : base_url('assets/uploads/img/' . $section->image))
    : 'https://images.unsplash.com/photo-1578474846511-04ba529f0b88?q=80&w=900&auto=format&fit=crop';

// 3. Ekstrak Data Dinamis Berdasarkan Payload JSON
// Menggunakan ?? null agar tidak terjadi error undefined index jika JSON di database berbeda-beda
$badge_box  = $payload['badge_box'] ?? null;
$experience = $payload['experience'] ?? null;
$features   = $payload['features'] ?? null;
$checklists = $payload['checklists'] ?? null;
$stats      = $payload['stats'] ?? null;

// Konfigurasi Animasi dari Payload (jika ada)
$anim_img  = $payload['animate_img'] ?? 'animate__fadeInLeft';
$anim_text = $payload['animate_text'] ?? 'animate__fadeInRight';
?>

<section id="<?= $dom_id; ?>" class="py-20 bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

            <!-- Left Column: Featured Image with Dynamic Overlays -->
            <div class="relative reveal" data-animate="<?= $anim_img; ?>">
                <img src="<?= $about_img; ?>" alt="<?= strip_tags($title); ?>" class="rounded-lg shadow-xl w-full h-[420px] object-cover">

                <!-- Kondisi 1: Menampilkan Badge Box (Untuk Solusi Dapur Restoran) -->
                <?php if (!empty($badge_box['title'])) : ?>
                    <div class="absolute -bottom-6 -right-6 bg-primary text-white p-6 rounded shadow-lg hidden sm:block">
                        <span class="block text-3xl font-black"><?= $badge_box['title']; ?></span>
                        <span class="text-xs uppercase tracking-wider font-semibold"><?= $badge_box['subtitle'] ?? ''; ?></span>
                    </div>
                <?php endif; ?>

                <!-- Kondisi 2: Menampilkan Experience Box (Untuk Kitchen Tera Sentosa) -->
                <?php if (!empty($experience['years'])) : ?>
                    <div class="absolute -bottom-6 -right-6 bg-navy p-6 rounded-lg shadow-xl hidden sm:block border-l-4 border-primary">
                        <span class="block text-4xl font-black text-white"><?= $experience['years']; ?></span>
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-widest"><?= $experience['label'] ?? 'Pengalaman'; ?></span>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Right Column: Content & Dynamic Features -->
            <div class="space-y-5 reveal" data-animate="<?= $anim_text; ?>">

                <?php if (!empty($tagline)) : ?>
                    <div class="inline-block text-xs font-bold text-primary tracking-widest uppercase">
                        <?= $tagline; ?>
                    </div>
                <?php endif; ?>

                <h2 class="text-3xl sm:text-4xl font-black text-navy uppercase leading-tight">
                    <?= $title; ?>
                </h2>

                <div class="text-slate-600 text-sm sm:text-base leading-relaxed space-y-4">
                    <?= nl2br($content); ?>
                </div>

                <!-- Kondisi 3: Menampilkan Grid Features (Ikon + Judul + Deskripsi) -->
                <?php if (!empty($features) && is_array($features)) : ?>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-3">
                        <?php foreach ($features as $feature) : ?>
                            <div class="flex items-start space-x-3">
                                <i class="fa-solid <?= $feature['icon'] ?? 'fa-check'; ?> text-primary mt-1 shrink-0"></i>
                                <div>
                                    <h4 class="font-bold text-sm text-navy"><?= $feature['title']; ?></h4>
                                    <?php if (!empty($feature['desc'])): ?>
                                        <p class="text-xs text-gray-500 mt-0.5"><?= $feature['desc']; ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <!-- Kondisi 4: Menampilkan Checklists (Daftar List Vertikal) -->
                <?php if (!empty($checklists) && is_array($checklists)): ?>
                    <ul class="space-y-4 pt-4">
                        <?php foreach ($checklists as $check): ?>
                            <li class="flex items-start gap-3">
                                <i class="fa-solid fa-check text-primary mt-1 shrink-0"></i>
                                <span class="text-sm font-semibold text-slate-700"><?= $check; ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>

                <!-- Kondisi 5: Menampilkan Block Stats Internal (Jika JSON berisi "stats") -->
                <?php if (!empty($stats) && is_array($stats)): ?>
                    <div class="grid grid-cols-2 gap-4 pt-6 mt-4 border-t border-slate-100">
                        <?php foreach ($stats as $stat): ?>
                            <div>
                                <h4 class="text-2xl font-black text-navy"><?= $stat['value'] ?? ''; ?></h4>
                                <span class="text-xs font-bold text-slate-500 uppercase tracking-widest"><?= $stat['label'] ?? ''; ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

            </div>
            <!-- Kondisi Tambahan: Menampilkan Struktur Organisasi / Dewan Pengurus -->
            <?php if (!empty($payload['structure_groups']) && is_array($payload['structure_groups'])): ?>
                <div class="space-y-6 pt-4 border-t border-slate-200 mt-6">
                    <?php foreach ($payload['structure_groups'] as $group): ?>
                        <div class="bg-slate-50 p-5 rounded-xl border border-slate-100 shadow-sm">
                            <h3 class="text-base font-black text-navy uppercase tracking-wide mb-3 flex items-center gap-2">
                                <i class="fa-solid fa-users text-primary"></i> <?= $group['category']; ?>
                            </h3>

                            <?php if (!empty($group['leader'])): ?>
                                <div class="mb-3 pl-3 border-l-2 border-primary">
                                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block">Ketua</span>
                                    <span class="text-sm font-bold text-slate-800"><?= $group['leader']; ?></span>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($group['members']) && is_array($group['members'])): ?>
                                <div class="pl-3">
                                    <?php if (!empty($group['leader'])): ?>
                                        <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block mb-1.5">Anggota</span>
                                    <?php endif; ?>
                                    <ul class="space-y-2">
                                        <?php foreach ($group['members'] as $idx => $member): ?>
                                            <li class="text-xs sm:text-sm text-slate-700 flex items-start gap-2">
                                                <?php if (is_array($member)): ?>
                                                    <div>
                                                        <span class="font-bold text-slate-900"><?= $member['name']; ?></span>
                                                        <?php if (!empty($member['role'])): ?>
                                                            <span class="block text-xs text-slate-500 italic"><?= $member['role']; ?></span>
                                                        <?php endif; ?>
                                                    </div>
                                                <?php else: ?>
                                                    <span class="text-slate-400 font-medium shrink-0"><?= ($idx + 1); ?>.</span>
                                                    <span class="font-medium text-slate-800"><?= $member; ?></span>
                                                <?php endif; ?>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>