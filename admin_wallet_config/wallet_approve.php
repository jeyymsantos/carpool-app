<?php

include '../includes/connection.php';

$trans_id = $_POST['trans_id'];
$user_id = $_POST['user_id'];
$trans_type = $_POST['type'];
$trans_fee = $_POST['fee'];
$trans_amount = $_POST['amount'];

if ($trans_type == 'Cash Out') {
    $reference = $_POST['reference'];
}

$now = new DateTime();
$now->setTimezone(new DateTimeZone('Asia/Manila'));
$timestamp = $now->format('Y-m-d H:i:s');

if ($trans_type == 'Cash In') {
    $stmnt = $connection->prepare("UPDATE users SET user_balance = user_balance + '$trans_fee' WHERE user_id='$user_id'");
    $stmnt->execute();
    $_SESSION['message'] = "Transaction has been successfully cashed in!";
} else if ($trans_type == 'Cash Out') {
    $cash_out = $trans_amount + $trans_fee;
    $stmnt = $connection->prepare("UPDATE users SET user_balance = user_balance - '$cash_out' WHERE user_id='$user_id'");
    $stmnt->execute();

    $stmnt = $connection->prepare("UPDATE transactions SET trans_reference_no = '$reference' WHERE trans_id='$trans_id'");
    $stmnt->execute();

    $_SESSION['message'] = "Transaction has been successfully cashed out!";
}

// Prepared Statement & Binding (Avoid SQL Injections)
$stmnt = $connection->prepare("UPDATE transactions SET trans_verified_at = '$timestamp' WHERE trans_id='$trans_id'");
$stmnt->execute();

$stmnt->close();
$connection->close();

$_SESSION['bg'] =  "success";
$_SESSION['title'] =  "Wallet Configuration";
header('Location: ' . $home . '/admin_wallet_config/index.php');
