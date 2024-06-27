<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order History</title>
    <link href="../assets/fontawesome-free-6.5.2-web/css/fontawesome.css" rel="stylesheet" />
  <link href="../assets/fontawesome-free-6.5.2-web/css/brands.css" rel="stylesheet" />
  <link href="../assets/fontawesome-free-6.5.2-web/css/solid.css" rel="stylesheet" />
  <link rel="stylesheet" href="../css/bootstrap-5.3.3/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
        .img-thumbnail {
            max-width: 100px;
            max-height: 100px;
        }
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
    <div class="container">
        <section>
        <h2 class="text-center mb-4">Order History</h2>

        <form method="POST" class="mb-3">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Enter Order ID" name="order_id" required>
                <button type="submit" class="btn btn-primary">View Orders</button>
            </div>
        </form>
        
        <?php
        include 'db_connect.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['order_id'])) {
            $order_id = mysqli_real_escape_string($conn, $_POST['order_id']);

            $query = "SELECT o.*, oi.product_id, p.product_name, oi.quantity, p.image_path, p.price
                      FROM orders o
                      JOIN order_items oi ON o.order_id = oi.order_id
                      JOIN products p ON oi.product_id = p.product_id
                      WHERE o.order_id='$order_id'
                      ORDER BY o.order_date DESC";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
        ?>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th><i class="fas fa-receipt"></i> Order ID</th>
                            <th><i class="fas fa-calendar-alt"></i> Order Date</th>
                            <th><i class="fas fa-dollar-sign"></i> Total Cost</th>
                            <th><i class="fas fa-credit-card"></i> Payment Mode</th>
                            <th><i class="fas fa-info-circle"></i> Status</th>
                            <th><i class="fa fa-bolt"></i>  Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <td><?php echo $row['order_id']; ?></td>
                            <td><?php echo $row['order_date']; ?></td>
                            <td><?php echo $row['total_cost']; ?></td>
                            <td><?php echo ucfirst($row['payment_mode']); ?></td>
                            <td><?php echo ucfirst($row['status']); ?></td>
                            <td>
                                <form method="POST" style="display:inline-block;">
                                    <input type="hidden" name="delete_order_id" value="<?php echo $row['order_id']; ?>">
                                    <input type="hidden" name="delete_product_id" value="<?php echo $row['product_id']; ?>">
                                    <button type="submit" class="btn btn-danger btn-sm">Cancel Order</button>
                                </form>
                                <button onclick="printOrder(<?php echo $row['order_id']; ?>)" class="btn btn-secondary btn-sm">Print</button>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <h5 class="mt-4">Order Items</h5>
            <ul class="list-group">
                <?php
                mysqli_data_seek($result, 0); // Reset result pointer
                while ($item = mysqli_fetch_assoc($result)) { ?>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-2">
                                <?php if (!empty($item['image_path'])): ?>
                                    <img src="<?php echo $item['image_path']; ?>" alt="<?php echo $item['product_name']; ?>" class="img-fluid img-thumbnail">
                                <?php else: ?>
                                    No Image Available
                                <?php endif; ?>
                            </div>
                            <div class="col-md-10">
                                <strong>Product:</strong> <?php echo $item['product_name']; ?><br>
                                <strong>Quantity:</strong> <?php echo $item['quantity']; ?><br>
                                <strong>Price:</strong> <?php echo $item['price']; ?>
                            </div>
                        </div>
                    </li>
                <?php } ?>
            </ul>
            </section>
        <?php
            } else {
                echo "<div class='alert alert-warning'>No orders found for order ID: $order_id</div>";
            }
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_order_id']) && isset($_POST['delete_product_id'])) {
            $delete_order_id = mysqli_real_escape_string($conn, $_POST['delete_order_id']);
            $delete_product_id = mysqli_real_escape_string($conn, $_POST['delete_product_id']);

            $delete_query = "DELETE FROM order_items WHERE order_id='$delete_order_id' AND product_id='$delete_product_id'";
            mysqli_query($conn, $delete_query);

            $check_order_query = "SELECT * FROM order_items WHERE order_id='$delete_order_id'";
            $check_order_result = mysqli_query($conn, $check_order_query);
            if (mysqli_num_rows($check_order_result) == 0) {
                $delete_order_query = "DELETE FROM orders WHERE order_id='$delete_order_id'";
                mysqli_query($conn, $delete_order_query);
            }

            echo "<meta http-equiv='refresh' content='0'>";
        }
        ?>

        

    <script>
        function printOrder(orderId) {
            const printContent = document.querySelectorAll('tr td:first-child').forEach(td => {
                if (td.textContent == orderId) {
                    window.print();
                }
            });
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../css/bootstrap-5.3.3/bootstrap.bundle.min.js"></script>
    <script src="../css/bootstrap-5.3.3/bootstrap.bundle.min.js"></script>
<script src="../css/bootstrap-5.3.3/popper.min.js"></script>
<script src="../css/bootstrap-5.3.3/jquery-3.5.1.slim.min.js"></script>
<script src="../css/bootstrap-5.3.3/bootstrap.min.js"></script>
</body>
</html>
