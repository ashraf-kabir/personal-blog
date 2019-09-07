<nav class="navbar navbar-light navbar-expand-lg fixed-top" id="mainNav">
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
                <li class="nav-item" role="presentation"><a class="nav-link" href="post.php">View Posts</a></li>
                <?php if (strlen($_SESSION['login']) == 0) {
                    ?>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="login.php">Log in</a></li>
                <?php } else {
                    $email = $_SESSION['login'];
                    $sql = "SELECT fname,lname FROM users WHERE email=:email ";
                    $query = $dbh->prepare($sql);
                    $query->bindParam(':email', $email, PDO::PARAM_STR);
                    $query->execute();
                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                    if ($query->rowCount() > 0) {
                        foreach ($results as $result2) {
                            ?>
                            <li class="nav-item" role="presentation"><a class="nav-link" href="profile.php"><?php echo htmlentities($result2->fname." ".$result2->lname); ?></a></li>
                        <?php }
                    }
                } ?>
                <?php if (strlen($_SESSION['login']) != 0) {
                ?>
                <li class="nav-item" role="presentation"><a class="nav-link" href="manage-posts.php">Manage Posts</a></li>
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