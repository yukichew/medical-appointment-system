<?php
include('config.php');

if (isset($_POST['submit'])) {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $contact = $_POST['phone'];
    $patientPassword = $_POST['password'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];

    if (
        isset($fullname, $email, $contact, $patientPassword, $dob, $gender)
        && !empty($fullname) && !empty($email) && !empty($contact) && !empty($patientPassword)
        && !empty($dob) && !empty($gender)
    ) {
        $fullname = filter_var(trim($fullname, FILTER_SANITIZE_STRING));
        $email = filter_var(trim($email, FILTER_VALIDATE_EMAIL));

        $checkPatientsql = "SELECT patient_id FROM patient WHERE patient_email = '$email'";
        $result = mysqli_query($conn, $checkPatientsql);

        if (mysqli_affected_rows($conn) == 1) {
            echo '<script>alert("It looks like there\'s already an account with"' . $email . '. If it\'s you, go back and sign in.");</script>';

        } else {
            $lastID = mysqli_insert_id($conn);
            $sql = "INSERT INTO patient(patient_fullname, patient_email, patient_contact, patient_password, patient_dob, patient_gender) VALUES ('$fullname', '$email', '$contact', '$patientPassword', '$dob', '$gender')";

            if (!mysqli_query($conn, $sql)) {
                die('Error: ' . mysqli_error($conn));
            } else {
                echo '<script>alert("Register Successful! You can login to our system now! "); window.location.href = "index.php"; </script>';
            }
        }
    }
    mysqli_close($conn);
}
?>