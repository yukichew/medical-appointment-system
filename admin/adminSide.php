<body>
    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-item">
                <a class="nav-link " href="adminHome.php">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-heading">Pages</li>

            <?php
            if (isset($_SESSION['admin_id'])) {
                ?>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="appointmentTable.php">
                        <i class="bi bi-menu-button-wide"></i>
                        <span>Appointment</span>
                    </a>
                </li>
                <?php
            }
            ?>

            <li class="nav-item">
                <a class="nav-link collapsed" href="patientTable.php">
                    <i class="bi bi-table"></i>
                    <span>Patient</span>
                </a>
            </li>

            <?php
            if (isset($_SESSION['admin_id'])) {
                ?>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="doctorTable.php">
                        <i class="bi bi-file-medical"></i>
                        <span>Doctor</span>
                    </a>
                </li>
                <?php
            }
            ?>

            <?php
            if (isset($_SESSION['doctor_id'])) {
                ?>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="scheduleTable.php">
                        <i class="bi bi-journal-text"></i>
                        <span>My Schedule</span>
                    </a>
                </li>
                <?php
            }
            ?>

            <li class="nav-item">
                <?php
                $directPage = '';
                if (isset($_SESSION['admin_id'])) {
                    $directPage = 'adminProfile.php';
                }
                if (isset($_SESSION['doctor_id'])) {
                    $directPage = 'doctorProfile.php';
                }
                ?>
                <a class="nav-link collapsed" href="<?php echo $directPage ?>">
                    <i class="bi bi-person"></i>
                    <span>Edit Profile</span>
                </a>
            </li>

        </ul>
    </aside>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>