<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>

<div class="container">
    <?php
    session_start();

    if (!isset($_SESSION["username"]) || $_SESSION["role"] != "admin") {
        header("Location: index.php");
        exit();
    }

    echo "Welcome, " . $_SESSION["username"] . "! You are logged in as Admin.";
    ?>

    <h2>Admin Dashboard</h2>
    <p>Admin functionalities go here.</p>

    <a href="logout.php">Logout</a>
</div>
<script src="css/bootstrap-5.3.3/bootstrap.bundle.min.js"></script>
    <script src="css/bootstrap-5.3.3/popper.min.js"></script>
    <script src="css/bootstrap-5.3.3/jquery-3.5.1.slim.min.js"></script>
    <script src="css/bootstrap-5.3.3/bootstrap.min.js"></script>
</body>
</html>
