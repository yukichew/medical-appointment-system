<?php
include('navbar.php');
include('config.php');

$selectOrder_sql = 'SELECT * from doctor ORDER BY doctor_id';
$result = mysqli_query($conn, $selectOrder_sql);
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

<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/main.js"></script>
</body>
<section class="py-5" id="aboutUs">
    <div class="container px-5 my-3">
        <div class="row gx-5 justify-content-center">
            <div class="col-lg-8 col-xl-6">
                <div class="text-center">
                    <h2 class="fw-bolder mb-5">Our Doctors</h2>
                </div>
            </div>
        </div>
        <div class="row gx-5">
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <div class="col-lg-4 mb-5 embed-responsive-item">
                    <div class="card h-100 shadow border-0">
                        <div class="card-body p-4">
                            <h5 class="card-title mb-3 mt-3">
                                <?php echo $row['doctor_name'] ?>
                            </h5>
                            <p class="card-text mb-1">
                                <?php echo $row['doctor_specialist'] ?>
                            </p>
                            <div class="small">
                                <div class="text-muted">
                                    <?php echo $row['doctor_qualification'] ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</section>

</html>