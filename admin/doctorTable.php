<?php
include("adminSession.php");
include("adminHeader.php");
include("adminSide.php");
include('../config.php');

if (isset($_GET['action'], $_GET['doctor_id']) && $_GET['action'] == 'delete') {
    $id = intval(trim($_GET['doctor_id']));

    $sql = 'DELETE FROM doctor WHERE doctor_id= ' . $id;
    $delete = mysqli_query($conn, $sql);

    if (mysqli_affected_rows($conn) == 0) {
        echo '<script>alert("Unable to delete record."); window.location.href = "doctorTable.php"; </script>';

    } else {
        echo '<script>alert("Record has deleted successfully."); window.location.href = "doctorTable.php"; </script>';
    }
}

$selectOrder_sql = 'SELECT * from doctor ORDER BY doctor_id';
$rs = mysqli_query($conn, $selectOrder_sql);

?>

<body>
    <?php
    if (isset($_SESSION['admin_id'])) {
        ?>
        <main id="main" class="main">

            <div class="pagetitle">
                <h1>All Doctors</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="adminHome.php">Home</a></li>
                        <li class="breadcrumb-item active">Doctor</li>
                    </ol>
                </nav>
            </div>

            <section class="section">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">All Doctors</h5>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Contact</th>
                                            <th scope="col">Qualification</th>
                                            <th scope="col">Specialist</th>
                                            <th scope="col">Date of Birth</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($row = mysqli_fetch_assoc($rs)) {
                                            ?>

                                            <tr>
                                                <td>
                                                    <?php echo $row['doctor_id'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['doctor_name'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['doctor_email'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['doctor_contact'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['doctor_qualification'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['doctor_specialist'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['doctor_dob'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['doctor_status'] ?>
                                                </td>
                                                <td>
                                                    <a href="doctorEdit.php?doctor_id=<?php echo $row['doctor_id'] ?>">Edit</a>
                                                    <a href="doctorTable.php?action=delete&doctor_id=<?php echo $row['doctor_id'] ?>"
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