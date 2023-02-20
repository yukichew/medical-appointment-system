<?php
session_start();
include('../config.php');

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $doctor_password = $_POST['password'];

    if (
        isset($email, $doctor_password)
        && !empty($email) && !empty($doctor_password)
    ) {
        $email = filter_var(trim($email, FILTER_VALIDATE_EMAIL));

        $sql = "SELECT doctor_id FROM doctor WHERE doctor_email = '$email' and doctor_password = '$doctor_password'";
        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_array($result)) {
            $doctor_id = $row['doctor_id'];
        }

        if (mysqli_affected_rows($conn) == 0) {
            echo "<script>alert('Your email or password is invalid. Please try again.');</script>";

        } else {
            $_SESSION['doctorSession'] = $email;
            $_SESSION['doctor_id'] = $doctor_id;
            echo "<script>window.location.href = 'adminHome.php';</script>";
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
                                        <h5 class="card-title text-center pb-0 fs-4">Doctor Login</h5>
                                    </div>

                                    <form class="row g-3 needs-validation" method="POST">

                                        <div class="col-12">
                                            <label for="email" class="form-label">Email</label>
                                            <div class="input-group has-validation">
                                                <input type="email" name="email" class="form-control" id="email"
                                                    required>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="doctor_password" class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control"
                                                id="doctor_password" required>
                                        </div>

                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit"
                                                name="submit">Login</button>
                                            <a href="doctorRegister.php" class="btn btn-link w-100">Register as a
                                                doctor</a>
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