<?php
// 1. Parsing payload JSON utama
$payload = [];
if (!empty($section->data_payload)) {
    $payload = is_array($section->data_payload) ? $section->data_payload : json_decode($section->data_payload, true);
}

// 2. Targetkan key 'counters' dari dalam payload
$counters = $payload['counters'] ?? [];
$anim_section = $payload['animate_section'] ?? 'animate__fadeInUp';

// 3. Fallback jika database belum terisi atau array counters kosong
if (empty($counters)) {
    $counters = [
        ['value' => '500', 'suffix' => '+', 'label' => 'Proyek Sukses', 'icon' => 'fa-list-check'],
        ['value' => '100', 'suffix' => '%', 'label' => 'Food Grade SUS 304', 'icon' => 'fa-medal'],
        ['value' => 'SNI', 'suffix' => '', 'label' => 'Standar Safety Gas', 'icon' => 'fa-shield-halved'],
        ['value' => '24/7', 'suffix' => '', 'label' => 'Emergency Response', 'icon' => 'fa-phone']
    ];
}

$dom_id = !empty($section->span) ? $section->span : 'counters';
$total_items = count($counters);
?>

<section id="<?= $dom_id; ?>" class="bg-navy text-white py-10 border-b border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-2 md:grid-cols-4 gap-y-8 gap-x-6 text-center">
        <?php foreach ($counters as $index => $item) :
            $is_last = ($index === $total_items - 1);

            // Perbaikan Border: Menggunakan md:border-r agar di tampilan HP (2 kolom) garisnya tidak berantakan
            $border_class = $is_last ? '' : 'md:border-r border-slate-700/50';

            // Menggabungkan "value" (misal: 15) dan "suffix" (misal: +) menjadi satu kesatuan
            $display_number = ($item['value'] ?? '') . ($item['suffix'] ?? '');
            $icon = $item['icon'] ?? '';
        ?>
            <div class="<?= $border_class; ?> reveal flex flex-col items-center justify-center" data-animate="<?= $anim_section; ?>">

                <!-- Opsional: Menampilkan icon dari payload jika ada -->
                <?php if (!empty($icon)): ?>
                    <i class="fa-solid <?= $icon; ?> text-slate-500 mb-3 text-xl"></i>
                <?php endif; ?>

                <span class="block text-3xl sm:text-4xl font-extrabold text-primary mb-1">
                    <?= $display_number; ?>
                </span>
                <span class="text-xs uppercase tracking-wider text-gray-300 font-medium">
                    <?= $item['label'] ?? ''; ?>
                </span>
            </div>
        <?php endforeach; ?>
    </div>
</section>