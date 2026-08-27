<?php
// Ambil URI saat ini untuk pengecekan status menu aktif
$current_uri = uri_string();
if (empty($current_uri)) {
    $current_uri = 'home'; // Fallback root URL ke slug 'home'
}
?>

<!-- Spinner Start -->
<div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
    <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;"></div>
</div>
<!-- Spinner End -->

<!-- Topbar Start -->
<div class="container-fluid bg-primary text-white d-none d-lg-flex wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-3">
        <div class="d-flex align-items-center">
            <!-- Brand Logo Text (Dari $domain) -->
            <a href="<?= base_url(); ?>">
                <?php if (!empty($domain->image_domain)) : ?>
                    <!-- Menampilkan Logo Image -->
                    <img src="<?= base_url('assets/uploads/img/' . $domain->image_domain); ?>"
                        alt="<?= $domain->domain_name ?? 'Logo'; ?>"
                        style="max-height: 45px; width: auto; object-fit: contain;">
                <?php else : ?>
                    <!-- Fallback Text jika Logo kosong -->
                    <h2 class="text-white fw-bold m-0"><?= strtoupper($domain->domain_name ?? 'WELDORK'); ?></h2>
                <?php endif; ?>
            </a>

            <div class="ms-auto d-flex align-items-center">
                <!-- Data Kontak Dinamis (Dari array $contact) -->
                <?php if (!empty($contact['address'])) : ?>
                    <small class="ms-4"><i class="fa fa-map-marker-alt me-3"></i><?= $contact['address']; ?></small>
                <?php endif; ?>

                <?php if (!empty($contact['email'])) : ?>
                    <small class="ms-4"><i class="fa fa-envelope me-3"></i><?= $contact['email']; ?></small>
                <?php endif; ?>

                <?php if (!empty($contact['phone'])) : ?>
                    <small class="ms-4"><i class="fa fa-phone-alt me-3"></i><?= $contact['phone']; ?></small>
                <?php endif; ?>

                <!-- Media Sosial Dinamis (Dari array $socials) -->
                <div class="ms-3 d-flex">
                    <?php if (!empty($socials['fb'])) : ?>
                        <a class="btn btn-sm-square btn-light text-primary ms-2" href="<?= $socials['fb']; ?>" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    <?php endif; ?>

                    <?php if (!empty($socials['tw'])) : ?>
                        <a class="btn btn-sm-square btn-light text-primary ms-2" href="<?= $socials['tw']; ?>" target="_blank"><i class="fab fa-twitter"></i></a>
                    <?php endif; ?>

                    <?php if (!empty($socials['ig'])) : ?>
                        <a class="btn btn-sm-square btn-light text-primary ms-2" href="<?= $socials['ig']; ?>" target="_blank"><i class="fab fa-instagram"></i></a>
                    <?php endif; ?>

                    <?php if (!empty($socials['yt'])) : ?>
                        <a class="btn btn-sm-square btn-light text-primary ms-2" href="<?= $socials['yt']; ?>" target="_blank"><i class="fab fa-youtube"></i></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Topbar End -->

<!-- Navbar Start -->
<div class="container-fluid bg-white sticky-top wow fadeIn" data-wow-delay="0.1s">
    <div class="container">
        <nav class="navbar navbar-expand-lg bg-white navbar-light p-lg-0">
            <!-- Mobile Brand Logo -->
            <a href="<?= base_url(); ?>" class="navbar-brand d-lg-none flex items-center">
                <?php if (!empty($domain->image_domain)) : ?>
                    <!-- Menampilkan Logo Image -->
                    <img src="<?= base_url('assets/uploads/img/' . $domain->image_domain); ?>"
                        alt="<?= $domain->domain_name ?? 'Logo'; ?>"
                        style="max-height: 45px; width: auto; object-fit: contain;">
                <?php else : ?>
                    <!-- Fallback Text jika Logo kosong -->
                    <h1 class="fw-bold m-0 text-primary"><?= strtoupper($domain->domain_name ?? 'WELDORK'); ?></h1>
                <?php endif; ?>
            </a>

            <!-- Mobile Toggler -->
            <button type="button" class="navbar-toggler me-0" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav">
                    <!-- Iterasi Dinamis dari $menus -->
                    <?php if (!empty($menus)) : ?>
                        <?php foreach ($menus as $menu) :
                            $slug = is_array($menu) ? $menu['slug'] : $menu->slug;
                            $name = is_array($menu) ? $menu['nama_menu'] : $menu->nama_menu;
                            $children = is_array($menu) ? ($menu['children'] ?? []) : ($menu->children ?? []);

                            // Cek active parent
                            $isActiveParent = ($current_uri === $slug || $current_uri === trim($slug, '/'));
                            $isChildActive = false;

                            // Cek apakah ada child yang aktif
                            if (!empty($children)) {
                                foreach ($children as $child) {
                                    $cSlug = is_array($child) ? $child['slug'] : $child->slug;
                                    if ($current_uri === $cSlug || $current_uri === trim($cSlug, '/')) {
                                        $isChildActive = true;
                                        break;
                                    }
                                }
                            }
                        ?>
                            <?php if (!empty($children)) : ?>
                                <!-- Dropdown Menu -->
                                <div class="nav-item dropdown">
                                    <a href="<?= (strpos($slug, 'http') === 0 || strpos($slug, '#') === 0) ? $slug : base_url($slug); ?>"
                                        class="nav-link dropdown-toggle <?= ($isActiveParent || $isChildActive) ? 'active' : ''; ?>"
                                        data-bs-toggle="dropdown">
                                        <?= ucwords(strtolower($name)); ?>
                                    </a>

                                    <div class="dropdown-menu bg-light rounded-0 rounded-bottom m-0">
                                        <?php foreach ($children as $child) :
                                            $cSlug = is_array($child) ? $child['slug'] : $child->slug;
                                            $cName = is_array($child) ? $child['nama_menu'] : $child->nama_menu;
                                            $cActive = ($current_uri === $cSlug || $current_uri === trim($cSlug, '/')) ? 'active' : '';
                                        ?>
                                            <a href="<?= (strpos($cSlug, 'http') === 0 || strpos($cSlug, '#') === 0) ? $cSlug : base_url($cSlug); ?>"
                                                class="dropdown-item <?= $cActive; ?>">
                                                <?= ucwords(strtolower($cName)); ?>
                                            </a>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php else : ?>
                                <!-- Single Menu -->
                                <a href="<?= (strpos($slug, 'http') === 0 || strpos($slug, '#') === 0) ? $slug : base_url($slug); ?>"
                                    class="nav-item nav-link <?= $isActiveParent ? 'active' : ''; ?>">
                                    <?= ucwords(strtolower($name)); ?>
                                </a>
                            <?php endif; ?>

                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <!-- CTA Button -->
                <div class="ms-auto d-none d-lg-block">
                    <a href="<?= !empty($contact['wa']) ? $contact['wa'] : '#'; ?>" target="_blank" class="btn btn-primary py-2 px-3">
                        <i class="fab fa-whatsapp me-2"></i>Konsultasi Gratis
                    </a>
                </div>
            </div>
        </nav>
    </div>
</div>
<!-- Navbar End -->
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
        $this->load->view('weldork/' . $type, $data_render);
    }
}
?>