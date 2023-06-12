<?php

include '../includes/connection.php';
include_once '../includes/auth.php';

// Retrieves Pending Transactions
$sql = "SELECT * FROM transactions 
INNER JOIN users
ON transactions.user_id = users.user_id
WHERE trans_verified_at IS NULL AND trans_rejected = 0;
";
$result = $connection->query($sql);

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
    <title> Sabay App | Wallet Approval </title>
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
        <a href="../index.php" class="btn btn-danger"> Back </a>
        <hr>

        <table class="table-responsive" style="width:100%">
            <thead>
                <tr>
                    <th scope="col" class="text-center">#</th>
                    <th scope="col" class="text-center">Name</th>
                    <th scope="col" class="text-center">Email</th>
                    <th scope="col" class="text-center">Type</th>
                    <th scope="col" class="text-center">GCash Reference No</th>
                    <th scope="col" class="text-center">GCash No</th>
                    <th scope="col" class="text-center">Amount</th>
                    <th scope="col" class="text-center">Conversion Fee</th>
                    <th scope="col" class="text-center">Processing Fee</th>
                    <th scope="col" class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>

                <?php
                if ($result->num_rows > 0) :
                    $x = 1;
                    while ($row = $result->fetch_assoc()) :
                ?>
                        <tr>
                            <th class="text-center"> <?= $x ?> </th>
                            <td class="text-center"> <?= $row['user_fname'] . " " . $row['user_lname'] ?> </td>
                            <td class="text-center"> <?= $row['user_email'] ?> </td>
                            <td class="text-center"> <?= $row['trans_type'] ?> </td>
                            <td class="text-center"> <?= $row['trans_reference_no'] ?> </td>
                            <td class="text-center"> <?= $row['trans_gcash_no'] ?> </td>
                            <td class="text-center"> <?= $row['trans_amount'] ?> </td>
                            <td class="text-center"> <?= $row['trans_type'] == 'Cash In' ? $row['trans_fee'] : '0' ?> </td>
                            <td class="text-center"> <?= $row['trans_type'] == 'Cash Out' ? $row['trans_fee'] : '0' ?> </td>
                            <td class="text-center">

                                <?php
                                if ($row['trans_type'] == 'Cash Out') :
                                ?>
                                    <a href="wallet_cashout.php?trans_id=<?= $row['trans_id'] ?>&user_id=<?= $row['user_id'] ?>&fee=<?= $row['trans_fee'] ?>&type=<?= $row['trans_type'] ?>&amount=<?= $row['trans_amount'] ?>" class="btn btn-dark"> Add Reference </a>

                                <?php
                                else :
                                ?>
                                    <a href="wallet_approve.php?trans_id=<?= $row['trans_id'] ?>&user_id=<?= $row['user_id'] ?>&fee=<?= $row['trans_fee'] ?>&type=<?= $row['trans_type'] ?>&amount=<?= $row['trans_amount'] ?>" class="btn btn-success"> Approve </a>
                                <?php endif; ?>

                                <a href="wallet_reject.php?trans_id=<?= $row['trans_id'] ?>" class="btn btn-danger"> Reject </a>
                            </td>
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


    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>

</html>