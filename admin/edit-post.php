<?php
session_start();
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location: login.php');
} else {
    if (isset($_POST['submit'])) {
        $title = $_POST['title'];
        $cat = $_POST['selectcat'];
        $description = $_POST['desc'];
        $id = intval($_GET['id']);

        $sql = "UPDATE `posts` SET title=:title,category=:cat,description=:description WHERE id=:id ";
        $query = $dbh->prepare($sql);
        $query->bindParam(':title', $title, PDO::PARAM_STR);
        $query->bindParam(':cat', $cat, PDO::PARAM_STR);
        $query->bindParam(':description', $description, PDO::PARAM_STR);
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->execute();

        echo "<script>alert('Data has updated successfully');</script>";
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
              href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
        <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    </head>

    <body id="page-top">
        <div id="wrapper">

            <!-- sidebar -->
            <?php include 'includes/sidebar.php'; ?>

            <div class="d-flex flex-column" id="content-wrapper">
                <div id="content">

                    <!-- header -->
                    <?php include 'includes/header.php'; ?>

                    <div class="container-fluid">
                        <h3 class="text-dark mb-4">Edit Post</h3>
                        <div class="row mb-3">
                            <div class="col-lg-8">
                                <div class="row mb-3 d-none">
                                    <div class="col">
                                        <div class="card text-white bg-primary shadow">
                                            <div class="card-body">
                                                <div class="row mb-2">
                                                    <div class="col">
                                                        <p class="m-0">Performance</p>
                                                        <p class="m-0"><strong>65.2%</strong></p>
                                                    </div>
                                                    <div class="col-auto"><i class="fas fa-rocket fa-2x"></i></div>
                                                </div>
                                                <p class="text-white-50 small m-0"><i class="fas fa-arrow-up"></i>&nbsp;5%
                                                                                                                  since
                                                                                                                  last
                                                                                                                  month
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="card text-white bg-success shadow">
                                            <div class="card-body">
                                                <div class="row mb-2">
                                                    <div class="col">
                                                        <p class="m-0">Performance</p>
                                                        <p class="m-0"><strong>65.2%</strong></p>
                                                    </div>
                                                    <div class="col-auto"><i class="fas fa-rocket fa-2x"></i></div>
                                                </div>
                                                <p class="text-white-50 small m-0"><i class="fas fa-arrow-up"></i>&nbsp;5%
                                                                                                                  since
                                                                                                                  last
                                                                                                                  month
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="card shadow mb-3">
                                            <div class="card-header py-3">
                                                <p class="text-primary m-0 font-weight-bold">Edit post</p>
                                            </div>

                                            <div class="card-body">
                                                <?php
                                                $id = intval($_GET['id']);
                                                $sql = "SELECT posts.*,categories.catname,categories.id as cid from posts join categories on categories.id=posts.category where posts.id=:id";
                                                $query = $dbh->prepare($sql);
                                                $query->bindParam(':id', $id, PDO::PARAM_STR);
                                                $query->execute();
                                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                $cnt = 1;
                                                if ($query->rowCount() > 0) {
                                                foreach ($results

                                                as $result) { ?>
                                                <form method="post">

                                                    <div class="form-row">
                                                        <div class="col-md-8 col-lg-6 col-xl-6">
                                                            <div class="form-group">
                                                                <label for="title1"><strong>Title</strong></label>
                                                                <input class="form-control" id="title1" type="text"
                                                                       placeholder="Enter title" name="title"
                                                                       value="<?php echo htmlentities($result->title); ?>"
                                                                       required>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-row">
                                                        <div class="col-md-8 col-lg-6 col-xl-6">
                                                            <div class="form-group">
                                                                <label for="select1"><strong>Select
                                                                                             Category</strong></label>
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
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-row">
                                                        <div class="col-md-8 col-lg-6 col-xl-6">
                                                            <div class="form-group">
                                                                <label for="insertimage1"><strong>Insert an
                                                                                                  image</strong></label>
                                                                <input type="file" class="form-control-file"
                                                                       id="insertimage1" disabled>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="form-row">
                                                            <div class="col-md-12 col-lg-12 col-xl-12">
                                                                <div class="form-group">
                                                                    <label for="textarea1"><strong>Description</strong></label>
                                                                    <textarea class="form-control" id="textarea1"
                                                                              rows="4" name="desc"
                                                                              style="height: 200px;"
                                                                              required><?php echo htmlentities($result->description); ?></textarea>
                                                                </div>

                                                                <?php }
                                                                } ?>

                                                                <div class="form-group">
                                                                    <button class="btn btn-primary" type="submit"
                                                                            name="submit">Update
                                                                    </button>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <?php include 'includes/footer.php'; ?>

            </div>
            <a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a></div>
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/chart.min.js"></script>
        <script src="assets/js/bs-charts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
        <script src="assets/js/theme.js"></script>
    </body>

    </html>
<?php } ?>