<?php
include('config.php');

$query = "SELECT doctor_id, doctor_name FROM doctor WHERE doctor_status = 'Active' ";
$results = mysqli_query($conn, $query);
if (mysqli_affected_rows($conn) > 0) {
    $options = mysqli_fetch_all($results, MYSQLI_ASSOC);
}

if (isset($_POST['submit'])) {
    if (isset($_SESSION['patient_id'])) {
        $patient_id = $_SESSION['patient_id'];
        $userid = intval($patient_id);
        $appointment_date = $_POST['appointment_date'];
        $appointment_time = $_POST['appointment_time'];
        $doctor_id = $_POST['doctor_id'];
        $appointment_reason = $_POST['appointment_reason'];
        $appointment_status = $_POST['appointment_status'];
    
        if (
            isset($appointment_date, $doctor_id, $appointment_reason, $appointment_time)
            && !empty($appointment_date) && !empty($doctor_id) && !empty($appointment_reason) && !empty($appointment_time)
        ) {
            $appointment_reason = filter_var(trim($appointment_reason, FILTER_SANITIZE_STRING));
    
            $checkAppointmentsql = "SELECT appointment_id FROM appointment WHERE appointment_date = '$appointment_date' and appointment_time = '$appointment_time' and doctor_id = '$doctor_id'
            and appointment_status = 'Active'";
            $result = mysqli_query($conn, $checkAppointmentsql);
    
            if (mysqli_affected_rows($conn) == 1) {
                echo '<script>alert("This time slot has been booked. Please choose other time slot."); window.location.href = "#appointment";</script>';
    
            } else {
                $sql = "INSERT INTO appointment(doctor_id, patient_id, appointment_date, appointment_time, appointment_reason, appointment_status)
                VALUES ('$doctor_id', $userid, '$appointment_date', '$appointment_time', '$appointment_reason', '$appointment_status')";
                
                if (!mysqli_query($conn, $sql)) {
                    die('Error: ' . mysqli_error($conn));
                } else {
                    echo '<script>alert("You have successfully made the appointment."); window.location.href = "allAppointments.php";</script>';
                }
            }
    
        }

    } else {
        echo '<script>alert("You have have to login before make an appointment."); window.location.href = "#appointment"; </script>';
    }
    mysqli_close($conn);
}
?>

<section class="p-3 bg-light p-sm-4 mt-3" id="appointment">
    <div class="fs-3 fw-bold text-black text-center mb-3 mt-5">Make an Appointment</div>
    <p class="lead fw-normal text-muted mb-5 text-center">We always fully focused on helping you to overcome any hurdle.
        Make your appointment now.</p>
    <div class="mx-5 mb-5">
        <div class="card">
            <div class="card-body m-4">
                <form method="POST">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="appointment_date">Appointment Date</label>
                            <input type="date" class="form-control mt-2" id="appointment_date" name="appointment_date" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="appointment_time">Appointment Time</label>
                            <select class="form-control mt-2" name="appointment_time" required>
                                <option selected disabled>Select a time</option>
                                <option value="10:00:00">10:00:00</option>
                                <option value="10:30:00">10:30:00</option>
                                <option value="11:00:00">11:00:00</option>
                                <option value="11:30:00">11:30:00</option>
                                <option value="12:00:00">12:00:00</option>
                                <option value="12:30:00">12:30:00</option>
                                <option value="13:00:00">13:00:00</option>
                                <option value="13:30:00">13:30:00</option>
                                <option value="14:00:00">14:00:00</option>
                                <option value="14:30:00">14:30:00</option>
                                <option value="15:00:00">15:00:00</option>
                                <option value="15:30:00">15:30:00</option>
                                <option value="16:00:00">16:00:00</option>
                                <option value="16:30:00">16:30:00</option>
                                <option value="17:00:00">17:00:00</option>
                                <option value="17:30:00">17:30:00</option>
                                <option value="18:00:00">18:00:00</option>
                                <option value="18:30:00">18:30:00</option>
                                <option value="19:00:00">19:00:00</option>
                                <option value="19:30:00">19:30:00</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="form-group col-md-12">
                            <label for="doctor_id" class="mt-2">Doctor Preferred</label>
                            <select class="form-control mt-2" name="doctor_id" required>
                                <option selected disabled>Select a doctor</option>
                                <?php
                                foreach ($options as $option) {
                                    ?>
                                    <option value='<?php echo $option["doctor_id"]; ?>'><?php echo $option['doctor_name']; ?>
                                    </option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="form-group col-md-12">
                            <label for="appointment_date" class="mt-2">Reason of Appointment</label>
                            <textarea name="appointment_reason" id="appointment_reason" class="form-control mt-2"
                                required></textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="appointment_status" class="mt-2" hidden>Appointment
                                Status</label>
                            <select class="form-control mt-2" name="appointment_status" hidden>
                                <option selected>Active</option>
                                <option>Cancelled</option>
                            </select>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-dark" name='submit'>Make Appointment</button>
                </form>
            </div>
        </div>
    </div>
</section>

<script language="javascript">
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0');
    var yyyy = today.getFullYear();

    today = yyyy + '-' + mm + '-' + dd;
    $('#appointment_date').attr('min',today);
</script>