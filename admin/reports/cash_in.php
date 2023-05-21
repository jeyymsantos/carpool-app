<?php

include '../../includes/connection.php';
include_once '../../includes/auth.php';

$now = new DateTime();
$now->setTimezone(new DateTimeZone('Asia/Manila'));
$timestamp = $now->format('Y-m-d');

$sql = "SELECT * FROM transactions
INNER JOIN users
ON transactions.user_id = users.user_id
WHERE 
trans_verified_at IS NOT NULL 
AND trans_rejected = 0 
AND trans_type = 'Cash In' 
AND DATE(trans_verified_at) = CURDATE() 
ORDER BY trans_verified_at DESC;
";
$result = $connection->query($sql);

$bal_sum = "SELECT SUM(user_balance) AS bal_total FROM users;";
$bal_result = $connection->query($bal_sum);
$bal_row = $bal_result->fetch_assoc();

if (!empty($_SESSION['message'])) {
    $message = $_SESSION['message'];
    $bg = $_SESSION['bg'];
}

$cash_in = 0.00;
$con_fee = 0.00;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Sabay App | Cash In Transactions </title>
    <link rel="shortcut icon" href="../../assets/img/Sabay App Logo.png" type="image/x-icon">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>

    <div class="container my-3">

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

        <h1> Admin - Reports Generation </h1>
        <a href="<?= $home ?>/admin/reports/reports_module.php" class="btn btn-danger"> Back </a>
        <hr>

        <h3 class="text-center"> Cash In Transactions </h3>

        <table class="table table-responsive table-striped" style="width:100%">
            <thead>
                <tr>
                    <th scope="col" class="text-center">#</th>
                    <th scope="col" class="text-center">Name</th>
                    <th scope="col" class="text-center">Amount</th>
                    <th scope="col" class="text-center">Con Fee</th>
                </tr>
            </thead>
            <tbody>

                <?php
                if ($result->num_rows > 0) :
                    $x = 1;
                    while ($row = $result->fetch_assoc()) :
                        $cash_in = $cash_in + $row['trans_amount'];
                        $con_fee = $con_fee + $row['trans_fee'];
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
                    <td class="text-center"> <?= number_format((float)$cash_in, 2, '.', ''); ?> </td>
                    <td class="text-center"> <?= number_format((float)$con_fee, 2, '.', ''); ?> </td>
                </tr>
            </tfoot>
        </table>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>

</html>