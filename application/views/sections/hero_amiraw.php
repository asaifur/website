<?php
// 1. Parsing payload JSON utama section hero
$payload = [];
if (!empty($section->data_payload)) {
    $payload = is_array($section->data_payload) ? $section->data_payload : json_decode(html_entity_decode($section->data_payload, ENT_QUOTES, 'UTF-8'), true);
}

// 2. Ekstrak data dari objek $section dan $payload dengan fallback otomatis
$dom_id       = !empty($section->span) ? $section->span : (!empty($section->section_id_dom) ? $section->section_id_dom : 'beranda');
$tagline      = !empty($section->subtitle) ? $section->subtitle : 'Kopi Gula Aren & Kayu Manis Pilihan';
$title        = !empty($section->title) ? $section->title : 'Kesegaran Alami Amiraw Kopi';
$content      = !empty($section->content) ? $section->content : 'Perpaduan sempurna biji kopi pilihan nusantara dengan manisnya gula aren murni dan kehangatan aroma kayu manis.';
$btn_text     = !empty($section->btn_text) ? $section->btn_text : 'Pesan Sekarang';
$btn_url      = !empty($section->btn_url) ? $section->btn_url : 'https://wa.me/6281345578282?text=Halo%20Amiraw%20Kopi,%20saya%20ingin%20pesan.';

// Data tambahan dari payload JSON
$badges       = $payload['badges'] ?? [
    ['text' => '100% Gula Aren Asli', 'color' => 'amber'],
    ['text' => 'Halal Resmi', 'color' => 'emerald'],
    ['text' => 'Fresh Disajikan Dingin', 'color' => 'amber']
];
$secondary_btn = $payload['secondary_btn'] ?? ['text' => 'Lihat Varian Rasa', 'url' => '#menu'];

// Resolve Image URL untuk Botol Produk
$has_image    = !empty($section->image);
if ($has_image) {
    $img_url  = filter_var($section->image, FILTER_VALIDATE_URL) ? $section->image : base_url('assets/uploads/img/' . $section->image);
} else {
    $img_url  = base_url('assets/uploads/img/default-product.png');
}

$domain_name  = is_object($domain) ? ($domain->domain_name ?? 'Amiraw Kopi') : ($domain['domain_name'] ?? 'Amiraw Kopi');
?>

