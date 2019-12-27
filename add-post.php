<?php
session_set_cookie_params(0);
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['login']) == 0) {
    header('location: login.php');
} else {
    if (isset($_POST['submit'])) {
        $title = $_POST['title'];
        $cat = $_POST['selectcat'];
        $grabber = $_POST['grabber'];
        $description = $_POST['description'];
        $username = $_POST['name'];

        $email3 = $_SESSION['login'];

        $sql3 = "SELECT `id` FROM `users` WHERE `email`=:email3";
        $query3 = $dbh->prepare($sql3);
        $query3->bindParam(':email3', $email3, PDO::PARAM_STR);
        $query3->execute();
        $results3 = $query3->fetchAll(PDO::FETCH_OBJ);
        if ($query3->rowCount() > 0) {
            foreach ($results3 as $result3) {
                $uid = $result3->id;
            }
        }

        $image1 = $_FILES["img1"]["name"];
        $status = 0;

        move_uploaded_file($_FILES["img1"]["tmp_name"], "assets/img/postimages/" . $_FILES["img1"]["name"]);

        $sql = "INSERT INTO posts(title,category,grabber,description,username,image1,userid,status) VALUES(:title,:cat,:grabber,:description,:username,:image1,:uid,:status)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':title', $title, PDO::PARAM_STR);
        $query->bindParam(':cat', $cat, PDO::PARAM_STR);
        $query->bindParam(':grabber', $grabber, PDO::PARAM_STR);
        $query->bindParam(':description', $description, PDO::PARAM_STR);
        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->bindParam(':image1', $image1, PDO::PARAM_STR);
        $query->bindParam(':uid', $uid, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);

        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        if ($lastInsertId) {
            echo "<script>alert('Blog submitted successfully, wait for approval');document.location = 'index.php';</script>";
        } else {
            echo "<script>alert('Something went wrong')</script>";
        }
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Add Post</title>
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet"
              href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic">
        <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
        <script src="assets/js/tinymce.min.js" referrerpolicy="origin"></script>
        <script>tinymce.init({selector: 'textarea'});</script>
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
                <div class="col-md-10 col-lg-8 mx-auto">
                    <h2 class="post-title">Add a post</h2>
                    <form id="contactForm" method="post" enctype="multipart/form-data">
                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls">
                                <label for="title">Title</label>
                                <input class="form-control" type="text" id="title" required placeholder="Title"
                                       name="title">
                                <small class="form-text text-danger help-block">Title</small>
                            </div>
                        </div>

                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls">
                                <label for="select1"><strong>Select Category</strong></label>
                                <select class="form-control" id="select1"
                                        name="selectcat" required>
                                    <option value="">-- Select --</option>
                                    <?php $ret = "SELECT `id`,`catname` FROM `categories`";
                                    $query = $dbh->prepare($ret);
                                    //$query->bindParam(':id',$id, PDO::PARAM_STR);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    if ($query->rowCount() > 0) {
                                        foreach ($results as $result) {
                                            ?>
                                            <option value="<?php echo htmlentities($result->id); ?>">
                                                <?php echo htmlentities($result->catname); ?>
                                            </option>
                                        <?php }
                                    } ?>
                                </select>
                                <small class="form-text text-danger help-block">Select Category</small>
                            </div>
                        </div>

                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls">
                                <label for="grabber">Grabber</label>
                                <input class="form-control" type="text" id="grabber" required placeholder="Grabber"
                                       name="grabber">
                                <small class="form-text text-danger help-block">Grabber</small>
                            </div>
                        </div>

                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls">
                                <label for="file1">Add an image</label>
                                <input type="file" class="form-control-file" id="file1" name="img1">
                                <small class="form-text text-danger help-block">Header Image</small>
                            </div>
                        </div>

                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls">
                                <label for="desc">Description</label>
                                <textarea class="form-control" id="desc" required rows="5"
                                          name="description"></textarea>
                                <small class="form-text text-danger help-block">Description</small>
                            </div>
                        </div>
                        <?php
                        $email = $_SESSION['login'];
                        $sql2 = "SELECT fname,lname,id FROM users WHERE email=:email ";
                        $query = $dbh->prepare($sql2);
                        $query->bindParam(':email', $email, PDO::PARAM_STR);
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                        if ($query->rowCount() > 0) {
                            foreach ($results as $result2) {
                                $name = $result2->fname . " " . $result2->lname;
                                ?>
                                <div class="control-group">
                                    <div class="form-group floating-label-form-group controls">
                                        <label for="name">Username</label>
                                        <input class="form-control" type="text" id="name" required
                                               name="name" value="<?php echo htmlentities($name); ?>">
                                        <small class="form-text text-danger help-block">Username</small>
                                    </div>
                                </div>
                            <?php }
                        }
                        ?>
                        <br>
                        <div id="success"></div>
                        <div class="form-group">
                            <button class="btn btn-primary float-right" id="sendMessageButton" type="submit"
                                    name="submit">Post
                            </button>
                        </div>
                    </form>
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
