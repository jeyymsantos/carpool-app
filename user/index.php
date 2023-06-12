<?php

include '../includes/connection.php';
include_once '../includes/auth.php';

if (!empty($_SESSION['message'])) {
    $message = $_SESSION['message'];
    $bg = $_SESSION['bg'];
}

// Retrieves User
$sql = "SELECT * FROM users WHERE user_id=$id";
$result = $connection->query($sql);
$row = $result->fetch_assoc();

// Retrieves Cars
$car_sql = "SELECT * FROM cars WHERE user_id = '$id' ORDER BY car_id DESC";
$car_result = $connection->query($car_sql);

// Check if the Account is Verified or Not
if (is_null($row['user_verified_at'])) {
    $_SESSION['bg'] =  "warning";
    $_SESSION['message'] = "Your account is not yet verified. Check your email to verify account!";
    header('Location: ' . $home . '/login.php');
    return;
}

if (!empty($_SESSION['message'])) {
    $message = $_SESSION['message'];
    $bg = $_SESSION['bg'];
}

$type = $row['user_type'];
$fname = $row['user_fname'];
$mname = $row['user_mname'];
$lname = $row['user_lname'];
$contact_no = $row['user_contact_no'];
$barangay = $row['user_barangay'];
$city = $row['user_city'];
$province = $row['user_province'];
$verification = $row['user_verified_at'];
$creation = $row['user_created_at'];

// IDs
$id_type = $row['user_id_type'];
$id_number = $row['user_id_number'];
$id_rejected = $row['user_id_rejected'];
$id_confirmation = $row['user_id_confirmed_at'];

// User Balance
$balance = $row['user_balance'];





include_once '../user_components/head.php';
?>

<title>Sabay App | Admin Panel </title>

<!-- Insert Topbar -->
<?php
include '../user_components/topbar.php';
include '../user_components/sidebar.php';
?>

<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Howdy, <?= $row['user_fname'] ?>!</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item">Dashboard
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6 col-lg-3">
                <div class="card border-end ">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <h2 class="text-dark mb-1 w-100 text-truncate font-weight-medium"><?= $balance ?></h2>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Available Bits
                                </h6>
                            </div>
                            <div class="ms-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i data-feather="code"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3">
                <div class="card border-end">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <div class="d-inline-flex align-items-center">
                                    <h2 class="text-dark mb-1 font-weight-medium"><?= $car_result->num_rows ?> </h2>

                                </div>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Total Cars
                                </h6>
                            </div>
                            <div class="ms-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i data-feather="hard-drive"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3">
                <div class="card border-end ">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <div class="d-inline-flex align-items-center">
                                    <h2 class="text-dark mb-1 font-weight-medium"> <?= $id_type == 'Driver\'s License' ? 'Driver' : 'Passenger' ?> </h2>

                                    <?php
                                    if ($id_type == 'Driver\'s License') :
                                    ?>
                                        <span class="badge bg-<?= $id_rejected == 1 ? 'danger' : ($id_confirmation == null ? 'warning' : 'success') ?> font-12 text-white font-weight-medium rounded-pill ms-2 d-md-none d-lg-block">
                                            <?= $id_rejected == 1 ? 'Rejected' : ($id_confirmation == null ? 'Pending' : 'Approved') ?>
                                        </span>

                                    <?php
                                    endif;
                                    ?>
                                </div>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">ID Status
                                </h6>
                            </div>
                            <div class="ms-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i data-feather="file-plus"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <?php
    include_once '../user_components/foot.php';
    ?>