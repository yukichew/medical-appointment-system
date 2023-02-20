<?php
session_start();
if (!isset($_SESSION['userSession']))
{
  echo "<script>alert('Please login!'); window.location.href='index.php';</script>";
}
else{
  $userID = $_SESSION['patient_id'];
}
?>