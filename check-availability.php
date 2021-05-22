<?php
require_once("includes/config.php");
if (!empty($_POST["email"])) {
    $email = $_POST["email"];
    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        echo "Error: You didn't enter a valid email";
    } else {
        $sql = "SELECT `email` FROM `users` WHERE `email`=:email";
        $query = $dbh->prepare($sql);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);
        $cnt = 1;
        if ($query->rowCount() > 0) {
            echo "<span style='color:red'>Email already EXISTS</span>";
            echo "<script>$('#submit').prop('disabled',true);</script>";
        } else {
            echo "<span></span>";
            echo "<script>$('#submit').prop('disabled',false);</script>";
        }
    }
}

?>
