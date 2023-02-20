<?php
session_start();
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>

<body class="d-flex flex-column h-100">
    <main class="flex-shrink-0">
        <!-- Nav Bar -->
        <?php include('navbar.php'); ?>

        <!-- Header -->
        <header class="bg-dark py-5">
            <div class="container px-5">
                <div class="row gx-5 align-items-center justify-content-center">
                    <div class="col-lg-8 col-xl-7 col-xxl-6">
                        <div class="my-5 text-center text-xl-start">
                            <h1 class="display-5 fw-bolder text-white mb-3">Welcome to MediZone</h1>
                        </div>
                    </div>
                    <div class="col-xl-5 col-xxl-6 d-none d-xl-block text-center">
                        <img class="img-fluid rounded-3 my-5" src="https://dummyimage.com/600x400/343a40/6c757d" />
                    </div>
                </div>
            </div>
        </header>

        <!-- Services -->
        <section class="py-5 bg-light" id="services">
            <div class="container px-5 my-5">
                <div class="row gx-5">
                    <div class="col-lg-3 mb-5 mb-lg-0">
                        <h2 class="fw-bolder mb-0">Our Services</h2>
                    </div>
                    <div class="col-lg-9">
                        <div class="row gx-5 row-cols-1 row-cols-md-2">
                            <div class="col mb-5 h-100">
                                <h2 class="h5">Lorem Ipsum</h2>
                                <p class="mb-0">Lorem Ipsum is simply dummy text of the printing and typesetting
                                    industry. Lorem Ipsum has been the industry's standard dummy text ever since the
                                    1500s, when an unknown printer took a galley of type and scrambled it to make a type
                                    specimen book.</p>
                            </div>
                            <div class="col mb-5 h-100">
                                <h2 class="h5">Lorem Ipsum</h2>
                                <p class="mb-0">Lorem Ipsum is simply dummy text of the printing and typesetting
                                    industry. Lorem Ipsum has been the industry's standard dummy text ever since the
                                    1500s, when an unknown printer took a galley of type and scrambled it to make a type
                                    specimen book.</p>
                            </div>
                            <div class="col mb-5 h-100">
                                <h2 class="h5">Lorem Ipsum</h2>
                                <p class="mb-0">Lorem Ipsum is simply dummy text of the printing and typesetting
                                    industry. Lorem Ipsum has been the industry's standard dummy text ever since the
                                    1500s, when an unknown printer took a galley of type and scrambled it to make a type
                                    specimen book.</p>
                            </div>
                            <div class="col mb-5 h-100">
                                <h2 class="h5">Lorem Ipsum</h2>
                                <p class="mb-0">Lorem Ipsum is simply dummy text of the printing and typesetting
                                    industry. Lorem Ipsum has been the industry's standard dummy text ever since the
                                    1500s, when an unknown printer took a galley of type and scrambled it to make a type
                                    specimen book.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- About Us -->
        <?php include('aboutUs.php'); ?>

        <!-- Make Appoinment Form -->
        <?php include('appointment.php'); ?>
    </main>

    <!-- Footer -->
    <?php include('footer.php'); ?>

</body>

</html>