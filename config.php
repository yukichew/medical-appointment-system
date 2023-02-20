<?php

$localhost = 'localhost';
$user = 'root';
$password = '';
$db = 'medical';

$conn = mysqli_connect($localhost, $user, $password, $db);

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

?>