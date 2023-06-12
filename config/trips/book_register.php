<?php

include '../../includes/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = $_SESSION['auth_id'];
    $rate_id = $_SESSION['rate_id'];

    $seat = $_POST['seat'];
    $barangay_start = $_POST['barangay_start'];
    $city_start = $_POST['city_start'];
    $province_start = $_POST['province_start'];
    $description = $_POST['description'];

    if ($seat == 'Front Seat') {
        $sql = "UPDATE rates SET rate_front_status = 'Booked' WHERE rate_id = $rate_id;";
    } else if ($seat == 'Left Seat') {
        $sql = "UPDATE rates SET rate_left_status = 'Booked' WHERE rate_id = $rate_id;";
    } else if ($seat == 'Middle Seat') {
        $sql = "UPDATE rates SET rate_middle_status = 'Booked' WHERE rate_id = $rate_id;";
    } else if ($seat == 'Right Seat') {
        $sql = "UPDATE rates SET rate_right_status = 'Booked' WHERE rate_id = $rate_id;";
    }

    $stmnt = $connection->prepare($sql);
    $stmnt->execute();

    // Select Last 
    $sql = "SELECT * FROM rates ORDER BY rate_id DESC LIMIT 1";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    $rate_id = $row['rate_id'];
    $status = 'Available';

    // Prepared Statement & Binding (Avoid SQL Injections)
    $stmnt = $connection->prepare("INSERT INTO bookings (car_id, rate_id, trip_departure_datetime, trip_start_barangay, trip_start_city, trip_start_province, trip_end_barangay, trip_end_city, trip_end_province, trip_status)
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
