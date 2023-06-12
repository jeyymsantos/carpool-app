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

        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-4">
                            <h4 class="card-title">Top Leaders</h4>
                            <div class="ms-auto">
                                <div class="dropdown sub-dropdown">
                                    <button class="btn btn-link text-muted dropdown-toggle" type="button" id="dd1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i data-feather="more-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd1">
                                        <a class="dropdown-item" href="#">Insert</a>
                                        <a class="dropdown-item" href="#">Update</a>
                                        <a class="dropdown-item" href="#">Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table no-wrap v-middle mb-0">
                                <thead>
                                    <tr class="border-0">
                                        <th class="border-0 font-14 font-weight-medium text-muted">Team Lead
                                        </th>
                                        <th class="border-0 font-14 font-weight-medium text-muted px-2">Project
                                        </th>
                                        <th class="border-0 font-14 font-weight-medium text-muted">Team</th>
                                        <th class="border-0 font-14 font-weight-medium text-muted text-center">
                                            Status
                                        </th>
                                        <th class="border-0 font-14 font-weight-medium text-muted text-center">
                                            Weeks
                                        </th>
                                        <th class="border-0 font-14 font-weight-medium text-muted">Budget</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="border-top-0 px-2 py-4">
                                            <div class="d-flex no-block align-items-center">
                                                <div class="me-3"><img src="../user_components/backend/assets/images/users/widget-table-pic1.jpg" alt="user" class="rounded-circle" width="45" height="45" /></div>
                                                <div class="">
                                                    <h5 class="text-dark mb-0 font-16 font-weight-medium">Hanna
                                                        Gover</h5>
                                                    <span class="text-muted font-14">hgover@gmail.com</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="border-top-0 text-muted px-2 py-4 font-14">Elite Admin</td>
                                        <td class="border-top-0 px-2 py-4">
                                            <div class="popover-icon">
                                                <a class="btn btn-primary rounded-circle btn-circle font-12" href="javascript:void(0)">DS</a>
                                                <a class="btn btn-danger rounded-circle btn-circle font-12 popover-item" href="javascript:void(0)">SS</a>
                                                <a class="btn btn-cyan rounded-circle btn-circle font-12 popover-item" href="javascript:void(0)">RP</a>
                                                <a class="btn btn-success text-white rounded-circle btn-circle font-20" href="javascript:void(0)">+</a>
                                            </div>
                                        </td>
                                        <td class="border-top-0 text-center px-2 py-4"><i class="fa fa-circle text-primary font-12" data-bs-toggle="tooltip" data-placement="top" title="In Testing"></i></td>
                                        <td class="border-top-0 text-center font-weight-medium text-muted px-2 py-4">
                                            35
                                        </td>
                                        <td class="font-weight-medium text-dark border-top-0 px-2 py-4">$96K
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-2 py-4">
                                            <div class="d-flex no-block align-items-center">
                                                <div class="me-3"><img src="../user_components/backend/assets/images/users/widget-table-pic2.jpg" alt="user" class="rounded-circle" width="45" height="45" /></div>
                                                <div class="">
                                                    <h5 class="text-dark mb-0 font-16 font-weight-medium">Daniel
                                                        Kristeen
                                                    </h5>
                                                    <span class="text-muted font-14">Kristeen@gmail.com</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-muted px-2 py-4 font-14">Real Homes WP Theme</td>
                                        <td class="px-2 py-4">
                                            <div class="popover-icon">
                                                <a class="btn btn-primary rounded-circle btn-circle font-12" href="javascript:void(0)">DS</a>
                                                <a class="btn btn-danger rounded-circle btn-circle font-12 popover-item" href="javascript:void(0)">SS</a>
                                                <a class="btn btn-success text-white rounded-circle btn-circle font-20" href="javascript:void(0)">+</a>
                                            </div>
                                        </td>
                                        <td class="text-center px-2 py-4"><i class="fa fa-circle text-success font-12" data-bs-toggle="tooltip" data-placement="top" title="Done"></i>
                                        </td>
                                        <td class="text-center text-muted font-weight-medium px-2 py-4">32</td>
                                        <td class="font-weight-medium text-dark px-2 py-4">$85K</td>
                                    </tr>
                                    <tr>
                                        <td class="px-2 py-4">
                                            <div class="d-flex no-block align-items-center">
                                                <div class="me-3"><img src="../user_components/backend/assets/images/users/widget-table-pic3.jpg" alt="user" class="rounded-circle" width="45" height="45" /></div>
                                                <div class="">
                                                    <h5 class="text-dark mb-0 font-16 font-weight-medium">Julian
                                                        Josephs
                                                    </h5>
                                                    <span class="text-muted font-14">Josephs@gmail.com</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-muted px-2 py-4 font-14">MedicalPro WP Theme</td>
                                        <td class="px-2 py-4">
                                            <div class="popover-icon">
                                                <a class="btn btn-primary rounded-circle btn-circle font-12" href="javascript:void(0)">DS</a>
                                                <a class="btn btn-danger rounded-circle btn-circle font-12 popover-item" href="javascript:void(0)">SS</a>
                                                <a class="btn btn-cyan rounded-circle btn-circle font-12 popover-item" href="javascript:void(0)">RP</a>
                                                <a class="btn btn-success text-white rounded-circle btn-circle font-20" href="javascript:void(0)">+</a>
                                            </div>
                                        </td>
                                        <td class="text-center px-2 py-4"><i class="fa fa-circle text-primary font-12" data-bs-toggle="tooltip" data-placement="top" title="Done"></i>
                                        </td>
                                        <td class="text-center text-muted font-weight-medium px-2 py-4">29</td>
                                        <td class="font-weight-medium text-dark px-2 py-4">$81K</td>
                                    </tr>
                                    <tr>
                                        <td class="border-bottom-0 px-2 py-4">
                                            <div class="d-flex no-block align-items-center">
                                                <div class="me-3"><img src="../user_components/backend/assets/images/users/widget-table-pic4.jpg" alt="user" class="rounded-circle" width="45" height="45" /></div>
                                                <div class="">
                                                    <h5 class="text-dark mb-0 font-16 font-weight-medium">Jan
                                                        Petrovic
                                                    </h5>
                                                    <span class="text-muted font-14">hgover@gmail.com</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="border-bottom-0 text-muted px-2 py-4 font-14">Hosting Press
                                            HTML</td>
                                        <td class="border-bottom-0 px-2 py-4">
                                            <div class="popover-icon">
                                                <a class="btn btn-primary rounded-circle btn-circle font-12" href="javascript:void(0)">DS</a>
                                                <a class="btn btn-success text-white font-20 rounded-circle btn-circle" href="javascript:void(0)">+</a>
                                            </div>
                                        </td>
                                        <td class="border-bottom-0 text-center px-2 py-4"><i class="fa fa-circle text-danger font-12" data-bs-toggle="tooltip" data-placement="top" title="In Progress"></i></td>
                                        <td class="border-bottom-0 text-center text-muted font-weight-medium px-2 py-4">
                                            23</td>
                                        <td class="border-bottom-0 font-weight-medium text-dark px-2 py-4">$80K
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <?php
    include_once '../user_components/foot.php';
    ?>