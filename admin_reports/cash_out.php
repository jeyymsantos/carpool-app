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
$sql = "SELECT * FROM transactions
INNER JOIN users
ON transactions.user_id = users.user_id
WHERE 
trans_verified_at IS NOT NULL 
AND trans_rejected = 0 
AND trans_type = 'Cash Out' 
AND DATE(trans_verified_at) = CURDATE() 
ORDER BY trans_verified_at DESC;
";
$result = $connection->query($sql);

require '../admin_components/head.php';
?>
<title>Sabay App | Cash Out Transaction Reports </title>

<!-- Insert Topbar -->
<?php
require '../admin_components/topbar.php';
require '../admin_components/sidebar.php';

if (!empty($_SESSION['message'])) {
    $message = $_SESSION['message'];
    $bg = $_SESSION['bg'];
    $title = $_SESSION['title'];
}

$cash_out = 0.00;
$pro_fee = 0.00;
?>


<div class="page-wrapper" >
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">

                <?php require '../admin_components/modal.php'; ?>

                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Cash In Transactions</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="<?= $home ?>" class="text-muted">Home</a></li>
                            <li class="breadcrumb-item text-muted active" aria-current="page">Cash In Reports</li>
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
                        <h4 class="card-title">Cash In Transaction Reports</h4>
                        <h6 class="card-subtitle">The list below are the pending users that needs to be approved as a driver in order for the user to do cash out and register a car.</h6>
                        <div class="table-responsive">
                            <table id="zero_config" class="table border table-striped table-bordered text-nowrap">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center">#</th>
                                        <th scope="col" class="text-center">Name</th>
                                        <th scope="col" class="text-center">Amount</th>
                                        <th scope="col" class="text-center">Processing Fee</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    if ($result->num_rows > 0) :
                                        $x = 1;
                                        while ($row = $result->fetch_assoc()) :
                                            $cash_out = $cash_out + $row['trans_amount'];
                                            $pro_fee = $pro_fee + $row['trans_fee'];
                                    ?>
                                            <tr>
                                                <th class="text-center"> <?= $x ?> </th>
                                                <td class="text-center"> <?= $row['user_fname'] . " " . $row['user_lname'] ?> </td>
                                                <td class="text-center"> <?= $row['trans_amount'] ?> </td>
                                                <td class="text-center"> <?= $row['trans_fee'] ?> </td>
                                            </tr>
                                    <?php
                                            $x++;
                                        endwhile;
                                    endif;
                                    ?>
                                </tbody>

                                <tfoot>
                                    <tr>
                                        <th colspan="2" class="text-end"> Total: </th>
                                        <td class="text-center"> <?= number_format((float)$cash_out, 2, '.', ''); ?> </td>
                                        <td class="text-center"> <?= number_format((float)$pro_fee, 2, '.', ''); ?> </td>
                                    </tr>
                                </tfoot>
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