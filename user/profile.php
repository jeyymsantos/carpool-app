<?php

include '../includes/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $id = $_GET['id'];

    // Retrieves User
    $sql = "SELECT * FROM users WHERE user_id=$id";
    $result = $connection->query($sql);

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
        }
    } else {
        $_SESSION['bg'] =  "warning";
        $_SESSION['message'] = "Profile not found!";
        header('Location: ' . $home . '/login.php');
        return;
    }
} else {
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

        <!-- Car Registration -->
        <form action="config/car_register.php" method="post">

            <h1 class="mb-3"> Car Registration </h1>
            <hr>

            <input type="hidden" name="id" value="<?= $id ?>">

            <div class="row">
                <div class="mb-3 col-4">
                    <label for="fname" class="form-label">Car Plate No. <span class="text-danger">*</span></label>
                    <input type="text" name="fname" id="fname" class="form-control" required placeholder="XXX-9999">
                </div>
                <div class="mb-3 col-4">
                    <label for="mname" class="form-label">Car Model <span class="text-danger">*</span></label>
                    <input type="text" name="mname" id="mname" class="form-control">
                </div>
                <div class="mb-3 col-4">
                    <label for="lname" class="form-label">Car Color <span class="text-danger">*</span></label>
                    <input type="text" name="lname" id="lname" class="form-control" required>
                </div>
            </div>

            <div class="row">
                <div class="mb-3 col-4">
                    <label for="fname" class="form-label">Car Brand <span class="text-danger">*</span></label>
                    <input type="text" name="fname" id="fname" class="form-control" required>
                </div>
            </div>

            <div class="col">
                <input type="submit" name="register" value="Register" class="btn btn-primary">
                <input type="reset" class="btn btn-warning"> 
            </div>
            
        </form>


    </div>

</body>

</html>