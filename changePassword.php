<?php
include("session.php");
include('config.php');

$patient_id = $_SESSION['patient_id'];

if (isset($_POST['submit'])) {
    $currentPassword = $_POST['currentPassword'];
    $patient_password = $_POST['patient_password'];

    if (
        isset($currentPassword, $patient_password)
        && !empty($currentPassword) && !empty($patient_password)
    ) {
        $sql = "SELECT patient_id FROM patient WHERE patient_id = '$patient_id' and patient_password = '$currentPassword'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_affected_rows($conn) == 0) {
            echo "<script>alert('Your current password is wrong. Please try again.');</script>";

        } else {

            $sql = "UPDATE patient SET patient_password = '$patient_password' WHERE patient_id = " . $patient_id;

            if (mysqli_query($conn, $sql)) {
                if (!mysqli_query($conn, $sql)) {
                    die('Error: ' . mysqli_error($conn));

                } else {
                    echo '<script>alert("Patient details have been updated successfully."); </script>';
                }
            }
        }
    }
}

$selectOrder_sql = 'SELECT * from patient WHERE patient_id = ' . $patient_id;
$rs = mysqli_query($conn, $selectOrder_sql);
$row = mysqli_fetch_assoc($rs);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title> Medical Appointment System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>

<body class="d-flex flex-column h-100">
    <main class="flex-shrink-0">
        <?php include('navbar.php'); ?>

        <section class="py-5" id="editProfile">

            <h5 class='text-center pb-3'>Change Password</h5>
            <div class="row">
                <div class="card mx-auto" style="width: 1000px;">
                    <div class="card-body pt-3" id="editPatient">
                        <form method="POST">
                            <div class="form-group row mb-2">
                                <label for="currentPassword" class="col-sm-2 col-form-label">Current Password</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="password" name="currentPassword" required>
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label for="patient_password" class="col-sm-2 col-form-label">New Password</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="password" name="patient_password" required>
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary" name='submit'>Save Changes</button>
                                <button type="button" class="btn btn-primary"
                                    onclick="window.location.href = 'index.php'; return false;">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</body>

</html>