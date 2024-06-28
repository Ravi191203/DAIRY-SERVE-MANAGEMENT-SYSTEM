<?php
session_start();
include 'db_connect.php';

// Check if the user is logged in as admin
if ($_SESSION['role'] !== 'admin') {
    die("Access denied");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    // Update user details
    $update_query = "UPDATE users SET password = ?, role = ? WHERE id = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("ssi", $password, $role, $id);
    $stmt->execute();

    header('Location: admin_dashboard.php');
}
?>
