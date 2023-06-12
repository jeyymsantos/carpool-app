<?php

include '../includes/connection.php';
include_once '../includes/auth.php';

$_SESSION['trans_id'] =  $_GET['trans_id'];
$_SESSION['user_id'] =  $_GET['user_id'];
$_SESSION['trans_type'] =  $_GET['type'];
$_SESSION['trans_fee'] =  $_GET['fee'];
$_SESSION['trans_amount'] =  $_GET['amount'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sabay App | Cash Out</title>

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

        <form action="wallet_approve.php" method="post">
            <h1 class="mb-3"> User Cash Out Page </h1>
            <hr>

            <div class="row">
                <h3> Cash Out </h3>
                <div class="mb-3 col-6">
                    <label for="reference" class="form-label"> GCash Refence Number <span class="text-danger">*</span></label>
                    <input type="text" name="reference" id="reference" minlength="8" maxlength="8" class="form-control" required>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <input type="submit" name="proceed" value="Proceed" class="btn btn-primary">
                    <a href="<?= $home ?>/admin/wallet_config/wallet_module.php" class="btn btn-danger"> Back </a>
                </div>
            </div>

        </form>

    </div>

</body>

</html>