<?php
session_start();
if (!isset($_SESSION["username"]) || $_SESSION["role"] != "farmer") {
    header("Location: login.php");
    exit();
}
echo "<center><b>Welcome, " . $_SESSION["username"] . "! You are logged in as Farmer.</b></center>";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farmer Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="assets/fontawesome-free-6.5.2-web/css/fontawesome.css" rel="stylesheet" />
  <link href="assets/fontawesome-free-6.5.2-web/css/brands.css" rel="stylesheet" />
  <link href="assets/fontawesome-free-6.5.2-web/css/solid.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            background: linear-gradient(45deg, blue 0%, #fad0c4 100%);
            background-size: 200% 200%;
            animation: gradientBackground 10s ease-in-out infinite;
        }

        @keyframes gradientBackground {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .card {
            border-radius: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: transform 0.2s, box-shadow 0.2s;
            text-align: center;
        }
        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 1);
        }
        .card img {
            border-radius: 20px 20px 0 0;
            width: 100%;
            height: 150px;
            object-fit: cover;
        }
        .navbar-brand img {
            height: 100px;
            width: 150px;
        }
        .btn-logout img {
            height: 30px;
            width: 30px;
        }
        .navbar {
            border-radius: 25px;
            width: 100%;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark alert alert-primary">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="/PROJECT-K/images/new.png" alt="Logo">
                </a>
                <h1 class="navbar-text text-dark">Dairy Serve Management System</h1>
                <div class="ml-auto">
                    <a href="/PROJECT-K/logout.php" class="btn btn-info btn-logout">
                        <img src="/PROJECT-K/images/logout.png" alt="Logout">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </div>
            </div>
        </nav>
    </header>
    <h2 class="text-center my-4">Farmer Dashboard</h2>
    <div class="row text-center alert alert-warning">
        <div class="col-md-3 mb-4">
            <div class="card">
                <a href="/PROJECT-K/farmer/farmer_details.php" class="text-decoration-none text-dark">
                    <img src="/PROJECT-K/images/farmers.jpeg" alt="Farmer">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-user"></i> Farmer Details</h5>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card">
                <a href="/PROJECT-K/farmer/edit_farmer_details.php" class="text-decoration-none text-dark">
                    <script src="https://cdn.lordicon.com/lordicon.js"></script>
                    <lord-icon
                        src="https://cdn.lordicon.com/zfzufhzk.json"
                        trigger="hover"
                        style="width:150px;height:150px">
                    </lord-icon>
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-edit"></i> Edit Details</h5>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card">
                <a href="/PROJECT-K/farmer/view_daily_data.php" class="text-decoration-none text-dark">
                    <img src="gif/q6.gif" style="width:150px;height:150px;">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-database"></i> Data</h5>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card">
                <a href="/PROJECT-K/farmer/add_daily_data.php" class="text-decoration-none text-dark">
                    <img src="gif/q2.gif" style="width:150px;height:150px;">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-plus"></i> Add Data</h5>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
