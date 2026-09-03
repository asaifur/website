<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!-- Section View: Jurnal Mitra Bestari with Domain-Filtered Live Search & Pagination (Tailwind CSS) -->
<section class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header & Live Search Bar -->
        <div class="mb-10 text-center">
            <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight sm:text-4xl"><?= isset($title) ? $title : 'Jurnal Mitra Bestari'; ?></h1>
            <p class="mt-3 max-w-2xl mx-auto text-lg text-gray-500">Temukan artikel ilmiah, jurnal mitra bestari, dan publikasi akademik terverifikasi.</p>

            <div class="mt-6 max-w-xl mx-auto">
                <div class="relative flex items-center">
                    <input type="text" id="liveSearchInput" class="w-full pl-4 pr-12 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm" placeholder="Cari judul artikel, penulis, ISSN, atau subjek...">
                    <div class="absolute right-3 text-gray-400">
                        <i class="fas fa-search"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Blog Grid Container -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="journalGridContainer">
            <?php
            // Konsisten menerapkan filter multi-domain (id_domain) sesuai active context sistem


            $journals = $this->Menu_model->fetch_data('table_jurnal', ['id_domain' => $domain->id])->result();
            if (!empty($journals)): ?>
                <?php foreach ($journals as $j): ?>
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col justify-between transition duration-300 hover:shadow-md journal-card-item" data-search="<?= strtolower($j->title . ' ' . $j->authors . ' ' . $j->subject . ' ' . $j->issn); ?>">
                        <div>
                            <div class="relative h-48 bg-gray-200 overflow-hidden">
                                <img src="<?= !empty($j->file_pdf) ? base_url('assets/uploads/img/default_journal.jpg') : 'https://images.unsplash.com/photo-1457369804613-52c61a468e7d?q=80&w=600&auto=format&fit=crop'; ?>" alt="Journal Cover" class="w-full h-full object-cover">
                                <span class="absolute top-3 right-3 bg-indigo-600 text-white text-xs font-semibold px-2.5 py-1 rounded-full shadow"><?= $j->subject; ?></span>
                            </div>
                            <div class="p-6">
                                <div class="flex items-center text-xs text-gray-500 mb-2 space-x-2">
                                    <span><i class="far fa-calendar-alt mr-1"></i> <?= date('d M Y', strtotime($j->publication_date)); ?></span>
                                    <span>&bull;</span>
                                    <span><strong>ISSN:</strong> <?= $j->issn; ?></span>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900 mb-2 leading-snug line-clamp-2"><?= $j->title; ?></h3>
                                <p class="text-xs font-medium text-indigo-600 mb-3">Oleh: <?= $j->authors; ?></p>
                                <p class="text-sm text-gray-600 line-clamp-3 mb-4"><?= $j->abstract; ?></p>
                            </div>
                        </div>
                        <div class="px-6 pb-6 pt-0 flex items-center justify-between border-t border-gray-100 mt-auto pt-4">
                            <span class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded border border-gray-200">DOI: <?= $j->doi; ?></span>
                            <a href="<?= $j->url_article; ?>" target="_blank" class="inline-flex items-center text-sm font-semibold text-indigo-600 hover:text-indigo-800">
                                Detail Artikel <i class="fas fa-arrow-right ml-1 text-xs"></i>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-full">
                    <div class="text-center py-12 bg-white rounded-xl shadow-sm border border-gray-100">
                        <i class="fas fa-exclamation-triangle text-4xl text-gray-400 mb-3"></i>
                        <p class="text-gray-600 font-medium">Belum ada data jurnal mitra bestari yang tersedia untuk domain ini.</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Empty State for Live Search -->
        <div id="noResults" class="hidden text-center py-16 bg-white rounded-xl shadow-sm border border-gray-100 mt-6">
            <i class="fas fa-search text-4xl text-gray-400 mb-3"></i>
            <h4 class="text-lg font-bold text-gray-800">Artikel Jurnal Tidak Ditemukan</h4>
            <p class="text-sm text-gray-500 mt-1">Coba gunakan kata kunci pencarian yang lain.</p>
        </div>

        <!-- Pagination Links Container -->
        <?php if (isset($pagination)): ?>
            <div class="mt-10 flex justify-center">
                <nav class="pagination-container">
                    <?= $pagination; ?>
                </nav>
            </div>
        <?php endif; ?>

    </div>
</section>

<!-- Live Search Script with Dynamic Pagination Awareness -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#liveSearchInput').on('keyup', function() {
            let keyword = $(this).val().toLowerCase().trim();
            let visibleCount = 0;

            $('.journal-card-item').each(function() {
                let searchData = $(this).data('search');
                if (searchData.indexOf(keyword) > -1) {
                    $(this).show();
                    visibleCount++;
                } else {
                    $(this).hide();
                }
            });

            if (visibleCount === 0) {
                $('#noResults').removeClass('hidden');
            } else {
                $('#noResults').addClass('hidden');
            }

            // Sembunyikan pagination saat live search aktif untuk menghindari ketidaksesuaian indeks halaman
            if (keyword.length > 0) {
                $('.pagination-container').hide();
            } else {
                $('.pagination-container').show();
            }
        });
    });
</script>