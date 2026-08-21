<?= '<?xml version="1.0" encoding="UTF-8"?>' ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 
                            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">

    <!-- Homepage -->
    <url>
        <loc><?= base_url() ?></loc>
        <lastmod><?= $last_update ?></lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>

    <!-- Static Pages -->
    <?php if (!empty($pages)): ?>
        <?php foreach ($pages as $page): ?>
            <url>
                <loc><?= base_url('page/' . $page['slug']) ?></loc>
                <lastmod><?= date('Y-m-d\TH:i:sP', strtotime($page['updated_at'])) ?></lastmod>
                <changefreq>weekly</changefreq>
                <priority>0.8</priority>
            </url>
        <?php endforeach; ?>
    <?php endif; ?>

    <!-- Dynamic Weblinks -->
    <?php if (!empty($links)): ?>
        <?php foreach ($links as $link): ?>
            <url>
                <loc><?= base_url('link/' . $link['slug']) ?></loc>
                <lastmod><?= date('Y-m-d\TH:i:sP', strtotime($link['updated_at'])) ?></lastmod>
                <changefreq>monthly</changefreq>
                <priority>0.6</priority>
            </url>
        <?php endforeach; ?>
    <?php endif; ?>

</urlset>