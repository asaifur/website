<!--begin::Brand Image-->
<div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center animate__animated animate__fadeIn">
        <div class="image">
            <img src="<?= base_url("assets/uploads/img/" . $domain['image_domain']) ?>" class="img-circle elevation-2" alt="Domain Logo" style="width: 40px; height: 40px; object-fit: cover;">
        </div>
        <div class="info">
            <a href="<?= base_url() ?>" class="d-block font-weight-bold text-truncate" style="max-width: 180px;"><?= $domain['meta_title'] ?></a>
            <span class="badge badge-success navbar-badge position-static font-weight-normal px-2 py-1" style="font-size: 10px;">Active System</span>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">

            <li class="nav-item">
                <a href="<?= base_url('') ?>" class="nav-link <?= ($this->uri->segment(2) == 'navigasi') ? 'active shadow-sm' : ''; ?>">
                    <i class="nav-icon fas fa-tachometer-alt text-info"></i>
                    <p>Dashboard</p>
                </a>
            </li>

            <?php if (!empty($menus)):
                ?>
                <?php foreach ($menus as $modul => $items): ?>
                    <li class="nav-header text-uppercase text-xs font-weight-bold text-secondary"><?= $modul; ?></li>

                    <?php foreach ($items as $m): ?>
                        <li class="nav-item">
                            <a href="<?= base_url($m->url); ?>" class="nav-link">
                                <i class="nav-icon fas fa-angle-right text-muted"></i>
                                <p><?= $m->title; ?></p>
                            </a>
                        </li>
                    <?php endforeach; ?>

                <?php endforeach; ?>
            <?php endif; ?>

            <li class="nav-header text-uppercase text-xs font-weight-bold text-secondary">Account</li>

            <li class="nav-item">
                <a href="<?= base_url('dashboard/profileuser') ?>" class="nav-link <?= ($this->uri->segment(2) == 'profileuser') ? 'active shadow-sm' : ''; ?>">
                    <i class="nav-icon fas fa-user-cog text-warning"></i>
                    <p>User Profile</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="<?= base_url('admin/logout') ?>" class="nav-link text-danger" onclick="return confirm('Apakah Anda yakin ingin keluar?')">
                    <i class="nav-icon fas fa-sign-out-alt"></i>
                    <p>Logout</p>
                </a>
            </li>

        </ul>
    </nav>
</div>

<!-- Animasi tambahan dengan Animate.css & Hover Effects -->
<style>
    .nav-sidebar .nav-link {
        transition: all 0.3s ease-in-out;
        border-radius: 6px !important;
        margin-bottom: 4px;
    }

    .nav-sidebar .nav-link:hover {
        transform: translateX(4px);
        background-color: rgba(255, 255, 255, 0.08) !important;
    }

    .nav-sidebar .nav-link.active {
        background: linear-gradient(135deg, #007bff 0%, #0056b3 100%) !important;
        color: #fff !important;
    }
</style>