<!-- Hero Section Amiraw Kopi dengan Efek Splash Parallax (Dynamic View) -->
<section id="<?= htmlspecialchars($dom_id); ?>" class="relative min-h-screen flex items-center justify-center overflow-hidden bg-stone-950 text-white pt-24 lg:pt-0">

    <!-- Background Parallax Layer (Splash & Wood Texture) -->
    <div id="parallax-bg" class="absolute inset-0 z-0 scale-105 transition-transform duration-100 ease-out">
        <div class="absolute inset-0 bg-gradient-to-r from-stone-950/90 via-stone-950/70 to-stone-950/80 z-10"></div>
        <img src="https://images.unsplash.com/photo-1514432324607-a09d9b4aefdd?q=80&w=1920&auto=format&fit=crop" alt="<?= htmlspecialchars($domain_name); ?> Background" class="w-full h-full object-cover opacity-40">
    </div>

    <!-- Floating Water Droplets Effect / Ornamen Cahaya -->
    <div class="absolute inset-0 z-10 pointer-events-none overflow-hidden">
        <div class="absolute top-1/4 left-10 w-72 h-72 bg-amber-600/10 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-10 right-10 w-96 h-96 bg-emerald-600/10 rounded-full blur-3xl animate-pulse"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-20 w-full py-12">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">

            <!-- Kolom Teks / Informasi Produk -->
            <div class="lg:col-span-7 space-y-6 text-center lg:text-left">

                <!-- Badge Tagline -->
                <?php if (!empty($tagline)) : ?>
                    <div class="inline-flex items-center gap-2 bg-emerald-900/40 border border-emerald-500/30 text-emerald-400 text-xs font-bold uppercase tracking-widest px-4 py-2 rounded-full backdrop-blur-md">
                        <i class="fa-solid fa-mug-hot"></i> <?= htmlspecialchars($tagline); ?>
                    </div>
                <?php endif; ?>

                <!-- Judul Utama -->
                <h1 class="text-4xl sm:text-6xl font-black tracking-tight uppercase leading-none">
                    <?= htmlspecialchars($title); ?> <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-400 via-amber-500 to-emerald-400">
                        <?= htmlspecialchars($domain_name); ?>
                    </span>
                </h1>

                <!-- Deskripsi -->
                <?php if (!empty($content)) : ?>
                    <p class="text-stone-300 text-base sm:text-lg max-w-xl mx-auto lg:mx-0 leading-relaxed font-light">
                        <?= nl2br(htmlspecialchars($content)); ?>
                    </p>
                <?php endif; ?>

                <!-- Tombol Aksi (CTA) -->
                <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-4">
                    <a href="<?= htmlspecialchars($btn_url); ?>" target="_blank" class="w-full sm:w-auto bg-amber-600 hover:bg-amber-500 text-stone-950 font-black uppercase text-xs tracking-wider px-8 py-4 rounded-xl transition-all shadow-xl shadow-amber-600/20 text-center flex items-center justify-center gap-2">
                        <i class="fa-brands fa-whatsapp text-lg"></i> <?= htmlspecialchars($btn_text); ?>
                    </a>
                    <?php if (!empty($secondary_btn['text'])) : ?>
                        <a href="<?= htmlspecialchars($secondary_btn['url'] ?? '#menu'); ?>" class="w-full sm:w-auto bg-stone-900/80 hover:bg-stone-800 text-stone-200 font-bold uppercase text-xs tracking-wider px-8 py-4 rounded-xl transition-all border border-stone-700 text-center backdrop-blur-md">
                            <?= htmlspecialchars($secondary_btn['text']); ?>
                        </a>
                    <?php endif; ?>
                </div>

                <!-- Keunggulan Singkat (Dari Payload JSON) -->
                <?php if (!empty($badges) && is_array($badges)) : ?>
                    <div class="grid grid-cols-3 gap-4 pt-8 border-t border-stone-800/80 max-w-lg mx-auto lg:mx-0">
                        <?php foreach ($badges as $badge) :
                            $color_class = ($badge['color'] ?? 'amber') === 'emerald' ? 'text-emerald-400' : 'text-amber-400';
                        ?>
                            <div>
                                <h4 class="font-black <?= $color_class; ?> text-lg"><?= htmlspecialchars($badge['text'] ?? ''); ?></h4>
                                <p class="text-[11px] text-stone-400 uppercase tracking-wider mt-0.5">Kualitas Premium</p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Kolom Visual Produk dengan Efek Parallax & Splash -->
            <div class="lg:col-span-5 flex justify-center">
                <div class="relative w-full max-w-sm">
                    <!-- Lingkaran Cahaya Belakang Botol -->
                    <div class="absolute inset-0 bg-gradient-to-tr from-amber-600/30 to-emerald-600/30 rounded-full blur-2xl transform -rotate-6 scale-95"></div>

                    <!-- Container Gambar Botol dengan Efek Floating & Parallax Mouse -->
                    <div id="product-card" class="relative z-10 transition-transform duration-200 ease-out hover:scale-105">
                        <div class="relative rounded-3xl overflow-hidden shadow-2xl border border-stone-700/50 bg-stone-900/40 backdrop-blur-sm p-4 text-center">

                            <!-- Gambar Botol Produk -->
                            <img src="<?= htmlspecialchars($img_url); ?>" alt="<?= htmlspecialchars($title); ?>" class="w-full h-[450px] object-cover rounded-2xl shadow-lg transform hover:-translate-y-2 transition-transform duration-500">

                            <!-- Badge Label Mengambang -->
                            <div class="absolute bottom-8 left-8 right-8 bg-stone-950/80 backdrop-blur-md border border-stone-700/60 p-3 rounded-xl text-left flex items-center justify-between">
                                <div>
                                    <span class="text-[10px] uppercase font-bold tracking-widest text-emerald-400">Signature Blend</span>
                                    <h5 class="text-sm font-bold text-white"><?= htmlspecialchars($tagline); ?></h5>
                                </div>
                                <span class="bg-amber-600 text-stone-950 text-xs font-black px-2.5 py-1 rounded-lg">Ready</span>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

<!-- Script JavaScript untuk Efek Parallax Interaktif pada Mouse Move -->
<script>
    document.addEventListener('mousemove', (e) => {
        const x = (window.innerWidth / 2 - e.pageX) / 40;
        const y = (window.innerHeight / 2 - e.pageY) / 40;

        const bg = document.getElementById('parallax-bg');
        const card = document.getElementById('product-card');

        if (bg && card) {
            bg.style.transform = `scale(1.05) translate(${x}px, ${y}px)`;
            card.style.transform = `translate(${-x}px, ${-y}px)`;
        }
    });
</script>