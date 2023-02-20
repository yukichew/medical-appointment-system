<?php
include("session.php");
include('config.php');
include('navbar.php');

$patient_id = $_SESSION['patient_id'];

$query = "SELECT doctor_id, doctor_name FROM doctor WHERE doctor_status = 'Active'";
$results = mysqli_query($conn, $query);
if (mysqli_affected_rows($conn) > 0) {
    $options = mysqli_fetch_all($results, MYSQLI_ASSOC);
}

$appointment_id = $_GET['id'];

$selectOrder_sql = 'SELECT * from appointment WHERE appointment_id = ' . $appointment_id;
$rs = mysqli_query($conn, $selectOrder_sql);
$row = mysqli_fetch_assoc($rs);

$checkAppointmentsql = "SELECT * FROM appointment WHERE appointment_status = 'Active'";
$result = mysqli_query($conn, $checkAppointmentsql);
$checkAppointment_rw = mysqli_fetch_all($result, MYSQLI_ASSOC);

foreach ($checkAppointment_rw as $rw) {
    if (isset($_POST['submit'])) {
        $appointment_date = $_POST['appointment_date'];
        $appointment_time = $_POST['appointment_time'];
        $doctor_id = $_POST['doctor_id'];
        $appointment_reason = $_POST['appointment_reason'];
        $appointment_status = $_POST['appointment_status'];

        if (
            isset($appointment_date, $doctor_id, $appointment_reason, $appointment_time)
            && !empty($appointment_date) && !empty($doctor_id) && !empty($appointment_reason) && !empty($appointment_time)
        ) {
            if ($rw["appointment_date"] == $appointment_date && $rw["appointment_time"] == $appointment_time && $rw["doctor_id"] == $doctor_id) {

                if ($rw["appointment_id"] != $appointment_id) {
                    echo '<script>alert("This time slot has been booked. Please choose other time slot.");</script>';
                    break;

                } else {
                    $sql = "UPDATE appointment SET appointment_date = '$appointment_date', appointment_time = '$appointment_time', appointment_reason = '$appointment_reason' , appointment_status = '$appointment_status'  , doctor_id = '$doctor_id' WHERE appointment_id = " . $appointment_id;

                    if (!mysqli_query($conn, $sql)) {
                        die('Error: ' . mysqli_error($conn));

                    } else {
                        echo '<script>window.location.href = "allAppointments.php";</script>';

                    }
                }

            } else {
                $sql = "UPDATE appointment SET appointment_date = '$appointment_date', appointment_time = '$appointment_time', appointment_reason = '$appointment_reason' , appointment_status = '$appointment_status'  , doctor_id = '$doctor_id' WHERE appointment_id = " . $appointment_id;

                if (!mysqli_query($conn, $sql)) {
                    die('Error: ' . mysqli_error($conn));

                } else {
                    echo '<script>alert("Appointment has been updated successfully."); window.location.href = "allAppointments.php";</script>';

                }
            }
        }
    }
}

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

