<?php
include("adminSession.php");
include("adminHeader.php");
include("adminSide.php");
include('../config.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Admin Dashboard</title>

    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="adminhome.php">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div>

        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">

                        <!-- Appointments Card -->
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card sales-card">
                                <div class="card-body">
                                    <h5 class="card-title">Appointments <span>| Total</span></h5>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-calendar2-week"></i>
                                        </div>
                                        <div class="ps-3">
                                            <?php
                                            $totalAppointment_sql = 'SELECT COUNT(appointment_id) FROM appointment';
                                            $totalAppointment_rs = mysqli_query($conn, $totalAppointment_sql);
                                            $Appointment_data = mysqli_fetch_assoc($totalAppointment_rs);
                                            $totalAppointment = intval($Appointment_data);
                                            ?>
                                            <h6>
                                                <?php echo $totalAppointment; ?>
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Patients Card -->
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card revenue-card">
                                <div class="card-body">
                                    <h5 class="card-title">Patients <span>| Total</span></h5>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-people"></i>
                                        </div>
                                        <div class="ps-3">
                                            <?php
                                            $totalPatient_sql = 'SELECT COUNT(patient_id) FROM patient';
                                            $totalPatient_rs = mysqli_query($conn, $totalPatient_sql);
                                            $patient_data = mysqli_fetch_assoc($totalPatient_rs);
                                            $totalPatient = intval($patient_data);
                                            ?>
                                            <h6>
                                                <?php echo $totalPatient; ?>
                                            </h6>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- Doctors Card -->
                        <div class="col-xxl-4 col-xl-12">
                            <div class="card info-card customers-card">
                                <div class="card-body">
                                    <h5 class="card-title">Doctors <span>| Total</span></h5>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-people"></i>
                                        </div>
                                        <div class="ps-3">
                                            <?php
                                            $totalDoctor_sql = 'SELECT COUNT(patient_id) FROM patient';
                                            $totalDoctor_rs = mysqli_query($conn, $totalDoctor_sql);
                                            $doctor_data = mysqli_fetch_assoc($totalDoctor_rs);
                                            $totalDoctor = intval($doctor_data);
                                            ?>
                                            <h6>
                                                <?php echo $totalDoctor; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
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