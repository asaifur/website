<?php
// Memanggil fungsi helper get_color untuk mengambil warna dari database domain aktif
$primary_color = get_color('primary');
$navy_color    = get_color('navy');
?>

<!-- Floating Contact WhatsApp & Call (Left Floating) -->
<style>
    .floating-contact {
        position: fixed;
        left: 15px;
        bottom: 25px;
        z-index: 9999;
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .float-btn {
        display: flex;
        align-items: center;
        background: #ffffff;
        border-radius: 50px;
        padding: 5px 12px 5px 5px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        text-decoration: none;
        transition: all 0.3s ease;
        animation: floatBounce 2.5s infinite;
    }

    .float-btn img {
        width: 46px;
        height: 46px;
        object-fit: contain;
    }

    .float-btn .label {
        margin-left: 8px;
        font-size: 13px;
        font-weight: 700;
        color: #1e293b;
    }

    .float-btn:hover {
        transform: translateY(-3px) scale(1.03);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
    }

    @keyframes floatBounce {

        0%,
        20%,
        50%,
        80%,
        100% {
            transform: translateY(0);
        }

        40% {
            transform: translateY(-6px);
        }

        60% {
            transform: translateY(-3px);
        }
    }

    @media (max-width: 768px) {
        .float-btn {
            padding: 5px;
        }

        .float-btn img {
            width: 42px;
            height: 42px;
        }

        .float-btn .label {
            display: none;
        }
    }
</style>

<div class="floating-contact">
    <!-- WhatsApp Button -->
    <?php if (!empty($domain->wa_link) || !empty($this->domain->wa_link)) : ?>
        <a href="<?= !empty($domain->wa_link) ? $domain->wa_link : $this->domain->wa_link; ?>" target="_blank" class="float-btn" title="Chat WhatsApp">
            <img src="<?= base_url('assets/uploads/img/fd14d9811e056a03b44e7c3e043b2476.png'); ?>" alt="WhatsApp">
            <span class="label">Chat WhatsApp</span>
        </a>
    <?php endif; ?>

    <!-- Phone Call Button -->
    <?php if (!empty($domain->telepon) || !empty($this->domain->telepon)) : ?>
        <a href="tel:<?= !empty($domain->telepon) ? $domain->telepon : $this->domain->telepon; ?>" class="float-btn" title="Telepon Kami">
            <img src="<?= base_url('assets/uploads/img/b06f39c95463db9183a5d3fa912777ee.png'); ?>" alt="Telepon">
            <span class="label">Hubungi Kami</span>
        </a>
    <?php endif; ?>
</div>

<!-- Main Footer (Tailwind & Dynamic CodeIgniter) -->
<footer id="kontak" class="bg-navy text-gray-400 pt-16 pb-8 border-t border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 mb-12">

        <!-- Column 1: Company Profile & Social Media -->
        <div class="space-y-4">
            <div class="flex items-center space-x-3">
                <?php
                $logoImg = !empty($this->domain->image_domain) ? $this->domain->image_domain : ($domain->logo ?? 'default.png');
                ?>
                <?php if (!empty($logoImg) && $logoImg !== 'default.png') : ?>
                    <img src="<?= base_url('assets/uploads/img/') . $logoImg; ?>" alt="Logo" class="h-10 w-auto object-contain">
                <?php else : ?>
                    <div class="w-10 h-10 bg-primary flex items-center justify-center rounded text-white font-black text-xl">SDR</div>
                <?php endif; ?>
                <span class="text-lg font-bold text-white tracking-tight">
                    <?= !empty($domain->title) ? $domain->title : ($domain->meta_title ?? 'PT SOLUSI DAPUR RESTORAN'); ?>
                </span>
            </div>

            <p class="text-xs sm:text-sm text-gray-400 leading-relaxed">
                <?= !empty($this->domain->meta_description) ? $this->domain->meta_description : ($domain->meta_description ?? 'Perusahaan kontraktor spesialis kitchen equipment, fabrikasi stainless kustom, instalasi ducting exhaust, sistem fresh air, dan jaringan gas restoran profesional.'); ?>
            </p>

            <!-- Social Media Links -->
            <div class="flex items-center space-x-3 pt-2 text-slate-300">
                <?php if (!empty($this->domain->link_facebook) || !empty($domain->link_facebook)) : ?>
                    <a href="<?= $this->domain->link_facebook ?? $domain->link_facebook; ?>" target="_blank" class="w-8 h-8 rounded-full bg-slate-800 hover:bg-primary hover:text-white flex items-center justify-center transition">
                        <i class="fa-brands fa-facebook-f text-xs"></i>
                    </a>
                <?php endif; ?>
                <?php if (!empty($this->domain->link_instagram) || !empty($domain->link_instagram)) : ?>
                    <a href="<?= $this->domain->link_instagram ?? $domain->link_instagram; ?>" target="_blank" class="w-8 h-8 rounded-full bg-slate-800 hover:bg-primary hover:text-white flex items-center justify-center transition">
                        <i class="fa-brands fa-instagram text-xs"></i>
                    </a>
                <?php endif; ?>
                <?php if (!empty($this->domain->link_youtube) || !empty($domain->link_youtube)) : ?>
                    <a href="<?= $this->domain->link_youtube ?? $domain->link_youtube; ?>" target="_blank" class="w-8 h-8 rounded-full bg-slate-800 hover:bg-primary hover:text-white flex items-center justify-center transition">
                        <i class="fa-brands fa-youtube text-xs"></i>
                    </a>
                <?php endif; ?>
                <?php if (!empty($this->domain->link_twitter) || !empty($domain->link_twitter)) : ?>
                    <a href="<?= $this->domain->link_twitter ?? $domain->link_twitter; ?>" target="_blank" class="w-8 h-8 rounded-full bg-slate-800 hover:bg-primary hover:text-white flex items-center justify-center transition">
                        <i class="fa-brands fa-x-twitter text-xs"></i>
                    </a>
                <?php endif; ?>
            </div>
        </div>

        <!-- Column 2: Dynamic Articles & Blog -->
        <div>
            <h4 class="text-sm font-bold text-white uppercase tracking-wider mb-4 border-l-2 border-primary pl-2">Artikel & Berita</h4>
            <ul class="space-y-2 text-xs sm:text-sm">
                <?php
                $domain_id = isset($this->domain->id) ? $this->domain->id : ($domain->id ?? null);
                if ($domain_id && isset($this->Menu_model)) {
                    $artikel = $this->Menu_model->fetch_data_pages_by_limit_order('table_pages', ['id_domain' => $domain_id, 'category' => '2'])->result();
                } else {
                    $artikel = [];
                }
                ?>
                <?php if (!empty($artikel)) : ?>
                    <?php foreach ($artikel as $row) : ?>
                        <li>
                            <a href="<?= base_url('/') . $row->slug; ?>" class="hover:text-primary transition block line-clamp-1">
                                <?= $row->title; ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                <?php else : ?>
                    <li><a href="#jasa-gas" class="hover:text-white transition">Panduan Standar Pipa Gas Komersial</a></li>
                    <li><a href="#jasa-exhaust" class="hover:text-white transition">Perhitungan Kapasitas Blower Exhaust</a></li>
                    <li><a href="#jasa-freshair" class="hover:text-white transition">Manfaat Fresh Air pada Dapur Industri</a></li>
                    <li><a href="#jasa-custom" class="hover:text-white transition">Perawatan Kitchen Equipment SUS 304</a></li>
                <?php endif; ?>
            </ul>
        </div>

        <!-- Column 3: Dynamic Navigasi Menu -->
        <div>
            <h4 class="text-sm font-bold text-white uppercase tracking-wider mb-4 border-l-2 border-primary pl-2">Navigasi Utama</h4>
            <ul class="space-y-2 text-xs sm:text-sm">
                <?php if (!empty($menus)) : ?>
                    <?php foreach ($menus as $menu) : ?>
                        <li>
                            <a href="<?= base_url('') . (is_array($menu) ? $menu['slug'] : $menu->slug); ?>" class="hover:text-primary transition block">
                                <?= is_array($menu) ? $menu['nama_menu'] : $menu->nama_menu; ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                <?php else : ?>
                    <li><a href="#beranda" class="hover:text-white transition">Beranda</a></li>
                    <li><a href="#tentang" class="hover:text-white transition">Tentang Kami</a></li>
                    <li><a href="#layanan" class="hover:text-white transition">Layanan & Jasa</a></li>
                    <li><a href="#produk" class="hover:text-white transition">Fabrikasi Stainless</a></li>
                    <li><a href="#portofolio" class="hover:text-white transition">Portofolio</a></li>
                <?php endif; ?>
            </ul>
        </div>

        <!-- Column 4: Office Info & Hours -->
        <div class="space-y-4">
            <div>
                <h4 class="text-sm font-bold text-white uppercase tracking-wider mb-4 border-l-2 border-primary pl-2">Kontak & Workshop</h4>
                <ul class="space-y-2.5 text-xs sm:text-sm">
                    <li class="flex items-start">
                        <i class="fa-solid fa-location-dot text-primary mt-1 mr-2.5 shrink-0"></i>
                        <span><?= !empty($domain->alamat) ? $domain->alamat : 'Jl. Raya Industri Komersial No. 88, Jabodetabek, Indonesia'; ?></span>
                    </li>
                    <li class="flex items-center">
                        <i class="fa-solid fa-phone text-primary mr-2.5 shrink-0"></i>
                        <span><?= !empty($domain->telepon) ? $domain->telepon : ($this->domain->telepon ?? '+62 812-3456-7890'); ?></span>
                    </li>
                    <li class="flex items-center">
                        <i class="fa-solid fa-envelope text-primary mr-2.5 shrink-0"></i>
                        <span><?= !empty($domain->email) ? $domain->email : 'info@solusidapurrestoran.com'; ?></span>
                    </li>
                </ul>
            </div>
            <div class="pt-2">
                <span class="text-xs text-gray-300 font-semibold block">Jam Operasional:</span>
                <span class="text-xs text-gray-400 block">Senin - Sabtu: 08:00 - 17:00 WIB</span>
                <span class="text-xs text-red-400 font-semibold block mt-0.5">Emergency Service: 24 Jam</span>
            </div>
        </div>

    </div>

    <!-- Copyright Bar -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 border-t border-slate-800 text-center text-xs text-gray-500">
        <p>&copy; <?= date('Y'); ?> <?= !empty($domain->title) ? $domain->title : ($domain->meta_title ?? 'PT Solusi Dapur Restoran'); ?>. Hak Cipta Dilindungi Undang-Undang.</p>
        <p class="mt-1 text-slate-600">
            Powered by <a href="<?= base_url(); ?>" class="text-slate-500 hover:text-slate-400"><?= !empty($domain->domain_name) ? $domain->domain_name : 'solusidapurrestoran.com'; ?></a>
        </p>
    </div>
</footer>

<!-- Scripts: jQuery & Intersection Observer Animation -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    // Toggle Mobile Main Menu
    const menuBtn = document.getElementById('menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    if (menuBtn && mobileMenu) {
        menuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    }

    // Toggle Mobile Services Submenu Accordion
    const mobileServicesBtn = document.getElementById('mobile-services-btn');
    const mobileServicesMenu = document.getElementById('mobile-services-menu');
    const mobileServicesArrow = document.getElementById('mobile-services-arrow');

    if (mobileServicesBtn && mobileServicesMenu) {
        mobileServicesBtn.addEventListener('click', () => {
            mobileServicesMenu.classList.toggle('hidden');
            if (mobileServicesArrow) {
                mobileServicesArrow.classList.toggle('rotate-180');
            }
        });
    }

    // Intersection Observer untuk Animate.css saat Scroll
    const revealElements = document.querySelectorAll('.reveal');
    if (revealElements.length > 0) {
        const observer = new IntersectionObserver((entries, obs) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const el = entry.target;
                    const animClass = el.getAttribute('data-animate') || 'animate__fadeInUp';
                    el.classList.remove('reveal');
                    el.classList.add('animate__animated', animClass);
                    obs.unobserve(el);
                }
            });
        }, {
            threshold: 0.12
        });

        revealElements.forEach(el => observer.observe(el));
    }

    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    // Menerapkan warna dinamis dari database
                    primary: '<?= $primary_color; ?>',
                    navy: '<?= $navy_color; ?>',
                },
                fontFamily: {
                    sans: ['Inter', 'sans-serif'],
                }
            }
        }
    }

    // Typing Effect Support jika elemen typing-text tersedia di view
    const typingElement = document.getElementById("typing-text");
    if (typingElement) {
        const texts = [
            "Instalasi Ducting Exhaust Dapur Restoran",
            "Fabrikasi Stainless Steel Food Grade SUS 304",
            "Pemasangan Central Pipa Gas Komersial Standar SNI"
        ];

        let textIndex = 0;
        let charIndex = 0;
        let isDeleting = false;

        function typeEffect() {
            const currentText = texts[textIndex];

            if (!isDeleting) {
                typingElement.textContent = currentText.substring(0, charIndex + 1);
                charIndex++;

                if (charIndex === currentText.length) {
                    setTimeout(() => isDeleting = true, 1800);
                }
            } else {
                typingElement.textContent = currentText.substring(0, charIndex - 1);
                charIndex--;

                if (charIndex === 0) {
                    isDeleting = false;
                    textIndex = (textIndex + 1) % texts.length;
                }
            }

            setTimeout(typeEffect, isDeleting ? 35 : 75);
        }

        typeEffect();
    }
</script>
</body>

</html>