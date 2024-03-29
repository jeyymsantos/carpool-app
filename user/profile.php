<?php

include '../includes/connection.php';
include_once '../includes/auth.php';

// Retrieves User
$sql = "SELECT * FROM users WHERE user_id=$id";
$result = $connection->query($sql);

// Retrieves Pending Car Approval
$car_sql = "SELECT * FROM cars WHERE user_id = '$id';";
$car_result = $connection->query($car_sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

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
    }
} else {
    $_SESSION['bg'] =  "warning";
    $_SESSION['message'] = "Profile not found!";
    header('Location: ' . $home . '/login.php');
    return;
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Sabay App | Profile - <?= $fname . ' ' . $lname ?> </title>

    <link rel="shortcut icon" href="../assets/img/Sabay App Logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>

    <div class="container my-3 col-lg-5">

        <?php
        if (!empty($_SESSION['message'])) :
        ?>
            <div class="alert alert-<?= $bg ?> alert-dismissible fade show" role="alert">
                <?= $message ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
            unset($_SESSION['message']);
            unset($_SESSION['bg']);
        endif ?>

        <h1> Profile </h1>
        <table style="width:100%">
            <tr>
                <th> Name </th>
                <td> <?= $fname . ' ' . $mname . ' ' . $lname ?> </td>
            </tr>
            <tr>
                <th> Address: </th>
                <td> <?= $barangay . ', ' . $city . ', ' . $province ?> </td>
            </tr>
            <tr>
                <th> Contact No: </th>
                <td> <?= $contact_no == '' ? 'N/A' : $contact_no ?> </td>
            </tr>
            <tr>
                <th> Submitted ID: </th>
                <td> <?= $id_type == '' ? 'No ID submitted' : $id_type ?> </td>
            </tr>
            <tr>
                <th> ID Status: </th>
                <th class="<?= $id_rejected == 1 ? 'text-danger' : ($id_confirmation == null ? 'text-warning' : 'text-success') ?>"> <?= $id_rejected == 1 ? 'Rejected' : ($id_confirmation == null ? 'Pending' : 'Approved') ?> </th>
            </tr>
            <tr>
                <th> Balance Ticket(s): </th>
                <td> <?= $balance ?> </td>
            </tr>
        </table>

        <hr>

        <!-- Wallet Management -->
        <a href="wallet/cash_in.php" class="btn btn-info"> Cash-In </a>

        <?php
        if ($type == 'Driver') :
        ?>
            <a href="wallet/cash_out.php" class="btn btn-dark"> Cash-Out </a>
        <?php endif; ?>

        <?php
        if (!is_null($id_confirmation)) :
        ?>
            <a href="car_register.php" class="btn btn-primary"> Register a Car </a>
        <?php endif; ?>


        <a href="update.php" class="btn btn-secondary"> Update Profile </a>

        <?php
        if ($car_result->num_rows > 0) :
        ?>
            <a href="view_cars.php" class="btn btn-warning"> View Cars </a>
        <?php endif; ?>

        <a href="../config/logout.php" class="btn btn-danger"> Logout </a>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>

</html>