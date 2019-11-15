<?php
session_set_cookie_params(0);
session_start();
include('includes/config.php');
error_reporting(0);
if (strlen($_SESSION['alogin']) == 0) {
    header('location: login.php');
} else {
    if (isset($_POST['submit'])) {
        $password = md5($_POST['password']);
        $newpassword = md5($_POST['newpassword']);

        $email = $_SESSION['alogin'];

        $sql = "SELECT `password` FROM `admin` WHERE email=:email AND password=:password";
        $query = $dbh->prepare($sql);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);

        if ($query->rowCount() > 0) {
            $con = "UPDATE `admin` SET password=:newpassword WHERE email=:email";
            $chngpwd1 = $dbh->prepare($con);
            $chngpwd1->bindParam(':email', $email, PDO::PARAM_STR);
            $chngpwd1->bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
            $chngpwd1->execute();
            echo "<script>alert('Your password has successfully updated')</script>";
        } else {
            echo "<script>alert('Your current password is not correct')</script>";
        }
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Update Password</title>

        <!-- Custom fonts for this template-->
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
              rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="css/sb-admin-2.min.css" rel="stylesheet">

        <script type="text/javascript">
            function valid() {
                if (document.chngpwd.newpassword.value !== document.chngpwd.confirmpassword.value) {
                    alert("New password and Confirm password field didn\'t match!!");
                    document.chngpwd.confirmpassword.focus();
                    return false;
                }
                return true;
            }
        </script>

        <script>
            var checkPass = function () {
                var password = document.getElementById('newpass').value;
                var repassword = document.getElementById('confirmpass').value;
                var regexpass = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,12}$/;
                if (password !== "" || password !== null) {
                    if (password.match(regexpass)) {
                        document.getElementById('newpassmsg').innerHTML = '';
                        document.getElementById('submit').disabled = false;
                        if (password === repassword) {
                            document.getElementById('confirmpassmsg').style.color = 'green';
                            document.getElementById('confirmpassmsg').innerHTML = 'password matched';
                            document.getElementById('submit').disabled = false;
                        } else {
                            document.getElementById('confirmpassmsg').style.color = 'red';
                            document.getElementById('confirmpassmsg').innerHTML = 'password not matching';
                            document.getElementById('submit').disabled = true;
                        }
                    } else {
                        document.getElementById('newpassmsg').innerHTML = 'Minimum len 8 & max len 12 where 1 uppercase & 1 digit mandatory';
                        document.getElementById('submit').disabled = true;
                    }
                } else {
                    document.getElementById('newpassmsg').innerHTML = 'Empty password';
                    document.getElementById('submit').disabled = true;
                }
            };
        </script>

        <script>
            function validate() {
                var currentpass = document.chngpwd.password.value;
                var newpass = document.chngpwd.newpassword.value;
                var confirmpass = document.chngpwd.confirmpassword.value;

                if (currentpass === "" || currentpass === null) {
                    document.getElementById('passmsg').style.color = 'red';
                    document.getElementById('passmsg').innerHTML = 'Invalid current password';
                    return false;
                }
                if (newpass === "" || newpass === null) {
                    document.getElementById('newpassmsg').innerHTML = 'Invalid new password';
                    return false;
                }
                if (confirmpass === "" || confirmpass === null) {
                    document.getElementById('confirmpassmsg').innerHTML = 'Invalid confirm password';
                    return false;
                }
            }
        </script>

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
                        <h3 class="text-dark mb-4">Update Password</h3>
                        <div class="row mb-3">
                            <div class="col-lg-8">

                                <div class="row">
                                    <div class="col">
                                        <div class="card shadow mb-3">
                                            <div class="card-header py-3">
                                                <p class="text-primary m-0 font-weight-bold">Update Password</p>
                                            </div>

                                            <div class="card-body">

                                                <form method="post" name="chngpwd" onSubmit="return validate();"
                                                      novalidate>

                                                    <div class="form-row">
                                                        <div class="col-md-8 col-lg-6 col-xl-6">
                                                            <div class="form-group">
                                                                <label for="pass"><strong>Current
                                                                                          Password</strong></label>
                                                                <input class="form-control" id="pass" type="password"
                                                                       name="password" autocomplete="off" required>
                                                                <span id="passmsg" style="font-size: 12px;"></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-row">
                                                        <div class="col-md-8 col-lg-6 col-xl-6">
                                                            <div class="form-group">
                                                                <label for="newpass"><strong>New
                                                                                             Password</strong></label>
                                                                <input class="form-control" id="newpass" type="password"
                                                                       name="newpassword" autocomplete="off"
                                                                       onkeyup="checkPass();" required>
                                                                <span id="newpassmsg" style="font-size: 12px;"></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-row">
                                                        <div class="col-md-8 col-lg-6 col-xl-6">
                                                            <div class="form-group">
                                                                <label for="confirmpass"><strong>Confirm
                                                                                                 Password</strong></label>
                                                                <input class="form-control" id="confirmpass" type="password"
                                                                       name="confirmpassword" autocomplete="off"
                                                                       onkeyup="checkPass();" required>
                                                                <span id="confirmpassmsg"
                                                                      style="font-size: 12px;"></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="form-row">
                                                            <div class="col-md-12 col-lg-12 col-xl-12">
                                                                <div class="form-group">
                                                                    <button class="btn btn-primary" type="submit"
                                                                            name="submit">Update
                                                                    </button>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                </form>
                                            </div>
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