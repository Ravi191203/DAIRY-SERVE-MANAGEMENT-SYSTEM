<?php
include 'db_connect.php';
session_start(); // Start the session to access session variables

// Assuming the username is stored in the session during login
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    // Redirect to login page if the user is not logged in
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_SESSION['username'];
    $customer_name = $_POST['customer_name'];
    $customer_mobile = $_POST['customer_mobile'];
    $customer_email = $_POST['customer_email'];
    $customer_address= $_POST['customer_address'];
    $payment_mode = $_POST['payment_mode'];
    $transaction_id = isset($_POST['transaction_id']) ? $_POST['transaction_id'] : null;
    $total_cost = $_POST['cost'];

    // Debug output to check the contents of the $_POST array
    echo '<pre>';
    print_r($_POST);
    echo '</pre>';

    // Insert customer details
    $query = "INSERT INTO customers (customer_name, customer_mobile, customer_email,customer_address) VALUES ('$customer_name', '$customer_mobile','$customer_email','$customer_address')";
    if (mysqli_query($conn, $query)) {
        $customer_id = mysqli_insert_id($conn);

        // Insert order details
        $status = ($payment_mode == 'offline') ? 'approved' : 'pending';
        $query = "INSERT INTO orders (username, customer_id, total_cost, payment_mode, transaction_id, status) 
                  VALUES ('$username', '$customer_id', '$total_cost', '$payment_mode', '$transaction_id', '$status')";
        if (mysqli_query($conn, $query)) {
            $order_id = mysqli_insert_id($conn);

            // Insert order items and update stock quantity
            foreach ($_POST['products'] as $product_id => $product) {
                if (isset($product['id']) && isset($product['quantity'])) {
                    $quantity = $product['quantity'];
                    if ($quantity > 0) {
                        // Insert order item
                        $query = "INSERT INTO order_items (order_id, product_id, quantity) VALUES ('$order_id', '$product_id', '$quantity')";
                        if (!mysqli_query($conn, $query)) {
                            echo "Error inserting order item: " . mysqli_error($conn);
                            exit();
                        }

                        // Update stock quantity
                        $query = "UPDATE products SET stock_quantity = stock_quantity - '$quantity' WHERE product_id = '$product_id'";
                        if (!mysqli_query($conn, $query)) {
                            echo "Error updating stock quantity: " . mysqli_error($conn);
                            exit();
                        }
                    }
                } else {
                    // If product id or quantity is missing, continue to next iteration
                    continue;
                }
            }

            header("Location: /dairy-serve-management-system/buyers/order_confirmation.php?order_id=$order_id");
            exit(); // Ensure the script stops executing after the redirect
        } else {
            echo "Error inserting order details: " . mysqli_error($conn);
        }
    } else {
        echo "Error inserting customer details: " . mysqli_error($conn);
    }
}
?>
