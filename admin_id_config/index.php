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

// Retrieves Pending Car Approval
$sql = "SELECT * FROM users WHERE user_id_type = 'Driver\'s License' AND user_id_confirmed_at IS NULL AND user_id_rejected = 0";
$result = $connection->query($sql);

require '../admin_components/head.php';
?>
<title>Sabay App | Pending Cars </title>

<!-- Insert Topbar -->
<?php
require '../admin_components/topbar.php';
require '../admin_components/sidebar.php';

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

                <?php require '../admin_components/modal.php'; ?>

                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Drivers Administration</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="<?= $home ?>" class="text-muted">Home</a></li>
                            <li class="breadcrumb-item text-muted active" aria-current="page">Pending Drivers</li>
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
                        <h4 class="card-title">Pending Driver Approval</h4>
                        <h6 class="card-subtitle">The list below are the pending users that needs to be approved as a driver in order for the user to do cash out and register a car.</h6>
                        <div class="table-responsive">
                            <table id="zero_config" class="table border table-striped table-bordered text-nowrap">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th scope="col" class="text-center">ID Type</th>
                                        <th scope="col" class="text-center">ID No</th>
                                        <th scope="col" class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    if ($result->num_rows > 0) :
                                        $x = 1;
                                        while ($row = $result->fetch_assoc()) :
                                    ?>
                                            <tr>
                                                <td class="text-center"><?= $x ?></td>
                                                <td class="text-center"> <?= $row['user_fname'] . " " . $row['user_lname'] ?> </td>
                                                <td class="text-center"> <?= $row['user_email'] ?> </td>
                                                <td class="text-center"> <?= $row['user_id_type'] ?> </td>
                                                <td class="text-center"> <?= $row['user_id_number'] ?> </td>
                                                <td class="text-center">
                                                    <a href="id_approve.php?user_id=<?= $row['user_id'] ?>&user_id=<?= $row['user_id'] ?>" class="btn btn-success"> Approve </a>
                                                    <a href="id_reject.php?user_id=<?= $row['user_id'] ?>&user_id=<?= $row['user_id'] ?>" class="btn btn-danger"> Reject </a>

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
    include_once '../admin_components/foot.php';
    ?>