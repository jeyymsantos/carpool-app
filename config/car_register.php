<?php

include '../includes/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = $_SESSION['auth_id'];
    $plate_no = $_POST['plate_no'];
    $model = $_POST['model'];
    $color = $_POST['color'];
    $brand = $_POST['brand'];

    // Prepared Statement & Binding (Avoid SQL Injections)
    $stmnt = $connection->prepare("INSERT INTO cars (driv_id, car_plate_no, 
                                    car_model, car_color, car_brand)
            VALUES (?, ?, ?, ?, ?)");
    $stmnt->bind_param('sssss', $id, $plate_no, $model, $color, $brand);
    $stmnt->execute();
    $stmnt->close();
    $connection->close();

    $_SESSION['bg'] =  "warning";
    $_SESSION['message'] = "Your car is now pending for approval.";
    header('Location: ' . $home .'/user/car_register.php');
}
