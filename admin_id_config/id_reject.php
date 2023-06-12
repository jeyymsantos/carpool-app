<?php

include '../includes/connection.php';

$user_id = $_GET['user_id'];

$now = new DateTime();
$now->setTimezone(new DateTimeZone('Asia/Manila'));
$timestamp = $now->format('Y-m-d H:i:s');

// Prepared Statement & Binding (Avoid SQL Injections)
$stmnt = $connection->prepare("UPDATE users SET user_id_rejected = 1 WHERE user_id='$user_id'");
$stmnt->execute();
$stmnt->close();
$connection->close();

$_SESSION['bg'] =  "danger";
$_SESSION['title'] =  "ID Configuration";
$_SESSION['message'] = "ID has been rejected!";
header('Location: ' . $home . '/admin_id_config/index.php');
