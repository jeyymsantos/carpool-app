
<?php
include '../../includes/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = $_SESSION['auth_id'];

    $mobile_no = $_POST['mobile_no'];
    $amount = (int)$_POST['amount'];

    $type = 'Cash Out';

    // Checks the Email & Password
    $sql = "SELECT user_balance FROM users WHERE user_id='$id'";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();


    $whole = (int) ($amount / 1000);
    $decimal = fmod($amount, 1000);
    $process = 0;

    if ($whole > 0) {
        if ($decimal == 0) {
            $process = 20 * $whole;
        } else {
            $process = (20 * $whole) + 20;
        }
    } else {
        $process = 20;
    }

    $total = $amount + $process;

    if ($row['user_balance'] < $total) {
        $_SESSION['bg'] =  "danger";
        $_SESSION['message'] = "Insufficient Tickets!";
        header('Location: ' . $home . '/user/profile.php');
        return;
    }

    $stmnt = $connection->prepare("INSERT INTO transactions 
                (user_id, trans_type, 
                trans_gcash_no, trans_amount, trans_fee) 
                VALUES (?, ?, ?, ?, ?)");
    $stmnt->bind_param('sssss', $id, $type, $mobile_no, $amount, $process);
    $stmnt->execute();
    $stmnt->close();
    $connection->close();

    $_SESSION['bg'] =  "warning";
    $_SESSION['message'] = "Cash Out is now pending for approval!";
    header('Location: ' . $home . '/user/profile.php');
}


?>