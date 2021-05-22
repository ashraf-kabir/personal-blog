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

        <title>SB Admin 2 - Other Utilities</title>

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
                        <h1 class="h3 mb-1 text-gray-800">Other Utilities</h1>
                        <p class="mb-4">Bootstrap's default utility classes can be found on the official <a
                                    href="https://getbootstrap.com/docs">Bootstrap Documentation</a> page. The custom
                                        utilities below were created to extend this theme past the default utility
                                        classes
                                        built into Bootstrap's framework.</p>

                        <!-- Content Row -->
                        <div class="row">

                            <div class="col-lg-6">

                                <!-- Overflow Hidden -->
                                <div class="card mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Overflow Hidden Utilty</h6>
                                    </div>
                                    <div class="card-body">
                                        Use <code>.o-hidden</code> to set the overflow property of any element to
                                        hidden.
                                    </div>
                                </div>

                                <!-- Progress Small -->
                                <div class="card mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Progress Small Utility</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-1 small">Normal Progress Bar</div>
                                        <div class="progress mb-4">
                                            <div class="progress-bar" role="progressbar" style="width: 75%"
                                                 aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <div class="mb-1 small">Small Progress Bar</div>
                                        <div class="progress progress-sm mb-2">
                                            <div class="progress-bar" role="progressbar" style="width: 75%"
                                                 aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        Use the <code>.progress-sm</code> class along with <code>.progress</code>
                                    </div>
                                </div>

                                <!-- Dropdown No Arrow -->
                                <div class="card mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Dropdown - No Arrow</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="dropdown no-arrow mb-4">
                                            <button class="btn btn-secondary dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                Dropdown (no arrow)
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="#">Action</a>
                                                <a class="dropdown-item" href="#">Another action</a>
                                                <a class="dropdown-item" href="#">Something else here</a>
                                            </div>
                                        </div>
                                        Add the <code>.no-arrow</code> class alongside the <code>.dropdown</code>
                                    </div>
                                </div>

                            </div>

                            <div class="col-lg-6">

                                <!-- Roitation Utilities -->
                                <div class="card">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Rotation Utilities</h6>
                                    </div>
                                    <div class="card-body text-center">
                                        <div class="bg-primary text-white p-3 rotate-15 d-inline-block my-4">.rotate-15
                                        </div>
                                        <hr>
                                        <div class="bg-primary text-white p-3 rotate-n-15 d-inline-block my-4">
                                            .rotate-n-15
                                        </div>
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