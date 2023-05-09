<?php

include '../../includes/connection.php';

$trans_id = $_GET['trans_id'];
$user_id = $_GET['user_id'];
$trans_type = $_GET['type'];
$trans_fee = $_GET['fee'];
$trans_amount = $_GET['amount'];

$now = new DateTime();
$now->setTimezone(new DateTimeZone('Asia/Manila'));
$timestamp = $now->format('Y-m-d H:i:s');

if ($trans_type == 'Cash In') {
    $stmnt = $connection->prepare("UPDATE users SET user_balance = user_balance + '$trans_fee' WHERE user_id='$user_id'");
    $stmnt->execute();
} else if ($trans_type == 'Cash Out') {

    $cash_out = $trans_amount + $trans_fee;
    $stmnt = $connection->prepare("UPDATE users SET user_balance = user_balance - '$cash_out' WHERE user_id='$user_id'");
    $stmnt->execute();

}

// Prepared Statement & Binding (Avoid SQL Injections)
$stmnt = $connection->prepare("UPDATE transactions SET trans_verified_at = '$timestamp' WHERE trans_id='$trans_id'");
$stmnt->execute();

$stmnt->close();
$connection->close();

$_SESSION['bg'] =  "success";
$_SESSION['message'] = "Transaction has been successfully approved!";
header('Location: ' . $home . '/admin/wallet_config/wallet_module.php');
