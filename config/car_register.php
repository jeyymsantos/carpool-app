<?php

include '../includes/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = $_POST['id'];
    $plate_no = $_POST['fname'];
    $model = $_POST['mname'];
    $color = $_POST['lname'];
    $brand = $_POST['contact_no'];


    // Prepared Statement & Binding (Avoid SQL Injections)
    $stmnt = $connection->prepare("INSERT INTO users (user_type, user_fname, 
                                    user_mname, user_lname, user_contact_no, 
                                    user_email, user_password, user_barangay, 
                                    user_city, user_province)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmnt->bind_param('ssssssssss', $type, $fname, $mname, $lname, $contact_no, 
                                    $email, $password, $barangay, $city, $province);
    // $stmnt->execute();
    $stmnt->close();
    $connection->close();


    header('Location: ' . $home .'/index.php');
}
