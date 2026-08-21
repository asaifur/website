<?php $this->load->view('template/header'); ?>
<style>
    /* Sidebar background */
    .main-sidebar {
        background-color: #6367FF !important;
    }

    /* Brand logo */
    .main-sidebar .brand-link {
        background-color: #6367FF !important;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    /* Menu text */
    .nav-sidebar .nav-link {
        color: #ffffff !important;
    }

    /* Menu hover */
    .nav-sidebar .nav-link:hover {
        background-color: rgba(255, 255, 255, 0.15) !important;
        color: #fff !important;
    }

    /* Active menu */
    .nav-sidebar .nav-link.active {
        background-color: rgba(0, 0, 0, 0.2) !important;
        color: #fff !important;
    }
</style>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!--begin::Header-->

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>

            </ul>

            <!--begin::End Navbar Links-->
            <ul class="navbar-nav ml-auto">
                <!--begin::Navbar Search-->
                <li class="nav-item">
                    <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                        <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                        <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
                    </a>
                </li>
                <!--end::Fullscreen Toggle-->

                <!--begin::User Menu Dropdown-->
                <li class="nav-item dropdown user-menu">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                        <span class="d-none d-md-inline"><?= $_SESSION['username'] ?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                        <!--begin::User Image-->
                        <li class="user-header text-bg-primary">
                            <p>
                                <?= $_SESSION['username'] ?>
                            </p>
                        </li>
                        <li class="user-body">
                        </li>
                        <!--end::Menu Body-->
                        <!--begin::Menu Footer-->
                        <li class="user-footer">
                            <a href="<?= base_url('auth/logout/') ?>" class="btn btn-outline-danger float-end">Sign out</a>
                        </li>
                        <!--end::Menu Footer-->
                    </ul>
                </li>
                <!--end::User Menu Dropdown-->
            </ul>
            <!--end::End Navbar Links-->
    </div>
    <!--end::Container-->
    </nav>
    <aside class="main-sidebar sidebar-custom elevation-4">
        <!--begin::Sidebar Brand-->

        <?php $this->load->view('template/navbar'); ?>
    </aside>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Menu Meta</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Menu Meta Data</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <section class="content">
            <!--begin::Container-->
            <div class="container-fluid">
                <?= $contents; ?>
            </div>
            <!--end::Row-->
        </section>
        <!--end::Container-->
    </div>
    <!--end::App Content-->
    <footer class="main-footer">
        <strong>
            Copyright &copy; <?= date('Y') ?>&nbsp;
            <a href="https://wa.link/38cm8i" class="text-decoration-none">HTP Sinergi</a>.
        </strong>
        All rights reserved.
        <!--end::Copyright-->
    </footer>
    <!--end::Footer-->
    </div>
    <!--end::App Wrapper-->
    <!--begin::Script-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->


</body>
<!--end::Body-->

</html>