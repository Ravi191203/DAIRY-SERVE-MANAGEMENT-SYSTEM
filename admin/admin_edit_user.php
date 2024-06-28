<?php
session_start();
include 'db_connect.php';

// Check if the user is logged in as admin
if ($_SESSION['role'] !== 'admin') {
    die("Access denied");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Hash the password using md5 (not recommended for production)
    $hashed_password = md5($password);

    // Update user details
    $update_query = "UPDATE users SET password = ?, role = ? WHERE id = ?";
    $stmt = $conn->prepare($update_query);
    if ($stmt) {
        $stmt->bind_param("ssi", $hashed_password, $role, $id);
        if ($stmt->execute()) {
            header('Location: admin_dashboard1.php');
            exit();
        } else {
            echo "Error executing query: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
}
?>
