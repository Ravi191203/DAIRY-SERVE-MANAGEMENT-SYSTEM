<?php
session_start();
if (!isset($_SESSION["username"]) || $_SESSION["role"] != "staff") {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Staff Dashboard</title>
    <link rel="stylesheet" href="css/bootstrap-5.3.3/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            background-size: 200% 200%;
            animation: gradientBackground 10s ease-in-out infinite;
        }
        @keyframes gradientBackground {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .navbar {
            background-color: #4b6cb7;
            border-radius: 15px;
        }

        .navbar-brand img {
            width: 100px;
        }

        h1, h2 {
            font-weight: bold;
        }

        .btn-outline-secondary {
            color: white;
            border-color: white;
        }

        .btn-outline-secondary:hover {
            background-color: white;
            color: #4b6cb7;
        }

        .section {
            background: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 15px;
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .section img {
            width: 100px;
            height: 100px;
            margin-bottom: 10px;
        }

        .section:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .footer {
            background-color: #343a40;
            padding: 20px;
            color: white;
            text-align: center;
        }
        h5{
            text-decoration: none;
            color:white;
            font-weight:bold;
        }
        a{
            text-decoration: none;
            color:white;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container">
                <a class="navbar-brand" href="#"><img src="/dairy-serve-management-system/images/new.png" alt="Logo"></a>
                <h1 class="navbar-text">Dairy Serve Management System</h1>
                <div class="ml-auto">
                    <a href="logout.php" class="btn btn-danger"><i class="fas fa-sign-in-alt"></i> Logout</a>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="text-center">STAFF DASHBOARD</h2>
            <a href="/dairy-serve-management-system/staff/staff_option.php" class="btn btn-outline-secondary">Back</a>
        </div>
        <div class="row mt-3">
            <div class="col-md-4 mb-3">
                <div class="section">
                    <a href="/dairy-serve-management-system/staff/farmer_details.php">
                        <img src="/dairy-serve-management-system/images/farmers.jpeg" alt="Farmer">
                        <h5>Farmer Details</h5>
                    </a>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="section">
                    <a href="/dairy-serve-management-system/staff/view_staff_details.php">
                        <img src="/dairy-serve-management-system/gif/q12.gif" alt="Staff">
                        <h5>Logged in Staff Details</h5>
                    </a>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="section">
                    <a href="/dairy-serve-management-system/staff/animal_details.php">
                        <img src="images/cow_.png" alt="Animal">
                        <h5>Animal Details</h5>
                    </a>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="section">
                    <a href="/dairy-serve-management-system/staff/daily_data.php">
                        <img src="/dairy-serve-management-system/gif/q1.gif" alt="Daily Data">
                        <h5>View Daily Data</h5>
                    </a>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="section">
                    <a href="/dairy-serve-management-system/staff/add_daily_data.php">
                        <img src="images/mail-inbox-add-16-filled_.png" alt="Daily Data">
                        <h5>Add Daily Data</h5>
                    </a>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="section">
                    <a href="/dairy-serve-management-system/staff/view_bills.php">
                        <img src="/dairy-serve-management-system/gif/q3.gif" alt="View Bills">
                        <h5>View Bills</h5>
                    </a>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="section">
                    <a href="/dairy-serve-management-system/staff/generate_bill.php">
                        <img src="images/bill_ (1).png" alt="Generate Bill">
                        <h5>Generate Bill</h5>
                    </a>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="section">
                    <a href="/dairy-serve-management-system/add_customer_process.php">
                        <img src="/dairy-serve-management-system/gif/q2.gif" alt="Add Customers">
                        <h5>Add Customers</h5>
                    </a>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="section">
                    <a href="/dairy-serve-management-system/staff/staff_cart.php">
                        <img src="/dairy-serve-management-system/images/Dairyproducts.png" alt="Cart">
                        <h5>Cart</h5>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer mt-5">
        <div class="container text-center">
            <p>&copy; 2023 Dairy Serve Management System. All Rights Reserved.</p>
        </div>
    </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
</body>

</html>
