<main>
    <?php
    if (!empty($sections)) {
        foreach ($sections as $section) {
            $type = strtolower($section->section);
            $payload = !empty($section->data_payload) ? json_decode($section->data_payload, true) : [];

            $data_render = [
                'section' => $section,
                'payload' => $payload,
                'domain'  => $domain ?? null
            ];

            // Memuat file view partial dari folder views/sections/
            $view_path = 'news/' . $type;
            if ($this->load->is_loaded($view_path) || file_exists(APPPATH . 'views/' . $view_path . '.php')) {
                $this->load->view($view_path, $data_render);
            } else {
                // Fallback jika file view section belum tersedia
                echo '<!-- Section view "news/' . $type . '" not found -->';
            }
        }
    } else {
    ?>
        <!-- Fallback Default Content jika Sections Kosong -->
        <section class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h1 class="text-3xl font-black text-navy uppercase tracking-tight mb-4">
                    <?= !empty($page->title) ? $page->title : 'Halaman Utama'; ?>
                </h1>
                <p class="text-slate-600 max-w-2xl mx-auto text-base leading-relaxed">
                    <?= !empty($page->content) ? $page->content : 'Konten halaman ini sedang dalam tahap pembaruan sistem.'; ?>
                </p>
            </div>
        </section>
    <?php
    }
    ?>
</main>