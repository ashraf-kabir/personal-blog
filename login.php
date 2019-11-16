<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (!empty($_SESSION['login'])) {
    header("location: index.php");
} else {
    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $status = 1;
        $sql = "SELECT email,password FROM users WHERE email=:email AND password=:password AND status=:status";
        $query = $dbh->prepare($sql);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);

        if ($query->rowCount() > 0) {
            $_SESSION['login'] = $_POST['email'];
            $currentpage = $_SESSION['redirectURL'];
            echo "<script type='text/javascript'> document.location = '$currentpage'; </script>";
        } else {
            echo "<script>alert('Invalid Details');</script>";
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

        <title>Login - User</title>

        <!-- Custom fonts for this template-->
        <link href="admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
              rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="admin/css/sb-admin-2.min.css" rel="stylesheet">

        <script type="text/javascript">
            function validate() {
                let email = document.userlogin.email.value;
                let pass = document.userlogin.password.value;
                if (email === "" || email === null && pass === "" || pass === null) {
                    //alert("Please provide your email and password");
                    document.getElementById('emailcheck').innerHTML = 'Enter your email address';
                    document.getElementById('passwordcheck').innerHTML = 'Enter your password';
                    //document.userlogin.password.focus() ;
                    return false;
                }
                if (email === "" || email === null) {
                    //alert("Please provide your email");
                    document.getElementById('emailcheck').innerHTML = 'Enter your email address';
                    document.userlogin.email.focus();
                    return false;
                } else {
                    var mailformat = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                    if (email.match(mailformat)) {
                        if (pass === "" || pass === null) {
                            //alert("Please provide your password");
                            document.getElementById('passwordcheck').innerHTML = 'Enter your password';
                            document.userlogin.password.focus();
                            return false;
                        }
                        return true;
                        // when password field is not empty
                    } else {
                        document.getElementById('emailcheck').innerHTML = 'Enter a correct email address';
                        document.userlogin.email.focus();
                        return false;
                    }
                }
            }
        </script>

    </head>

    <body class="bg-gradient-primary">

        <div class="container">

            <!-- Outer Row -->
            <div class="row justify-content-center">

                <div class="col-xl-10 col-lg-12 col-md-9">

                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-6 d-none d-lg-block" style="background-image: url(admin/img/green.jpg);"></div>
                                <div class="col-lg-6">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">User Login</h1>
                                        </div>
                                        <form class="user" method="post" id="userform" name="userlogin"
                                              onsubmit="return validate();" novalidate>
                                            <div class="form-group">
                                                <input type="email" class="form-control form-control-user"
                                                       id="email" aria-describedby="emailHelp" name="email"
                                                       autocomplete="off"
                                                       placeholder="Enter Email Address...">
                                                <span id="emailcheck" style="font-size: 12px; color: red;"></span>
                                            </div>
                                            <div class="form-group">
                                                <input type="password" class="form-control form-control-user"
                                                       id="password" placeholder="Password" name="password"
                                                       autocomplete="off">
                                                <span id="passwordcheck" style="font-size: 12px; color: red;"></span>
                                            </div>
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox small">
                                                    <input type="checkbox" class="custom-control-input"
                                                           id="customCheck">
                                                    <label class="custom-control-label" for="customCheck">Remember
                                                                                                          Me</label>
                                                </div>
                                            </div>
                                            <button class="btn btn-success btn-block text-white btn-user" type="submit"
                                                    name="login">Login
                                            </button>
                                            <hr>
                                        </form>
                                        <hr>
                                        <div class="text-center">
                                            <a href="index.php"
                                               class="btn btn-primary btn-block text-white btn-user">Home</a>
                                        </div>
                                        <hr>
                                        <div class="text-center">
                                            <a href="view-posts.php" class="btn btn-info btn-block text-white btn-user">View
                                                                                                                        Posts</a>
                                        </div>
                                        <div class="text-center">
                                            <hr>
                                            <a href="#"
                                               class="btn btn-warning btn-block text-black-50 btn-user disabled">Forgot
                                                                                                                 Password?</a>
                                        </div>
                                        <hr>
                                        <div class="text-center">
                                            <a href="register.php" class="btn btn-danger btn-block text-white btn-user">Don't
                                                                                                                        have
                                                                                                                        an
                                                                                                                        account?
                                                                                                                        Register</a>
                                        </div>
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