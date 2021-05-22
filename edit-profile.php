<?php
session_set_cookie_params(0);
session_start();
include('includes/config.php');
if (strlen($_SESSION['login']) == 0) {
    header('location: login.php');
} else {
    if (isset($_POST['submit'])) {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $phone = $_POST['phone'];
        $email = $_SESSION['login'];

        $sql1 = "UPDATE `users` SET `fname`=:fname,`lname`=:lname,`email`=:email,`phone`=:phone WHERE `email`=:email";
        $query = $dbh->prepare($sql1);
        $query->bindParam(':fname', $fname, PDO::PARAM_STR);
        $query->bindParam(':lname', $lname, PDO::PARAM_STR);
        $query->bindParam(':phone', $phone, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);

        $query->execute();
        echo "<script>alert('User UPDATED');document.location = 'index.php';</script>";
    }
    ?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Profile</title>
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet"
              href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic">
        <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    </head>

    <body>
        <!-- Header -->
        <?php include 'includes/header.php'; ?>

        <header class="masthead" style="background-image:url('assets/img/home-bg.jpg');">
            <div class="overlay"></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-lg-8 mx-auto">
                        <div class="site-heading">
                            <h1>Kabir's Blog</h1><span class="subheading">An Informative Blog</span></div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Header -->

        <div class="container">

            <div class="row">
                <div class="col-md-9 col-lg-6">
                    <div class="clearfix">
                        <h4>Update Profile</h4>
                        <br>
                        <?php
                        $email = $_SESSION['login'];
                        $sql2 = "SELECT * FROM `users` WHERE `email`=:email";
                        $query = $dbh->prepare($sql2);
                        $query->bindParam(':email', $email, PDO::PARAM_STR);
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                        $cnt = 1;
                        if ($query->rowCount() > 0) {
                        foreach ($results

                        as $result) { ?>
                        <form method="post">
                            <div class="form-group">
                                <label for="fname">First Name</label>
                                <input type="text" class="form-control" id="fname" name="fname"
                                       value="<?php echo htmlentities($result->fname); ?>">
                            </div>
                            <div class="form-group">
                                <label for="lname">Last Name</label>
                                <input type="text" class="form-control" id="lname" name="lname"
                                       value="<?php echo htmlentities($result->lname); ?>">
                            </div>
                            <div class="form-group">
                                <label for="email1">Email address</label>
                                <input type="email" class="form-control" id="email1" name="email"
                                       value="<?php echo htmlentities($result->email); ?>" disabled>
                                <small id="emailHelp" class="form-text text-muted">To change email address contact
                                                                                   admin</small>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="tel" class="form-control" id="phone" name="phone" autocomplete="off"
                                       value="<?php echo htmlentities($result->phone); ?>">
                            </div>
                            <?php }
                            } ?>
                            <div class="form-group">
                                <button type="submit" class="btn btn-danger float-right" name="submit">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
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