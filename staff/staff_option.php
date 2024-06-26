<?php
session_start();

// Check if the user is logged in and the eid is set
if (!isset($_SESSION['eid'])) {
    header('Location: verify_staff.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Staff Options</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css">
    <link href="../assets/fontawesome-free-6.5.2-web/css/fontawesome.css" rel="stylesheet" />
  <link href="../assets/fontawesome-free-6.5.2-web/css/brands.css" rel="stylesheet" />
  <link href="../assets/fontawesome-free-6.5.2-web/css/solid.css" rel="stylesheet" />
    <style>
        body {
            background: linear-gradient(135deg, red 0%, blue 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background-size: 200% 200%;
            animation: gradientBackground 10s ease-in-out infinite;
        }
        @keyframes gradientBackground {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .h2{
            background: -webkit-linear-gradient(white,blue);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: gradientBackground1 10s ease-in-out infinite;
        }
        @keyframes gradientBackground {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .navbar, .footer {
            border-radius: 15px;
        }
        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            margin-top: 50px;
        }
        .card {
            width: 200px;
            transition: transform 0.3s, box-shadow 0.3s;
            text-align: center;
        }
        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.5);
        }
        .card img {
            width: 150px;
            height: 150px;
            transition: transform 0.3s;
        }
        .card:hover img {
            transform: scale(1.1);
        }
        .card-title {
            font-size: 1.2rem;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<!-- Header -->
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mx-3 mt-3">
        <div class="container">
            <a class="navbar-brand" href="#">Dairy Serve Management System <i class="fa-solid fa-cow" style="color: #ffffff;"></i></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../startstaff.php"><i class="fa-solid fa-igloo" style="color: #ffffff;"></i> Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../staff_dashboard.php"><i class="fa-brands fa-servicestack" style="color: #ffffff;"></i> Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../gallerybuyer.html"><i class="fa-solid fa-lightbulb" style="color: #ffffff;"></i> About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../contact.php"><i class="fa-solid fa-id-badge" style="color: #ffffff;"></i> Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../logout.php"><i class="fa-solid fa-arrow-right-from-bracket" style="color: #ffffff;"></i> Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<!-- Main Content -->
<div class="container flex-grow-1 d-flex flex-column">
    <h2 class="h2 text-center mt-4 text-white">Staff Options</h2>
    <div class="card-container">
        <div class="card bg-primary text-white">
            <div class="card-body d-flex flex-column align-items-center justify-content-center">
                <i class="fas fa-search fa-2x mb-2"></i> <!-- Font Awesome Icon -->
                <img src="../images/search.png" alt="View Details" class="mb-2"> <!-- Existing Image -->
                <a href="view_staff_details.php" class="text-white text-decoration-none">
                    <h5 class="card-title">View Details</h5>
                </a>
            </div>
        </div>
        <div class="card bg-secondary text-white">
            <div class="card-body d-flex flex-column align-items-center justify-content-center">
                <i class="fas fa-edit fa-2x mb-2"></i> <!-- Font Awesome Icon -->
                <img src="../gif/q9.gif" alt="Edit Details" class="mb-2"> <!-- Existing Image -->
                <a href="edit_staff_details.php" class="text-white text-decoration-none">
                    <h5 class="card-title">Edit Details</h5>
                </a>
            </div>
        </div>
        <div class="card bg-danger text-white">
            <div class="card-body d-flex flex-column align-items-center justify-content-center">
                <i class="fas fa-tachometer-alt fa-2x mb-2"></i> <!-- Font Awesome Icon -->
                <img src="../images/dashboard1.png" alt="Dashboard" class="mb-2"> <!-- Existing Image -->
                <a href="../staff_dashboard.php" class="text-white text-decoration-none">
                    <h5 class="card-title">Dashboard</h5>
                </a>
            </div>
        </div>
        <div class="card bg-info text-dark">
            <div class="card-body d-flex flex-column align-items-center justify-content-center">
                <i class="fas fa-key fa-2x mb-2"></i> <!-- Font Awesome Icon -->
                <img src="../images/bug.png" alt="Change Password" class="mb-2"> <!-- Existing Image -->
                <a href="../change_password.html" class="text-dark text-decoration-none">
                    <h5 class="card-title">Change Password</h5>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="footer bg-dark text-white mt-5 py-3">
    <div class="container text-center">
        <p>&copy; 2024 Dairy Management System. All Rights Reserved.</p>
    </div>
</footer>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>
