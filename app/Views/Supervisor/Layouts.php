
<!DOCTYPE html>
<html lang="en">
 <meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
        <meta charset="utf-8" />
        <title>Superv | <?=$title?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured superv theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="<?=base_url()?>/public/images/favicon.ico">

        <!-- third party css -->
        <link href="<?=base_url()?>/public/css/vendor/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        <!-- third party css end -->
        <!-- App css -->
        <link href="<?=base_url()?>/public/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url()?>/public/css/app-creative.min.css" rel="stylesheet" type="text/css" id="light-style" />
        <link href="<?=base_url()?>/public/css/app-creative-dark.min.css" rel="stylesheet" type="text/css" id="dark-style" />
        <style>
            .button-menu-mobile span {
                background:black;
            }
            .mybg{
                background: rgb(248,248,248);
                background: linear-gradient(90deg, rgba(248,248,248,0.9725140056022409) 12%, rgba(255,255,255,0.9024859943977591) 55%, rgba(255,255,255,1) 100%);
            }
            /* CSS */
.mid td {
    vertical-align: middle;
}
.mid th {
    vertical-align: middle;
}

            </style>
           <script src="<?=base_url()?>/public/js/vendor.min.js"></script>
           <script src="<?=base_url()?>/public/js/sweetalert2.min.js"></script>
           <link href="<?=base_url()?>/public/css/sweetalert2.min.css" rel="stylesheet" type="text/css" />

           <!-- Datatables css -->
<link href="<?=base_url()?>/public/css/vendor/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url()?>/public/css/vendor/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />
<!-- Datatables js -->
<script src="<?=base_url()?>/public/js/vendor/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>/public/js/vendor/dataTables.bootstrap4.js"></script>
<script src="<?=base_url()?>/public/js/vendor/dataTables.responsive.min.js"></script>
<script src="<?=base_url()?>/public/js/vendor/responsive.bootstrap4.min.js"></script>


    </head>

    <body class="loading mybg" data-layout="detached" data-layout-config='{"layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>

        <!-- Topbar Start -->
        <!-- <a class="button-menu-mobile disable-btn bg-dark">
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

  
        <!-- end Topbar -->
        
        <!-- Start Content-->
        <div class="container-fluid">

            <!-- Begin page -->
            <div class="wrapper">

                <!-- ========== Left Sidebar Start ========== -->
                <div class="leftside-menu leftside-menu-detached">

                    <div class="leftbar-user">
                        <a href="javascript: void(0);">
                            <img src="<?=base_url()?>/public/images/users/avatar.jpg" alt="user-image" height="42" class="rounded-circle shadow-sm">
                            <span class="leftbar-user-name"><?=UserLogin()->full_name?></span>
                            <span class="badge bg-info rounded-pill">Supervisor</span>
                        </a>
                    </div>

                    <!--- Sidemenu -->
                    <ul class="side-nav">

                        <li class="side-nav-title side-nav-item">PKG (<?=PeriodeAktif()->tahun_akademik?>)</li>

                        <li class="side-nav-item active">
                            <a href="<?=base_url('superv')?>"  class="side-nav-link ">
                                <i class="mdi mdi-view-dashboard-outline"></i>
                                <span> Dashboard </span>
                            </a>
              
                        </li>
                        <li class="side-nav-item">
                            <a href="<?=base_url('superv/penilaian')?>" class="side-nav-link">
                                <i class="uil-file-copy-alt"></i>
                                <span> Penilaian </span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="<?=base_url('superv/skors')?>" class="side-nav-link">
                                <i class="mdi mdi-star"></i>
                                <span> Skors</span>
                            </a>
                        </li>
        
                        <li class="side-nav-title side-nav-item mt-1">SETTING</li>

                        <li class="side-nav-item">
                            <a href="<?=base_url('superv/account')?>" class="side-nav-link">
                                <i class="uil-key-skeleton-alt"></i>
                                <span> Account </span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="<?=base_url('superv/logout')?>" class="side-nav-link">
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
                    <script>document.write(new Date().getFullYear())</script> © PKG - Abdul Yamin
                    </div>
                    </div>
                    </footer>
                    <!-- end Footer -->

                </div> <!-- content-page -->

            </div> <!-- end wrapper-->
        </div>
        <!-- END Container -->
 
        <!-- bundle -->
        <script src="<?=base_url()?>/public/js/app.min.js"></script>
        <!-- Todo js -->
        <script src="<?=base_url()?>/public/js/ui/component.todo.js"></script>
        <!-- end demo js-->
        
    </body>
</html>
