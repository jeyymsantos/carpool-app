<?php

include '../../includes/connection.php';
include_once '../../includes/auth.php';

$now = new DateTime();
$now->setTimezone(new DateTimeZone('Asia/Manila'));
$timestamp = $now->format('Y-m-d');

$sql = "SELECT * FROM transactions
INNER JOIN users
ON transactions.user_id = users.user_id
WHERE trans_verified_at IS NOT NULL AND trans_rejected = 0
ORDER BY trans_verified_at DESC;
;
";
$result = $connection->query($sql);

$bal_sum = "SELECT SUM(user_balance) AS bal_total FROM users;";
$bal_result = $connection->query($bal_sum);
$bal_row = $bal_result->fetch_assoc();

if (!empty($_SESSION['message'])) {
    $message = $_SESSION['message'];
    $bg = $_SESSION['bg'];
}

$cash_in = 0;
$cash_out = 0;
$con_fee = 0;
$pro_fee = 0;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Sabay App | Wallet Report </title>
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

        <h1> Admin - Wallet Approval </h1>
        <a href="wallet_report.php" class="btn btn-success"> Report </a>
        <a href="../" class="btn btn-danger"> Back </a>
        <hr>

        <h3 class="text-center"> Daily Report </h3>

        <table class="table-responsive" style="width:100%">
            <thead>
                <tr>
                    <th scope="col" class="text-center">#</th>
                    <th scope="col" class="text-center">Name</th>
                    <th scope="col" class="text-center">Type</th>
                    <th scope="col" class="text-center">Amount</th>
                    <th scope="col" class="text-center">Pro Fee</th>
                    <th scope="col" class="text-center">Con Fee</th>
                    <th scope="col" class="text-center">Balance</th>
                </tr>
            </thead>
            <tbody>

                <?php
                if ($result->num_rows > 0) :
                    $x = 1;
                    while ($row = $result->fetch_assoc()) :

                        if ($row['trans_type'] == 'Cash In') {
                            $cash_in = $cash_in + $row['trans_amount'];
                            $con_fee = $con_fee + $row['trans_fee'];
                        }else {
                            $cash_out = $cash_out + $row['trans_amount'];
                            $pro_fee = $pro_fee + $row['trans_fee'];
                        }
                ?>
                        <tr>
                            <th class="text-center"> <?= $x ?> </th>
                            <td class="text-center"> <?= $row['user_fname'] . " " . $row['user_lname'] ?> </td>
                            <td class="text-center"> <?= $row['trans_type'] ?> </td>
                            <td class="text-center"> <?= $row['trans_amount'] ?> </td>
                            <td class="text-center"> <?= $row['trans_type'] == 'Cash Out' ? $row['trans_fee'] : '0' ?> </td>
                            <td class="text-center"> <?= $row['trans_type'] == 'Cash In' ? $row['trans_fee'] : '0' ?> </td>
                            <td class="text-center"> <?= $row['user_balance'] ?> </td>
                            <!-- <td> <?= date("M d, Y H:i A", strtotime($row['user_verified_at'])) ?> </td> -->
                            <!-- date("M d, Y H:iA", strtotime($row['user_verified_at']) -->
                        </tr>
                <?php
                        $x++;
                    endwhile;
                endif;
                ?>
            </tbody>
        </table>

        <hr>

        <table style="float:right" class="me-3 mb-5">
                <tr>
                    <td> Total Cash In: </td>
                    <td> <?= $cash_in  . ' Pesos'?> </td>
                </tr>

                <tr>
                    <td> Total Cash Out: </td>
                    <td> <?= $cash_out  . ' Pesos'?> </td>
                </tr>

                <tr>
                    <td> Total: </td>
                    <td> <?= $cash_out + $cash_in . ' Pesos' ?> </td>
                </tr>
 
                <tr>
                    <td> Balance: </td>
                    <td class="text-primary"> <?= $bal_row['bal_total'] .' Tickets' ?> </td>
                </tr>

                <tr>
                    <td> Generated Income: </td>
                </tr>

                
                <tr>
                    <td> a. Conversion Fee: </td>
                    <td> <?= $con_fee .' Tickets' ?> </td>
                </tr>

                <tr>
                    <td> b. Processing Fee: </td>
                    <td class="text-primary"> <?= $pro_fee .' Tickets' ?> </td>
                </tr>

        </table>


    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>

</html>