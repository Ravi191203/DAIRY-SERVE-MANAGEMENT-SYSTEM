<?php
include '../db_connect.php';

if (isset($_GET['order_id']) && isset($_GET['action'])) {
    $order_id = $_GET['order_id'];
    $action = $_GET['action'];

    if ($action == 'approve') {
        $status = 'approved';
    } elseif ($action == 'decline') {
        $status = 'declined';
    }

    $query = "UPDATE orders SET status='$status' WHERE order_id='$order_id'";
    if (mysqli_query($con, $query)) {
        header("Location: admin_dashboard.php");
        exit;
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>
