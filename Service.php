<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Services</title>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="dark.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="scroll.css">
    <link href="assets/fontawesome-free-6.5.2-web/css/fontawesome.css" rel="stylesheet" />
    <link href="assets/fontawesome-free-6.5.2-web/css/brands.css" rel="stylesheet" />
    <link href="assets/fontawesome-free-6.5.2-web/css/solid.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/bootstrap-5.3.3/bootstrap.min.css">
    <style>
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            border-radius: 15px;
            border-bottom: 1px solid #dee2e6;
        }
        .header .LOGO {
            height: 100px;
        }
        .header .list {
            list-style: none;
            display: flex;
        }
        .header .list li {
            margin-left: 20px;
        }
        .header .list a {
            text-decoration: none;
            color: #007bff;
        }
        .header .list a:hover {
            color: #0056b3;
        }
        .main-body {
            padding: 20px;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0,0,0,1);
            transition: transform 0.2s;
            text-align: center;
        }
        .card:hover {
            transform: scale(1.05);
        }
        .card img {
            border-radius: 15px 15px 0 0;
            width: 50%;
            height: 80%;
            object-fit: cover;
        }
        .card p {
            margin: 0;
            padding: 15px;
            font-size: 20px;
            font-weight: bold;
        }
        .footer {
            text-align: center;
            padding: 40px;
            border-radius: 15px;
            background-color: black;
            border-top: 1px solid #dee2e6;
            margin-top: 20px;
            font-weight: bold;
            color: white;
        }
        @media (max-width: 768px) {
            .card img {
                height: auto;
                width: 100%;
            }
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
    </style>
</head>
<body class="alert alert-primary">
<div id="jsScroll" class="scroll" onclick="scrollToTop();">
        <i class="fa fa-angle-up"></i>
      </div>
    
    <script src="app.js"></script>
<div>
  <input type="checkbox" class="checkbox" id="checkbox">
  <label for="checkbox" class="checkbox-label">
    <i class="fas fa-moon"></i>
    <i class="fas fa-sun"></i>
    <span class="ball"></span>
  </label>
</div>
<script>
    const checkbox = document.getElementById("checkbox")
checkbox.addEventListener("change", () => {
  document.body.classList.toggle("dark")
})
</script>
<!-- Header -->
<div class="header alert alert-light">
    <a href="startpage.php"><img src="images/new.png" alt="logo" class="LOGO"></a>
    <center><h2 class="">Service</h2></center>
    <ul class="list">
        <li><a href="startpage.php" class="effect">HOME</a></li>
        <li><a href="aboutus.html" class="effect">ABOUT US</a></li>
    </ul>
</div>

<!-- Body -->
<div class="main-body container">
    <!-- First row -->
    <div class="row">
        <div class="col-md-4 mb-4">
            <a href="farmer.php">
                <div class="card">
                    <center><img src="images/farmers.jpeg" alt="customer" stroke="bold" style="width:150px;height:150px;"></center>
                    <p>Farmer</p>
                </div>
            </a>
        </div>
        <div class="col-md-4 mb-4">
            <a href="staff.php">
                <div class="card">
                <center> <img src="gif/q7.gif" alt="data"  stroke="bold" style="width:150px;height:150px;"></center>
                    <p>Staff</p>
                </div>
            </a>
        </div>
        <div class="col-md-4 mb-4">
            <a href="data.php">
                <div class="card">
                <center> <img src="gif/q6.gif" alt="data"  stroke="bold" style="width:150px;height:150px;"></center>
                    <p>Data</p>
                </div>
            </a>
        </div>
    </div>
    <!-- Second row -->
    <div class="row">
        <div class="col-md-4 mb-4">
            <a href="bill.html">
                <div class="card">
                <center> <img src="images/stocks.jpg" alt="bill"  stroke="bold" style="width:150px;height:150px;"></center>
                    <p>Bill</p>
                </div>
            </a>
        </div>
        <div class="col-md-4 mb-4">
            <a href="admin/cart.php">
                <div class="card">
                <center> <img src="images/Dairyproducts.png" alt="dairy products"  stroke="bold" style="width:150px;height:150px;"></center>
                    <p>Dairy Products</p>
                </div>
            </a>
        </div>
        <div class="col-md-4 mb-4">
            <a href="Animalinfo.php">
                <div class="card">
                <center><img src="images/animals.png" alt="animal info" stroke="bold" style="width:220px;height:150px;"></center>
                    <p>Animal Info</p>
                </div>
            </a>
        </div>
        <div class="col-md-4 mb-4">
            <a href="admin/admin_dashboard.php">
                <div class="card">
                <center><img src="gif/qr5.gif" alt="animal info"  stroke="bold" style="width:150px;height:150px;"></center>
                    <p>Pending Payments Info</p>
                </div>
            </a>
        </div>
        <div class="col-md-4 mb-4">
            <a href="admin/admin_add_product.php">
                <div class="card">
                <center><img src="gif/q8.gif" alt="animal info"  stroke="bold" style="width:150px;height:150px;"></center>
                    <p>Add New Products to Cart</p>
                </div>
            </a>
        </div>
        <div class="col-md-4 mb-4">
            <a href="buyers/order_manage.php">
                <div class="card">
                <center><img src="gif/q4.gif" alt="animal info"  stroke="bold" style="width:150px;height:150px;"></center>
                    <p>Admin Order Management</p>
                </div>
            </a>
        </div>
    </div>
</div>

<!-- Footer -->
<div class="footer alert alert-info">
    <h5>&copy;2023 Dairy Serve Management System. All Rights Reserved</h5>
</div>
<script src="css/bootstrap-5.3.3/bootstrap.bundle.min.js"></script>
<script src="css/bootstrap-5.3.3/popper.min.js"></script>
<script src="css/bootstrap-5.3.3/jquery-3.5.1.slim.min.js"></script>
<script src="css/bootstrap-5.3.3/bootstrap.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>