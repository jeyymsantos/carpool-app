<?php

include 'includes/connection.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

$now = new DateTime();
$now->setTimezone(new DateTimeZone('Asia/Manila'));
$timestamp = $now->format('Y-m-d H:i:s');

if($_SERVER['REQUEST_METHOD'] === 'GET'){

    $email = $_GET['user'];
    
    // Checks the Email if Verified
    $sql = "SELECT * FROM users WHERE user_email='$email'";
    $result = $connection->query($sql);

    $row = $result->fetch_assoc();
    if(!is_null($row['user_verified_at'])){
        echo "Email already verified!";
        return;
    }

    // Prepared Statement & Binding (Avoid SQL Injections)
    $stmnt = $connection->prepare("UPDATE users SET user_verified_at=? WHERE user_email=?");
    $stmnt->bind_param('ss', $timestamp, $email);
    $stmnt->execute();
    $stmnt->close();
    $connection->close();

    // Mailling Part
    $subject = "User Verified";
    $message = ' 
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
        <p> Your email account is now verified! You can now enjoy our Carpooling App!
            <br><br>
            If you have any inquiries/concerns, email us at carpool@jeyymsantos.com.
            <br><br>
            Riding you safe, <br>
            <b>Carpool Buddy 😊 </b>
        </p>
    </body>
    </html>
    ';

    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.hostinger.com';
    $mail->SMTPAuth = 'true';
    $mail->Username = 'carpool@jeyymsantos.com';
    $mail->Password = 'Jeyym@15';
    $mail->SMTPSecure = 'tls';
    $mail->Port = '587';

    $mail->setFrom('carpool@jeyymsantos.com', 'Carpool App');
    $mail->addAddress($email);
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $message;
    $mail->send();

    header('Location: '.$home.'/verified.html');
}
