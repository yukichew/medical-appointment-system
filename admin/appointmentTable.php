<?php
include("adminSession.php");
include("adminHeader.php");
include("adminSide.php");
include('../config.php');

if (isset($_GET['action'], $_GET['appointment_id']) && $_GET['action'] == 'delete') {
    $id = intval(trim($_GET['appointment_id']));

    $sql = 'DELETE FROM appointment WHERE appointment_id=' . $id;
    $delete = mysqli_query($conn, $sql);

    if (mysqli_affected_rows($conn) == 0) {
        echo '<script>alert("Unable to delete record.");</script>';
        header('location:appointmentTable.php');

    } else {
        echo '<script>alert("Record has deleted successfully."); window.location.href = "appointmentTable.php"; </script>';
    }
}

$selectOrder_sql = 'SELECT * from appointment ORDER BY appointment_id Desc';
$rs = mysqli_query($conn, $selectOrder_sql);

?>

<body>
    <?php
    if (isset($_SESSION['admin_id'])) {
        ?>
        <main id="main" class="main">

            <div class="pagetitle">
                <h1>All Appointments</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="adminHome.php">Home</a></li>
                        <li class="breadcrumb-item active">Appointment</li>
                    </ol>
                </nav>
            </div>

            <section class="section">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">All Appointments</h5>

                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Patient Name</th>
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
                                        // fetch result as an associative array
                                        while ($row = mysqli_fetch_assoc($rs)) {
                                            $created = date('Y-m-d', strtotime($row['appointment_date']));
                                            ?>

                                            <tr>
                                                <td>
                                                    <?php echo $row['appointment_id'] ?>
                                                </td>
                                                <td>
                                                    <?php $patient = 'SELECT appointment.appointment_id, appointment.patient_id, patient.patient_fullname FROM patient INNER JOIN appointment ON appointment.patient_id = patient.patient_id';
                                                    $patient_query = mysqli_query($conn, $patient);
                                                    while ($patient_row = mysqli_fetch_array($patient_query)) {
                                                        $patient_name = $patient_row['patient_fullname'];
                                                        $patient_id = $patient_row['patient_id'];
                                                        $appointment_id = $patient_row['appointment_id'];

                                                        if ($patient_id == $row['patient_id'] && $appointment_id == $row['appointment_id']) {
                                                            echo $patient_name;
                                                        }
                                                    } ?>
                                                </td>
                                                <td>
                                                    <?php $doctor = 'SELECT appointment.appointment_id, appointment.doctor_id, doctor.doctor_name FROM doctor INNER JOIN appointment ON appointment.doctor_id = doctor.doctor_id';
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
                                                        href="appointmentEdit.php?appointment_id=<?php echo $row['appointment_id'] ?>">Edit</a>
                                                    <a href="appointmentTable.php?action=delete&appointment_id=<?php echo $row['appointment_id'] ?>"
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
        <?php
    }
    ?>

    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js"></script>

</body>