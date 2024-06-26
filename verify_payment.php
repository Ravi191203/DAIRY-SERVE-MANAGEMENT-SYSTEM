<?php
// Include database connection
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $order_id = $_POST['order_id'];
    $payment_status = $_POST['payment_status'];

    // Update the payment status in the database
    $query = "UPDATE orders SET payment_status = ? WHERE order_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('si', $payment_status, $order_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Payment status updated successfully!";
    } else {
        echo "Failed to update payment status. Please try again.";
    }

    $stmt->close();
    $conn->close();
}
?>
