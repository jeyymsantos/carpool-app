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

// Retrieves Car of User
$car_sql = "SELECT * FROM cars INNER JOIN users ON cars.user_id = users.user_id WHERE car_confirmed_at IS NOT NULL AND users.user_id = $id ORDER BY car_plate_no";
$car_result = $connection->query($car_sql);

require '../user_components/head.php';
?>
<title>Sabay App | My Trips </title>

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

                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">My Trips</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="<?= $home ?>" class="text-muted">Home</a></li>
                            <li class="breadcrumb-item text-muted active" aria-current="page">Register a Trip</li>
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
                        <h4 class="card-title">Register a Trip</h4>
                        <h6 class="card-subtitle pb-3"> Register a trip to start carpooling.</h6>

                        <!-- Car Registration -->
                        <form action="../config/trips/trip_register.php" method="post">

                            <div class="row">
                                <div class="mb-3 col-sm-12 col-md-6">
                                    <label for="datetime" class="form-label"> Date & Time of Trip <span class="text-danger">*</span></label>
                                    <input type="datetime-local" min="today" name="datetime" id="datetime" class="form-control" required>
                                </div>

                                <div class="mb-3 col-md-6 col-sm-12">
                                    <label for="car" class="form-label"> Select Car <span class="text-danger">*</span></label>
                                    <select class="form-select" name="car" id="car" aria-label="Default select example" required>
                                        <?php
                                        if ($result->num_rows > 0) :
                                            while ($car = $car_result->fetch_assoc()) :
                                        ?>
                                                <option value="<?= $car['car_id'] ?>"> <?= $car['car_plate_no'] . ' (' . $car['car_brand'] . ' ' . $car['car_brand']  . ')' ?> </option>
                                        <?php
                                            endwhile;
                                        endif;
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <br>
                            <h4> Start Location of the Trip </h4>
                            <div class="row">
                                <div class="mb-3 col-md-4 col-sm-12">
                                    <label for="barangay_start" class="form-label">Barangay <span class="text-danger">*</span></label>
                                    <input type="text" name="barangay_start" id="barangay_start" class="form-control" required>
                                </div>
                                <div class="mb-3 col-md-4 col-sm-12">
                                    <label for="city_start" class="form-label">City <span class="text-danger">*</span></label>
                                    <input type="text" name="city_start" id="city_start" class="form-control" required>
                                </div>
                                <div class="mb-3 col-md-4 col-sm-12">
                                    <label for="province_start" class="form-label">Province <span class="text-danger">*</span></label>
                                    <input type="text" name="province_start" id="province_start" class="form-control" required>
                                </div>
                            </div>

                            <br>
                            <h4> End Location of the Trip </h4>
                            <div class="row">
                                <div class="mb-3 col-md-4 col-sm-12">
                                    <label for="barangay_end" class="form-label">Barangay <span class="text-danger">*</span></label>
                                    <input type="text" name="barangay_end" id="barangay_end" class="form-control" required>
                                </div>
                                <div class="mb-3 col-md-4 col-sm-12">
                                    <label for="city_end" class="form-label">City <span class="text-danger">*</span></label>
                                    <input type="text" name="city_end" id="city_end" class="form-control" required>
                                </div>
                                <div class="mb-3 col-md-4 col-sm-12">
                                    <label for="province_end" class="form-label">Province <span class="text-danger">*</span></label>
                                    <input type="text" name="province_end" id="province_end" class="form-control" required>
                                </div>
                            </div>

                            <br>
                            <h4> Assigning of Rates </h4>
                            <div class="row">
                                <div class="col-3">
                                    <label for="front_seat" class="form-label">Front Seat <span class="text-danger">*</span></label>
                                    <input type="number" min="40" name="front_seat" id="front_seat" class="form-control" required>
                                </div>

                                <div class="col-3">
                                    <label for="left_seat" class="form-label">Left Seat <span class="text-danger">*</span></label>
                                    <input type="number" min="40" name="left_seat" id="left_seat" class="form-control" required>
                                </div>

                                <div class="col-3">
                                    <label for="middle_seat" class="form-label">Middle Seat <span class="text-danger">*</span></label>
                                    <input type="number" min="40" name="middle_seat" id="middle_seat" class="form-control" required>
                                </div>

                                <div class="col-3">
                                    <label for="right_seat" class="form-label">Right Seat <span class="text-danger">*</span></label>
                                    <input type="number" min="40" name="right_seat" id="right_seat" class="form-control" required>
                                </div>
                            </div>
                            
                            <div id="emailHelp" class="form-text mb-3">Please be advised that there is an additional ₱10.00 charge for every seat rate.</div>

                            <div class="col">
                                <button type="submit" class="btn btn-primary">Register</button>
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