<body class="bg-gray-50 text-slate-800 antialiased overflow-x-hidden">

    <!-- Top Info Bar -->
    <div class="bg-navy text-gray-300 text-xs py-2.5 border-b border-slate-800 animate__animated animate__fadeInDown">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row justify-between items-center gap-2">
            <div class="flex items-center space-x-6">
                <span class="flex items-center"><i class="fa-solid fa-phone text-primary mr-2"></i> <?= $domain->telepon ?></span>
                <span class="flex items-center"><i class="fa-solid fa-envelope text-primary mr-2"></i> <?= $domain->email ?></span>
                <span class="hidden md:flex items-center"><i class="fa-solid fa-clock text-primary mr-2"></i> Respon Darurat & Layanan 24/7</span>
            </div>
            <div class="flex items-center space-x-4">
                <span class="text-gray-400">Ikuti Kami:</span>
                <a href="<?= $domain->link_instagram ?>" target="_blank" class="hover:text-white transition"><i class="fa-brands fa-instagram"></i></a>
                <a href="<?= $domain->link_facebook ?>" target="_blank" class="hover:text-white transition"><i class="fa-brands fa-facebook"></i></a>
                <a href="<?= $domain->link_youtube ?>" target="_blank" class="hover:text-white transition"><i class="fa-brands fa-youtube"></i></a>
            </div>
        </div>
    </div>

    <!-- Main Navigation Bar -->
    <?php
    $current = uri_string();
    ?>

    <header class="sticky top-0 z-50 bg-white/95 backdrop-blur-md shadow-sm animate__animated animate__fadeInDown">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">

                <!-- Logo Section -->
                <div class="flex items-center space-x-3">
                    <?php if (!empty($domain->image_domain)) : ?>
                        <a href="<?= base_url(); ?>">
                            <img src="<?= base_url('assets/uploads/img/') . $domain->image_domain; ?>" alt="Logo" class="max-h-12 w-auto object-contain">
                        </a>
                    <?php else : ?>
                        <a href="<?= base_url(); ?>" class="flex items-center space-x-3 group">
                            <div class="w-12 h-12 bg-primary flex items-center justify-center rounded text-white font-black text-2xl tracking-tighter shadow-md group-hover:bg-primaryDark transition">
                                SDR
                            </div>
                            <div>
                                <span class="text-xl font-extrabold tracking-tight text-navy block leading-none">SOLUSI DAPUR</span>
                                <span class="text-xs font-semibold text-primary tracking-widest uppercase">RESTORAN INDONESIA</span>
                            </div>
                        </a>
                    <?php endif; ?>
                </div>

                <!-- Desktop Navigation Links (Dynamic from $menus) -->
                <nav class="hidden lg:flex items-center space-x-8 font-medium text-sm text-slate-700">
                    <?php if (!empty($menus)) :  ?>
                        <?php foreach ($menus as $menu) :
                            $menuSlug = is_array($menu) ? $menu['slug'] : $menu->slug;
                            $menuName = is_array($menu) ? $menu['nama_menu'] : $menu->nama_menu;
                            $children = is_array($menu) ? ($menu['children'] ?? []) : ($menu->children ?? []);

                            $isActiveParent = ($current == $menuSlug || $current == trim($menuSlug, '/'));
                            $isChildActive = false;

                            if (!empty($children)) {
                                foreach ($children as $child) {
                                    $childSlug = is_array($child) ? $child['slug'] : $child->slug;
                                    if ($current == $childSlug || $current == trim($childSlug, '/')) {
                                        $isChildActive = true;
                                        break;
                                    }
                                }
                            }
                        ?>
                            <?php if (!empty($children)) : ?>
                                <!-- Dropdown Menu Item -->
                                <div class="relative group py-4">
                                    <a href="<?= base_url($menuSlug); ?>" class="flex items-center gap-1.5 font-semibold transition focus:outline-none <?= ($isActiveParent || $isChildActive) ? 'text-primary' : 'hover:text-primary'; ?>">
                                        <span><?= ucwords(strtolower($menuName)); ?></span>
                                        <i class="fa-solid fa-chevron-down text-xs text-gray-400 group-hover:text-primary group-hover:rotate-180 transition-transform duration-200"></i>
                                    </a>

                                    <div class="absolute left-0 top-full hidden group-hover:block w-80 bg-white rounded-xl shadow-2xl border border-gray-100 p-3 animate__animated animate__fadeIn animate__faster z-50">
                                        <?php foreach ($children as $child) :
                                            $childSlug = is_array($child) ? $child['slug'] : $child->slug;
                                            $childName = is_array($child) ? $child['nama_menu'] : $child->nama_menu;
                                            $isThisChildActive = ($current == $childSlug || $current == trim($childSlug, '/'));
                                        ?>
                                            <a href="<?= base_url($childSlug); ?>" class="flex items-start gap-3 p-2.5 rounded-lg hover:bg-slate-50 transition group/item <?= $isThisChildActive ? 'bg-red-50/70 text-primary' : ''; ?>">
                                                <div class="w-8 h-8 rounded-lg <?= $isThisChildActive ? 'bg-primary text-white' : 'bg-red-50 text-primary'; ?> flex items-center justify-center shrink-0 group-hover/item:bg-primary group-hover/item:text-white transition">
                                                    <i class="fa-solid fa-angle-right text-xs"></i>
                                                </div>
                                                <div>
                                                    <div class="text-xs font-bold <?= $isThisChildActive ? 'text-primary' : 'text-navy'; ?> group-hover/item:text-primary transition">
                                                        <?= ucwords(strtolower($childName)); ?>
                                                    </div>
                                                    <div class="text-[11px] text-gray-500 line-clamp-1"><?= ucwords(strtolower($menuName)); ?></div>
                                                </div>
                                            </a>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php else : ?>
                                <!-- Single Link Item -->
                                <a href="<?= base_url($menuSlug); ?>" class="font-medium transition <?= $isActiveParent ? 'text-primary font-bold' : 'hover:text-primary'; ?>">
                                    <?= ucwords(strtolower($menuName)); ?>
                                </a>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </nav>

                <!-- CTA Button -->
                <div class="hidden lg:block">
                    <a href="<?= !empty($domain->wa_link) ? $domain->wa_link : '#konsultasi'; ?>" target="_blank" class="bg-primary hover:bg-primaryDark text-white px-5 py-2.5 rounded font-semibold text-sm shadow-md transition duration-200 flex items-center gap-2 animate__animated animate__pulse animate__infinite animate__slower">
                        <i class="fa-solid fa-calculator"></i> Konsultasi Gratis
                    </a>
                </div>

                <!-- Mobile Menu Toggle Button -->
                <div class="lg:hidden">
                    <button id="menu-btn" aria-label="Toggle Navigation" class="text-gray-700 hover:text-primary focus:outline-none text-2xl p-1">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Navigation Drawer -->
        <div id="mobile-menu" class="hidden lg:hidden bg-white border-t border-gray-200 px-4 pt-3 pb-6 space-y-2 font-medium shadow-lg max-h-[80vh] overflow-y-auto">
            <?php if (!empty($menus)) : ?>
                <?php foreach ($menus as $index => $menu) :
                    $menuSlug = is_array($menu) ? $menu['slug'] : $menu->slug;
                    $menuName = is_array($menu) ? $menu['nama_menu'] : $menu->nama_menu;
                    $children = is_array($menu) ? ($menu['children'] ?? []) : ($menu->children ?? []);
                    $isActiveParent = ($current == $menuSlug || $current == trim($menuSlug, '/'));
                ?>
                    <?php if (!empty($children)) : ?>
                        <!-- Mobile Accordion Item -->
                        <div class="border-b border-slate-100 pb-2">
                            <button type="button" class="mobile-dropdown-btn w-full flex justify-between items-center py-2 text-slate-700 hover:text-primary focus:outline-none">
                                <span class="text-sm font-semibold"><?= ucwords(strtolower($menuName)); ?></span>
                                <i class="fa-solid fa-chevron-down text-xs transition-transform duration-200 text-gray-400"></i>
                            </button>
                            <div class="mobile-dropdown-menu hidden pl-3 pr-2 py-2 space-y-2 bg-slate-50 rounded-lg mt-1 text-xs">
                                <?php foreach ($children as $child) :
                                    $childSlug = is_array($child) ? $child['slug'] : $child->slug;
                                    $childName = is_array($child) ? $child['nama_menu'] : $child->nama_menu;
                                    $isThisChildActive = ($current == $childSlug || $current == trim($childSlug, '/'));
                                ?>
                                    <a href="<?= base_url($childSlug); ?>" class="flex items-center gap-2.5 py-1.5 <?= $isThisChildActive ? 'text-primary font-bold' : 'text-slate-600 hover:text-primary'; ?>">
                                        <i class="fa-solid fa-circle-dot text-[9px] text-primary"></i>
                                        <span><?= ucwords(strtolower($childName)); ?></span>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php else : ?>
                        <!-- Single Link Mobile -->
                        <a href="<?= base_url($menuSlug); ?>" class="block py-2 text-sm <?= $isActiveParent ? 'text-primary font-bold' : 'text-slate-700 hover:text-primary'; ?> border-b border-slate-100">
                            <?= ucwords(strtolower($menuName)); ?>
                        </a>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>

            <a href="<?= !empty($domain->wa_link) ? $domain->wa_link : '#konsultasi'; ?>" target="_blank" class="block text-center bg-primary text-white py-2.5 rounded font-semibold text-sm mt-3 shadow-md">
                Konsultasi Gratis
            </a>
        </div>
    </header>

    <script>
        // Inisialisasi Mobile Dropdown Accordion dinamis
        document.querySelectorAll('.mobile-dropdown-btn').forEach(button => {
            button.addEventListener('click', () => {
                const dropdown = button.nextElementSibling;
                const icon = button.querySelector('i');
                dropdown.classList.toggle('hidden');
                icon.classList.toggle('rotate-180');
            });
        });
    </script>

    <!-- Hero Section -->
    <?php
    if (!empty($sections)) {
        foreach ($sections as $section) {
            $type = strtolower($section->section);
            $payload = !empty($section->data_payload) ? json_decode($section->data_payload, true) : [];

            $data_render = [
                'section' => $section,
                'payload' => $payload,
                'domain'  => $domain
            ];
            // Memuat view partial (misal: application/views/sections/hero.php)
            $this->load->view('sections/' . $type, $data_render);
        }
    }
    ?>