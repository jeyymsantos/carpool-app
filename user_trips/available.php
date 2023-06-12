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

// Retrieves Cars
$trip_sql = "SELECT * FROM trips
INNER JOIN rates 
ON rates.rate_id = trips.rate_id
INNER JOIN cars 
ON cars.car_id = trips.car_id
INNER JOIN users
ON users.user_id = cars.user_id
ORDER BY trips.trip_id DESC";
$trip_result = $connection->query($trip_sql);

require '../user_components/head.php';
?>
<title>Sabay App | Available Trips </title>

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

                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Available Trips</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="<?= $home ?>" class="text-muted">Home</a></li>
                            <li class="breadcrumb-item text-muted active" aria-current="page">View Available Trips</li>
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
                        <h4 class="card-title">My Trips</h4>
                        <h6 class="card-subtitle">The list below are the available trips.</h6>

                        <div class="row">
                            <?php
                            if ($result->num_rows > 0) :
                                while ($trip = $trip_result->fetch_assoc()) :
                            ?>
                                    <div class="col-md-4">
                                        <div class="card h-100">
                                            <div class="card-body d-flex flex-column">
                                                <h4 class="card-title"> <?= $trip['trip_start_barangay'] . ', ' . $trip['trip_start_city'] . ', ' . $trip['trip_start_province']  ?> - <?= $trip['trip_end_barangay'] . ', ' . $trip['trip_end_city'] . ', ' . $trip['trip_end_province']  ?> </h4>
                                                <p class="card-text">
                                                    Driver: <?= $trip['user_fname'] . ' ' . $trip['user_lname'] ?> <br>
                                                    Date & Time: <?= $trip['trip_departure_datetime'] ?> <br>
                                                    Car Details: <?= $trip['car_plate_no'] . ' (' . $trip['car_brand'] . ' ' . $trip['car_brand']  . ')'?>
                                                </p>
                                                
                                                <a href="javascript:void(0)" class="btn btn-info">Book Now</a>
                                            </div>
                                        </div>
                                    </div>

                            <?php
                                endwhile;
                            endif;
                            ?>

                        </div>


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