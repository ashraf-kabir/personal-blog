<?php
session_start();
include('includes/config.php');
error_reporting(0);
$_SESSION['redirectURL'] = $_SERVER['REQUEST_URI'];

if (empty($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}

if (isset($_POST['submit'])) {
    //Verifying CSRF Token
    if (!empty($_POST['csrftoken'])) {
        if (hash_equals($_SESSION['token'], $_POST['csrftoken'])) {
            $email = $_SESSION['login'];

            $email = $_POST['email'];

            $comment = $_POST['comment'];
            $postid = intval($_GET['id']);
            $st1 = '0';
            //$sql = mysqli_query($con, "insert into comments(postid,name,email,comment,status) values('$postid','$name','$email','$comment','$st1')");
            $sql = "INSERT INTO comments(postid,name,email,comment,status) VALUES(:postid,:name,:email,:comment,:st1)";
            $query = $dbh->prepare($sql);
            $query->bindParam(':postid', $postid, PDO::PARAM_STR);
            $query->bindParam(':email', $email, PDO::PARAM_STR);
            $query->bindParam(':comment', $comment, PDO::PARAM_STR);
            $query->execute();
            $lastInsertId = $dbh->lastInsertId();
            if ($lastInsertId) {
                echo "<script>alert('Comment posted successfully')</script>";
                unset($_SESSION['token']);
            } else {
                echo "<script>alert('Something went wrong')</script>";
            }

            //endif;
        }
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Blog Post</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
</head>

<body>
    <!-- Header -->
    <?php include 'includes/header.php'; ?>

    <?php
    $id = intval($_GET['id']);
    $sql = "SELECT posts.*,categories.catname,categories.id AS cid FROM posts JOIN categories ON categories.id=posts.category where posts.id=:id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    $cnt = 1;
    if ($query->rowCount() > 0) {
        foreach ($results

                 as $result) {
            //$_SESSION['brndid'] = $result->bid;
            ?>
            <article>
                <div class="container">
                    <div class="row">
                        <div class="col-md-10 col-lg-8 mx-auto">
                            <div class="post-preview">
                                <h2 class="post-title"><?php echo htmlentities($result->title); ?></h2>
                                <p class="post-meta">Category: <a
                                            href="#"><?php echo htmlentities($result->catname); ?></a>
                                </p>
                                <p><?php echo htmlentities($result->description); ?></p>
                                <p class="post-meta">Posted by&nbsp;<a href="#">Admin
                                                                                on <?php echo htmlentities($result->creationdate); ?></a>
                                </p>
                            </div>
                        </div>


                        <div class="col-md-10 col-lg-8 mx-auto">
                            <div class="card my-4">
                                <h5 class="card-header">Leave a Comment:</h5>
                                <div class="card-body">
                                    <form name="Comment" method="post">
                                        <input type="hidden" name="csrftoken"
                                               value="<?php echo htmlentities($_SESSION['token']); ?>"/>
                                        <div class="form-group">
                                            <?php if ($_SESSION['login']) {
                                                $email = $_SESSION['login'];
                                                $sql = "SELECT fname,lname FROM users WHERE email=:email ";
                                                $query = $dbh->prepare($sql);
                                                $query->bindParam(':email', $email, PDO::PARAM_STR);
                                                $query->execute();
                                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                if ($query->rowCount() > 0) {
                                                    foreach ($results as $result2) {
                                                        $name = $result2->fname." ".$result2->lname;
                                                        ?>
                                                        <input type="text" name="name"
                                                               value="<?php echo htmlentities($name);?>"
                                                               class="form-control" placeholder="Enter your fullname"
                                                               required>
                                                    <?php }
                                                }
                                            } else { ?>
                                                <input type="text" name="name"
                                                       value=""
                                                       class="form-control" placeholder="Enter your fullname"
                                                       required>
                                            <?php } ?>
                                        </div>

                                        <div class="form-group">
                                            <?php if ($_SESSION['login']) {
                                                ?>
                                                <input type="email" name="email"
                                                       value="<?php echo $_SESSION['login']; ?>"
                                                       class="form-control"
                                                       placeholder="Enter your Valid email" required>
                                            <?php } else { ?>
                                                <input type="email" name="email"
                                                       value=""
                                                       class="form-control"
                                                       placeholder="Enter your Valid email" required>
                                            <?php } ?>
                                        </div>


                                        <div class="form-group">
                                            <textarea class="form-control" name="comment" rows="3" placeholder="Comment"
                                                      required></textarea>
                                        </div>
                                        <?php if ($_SESSION['login']) {
                                            ?>
                                            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                                        <?php } else { ?>
                                            <button type="submit" class="btn btn-primary" name="submit"><a
                                                        href="login.php">Log in &
                                                                         Comment</a>
                                            </button>
                                        <?php } ?>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
            </article>

        <?php }
    } ?>

    <!-- Footer -->
    <?php include 'includes/footer.php'; ?>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/clean-blog.js"></script>
</body>

</html>