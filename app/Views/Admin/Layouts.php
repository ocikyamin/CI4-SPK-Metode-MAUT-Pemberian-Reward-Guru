<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->

<head>
    <meta charset="utf-8" />
    <title>Admin | <?= $title ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Sistem Penilian Kinerja Guru Pondok Pesantren Madrasah Tarbiyah Islamiyah Canduang"
        name="description" />
    <meta content="Abdul Yamin" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?= base_url() ?>/public/PKG.png">

    <!-- third party css -->
    <link href="<?= base_url() ?>/public/css/vendor/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <!-- third party css end -->

    <!-- App css -->
    <link href="<?= base_url() ?>/public/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>/public/css/app-creative.min.css" rel="stylesheet" type="text/css" id="light-style" />
    <link href="<?= base_url() ?>/public/css/app-creative-dark.min.css" rel="stylesheet" type="text/css"
        id="dark-style" />
    <style>
    .button-menu-mobile span {
        background: black;
    }

    .mybg {
        background: rgb(248, 248, 248);
        background: linear-gradient(90deg, rgba(248, 248, 248, 0.9725140056022409) 12%, rgba(255, 255, 255, 0.9024859943977591) 55%, rgba(255, 255, 255, 1) 100%);
    }

    .topnav-navbar-dark {
        background: rgb(15, 128, 87);
        background: linear-gradient(90deg, rgba(15, 128, 87, 1) 0%, rgba(10, 223, 144, 1) 42%, rgba(0, 255, 160, 1) 100%);
    }

    .topnav-navbar-dark .nav-user {
        background: none;
        border: none;
    }

    .button-menu-mobile {
        color: white;
    }

    .button-menu-mobile span {
        background: white;
    }



    @media (max-width: 767.98px) {
        body[data-layout=detached] .leftbar-user {
            margin-top: 70px;
        }
    }
    </style>
    <script src="<?= base_url() ?>/public/js/sweetalert2.min.js"></script>
    <link href="<?= base_url() ?>/public/css/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <script src="<?= base_url() ?>/public/js/vendor.min.js"></script>

</head>

