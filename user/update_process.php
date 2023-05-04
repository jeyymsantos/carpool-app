<?php

include '../includes/connection.php';

$user_id = $_SESSION['auth_id'];

$fname = $_POST['fname'];
$mname = $_POST['mname'];
$lname = $_POST['lname'];
$contact_no = $_POST['contact_no'];
$barangay = $_POST['barangay'];
$city = $_POST['city'];
$province = $_POST['province'];

$id_type = $_POST['id_type'];
$id_number = $_POST['id_number'];

$stmnt = $connection->prepare("UPDATE users SET user_fname = '$fname', user_mname = '$mname', user_lname = '$lname',
    user_contact_no = '$contact_no', user_barangay = '$barangay', user_city = '$city', user_province = '$province' WHERE user_id='$user_id'");
$stmnt->execute();

// Selects the Users & Passengers
$sql = "SELECT * FROM users INNER JOIN passengers ON users.user_id = passengers.user_id WHERE users.user_id='$user_id'";
$result = $connection->query($sql);
$row = $result->fetch_assoc();

if (is_null($row['pass_id_confirmed_at'])) {
    $stmnt = $connection->prepare("UPDATE passengers SET pass_id_type=?, pass_id_number=?, pass_id_rejected=0 WHERE user_id=?");
    $stmnt->bind_param('sss', $id_type, $id_number, $user_id);
} else {
    $stmnt = $connection->prepare("UPDATE passengers SET pass_id_number=?, pass_id_rejected=0 WHERE user_id=?");
    $stmnt->bind_param('ss', $id_number, $user_id);
}

$stmnt->execute();
$stmnt->close();

$connection->close();

$_SESSION['bg'] =  "success";
$_SESSION['message'] = "Profile has been successfully updated!";
header('Location: ' . $home . '/user/profile.php');
