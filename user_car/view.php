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
$car_sql = "SELECT * FROM cars WHERE user_id = '$id' ORDER BY car_id DESC";
$car_result = $connection->query($car_sql);

require '../user_components/head.php';
?>
<title>Sabay App | Pending Cars </title>

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

                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">My Cars</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="<?= $home ?>" class="text-muted">Home</a></li>
                            <li class="breadcrumb-item text-muted active" aria-current="page">View My Cars</li>
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
                        <h4 class="card-title">Pending Cars</h4>
                        <h6 class="card-subtitle">The list below are the pending cars that needs to be approved in order for the user to add it on his profile.</h6>
                        <div class="table-responsive">
                            <table id="zero_config" class="table border table-striped table-bordered text-nowrap">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th>#</th>
                                        <th>Car Plate No</th>
                                        <th>Car Model</th>
                                        <th>Car Color</th>
                                        <th>Car Brand</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($result->num_rows > 0) :
                                        $x = 1;
                                        while ($car = $car_result->fetch_assoc()) :
                                    ?>
                                            <tr>
                                                <th class="text-center"> <?= $x ?> </th>
                                                <td class="text-center"> <?= $car['car_plate_no'] ?> </td>
                                                <td class="text-center"> <?= $car['car_model'] ?> </td>
                                                <td class="text-center"> <?= $car['car_color'] ?> </td>
                                                <td class="text-center"> <?= $car['car_brand'] ?> </td>
                                                <td class="text-center">

                                                    <?php
                                                    if ($car['car_rejected'] == 1) :
                                                    ?>
                                                        <p class="text-danger align-center"> Car Rejected </p>

                                                    <?php elseif (is_null($car['car_confirmed_at'])) : ?>
                                                        <p class="text-warning"> Pending for Approval </p>

                                                    <?php else : ?>
                                                        <a class="text-success"> Eligible </a>
                                                    <?php endif; ?>
                                                </td>

                                            </tr>
                                    <?php
                                            $x++;
                                        endwhile;
                                    endif;
                                    ?>
                                </tbody>
                            </table>
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