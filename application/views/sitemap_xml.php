<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    <!-- Homepage -->
    <url>
        <loc><?= base_url(); ?></loc>
        <lastmod><?= date('Y-m-d'); ?></lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>

    <!-- Pages -->
    <?php if (!empty($pages)) : ?>
        <?php foreach ($pages as $page) : ?>
            <url>
                <loc><?= base_url($page->slug); ?></loc>
                <lastmod><?= !empty($page->updated_at) ? date('Y-m-d', strtotime($page->updated_at)) : date('Y-m-d'); ?></lastmod>
                <changefreq>weekly</changefreq>
                <priority>0.8</priority>
            </url>
        <?php endforeach; ?>
    <?php endif; ?>

    <!-- Links -->
    <?php if (!empty($links)) : ?>
        <?php foreach ($links as $link) : ?>
            <url>
                <loc><?= base_url($link->slug); ?></loc>
                <lastmod><?= !empty($link->updated_at) ? date('Y-m-d', strtotime($link->updated_at)) : date('Y-m-d'); ?></lastmod>
                <changefreq>monthly</changefreq>
                <priority>0.7</priority>
            </url>
        <?php endforeach; ?>
    <?php endif; ?>

</urlset>