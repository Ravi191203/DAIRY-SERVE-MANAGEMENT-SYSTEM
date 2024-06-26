<?php
session_start(); // Start the session to use session variables
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data and ensure all fields are set
    $productName = isset($_POST['product_name']) ? $_POST['product_name'] : '';
    $productPrice = isset($_POST['product_price']) ? $_POST['product_price'] : '';
    $productImage = isset($_POST['product_image']) ? $_POST['product_image'] : '';
    $stockStatus = isset($_POST['stock_status']) ? $_POST['stock_status'] : 'in_stock'; // default to 'in_stock'
    $stockQuantity = isset($_POST['stock_quantity']) ? $_POST['stock_quantity'] : 0; // default to 0

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO products (product_name, price, image_path, stock_status, stock_quantity) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sdssi", $productName, $productPrice, $productImage, $stockStatus, $stockQuantity);

    if ($stmt->execute()) {
        $_SESSION['success_message'] = "New product added successfully";

        // Notify all buyers
        $message = "New product added: $productName";
        $buyersQuery = "SELECT id FROM users WHERE role='buyer'";
        $buyersResult = $conn->query($buyersQuery);

        if ($buyersResult->num_rows > 0) {
            while ($buyer = $buyersResult->fetch_assoc()) {
                $userId = $buyer['id'];
                $notificationStmt = $conn->prepare("INSERT INTO notifications (user_id, message) VALUES (?, ?)");
                $notificationStmt->bind_param("is", $userId, $message);
                $notificationStmt->execute();
            }
            $_SESSION['success_message'] .= " and buyers notified.";
        } else {
            $_SESSION['success_message'] .= " but no buyers found to notify.";
        }
    } else {
        $_SESSION['error_message'] = "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
    header("Location: admin_add_product.php");
    exit();
}
?>
