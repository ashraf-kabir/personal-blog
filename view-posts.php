<?php
session_set_cookie_params(0);
session_start();
include('includes/config.php');
error_reporting(0);
$_SESSION['redirectURL'] = $_SERVER['REQUEST_URI'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Blog Posts</title>
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
                        <h1>Kabir's Blog</h1><span class="subheading">An Informative Blog</span>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Header -->

    <article>
        <div class="container">
            <div class="row">
                <?php
                if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
                    $page_no = $_GET['page_no'];
                } else {
                    $page_no = 1;
                }

                $total_records_per_page = 3;
                $offset = ($page_no - 1) * $total_records_per_page;
                $previous_page = $page_no - 1;
                $next_page = $page_no + 1;
                $adjacents = "2";

                $sql1 = "SELECT * FROM `posts` WHERE posts.status=1";
                $stmt1 = $dbh->prepare($sql1);
                $stmt1->execute();
                $total_records = $stmt1->rowCount();

                $total_no_of_pages = ceil($total_records / $total_records_per_page);
                $second_last = $total_no_of_pages - 1;

                $s = 1;
                $sql = "SELECT posts.*,categories.catname FROM posts JOIN categories ON categories.id=posts.category WHERE posts.status=:s ORDER BY posts.id DESC LIMIT $offset, $total_records_per_page";
                $query = $dbh->prepare($sql);
                $query->bindParam(':s', $s, PDO::PARAM_STR);
                $query->execute();
                $results = $query->fetchAll(PDO::FETCH_OBJ);
                $cnt = 1;
                if ($query->rowCount() > 0) {
                    foreach ($results as $result) {
                        ?>
                        <div class="col-md-10 col-lg-12">
                            <div class="post-preview">
                                <a href="post-details.php?id=<?php echo htmlentities($result->id); ?>">
                                    <h2 class="post-title"><?php echo htmlentities($result->title); ?>,
                                        <i><?php echo htmlentities($result->catname); ?></i></h2>
                                    <h3 class="post-subtitle"><?php echo htmlentities($result->grabber); ?></h3>
                                </a>
                                <p class="post-meta">Posted by&nbsp;<?php echo htmlentities($result->username); ?>
                                                     on <?php echo htmlentities($result->creationdate); ?>
                                </p>
                            </div>
                            <hr>
                        </div>
                    <?php }
                } ?>

                <div style='padding: 10px 20px 0;'>
                    <strong>Page <?php echo $page_no . " of " . $total_no_of_pages; ?></strong>
                </div>

            </div>

            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li <?php if ($page_no <= 1) {
                        echo "class='page-item disabled'";
                    } ?>>
                        <a class="page-link" <?php if ($page_no > 1) {
                            echo "href='?page_no=$previous_page'";
                        } ?>>Previous</a>
                    </li>

                    <?php
                    if ($total_no_of_pages <= 10) {
                        for ($counter = 1; $counter <= $total_no_of_pages; $counter++) {
                            if ($counter == $page_no) {
                                echo "<li class='page-item active'><a class='page-link'>$counter</a></li>";
                            } else {
                                echo "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
                            }
                        }
                    } elseif ($total_no_of_pages > 10) {
                        if ($page_no <= 4) {
                            for ($counter = 1; $counter < 8; $counter++) {
                                if ($counter == $page_no) {
                                    echo "<li class='page-item active'><a>$counter</a></li>";
                                } else {
                                    echo "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
                                }
                            }
                            echo "<li class='page-item'><a>...</a></li>";
                            echo "<li class='page-item'><a class='page-link' href='?page_no=$second_last'>$second_last</a></li>";
                            echo "<li class='page-item'><a class='page-link' href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
                        } elseif ($page_no > 4 && $page_no < $total_no_of_pages - 4) {
                            echo "<li class='page-item'><a class='page-link' href='?page_no=1'>1</a></li>";
                            echo "<li class='page-item'><a class='page-link' href='?page_no=2'>2</a></li>";
                            echo "<li class='page-item'><a>...</a></li>";
                            for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {
                                if ($counter == $page_no) {
                                    echo "<li class='page-item active'><a class='page-link'>$counter</a></li>";
                                } else {
                                    echo "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
                                }
                            }
                            echo "<li class='page-item'><a>...</a></li>";
                            echo "<li class='page-item'><a href='?page_no=$second_last'>$second_last</a></li>";
                            echo "<li class='page-item'><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
                        } else {
                            echo "<li class='page-item'><a class='page-link' href='?page_no=1'>1</a></li>";
                            echo "<li class='page-item'><a class='page-link' href='?page_no=2'>2</a></li>";
                            echo "<li class='page-item'><a>...</a></li>";
                            for ($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++) {
                                if ($counter == $page_no) {
                                    echo "<li class='page-item active'><a class='page-link'>$counter</a></li>";
                                } else {
                                    echo "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
                                }
                            }
                        }
                    }
                    ?>

                    <li <?php if ($page_no >= $total_no_of_pages) {
                        echo "class='page-item disabled'";
                    } ?>>
                        <a class="page-link" <?php if ($page_no < $total_no_of_pages) {
                            echo "href='?page_no=$next_page'";
                        } ?>>Next</a>
                    </li>
                    <?php if ($page_no < $total_no_of_pages) {
                        echo "<li class='page-item'><a class='page-link' href='?page_no=$total_no_of_pages'>Last &rsaquo;&rsaquo;</a></li>";
                    } ?>
                </ul>
            </nav>
        </div>
    </article>

    <!-- Footer -->
    <?php include 'includes/footer.php'; ?>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/clean-blog.js"></script>
</body>

</html>