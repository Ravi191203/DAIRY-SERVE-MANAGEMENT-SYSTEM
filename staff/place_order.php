<?php
include 'db_connect.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customer_name = $_POST['customer_name'];
    $customer_mobile = $_POST['customer_mobile'];
    $payment_mode = $_POST['payment_mode'];
    $transaction_id = isset($_POST['transaction_id']) ? $_POST['transaction_id'] : null;
    $total_cost = $_POST['cost'];

    // Insert customer details
    $query = "INSERT INTO customers (customer_name, customer_mobile) VALUES ('$customer_name', '$customer_mobile')";
    mysqli_query($conn, $query);
    $customer_id = mysqli_insert_id($conn);

    // Insert order details
    $status = ($payment_mode == 'offline') ? 'approved' : 'pending';
    $query = "INSERT INTO orders (customer_id, total_cost, payment_mode, transaction_id, status) 
              VALUES ('$customer_id', '$total_cost', '$payment_mode', '$transaction_id', '$status')";
    mysqli_query($conn, $query);
    $order_id = mysqli_insert_id($conn);

    // Insert order items
    foreach ($_POST['products'] as $product) {
        $product_id = explode('&', $product['id'])[0];
        $quantity = $product['quantity'];
        $query = "INSERT INTO order_items (order_id, product_id, quantity) VALUES ('$order_id', '$product_id', '$quantity')";
        mysqli_query($conn, $query);
    }

    header("Location: /dairy-serve-management-system/buyers/order_confirmation.php?order_id=$order_id");
}
?>