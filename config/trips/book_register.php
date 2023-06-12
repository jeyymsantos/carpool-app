<?php

include '../../includes/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = $_SESSION['auth_id'];
    $rate_id = $_POST['rate_id'];
    $trip_id = $_POST['trip_id'];

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

    $status = 'Pending';

    // Prepared Statement & Binding (Avoid SQL Injections)
    $stmnt = $connection->prepare("INSERT INTO bookings (trip_id, user_id, book_seat_location, book_pickup_barangay, book_pickup_city, book_pickup_province, book_pickup_description, book_status)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmnt->bind_param('ssssssss', $trip_id, $id, $seat, $barangay_start, $city_start, $province_start, $description, $status);
    $stmnt->execute();

    $_SESSION['bg'] =  "warning";
    $_SESSION['message'] = "Your booking is now pending for driver's approval!";
    $_SESSION['title'] = "Trip Booking";
    header('Location: ' . $home . '/user_trips/available.php');


    $stmnt->close();
    $connection->close();
}