<body>
    <main class="main">
        <div class="mx-5 mb-5">
            <h5 class='text-center mt-4'>Edit Appointment</h5>
            <div class="card m-4">
                <div class="card-body m-3">
                    <form method="POST">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="appointment_date">Appointment Date</label>
                                <input type="date" class="form-control mt-2" id="appointment_date"
                                    name="appointment_date" value='<?php echo $row["appointment_date"]; ?>' required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="appointment_time">Appointment Time</label>
                                <select class="form-control mt-2" name="appointment_time" required>
                                    <option selected disabled>Select a time</option>
                                    <option <?php echo ($row['appointment_time'] == '10:00:00') ? 'selected="selected"' : ''; ?>value="10:00:00">10:00:00</option>
                                    <option <?php echo ($row['appointment_time'] == '10:30:00') ? 'selected="selected"' : ''; ?>value="10:30:00">10:30:00</option>
                                    <option <?php echo ($row['appointment_time'] == '11:00:00') ? 'selected="selected"' : ''; ?>value="11:00:00">11:00:00</option>
                                    <option <?php echo ($row['appointment_time'] == '11:30:00') ? 'selected="selected"' : ''; ?>value="11:30:00">11:30:00</option>
                                    <option <?php echo ($row['appointment_time'] == '12:00:00') ? 'selected="selected"' : ''; ?>value="12:00:00">12:00:00</option>
                                    <option <?php echo ($row['appointment_time'] == '12:30:00') ? 'selected="selected"' : ''; ?>value="12:30:00">12:30:00</option>
                                    <option <?php echo ($row['appointment_time'] == '13:00:00') ? 'selected="selected"' : ''; ?>value="13:00:00">13:00:00</option>
                                    <option <?php echo ($row['appointment_time'] == '13:30:00') ? 'selected="selected"' : ''; ?>value="13:30:00">13:30:00</option>
                                    <option <?php echo ($row['appointment_time'] == '14:00:00') ? 'selected="selected"' : ''; ?>value="14:00:00">14:00:00</option>
                                    <option <?php echo ($row['appointment_time'] == '14:30:00') ? 'selected="selected"' : ''; ?>value="14:30:00">14:30:00</option>
                                    <option <?php echo ($row['appointment_time'] == '15:00:00') ? 'selected="selected"' : ''; ?>value="15:00:00">15:00:00</option>
                                    <option <?php echo ($row['appointment_time'] == '15:30:00') ? 'selected="selected"' : ''; ?>value="15:30:00">15:30:00</option>
                                    <option <?php echo ($row['appointment_time'] == '16:00:00') ? 'selected="selected"' : ''; ?>value="16:00:00">16:00:00</option>
                                    <option <?php echo ($row['appointment_time'] == '16:30:00') ? 'selected="selected"' : ''; ?>value="16:30:00">16:30:00</option>
                                    <option <?php echo ($row['appointment_time'] == '17:00:00') ? 'selected="selected"' : ''; ?>value="17:00:00">17:00:00</option>
                                    <option <?php echo ($row['appointment_time'] == '17:30:00') ? 'selected="selected"' : ''; ?>value="17:30:00">17:30:00</option>
                                    <option <?php echo ($row['appointment_time'] == '18:00:00') ? 'selected="selected"' : ''; ?>value="18:00:00">18:00:00</option>
                                    <option <?php echo ($row['appointment_time'] == '18:30:00') ? 'selected="selected"' : ''; ?>value="18:30:00">18:30:00</option>
                                    <option <?php echo ($row['appointment_time'] == '19:00:00') ? 'selected="selected"' : ''; ?>value="19:00:00">19:00:00</option>
                                    <option <?php echo ($row['appointment_time'] == '19:30:00') ? 'selected="selected"' : ''; ?>value="19:30:00">19:30:00</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="form-group col-md-12">
                                <label for="doctor_id" class="mt-2">Doctor Preferred</label>
                                <select class="form-control mt-2" name="doctor_id" required>
                                    <option selected disabled>Select a doctor</option>
                                    <?php
                                    foreach ($options as $option) {
                                        ?>
                                        <option <?php echo ($option['doctor_id'] == $row['doctor_id']) ? 'selected="selected"' : ''; ?> value='<?php echo $option["doctor_id"]; ?>'>
                                            <?php echo $option['doctor_name']; ?>
                                        </option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="form-group col-md-12">
                                <label for="appointment_date" class="mt-2">Reason of Appointment</label>
                                <textarea name="appointment_reason" id="appointment_reason" class="form-control mt-2"
                                    required><?php echo $row['appointment_reason']; ?></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="appointment_status" class="mt-2">Appointment
                                    Status</label>
                                <select class="form-control mt-2" name="appointment_status">
                                    <option <?php echo ($row['appointment_status'] == 'Active') ? 'selected="selected"' : ''; ?>value="Active">Active</option>
                                    <option <?php echo ($row['appointment_status'] == 'Cancelled') ? 'selected="selected"' : ''; ?>value="Cancelled">Cancelled</option>
                                </select>
                            </div>
                        </div>

                        <div class="text-center mt-5">
                            <button type="submit" class="btn btn-primary" name="submit">Save
                                Changes</button>
                            <button type="button" class="btn btn-primary"
                                onclick="javascript:history.go(-1); return false;">Back</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js"></script>

    <script language="javascript">
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0');
        var yyyy = today.getFullYear();

        today = yyyy + '-' + mm + '-' + dd;
        $('#appointment_date').attr('min', today);
    </script>
</body>

</html>