<?php
include("adminSession.php");
include("adminHeader.php");
include("adminSide.php");
include('../config.php');

$patient_id = $_GET['patient_id'];

if (isset($_POST['submit'])) {
    $patient_fullname = $_POST['patient_fullname'];
    $patient_email = $_POST['patient_email'];
    $patient_contact = $_POST['patient_contact'];
    $patient_dob = $_POST['patient_dob'];
    $patient_gender = $_POST['patient_gender'];

    if (
        isset($patient_fullname, $patient_email, $patient_contact, $patient_dob, $patient_gender)
        && !empty($patient_fullname) && !empty($patient_email) && !empty($patient_contact) && !empty($patient_dob) && !empty($patient_gender)
    ) {
        $patient_fullname = filter_var(trim($patient_fullname, FILTER_SANITIZE_STRING));
        $patient_email = filter_var(trim($patient_email, FILTER_VALIDATE_EMAIL));

        $sql = "UPDATE patient SET patient_fullname = '$patient_fullname', patient_email = '$patient_email',
                patient_contact = '$patient_contact' , patient_dob = '$patient_dob' , patient_gender = '$patient_gender' WHERE doctor_id = " . $doctor_id;
                
        if (mysqli_query($conn, $sql)) {
            if (!mysqli_query($conn, $sql)) {
                die('Error: ' . mysqli_error($conn));

            } else {
                echo '<script>alert("Patient details have been updated successfully."); window.location.href = "patientTable.php"; </script>';
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
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Edit Appointment</title>

    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Edit Patient</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="adminHome.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="appointmentTable.php">Patient</a></li>
                    <li class="breadcrumb-item active">Edit Patient</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card mx-auto">
                        <div class="card-body pt-3" id="editPatient">
                            <form method="POST">
                                <div class="row mb-3">
                                    <label for="patient_fullname" class="col-md-4 col-lg-3 col-form-label">Full
                                        Name</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="patient_fullname" type="text" class="form-control"
                                            id="patient_fullname" value="<?php echo $row['patient_fullname']; ?>"
                                            required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="patient_email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="patient_email" type="email" class="form-control" id="patient_email"
                                            value="<?php echo $row['patient_email']; ?>" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="patient_contact"
                                        class="col-md-4 col-lg-3 col-form-label">Contact</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="patient_contact" type="tel" class="form-control"
                                            id="patient_contact" minlength="10" maxlength="11"
                                            value="<?php echo $row['patient_contact']; ?>" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="patient_dob" class="col-md-4 col-lg-3 col-form-label">Date of
                                        Birth</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="patient_dob" type="date" class="form-control" id="patient_dob"
                                            value="<?php echo $row['patient_dob']; ?>" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="patient_gender" class="col-md-4 col-lg-3 col-form-label">Gender</label>
                                    <div class="col-md-8 col-lg-9">
                                        <select class="form-select" name="patient_gender" required>
                                            <option <?php echo ($row['patient_gender'] == 'Female') ? 'selected="selected"' : ''; ?> value="Female">Active</option>
                                            <option <?php echo ($row['patient_gender'] == 'Male') ? 'selected="selected"' : ''; ?> value="Male">Male</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary" name='submit'>Save Changes</button>
                                    <button type="button" class="btn btn-primary"
                                        onclick="javascript:history.go(-1); return false;">Back</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>