<body class="loading mybg" data-layout="detached"
    data-layout-config='{"layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>

    <!-- Topbar Start -->
    <!-- <a class="button-menu-mobile disable-btn bg-dark">
        <div class="lines">
        <span></span>
        <span></span>
        <span></span>
        </div>
        </a> -->

    <div class="navbar-custom topnav-navbar topnav-navbar-dark">
        <div class="container">

            <!-- LOGO -->
            <a href="<?= base_url('admin') ?>" class="topnav-logo">
                <span class="topnav-logo-lg">
                    <img src="<?= base_url() ?>/public/logo_white.png" alt="" height="60">
                </span>
                <span class="topnav-logo-sm">
                    <img src="<?= base_url() ?>/public/logo_white.png" alt="" height="60">
                </span>
            </a>

            <ul class="list-unstyled topbar-menu float-end mb-0">


                <li class="dropdown notification-list">
                    <a class="nav-link dropdown-toggle nav-user arrow-none me-0" data-bs-toggle="dropdown"
                        id="topbar-userdrop" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        <span class="account-user-avatar">
                            <img src="<?= base_url() ?>/public/images/users/avatar.jpg" alt="user-image"
                                class="rounded-circle">
                        </span>
                        <span>
                            <span class="account-user-name"><?= UserLogin()->full_name ?></span>
                            <span class="account-position">Administraor</span>
                        </span>
                    </a>
                </li>

            </ul>
            <!-- <a class="button-menu-mobile disable-btn">
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </a> -->
            <a class="button-menu-mobile disable-btn">
                <div class="lines">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </a>

        </div>
    </div>




    <!-- end Topbar -->

    <!-- Start Content-->
    <div class="container-fluid">

        <!-- Begin page -->
        <div class="wrapper">

            <!-- ========== Left Sidebar Start ========== -->
            <div class="leftside-menu leftside-menu-detached">

                <div class="leftbar-user">
                    <a href="javascript: void(0);">
                        <img src="<?= base_url() ?>/public/images/users/avatar.jpg" alt="user-image" height="42"
                            class="rounded-circle shadow-sm">
                        <span class="leftbar-user-name">
                            <?= UserLogin()->full_name ?></span>
                    </a>
                    <span>Administraor</span>
                </div>

                <!--- Sidemenu -->
                <ul class="side-nav">

                    <!-- <li class="side-nav-title side-nav-item text-center">TP. 2023/2024</li> -->

                    <li class="side-nav-title side-nav-item">Menu Utama</li>
                    <li class="side-nav-item active">
                        <a href="<?= base_url('admin') ?>" class="side-nav-link ">
                            <i class="mdi mdi-view-dashboard-outline"></i>
                            <span> Dashboard </span>
                        </a>

                    </li>


                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#sidebarEcommerce" aria-expanded="false"
                            aria-controls="sidebarEcommerce" class="side-nav-link">
                            <i class="uil-cog"></i>
                            <span> Settings </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebarEcommerce">
                            <ul class="side-nav-second-level">
                                <li>
                                    <a href="<?= base_url('admin/sekolah') ?>"> Sekolah</a>
                                </li>
                                <li>
                                    <a href="<?= base_url('admin/periode') ?>"> Periode</a>
                                </li>
                                <li>
                                    <a href="<?= base_url('admin/mapel') ?>"> Mapel</a>
                                </li>
                                <li>
                                    <a href="<?= base_url('admin/kelas') ?>"> Kelas</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="side-nav-item">
                        <a href="<?= base_url('admin/kriteria') ?>" class="side-nav-link">
                            <i class="uil-file-copy-alt"></i>
                            <span> Kriteria </span>
                        </a>
                    </li>

                    <li class="side-nav-item">
                        <a href="<?= base_url('admin/guru') ?>" class="side-nav-link">
                            <i class="uil-users-alt"></i>
                            <span> Guru </span>
                        </a>
                    </li>
                    <li class="side-nav-item">
                        <a href="<?= base_url('admin/skors') ?>" class="side-nav-link">
                            <i class="mdi mdi-star"></i>
                            <span> Skors </span>
                        </a>
                    </li>

                    <li class="side-nav-title side-nav-item mt-1">Lainnya</li>

                    <li class="side-nav-item">
                        <a href="<?= base_url('admin/user') ?>" class="side-nav-link">
                            <i class="uil uil-user"></i>
                            <span> Users </span>
                        </a>
                    </li>

                    <li class="side-nav-item">
                        <a href="<?= base_url('admin/account') ?>" class="side-nav-link">
                            <i class="uil-key-skeleton-alt"></i>
                            <span> Account </span>
                        </a>
                    </li>
                    <li class="side-nav-item">
                        <a href="<?= base_url('admin/logout') ?>" class="side-nav-link">
                            <i class="uil-sign-out-alt"></i>
                            <span> Logout </span>
                        </a>
                    </li>

                </ul>
                <!-- End Sidebar -->

                <div class="clearfix"></div>
                <!-- Sidebar -left -->

            </div>
            <!-- Left Sidebar End -->

            <div class="content-page">
                <div class="content">
                    <?= $this->renderSection('content') ?>
                </div> <!-- End Content -->

                <!-- Footer Start -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="col-md-6">
                            <script>
                            document.write(new Date().getFullYear())
                            </script> © PKG - Abdul Yamin
                        </div>
                    </div>
                </footer>
                <!-- end Footer -->

            </div> <!-- content-page -->

        </div> <!-- end wrapper-->
    </div>
    <!-- END Container -->

    <!-- bundle -->
    <script src="<?= base_url() ?>/public/js/app.min.js"></script>

    <!-- Todo js -->
    <script src="<?= base_url() ?>/public/js/ui/component.todo.js"></script>
    <!-- end demo js-->

</body>

</html>