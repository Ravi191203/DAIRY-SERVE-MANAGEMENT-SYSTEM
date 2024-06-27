<?php
session_start();
require_once '../db_connect.php'; // Ensure this file connects to your database

// Enable error reporting for debugging purposes
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $eid = $_POST['eid'];

    // Check if the database connection is successful
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Prepare statement to prevent SQL injection
    $stmt = $con->prepare("SELECT * FROM employee WHERE eid = ?");
    if (!$stmt) {
        die("Prepare failed: " . $con->error);
    }
    
    $stmt->bind_param("i", $eid);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $_SESSION['eid'] = $eid;
        header('Location: ../startstaff.php');
        exit;
    } else {
        $error = "Invalid staff ID.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Verify Staff</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap-5.3.3/bootstrap.min.css">
    <style>
        .container {
            max-width: 500px;
            margin-top: 50px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        h2 {
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        
        .animate {
            animation: fadeIn 1s ease-out;
        }
        
        @keyframes fadeIn {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }
        
        .btn, .form-control {
            transition: background-color 0.3s, color 0.3s, border-color 0.3s, transform 0.3s;
        }
        
        .btn:hover, .form-control:hover {
            transform: scale(1.02);
        }
        
        form {
            transition: background-color 0.3s, color 0.3s, border-color 0.3s, transform 0.3s;
        }
        
        form:hover {
            transform: scale(1.02);
        }
    </style>
</head>
<body class="alert alert-dark" >
<div class="container alert alert-warning">
    <h2 class="text-center">Verify Staff ID</h2>
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    <form method="POST" action="verify_staff.php">
        <div class="form-group">
            <label for="eid">Staff ID</label>
            <input type="number" class="form-control" id="eid" name="eid" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Verify</button>
    </form>
</div>
<script src="../css/bootstrap-5.3.3/bootstrap.bundle.min.js"></script>
<script src="../css/bootstrap-5.3.3/popper.min.js"></script>
<script src="../css/bootstrap-5.3.3/jquery-3.5.1.slim.min.js"></script>
<script src="../css/bootstrap-5.3.3/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>
