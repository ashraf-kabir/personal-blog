<?php
session_set_cookie_params(0);
session_start();
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location: login.php');
} else {
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>SB Admin 2 - Animation Utilities</title>

        <!-- Custom fonts for this template-->
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
              rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="css/sb-admin-2.min.css" rel="stylesheet">

    </head>

    <body id="page-top">

        <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Sidebar -->
            <?php include "includes/sidebar.php"; ?>
            <!-- End of Sidebar -->

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- Topbar -->
                    <?php include "includes/header.php"; ?>
                    <!-- End of Topbar -->

                    <!-- Begin Page Content -->
                    <div class="container-fluid">

                        <!-- Page Heading -->
                        <h1 class="h3 mb-1 text-gray-800">Animation Utilities</h1>
                        <p class="mb-4">Bootstrap's default utility classes can be found on the official <a
                                    href="https://getbootstrap.com/docs">Bootstrap Documentation</a> page. The custom
                                        utilities below were created to extend this theme past the default utility
                                        classes
                                        built into Bootstrap's framework.</p>

                        <!-- Content Row -->
                        <div class="row">

                            <!-- Grow In Utility -->
                            <div class="col-lg-6">

                                <div class="card position-relative">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Grow In Animation Utilty</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <code>.animated--grow-in</code>
                                        </div>
                                        <div class="small mb-1">Navbar Dropdown Example:</div>
                                        <nav class="navbar navbar-expand navbar-light bg-light mb-4">
                                            <a class="navbar-brand" href="#">Navbar</a>
                                            <ul class="navbar-nav ml-auto">
                                                <li class="nav-item dropdown">
                                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown"
                                                       role="button" data-toggle="dropdown" aria-haspopup="true"
                                                       aria-expanded="false">
                                                        Dropdown
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right animated--grow-in"
                                                         aria-labelledby="navbarDropdown">
                                                        <a class="dropdown-item" href="#">Action</a>
                                                        <a class="dropdown-item" href="#">Another action</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="#">Something else here</a>
                                                    </div>
                                                </li>
                                            </ul>
                                        </nav>
                                        <p class="mb-0 small">Note: This utility animates the CSS transform property,
                                                              meaning it will override any existing transforms on an
                                                              element
                                                              being animated! In this theme, the grow in animation is
                                                              only
                                                              being used on dropdowns within the navbar.</p>
                                    </div>
                                </div>

                            </div>

                            <!-- Fade In Utility -->
                            <div class="col-lg-6">

                                <div class="card position-relative">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Fade In Animation Utilty</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <code>.animated--fade-in</code>
                                        </div>
                                        <div class="small mb-1">Navbar Dropdown Example:</div>
                                        <nav class="navbar navbar-expand navbar-light bg-light mb-4">
                                            <a class="navbar-brand" href="#">Navbar</a>
                                            <ul class="navbar-nav ml-auto">
                                                <li class="nav-item dropdown">
                                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown"
                                                       role="button" data-toggle="dropdown" aria-haspopup="true"
                                                       aria-expanded="false">
                                                        Dropdown
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right animated--fade-in"
                                                         aria-labelledby="navbarDropdown">
                                                        <a class="dropdown-item" href="#">Action</a>
                                                        <a class="dropdown-item" href="#">Another action</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="#">Something else here</a>
                                                    </div>
                                                </li>
                                            </ul>
                                        </nav>
                                        <div class="small mb-1">Dropdown Button Example:</div>
                                        <div class="dropdown mb-4">
                                            <button class="btn btn-primary dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                Dropdown
                                            </button>
                                            <div class="dropdown-menu animated--fade-in"
                                                 aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="#">Action</a>
                                                <a class="dropdown-item" href="#">Another action</a>
                                                <a class="dropdown-item" href="#">Something else here</a>
                                            </div>
                                        </div>
                                        <p class="mb-0 small">Note: This utility animates the CSS opacity property,
                                                              meaning
                                                              it will override any existing opacity on an element being
                                                              animated!</p>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>
                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <?php include "includes/footer.php"; ?>
                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="logout.php">Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>

    </body>

    </html>
<?php } ?>