<?php
session_start();
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location: login.php');
} else {
    if (isset($_POST['submit'])) {
        $title = $_POST['title'];
        $brand = $_POST['brandname'];
        $vehicleoverview = $_POST['vehicalorcview'];
        $priceperday = $_POST['priceperday'];
        $fueltype = $_POST['fueltype'];
        $modelyear = $_POST['modelyear'];
        $seatingcapacity = $_POST['seatingcapacity'];
        $vimage1 = $_FILES["img1"]["name"];
        $vimage2 = $_FILES["img2"]["name"];
        $vimage3 = $_FILES["img3"]["name"];
        $vimage4 = $_FILES["img4"]["name"];
        $vimage5 = $_FILES["img5"]["name"];
        $airconditioner = $_POST['airconditioner'];
        $powerdoorlocks = $_POST['powerdoorlocks'];
        $antilockbrakingsys = $_POST['antilockbrakingsys'];
        $brakeassist = $_POST['brakeassist'];
        $powersteering = $_POST['powersteering'];
        $driverairbag = $_POST['driverairbag'];
        $passengerairbag = $_POST['passengerairbag'];
        $powerwindow = $_POST['powerwindow'];
        $cdplayer = $_POST['cdplayer'];
        $centrallocking = $_POST['centrallocking'];
        $crashcensor = $_POST['crashcensor'];
        $leatherseats = $_POST['leatherseats'];

        move_uploaded_file($_FILES["img1"]["tmp_name"], "img/vehicleimages/" . $_FILES["img1"]["name"]);
        move_uploaded_file($_FILES["img2"]["tmp_name"], "img/vehicleimages/" . $_FILES["img2"]["name"]);
        move_uploaded_file($_FILES["img3"]["tmp_name"], "img/vehicleimages/" . $_FILES["img3"]["name"]);
        move_uploaded_file($_FILES["img4"]["tmp_name"], "img/vehicleimages/" . $_FILES["img4"]["name"]);
        move_uploaded_file($_FILES["img5"]["tmp_name"], "img/vehicleimages/" . $_FILES["img5"]["name"]);

        $sql = "INSERT INTO tblvehicles(VehiclesTitle,VehiclesBrand,VehiclesOverview,PricePerDay,FuelType,ModelYear,SeatingCapacity,Vimage1,Vimage2,Vimage3,Vimage4,Vimage5,AirConditioner,PowerDoorLocks,AntiLockBrakingSystem,BrakeAssist,PowerSteering,DriverAirbag,PassengerAirbag,PowerWindows,CDPlayer,CentralLocking,CrashSensor,LeatherSeats) VALUES(:vehicletitle,:brand,:vehicleoverview,:priceperday,:fueltype,:modelyear,:seatingcapacity,:vimage1,:vimage2,:vimage3,:vimage4,:vimage5,:airconditioner,:powerdoorlocks,:antilockbrakingsys,:brakeassist,:powersteering,:driverairbag,:passengerairbag,:powerwindow,:cdplayer,:centrallocking,:crashcensor,:leatherseats)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':vehicletitle', $vehicletitle, PDO::PARAM_STR);
        $query->bindParam(':brand', $brand, PDO::PARAM_STR);
        $query->bindParam(':vehicleoverview', $vehicleoverview, PDO::PARAM_STR);
        $query->bindParam(':priceperday', $priceperday, PDO::PARAM_STR);
        $query->bindParam(':fueltype', $fueltype, PDO::PARAM_STR);
        $query->bindParam(':modelyear', $modelyear, PDO::PARAM_STR);
        $query->bindParam(':seatingcapacity', $seatingcapacity, PDO::PARAM_STR);
        $query->bindParam(':vimage1', $vimage1, PDO::PARAM_STR);
        $query->bindParam(':vimage2', $vimage2, PDO::PARAM_STR);
        $query->bindParam(':vimage3', $vimage3, PDO::PARAM_STR);
        $query->bindParam(':vimage4', $vimage4, PDO::PARAM_STR);
        $query->bindParam(':vimage5', $vimage5, PDO::PARAM_STR);
        $query->bindParam(':airconditioner', $airconditioner, PDO::PARAM_STR);
        $query->bindParam(':powerdoorlocks', $powerdoorlocks, PDO::PARAM_STR);
        $query->bindParam(':antilockbrakingsys', $antilockbrakingsys, PDO::PARAM_STR);
        $query->bindParam(':brakeassist', $brakeassist, PDO::PARAM_STR);
        $query->bindParam(':powersteering', $powersteering, PDO::PARAM_STR);
        $query->bindParam(':driverairbag', $driverairbag, PDO::PARAM_STR);
        $query->bindParam(':passengerairbag', $passengerairbag, PDO::PARAM_STR);
        $query->bindParam(':powerwindow', $powerwindow, PDO::PARAM_STR);
        $query->bindParam(':cdplayer', $cdplayer, PDO::PARAM_STR);
        $query->bindParam(':centrallocking', $centrallocking, PDO::PARAM_STR);
        $query->bindParam(':crashcensor', $crashcensor, PDO::PARAM_STR);
        $query->bindParam(':leatherseats', $leatherseats, PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        if ($lastInsertId) {
            $msg = "Vehicle posted successfully";
        } else {
            $error = "Something went wrong. Please try again";
        }
    }
    ?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Profile - Admin</title>
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
                        <h3 class="text-dark mb-4">Add a Post</h3>
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
                                                <p class="text-primary m-0 font-weight-bold">Add a post</p>
                                            </div>
                                            <div class="card-body">
                                                <form method="post" enctype="multipart/form-data">
                                                    <div class="form-row">
                                                        <div class="col">
                                                            <div class="form-group"><label
                                                                        for="title"><strong>Title</strong></label><input
                                                                        class="form-control" type="text"
                                                                        placeholder="Enter Title" name="title">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="selectcat"><strong>Select Category</strong></label>
                                                                <div class="">
                                                                    <select class="form-control" name="selectcat" required>
                                                                        <option value="">Select</option>
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
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-row">
                                                        <div class="col">
                                                            <div class="form-group" style="width: 564px;"><label
                                                                        for="signature"><strong>Description</strong><br></label><textarea
                                                                        class="form-control form-control-lg" rows="4"
                                                                        name="signature"
                                                                        style="height: 300px;"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <button class="btn btn-primary btn-sm" type="submit" name="submit">
                                                                    Post
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>
                                        <div class="card shadow"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="card shadow mb-4">
                                    <div class="card-body text-center shadow"><img class="rounded-circle mb-3 mt-4"
                                                                                   src="assets/img/sample/image2.jpeg"
                                                                                   width="160" height="160">
                                        <div class="mb-3">
                                            <button class="btn btn-primary btn-sm" type="button">Change Photo</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-3">
                                    <div class="card-header py-3">
                                        <h6 class="text-primary font-weight-bold m-0">Projects</h6>
                                    </div>
                                    <div class="card-body">
                                        <h4 class="small font-weight-bold">Server migration<span
                                                    class="float-right">20%</span></h4>
                                        <div class="progress progress-sm mb-3">
                                            <div class="progress-bar bg-danger" aria-valuenow="20" aria-valuemin="0"
                                                 aria-valuemax="100" style="width: 20%;"><span
                                                        class="sr-only">20%</span></div>
                                        </div>
                                        <h4 class="small font-weight-bold">Sales tracking<span
                                                    class="float-right">40%</span></h4>
                                        <div class="progress progress-sm mb-3">
                                            <div class="progress-bar bg-warning" aria-valuenow="40" aria-valuemin="0"
                                                 aria-valuemax="100" style="width: 40%;"><span
                                                        class="sr-only">40%</span></div>
                                        </div>
                                        <h4 class="small font-weight-bold">Customer Database<span class="float-right">60%</span>
                                        </h4>
                                        <div class="progress progress-sm mb-3">
                                            <div class="progress-bar bg-primary" aria-valuenow="60" aria-valuemin="0"
                                                 aria-valuemax="100" style="width: 60%;"><span
                                                        class="sr-only">60%</span></div>
                                        </div>
                                        <h4 class="small font-weight-bold">Payout Details<span
                                                    class="float-right">80%</span></h4>
                                        <div class="progress progress-sm mb-3">
                                            <div class="progress-bar bg-info" aria-valuenow="80" aria-valuemin="0"
                                                 aria-valuemax="100" style="width: 80%;"><span
                                                        class="sr-only">80%</span></div>
                                        </div>
                                        <h4 class="small font-weight-bold">Account setup<span class="float-right">Complete!</span>
                                        </h4>
                                        <div class="progress progress-sm mb-3">
                                            <div class="progress-bar bg-success" aria-valuenow="100" aria-valuemin="0"
                                                 aria-valuemax="100" style="width: 100%;"><span
                                                        class="sr-only">100%</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card shadow mb-5"></div>
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