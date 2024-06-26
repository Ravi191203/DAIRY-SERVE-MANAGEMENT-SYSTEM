<?php
session_start();
require 'config.php'; // Include your database connection file

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate and sanitize input
    $name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : null;
    $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : null;
    $phone = isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : null;
    $message = isset($_POST['message']) ? htmlspecialchars($_POST['message']) : null;

    if ($name && $email && $phone && $message) {
        // Prepare the SQL statement
        $stmt = $conn->prepare("INSERT INTO messages (name, email, phone, message) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $phone, $message);

        // Execute the statement
        if ($stmt->execute()) {
            echo "Message sent successfully.";
        } else {
            echo "Error sending message: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "All fields are required.";
    }
} else {
    echo "Invalid request method.";
}

// Close the database connection
$conn->close();
?>
