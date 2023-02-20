<?php
include("adminSession.php");
include("adminHeader.php");
include("adminSide.php");
include('../config.php');

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    $adminID = intval($adminID);

    if (
        isset($email, $currentPassword,
        $newPassword) && !empty($email) && !empty($currentPassword)
        && !empty($newPassword)
    ) {
        $email = filter_var(trim($email, FILTER_VALIDATE_EMAIL));

        $sql = "SELECT admin_id FROM admin WHERE admin_id = '$adminID' and admin_password = '$currentPassword'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_affected_rows($conn) == 0) {
            echo "<script>alert('Your current password is wrong. Please try again.');</script>";

        } else {
            $sql = "UPDATE admin SET admin_email = '$email', admin_password = '$newPassword' WHERE admin_ID = '$adminID'";

            if (!mysqli_query($conn, $sql)) {
                die('Error: ' . mysqli_error($conn));
            } else {
                echo '<script>alert("Profile updated.");</script>';
            }
        }
    }
}

$selectOrder_sql = 'SELECT * from admin WHERE admin_id = ' . $adminID;
$rs = mysqli_query($conn, $selectOrder_sql);
$row = mysqli_fetch_assoc($rs);
?>

<body>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Edit Profile</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="adminHome.php">Home</a></li>
                    <li class="breadcrumb-item active">Profile</li>
                </ol>
            </nav>
        </div>

        <section class="section profile">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body pt-3" id="editProfile">
                            <form method="POST">
                                <div class="row mb-3">
                                    <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="email" type="email" class="form-control" id="email"
                                            value="<?php echo $row['admin_email']; ?>">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current
                                        Password</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="currentPassword" type="password" class="form-control"
                                            id="currentPassword">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New
                                        Password</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="newPassword" type="password" class="form-control" id="newPassword">
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary" name='submit'>Save Changes</button>
                                    <button type="button" class="btn btn-primary"
                                        onclick="window.location.href = 'adminHome.php'; return false;">Cancel</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>