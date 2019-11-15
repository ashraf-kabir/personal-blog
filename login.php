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
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Login - User</title>
        <link rel="stylesheet" href="admin/assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet"
              href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
        <link rel="stylesheet" href="/admin/assets/fonts/fontawesome-all.min.css">

        <script src="admin/assets/js/jquery.min.js"></script>

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

    <body class="bg-gradient-primary" style="background-color: #071e22;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-9 col-lg-12 col-xl-10">
                    <div class="card shadow-lg o-hidden border-0 my-5">
                        <div class="card-body p-0">
                            <div class="row">
                                <div class="col-lg-6 d-none d-lg-flex">
                                    <div class="flex-grow-1 bg-login-image"
                                         style="background-image: url(&quot;admin/assets/img/sample/Spongebob-Squarepants.jpg&quot;);"></div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h3 class="text-dark mb-4"><strong>Welcome</strong></h3>
                                        </div>
                                        <br>
                                        <form class="user" method="post" id="userform" name="userlogin"
                                              onsubmit="return validate();" novalidate>
                                            <div class="form-group">
                                                <input class="form-control form-control-user"
                                                       type="email" id="email" aria-describedby="emailHelp"
                                                       placeholder="Enter Email Address" name="email" autocomplete="off">
                                                <span id="emailcheck" style="font-size: 12px; color: red;"></span>
                                            </div>
                                            <div class="form-group">
                                                <input class="form-control form-control-user" type="password"
                                                       id="password" placeholder="Password" name="password"
                                                       autocomplete="off">
                                                <span id="passwordcheck" style="font-size: 12px; color: red;"></span>
                                            </div>
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox small">
                                                    <div class="form-check">
                                                        <input class="form-check-input custom-control-input"
                                                               type="checkbox" id="formCheck-1">
                                                        <label class="form-check-label custom-control-label"
                                                               for="formCheck-1">Remember Me</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <button class="btn btn-success btn-block text-white btn-user" type="submit"
                                                    name="login">Login
                                            </button>
                                            <hr>
                                            <br>
                                        </form>
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
        </div>
        <script src="admin/assets/js/jquery.min.js"></script>
        <script src="admin/assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="admin/assets/js/chart.min.js"></script>
        <script src="admin/assets/js/bs-charts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
        <script src="admin/assets/js/theme.js"></script>
    </body>

    </html>
<?php } ?>