<?php
session_start();
include('../config.php');

if (isset($_POST['submit'])) {
    $doctor_email = $_POST['doctor_email'];
    $doctor_name = $_POST['doctor_name'];
    $doctor_contact = $_POST['doctor_contact'];
    $doctor_qualification = $_POST['doctor_qualification'];
    $doctor_specialist = $_POST['doctor_specialist'];
    $doctor_status = $_POST['doctor_status'];
    $doctor_dob = $_POST['doctor_dob'];
    $doctor_password = $_POST['doctor_password'];

    if (
        isset($doctor_email, $doctor_name, $doctor_contact, $doctor_qualification, $doctor_specialist, $doctor_status, $doctor_dob)
        && !empty($doctor_email) && !empty($doctor_name) && !empty($doctor_qualification) && !empty($doctor_specialist) && !empty($doctor_status) && !empty($doctor_dob)

    ) {
        $doctor_name = filter_var(trim($doctor_name, FILTER_SANITIZE_STRING));
        $doctor_qualification = filter_var(trim($doctor_qualification, FILTER_SANITIZE_STRING));
        $doctor_specialist = filter_var(trim($doctor_specialist, FILTER_SANITIZE_STRING));
        $doctor_email = filter_var(trim($doctor_email, FILTER_VALIDATE_EMAIL));

        $sql = "SELECT doctor_id FROM doctor WHERE doctor_email = '$doctor_email'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_affected_rows($conn) == 1) {
            echo '<script>alert("It looks like there\'s already an account with"' . $doctor_email . '. If it\'s you, go back and sign in.");</script>';

        } else {
            $lastID = mysqli_insert_id($conn);
            $sql = "INSERT INTO doctor(doctor_email, doctor_name, doctor_contact, doctor_qualification, doctor_specialist, doctor_status, doctor_dob, doctor_password) VALUES ('$doctor_email', '$doctor_name', '$doctor_contact', '$doctor_qualification', '$doctor_specialist', '$doctor_status', '$doctor_dob', '$doctor_password')";

            if (!mysqli_query($conn, $sql)) {
                die('Error: ' . mysqli_error($conn));
            } else {
                echo '<script>alert("Register Successful!"); window.location.href = "doctorLogin.php"; </script>';
            }
        }
    }
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Admin Login</title>

    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>
    <main>
        <div class="container">
            <section
                class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Doctor Register</h5>
                                    </div>

                                    <form class="row g-3 needs-validation" method="POST">

                                        <div class="col-12">
                                            <label for="doctor_email" class="form-label">Email</label>
                                            <div class="input-group has-validation">
                                                <input type="email" name="doctor_email" class="form-control"
                                                    id="doctor_email" required>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="doctor_name" class="form-label">Name</label>
                                            <div class="input-group has-validation">
                                                <input type="text" name="doctor_name" class="form-control"
                                                    id="doctor_name" required>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="doctor_password" class="form-label">Password</label>
                                            <input type="password" name="doctor_password" class="form-control"
                                                id="doctor_password" required>

                                        </div>

                                        <div class="col-12">
                                            <label for="doctor_contact" class="form-label">Contact</label>
                                            <div class="input-group has-validation">
                                                <input type="tel" name="doctor_contact" minlength="10" maxlength="11"
                                                    class="form-control" id="doctor_contact" required>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="doctor_qualification" class="form-label">Qualification</label>
                                            <div class="input-group has-validation">
                                                <input type="text" name="doctor_qualification" class="form-control"
                                                    id="doctor_qualification" required>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="doctor_specialist" class="form-label">Specialist</label>
                                            <div class="input-group has-validation">
                                                <input type="text" name="doctor_specialist" class="form-control"
                                                    id="doctor_specialist" required>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="doctor_dob" class="form-label">Date of
                                                Birth</label>
                                            <div class="input-group has-validation">
                                                <input type="date" name="doctor_dob" class="form-control"
                                                    id="doctor_dob" required>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="doctor_status" class="form-label" hidden>Status</label>
                                            <div class="input-group">
                                                <select class="form-select" name="doctor_status" id="doctor_status"
                                                    hidden>
                                                    <option selected>Active</option>
                                                    <option>Inactive</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit"
                                                name="submit">Register</button>
                                            <a href="doctorLogin.php" class="btn btn-link w-100">Doctor Login</a>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </section>

        </div>
    </main>

    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js"></script>

</body>

</html>