<?php
session_start();
include('includes/config.php');

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $sql = "SELECT email,password FROM users WHERE email=:email AND password=:password";
    $query = $dbh->prepare($sql);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    if ($query->rowCount() > 0) {
        $_SESSION['login'] = $_POST['email'];
        //$_SESSION['name'] = $results->fname;
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
                                        <h4 class="text-dark mb-4">Welcome Back!</h4>
                                    </div>
                                    <form class="user" method="post" id="loginform">
                                        <div class="form-group"><input class="form-control form-control-user"
                                                                       type="email" id="exampleInputEmail"
                                                                       aria-describedby="emailHelp"
                                                                       placeholder="Enter Email Address"
                                                                       name="email"></div>
                                        <div class="form-group"><input class="form-control form-control-user"
                                                                       type="password" id="exampleInputPassword"
                                                                       placeholder="Password" name="password"></div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <div class="form-check"><input
                                                            class="form-check-input custom-control-input"
                                                            type="checkbox" id="formCheck-1"><label
                                                            class="form-check-label custom-control-label"
                                                            for="formCheck-1">Remember Me</label></div>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary btn-block text-white btn-user" type="submit"
                                                name="login">
                                            Login
                                        </button>
                                    </form>
                                    <div class="text-center">
                                        <hr>
                                        <a class="small" href="forgot-password.php">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="register.php">Don't have an account?
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