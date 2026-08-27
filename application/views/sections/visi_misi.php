<?php
$payload = !empty($section->data_payload) ? json_decode($section->data_payload, true) : [];

$dom_id   = !empty($section->span) ? $section->span : 'visi-misi';
$tagline  = !empty($section->subtitle) ? $section->subtitle : 'Visi & Misi';
$title    = !empty($section->title) ? $section->title : 'Tujuan Besar Kami';

$visi = $payload['visi'] ?? [];
$misi = $payload['misi'] ?? [];
$anim = $payload['animate'] ?? 'animate__fadeInUp';
?>


<section id="<?= $dom_id; ?>" class="py-20 bg-slate-50 border-t border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 reveal" data-animate="<?= $anim; ?>">

        <!-- Header -->
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-xs font-bold text-primary uppercase tracking-widest"><?= $tagline; ?></span>
            <h2 class="text-3xl font-black text-navy uppercase mt-2"><?= $title; ?></h2>
            <div class="w-16 h-1 bg-primary mx-auto mt-4"></div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12">

            <!-- Visi Area -->
            <div class="lg:col-span-5 flex">
                <div class="bg-navy rounded-2xl p-10 text-white w-full shadow-xl relative overflow-hidden flex flex-col justify-center">
                    <div class="absolute -right-10 -top-10 opacity-10 text-9xl">
                        <i class="fa-solid <?= $visi['icon'] ?? 'fa-eye'; ?>"></i>
                    </div>
                    <div class="relative z-10">
                        <div class="w-12 h-12 bg-primary rounded-lg flex items-center justify-center text-2xl mb-6">
                            <i class="fa-solid <?= $visi['icon'] ?? 'fa-eye'; ?>"></i>
                        </div>
                        <h3 class="text-2xl font-black uppercase mb-4 tracking-wider">Visi</h3>
                        <p class="text-slate-300 text-lg leading-relaxed font-medium">
                            <?= $visi['text'] ?? ''; ?>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Misi Area -->
            <div class="lg:col-span-7 flex flex-col justify-center">
                <h3 class="text-2xl font-black text-navy uppercase mb-6 tracking-wider">Misi Perusahaan</h3>

                <?php if (!empty($misi) && is_array($misi)): ?>
                    <ul class="space-y-4">
                        <?php foreach ($misi as $idx => $m): ?>
                            <li class="flex items-start bg-white p-4 rounded-xl border border-slate-100 shadow-sm hover:border-primary/30 transition-colors">
                                <div class="shrink-0 w-10 h-10 bg-red-50 text-primary rounded-full flex items-center justify-center font-bold text-lg mr-4 border border-red-100">
                                    <?= $idx + 1; ?>
                                </div>
                                <p class="text-slate-600 text-sm md:text-base pt-2 leading-relaxed">
                                    <?= $m; ?>
                                </p>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>

        </div>
    </div>
</section>