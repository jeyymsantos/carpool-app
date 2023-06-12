<?php

include '../includes/connection.php';
include_once '../includes/auth.php';

if (!empty($_SESSION['message'])) {
    $message = $_SESSION['message'];
    $bg = $_SESSION['bg'];
    $title = $_SESSION['title'];
}

// Retrieves User
$sql = "SELECT * FROM users WHERE user_id=$id";
$result = $connection->query($sql);
$row = $result->fetch_assoc();

$trip_id = $_GET['trip_id'];

// Retrieves Trips
$trip_sql = "SELECT * FROM trips
INNER JOIN rates 
ON rates.rate_id = trips.rate_id
INNER JOIN cars 
ON cars.car_id = trips.car_id
INNER JOIN users
ON users.user_id = cars.user_id
WHERE trips.trip_id = $trip_id
ORDER BY trips.trip_id DESC";
$trip_result = $connection->query($trip_sql);
$trip = $trip_result->fetch_assoc();

require '../user_components/head.php';
?>
<title>Sabay App | Book Trip </title>

<!-- Insert Topbar -->
<?php
require '../user_components/topbar.php';
require '../user_components/sidebar.php';

if (!empty($_SESSION['message'])) {
    $message = $_SESSION['message'];
    $bg = $_SESSION['bg'];
    $title = $_SESSION['title'];
}
?>


<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">

                <?php require '../user_components/modal.php'; ?>

                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Book a Trip</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="<?= $home ?>" class="text-muted">Home</a></li>
                            <li class="breadcrumb-item text-muted active" aria-current="page">Book a Trip</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <!-- basic table -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Book a Trip</h4>
                        <h6 class="card-subtitle pb-3"> You may now book a trip. </h6>

                        <table>
                            <thead>
                                <th> </th>
                            </thead>

                            <tbody>

                            </tbody>
                        </table>

                        <!-- Trip Registration -->
                        <form action="../config/trips/book_register.php" method="post">

                            <div class="row">
                                <div class="mb-3 col-md-6 col-sm-12">
                                    <label for="seat" class="form-label"> Select Seat <span class="text-danger">*</span></label>
                                    <select class="form-select" name="seat" id="seat" aria-label="Default select example" required>
                                        <option value="Front Seat" <?= $trip['rate_front_status'] == 'Booked' ? 'disabled' : ''?> > Front Seat (<?= $trip['rate_front_status'] ?>) - <?= $trip['rate_front'] ?></option>
                                        <option value="Left Seat" <?= $trip['rate_left_status'] == 'Booked' ? 'disabled' : ''?> > Left Seat (<?= $trip['rate_left_status'] ?>) - <?= $trip['rate_left'] ?></option>
                                        <option value="Middle Seat" <?= $trip['rate_middle_status'] == 'Booked' ? 'disabled' : ''?> > Middle Seat (<?= $trip['rate_middle_status'] ?>) - <?= $trip['rate_middle'] ?></option>
                                        <option value="Right Seat" <?= $trip['rate_right_status'] == 'Booked' ? 'disabled' : ''?> > Right Seat (<?= $trip['rate_right_status'] ?>) - <?= $trip['rate_right'] ?></option>
                                    </select>
                                </div>
                            </div>

                            <br>
                            <h4> Pickup Location </h4>
                            <div class="row">
                                <div class="mb-3 col-md-4 col-sm-12">
                                    <label for="barangay_start" class="form-label">Barangay <span class="text-danger">*</span></label>
                                    <input type="text" name="barangay_start" id="barangay_start" class="form-control" required>
                                    <input type="hidden" name="rate_id" id="rate_id" class="form-control" value="<?= $trip['rate_id'] ?>">
                                    <input type="hidden" name="trip_id" id="trip_id" class="form-control" value="<?= $trip['trip_id'] ?>">
                                </div>
                                <div class="mb-3 col-md-4 col-sm-12">
                                    <label for="city_start" class="form-label">City <span class="text-danger">*</span></label>
                                    <input type="text" name="city_start" id="city_start" class="form-control" required>
                                </div>
                                <div class="mb-3 col-md-4 col-sm-12">
                                    <label for="province_start" class="form-label">Province <span class="text-danger">*</span></label>
                                    <input type="text" name="province_start" id="province_start" class="form-control" required>
                                </div>
                                <div class="mb-3 col-md-12 col-sm-12">
                                    <label for="description" class="form-label">Other Description <span class="text-danger">*</span></label>
                                    <input type="text" name="description" id="description" class="form-control" required>
                                </div>
                            </div>

                            <div class="col">
                                <button type="submit" class="btn btn-primary">Book Now</button>
                            </div>

                        </form>


                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->

    <?php
    include_once '../user_components/foot.php';
    ?>