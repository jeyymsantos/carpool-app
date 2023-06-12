<?php

include '../../includes/connection.php';

$car_id = $_GET['car_id'];
$user_id = $_GET['user_id'];

$now = new DateTime();
$now->setTimezone(new DateTimeZone('Asia/Manila'));
$timestamp = $now->format('Y-m-d H:i:s');

// Prepared Statement & Binding (Avoid SQL Injections)
$stmnt = $connection->prepare("UPDATE cars SET car_confirmed_at = '$timestamp' WHERE car_id='$car_id'");
$stmnt->execute();

$stmnt = $connection->prepare("UPDATE users SET user_type = 'Driver' WHERE user_id='$user_id'");
$stmnt->execute();

// Checks the number of Cars if it's the First Registration
$sql = "SELECT car_id FROM cars WHERE car_confirmed_at IS NOT NULL AND user_id='$user_id'";
$result = $connection->query($sql);

if ($result->num_rows == 1) {
    // Free Tickets - Add to Transaction
    $stmnt = $connection->prepare("INSERT INTO transactions 
    (user_id, trans_type, trans_gcash_no, trans_amount, trans_fee, trans_verified_at) 
    VALUES ('$user_id', 'Car', 'NA', '0', '40', '$timestamp')");
    $stmnt->execute();

    // Free Tickets - Update Users Balance
    $stmnt = $connection->prepare("UPDATE users SET user_balance = user_balance + '40' WHERE user_id='$user_id'");
    $stmnt->execute();

    $stmnt->close();
    $connection->close();

    $_SESSION['bg'] =  "success";
    $_SESSION['message'] = "New Car has been successfully approved! 40 free tickets has been credited to the user's account as their first Car approval.";
    header('Location: ' . $home . '/admin/car_config/car_module.php');
} else {
    $stmnt->close();
    $connection->close();

    $_SESSION['bg'] =  "success";
    $_SESSION['message'] = "New Car has been successfully approved!";
    header('Location: ' . $home . '/admin/car_config/car_module.php');
}
