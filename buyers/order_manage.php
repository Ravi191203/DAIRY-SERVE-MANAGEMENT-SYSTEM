<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Order Management</title>
    <link href="../assets/fontawesome-free-6.5.2-web/css/fontawesome.css" rel="stylesheet" />
  <link href="../assets/fontawesome-free-6.5.2-web/css/brands.css" rel="stylesheet" />
  <link href="../assets/fontawesome-free-6.5.2-web/css/solid.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: lightgrey;
        }
        section {
            padding: 20px;
            margin: auto;
            background-color: #fff;
            border-radius: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .order-management {
            margin-top: 50px;
        }
        .order-table {
            margin-bottom: 30px;
        }
        .order-items {
            margin-top: 30px;
        }
        .order-items img {
            max-width: 100px;
        }
        .order-actions button {
            margin-right: 5px;
        }
        .order-actions form {
            display: inline-block;
        }
    </style>
</head>
<body>
    
    <div class="container order-management">
    <section style="background:white;">
        <h2 class="text-center mb-2">Admin Order Management</h2>
        </section>
        <br>
        <?php
        include 'db_connect.php';

        $query = "SELECT o.*, oi.product_id, p.product_name, oi.quantity, p.image_path, p.price
                  FROM orders o
                  JOIN order_items oi ON o.order_id = oi.order_id
                  JOIN products p ON oi.product_id = p.product_id
                  ORDER BY o.order_date DESC";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
        ?>
        <section>
            <div class="table-responsive order-table">
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                        <th><i class="fa fa-hashtag"></i> Order ID</th>
                        <th><i class="fa fa-calendar"></i> Order Date</th>
                        <th><i class="fa fa-indian-rupee-sign"></i> Total Cost</th>
                        <th><i class="fa fa-credit-card"></i> Payment Mode</th>
                        <th><i class="fa fa-info-circle"></i> Status</th>
                        <th><i class="fa fa-cogs"></i> Actions</th>
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
                            <td class="order-actions">
                                <form method="POST">
                                    <input type="hidden" name="delete_order_id" value="<?php echo $row['order_id']; ?>">
                                    <input type="hidden" name="delete_product_id" value="<?php echo $row['product_id']; ?>">
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                                <button onclick="printOrder(<?php echo $row['order_id']; ?>)" class="btn btn-secondary btn-sm">Print</button>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <br>
            </div>
            
            <h5 class="order-items">Order Items</h5>
            <ul class="list-group">
                <?php
                mysqli_data_seek($result, 0); // Reset result pointer
                while ($item = mysqli_fetch_assoc($result)) { ?>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-2">
                                <?php if (!empty($item['image_path'])): ?>
                                    <img src="<?php echo $item['image_path']; ?>" alt="<?php echo $item['product_name']; ?>" class="img-thumbnail">
                                <?php else: ?>
                                    No Image Available
                                <?php endif; ?>
                            </div>
                            <div class="col">
                                <strong>Product:</strong> <?php echo $item['product_name']; ?><br>
                                <strong>Quantity:</strong> <?php echo $item['quantity']; ?><br>
                                <strong>Price:</strong> ₹ <?php echo $item['price']; ?>
                            </div>
                        </div>
                    </li>
                <?php } ?>
            </ul>
            
        <?php
        } else {
            echo "<p>No orders found.</p>";
        }

        // Process delete request
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_order_id']) && isset($_POST['delete_product_id'])) {
            $delete_order_id = mysqli_real_escape_string($conn, $_POST['delete_order_id']);
            $delete_product_id = mysqli_real_escape_string($conn, $_POST['delete_product_id']);

            $delete_query = "DELETE FROM order_items WHERE order_id='$delete_order_id' AND product_id='$delete_product_id'";
            mysqli_query($conn, $delete_query);

            // Optionally, check if there are no more items in the order and delete the order itself
            $check_order_query = "SELECT * FROM order_items WHERE order_id='$delete_order_id'";
            $check_order_result = mysqli_query($conn, $check_order_query);
            if (mysqli_num_rows($check_order_result) == 0) {
                $delete_order_query = "DELETE FROM orders WHERE order_id='$delete_order_id'";
                mysqli_query($conn, $delete_order_query);
            }

            // Refresh the page to show updated order list
            echo "<meta http-equiv='refresh' content='0'>";
        }
        ?>
    </div>
    
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
    </section>
</body>
</html>
