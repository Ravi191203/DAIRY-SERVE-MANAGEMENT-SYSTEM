<?php
session_start();
require 'config.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $currentPassword = $_POST['current_password'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];
    $userId = $_SESSION['user_id']; // Assuming user ID is stored in session

    if ($newPassword !== $confirmPassword) {
        echo "New password and confirm password do not match.";
        exit;
    }

    // Fetch current password from database
    $query = $conn->prepare("SELECT password FROM users WHERE id = ?");
    $query->bind_param("i", $userId);
    $query->execute();
    $result = $query->get_result();
    $user = $result->fetch_assoc();

    if (!$user || $user['password'] !== md5($currentPassword)) {
        echo "Current password is incorrect.";
        exit;
    }

    // Update password
    $newPasswordHashed = md5($newPassword);
    $updateQuery = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
    $updateQuery->bind_param("si", $newPasswordHashed, $userId);

    if ($updateQuery->execute()) {
        echo "Password changed successfully.";
        header("Location: index.php");
        exit;
    } else {
        echo "Error changing password. Please try again.";
    }
}
?>
