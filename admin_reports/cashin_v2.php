<?php

include '../includes/connection.php';
include_once '../includes/auth.php';

$now = new DateTime();
$now->setTimezone(new DateTimeZone('Asia/Manila'));
$timestamp = $now->format('Y-m-d');

$sql = "SELECT * FROM transactions
INNER JOIN users
ON transactions.user_id = users.user_id
WHERE 
trans_verified_at IS NOT NULL 
AND trans_rejected = 0 
AND trans_type = 'Cash In' 
AND DATE(trans_verified_at) = CURDATE() 
ORDER BY trans_verified_at DESC;
";
$result = $connection->query($sql);

$bal_sum = "SELECT SUM(user_balance) AS bal_total FROM users;";
$bal_result = $connection->query($bal_sum);
$bal_row = $bal_result->fetch_assoc();

if (!empty($_SESSION['message'])) {
    $message = $_SESSION['message'];
    $bg = $_SESSION['bg'];
}

$cash_in = 0.00;
$con_fee = 0.00;

?>


<div class="page-wrapper" style="background-color: #FBEDFF">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">

                <?php require '../components/modal.php'; ?>

                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Cash In Requests
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
    include_once '../components/foot.php';
    ?>