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

        <title>Edit Profile</title>

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
                        <h3 class="text-dark mb-4">Profile</h3>
                        <div class="row mb-3">
                            <div class="col-lg-8">
                                <div class="row mb-3 d-none">
                                    <div class="col">
                                        <div class="card text-white bg-primary shadow">
                                            <div class="card-body">
                                                <div class="row mb-2">
                                                    <div class="col">
                                                        <p class="m-0">Peformance</p>
                                                        <p class="m-0"><strong>65.2%</strong></p>
                                                    </div>
                                                    <div class="col-auto"><i class="fas fa-rocket fa-2x"></i></div>
                                                </div>
                                                <p class="text-white-50 small m-0"><i class="fas fa-arrow-up"></i>&nbsp;5%
                                                                                                                  since
                                                                                                                  last
                                                                                                                  month
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="card text-white bg-success shadow">
                                            <div class="card-body">
                                                <div class="row mb-2">
                                                    <div class="col">
                                                        <p class="m-0">Peformance</p>
                                                        <p class="m-0"><strong>65.2%</strong></p>
                                                    </div>
                                                    <div class="col-auto"><i class="fas fa-rocket fa-2x"></i></div>
                                                </div>
                                                <p class="text-white-50 small m-0"><i class="fas fa-arrow-up"></i>&nbsp;5%
                                                                                                                  since
                                                                                                                  last
                                                                                                                  month
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="card shadow mb-3">
                                            <div class="card-header py-3">
                                                <p class="text-primary m-0 font-weight-bold">User Settings</p>
                                            </div>
                                            <div class="card-body">
                                                <form>
                                                    <div class="form-row">
                                                        <div class="col">
                                                            <div class="form-group"><label for="username"><strong>Username</strong></label><input
                                                                        class="form-control" type="text"
                                                                        placeholder="user.name" name="username"></div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group"><label for="email"><strong>Email
                                                                                                               Address</strong></label><input
                                                                        class="form-control" type="email"
                                                                        placeholder="user@example.com" name="email">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="col">
                                                            <div class="form-group"><label for="first_name"><strong>First
                                                                                                                    Name</strong></label><input
                                                                        class="form-control" type="text"
                                                                        placeholder="John" name="first_name"></div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group"><label for="last_name"><strong>Last
                                                                                                                   Name</strong></label><input
                                                                        class="form-control" type="text"
                                                                        placeholder="Doe" name="last_name"></div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group"><label
                                                                for="address"><strong>Address</strong></label><input
                                                                class="form-control" type="text"
                                                                placeholder="Sunset Blvd, 38" name="address"></div>
                                                    <div class="form-group" style="width: 564px;"><label
                                                                for="signature"><strong>Signature</strong><br></label><textarea
                                                                class="form-control form-control-lg" rows="4"
                                                                name="signature" style="height: 300px;"></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <button class="btn btn-primary btn-sm" type="submit">Save
                                                                                                             Settings
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="card shadow"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="card shadow mb-4">
                                    <div class="card-body text-center shadow"><img class="rounded-circle mb-3 mt-4"
                                                                                   src="assets/img/dogs/image2.jpeg"
                                                                                   width="160" height="160">
                                        <div class="mb-3">
                                            <button class="btn btn-primary btn-sm" type="button">Change Photo</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-3">
                                    <div class="card-header py-3">
                                        <h6 class="text-primary font-weight-bold m-0">Projects</h6>
                                    </div>
                                    <div class="card-body">
                                        <h4 class="small font-weight-bold">Server migration<span
                                                    class="float-right">20%</span></h4>
                                        <div class="progress progress-sm mb-3">
                                            <div class="progress-bar bg-danger" aria-valuenow="20" aria-valuemin="0"
                                                 aria-valuemax="100" style="width: 20%;"><span
                                                        class="sr-only">20%</span></div>
                                        </div>
                                        <h4 class="small font-weight-bold">Sales tracking<span
                                                    class="float-right">40%</span></h4>
                                        <div class="progress progress-sm mb-3">
                                            <div class="progress-bar bg-warning" aria-valuenow="40" aria-valuemin="0"
                                                 aria-valuemax="100" style="width: 40%;"><span
                                                        class="sr-only">40%</span></div>
                                        </div>
                                        <h4 class="small font-weight-bold">Customer Database<span class="float-right">60%</span>
                                        </h4>
                                        <div class="progress progress-sm mb-3">
                                            <div class="progress-bar bg-primary" aria-valuenow="60" aria-valuemin="0"
                                                 aria-valuemax="100" style="width: 60%;"><span
                                                        class="sr-only">60%</span></div>
                                        </div>
                                        <h4 class="small font-weight-bold">Payout Details<span
                                                    class="float-right">80%</span></h4>
                                        <div class="progress progress-sm mb-3">
                                            <div class="progress-bar bg-info" aria-valuenow="80" aria-valuemin="0"
                                                 aria-valuemax="100" style="width: 80%;"><span
                                                        class="sr-only">80%</span></div>
                                        </div>
                                        <h4 class="small font-weight-bold">Account setup<span class="float-right">Complete!</span>
                                        </h4>
                                        <div class="progress progress-sm mb-3">
                                            <div class="progress-bar bg-success" aria-valuenow="100" aria-valuemin="0"
                                                 aria-valuemax="100" style="width: 100%;"><span
                                                        class="sr-only">100%</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card shadow mb-5"></div>
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