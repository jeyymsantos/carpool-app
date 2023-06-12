<?php

include '../includes/connection.php';

$car_id = $_GET['car_id'];

$now = new DateTime();
$now->setTimezone(new DateTimeZone('Asia/Manila'));
$timestamp = $now->format('Y-m-d H:i:s');

// Prepared Statement & Binding (Avoid SQL Injections)
$stmnt = $connection->prepare("UPDATE cars SET car_rejected = 1 WHERE car_id='$car_id'");
$stmnt->execute();
$stmnt->close();
$connection->close();

$_SESSION['bg'] =  "danger";
$_SESSION['message'] = "Car has been rejected!";
$_SESSION['title'] =  "Car Configuration";
header('Location: ' . $home . '/admin_car_config/index.php');
