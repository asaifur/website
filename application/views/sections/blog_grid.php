<?php
// 1. Parsing payload JSON untuk konfigurasi section
$payload = [];
if (!empty($section->data_payload)) {
    $payload = is_array($section->data_payload) ? $section->data_payload : json_decode(html_entity_decode($section->data_payload, ENT_QUOTES, 'UTF-8'), true);
}

// Konfigurasi Domain & Request Host
$raw_host = $_SERVER['HTTP_HOST'] ?? 'localhost';
$host     = parse_url('http://' . $raw_host, PHP_URL_HOST);
$domain   = $this->Domain_model->getDomain($host);

// Konfigurasi Pagination
$limit  = isset($payload['limit']) ? (int)$payload['limit'] : 6; // Jumlah post per halaman
$page   = isset($_GET['p']) ? max(1, (int)$_GET['p']) : 1;
$offset = ($page - 1) * $limit;

$where = [
    'category'  => '2',
    'id_domain' => $domain->id
];

// Ambil total data untuk perhitungan halaman
$total_posts  = $this->Menu_model->count_data_pages('table_pages', $where);
$total_pages  = ceil($total_posts / $limit);

// Ambil data dengan limit dan offset
$blog_posts   = $this->Menu_model->fetch_data_pages_with_limit_offset('table_pages', $where, $limit, $offset, 'DESC')->result();

$dom_id       = !empty($section->span) ? $section->span : 'daftar-artikel';
$anim         = $payload['animate'] ?? 'animate__fadeInUp';
$empty_msg    = $payload['empty_message'] ?? 'Belum ada artikel yang dipublikasikan saat ini.';
?>

