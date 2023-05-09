
<?php
include '../../includes/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = $_SESSION['auth_id'];

    $reference = $_POST['reference'];
    $mobile_no = $_POST['mobile_no'];
    $amount = $_POST['amount'];
    $tickets = $_POST['tickets'];

    $type = 'Cash In';

    $stmnt = $connection->prepare("INSERT INTO transactions 
                (user_id, trans_type, trans_reference_no, 
                trans_gcash_no, trans_amount, trans_fee) 
                VALUES (?, ?, ?, ?, ?, ?)");
    $stmnt->bind_param('ssssss', $id, $type, $reference, $mobile_no, $amount, $tickets);
    $stmnt->execute();

    $stmnt->close();

    $connection->close();

    $_SESSION['bg'] =  "warning";
    $_SESSION['message'] = "Cash In is now pending for approval!";
    header('Location: ' . $home . '/user/profile.php');
}


?>