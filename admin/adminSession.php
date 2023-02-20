<?php
session_start();

if (!isset($_SESSION['doctorSession'])) {
  if (!isset($_SESSION['adminSession'])) {
    echo "<script>alert('Please login!'); window.location.href='index.php';</script>";

  } else {
    $adminID = $_SESSION['admin_id'];
    unset($_SESSION['doctorSession']);
  }

} else {
  $doctorID = $_SESSION['doctor_id'];
  unset($_SESSION['adminSession']);
}

?>