<section id="<?= $dom_id; ?>" class="py-16 lg:py-24 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <?php if (empty($blog_posts)): ?>
            <!-- Jika tidak ada artikel di database -->
            <div class="text-center py-20 reveal" data-animate="<?= $anim; ?>">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-slate-200 text-slate-400 mb-4">
                    <i class="fa-regular fa-folder-open text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-navy"><?= $empty_msg; ?></h3>
                <p class="text-slate-500 mt-2">Tidak Ada Data Artikel.</p>
            </div>
        <?php else: ?>
            <!-- Grid Artikel -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 reveal" data-animate="<?= $anim; ?>">

                <?php foreach ($blog_posts as $post):
                    $is_obj = is_object($post);
                    $p_cat = $this->Menu_model->fetch_data('tbl_category', ['id' => $post->category])->row();
                    $p_cat = $p_cat ? $p_cat->name : 'Berita';
                    $p_title            = $is_obj ? ($post->title ?? 'Tanpa Judul') : ($post['title'] ?? 'Tanpa Judul');
                    $p_slug             = $is_obj ? ($post->slug ?? '#') : ($post['slug'] ?? '#');
                    $p_meta_description = $is_obj ? ($post->meta_description ?? '') : ($post['meta_description'] ?? '');
                    $p_image_features   = $is_obj ? ($post->image_features ?? '') : ($post['image_features'] ?? '');
                    $p_date             = $is_obj ? ($post->created_at ?? date('Y-m-d H:i:s')) : ($post['created_at'] ?? date('Y-m-d H:i:s'));

                    // Format Tanggal
                    $formatted_date = date('d M Y', strtotime($p_date));

                    // Limit excerpt text
                    $excerpt = strip_tags($p_meta_description);
                    $excerpt = strlen($excerpt) > 120 ? substr($excerpt, 0, 120) . '...' : $excerpt;

                    // Resolve Image
                    if (empty($p_image_features)) {
                        $img_url = 'https://images.unsplash.com/photo-1556910103-1c02745aae4d?q=80&w=600&auto=format&fit=crop';
                    } else {
                        $img_url = filter_var($p_image_features, FILTER_VALIDATE_URL) ? $p_image_features : base_url('assets/uploads/img/' . $p_image_features);
                    }

                    $post_url = base_url('/' . $p_slug);
                ?>

                    <!-- Blog Card -->
                    <article class="bg-white rounded-2xl overflow-hidden shadow-sm border border-slate-100 hover:shadow-xl hover:-translate-y-2 transition-all duration-300 flex flex-col group">

                        <!-- Gambar Post -->
                        <a href="<?= $post_url; ?>" class="block relative h-56 overflow-hidden">
                            <img src="<?= $img_url; ?>" alt="<?= htmlspecialchars($p_title); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">

                            <!-- Kategori Badge -->
                            <div class="absolute top-4 left-4 bg-primary text-white text-[10px] font-bold uppercase tracking-wider px-3 py-1.5 rounded shadow-md">
                                <?= htmlspecialchars($p_cat); ?>
                            </div>
                        </a>

                        <!-- Body Post -->
                        <div class="p-6 flex flex-col flex-grow">
                            <!-- Meta Info -->
                            <div class="flex items-center gap-4 text-xs text-slate-400 mb-3">
                                <span class="flex items-center gap-1.5"><i class="fa-regular fa-calendar text-primary"></i> <?= $formatted_date; ?></span>
                                <span class="flex items-center gap-1.5"><i class="fa-solid fa-user-pen text-primary"></i> Admin</span>
                            </div>

                            <!-- Judul -->
                            <h3 class="text-lg font-bold text-navy mb-3 leading-snug group-hover:text-primary transition-colors">
                                <a href="<?= $post_url; ?>"><?= htmlspecialchars($p_title); ?></a>
                            </h3>

                            <!-- Deskripsi Singkat -->
                            <p class="text-sm text-slate-600 leading-relaxed mb-6 flex-grow">
                                <?= $excerpt; ?>
                            </p>

                            <!-- Tombol Read More -->
                            <div class="mt-auto pt-4 border-t border-slate-100">
                                <a href="<?= $post_url; ?>" class="inline-flex items-center gap-2 text-xs font-bold text-navy uppercase tracking-wider group-hover:text-primary transition-colors">
                                    Baca Selengkapnya <i class="fa-solid fa-arrow-right-long group-hover:translate-x-1 transition-transform"></i>
                                </a>
                            </div>
                        </div>
                    </article>

                <?php endforeach; ?>

            </div>

            <!-- Navigasi Pagination -->
            <?php if ($total_pages > 1): ?>
                <div class="mt-12 flex justify-center items-center gap-2">
                    <!-- Tombol Previous -->
                    <?php if ($page > 1): ?>
                        <a href="?p=<?= $page - 1; ?>" class="px-4 py-2 bg-white border border-slate-200 text-slate-700 rounded-lg text-sm font-bold hover:bg-primary hover:text-white hover:border-primary transition-colors">
                            <i class="fa-solid fa-chevron-left mr-1"></i> Prev
                        </a>
                    <?php endif; ?>

                    <!-- Nomor Halaman -->
                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <?php if ($i == $page): ?>
                            <span class="px-4 py-2 bg-primary text-white rounded-lg text-sm font-bold shadow-md shadow-primary/20">
                                <?= $i; ?>
                            </span>
                        <?php else: ?>
                            <a href="?p=<?= $i; ?>" class="px-4 py-2 bg-white border border-slate-200 text-slate-700 rounded-lg text-sm font-bold hover:bg-slate-100 transition-colors">
                                <?= $i; ?>
                            </a>
                        <?php endif; ?>
                    <?php endfor; ?>

                    <!-- Tombol Next -->
                    <?php if ($page < $total_pages): ?>
                        <a href="?p=<?= $page + 1; ?>" class="px-4 py-2 bg-white border border-slate-200 text-slate-700 rounded-lg text-sm font-bold hover:bg-primary hover:text-white hover:border-primary transition-colors">
                            Next <i class="fa-solid fa-chevron-right ml-1"></i>
                        </a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

        <?php endif; ?>

    </div>
</section>