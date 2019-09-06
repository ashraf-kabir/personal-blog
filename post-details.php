<?php
session_start();
include('includes/config.php');
error_reporting(0);
$_SESSION['redirectURL'] = $_SERVER['REQUEST_URI'];

if (isset($_POST['submit'])) {
    $name2 = $_POST['name'];
    $email = $_POST['email'];
    $comment = $_POST['comment'];
    $postid = intval($_GET['id']);
    $st1 = '0';
    $sql = "INSERT INTO comments(postid,name,email,comment,status) VALUES(:postid,:name2,:email,:comment,:st1)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':postid', $postid, PDO::PARAM_STR);
    $query->bindParam(':name2', $name2, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':comment', $comment, PDO::PARAM_STR);
    $query->bindParam(':st1', $st1, PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $dbh->lastInsertId();
    if ($lastInsertId) {
        echo "<script>alert('Comment posted successfully')</script>";
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


    <article>
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-lg-8 mx-auto">
                    <?php
                    $id = intval($_GET['id']);
                    $sql1 = "SELECT posts.*,categories.catname,categories.id AS cid FROM posts JOIN categories ON categories.id=posts.category WHERE posts.id=:id";
                    $query = $dbh->prepare($sql1);
                    $query->bindParam(':id', $id, PDO::PARAM_STR);
                    $query->execute();
                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                    $cnt = 1;
                    if ($query->rowCount() > 0) {
                        foreach ($results

                                 as $result) {
                            //$_SESSION['brndid'] = $result->bid;
                            ?>
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
                        <?php }
                    } ?>
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
                                        $sql2 = "SELECT fname,lname FROM users WHERE email=:email ";
                                        $query = $dbh->prepare($sql2);
                                        $query->bindParam(':email', $email, PDO::PARAM_STR);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        if ($query->rowCount() > 0) {
                                            foreach ($results as $result2) {
                                                $name = $result2->fname . " " . $result2->lname;
                                                ?>
                                                <input type="text" name="name"
                                                       value="<?php echo htmlentities($name); ?>"
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
                                    <a href="login.php" class="btn btn-primary">Log in & Comment</a>
                                <?php } ?>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-10 col-lg-8 mx-auto">
                    <br>
                </div>

                <!--Display Comments-->
                <div class="col-md-10 col-lg-8 mx-auto">
                    <div class="card my-4">
                        <h5 class="card-header">Comments</h5>
                        <div class="card-body">
                            <?php
                            //$sts = 1;
                            //$pid = intval($_GET['id']);;
                            $sql3 = "SELECT `name`,`comment`,`postingdate` FROM comments WHERE postid=1 AND status=1";
                            $query->bindParam(':id', $id, PDO::PARAM_STR);
                            $query = $dbh->prepare($sql3);
                            $query->execute();
                            $results3 = $query->fetchAll(PDO::FETCH_OBJ);
                            $cnt = 1;
                            if ($query->rowCount() > 0) {
                                foreach ($results3 as $result3) {
                                    ?>
                                    <div class="media-body">
                                        <h6><?php echo htmlentities($result3->name); ?> <br/>
                                            <span style="font-size:11px;"><b>commented at</b> <?php echo htmlentities($result3->postingdate); ?></span>
                                        </h6>
                                        <div style="font-size: 18px;">
                                            Comment: <?php echo htmlentities($result3->comment); ?></div>
                                    </div>
                                    <?php $cnt++;
                                }
                            } ?>
                        </div>
                    </div>
                </div>


            </div>
    </article>


    <!-- Footer -->
    <?php include 'includes/footer.php'; ?>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/clean-blog.js"></script>
</body>

</html>