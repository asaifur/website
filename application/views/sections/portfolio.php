<?php
// 1. Parsing payload JSON yang aman untuk mencegah TypeError
$items = [];

if (!empty($section->data_payload)) {
    if (is_array($section->data_payload)) {
        $payload = $section->data_payload;
    } else {
        $clean_payload = html_entity_decode($section->data_payload, ENT_QUOTES, 'UTF-8');
        $decoded = json_decode($clean_payload, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            // Coba decode ulang standar jika gagal
            $decoded = json_decode($section->data_payload, true);
        }

        $payload = is_array($decoded) ? $decoded : [];
    }

    // --- PERBAIKAN UTAMA: Mendeteksi key 'projects' sesuai struktur JSON Anda ---
    if (isset($payload['projects']) && is_array($payload['projects'])) {
        $items = $payload['projects'];
    } elseif (isset($payload['items']) && is_array($payload['items'])) {
        $items = $payload['items'];
    } elseif (is_array($payload)) {
        $items = $payload;
    }
}

// 2. Data Fallback (Jika database kosong atau gagal parse)
$dom_id   = !empty($section->span) ? $section->span : (!empty($section->section_id_dom) ? $section->section_id_dom : 'portofolio');
$tagline = !empty($section->subtitle) ? $section->subtitle : 'Portofolio Kami';
$title   = !empty($section->title) ? $section->title : 'Instalasi & Proyek Terbaru';

if (empty($items)) {
    $items = [
        [
            'category' => 'Fine Dining Restoran Jakarta',
            'title'    => 'Full Exhaust Hood & Island Cooking Setup',
            'image'    => 'https://kitchentools.id/assets/uploads/img/6d4f6b1e10648731b7e3c477bf5596b6.jpg'
        ]
    ];
}
?>

<section id="<?= $dom_id; ?>" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header Text -->
        <div class="text-center max-w-3xl mx-auto mb-16 space-y-3 reveal" data-animate="animate__fadeInDown">
            <?php if (!empty($tagline)) : ?>
                <span class="text-xs font-bold text-primary uppercase tracking-widest"><?= $tagline; ?></span>
            <?php endif; ?>

            <h2 class="text-3xl sm:text-4xl font-black text-navy uppercase"><?= $title; ?></h2>
            <div class="w-16 h-1 bg-primary mx-auto"></div>
        </div>

        <!-- Portfolio Item Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($items as $item) :
                if (!is_array($item)) continue;

                $anim = $item['animate'] ?? 'animate__fadeInUp';
                $raw_img = $item['image'] ?? '';

                // Cek apakah URL gambar sudah lengkap atau berupa nama file lokal
                $img_url = filter_var($raw_img, FILTER_VALIDATE_URL) ? $raw_img : base_url('assets/uploads/img/' . $raw_img);
                $category = $item['category'] ?? '';
                $item_title = $item['title'] ?? '';
            ?>
                <div class="group relative overflow-hidden rounded-lg shadow-md aspect-video reveal" data-animate="<?= $anim; ?>">
                    <img src="<?= $img_url; ?>" alt="<?= strip_tags($item_title); ?>" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">

                    <div class="absolute inset-0 bg-gradient-to-t from-navy via-navy/40 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300 flex flex-col justify-end p-6 text-white">
                        <span class="text-xs text-primary font-bold uppercase"><?= $category; ?></span>
                        <h4 class="font-bold text-base"><?= $item_title; ?></h4>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>