<?php
session_start();
unset($_SESSION['login']);
session_destroy();
$currentpage = $_SESSION['redirectURL'];
header("location: $currentpage");
?>