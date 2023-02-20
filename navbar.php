<?php
include('config.php');
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container px-5">
        <a class="navbar-brand mb-0 h1" href="index.php">MediZone</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar"
            aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation"><span
                class="navbar-toggler-icon"></span></button>

        <div class="collapse navbar-collapse" id="navbar">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php#aboutUs">Doctors</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php#appointment">Make Appointment</a></li>
            </ul>
            <?php
            if (!isset($_SESSION['userSession'])) {
                ?>
                <button type="button" class="btn btn-light my-2 my-lg-0" data-bs-toggle="modal"
                    data-bs-target="#loginForm">Login</button>
                <button type="button" class="btn btn-light my-2 my-lg-0" data-bs-toggle="modal"
                    data-bs-target="#registerForm">Register</button>
                <?php
            }
            ?>
        </div>

        <!-- Patient -->
        <?php
        if (isset($_SESSION['patient_id'])) {
            $sql = "SELECT * FROM patient WHERE patient_id = " . $_SESSION["patient_id"];
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result);
            ?>
            <div class="dropdown">
                <a class="link-secondary dropdown-toggle" id="patientProfile" href="index.php" role="button"
                    data-bs-toggle="dropdown"><?php echo $row['patient_fullname']; ?>
                </a>
                <ul class="dropdown-menu" aria-labelledby="patientProfile">
                    <li>
                        <a class="dropdown-item" href="profile.php"><i class="bi bi-person"></i>
                            <span>Edit Profile</span></a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="changePassword.php"><i class="bi bi-lock"></i>
                            <span>Change Password</span></a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="allAppointments.php"><i class="bi bi-calendar-event"></i>
                            <span>My Appointments</span></a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="logout.php"><i class="bi bi-box-arrow-right"></i>
                            <span>Sign Out</span></a>
                    </li>
                </ul>
            </div>

            <?php
        }
        ?>
    </div>

    <!-- Login Form -->
    <div class="modal fade" id="loginForm">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Login Form</h5>
                    <button type="button" class="close" data-bs-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="modal-content animate" action="login.php" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="email" id="email" name="email" class="form-control" required>
                            <label class="form-label" for="email">Email address</label>
                        </div>

                        <div class="form-group">
                            <input type="password" id="password" name="password" class="form-control" required>
                            <label class="form-label" for="password">Password</label>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" name='submit' class="btn btn-primary text-center">Login</button>
                        <p class="mt-2">Not a member? <a data-bs-dismiss="modal" data-bs-toggle="modal"
                                href="#registerForm">Register</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Register Form -->
    <div class="modal fade" id="registerForm">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Register Form</h5>
                    <button type="button" class="close" data-bs-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="modal-content animate" action="register.php" method="POST">
                    <div class="modal-body">
                        <div class="form-group row mb-2">
                            <label for="fullname" class="col-sm-2 col-form-label">Full Name</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="Enter your fullname"
                                    name="fullname" required>
                            </div>
                        </div>

                        <div class="form-group row mb-2">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="email" placeholder="Enter your email" name="email"
                                    required>
                            </div>
                        </div>

                        <div class="form-group row mb-2">
                            <label for="phone" class="col-sm-2 col-form-label">Contact</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="tel" name="phone" id="phone"
                                    placeholder="Enter your contact number" minlength="10" maxlength="11" required>
                            </div>
                        </div>

                        <div class="form-group row mb-2">
                            <label for="password" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="password" placeholder="Enter your password"
                                    name="password" required>
                            </div>
                        </div>

                        <div class="form-group row mb-2">
                            <label for="dob" class="col-sm-2 col-form-label">Date of Birth</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="date" name="dob" required>
                            </div>
                        </div>

                        <div class="form-group row mb-2">
                            <label for="gender" class="col-sm-2 col-form-label">Gender</label>
                            <div class="col-sm-10">
                                <select class="form-select" name="gender" required>
                                    <option selected disabled>Select your gender</option>
                                    <option value="Female">Female</option>
                                    <option value="Male">Male</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" name='submit' class="btn btn-primary text-center">Register</button>
                        <p class="mt-2">Already a member? <a data-bs-dismiss="modal" data-bs-toggle="modal"
                                href="#loginForm">Login</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</nav>