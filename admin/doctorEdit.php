<?php
include("adminSession.php");
include("adminHeader.php");
include("adminSide.php");
include('../config.php');

$doctor_id = $_GET['doctor_id'];

if (isset($_POST['submit'])) {
    $doctor_email = $_POST['doctor_email'];
    $doctor_name = $_POST['doctor_name'];
    $doctor_contact = $_POST['doctor_contact'];
    $doctor_qualification = $_POST['doctor_qualification'];
    $doctor_specialist = $_POST['doctor_specialist'];
    $doctor_status = $_POST['doctor_status'];
    $doctor_dob = $_POST['doctor_dob'];

    if (
        isset($doctor_email, $doctor_name, $doctor_contact, $doctor_qualification, $doctor_specialist, $doctor_status, $doctor_dob)
        && !empty($doctor_email) && !empty($doctor_name) && !empty($doctor_qualification) && !empty($doctor_specialist) && !empty($doctor_status) && !empty($doctor_dob)
    ) {
        $doctor_name = filter_var(trim($doctor_name, FILTER_SANITIZE_STRING));
        $doctor_qualification = filter_var(trim($doctor_qualification, FILTER_SANITIZE_STRING));
        $doctor_specialist = filter_var(trim($doctor_specialist, FILTER_SANITIZE_STRING));
        $doctor_email = filter_var(trim($doctor_email, FILTER_VALIDATE_EMAIL));

        $sql = "UPDATE doctor SET doctor_email = '$doctor_email', doctor_email = '$doctor_email',
                doctor_name = '$doctor_name' , doctor_contact = '$doctor_contact' , doctor_qualification = '$doctor_qualification' 
                , doctor_specialist = '$doctor_specialist' , doctor_status = '$doctor_status' WHERE doctor_id = " . $doctor_id;

        if (mysqli_query($conn, $sql)) {
            if (!mysqli_query($conn, $sql)) {
                die('Error: ' . mysqli_error($conn));

            } else {
                echo '<script>alert("Doctor details have been updated successfully."); window.location.href = "doctorTable.php"; </script>';
            }
        }
    }
}

$selectOrder_sql = 'SELECT * from doctor WHERE doctor_id = ' . $doctor_id;
$rs = mysqli_query($conn, $selectOrder_sql);
$row = mysqli_fetch_assoc($rs);
?>

<body>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Edit Doctor</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="adminHome.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="appointmentTable.php">Doctor</a></li>
                    <li class="breadcrumb-item active">Edit Doctor</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body pt-3" id="editDoctor">
                            <form method="POST">
                                <div class="row mb-3">
                                    <label for="doctor_email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="doctor_email" type="email" class="form-control" id="doctor_email"
                                            value="<?php echo $row['doctor_email']; ?>" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="doctor_name" class="col-md-4 col-lg-3 col-form-label">Name</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="doctor_name" type="text" class="form-control" id="doctor_name"
                                            value="<?php echo $row['doctor_name']; ?>" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="doctor_contact" class="col-md-4 col-lg-3 col-form-label">Contact</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="doctor_contact" type="tel" class="form-control" id="doctor_contact"
                                            minlength="10" maxlength="11" value="<?php echo $row['doctor_contact']; ?>"
                                            required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="doctor_qualification"
                                        class="col-md-4 col-lg-3 col-form-label">Qualification</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="doctor_qualification" type="text" class="form-control"
                                            id="doctor_qualification"
                                            value="<?php echo $row['doctor_qualification']; ?>" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="doctor_specialist"
                                        class="col-md-4 col-lg-3 col-form-label">Specialist</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="doctor_specialist" type="text" class="form-control"
                                            id="doctor_specialist" value="<?php echo $row['doctor_specialist']; ?>"
                                            required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="doctor_dob" class="col-md-4 col-lg-3 col-form-label">Date of
                                        Birth</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="doctor_dob" type="date" class="form-control" id="doctor_dob"
                                            value="<?php echo $row['doctor_dob']; ?>" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="doctor_status" class="col-md-4 col-lg-3 col-form-label">Status</label>
                                    <div class="col-md-8 col-lg-9">
                                        <select class="form-select" name="doctor_status" required>
                                            <option <?php echo ($row['doctor_status'] == 'Active') ? 'selected="selected"' : ''; ?> value="Active">Active</option>
                                            <option <?php echo ($row['doctor_status'] == 'Inactive') ? 'selected="selected"' : ''; ?> value="Inactive">Inactive</option>
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