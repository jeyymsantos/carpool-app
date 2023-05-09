<?php

include '../../includes/connection.php';
include_once '../../includes/auth.php';



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Sabay App | Cash Out </title>

    <link rel="shortcut icon" href="../../assets/img/Sabay App Logo.png" type="image/x-icon">
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

        <form action="../../config/billing/cash_out.php" method="post">

            <h1 class="mb-3"> User Cash Out Page </h1>
            <hr>

            <div class="row">
                <h3> Cash Out </h3>
                <div class="mb-3 col-6">
                    <label for="mobile_no" class="form-label"> GCash Mobile Number <span class="text-danger">*</span></label>
                    <input type="text" name="mobile_no" id="mobile_no" minlength="11" maxlength="11" class="form-control" required>
                </div>

                <div class="mb-3 col-6">
                    <label for="amount" class="form-label">Amount <span class="text-danger">*</span></label>
                    <input type="number" name="amount" id="amount" class="form-control" required>
                    <div id="emailHelp" class="form-text">Please be advised that there is a ₱20.00 charge for every ₱1000.00 Cash Out</div>
                </div>

            </div>

            <div class="row">
                <div class="col">
                    <input type="submit" name="proceed" value="Proceed" class="btn btn-primary">
                    <a href="../profile.php" class="btn btn-warning"> Back </a>
                </div>
            </div>

        </form>

    </div>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>

</html>