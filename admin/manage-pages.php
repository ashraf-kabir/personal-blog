<?php
session_start();
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location: login.php');
} else {

    ?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Pages - Manage Pages</title>
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
                        <h3 class="text-dark mb-4">Pages</h3>
                        <div class="card shadow">
                            <div class="card-header py-3">
                                <p class="text-primary m-0 font-weight-bold">Pages</p>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive table mt-2" id="dataTable" role="grid"
                                     aria-describedby="dataTable_info">
                                    <table class="table dataTable my-0" id="dataTable">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Page Name</th>
                                            <th>Type</th>
                                            <th>Edit</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php $sql = "SELECT pages.id,pages.pagename,pages.type FROM pages";
                                        $query = $dbh->prepare($sql);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        $cnt = 1;
                                        if ($query->rowCount() > 0) {
                                            foreach ($results as $result) { ?>
                                                <tr>
                                                    <td><?php echo htmlentities($cnt); ?></td>
                                                    <td><?php echo htmlentities($result->pagename); ?></td>
                                                    <td><?php echo htmlentities($result->type); ?></td>
                                                    <td><a href="edit-page.php?id=<?php echo $result->id; ?>">edit</a>
                                                </tr>
                                                <?php $cnt = $cnt + 1;
                                            }
                                        } ?>

                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td><strong>#</strong></td>
                                            <td><strong>Page Name</strong></td>
                                            <td><strong>Type</strong></td>
                                            <td><strong>Edit</strong></td>
                                        </tr>
                                        </tfoot>
                                    </table>
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