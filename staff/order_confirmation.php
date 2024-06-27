<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Confirmation</title>
    <link rel="stylesheet" href="../css/bootstrap-5.3.3/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Order Confirmation</h2>

        <?php
        include 'db_connect.php';

        if (isset($_GET['order_id'])) {
            $order_id = $_GET['order_id'];

            // Fetch order details
            $query = "SELECT orders.*, customers.customer_name, customers.customer_mobile 
                    FROM orders 
                    JOIN customers ON orders.customer_id = customers.customer_id 
                    WHERE orders.order_id='$order_id'";
            $result = mysqli_query($conn, $query);

            if (!$result) {
                echo "Error: " . mysqli_error($conn);
            }

            $order = mysqli_fetch_assoc($result);

            if ($order) {
                // Fetch order items with product details
                // Fetch order items with product details
$query = "SELECT order_items.*, products.product_name, products.price, products.image_path 
FROM order_items
JOIN products ON order_items.product_id = products.product_id 
WHERE order_items.order_id='$order_id'";
$items_result = mysqli_query($conn, $query);


                if (!$items_result) {
                    echo "Error: " . mysqli_error($conn);
                }
        ?>
        <div class="card mb-4">
            <div class="card-body">
                <h4 class="card-title">Order Details</h4>
                <p><strong>Order ID:</strong> <?php echo $order['order_id']; ?></p>
                <p><strong>Customer Name:</strong> <?php echo $order['customer_name']; ?></p>
                <p><strong>Customer Mobile:</strong> <?php echo $order['customer_mobile']; ?></p>
                <p><strong>Total Cost:</strong> <?php echo $order['total_cost']; ?></p>
                <p><strong>Payment Mode:</strong> <?php echo ucfirst($order['payment_mode']); ?></p>
                <p><strong>Status:</strong> <?php echo ucfirst($order['status']); ?></p>

                <h5>Order Items</h5>
                <ul class="list-group">
                    <?php while ($item = mysqli_fetch_assoc($items_result)) { ?>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-2">
                                    <?php if (!empty($item['image_path'])): ?>
                                        <img src="<?php echo $item['image_path']; ?>" alt="<?php echo $item['product_name']; ?>" style="max-width: 100px;">
                                    <?php else: ?>
                                        No Image Available
                                    <?php endif; ?>
                                </div><br>
                                <div class="col">
                                    <strong>Product:</strong><br> <?php echo $item['product_name']; ?>,
                                    <strong>Quantity:</strong><br> <?php echo $item['quantity']; ?>,
                                    <strong>Price:</strong> <?php echo $item['price']; ?>
                                </div>
                            </div>
                        </li>
                    <?php } ?>
                </ul><br><br>
                <?php if ($order['status'] === 'approved'): ?>
        <button onclick="window.print()" class="btn btn-danger">Print Invoice</button>
    <?php endif; ?>
            </div>
        </div>
        <?php
            } else {
                echo "<p>Order not found.</p>";
            }
        } else {
            echo "<p>Invalid Order ID.</p>";
        }
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../css/bootstrap-5.3.3/bootstrap.bundle.min.js"></script>
<script src="../css/bootstrap-5.3.3/popper.min.js"></script>
<script src="../css/bootstrap-5.3.3/jquery-3.5.1.slim.min.js"></script>
<script src="../css/bootstrap-5.3.3/bootstrap.min.js"></script>
</body>
</html>
