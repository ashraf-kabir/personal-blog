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

        <title>SB Admin 2 - Color Utilities</title>

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
                        <h1 class="h3 mb-1 text-gray-800">Color Utilities</h1>
                        <p class="mb-4">Bootstrap's default utility classes can be found on the official <a
                                    href="https://getbootstrap.com/docs">Bootstrap Documentation</a> page. The custom
                                        utilities below were created to extend this theme past the default utility
                                        classes
                                        built into Bootstrap's framework.</p>

                        <!-- Content Row -->
                        <div class="row">

                            <!-- First Column -->
                            <div class="col-lg-4">

                                <!-- Custom Text Color Utilities -->
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Custom Text Color Utilities</h6>
                                    </div>
                                    <div class="card-body">
                                        <p class="text-gray-100 p-3 bg-dark m-0">.text-gray-100</p>
                                        <p class="text-gray-200 p-3 bg-dark m-0">.text-gray-200</p>
                                        <p class="text-gray-300 p-3 bg-dark m-0">.text-gray-300</p>
                                        <p class="text-gray-400 p-3 bg-dark m-0">.text-gray-400</p>
                                        <p class="text-gray-500 p-3 m-0">.text-gray-500</p>
                                        <p class="text-gray-600 p-3 m-0">.text-gray-600</p>
                                        <p class="text-gray-700 p-3 m-0">.text-gray-700</p>
                                        <p class="text-gray-800 p-3 m-0">.text-gray-800</p>
                                        <p class="text-gray-900 p-3 m-0">.text-gray-900</p>
                                    </div>
                                </div>

                                <!-- Custom Font Size Utilities -->
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Custom Font Size Utilities</h6>
                                    </div>
                                    <div class="card-body">
                                        <p class="text-xs">.text-xs</p>
                                        <p class="text-lg mb-0">.text-lg</p>
                                    </div>
                                </div>

                            </div>

                            <!-- Second Column -->
                            <div class="col-lg-4">

                                <!-- Background Gradient Utilities -->
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Custom Background Gradient
                                                                                      Utilities</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="px-3 py-5 bg-gradient-primary text-white">.bg-gradient-primary</div>
                                        <div class="px-3 py-5 bg-gradient-success text-white">.bg-gradient-success</div>
                                        <div class="px-3 py-5 bg-gradient-info text-white">.bg-gradient-info</div>
                                        <div class="px-3 py-5 bg-gradient-warning text-white">.bg-gradient-warning</div>
                                        <div class="px-3 py-5 bg-gradient-danger text-white">.bg-gradient-danger</div>
                                    </div>
                                </div>

                            </div>

                            <!-- Third Column -->
                            <div class="col-lg-4">

                                <!-- Grayscale Utilities -->
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Custom Grayscale Background
                                                                                      Utilities</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="p-3 bg-gray-100">.bg-gray-100</div>
                                        <div class="p-3 bg-gray-200">.bg-gray-200</div>
                                        <div class="p-3 bg-gray-300">.bg-gray-300</div>
                                        <div class="p-3 bg-gray-400">.bg-gray-400</div>
                                        <div class="p-3 bg-gray-500 text-white">.bg-gray-500</div>
                                        <div class="p-3 bg-gray-600 text-white">.bg-gray-600</div>
                                        <div class="p-3 bg-gray-700 text-white">.bg-gray-700</div>
                                        <div class="p-3 bg-gray-800 text-white">.bg-gray-800</div>
                                        <div class="p-3 bg-gray-900 text-white">.bg-gray-900</div>
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