<?php
session_start();
include 'db_connect.php';

// Check if the user is logged in as admin
if ($_SESSION['role'] !== 'admin') {
    die("Access denied");
}

$id = $_GET['id'];

// Delete the user
$delete_query = "DELETE FROM users WHERE id = ?";
$stmt = $conn->prepare($delete_query);
$stmt->bind_param("i", $id);
$stmt->execute();

header('Location: admin_dashboard.php');
$conn->close();
?>
