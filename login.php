<?php
session_start();
include('config.php');

if (isset($_POST['submit'])) {
  $email = $_POST['email'];
  $patientPassword = $_POST['password'];

  if (
    isset($email, $patientPassword)
    && !empty($email) && !empty($patientPassword)
  ) {
    $email = filter_var(trim($email, FILTER_VALIDATE_EMAIL));

    $sql = "SELECT patient_id FROM patient WHERE patient_email = '$email' and patient_password = '$patientPassword'";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_array($result)) {
      $id = $row['patient_id'];
    }

    if (mysqli_affected_rows($conn) == 0) {
      echo "<script>alert('Your email or password is invalid. Please try again.');</script>";

    } else {
      $_SESSION['userSession'] = $email;
      $_SESSION['patient_id'] = $id;
      echo "<script>window.location.href='index.php';</script>";
    }
  }

  mysqli_close($conn);
}
?>