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
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Update Password</title>
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet"
              href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
        <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">

        <script type="text/javascript">
            function valid() {
                if (document.chngpwd.newpassword.value != document.chngpwd.confirmpassword.value) {
                    alert("New password and Confirm password field didn\'t match!!");
                    document.chngpwd.confirmpassword.focus();
                    return false;
                }
                return true;
            }
        </script>
    </head>

    <body id="page-top">
        <div id="wrapper">

            <!-- sidebar -->
            <?php include 'includes/sidebar.php'; ?>

            <div class="d-flex flex-column" id="content-wrapper">
                <div id="content">

                    <!-- header -->
                    <?php include 'includes/header.php'; ?>

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

                                                <form method="post" name="chngpwd" onSubmit="return valid();">

                                                    <div class="form-row">
                                                        <div class="col-md-8 col-lg-6 col-xl-6">
                                                            <div class="form-group">
                                                                <label for="cp"><strong>Current Password</strong></label>
                                                                <input class="form-control" id="cp" type="text"
                                                                       name="password"
                                                                       value=""
                                                                       required>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-row">
                                                        <div class="col-md-8 col-lg-6 col-xl-6">
                                                            <div class="form-group">
                                                                <label for="np"><strong>New Password</strong></label>
                                                                <input class="form-control" id="np" type="text"
                                                                       name="newpassword"
                                                                       value=""
                                                                       required>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-row">
                                                        <div class="col-md-8 col-lg-6 col-xl-6">
                                                            <div class="form-group">
                                                                <label for="cpd"><strong>Confirm Password</strong></label>
                                                                <input class="form-control" id="cpd" type="text"
                                                                       name="confirmpassword"
                                                                       value=""
                                                                       required>
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
                </div>

                <!-- Footer -->
                <?php include 'includes/footer.php'; ?>

            </div>
            <a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a></div>
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/chart.min.js"></script>
        <script src="assets/js/bs-charts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
        <script src="assets/js/theme.js"></script>
    </body>

    </html>
<?php } ?>