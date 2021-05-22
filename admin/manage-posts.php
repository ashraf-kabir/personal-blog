<?php
session_set_cookie_params(0);
session_start();
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location: login.php');
} else {
    if (isset($_REQUEST['del'])) {
        $delid = intval($_GET['del']);
        $sql = "DELETE FROM posts WHERE id=:delid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':delid', $delid, PDO::PARAM_STR);
        $query->execute();
        echo "<script>alert('Post deleted successfully');document.location = 'manage-posts.php';</script>";
    } elseif (isset($_REQUEST['uid'])) {
        $uid = intval($_GET['uid']);
        $sts3 = 2;
        $sql3 = "UPDATE posts SET status=:sts3 WHERE id=:uid";
        $query = $dbh->prepare($sql3);
        $query->bindParam(':uid', $uid, PDO::PARAM_STR);
        $query->bindParam(':sts3', $sts3, PDO::PARAM_STR);
        $query->execute();
        echo "<script>alert('Post Unpublished');document.location = 'manage-posts.php';</script>";
    } elseif (isset($_REQUEST['aid'])) {
        $aid = intval($_GET['aid']);
        $sts2 = 1;
        $sql2 = "UPDATE posts SET status=:sts2 WHERE id=:aid";
        $query = $dbh->prepare($sql2);
        $query->bindParam(':aid', $aid, PDO::PARAM_STR);
        $query->bindParam(':sts2', $sts2, PDO::PARAM_STR);
        $query->execute();
        echo "<script>alert('Post approved');document.location = 'manage-posts.php';</script>";
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Manage Posts</title>

        <!-- Custom fonts for this template-->
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
              rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="css/sb-admin-2.min.css" rel="stylesheet">

    </head>

    <body id="page-top">

        <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Sidebar -->
            <?php include "includes/sidebar.php"; ?>
            <!-- End of Sidebar -->

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- Topbar -->
                    <?php include "includes/header.php"; ?>
                    <!-- End of Topbar -->

                    <!-- Begin Page Content -->
                    <div class="container-fluid">
                        <h3 class="text-dark mb-4">Manage Posts</h3>
                        <div class="card shadow">
                            <div class="card-header py-3">
                                <p class="text-primary m-0 font-weight-bold">Posts</p>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 text-nowrap">
                                        <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable">
                                            <label>Show&nbsp;<select
                                                        class="form-control form-control-sm custom-select custom-select-sm">
                                                    <option value="5" selected="">5</option>
                                                    <option value="10">10</option>
                                                </select>&nbsp;</label></div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-md-right dataTables_filter" id="dataTable_filter"><label><input
                                                        type="search" class="form-control form-control-sm"
                                                        aria-controls="dataTable" placeholder="Search"></label></div>
                                    </div>
                                </div>
                                <div class="table-responsive table mt-2" id="dataTable" role="grid"
                                     aria-describedby="dataTable_info">
                                    <table class="table dataTable my-0" id="dataTable">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Category</th>
                                            <th>Edit</th>
                                            <th>Status</th>
                                            <th>Publish</th>
                                            <th>Unpublish</th>
                                            <th>Delete</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php
                                        $sts = 0;
                                        $sql = "SELECT posts.*,categories.catname FROM posts JOIN categories ON categories.id=posts.category";
                                        $query = $dbh->prepare($sql);
                                        $query->bindParam(':sts', $sts, PDO::PARAM_STR);
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
                                                    </td>
                                                    <?php
                                                    $sts4 = htmlentities($result->status);
                                                    if ($sts4 == 0) { ?>
                                                        <td>Pending</td>
                                                    <?php } elseif ($sts4 == 1) { ?>
                                                        <td>Published</td>
                                                    <?php } elseif ($sts4 == 2) { ?>
                                                        <td>Unpublished</td>
                                                    <?php } ?>
                                                    <td><a href="manage-posts.php?aid=<?php echo $result->id; ?>"
                                                           onclick="return confirm('Do you want to approve this post?');">Publish</a>
                                                    </td>
                                                    <td><a href="manage-posts.php?uid=<?php echo $result->id; ?>"
                                                           onclick="return confirm('Do you want to unpublish this post?');">Unpublish</a>
                                                    </td>
                                                    <td><a href="manage-posts.php?del=<?php echo $result->id; ?>"
                                                           onclick="return confirm('Do you want to delete?');">Delete</a>
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
                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <?php include "includes/footer.php"; ?>
                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="logout.php">Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>

    </body>

    </html>
<?php } ?>