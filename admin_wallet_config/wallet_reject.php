<?php

include '../includes/connection.php';

$trans_id = $_POST['trans_id'];
$user_id = $_POST['user_id'];
$trans_type = $_POST['type'];
$trans_fee = $_POST['fee'];

$now = new DateTime();
$now->setTimezone(new DateTimeZone('Asia/Manila'));
$timestamp = $now->format('Y-m-d H:i:s');

// Prepared Statement & Binding (Avoid SQL Injections)
$stmnt = $connection->prepare("UPDATE transactions SET trans_rejected = 1 WHERE trans_id='$trans_id'");
$stmnt->execute();

$stmnt->close();
$connection->close();

$_SESSION['bg'] =  "danger";
$_SESSION['title'] =  "Wallet Configuration";
$_SESSION['message'] = "Transaction has been rejected!";
header('Location: ' . $home . '/admin_wallet_config/index.php');
