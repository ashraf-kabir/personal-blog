<?php
//error_reporting(0);
include('includes/config.php');
if (isset($_POST['signup'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $sql = "INSERT INTO users(`fname`,`lname`,`email`,`password`) VALUES(:fname,:lname,:email,:password)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':fname', $fname, PDO::PARAM_STR);
    $query->bindParam(':lname', $lname, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $dbh->lastInsertId();
    if ($lastInsertId) {
        echo "<script>alert('Registration successful');</script>";
    } else {
        echo "<script>alert('Something went wrong');</script>";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Register - Blog</title>
    <link rel="stylesheet" href="admin/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="admin/assets/fonts/fontawesome-all.min.css">

    <script>
        function checkAvailability() {
            $("#loaderIcon").show();
            jQuery.ajax({
                url: "check-availability.php",
                data: 'email=' + $("#email").val(),
                type: "POST",
                success: function (data) {
                    $("#user-availability-status").html(data);
                    $("#loaderIcon").hide();
                },
                error: function () {
                }
            });
        }
    </script>

    <script type="text/javascript">
        function valid() {
            if (document.signup.password.value != document.signup.passwordrepeat.value) {
                alert("Password and Repeat Password field didn\'t match!!");
                document.signup.passwordrepeat.focus();
                return false;
            }
            return true;
        }
    </script>
</head>

<body class="bg-gradient-primary">
    <div class="container">
        <div class="card shadow-lg o-hidden border-0 my-5">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-flex">
                        <div class="flex-grow-1 bg-register-image"
                             style="background-image: url(&quot;assets/img/bugsbunny02.jpg&quot;);"></div>
                    </div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h4 class="text-dark mb-4"><strog>Create an Account!</strog></h4>
                            </div>
                            <form class="user" method="post" name="signup" onSubmit="return valid();">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0"><input class="form-control form-control-user"
                                                                              type="text" id="exampleFirstName"
                                                                              placeholder="First Name"
                                                                              name="fname"></div>
                                    <div class="col-sm-6"><input class="form-control form-control-user" type="text"
                                                                 id="exampleFirstName" placeholder="Last Name"
                                                                 name="lname">
                                    </div>
                                </div>
                                <div class="form-group"><input class="form-control form-control-user" type="email"
                                                               id="email" aria-describedby="emailHelp"
                                                               placeholder="Email Address" name="email"
                                                               onBlur="checkAvailability()">
                                    <span id="user-availability-status" style="font-size:12px;"></span>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0"><input class="form-control form-control-user"
                                                                              type="password" id="examplePasswordInput"
                                                                              placeholder="Password" name="password">
                                    </div>
                                    <div class="col-sm-6"><input class="form-control form-control-user" type="password"
                                                                 id="exampleRepeatPasswordInput"
                                                                 placeholder="Repeat Password" name="passwordrepeat">
                                    </div>
                                </div>
                                <button class="btn btn-danger btn-block text-white btn-user" type="submit"
                                        name="signup" id="submit">Register Account
                                </button>
                                <hr>
                            </form>
                            <div class="text-center">
                                <a href="index.php"
                                   class="btn btn-primary btn-block text-white btn-user">Home</a>
                                <hr>
                            </div>
                            <div class="text-center">
                                <a href="forgot-password.php"
                                   class="btn btn-warning btn-block text-black-50 btn-user disabled">Forgot
                                                                                                     Password?</a>
                                <hr>
                            </div>
                            <div class="text-center"><a href="login.php"
                                                        class="btn btn-success btn-block text-white btn-user">Already have an account? Login!</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="admin/assets/js/jquery.min.js"></script>
    <script src="admin/assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="admin/assets/js/chart.min.js"></script>
    <script src="admin/assets/js/bs-charts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="admin/assets/js/theme.js"></script>
</body>

</html>