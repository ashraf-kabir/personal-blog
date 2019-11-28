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
        $id = intval($_GET['id']);

        $sql = "UPDATE `posts` SET title=:title,category=:cat,grabber=:grabber,description=:description WHERE id=:id ";
        $query = $dbh->prepare($sql);
        $query->bindParam(':title', $title, PDO::PARAM_STR);
        $query->bindParam(':cat', $cat, PDO::PARAM_STR);
        $query->bindParam(':grabber', $grabber, PDO::PARAM_STR);
        $query->bindParam(':description', $description, PDO::PARAM_STR);
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->execute();

        echo "<script>alert('Post has updated successfully');document.location = 'view-posts.php';</script>";
    }
    ?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Edit Post</title>
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
                <div class="col-md-10 col-lg-8 mx-auto">
                    <h2 class="post-title">Edit a post</h2>
                    <br>
                    <?php
                    $id = intval($_GET['id']);
                    $sql = "SELECT posts.*,categories.catname,categories.id AS cid FROM posts JOIN categories ON categories.id=posts.category WHERE posts.id=:id";
                    $query = $dbh->prepare($sql);
                    $query->bindParam(':id', $id, PDO::PARAM_STR);
                    $query->execute();
                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                    $cnt = 1;
                    if ($query->rowCount() > 0) {
                    foreach ($results

                    as $result) { ?>
                    <form id="contactForm" method="post" enctype="multipart/form-data">
                        <div class="control-group">
                            <label for="title"><strong>Title</strong></label>
                            <div class="form-group floating-label-form-group controls"><input
                                        class="form-control" type="text" id="title" required="" placeholder="Title"
                                        name="title" value="<?php echo htmlentities($result->title); ?>"><small
                                        class="form-text text-danger help-block"></small></div>
                        </div>

                        <div class="control-group">
                            <label for="select1"><strong>Select Category</strong></label>
                            <div class="form-group floating-label-form-group controls">
                                <select class="form-control" id="select1"
                                        name="selectcat" required>
                                    <option value="<?php echo htmlentities($result->cid); ?>"><?php echo htmlentities($cname = $result->catname); ?></option>
                                    <?php $ret = "SELECT `id`,`catname` FROM `categories`";
                                    $query = $dbh->prepare($ret);
                                    //$query->bindParam(':id',$id, PDO::PARAM_STR);
                                    $query->execute();
                                    $resultss = $query->fetchAll(PDO::FETCH_OBJ);
                                    if ($query->rowCount() > 0) {
                                        foreach ($resultss as $results) {
                                            if ($results->catname == $cname) {
                                                continue;
                                            } else {
                                                ?>
                                                <option value="<?php echo htmlentities($results->id); ?>">
                                                    <?php echo htmlentities($results->catname); ?>
                                                </option>
                                            <?php }
                                        }
                                    } ?>
                                </select><small class="form-text text-danger help-block"></small>
                            </div>
                        </div>

                        <div class="control-group">
                            <label for="grabber"><strong>Grabber</strong></label>
                            <div class="form-group floating-label-form-group controls"><input
                                        class="form-control" type="text" id="grabber" required="" placeholder="Grabber"
                                        name="grabber" value="<?php echo htmlentities($result->grabber); ?>"><small
                                        class="form-text text-danger help-block"></small></div>
                        </div>

                        <div class="control-group">
                            <label for="image1"><strong>Header Image</strong></label>
                            <div class="form-group floating-label-form-group controls"><img
                                        src="assets/img/postimages/<?php echo htmlentities($result->image1); ?>"
                                        width="300" height="200" style="border:solid 1px #000"><br><br>
                                <a href="changeimage1.php?imgid=<?php echo htmlentities($result->id) ?>">Change
                                                                                                         Header Image</a>
                                <small class="form-text text-danger help-block"></small></div>
                        </div>

                        <div class="control-group">
                            <label for="desc"><strong>Description</strong></label>
                            <div class="form-group floating-label-form-group controls mb-3"><textarea
                                        class="form-control" id="desc"
                                        data-validation-required-message="Description" required=""
                                        placeholder="Description" rows="5"
                                        name="description"><?php echo htmlentities($result->description); ?></textarea><small
                                        class="form-text text-danger help-block"></small></div>
                        </div>
                        <?php }
                        } ?>
                        <div id="success"></div>
                        <div class="form-group">
                            <button class="btn btn-primary" id="sendMessageButton" type="submit" name="submit">Update
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
