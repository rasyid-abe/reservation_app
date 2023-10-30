<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title><?php echo $header_title ?> - <?php echo $subtitle ?></title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <link href="<?= base_url() ?>/themes/css/styles.css" rel="stylesheet" />
        <link href="<?= base_url() ?>/themes/dataTable/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="<?= base_url() ?>themes/js/all.min.js" crossorigin="anonymous"></script>
        <script src="<?= base_url() ?>themes/js/jquery-3.4.1.js" crossorigin="anonymous"></script>
        <style media="screen">
        .jamtanggal {
            font-size: 14pt;
            color: white;
        }
        </style>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="#">Grha PETCARE</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                <div class="input-group jamtanggal">
                    <?php echo format_indo(date('Y-m-d')) . ' -' ?>&nbsp;<span class="jam"></span> &nbsp;WIB
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <?php if ($this->session->userdata('role_id') != 1): ?>
                            <a class="dropdown-item" href="<?php echo base_url('profile') ?>">Profil Saya</a>
                            <a class="dropdown-item" href="<?php echo base_url('profile/password') ?>">Ubah Password</a>
                            <div class="dropdown-divider"></div>
                        <?php endif; ?>
                        <a class="dropdown-item" href="<?php echo base_url('auth/logout') ?>">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <?php if ($this->session->userdata('role_id') == 1): ?>
                                <a class="nav-link" href="<?php echo base_url('root/home') ?>">
                                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                    Dashboard
                                </a>
                                <!-- <div class="sb-sidenav-menu-heading">Interface</div> -->
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                    Manajemen User
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="<?php echo base_url('root/user_admin') ?>">Admin</a>
                                        <a class="nav-link" href="<?php echo base_url('root/user_doctor') ?>">Dokter</a>
                                        <a class="nav-link" href="<?php echo base_url('root/user_client') ?>">Klien</a>
                                    </nav>
                                </div>
                                <a class="nav-link" href="<?php echo base_url('root/reservation_ro') ?>">
                                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                    Reservasi
                                </a>
                                <a class="nav-link" href="<?php echo base_url('root/billing_ro') ?>">
                                    <div class="sb-nav-link-icon"><i class="fas fa-file-invoice-dollar"></i></div>
                                    Biling
                                </a>
                                <!-- <a class="nav-link" href="tables.html">
                                    <div class="sb-nav-link-icon"><i class="fas fa-clipboard-list"></i></div>
                                    History
                                </a> -->
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#master_data" aria-expanded="false" aria-controls="master_data">
                                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                    Master Data
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="master_data" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <!-- <a class="nav-link" href="<?php echo base_url('root/specialist') ?>">Spesialis Dokter</a> -->
                                        <a class="nav-link" href="<?php echo base_url('root/hour') ?>">Jam Reservasi</a>
                                    </nav>
                                </div>
                            <?php elseif ($this->session->userdata('role_id') == 2): ?>
                                <a class="nav-link" href="<?php echo base_url('admin/home_adm') ?>">
                                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                    Dashboard
                                </a>
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                    Manajemen User
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="<?php echo base_url('admin/user_doctor_adm') ?>">Dokter</a>
                                        <a class="nav-link" href="<?php echo base_url('admin/user_client_adm') ?>">Klien</a>
                                    </nav>
                                </div>
                                <a class="nav-link" href="<?php echo base_url('admin/reservation_adm') ?>">
                                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                    Reservasi
                                </a>
                                <a class="nav-link" href="<?php echo base_url('admin/billing_adm') ?>">
                                    <div class="sb-nav-link-icon"><i class="fas fa-file-invoice-dollar"></i></div>
                                    Biling
                                </a>
                                <!-- <a class="nav-link" href="tables.html">
                                    <div class="sb-nav-link-icon"><i class="fas fa-clipboard-list"></i></div>
                                    History
                                </a> -->
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#master_data" aria-expanded="false" aria-controls="master_data">
                                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                    Master Data
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="master_data" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <!-- <a class="nav-link" href="<?php echo base_url('admin/specialist_adm') ?>">Spesialis Dokter</a> -->
                                        <a class="nav-link" href="<?php echo base_url('admin/hour_adm') ?>">Jam Reservasi</a>
                                    </nav>
                                </div>
                            <?php elseif ($this->session->userdata('role_id') == 4): ?>
                                <a class="nav-link" href="<?php echo base_url('client/home_kl') ?>">
                                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                    Dashboard
                                </a>
                                <a class="nav-link" href="<?php echo base_url('client/reservation_kl') ?>">
                                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                    Reservasi
                                </a>
                                <a class="nav-link" href="<?php echo base_url('client/User_doctor_kl') ?>">
                                    <div class="sb-nav-link-icon"><i class="fas fa-align-justify"></i></div>
                                    Daftar Dokter
                                </a>
                                <!-- <a class="nav-link" href="tables.html">
                                    <div class="sb-nav-link-icon"><i class="fas fa-clock"></i></div>
                                    Jadwal Saya
                                </a> -->
                                <a class="nav-link" href="<?php echo base_url('client/billing_kl') ?>">
                                    <div class="sb-nav-link-icon"><i class="fas fa-file-invoice-dollar"></i></div>
                                    Biling
                                </a>
                                <!-- <a class="nav-link" href="tables.html">
                                    <div class="sb-nav-link-icon"><i class="fas fa-clipboard-list"></i></div>
                                    History
                                </a> -->
                            <?php else: ?>
                                <a class="nav-link" href="<?php echo base_url('doctor/home_doc') ?>">
                                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                    Dashboard
                                </a>
                                <a class="nav-link" href="<?php echo base_url('doctor/reservation_doc') ?>">
                                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                    Reservasi
                                </a>
                                <a class="nav-link" href="<?php echo base_url('doctor/user_client_doc') ?>">
                                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                    Klien Saya
                                </a>
                                <!-- <a class="nav-link" href="tables.html">
                                    <div class="sb-nav-link-icon"><i class="fas fa-clock"></i></div>
                                    Jadwal Saya
                                </a> -->
                                <a class="nav-link" href="<?php echo base_url('doctor/billing_doc') ?>">
                                    <div class="sb-nav-link-icon"><i class="fas fa-file-invoice-dollar"></i></div>
                                    Biling
                                </a>
                                <!-- <a class="nav-link" href="tables.html">
                                    <div class="sb-nav-link-icon"><i class="fas fa-clipboard-list"></i></div>
                                    History
                                </a> -->
                            <?php endif; ?>

                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Login sebagai:</div>
                        <?php if ($this->session->userdata('role_id') == 1): ?>
                            Super User
                        <?php elseif ($this->session->userdata('role_id') == 2): ?>
                            Admin
                        <?php elseif ($this->session->userdata('role_id') == 3): ?>
                            Dokter
                        <?php else: ?>
                            Klien
                        <?php endif; ?>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h4 class="mt-4"><?php echo $header_title ?></h4><hr>
                        <?php echo template_echo('content');?>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2020</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

        <script src="<?= base_url() ?>themes/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="<?= base_url() ?>themes/js/scripts.js"></script>
        <!-- <script src="<?= base_url() ?>themes/js/Chart.min.js" crossorigin="anonymous"></script> -->
        <!-- <script src="<?= base_url() ?>themes/assets/demo/chart-area-demo.js"></script> -->
        <!-- <script src="<?= base_url() ?>themes/assets/demo/chart-bar-demo.js"></script> -->
        <script src="<?= base_url() ?>themes/dataTable/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="<?= base_url() ?>themes/dataTable/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="<?= base_url() ?>themes/assets/demo/datatables-demo.js"></script>

        <script type="text/javascript">
        function jam() {
            var time = new Date(),
            hours = time.getHours(),
            minutes = time.getMinutes(),
            seconds = time.getSeconds();
            document.querySelectorAll('.jam')[0].innerHTML = harold(hours) + ":" + harold(minutes) + ":" + harold(seconds);

            function harold(standIn) {
                if (standIn < 10) {
                    standIn = '0' + standIn
                }
                return standIn;
            }
        }
        setInterval(jam, 1000);
    </script>
    </body>
</html>
