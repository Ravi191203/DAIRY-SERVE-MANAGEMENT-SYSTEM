<?php
session_start();
require_once '../db_connect.php';

if (!isset($_SESSION["username"]) || $_SESSION["role"] != "farmer") {
    header("Location: login.php");
    exit();
}
echo "<center><b>Welcome, " . $_SESSION["username"] . "! You are logged in as Farmer.</b></center>";

$farmer_id = $_SESSION['farmer_id'];

$query = "SELECT * FROM farmer WHERE id = '$farmer_id'";
$result = mysqli_query($con, $query);

if ($result) {
    $farmer = mysqli_fetch_assoc($result);
} else {
    echo "Error: " . mysqli_error($con);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Farmer Details</title>
    <link href="../assets/fontawesome-free-6.5.2-web/css/fontawesome.css" rel="stylesheet" />
  <link href="../assets/fontawesome-free-6.5.2-web/css/brands.css" rel="stylesheet" />
  <link href="../assets/fontawesome-free-6.5.2-web/css/solid.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            transition: background-color 0.5s ease;
        }

        .container {
            margin-top: 50px;
            animation: fadeIn 1s ease-in-out;
        }

        table {
            animation: slideInUp 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideInUp {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        th, td {
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        th:hover, td:hover {
            background-color: #007bff;
            color: white;
        }
    </style>
</head>
<body>
<div class="container">
    <h2 class="text-center mb-4"><i class="fas fa-user"></i> Farmer Details</h2>
    <table class="table table-bordered">
        <tr>
            <th><i class="fas fa-id-card"></i> ID</th>
            <td><?php echo $farmer['id']; ?></td>
        </tr>
        <tr>
            <th><i class="fas fa-user"></i> Name</th>
            <td><?php echo $farmer['fname']; ?></td>
        </tr>
        <tr>
            <th><i class="fas fa-phone"></i> Phone</th>
            <td><?php echo $farmer['ph']; ?></td>
        </tr>
        <tr>
            <th><i class="fas fa-map-marker-alt"></i> Village ID</th>
            <td><?php echo $farmer['f_vid']; ?></td>
        </tr>
        <tr>
            <th><i class="fas fa-tint"></i> Milk Type</th>
            <td><?php echo $farmer['milk_type']; ?></td>
        </tr>
        <tr>
            <th><i class="fas fa-balance-scale"></i> Minimum Litre</th>
            <td><?php echo $farmer['min_litre']; ?></td>
        </tr>
        <tr>
            <th><i class="fas fa-calendar-alt"></i> Registration Date</th>
            <td><?php echo $farmer['reg_date']; ?></td>
        </tr>
        <tr>
            <th><i class="fas fa-paw"></i> Animal ID</th>
            <td><?php echo $farmer['animalID']; ?></td>
        </tr>
    </table>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
