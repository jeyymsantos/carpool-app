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

                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">My e-Wallet</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="<?= $home ?>" class="text-muted">Home</a></li>
                            <li class="breadcrumb-item text-muted active" aria-current="page">Cash In</li>
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
                        <h4 class="card-title">Cash In</h4>
                        <h6 class="card-subtitle pb-3"> Cash In on your e-Wallet.</h6>

                        <form action="../config/billing/cash_in.php" method="post">

                            <div class="row">
                                <h3> Cash In </h3>
                                <div class="mb-3 col-6">
                                    <label for="reference" class="form-label"> Reference Number <span class="text-danger">*</span></label>
                                    <input type="text" name="reference" minlength="8" maxlength="8" id="reference" class="form-control" required>
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="mobile_no" class="form-label"> GCash Mobile Number <span class="text-danger">*</span></label>
                                    <input type="text" name="mobile_no" id="mobile_no" minlength="11" maxlength="11" class="form-control" required>
                                </div>
                            </div>

                            <div class="row">

                                <div class="mb-3 col-4">
                                    <label for="amount" class="form-label">Amount</label>
                                    <select class="form-select" name="amount" id="amount" aria-label="Default select example">
                                        <option value="50" selected>₱50.00</option>
                                        <option value="100">₱100.00</option>
                                        <option value="250">₱250.00</option>
                                        <option value="500">₱500.00</option>
                                    </select>
                                </div>

                                <div class="mb-3 col-4">
                                    <label for="tickets" class="form-label">Tickets</label>
                                    <input type="text" value="40" name="tickets" id="tickets" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col">
                                    <button type="submit" class="btn btn-primary"> Cash In </button>
                                </div>
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

    <script>
        $('select').on('change', function() {
            if (this.value == '50') {
                $("#tickets").val('40');

            } else if (this.value == '100') {
                $("#tickets").val('80');
            } else if (this.value == '250') {
                $("#tickets").val('200');
            } else {
                $("#tickets").val('450');
            }
        });
    </script>