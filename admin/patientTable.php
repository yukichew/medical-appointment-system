<?php
include("adminSession.php");
include("adminHeader.php");
include("adminSide.php");

include('../config.php');

if (isset($_GET['action'], $_GET['patient_id']) && $_GET['action'] == 'delete') {
    $id = intval(trim($_GET['patient_id']));

    $sql = 'DELETE FROM patient WHERE patient_id= ' . $id;
    $delete = mysqli_query($conn, $sql);

    if (mysqli_affected_rows($conn) == 0) {
        echo '<script>alert("Unable to delete record.");</script>';
        header('location:patientTable.php');

    } else {
        echo '<script>alert("Record has deleted successfully."); window.location.href = "patientTable.php"; </script>';
    }
}

$selectOrder_sql = 'SELECT * from patient ORDER BY patient_id';
$rs = mysqli_query($conn, $selectOrder_sql);

?>

<body>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>All Patients</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="adminHome.php">Home</a></li>
                    <li class="breadcrumb-item active">Patient</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">All Patients</h5>

                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Full Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Contact</th>
                                        <th scope="col">Date of Birth</th>
                                        <th scope="col">Gender</th>
                                        <?php
                                        if (isset($_SESSION['admin_id'])) {
                                            ?>
                                            <th scope="col">Action</th>
                                            <?php
                                        }
                                        ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($row = mysqli_fetch_assoc($rs)) {
                                        ?>

                                        <tr>
                                            <td>
                                                <?php echo $row['patient_id'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['patient_fullname'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['patient_email'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['patient_contact'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['patient_dob'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['patient_gender'] ?>
                                            </td>
                                            <?php
                                            if (isset($_SESSION['admin_id'])) {
                                                ?>
                                                <td>
                                                    <a
                                                        href="patientEdit.php?patient_id=<?php echo $row['patient_id'] ?>">Edit</a>
                                                    <a href="patientTable.php?action=delete&patient_id=<?php echo $row['patient_id'] ?>"
                                                        class="delete-record">Delete</a>
                                                </td>
                                                <?php
                                            }
                                            ?>
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

    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>