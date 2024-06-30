<?php
include 'snippets/head_footer.php';
require_once 'connection.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Entry</title>
    <link href="assets/fontawesome-free-6.5.2-web/css/fontawesome.css" rel="stylesheet" />
  <link href="assets/fontawesome-free-6.5.2-web/css/brands.css" rel="stylesheet" />
  <link href="assets/fontawesome-free-6.5.2-web/css/solid.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap-5.3.3/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        .container{
            width:50%;
        }
        .footer {
            background-color: #343a40;
            color: #fff;
            padding: 10px 0;
            position: absolute;
            bottom: 0;
            width: 100%;
            animation: fadeInUp 1s ease-out;
        }

        .footer p {
            margin: 0;
        }
        @keyframes fadeInUp {
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
        <div class="card shadow-sm">
            <div class="card-header text-center bg-primary text-white">
                <h3><i class="fas fa-pencil-alt"></i> Daily Data Entry Sheet</h3>
            </div>
            <div class="card-body">
                <?php
                if (isset($_SESSION['status'])) {
                    echo "<div class='alert alert-info'>".$_SESSION['status']."</div>";
                    unset($_SESSION['status']);
                }
                ?>
                <form action="valid.php" method="POST">
                    <div class="form-group mb-3">
                        <label for="fid"><i class="fas fa-user"></i> Farmer ID</label>
                        <input type="text" class="form-control" id="fid" name="fid" placeholder="Enter farmer ID" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="quan"><i class="fas fa-weight"></i> Quantity</label>
                        <input type="text" class="form-control" id="quan" name="quan" placeholder="Enter quantity" required>
                    </div>
                    <div class="form-group mb-4">
                        <label for="to-date"><i class="fas fa-calendar-alt"></i> Date</label>
                        <input type="date" class="form-control" id="to-date" name="to-date" required>
                    </div>
                    <center><button type="submit" name="senddata" class="btn btn-success btn-block"><i class="fas fa-paper-plane"></i> Submit</button></center>
                </form>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <footer class="footer bg-dark text-white text-center py-3 mt-5">
        <p>&copy; 2024 Your Company. All rights reserved. <i class="fas fa-heart"></i></p>
    </footer>
    <script src="css/bootstrap-5.3.3/bootstrap.bundle.min.js"></script>
    <script src="css/bootstrap-5.3.3/popper.min.js"></script>
    <script src="css/bootstrap-5.3.3/jquery-3.5.1.slim.min.js"></script>
    <script src="css/bootstrap-5.3.3/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
