<?php
session_start();
if (!isset($_SESSION["username"]) || $_SESSION["role"] != "admin") {
    header("Location: login.php");
    exit();
}
require 'db_connect.php'; // Include your database connection file

$result = $conn->query("SELECT * FROM messages ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - View Messages</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-4">View Messages <i class="fas fa-envelope-open-text"></i></h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th><i class="fas fa-user"></i> Name</th>
                <th><i class="fas fa-envelope"></i> Email</th>
                <th><i class="fas fa-phone"></i> Phone</th>
                <th><i class="fas fa-comment"></i> Message</th>
                <th><i class="fas fa-calendar-alt"></i> Date</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['name']); ?></td>
                <td><?php echo htmlspecialchars($row['email']); ?></td>
                <td><?php echo htmlspecialchars($row['phone']); ?></td>
                <td><?php echo nl2br(htmlspecialchars($row['message'])); ?></td>
                <td><?php echo $row['created_at']; ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
