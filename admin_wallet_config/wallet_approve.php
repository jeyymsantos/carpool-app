<?php

include '../../includes/connection.php';

$trans_type = "";

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $trans_id = $_GET['trans_id'];
    $user_id = $_GET['user_id'];
    $trans_type = $_GET['type'];
    $trans_fee = $_GET['fee'];
    $trans_amount = $_GET['amount'];
} else {
    $trans_type = $_SESSION['trans_type'];
}

$now = new DateTime();
$now->setTimezone(new DateTimeZone('Asia/Manila'));
$timestamp = $now->format('Y-m-d H:i:s');

if ($trans_type == 'Cash In') {
    $stmnt = $connection->prepare("UPDATE users SET user_balance = user_balance + '$trans_fee' WHERE user_id='$user_id'");
    $stmnt->execute();
} else if ($trans_type == 'Cash Out') {
    $trans_id =  $_SESSION['trans_id'];
    $user_id = $_SESSION['user_id'];
    $trans_fee = $_SESSION['trans_fee'];
    $trans_amount = $_SESSION['trans_amount'];
    $reference = $_POST['reference'];

    $cash_out = $trans_amount + $trans_fee;
    $stmnt = $connection->prepare("UPDATE users SET user_balance = user_balance - '$cash_out' WHERE user_id='$user_id'");
    $stmnt->execute();

    $stmnt = $connection->prepare("UPDATE transactions SET trans_reference_no = '$reference' WHERE trans_id='$trans_id'");
    $stmnt->execute();

    // Unset Sessions of Cashout Transactions
    unset($_SESSION['trans_type']);
    unset($_SESSION['trans_id']);
    unset($_SESSION['user_id']);
    unset($_SESSION['trans_fee']);
    unset($_SESSION['trans_amount']);
}

// Prepared Statement & Binding (Avoid SQL Injections)
$stmnt = $connection->prepare("UPDATE transactions SET trans_verified_at = '$timestamp' WHERE trans_id='$trans_id'");
$stmnt->execute();

$stmnt->close();
$connection->close();

$_SESSION['bg'] =  "success";
$_SESSION['message'] = "Transaction has been successfully approved!";
header('Location: ' . $home . '/admin/wallet_config/wallet_module.php');
