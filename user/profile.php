<?php

include '../includes/connection.php';

if (isset($_SESSION['auth_id'])) {

    $id = $_SESSION['auth_id'];

    // Retrieves User
    $sql = "SELECT * FROM users WHERE user_id=$id";
    $result = $connection->query($sql);

    // Retrieves Pending Car Approval
    $car_sql = "SELECT * FROM cars WHERE driv_id = '$id';";
    $car_result = $connection->query($car_sql);

    // Retrieves Passenger
    $pass_sql = "SELECT * FROM passengers WHERE user_id=$id";
    $pass_result = $connection->query($pass_sql);
    $pass_row = $pass_result->fetch_assoc();


    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

            // Check if the Account is Verified or Not
            if (is_null($row['user_verified_at'])) {
                $_SESSION['bg'] =  "warning";
                $_SESSION['message'] = "Your account is not yet verified. Check your email to verify account!";
                header('Location: ' . $home . '/login.php');
                return;
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
            $creation = $row['user_created_at'];
            $creation = $row['user_created_at'];
            $creation = $row['user_created_at'];
        }
    } else {
        $_SESSION['bg'] =  "warning";
        $_SESSION['message'] = "Profile not found!";
        header('Location: ' . $home . '/login.php');
        return;
    }
} else {
    $_SESSION['bg'] =  "warning";
    $_SESSION['message'] = "Please login first!";
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
    <title> Profile - <?= $fname . ' ' . $lname ?> </title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>

    <div class="container my-3 col-lg-5">

        <h1> Profile </h1>
        <table style="width:100%">
            <tr>
                <th> Name </th>
                <td> <?= $fname . ' ' . $lname ?> </td>
            </tr>
            <tr>
                <th> User Type </th>
                <td> <?= $type ?> </td>
            </tr>
            <tr>
                <th> Address: </th>
                <td> <?= $barangay . ', ' . $city . ', ' . $province ?> </td>
            </tr>
            <tr>
                <th> Contact No: </th>
                <td> <?= $contact_no ?> </td>
            </tr>
            <tr>
                <th> User Verified: </th>
                <td> <?= date('M d, Y h:i A', strtotime($verification)) ?> </td>
            </tr>
            <tr>
                <th> User Created: </th>
                <td> <?= date('M d, Y h:i A', strtotime($creation)) ?> </td>
            </tr>
        </table>

        <hr>

        <?php
        if (!is_null($pass_row['pass_id_confirmed_at'])) :
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

</body>

</html>