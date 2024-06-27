<?php
session_start();
include('db_connect.php');

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

// Fetch user information
$username = $_SESSION['username'];
$query = "SELECT * FROM users WHERE username='$username'";
$result = mysqli_query($conn, $query);

// Check if query execution was successful
if (!$result) {
    die("Error executing query: " . mysqli_error($conn));
}

$user = mysqli_fetch_assoc($result);

// Check for new notifications
$new_notification = isset($_SESSION['new_notification']) && $_SESSION['new_notification'];

// Reset the new notification flag
unset($_SESSION['new_notification']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dairy Management System</title>
    <link rel="stylesheet" href="../css/bootstrap-5.3.3/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="../assets/fontawesome-free-6.5.2-web/css/fontawesome.css" rel="stylesheet" />
    <link href="../assets/fontawesome-free-6.5.2-web/css/brands.css" rel="stylesheet" />
    <link href="../assets/fontawesome-free-6.5.2-web/css/solid.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <style>
        body{
            background-color: lightgrey;
        }
        section {
            width: fit-content;
            padding: 20px;
            margin: auto;
            background-color: #fff;
            border-radius: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        body {
            animation: fadeIn 1s ease-in-out;
        }
        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            margin-top: 50px;
            animation: slideInUp 1s ease-in-out;
        }
        .card {
            width: 18rem;
            transition: transform 0.3s, box-shadow 0.3s;
            border-radius:20px;
        }
        .card:hover {
            transform: translateY(-20px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .dot {
            height: 8px;
            width: 8px;
            background-color: red;
            border-radius: 50%;
            display: inline-block;
            margin-left: 5px; /* Adjust this value for positioning */
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
        @keyframes slideInUp {
            from {
                transform: translateY(50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            padding: 40px;
            border-radius: 15px;
            border-top: 1px solid #dee2e6;
            margin-top: 20px;
            font-weight: bold;
            color: white;
        }
    </style>
</head>
<body>

<!-- Header -->
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <img src="../images/new.png" alt="logo" class="img-fluid" style="max-width: 100px;">
            <a class="navbar-brand" href="#">Dairy Serve Management System</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#"><i class="fas fa-user"></i> Welcome, <?php echo htmlspecialchars($user['username']); ?>!</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="buyer.php"><i class="fas fa-shopping-cart"></i> View Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="order_history.php"><i class="fas fa-history"></i> Order History</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="payment_history.php"><i class="fas fa-money-check-alt"></i> Payment History</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="notifications.php"><i class="fas fa-bell"></i> Notifications<?php if ($new_notification) echo '<span class="dot"></span>'; ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<br>
<!-- Main Content -->
<section>
    <div class="container">
        <div class="card-container">
            <div class="card p-3 mb-2 bg-success text-dark">
                <div class="card-body d-flex align-items-center justify-content-center">
                    <a href="buyer.php" class="text-dark text-center">
                        <center><img src="../gif/q8.gif" alt="animal info" style="width:150px;height:150px;"></center>
                        <h5 class="card-title"><i class="fas fa-box-open"></i> View Products</h5>
                    </a>
                </div>
            </div>
            <div class="card text-white bg-secondary">
                <div class="card-body d-flex align-items-center justify-content-center">
                    <a href="order_history.php" class="text-white text-center">
                        <center><img src="../images/buy.png" alt="animal info" style="width:150px;height:150px;"></center>
                        <h5 class="card-title"><i class="fas fa-receipt"></i> Order History</h5>
                    </a>
                </div>
            </div>
            <div class="card p-3 bg-warning text-dark">
                <div class="card-body d-flex align-items-center justify-content-center">
                    <a href="payment_history.php" class="text-dark text-center">
                        <center><img src="../gif/qr5.gif" alt="animal info" style="width:150px;height:150px;"></center>
                        <h5 class="card-title"><i class="fas fa-credit-card"></i> Payment History</h5>
                    </a>
                </div>
            </div>
            <div class="card p-3 bg-dark text-light">
                <div class="card-body d-flex align-items-center justify-content-center">
                    <a href="recent_orders.php" class="text-light text-center">
                        <center><img src="../images/recent.png" alt="animal info" style="width:150px;height:150px;"></center>
                        <h5 class="card-title"><i class="fas fa-box"></i> Recent Orders</h5>
                    </a>
                </div>
            </div>
            <div class="card p-3 bg-info text-dark">
                <div class="card-body d-flex align-items-center justify-content-center">
                    <a href="../change_password.html" class="text-dark text-center">
                        <center><img src="../images/bug.png" alt="animal info" style="width:150px;height:150px;"></center>
                        <h5 class="card-title"><i class="fas fa-key"></i> Change Password</h5>
                    </a>
                </div>
            </div>
            <div class="card text-dark bg-alert alert-primary">
                <div class="card-body d-flex align-items-center justify-content-center">
                    <a href="logout.php" class="text-dark text-center">
                        <center><img src="../gif/logout.gif" alt="animal info" style="width:150px;height:150px;"></center>
                        <h5 class="card-title"><i class="fas fa-sign-out-alt"></i> Logout</h5>
                    </a>
                </div>
            </div>
        </div>
    </div><br>
</section>
<!-- Footer -->
<footer class="footer bg-dark text-white mt-5">
    <div class="container text-center">
        <h4>&copy; 2023 Dairy Serve Management System. All Rights Reserved.</h4>
    </div>
</footer>

<!-- Bootstrap JS, Popper.js, and jQuery -->
<script src="../css/bootstrap-5.3.3/bootstrap.bundle.min.js"></script>
<script src="../css/bootstrap-5.3.3/popper.min.js"></script>
<script src="../css/bootstrap-5.3.3/jquery-3.5.1.slim.min.js"></script>
<script src="../css/bootstrap-5.3.3/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
