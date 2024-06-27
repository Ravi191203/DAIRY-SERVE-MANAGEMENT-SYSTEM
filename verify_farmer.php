<?php
session_start();
require_once 'db_connect.php'; // Ensure this file connects to your database

// Check if the user is logged in and is a farmer (you may need to adjust this based on your login logic)
if (!isset($_SESSION["username"]) || $_SESSION["role"] != "farmer") {
    header("Location: login.php");
    exit();
}


echo "<h3><center><b>Welcome, " . $_SESSION["username"] . "! You are logged in as Farmer.</b></center></h3>";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $farmer_id = $_POST['farmer_id'];
    $user_id = $_SESSION['username']; // Assuming user_id is stored in the session

    $query = "SELECT * FROM farmer WHERE id = '$farmer_id'";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) === 1) {
        $_SESSION['farmer_id'] = $farmer_id;
        header('Location: /dairy-serve-management-system/farmer_dashboard.php');
        exit;
    } else {
        $error = "Invalid farmer ID.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Verify Farmer</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-5.3.3/bootstrap.min.css">
</head>
<body class="alert alert-secondary">
<div class="container mt-5 ">
    <div class="row justify-content-center ">
        <div class="col-md-6 alert alert-danger">
            <div class="card">
                <div class="card-header bg-primary text-white text-center">
                    <h2 >Verify Farmer ID</h2>
                </div>
                <div class="card-body">
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger"><?php echo $error; ?></div>
                    <?php endif; ?>
                    <form method="POST" action="verify_farmer.php">
                        <div class="mb-3">
                            <label for="farmer_id" class="form-label">Farmer ID</label>
                            <input type="number" class="form-control" id="farmer_id" name="farmer_id" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Verify</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="css/bootstrap-5.3.3/bootstrap.bundle.min.js"></script>
<script src="css/bootstrap-5.3.3/popper.min.js"></script>
<script src="css/bootstrap-5.3.3/jquery-3.5.1.slim.min.js"></script>
<script src="css/bootstrap-5.3.3/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>
