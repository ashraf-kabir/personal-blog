<?php
session_start();
include('includes/config.php');
if (strlen($_SESSION['login']) == 0) {
    header('location: login.php');
} else {
    if (isset($_POST['submit'])) {
        $title = $_POST['title'];
        $cat = $_POST['selectcat'];
        $grabber = $_POST['grabber'];
        $description = $_POST['description'];

        $sql = "INSERT INTO posts(title,category,grabber,description) VALUES(:title,:cat,:grabber,:description)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':title', $title, PDO::PARAM_STR);
        $query->bindParam(':cat', $cat, PDO::PARAM_STR);
        $query->bindParam(':grabber', $grabber, PDO::PARAM_STR);
        $query->bindParam(':description', $description, PDO::PARAM_STR);

        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        if ($lastInsertId) {
            echo "<script>alert('Blog posted successfully')</script>";
        } else {
            echo "<script>alert('Something went wrong')</script>";
        }
    }
    ?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Add Post</title>
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet"
              href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic">
        <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    </head>

    <body>
        <!-- Header -->
        <?php include 'includes/header.php'; ?>

        <div class="container">
            <div class="row">
                <div class="col-md-10 col-lg-8 mx-auto">
                    <h2 class="post-title">Add a post</h2>
                    <form id="contactForm" name="sentMessage" novalidate="novalidate" method="post">
                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls"><label for="title">Title</label><input
                                    class="form-control" type="text" id="title" required="" placeholder="Title" name="title"><small
                                    class="form-text text-danger help-block"></small></div>
                        </div>

                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls"><label for="select1"><strong>Select
                                                                                                                    Category</strong></label>
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
                                </select><small class="form-text text-danger help-block"></small>
                            </div>
                        </div>

                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls"><label for="grabber">Grabber</label><input
                                    class="form-control" type="text" id="grabber" required="" placeholder="Grabber" name="grabber"><small
                                    class="form-text text-danger help-block"></small></div>
                        </div>

                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls mb-3"><label for="desc">Description</label><textarea
                                    class="form-control" id="desc"
                                    data-validation-required-message="Description" required=""
                                    placeholder="Description" rows="5" name="description"></textarea><small
                                    class="form-text text-danger help-block"></small></div>
                        </div>
                        <div id="success"></div>
                        <div class="form-group">
                            <button class="btn btn-primary" id="sendMessageButton" type="submit" name="submit">Post</button>
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
