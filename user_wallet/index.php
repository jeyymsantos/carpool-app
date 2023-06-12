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
$car_sql = "SELECT * FROM transactions INNER JOIN users ON transactions.user_id = users.user_id WHERE users.user_id='$id' AND transactions.trans_type='Cash In' OR transactions.trans_type='Cash Out' ";
$car_result = $connection->query($car_sql);

require '../user_components/head.php';
?>
<title>Sabay App | Cash Transactions </title>

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

                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">My e-Wallet</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="<?= $home ?>" class="text-muted">Home</a></li>
                            <li class="breadcrumb-item text-muted active" aria-current="page">View My Transactions</li>
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
                        <h4 class="card-title">My Transactions</h4>
                        <h6 class="card-subtitle">The list below allows user to view their cash in and cash out transactions.</h6>
                        <div class="table-responsive">
                            <table id="zero_config" class="table border table-striped table-bordered text-nowrap">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>Gcash Number</th>
                                        <th>Reference Number</th>
                                        <th>Amount</th>
                                        <th>Date & Time</th>
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
                                                <td class="text-center"><?= $row['user_fname'] . " " . $row['user_lname'] ?></td>
                                                <td class="text-center"> <?= $car['trans_type'] ?> </td>
                                                <td class="text-center"> <?= $car['trans_gcash_no'] ?> </td>
                                                <td class="text-center"> <?= $car['trans_reference_no'] ?> </td>
                                                <td class="text-center"> <?= $car['trans_amount'] ?> </td>
                                                <td class="text-center"> <?= $car['trans_created_at'] ?> </td>
                                                <td class="text-center">

                                                    <?php
                                                    if ($car['trans_rejected'] == 1) :
                                                    ?>
                                                        <p class="text-danger align-center"> Rejected </p>


                                                    <?php else : ?>
                                                        <a class="btn btn-primary"> Approved </a>
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