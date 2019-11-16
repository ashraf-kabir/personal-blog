<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (!empty($_SESSION['login'])) {
    header("location: index.php");
} else {
    if (isset($_POST['signup'])) {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $status = 0;

        $sql = "INSERT INTO users(`fname`,`lname`,`email`,`password`,`status`) VALUES(:fname,:lname,:email,:password,:status)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':fname', $fname, PDO::PARAM_STR);
        $query->bindParam(':lname', $lname, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        if ($lastInsertId) {
            echo "<script>alert('Registration successful, wait for approval');document.location = 'login.php'</script>";
        } else {
            echo "<script>alert('Something went wrong');</script>";
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

        <title>Register - Blog</title>

        <!-- Custom fonts for this template-->
        <link href="admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
              rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="admin/css/sb-admin-2.min.css" rel="stylesheet">

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
                if (document.signup.password.value !== document.signup.passwordrepeat.value) {
                    alert("Password and Repeat Password field didn\'t match!!");
                    document.signup.passwordrepeat.focus();
                    return false;
                }
                return true;
            }
        </script>

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
            $(document).ready(function () {
                function disablePrev() {
                    window.history.forward();
                }

                window.onload = disablePrev();
                window.onpageshow = function (evt) {
                    if (evt.persisted) disableBack()
                }
            });
        </script>

        <script type="text/javascript">
            var checkPass = function () {
                var password = document.getElementById('password').value;
                var repassword = document.getElementById('confirm_password').value;
                var regexpass = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,12}$/;
                if (password !== "" || password !== null) {
                    if (password.match(regexpass)) {
                        document.getElementById('checkpass').innerHTML = '';
                        document.getElementById('submit').disabled = false;
                        if (password === repassword) {
                            document.getElementById('message').style.color = 'green';
                            document.getElementById('message').innerHTML = 'password matched';
                            document.getElementById('submit').disabled = false;
                        } else {
                            document.getElementById('message').style.color = 'red';
                            document.getElementById('message').innerHTML = 'password not matching';
                            document.getElementById('submit').disabled = true;
                        }
                    } else {
                        document.getElementById('checkpass').innerHTML = 'Minimum len 8 & max len 12 where 1 uppercase & 1 digit mandatory';
                        document.getElementById('submit').disabled = true;
                    }
                } else {
                    document.getElementById('checkpass').innerHTML = 'Empty password';
                    document.getElementById('submit').disabled = true;
                }
            };

            var checkfname = function () {
                var fname = document.getElementById('fname').value;
                var fnamevalidation = /^[a-zA-Z ]{2,30}$/;

                if (fname === "" || fname === null || !fname.match(fnamevalidation) || fname.length < 2 || fname.length > 30) {
                    document.getElementById('checkfname').style.color = 'red';
                    document.getElementById('checkfname').innerHTML = 'invalid first name';
                    document.getElementById('submit').disabled = true;
                } else {
                    //var fnamevalidation = /^[a-zA-Z ]{2,15}$/;
                    if (fname.match(fnamevalidation)) {
                        //document.getElementById('checkfname').style.color = 'green';
                        document.getElementById('checkfname').innerHTML = '';
                        document.getElementById('submit').disabled = false;
                    }
                }
            };

            var checklname = function () {
                var lname = document.getElementById('lname').value;
                var lnamevalidation = /^[a-zA-Z]{2,15}$/;

                if (lname === "" || lname === null || !lname.match(lnamevalidation) || lname.length < 2 || lname.length > 15) {
                    document.getElementById('checklname').style.color = 'red';
                    document.getElementById('checklname').innerHTML = 'invalid last name';
                    document.getElementById('submit').disabled = true;
                } else {
                    //var fnamevalidation = /^[a-zA-Z ]{2,15}$/;
                    if (lname.match(lnamevalidation)) {
                        //document.getElementById('checklname').style.color = 'green';
                        document.getElementById('checklname').innerHTML = '';
                        document.getElementById('submit').disabled = false;
                    }
                }
            };

        </script>

        <script>
            function validate() {
                var fname = document.signup.fname.value;
                var lname = document.signup.lname.value;
                var email = document.signup.email.value;
                var pass = document.signup.password.value;
                var repass = document.signup.passwordrepeat.value;

                if (fname === "" || fname === null) {
                    document.getElementById('checkfname').innerHTML = 'Invalid First name';
                    return false;
                }
                if (lname === "" || lname === null) {
                    document.getElementById('checklname').innerHTML = 'Invalid Last name';
                    return false;
                }
                if (email === "" || email === null) {
                    //document.getElementById('checkemail').innerHTML = 'Enter your email address';
                    return false;
                }
                if (pass === "" || pass === null) {
                    document.getElementById('checkpass').innerHTML = 'Invalid password';
                    return false;
                }
            }
        </script>

    </head>

    <body class="bg-gradient-primary">

        <div class="container">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-5 d-none d-lg-block" style="background-image: url(admin/img/regimage.jpg);"></div>
                        <div class="col-lg-7">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Create an Account</h1>
                                </div>
                                <form class="user" method="post" name="signup" onsubmit="return validate();"
                                      novalidate>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input class="form-control form-control-user" type="text" id="fname"
                                                   placeholder="First Name" name="fname" autocomplete="off"
                                                   onkeyup="checkfname();">
                                            <span id="checkfname" style="font-size:12px; color: red;"></span>
                                        </div>
                                        <div class="col-sm-6">
                                            <input class="form-control form-control-user" type="text" id="lname"
                                                   placeholder="Last Name" name="lname" autocomplete="off"
                                                   onkeyup="checklname();">
                                            <span id="checklname" style="font-size:12px; color: red;"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control form-control-user" type="email" id="email"
                                               aria-describedby="emailHelp" autocomplete="off"
                                               placeholder="Email Address" name="email" onBlur="checkAvailability();">
                                        <span id="user-availability-status" style="font-size:12px;"></span>
                                        <span id="checkemail" style="font-size:12px; color: red;"></span>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input class="form-control form-control-user" type="password" id="password"
                                                   placeholder="Password" autocomplete="off" name="password"
                                                   onkeyup="checkPass();">
                                            <span id="checkpass" style="font-size:12px; color: red;"></span>
                                        </div>
                                        <div class="col-sm-6">
                                            <input class="form-control form-control-user" type="password"
                                                   id="confirm_password" autocomplete="off" onkeyup='checkPass();'
                                                   placeholder="Repeat Password" name="passwordrepeat">
                                            <span id='message'></span>
                                            <span id="checkrepass" style="font-size:12px; color: red;"></span>
                                        </div>
                                    </div>
                                    <button class="btn btn-danger btn-block text-white btn-user" type="submit"
                                            name="signup" id="submit">Register Account
                                    </button>
                                    <hr>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a href="index.php"
                                       class="btn btn-primary btn-block text-white btn-user">Home</a>
                                    <hr>
                                </div>
                                <div class="text-center">
                                    <a href="#"
                                       class="btn btn-warning btn-block text-black-50 btn-user disabled">Forgot
                                                                                                         Password?</a>
                                    <hr>
                                </div>
                                <div class="text-center"><a href="login.php"
                                                            class="btn btn-success btn-block text-white btn-user">Already
                                                                                                                  have an
                                                                                                                  account?
                                                                                                                  Login!</a>
                                </div>
                                <div class="text-center">
                                    <a class="small" href="#" aria-disabled="true">Forgot Password?</a>
                                </div>
                                <div class="text-center">
                                    <a class="small" href="login.php">Already have an account? Login!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="admin/vendor/jquery/jquery.min.js"></script>
        <script src="admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="admin/vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="admin/js/sb-admin-2.min.js"></script>

    </body>

    </html>
<?php } ?>