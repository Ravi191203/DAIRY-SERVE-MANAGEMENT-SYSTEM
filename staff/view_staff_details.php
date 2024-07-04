<?php
session_start();
require_once '../db_connect.php'; // Ensure this file connects to your database

// Enable error reporting for debugging purposes
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the user is logged in and the eid is set
if (!isset($_SESSION['eid'])) {
    header('Location: verify_staff.php');
    exit;
}

$eid = $_SESSION['eid'];

// Check if the database connection is successful
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Prepare statement to fetch staff details
$stmt = $con->prepare("SELECT * FROM employee WHERE eid = ?");
if (!$stmt) {
    die("Prepare failed: " . $con->error);
}

$stmt->bind_param("i", $eid);
$stmt->execute();
$result = $stmt->get_result();
$staff = $result->fetch_assoc();

$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Staff Details</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../css/bootstrap-5.3.3/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(to right, #f3f4f6, black);
            color: #333;
            background-size: 200% 200%;
            animation: gradientBackground 10s ease-in-out infinite;
        }
        @keyframes gradientBackground {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        body {
            background-color: #f8f9fa;
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
            transition: transform 0.3s, box-shadow 0.3s;
            animation: fadeIn 1s ease-out;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }

        .card-header {
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            background: linear-gradient(45deg, #007bff, #00d4ff);
            animation: gradient 3s ease infinite;
        }

        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }

        .card-header h2 {
            margin: 0;
        }

        .table th, .table td {
            vertical-align: middle;
        }

        .table tbody tr:hover {
            background-color: #e9ecef;
            transform: scale(1.02);
            transition: transform 0.3s, background-color 0.3s;
        }

        .btn-secondary {
            background-color: #6c757d;
            border: none;
            transition: background-color 0.3s;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-primary text-white text-center">
            <h2>Staff Details</h2>
        </div>
        <div class="card-body">
            <table class="table table-hover table-bordered">
                <tbody>
                    <tr><th>ID</th><td><?php echo htmlspecialchars($staff['eid']); ?></td></tr>
                    <tr><th>Name</th><td><?php echo htmlspecialchars($staff['ename']); ?></td></tr>
                    <tr><th>Phone Number</th><td><?php echo htmlspecialchars($staff['phno']); ?></td></tr>
                    <tr><th>Salary</th><td><?php echo htmlspecialchars($staff['salary']); ?></td></tr>
                    <tr><th>Designation</th><td><?php echo htmlspecialchars($staff['designation']); ?></td></tr>
                    <tr><th>Address</th><td><?php echo htmlspecialchars($staff['address']); ?></td></tr>
                    <!-- Add more fields as necessary -->
                </tbody>
            </table>
        </div>
        <div class="card-footer text-center">
            <a href="../staff_dashboard.php" class="btn btn-secondary">Back</a>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
<script src="../css/bootstrap-5.3.3/bootstrap.bundle.min.js"></script>
<script src="../css/bootstrap-5.3.3/popper.min.js"></script>
<script src="../css/bootstrap-5.3.3/jquery-3.5.1.slim.min.js"></script>
<script src="../css/bootstrap-5.3.3/bootstrap.min.js"></script>
</body>
</html>
