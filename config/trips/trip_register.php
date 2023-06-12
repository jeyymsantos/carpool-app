<?php

include '../../includes/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = $_SESSION['auth_id'];

    $datetime = $_POST['datetime'];
    $car = $_POST['car'];
    $barangay_start = $_POST['barangay_start'];
    $city_start = $_POST['city_start'];
    $province_start = $_POST['province_start'];
    $barangay_end = $_POST['barangay_end'];
    $city_end = $_POST['city_end'];
    $province_end = $_POST['province_end'];

    $front_seat = $_POST['front_seat'] + 10;
    $left_seat = $_POST['left_seat'] + 10;
    $middle_seat = $_POST['middle_seat'] + 10;
    $right_seat = $_POST['right_seat'] + 10;

    // Prepared Statement & Binding (Avoid SQL Injections)
    $stmnt = $connection->prepare("INSERT INTO rates (rate_front, rate_left, rate_right, rate_middle)
            VALUES (?, ?, ?, ?)");
    $stmnt->bind_param('ssss', $front_seat, $left_seat, $right_seat, $middle_seat);
    $stmnt->execute();

    // Select Last 
    $sql = "SELECT * FROM rates ORDER BY rate_id DESC LIMIT 1";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    $rate_id = $row['rate_id'];
    $status = 'Available';

    // Prepared Statement & Binding (Avoid SQL Injections)
    $stmnt = $connection->prepare("INSERT INTO trips (car_id, rate_id, trip_departure_datetime, trip_start_barangay, trip_start_city, trip_start_province, trip_end_barangay, trip_end_city, trip_end_province, trip_status)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmnt->bind_param('ssssssssss', $car, $rate_id, $datetime, $barangay_start, $city_start, $province_start, $barangay_end, $city_end, $province_end, $status);
    $stmnt->execute();

    $_SESSION['bg'] =  "success";
    $_SESSION['message'] = "Your trip is now available!";
    $_SESSION['title'] = "Trip Registration";
    header('Location: ' . $home . '/user_trips/index.php');


    $stmnt->close();
    $connection->close();
}
