<?php

include '../includes/connection.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

$now = new DateTime();
$now->setTimezone(new DateTimeZone('Asia/Manila'));
$timestamp = $now->format('Y-m-d H:i:s');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $email = $_GET['user'];

    // Checks the Email if Verified
    $sql = "SELECT * FROM users WHERE user_email='$email'";
    $result = $connection->query($sql);

    $row = $result->fetch_assoc();
    $user_id = $row['user_id'];

    if (!is_null($row['user_verified_at'])) {
        $_SESSION['bg'] =  "danger";
        $_SESSION['message'] = "Email has already been verified!";
        header('Location: ' . $home . '/index.php');
        return;
    }

    // Free Tickets - Add to Transaction
    $stmnt = $connection->prepare("INSERT INTO transactions 
    (user_id, trans_type, trans_gcash_no, trans_amount, trans_fee, trans_verified_at) 
    VALUES ('$user_id', 'Email', 'NA', '0', '10', '$timestamp')");
    $stmnt->execute();

    // Free Tickets - Update Users Balance
    $stmnt = $connection->prepare("UPDATE users SET user_balance = user_balance + '10' WHERE user_id=?");
    $stmnt->bind_param('s', $row['user_id']);
    $stmnt->execute();

    // Final Verification
    $stmnt = $connection->prepare("UPDATE users SET user_verified_at=? WHERE user_email=?");
    $stmnt->bind_param('ss', $timestamp, $email);
    $stmnt->execute();

    $stmnt->close();
    $connection->close();

    $_SESSION['bg'] =  "success";
    $_SESSION['message'] = "Your email is now verified and has received 10 free initial tickets! You may now login to your account.";
    header('Location: ' . $home . '/index.php');
}
