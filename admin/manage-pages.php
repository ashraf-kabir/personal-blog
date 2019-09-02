<?php
session_start();
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location: login.php');
} else {
    if ($_POST['submit'] == "Update") {
        $pagetype = $_GET['type'];
        $description = $_POST['desc'];
        $sql = "UPDATE pages SET description=:description WHERE type=:pagetype";
        $query = $dbh->prepare($sql);
        $query->bindParam(':pagetype', $pagetype, PDO::PARAM_STR);
        $query->bindParam(':description', $description, PDO::PARAM_STR);
        $query->execute();
        $msg = "Page data has updated successfully";
    }
    ?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Posts - Manage Posts</title>
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet"
              href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
        <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">

        <script type="text/JavaScript">
            <!--
            function MM_findObj(n, d) { //v4.01
                var p, i, x;
                if (!d) d = document;
                if ((p = n.indexOf("?")) > 0 && parent.frames.length) {
                    d = parent.frames[n.substring(p + 1)].document;
                    n = n.substring(0, p);
                }
                if (!(x = d[n]) && d.all) x = d.all[n];
                for (i = 0; !x && i < d.forms.length; i++) x = d.forms[i][n];
                for (i = 0; !x && d.layers && i < d.layers.length; i++) x = MM_findObj(n, d.layers[i].document);
                if (!x && d.getElementById) x = d.getElementById(n);
                return x;
            }

            function MM_validateForm() { //v4.0
                var i, p, q, nm, test, num, min, max, errors = '', args = MM_validateForm.arguments;
                for (i = 0; i < (args.length - 2); i += 3) {
                    test = args[i + 2];
                    val = MM_findObj(args[i]);
                    if (val) {
                        nm = val.name;
                        if ((val = val.value) != "") {
                            if (test.indexOf('isEmail') != -1) {
                                p = val.indexOf('@');
                                if (p < 1 || p == (val.length - 1)) errors += '- ' + nm + ' must contain an e-mail address.\n';
                            } else if (test != 'R') {
                                num = parseFloat(val);
                                if (isNaN(val)) errors += '- ' + nm + ' must contain a number.\n';
                                if (test.indexOf('inRange') != -1) {
                                    p = test.indexOf(':');
                                    min = test.substring(8, p);
                                    max = test.substring(p + 1);
                                    if (num < min || max < num) errors += '- ' + nm + ' must contain a number between ' + min + ' and ' + max + '.\n';
                                }
                            }
                        } else if (test.charAt(0) == 'R') errors += '- ' + nm + ' is required.\n';
                    }
                }
                if (errors) alert('The following error(s) occurred:\n' + errors);
                document.MM_returnValue = (errors == '');
            }

            function MM_jumpMenu(targ, selObj, restore) { //v3.0
                eval(targ + ".location='" + selObj.options[selObj.selectedIndex].value + "'");
                if (restore) selObj.selectedIndex = 0;
            }

            //-->
        </script>

        <script type="text/javascript">
            bkLib.onDomLoaded(function () {
                nicEditors.allTextAreas()
            });
        </script>
        <style>
            .errorWrap {
                padding: 10px;
                margin: 0 0 20px 0;
                background: #fff;
                border-left: 4px solid #dd3d36;
                -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
                box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
            }

            .succWrap {
                padding: 10px;
                margin: 0 0 20px 0;
                background: #fff;
                border-left: 4px solid #5cb85c;
                -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
                box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
            }
        </style>

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

                                <div class="row">
                                    <div class="col">
                                        <div class="card shadow mb-3">
                                            <div class="card-header py-3">
                                                <p class="text-primary m-0 font-weight-bold">Edit post</p>
                                            </div>

                                            <div class="card-body">

                                                <form method="post" onSubmit="return valid();">

                                                    <div class="form-row">
                                                        <div class="col-md-8 col-lg-6 col-xl-6">
                                                            <div class="form-group">
                                                                <label for="select1"><strong>Select
                                                                                             Page</strong></label>
                                                                <select class="form-control" id="select1"
                                                                        name="select1"
                                                                        onChange="MM_jumpMenu('parent',this,0)">
                                                                    <option value="" selected="selected">--Select One--
                                                                    </option>
                                                                    <option value="manage-pages.php?type=aboutus"></option>
                                                                    <option value="manage-pages.php?type=contactus"></option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-row">
                                                        <div class="col-md-8 col-lg-6 col-xl-6">
                                                            <div class="form-group">
                                                                <label class="col-sm-4 control-label">Selected
                                                                                                      Page:</label>
                                                                <div class="col-sm-8">
                                                                    <?php
                                                                    switch ($_GET['type']) {
                                                                        case "aboutus" :
                                                                            echo "About Us";
                                                                            break;

                                                                        case "contactus" :
                                                                            echo "Contact Us";
                                                                            break;

                                                                        default :
                                                                            echo "";
                                                                            break;
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="form-row">
                                                            <div class="col-md-12 col-lg-12 col-xl-12">
                                                                <div class="form-group">
                                                                    <label for="textarea1"><strong>Page
                                                                                                   Description</strong></label>
                                                                    <textarea class="form-control" id="textarea1"
                                                                              rows="4" name="desc"
                                                                              style="height: 200px;"
                                                                              required>
                                                                        <?php
                                                                        $pagetype = $_GET['type'];
                                                                        $sql = "SELECT detail FROM pages WHERE type=:pagetype";
                                                                        $query = $dbh->prepare($sql);
                                                                        $query->bindParam(':pagetype', $pagetype, PDO::PARAM_STR);
                                                                        $query->execute();
                                                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                                        $cnt = 1;
                                                                        if ($query->rowCount() > 0) {
                                                                            foreach ($results as $result) {
                                                                                echo htmlentities($result->description);
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </textarea>
                                                                </div>

                                                                <div class="form-group">
                                                                    <button class="btn btn-primary" type="submit"
                                                                            name="submit" value="Update">Update
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