<?php
session_start();

unset($_SESSION['adminSession']);

session_destroy();

header("location: index.php");

exit();

if (isset($_SESSION['adminSession'])) {
    unset($_SESSION['adminSession']);
    session_destroy();
    header("location: index.php");
    exit();
}

if (isset($_SESSION['doctorSession'])) {
    unset($_SESSION['doctorSession']);
    session_destroy();
    header("location: doctorLogin.php");
    exit();
}

?>