<?php

include 'includes/connection.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $type = $_POST['type'];
    $fname= $_POST['fname'];
    $mname= $_POST['mname'];
    $lname= $_POST['lname'];
    $contact_no= $_POST['contact_no'];
    $barangay= $_POST['barangay'];
    $city= $_POST['city'];
    $province= $_POST['province'];
    $email= $_POST['email'];
    $password = $_POST['password']; 
    
    // Checks the Email 
    $sql = "SELECT * FROM users WHERE user_email='$email'";
    $result = $connection->query($sql);

    if($result->num_rows > 0){
        echo "Email Already Exists!";
        return;
    }

    // Prepared Statement & Binding (Avoid SQL Injections)
    $stmnt = $connection->prepare("INSERT INTO users (user_type, user_fname, user_mname, user_lname, user_contact_no, user_email, user_password, user_barangay, user_city, user_province)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmnt->bind_param('ssssssssss', $type, $fname, $mname, $lname, $contact_no, $email, $password, $barangay, $city, $province);
    $stmnt->execute();
    $stmnt->close();
    $connection->close();

    // Mailling Part
    $name = $fname . " " . $lname;
    $subject = "User Registration";
    $link = $home . "/verify.php?user=". $email."";
    $message = ' 
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <style>
            #verify {
                background-color: #0f79b7;
                padding: 10px;
                text-decoration: none;
                color: white;
            }
            #verify:hover {
                background-color: #0988d2;
            }
        </style>
    </head>
    <body>
        <p> Hi, <strong>' . $name . '!</strong></p>
        <p> You only have one more step to use the app. Please click the link below to finalize your Carpool App
            Registration.
            <br><br>
            <a id="verify" href="' . $link . '"> Verify Email Address </a>
            <br><br>
            If you have are having trouble verifying, email us at carpool@jeyymsantos.com. Did not sign up for an account? You may kindly ignore this email.
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

    echo "<script> alert('Check your email to verify your registration')</script>";

}
