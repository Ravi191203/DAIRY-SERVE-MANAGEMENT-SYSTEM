<?php
session_start();
include 'db_connect.php';

$result = null;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['order_id'])) {
    $order_id = mysqli_real_escape_string($conn, $_POST['order_id']);
    $query = "SELECT * FROM orders WHERE order_id='$order_id' AND payment_mode='online' ORDER BY order_date DESC";
    $result = mysqli_query($conn, $query);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment History</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/fontawesome-free-6.5.2-web/css/fontawesome.css" rel="stylesheet" />
  <link href="../assets/fontawesome-free-6.5.2-web/css/brands.css" rel="stylesheet" />
  <link href="../assets/fontawesome-free-6.5.2-web/css/solid.css" rel="stylesheet" />
    <style>
        section {
            padding: 20px;
            margin: auto;
            background-color: #fff;
            border-radius: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Payment History</h2>
        <section>
        <form method="POST" class="mb-3">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Enter Order ID" name="order_id" required>
                <button type="submit" class="btn btn-primary"><i class="fa fa-eye"></i> View Status</button>
            </div>
        </form>
        <?php if ($result && mysqli_num_rows($result) > 0) { ?>
           

            
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th><i class="fas fa-receipt"></i> Order ID</th>
                    <th><i class="fas fa-dollar-sign"></i> Total Cost</th>
                    <th><i class="fas fa-credit-card"></i> Transaction ID</th>
                    <th><i class="fa fa-info-circle"></i> Status</th>
                    <th><i class="fa fa-calendar"></i>  Order Date</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($order = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $order['order_id']; ?></td>
                    <td><?php echo $order['total_cost']; ?></td>
                    <td><?php echo $order['transaction_id']; ?></td>
                    <td><?php echo ucfirst($order['status']); ?></td>
                    <td><?php echo $order['order_date']; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table></section>
        <?php } else if ($result && mysqli_num_rows($result) == 0) {
            echo "<p>No payments found for the specified order ID.</p>";
        } ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
