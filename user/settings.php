<?php

include '../includes/connection.php';
include_once '../includes/auth.php';

if (!empty($_SESSION['message'])) {
    $message = $_SESSION['message'];
    $bg = $_SESSION['bg'];
    $title = $_SESSION['title'];
}

// Selects the Users & Passengers
$sql = "SELECT * FROM users WHERE user_id='$id'";
$result = $connection->query($sql);
$row = $result->fetch_assoc();

if (is_null($row['user_id_confirmed_at'])) {
    $id_confirmed = 'false';
} else {
    $id_confirmed = 'true';
}

require '../user_components/head.php';
?>
<title>Sabay App | Update Profile </title>

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

                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">My Profile</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="<?= $home ?>" class="text-muted">Home</a></li>
                            <li class="breadcrumb-item text-muted active" aria-current="page">Profile Update</li>
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
                        <h4 class="card-title">Update Profile</h4>
                        <h6 class="card-subtitle pb-3">You may update your profile</h6>
                        <form action="../config/update_process.php" method="post">

                            

                            <div class="row">
                                <h3> Personal Details </h3>
                                <div class="mb-3 col-4">
                                    <label for="fname" class="form-label">First Name <span class="text-danger">*</span></label>
                                    <input type="text" name="fname" id="fname" class="form-control" required value="<?= $row['user_fname'] ?>" <?= $id_confirmed == 'true' ? 'readonly' : '' ?>>
                                </div>
                                <div class="mb-3 col-4">
                                    <label for="mname" class="form-label">Middle Name</label>
                                    <input type="text" name="mname" id="mname" class="form-control" value="<?= $row['user_mname'] ?>" <?= $id_confirmed == 'true' ? 'readonly' : '' ?>>
                                </div>
                                <div class="mb-3 col-4">
                                    <label for="lname" class="form-label">Last Name <span class="text-danger">*</span></label>
                                    <input type="text" name="lname" id="lname" class="form-control" required value="<?= $row['user_lname'] ?>" <?= $id_confirmed == 'true' ? 'readonly' : '' ?>>
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-4">
                                    <label for="contact_no" class="form-label">Contact Number</label>
                                    <input type="text" value="<?= $row['user_contact_no'] ?>" minlength="11" maxlength="11" placeholder="09000000000" name="contact_no" id="contact_no" class="form-control">
                                </div>
                                <div class="mb-3 col-8">
                                    <label for="barangay" class="form-label">Barangay <span class="text-danger">*</span></label>
                                    <input type="text" name="barangay" id="barangay" class="form-control" required value="<?= $row['user_barangay'] ?>" <?= $id_confirmed == 'true' ? 'readonly' : '' ?>>
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label for="city" class="form-label">City <span class="text-danger">*</span></label>
                                    <input type="text" name="city" id="city" class="form-control" required value="<?= $row['user_city'] ?>" <?= $id_confirmed == 'true' ? 'readonly' : '' ?>>
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="province" class="form-label">Province <span class="text-danger">*</span></label>
                                    <input type="text" name="province" id="province" class="form-control" required value="<?= $row['user_province'] ?>" <?= $id_confirmed == 'true' ? 'readonly' : '' ?>>
                                </div>
                            </div>

                            <hr>

                            <div class="row">
                                <h3> Identification </h3>
                                <div class="mb-3 col-6">
                                    <label for="id_type" class="form-label">ID Type</label>
                                    <select class="form-select" name="id_type" id="id_type" aria-label="Default select example">
                                        <option value="" <?= $row['user_id_type'] == '' ? 'selected' : '' ?> <?= $id_confirmed == 'true' ? 'disabled' : '' ?>>-- Select -- </option>
                                        <option value="Driver's License" <?= $row['user_id_type'] == 'Driver\'s License' ? 'selected' : '' ?> <?= $id_confirmed == 'true' ? 'disabled' : '' ?>>Driver's License</option>
                                        <option value="UMID" <?= $row['user_id_type'] == 'UMID' ? 'selected' : '' ?> <?= $id_confirmed == 'true' ? 'disabled' : '' ?>>UMID</option>
                                        <option value="Student ID" <?= $row['user_id_type'] == 'Student ID' ? 'selected' : '' ?> <?= $id_confirmed == 'true' ? 'disabled' : '' ?>>Student ID</option>
                                    </select>
                                </div>

                                <div class="mb-3 col-6">
                                    <label for="id_number" class="form-label">ID Number</label>
                                    <input type="text" name="id_number" id="id_number" class="form-control" value="<?= $row['user_id_number'] ?>" <?= $id_confirmed == 'true' ? 'readonly' : ($row['user_id_type'] == '' ? 'readonly' : '') ?>>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <button type="submit"  class="btn btn-primary">Update</button>
                                    
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