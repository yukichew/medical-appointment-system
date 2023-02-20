<?php
include("session.php");
include('config.php');

$patient_id = $_SESSION['patient_id'];

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
                patient_contact = '$patient_contact' , patient_dob = '$patient_dob' , patient_gender = '$patient_gender'
                WHERE patient_id = " . $patient_id;

        if (mysqli_query($conn, $sql)) {
            if (!mysqli_query($conn, $sql)) {
                die('Error: ' . mysqli_error($conn));

            } else {
                echo '<script>alert("Patient details have been updated successfully.");</script>';
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
        <h5 class='text-center pb-3'>Edit Profile</h5>
            <div class="row">
                <div class="card mx-auto" style="width: 1000px;">
                    <div class="card-body pt-3" id="editPatient">
                        <form method="POST">
                            <div class="form-group row mb-2">
                                <label for="patient_fullname" class="col-sm-2 col-form-label">Full Name</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" placeholder="Enter your fullname"
                                        name="patient_fullname" value="<?php echo $row['patient_fullname']; ?>"
                                        required>
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label for="patient_email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="Email" placeholder="Enter your patient_email"
                                        name="patient_email" value="<?php echo $row['patient_email']; ?>" required>
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label for="patient_contact" class="col-sm-2 col-form-label">Contact</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="tel" name="patient_contact" id="patient_contact"
                                        placeholder="Enter your contact number" minlength="10" maxlength="11"
                                        value="<?php echo $row['patient_contact']; ?>" required>
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label for="patient_dob" class="col-sm-2 col-form-label">Date of Birth</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="date" name="patient_dob"
                                        value="<?php echo $row['patient_dob']; ?>" required>
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label for="patient_gender" class="col-sm-2 col-form-label">Gender</label>
                                <div class="col-sm-10">
                                    <select class="form-select" name="patient_gender" required>
                                        <option selected disabled>Select your gender</option>
                                        <option <?php echo ($row['patient_gender'] == 'Female') ? 'selected="selected"' : ''; ?> value="Female">Female</option>
                                        <option <?php echo ($row['patient_gender'] == 'Male') ? 'selected="selected"' : ''; ?> value="Male">Male</option>
                                    </select>
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary" name='submit'>Save Changes</button>
                                <button type="button" class="btn btn-primary"
                                    onclick = "window.location.href = 'index.php'; return false;">Back</button>
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