<?php
include('config.php');

$selectOrder_sql = 'SELECT * from doctor ORDER BY doctor_id LIMIT 3';
$result = mysqli_query($conn, $selectOrder_sql);
?>
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
        <div class="text-center">
            <a href="allDoctors.php" class="link-dark">View All Doctors</a>
        </div>
    </div>
</section>