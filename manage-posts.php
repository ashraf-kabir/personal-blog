<?php
session_set_cookie_params(0);
session_start();
include('includes/config.php');
if (strlen($_SESSION['login']) == 0) {
    header('location: login.php');
} else {
    if (isset($_REQUEST['del'])) {
        $delid = intval($_GET['del']);
        $sql = "DELETE FROM posts WHERE id=:delid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':delid', $delid, PDO::PARAM_STR);
        $query->execute();
        echo "<script>alert('Post has deleted successfully');document.location = 'manage-posts.php';</script>";
    }
    ?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Manage Posts</title>
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

                <div class="container-fluid">
                    <h3 class="text-dark mb-4">Posts</h3>
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 font-weight-bold">Posts</p>
                        </div>
                        <a href="add-post.php" class="btn btn-primary">Add a post</a>
                        <br>
                        <div class="card-body">
                            <div class="table-responsive table mt-2" id="dataTable" role="grid"
                                 aria-describedby="dataTable_info">
                                <table class="table dataTable my-0" id="dataTable">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                    //$sql = "SELECT posts.title,categories.catname,posts.id FROM posts JOIN categories ON categories.id=posts.category";

                                    $email1 = $_SESSION['login'];
                                    $sql1 = "SELECT `id` FROM `users` WHERE `email`=:email1";
                                    $query1 = $dbh->prepare($sql1);
                                    $query1->bindParam(':email1', $email1, PDO::PARAM_STR);
                                    $query1->execute();
                                    $results1 = $query1->fetchAll(PDO::FETCH_OBJ);
                                    if ($query1->rowCount() > 0) {
                                        foreach ($results1 as $result1) {
                                            $uid = $result1->id;
                                        }
                                    }

                                    $status = 1;
                                    $sql = "SELECT title,posts.id,catname FROM posts, categories WHERE categories.id=posts.category AND posts.userid=:uid AND posts.status=:status";
                                    $query = $dbh->prepare($sql);
                                    $query->bindParam(':uid', $uid, PDO::PARAM_STR);
                                    $query->bindParam(':status', $status, PDO::PARAM_STR);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt = 1;
                                    if ($query->rowCount() > 0) {
                                        foreach ($results as $result) { ?>
                                            <tr>
                                                <td><?php echo htmlentities($cnt); ?></td>
                                                <td><?php echo htmlentities($result->title); ?></td>
                                                <td><?php echo htmlentities($result->catname); ?></td>
                                                <td><a href="edit-post.php?id=<?php echo $result->id; ?>">edit</a>
                                                <td><a href="manage-posts.php?del=<?php echo $result->id; ?>"
                                                       onclick="return confirm('Do you want to delete?');">delete</a>
                                                </td>
                                            </tr>
                                            <?php $cnt = $cnt + 1;
                                        }
                                    } ?>

                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-6 align-self-center">
                                    <p id="dataTable_info" class="dataTables_info" role="status" aria-live="polite">
                                        Showing 1 to 5 of 100</p>
                                </div>
                                <div class="col-md-6">
                                    <nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
                                        <ul class="pagination">
                                            <li class="page-item disabled"><a class="page-link" href="#"
                                                                              aria-label="Previous"><span
                                                            aria-hidden="true">«</span></a></li>
                                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                            <li class="page-item"><a class="page-link" href="#"
                                                                     aria-label="Next"><span
                                                            aria-hidden="true">»</span></a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">

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