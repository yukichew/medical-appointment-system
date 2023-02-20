<?php
include('../config.php');
if (isset($_SESSION['admin_id'])) {
    $adminID = $_SESSION["admin_id"];
    $sql = "SELECT * FROM admin WHERE admin_id = '$adminID'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
} else {
    $doctorID = $_SESSION["doctor_id"];
    $sql_doctor = "SELECT * FROM doctor WHERE doctor_id = '$doctorID'";
    $result_doctor = mysqli_query($conn, $sql_doctor);
    $row_doctor = mysqli_fetch_array($result_doctor);
}
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

    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="adminhome.php" class="logo d-flex align-items-center">
                <span class="d-none d-lg-block">Medizone</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div>

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">
                <li class="nav-item dropdown pe-3">
                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <span class="d-none d-md-block dropdown-toggle ps-2">
                            <?php
                            if (isset($_SESSION['admin_id'])) {
                                echo "Admin " . $row['admin_id'] . "";
                            }
                            if (isset($_SESSION['doctor_id'])) {
                                echo "Doctor " . $row_doctor['doctor_name'] . "";
                            }
                            ?>
                        </span>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <?php
                            if (isset($_SESSION['admin_id'])) {
                                echo "<h6>" . $row['admin_email'] . "</h6>";
                            }
                            if (isset($_SESSION['doctor_id'])) {
                                echo "<h6>" . $row_doctor['doctor_email'] . "</h6>";
                            }
                            ?>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <?php
                            $directPage = '';
                            if (isset($_SESSION['admin_id'])) {
                                $directPage = 'adminProfile.php';
                            }
                            if (isset($_SESSION['doctor_id'])) {
                                $directPage = 'doctorProfile.php';
                            }
                            ?>
                            <a class="dropdown-item d-flex align-items-center" href="<?php echo $directPage ?>">
                                <i class="bi bi-person"></i>
                                <span>Edit Profile</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="adminLogout.php">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </header>

    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>