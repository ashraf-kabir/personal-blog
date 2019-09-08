<nav class="navbar fixed-top navbar-light navbar-expand-lg" id="mainNav">
    <div class="container">
        <a class="navbar-brand" href="index.php">Ashraf Kabir</a>
        <button data-toggle="collapse" data-target="#navbarResponsive" class="navbar-toggler"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><i
                    class="fa fa-bars"></i></button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="nav navbar-nav ml-auto">
                <li class="nav-item" role="presentation"><a class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item" role="presentation"><a class="nav-link" href="about.php">About us</a></li>
                <li class="nav-item" role="presentation"><a class="nav-link" href="contact.php">Contact us</a></li>
                <li class="nav-item" role="presentation"><a class="nav-link" href="view-posts.php">View Posts</a></li>
                <?php if (strlen($_SESSION['login']) != 0) {
                    ?>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="manage-posts.php">Manage Posts</a></li>
                <?php } else { }?>
                <?php if (strlen($_SESSION['login']) == 0) {
                    ?>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="login.php">Log in</a></li>
                <?php } else {
                    $email = $_SESSION['login'];
                    $sql = "SELECT fname,lname FROM users WHERE email=:email";
                    $query = $dbh->prepare($sql);
                    $query->bindParam(':email', $email, PDO::PARAM_STR);
                    $query->execute();
                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                    if ($query->rowCount() > 0) {
                        foreach ($results as $result2) {
                            ?>
                            <li class="nav-item dropdown" role="presentation">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo htmlentities($result2->fname." ".$result2->lname); ?></a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="profile.php">Update Profile</a>
                                    <a class="dropdown-item" href="update-password">Update Password</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </li>
                        <?php }
                    }
                } ?>
                <?php if (strlen($_SESSION['login']) == 0) {
                ?>
                <li class="nav-item" role="presentation"><a class="nav-link" href="register.php">Register</a></li>
                <?php } else { }?>
                <?php if (strlen($_SESSION['login']) == 0) {
                    ?>
                <?php } else { ?>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="logout.php">Log out</a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>
