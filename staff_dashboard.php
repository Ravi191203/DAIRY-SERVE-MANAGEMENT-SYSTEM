<?php
session_start();
if (!isset($_SESSION["username"]) || $_SESSION["role"] != "staff") {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Staff Dashboard</title>
    <link href="assets/fontawesome-free-6.5.2-web/css/fontawesome.css" rel="stylesheet" />
  <link href="assets/fontawesome-free-6.5.2-web/css/brands.css" rel="stylesheet" />
  <link href="assets/fontawesome-free-6.5.2-web/css/solid.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(45deg, #6a11cb 0%, #2575fc 100%);
            color: white;
        }
        .card {
            
            border-radius: 20px;
            transition: transform 0.5s, box-shadow 0.5s;
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .card img {
            transition: opacity 0.5s;
        }

        .card:hover img {
            opacity: 0.8;
        }

        .card-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.5);
            color: #fff;
            padding: 1px;
            text-align: center;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .card:hover .card-overlay {
            opacity: 1;
        }

        /* Gradient animation */
        @keyframes gradientBackground {
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
        header{
            border-radius: 20px;
        }
        body {
            background: linear-gradient(270deg, #ff7e5f, #feb47b);
            background-size: 400% 400%;
            animation: gradientBackground 15s ease infinite;
        }

        .navbar {
            background-color: rgba(0, 0, 0, 0.8) !important;
            border-radius: 20px;
        }

        .navbar-brand img {
            width: 100px;
        }

        h1 {
            font-size: 2rem;
            font-weight: bold;
        }

        h2 {
            margin-bottom: 30px;
        }

        .card-body a {
            text-decoration: none;
            color: inherit;
        }

        footer {
            background-color: #343a40;
            padding: 20px;
            color: white;
            text-align: center;
        }

        .card-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.5);
            color: #fff;
            padding: 1px;
            text-align: center;
            opacity: 0;
            transition: opacity 0.3s;
        }
        .gradient-text {
            background: linear-gradient(45deg, blue, #ee0979);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-fill-color: transparent;
        }
        .card:hover .card-overlay {
            opacity: 1;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header>
        <nav class="navbar navbar-expand-lg alert alert-danger text-black">
            <div class="container">
                <a class="navbar-brand" href="#"><img src="/PROJECT-K/images/new.png" alt="Logo"></a>
                <h1 class="navbar-text text-white">Dairy Serve Management System</h1>
                <div class="ml-auto">
                <a href="logout.php" class="btn btn-outline-success"><i class="fas fa-sign-in-alt"></i> Logout</a>                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center">
        <center><h2 class=" gradient-text">Staff Dashboard</h2></center>
            <a href="/PROJECT-K/staff/staff_option.php" class="btn btn-outline-secondary">Back</a>
        </div>
        <div class="row mt-1">
            <div class="col-sm-6 col-md-4 col-lg-3 mb-3">
                <div class="card bg-light text-center transition-all">
                    <div class="card-body position-relative">
                        <a href="/PROJECT-K/staff/farmer_details.php">
                            <img src="/PROJECT-K/images/farmers.jpeg" alt="Farmer" style="width:150px;height:150px;">
                            <div class="card-overlay">
                                <h5>Farmer Details</h5>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3 mb-3">
                <div class="card bg-light text-center transition-all">
                    <div class="card-body position-relative">
                        <a href="/PROJECT-K/staff/view_staff_details.php">
                            <img src="/PROJECT-K/gif/q4.gif" alt="Staff" style="width:150px;height:150px;">
                            <div class="card-overlay">
                                <h5>Logged in Staff Details</h5>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3 mb-3">
                <div class="card bg-light text-center transition-all">
                    <div class="card-body position-relative">
                        <a href="/PROJECT-K/staff/animal_details.php">
                            <img src="images/cow_.png" alt="Animal" style="width:150px;height:150px;">
                            <div class="card-overlay">
                                <h5>Animal Details</h5>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3 mb-3">
                <div class="card bg-light text-center transition-all">
                    <div class="card-body position-relative">
                        <a href="/PROJECT-K/staff/daily_data.php">
                            <img src="/PROJECT-K/gif/q1.gif" alt="Daily Data" style="width:150px;height:150px;">
                            <div class="card-overlay">
                                <h5>View Daily Data</h5>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3 mb-3">
                <div class="card bg-light text-center transition-all">
                    <div class="card-body position-relative">
                        <a href="/PROJECT-K/staff/add_daily_data.php">
                            <img src="images/mail-inbox-add-16-filled_.png" alt="Daily Data" style="width:150px;height:150px;">
                            <div class="card-overlay">
                                <h5>Add Daily Data</h5>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3 mb-3">
                <div class="card bg-light text-center transition-all">
                    <div class="card-body position-relative">
                        <a href="/PROJECT-K/staff/view_bills.php">
                            <img src="/PROJECT-K/gif/q3.gif" alt="View Bills" style="width:150px;height:150px;">
                            <div class="card-overlay">
                                <h5>View Bills</h5>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3 mb-3">
                <div class="card bg-light text-center transition-all">
                    <div class="card-body position-relative">
                        <a href="/PROJECT-K/staff/generate_bill.php">
                            <img src="images/bill_ (1).png" alt="Generate Bill" style="width:150px;height:150px;">
                            <div class="card-overlay">
                                <h5>Generate Bill</h5>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3 mb-3">
                <div class="card bg-light text-center transition-all">
                    <div class="card-body position-relative">
                        <a href="/PROJECT-K/add_customer_process.php">
                            <img src="/PROJECT-K/gif/q2.gif" alt="Add Customers" style="width:150px;height:150px;">
                            <div class="card-overlay">
                                <h5>Add Customers</h5>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3 mb-3">
                <div class="card bg-light text-center transition-all">
                    <div class="card-body position-relative">
                        <a href="/PROJECT-K/staff/staff_cart.php">
                            <img src="/PROJECT-K/images/Dairyproducts.png" alt="Cart" style="width:150px;height:150px;">
                            <div class="card-overlay">
                                <h5>Cart</h5>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer bg-dark text-white mt-5">
        <div class="container text-center">
            <p>&copy; 2023 Dairy Serve Management System. All Rights Reserved.</p>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
</body>

</html>
