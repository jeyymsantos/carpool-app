<?php

include '../includes/connection.php';

$user_id = $_GET['user_id'];

$now = new DateTime();
$now->setTimezone(new DateTimeZone('Asia/Manila'));
$timestamp = $now->format('Y-m-d H:i:s');

// Prepared Statement & Binding (Avoid SQL Injections)
$stmnt = $connection->prepare("UPDATE users SET user_id_confirmed_at = '$timestamp' WHERE user_id='$user_id'");
$stmnt->execute();
$stmnt->close();
$connection->close();

$_SESSION['bg'] =  "success";
$_SESSION['title'] =  "ID Configuration";
$_SESSION['message'] = "Driver's ID has been successfully verified!";
header('Location: ' . $home . '/admin_id_config/index.php');
