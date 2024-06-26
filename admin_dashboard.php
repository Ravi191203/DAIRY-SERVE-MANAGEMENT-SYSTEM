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
        header("Location: login.php");
        exit();
    }

    echo "Welcome, " . $_SESSION["username"] . "! You are logged in as Admin.";
    ?>

    <h2>Admin Dashboard</h2>
    <p>Admin functionalities go here.</p>

    <a href="logout.php">Logout</a>
</div>

</body>
</html>
