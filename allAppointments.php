<?php
include("session.php");
include('config.php');

$userID = intval($userID);

if (isset($_GET['action'], $_GET['appointment_id']) && $_GET['action'] == 'delete') {
    $id = intval(trim($_GET['appointment_id']));

    $sql = 'DELETE FROM appointment WHERE appointment_id=' . $id;
    $delete = mysqli_query($conn, $sql);

    if (mysqli_affected_rows($conn) == 0) {
        echo '<script>alert("Unable to delete record.");</script>';
        header('location:allAppointments.php');

    } else {
        echo '<script>alert("Record has deleted successfully."); window.location.href = "allAppointments.php"; </script>';
    }
}

$selectOrder_sql = "SELECT * from appointment WHERE patient_id = '$userID' ORDER BY appointment_id Desc";
$rs = mysqli_query($conn, $selectOrder_sql);

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
        <?php include('navbar.php'); ?>
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card m-5">
                        <div class="card-header">
                            <div class="text-center">
                                <h5 class="card-title">My Appointments</h5>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Doctor Name</th>
                                        <th scope="col">Appointment Date</th>
                                        <th scope="col">Appointment Time</th>
                                        <th scope="col">Appointment Reason</th>
                                        <th scope="col">Appointment Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($row = mysqli_fetch_assoc($rs)) {
                                        $created = date('Y-m-d', strtotime($row['appointment_date']));
                                        ?>

                                        <tr>
                                            <td>
                                                <?php $doctor = 'SELECT appointment.appointment_id, appointment.doctor_id, doctor.doctor_name FROM doctor INNER JOIN appointment ON appointment.doctor_id = doctor.doctor_id WHERE appointment.patient_id =' . $_SESSION['patient_id'];
                                                $doctor_query = mysqli_query($conn, $doctor);
                                                while ($doctor_row = mysqli_fetch_array($doctor_query)) {
                                                    $doctor_name = $doctor_row['doctor_name'];
                                                    $doctor_id = $doctor_row['doctor_id'];
                                                    $appointment_id = $doctor_row['appointment_id'];

                                                    if ($doctor_id == $row['doctor_id'] && $appointment_id == $row['appointment_id']) {
                                                        echo $doctor_name;
                                                    }
                                                } ?>
                                            </td>
                                            <td>
                                                <?php echo $created ?>
                                            </td>
                                            <td>
                                                <?php echo $row['appointment_time'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['appointment_reason'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['appointment_status'] ?>
                                            </td>
                                            <td>
                                                <a
                                                    href="appointmentEdits.php?id=<?php echo $row['appointment_id'] ?>">Edit</a>
                                                <a href="allAppointments.php?action=delete&appointment_id=<?php echo $row['appointment_id'] ?>"
                                                    onclick="return confirm('Are you sure?');">Delete</a>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
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