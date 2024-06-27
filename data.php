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
    <link rel="stylesheet" href="css/bootstrap-5.3.3/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header text-center">
                <h3>Daily Data Entry Sheet</h3>
            </div>
            <div class="card-body">
                <?php
                if (isset($_SESSION['status'])) {
                    echo "<div class='alert alert-info'>".$_SESSION['status']."</div>";
                    unset($_SESSION['status']);
                }
                ?>
                <form action="valid.php" method="POST">
                    <div class="form-group">
                        <label for="fid">Farmer ID</label>
                        <input type="text" class="form-control" id="fid" name="fid" placeholder="Enter farmer ID" required>
                    </div>
                    <div class="form-group">
                        <label for="quan">Quantity</label>
                        <input type="text" class="form-control" id="quan" name="quan" placeholder="Enter quantity" required>
                    </div>
                    <div class="form-group">
                        <label for="to-date">Date</label>
                        <input type="date" class="form-control" id="to-date" name="to-date" required>
                    </div><br>
                    <center><button type="submit" name="senddata" class="btn btn-primary btn-block">Submit</button></center>
                </form>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p>&copy; 2024 Your Company. All rights reserved.</p>
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
