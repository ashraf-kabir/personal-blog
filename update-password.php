<?php
session_start();
include('includes/config.php');
error_reporting(0);
if (strlen($_SESSION['login']) == 0) {
    header('location: login.php');
} else {
if (isset($_POST['submit'])) {
    $password = md5($_POST['password']);
    $newpassword = md5($_POST['newpassword']);

    $email = $_SESSION['login'];

    $sql = "SELECT `password` FROM `users` WHERE email=:email AND password=:password";
    $query = $dbh->prepare($sql);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    if ($query->rowCount() > 0) {
        $con = "UPDATE `users` SET password=:newpassword WHERE email=:email";
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
          href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">

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

<body>
    <!-- Header -->
    <?php include 'includes/header.php'; ?>

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card-box">
                    <h4 class="m-t-0 header-title"><b>Update Password</b></h4>
                    <hr/>

                    <div class="row">
                        <div class="col-md-10">
                            <form class="form-horizontal" name="chngpwd" method="post"
                                  onSubmit="return valid();">

                                <div class="form-group">
                                    <label for="cp" class="col-md-4 control-label">Current Password</label>
                                    <div class="col-md-4">
                                        <input id="cp" type="text" class="form-control" value="" name="password"
                                               required>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="np" class="col-md-4 control-label">New Password</label>
                                    <div class="col-md-4">
                                        <input id="np" type="text" class="form-control" value=""
                                               name="newpassword" required>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="cpd" class="col-md-4 control-label">Confirm Password</label>
                                    <div class="col-md-4">
                                        <input id="cpd" type="text" class="form-control" value=""
                                               name="confirmpassword" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-danger" name="submit">Submit</button>
                                    </div>
                                </div>

                            </form>
                        </div>

                    </div>


                </div>
            </div>
        </div>

        <div class="row">

        </div>
    </div>

    <!-- Footer -->
    <?php include 'includes/footer.php'; ?>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/clean-blog.js"></script>
</body>

</html>
<?php } ?>