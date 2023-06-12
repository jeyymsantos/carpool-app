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

// Retrieves Pending Transactions
$sql = "SELECT * FROM transactions INNER JOIN users ON transactions.user_id = users.user_id
WHERE trans_verified_at IS NULL AND trans_rejected = 0;";
$result = $connection->query($sql);

require '../components/head.php';
?>
<title>Sabay App | Pending Cars </title>

<!-- Insert Topbar -->
<?php
require '../components/topbar.php';
require '../components/sidebar.php';

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

                <?php require '../components/modal.php'; ?>

                <!-- Full width modal -->
                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#login-modal">Log in Modal</button>
                <!-- SignIn modal content -->
                <div id="login-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="login-modal-label">Add Reference</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                            </div>
                            <div class="modal-body">

                                <form action="#" class="ps-3 pe-3">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="emailaddress1">GCash Reference Number <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text"  minlength="8" maxlength="8" id="emailaddress1" required placeholder="XXXXXXXX">
                                    </div>

                                    <div class="form-group mb-3 text-center">
                                        <button class="btn btn-rounded btn-primary" type="submit">Proceed</button>
                                    </div>

                                </form>

                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->


                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Wallet Configuration</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="<?= $home ?>" class="text-muted">Home</a></li>
                            <li class="breadcrumb-item text-muted active" aria-current="page">Pending Transactions</li>
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
                        <h4 class="card-title">Pending Transactions</h4>
                        <h6 class="card-subtitle">The list below are the pending transactions that needs to be approved.</h6>
                        <div class="table-responsive">
                            <table id="zero_config" class="table border table-striped table-bordered text-nowrap">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Type</th>
                                        <th>Reference No</th>
                                        <th>GCash Number</th>
                                        <th>Amount</th>
                                        <th>Conversion Fee</th>
                                        <th>Processing Fee</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    if ($result->num_rows > 0) :
                                        $x = 1;
                                        while ($row = $result->fetch_assoc()) :
                                    ?>
                                            <tr>
                                                <th class="text-center"> <?= $x ?> </th>
                                                <td class="text-center"> <?= $row['user_fname'] . " " . $row['user_lname'] ?> </td>
                                                <td class="text-center"> <?= $row['user_email'] ?> </td>
                                                <td class="text-center"> <?= $row['trans_type'] ?> </td>
                                                <td class="text-center"> <?= $row['trans_reference_no'] ?> </td>
                                                <td class="text-center"> <?= $row['trans_gcash_no'] ?> </td>
                                                <td class="text-center"> <?= $row['trans_amount'] ?> </td>
                                                <td class="text-center"> <?= $row['trans_type'] == 'Cash In' ? $row['trans_fee'] : '0' ?> </td>
                                                <td class="text-center"> <?= $row['trans_type'] == 'Cash Out' ? $row['trans_fee'] : '0' ?> </td>
                                                <td class="text-center">

                                                    <?php
                                                    if ($row['trans_type'] == 'Cash Out') :
                                                    ?>
                                                        <a href="wallet_cashout.php?trans_id=<?= $row['trans_id'] ?>&user_id=<?= $row['user_id'] ?>&fee=<?= $row['trans_fee'] ?>&type=<?= $row['trans_type'] ?>&amount=<?= $row['trans_amount'] ?>" class="btn btn-dark"> Add Reference </a>

                                                    <?php
                                                    else :
                                                    ?>
                                                        <a href="wallet_approve.php?trans_id=<?= $row['trans_id'] ?>&user_id=<?= $row['user_id'] ?>&fee=<?= $row['trans_fee'] ?>&type=<?= $row['trans_type'] ?>&amount=<?= $row['trans_amount'] ?>" class="btn btn-success"> Approve </a>
                                                    <?php endif; ?>

                                                    <a href="wallet_reject.php?trans_id=<?= $row['trans_id'] ?>" class="btn btn-danger"> Reject </a>
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