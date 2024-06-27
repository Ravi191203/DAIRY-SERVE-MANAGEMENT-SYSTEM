<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap-5.3.3/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css">
</head>
<body>
<?php

if (isset($_POST['subscribe'])) {
    $email = $_POST['email'];

    $conn = new mysqli('localhost', 'root', '', 'dry');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO subscriptions (email) VALUES ('$email')";
    if ($conn->query($sql) === TRUE) {
        echo '<p class="alert alert-warning">Subscription successful! You will receive our latest updates and offers.</p>';
    } else {
        echo '<p class="alert alert-danger">Error: ' . $sql . '<br>' . $conn->error . '</p>';
    }

    $conn->close();
}
?>
<script src="css/bootstrap-5.3.3/bootstrap.bundle.min.js"></script>
<script src="css/bootstrap-5.3.3/popper.min.js"></script>
<script src="css/bootstrap-5.3.3/jquery-3.5.1.slim.min.js"></script>
<script src="css/bootstrap-5.3.3/bootstrap.min.js"></script>
</body>
</html>

