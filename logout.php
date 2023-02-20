<?php
session_start();

unset($_SESSION['userSession']);

session_destroy();

header("location: index.php");

exit();

?>