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

// Retrieves Pending Car Approval
$sql = "SELECT * FROM cars INNER JOIN users ON cars.user_id = users.user_id WHERE car_confirmed_at IS NULL AND car_rejected = 0;";
$result = $connection->query($sql);

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
                            <li class="breadcrumb-item text-muted active" aria-current="page">Register a Car</li>
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
                        <h4 class="card-title">Register a Car</h4>
                        <h6 class="card-subtitle pb-3"> Register or add a car on your profile.</h6>

                        <!-- Car Registration -->
                        <form action="../config/car_register.php" method="post">

                            <h4> Office Details </h4>
                            <div class="row">
                                <div class="mb-3 col-8">
                                    <label for="field_office" class="form-label"> Field Office <span class="text-danger">*</span></label>
                                    <input type="text" maxlength="100" name="field_office" id="field_office" class="form-control" required>
                                </div>
                                <div class="mb-3 col-4">
                                    <label for="office_code" class="form-label">Field Office Code<span class="text-danger">*</span></label>
                                    <input type="text" minlength="4" maxlength="4" name="office_code" id="office_code" class="form-control" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label for="receipt_no" class="form-label"> Receipt No. <span class="text-danger">*</span></label>
                                    <input type="text" maxlength="30" name="receipt_no" id="receipt_no" class="form-control" required>
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="tin_no" class="form-label">TIN<span class="text-danger">*</span></label>
                                    <input type="text" placeholder="000-000-000-000" minlength="15" maxlength="15" name="tin_no" id="tin_no" class="form-control" required>
                                </div>
                            </div>

                            <br>
                            <h4> Car Details </h4>

                            <div class="row">
                                <div class="mb-3 col-4">
                                    <label for="plate_no" class="form-label">Car Plate No. <span class="text-danger">*</span></label>
                                    <input type="text" name="plate_no" id="plate_no" class="form-control" required placeholder="XXX-9999" minlength="8" maxlength="8">
                                </div>
                                <div class="mb-3 col-4">
                                    <label for="model" class="form-label">Car Model <span class="text-danger">*</span></label>
                                    <input type="text" name="model" maxlength="20" id="model" class="form-control" required>
                                </div>
                                <div class="mb-3 col-4">
                                    <label for="color" class="form-label">Car Color <span class="text-danger">*</span></label>
                                    <input type="text" maxlength="20" name="color" id="color" class="form-control" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-4">
                                    <label for="brand" class="form-label">Car Brand <span class="text-danger">*</span></label>
                                    <input type="text" maxlength="20" name="brand" id="brand" class="form-control" required>
                                </div>

                                <div class="mb-3 col-4">
                                    <label for="classification" class="form-label">Car Classification <span class="text-danger">*</span></label>
                                    <select class="form-select" name="classification" id="classification" aria-label="Default select example" required>
                                        <option value="Public" selected> Public </option>
                                        <option value="Private">Private</option>
                                    </select>
                                </div>

                                <div class="mb-3 col-4">
                                    <label for="engine" class="form-label">Car Engine No <span class="text-danger">*</span></label>
                                    <input type="text" maxlength="20" name="engine" id="engine" class="form-control" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-4">
                                    <label for="chassis" class="form-label">Car Chassis No <span class="text-danger">*</span></label>
                                    <input type="text" minlength="17" maxlength="17" name="chassis" id="chassis" class="form-control" required>
                                </div>

                                <div class="mb-3 col-4">
                                    <label for="car_year" class="form-label">Car Year <span class="text-danger">*</span></label>
                                    <input type="text" minlength="4" maxlength="4" name="car_year" id="car_year" class="form-control" required>
                                </div>

                                <div class="mb-3 col-4">
                                    <label for="car_type" class="form-label">Car Type <span class="text-danger">*</span></label>
                                    <select class="form-select" name="car_type" id="car_type" aria-label="Default select example" required>
                                        <option value="Sedan" selected> Sedan </option>
                                        <option value="Hatchback"> Hatchback </option>
                                        <option value="Coupe"> Coupe </option>
                                        <option value="Sports Utility Vehicle (SUV)"> Sports Utility Vehicle (SUV) </option>
                                        <option value="Multi-Purpose Vehicle (MPV)"> Multi-Purpose Vehicle (MPV) </option>
                                        <option value="Asian Utility Vehicle (AUV)"> Asian Utility Vehicle (AUV) </option>
                                        <option value="Crossover"> Crossover </option>
                                        <option value="Pick-Up Truck"> Pick-Up Truck </option>
                                        <option value="Van"> Van </option>
                                        <option value="Convertible Car"> Convertible Car </option>

                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-4">
                                    <label for="car_category" class="form-label">Car Category <span class="text-danger">*</span></label>
                                    <select class="form-select" name="car_category" id="car_category" aria-label="Default select example" required>
                                        <option value="Passenger Car" selected> Passenger Car </option>
                                        <option value="Trucks"> Trucks </option>
                                        <option value="Buses"> Buses </option>
                                        <option value="Trailers"> Trailers </option>
                                        <option value="Motorcycles"> Motorcycles </option>
                                    </select>

                                </div>

                                <div class="mb-3 col-4">
                                    <label for="car_fuel" class="form-label">Car Fuel <span class="text-danger">*</span></label>
                                    <select class="form-select" name="car_fuel" id="car_fuel" aria-label="Default select example" required>
                                        <option value="Gasoline" selected> Gasoline </option>
                                        <option value="Diesel">Diesel</option>
                                        <option value="Biodiesel">Biodiesel</option>
                                        <option value="Ethanol">Ethanol</option>
                                        <option value="Methanol">Methanol</option>
                                    </select>
                                </div>

                                <div class="mb-3 col-4">
                                    <label for="car_renewal" class="form-label">Car Renewal Date <span class="text-danger">*</span></label>
                                    <input type="date" name="car_renewal" id="car_renewal" class="form-control" required>
                                </div>
                            </div>

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