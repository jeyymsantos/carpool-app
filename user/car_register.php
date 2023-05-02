<?php

include '../includes/connection.php';

if (!empty($_SESSION['message'])) {
    $message = $_SESSION['message'];
    $bg = $_SESSION['bg'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Register </title>

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

        <!-- Car Registration -->
        <form action="../config/car_register.php" method="post">

            <h1 class="mb-3"> Car Registration </h1>
            <hr>

            <div class="row">
                <div class="mb-3 col-4">
                    <label for="plate_no" class="form-label">Car Plate No. <span class="text-danger">*</span></label>
                    <input type="text" name="plate_no" id="plate_no" class="form-control" required placeholder="XXX-9999" minlength="9" maxlength="9">
                </div>
                <div class="mb-3 col-4">
                    <label for="model" class="form-label">Car Model <span class="text-danger">*</span></label>
                    <input type="text" name="model" id="model" class="form-control" required>
                </div>
                <div class="mb-3 col-4">
                    <label for="color" class="form-label">Car Color <span class="text-danger">*</span></label>
                    <input type="text" name="color" id="color" class="form-control" required>
                </div>
            </div>

            <div class="row">
                <div class="mb-3 col-4">
                    <label for="brand" class="form-label">Car Brand <span class="text-danger">*</span></label>
                    <input type="text" name="brand" id="brand" class="form-control" required>
                </div>
            </div>

            <div class="col">
                <input type="submit" name="register" value="Register" class="btn btn-primary">
                <a href="profile.php" class="btn btn-warning"> Back </a>
            </div>

        </form>


    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>

</html>