<?php
include("adminSession.php");
include("adminHeader.php");
include("adminSide.php");
include('../config.php');

$doctor_id = $_SESSION['doctor_id'];

if (isset($_GET['action'], $_GET['appointment_id']) && $_GET['action'] == 'delete') {
    $id = intval(trim($_GET['appointment_id']));

    $sql = 'DELETE FROM appointment WHERE appointment_id=' . $id;
    $delete = mysqli_query($conn, $sql);

    if (mysqli_affected_rows($conn) == 0) {
        echo '<script>alert("Unable to delete record.");</script>';
        header('location:scheduleTable.php');

    } else {
        echo '<script>alert("Record has deleted successfully."); window.location.href = "scheduleTable.php"; </script>';
    }
}

$doctorSchedule_sql = "SELECT * from appointment WHERE doctor_id = '$doctor_id' ORDER BY appointment_id Desc";
$doctorSchedule_rs = mysqli_query($conn, $doctorSchedule_sql);

?>

<body>
    <?php
    if (isset($_SESSION['doctor_id'])) {
        ?>
        <main id="main" class="main">

            <div class="pagetitle">
                <h1>All My Schedules</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="adminHome.php">Home</a></li>
                        <li class="breadcrumb-item active">My Schedule</li>
                    </ol>
                </nav>
            </div>

            <section class="section">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">All My Schedules</h5>

                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">Patient Name</th>
                                            <th scope="col">Appointment Date</th>
                                            <th scope="col">Appointment Time</th>
                                            <th scope="col">Appointment Reason</th>
                                            <th scope="col">Appointment Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($doctorSchedule_row = mysqli_fetch_assoc($doctorSchedule_rs)) {
                                            $created = date('Y-m-d', strtotime($doctorSchedule_row['appointment_date']));
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php $patient = 'SELECT appointment.appointment_id, appointment.patient_id, patient.patient_fullname FROM patient INNER JOIN appointment ON appointment.patient_id = patient.patient_id WHERE appointment.doctor_id =' . $_SESSION['doctor_id'];
                                                    $patient_query = mysqli_query($conn, $patient);
                                                    while ($patient_row = mysqli_fetch_array($patient_query)) {
                                                        $patient_name = $patient_row['patient_fullname'];
                                                        $patient_id = $patient_row['patient_id'];
                                                        $appointment_id = $patient_row['appointment_id'];

                                                        if ($patient_id == $doctorSchedule_row['patient_id'] && $appointment_id == $doctorSchedule_row['appointment_id']) {
                                                            echo $patient_name;
                                                        }
                                                    } ?>
                                                </td>
                                                <td>
                                                    <?php echo $created ?>
                                                </td>
                                                <td>
                                                    <?php echo $doctorSchedule_row['appointment_time'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $doctorSchedule_row['appointment_reason'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $doctorSchedule_row['appointment_status'] ?>
                                                </td>
                                                <td>
                                                    <a
                                                        href="appointmentEdit.php?appointment_id=<?php echo $doctorSchedule_row['appointment_id'] ?>">Edit</a>
                                                    <a href="scheduleTable.php?action=delete&appointment_id=<?php echo $doctorSchedule_row['appointment_id'] ?>"
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