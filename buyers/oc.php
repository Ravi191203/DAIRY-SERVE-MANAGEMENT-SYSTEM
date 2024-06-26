<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Confirmation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .list-group-item {
            border: none;
            border-bottom: 1px solid #ddd;
        }
        .list-group-item:last-child {
            border-bottom: none;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center"><i class="fas fa-check-circle"></i> Order Confirmation</h2>

        <form method="GET" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="mb-3">
                <label for="order_id" class="form-label"><i class="fas fa-receipt"></i> Enter Order ID:</label>
                <input type="text" class="form-control" id="order_id" name="order_id" required>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Verify</button>
        </form>

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
                // Check if the order belongs to the current user or role (you can modify this check based on your user authentication logic)
                $isAuthorized = true; // Assuming the current user or role is authorized to view this order

                if ($isAuthorized) {
                    // Fetch order items with product details
                    $items_query = "SELECT order_items.*, products.product_name, products.price, products.image_path 
                                    FROM order_items
                                    JOIN products ON order_items.product_id = products.product_id 
                                    WHERE order_items.order_id='$order_id'";
                    $items_result = mysqli_query($conn, $items_query);

                    if (!$items_result) {
                        echo "Error: " . mysqli_error($conn);
                    }
        ?>
        <div class="card mb-4">
            <div class="card-body">
                <h2 class="card-title"> Order Details</h2><br>
                <p><strong><i class="fas fa-receipt"></i> Order ID:</strong> <?php echo $order['order_id']; ?></p>
                <p><strong><i class="fas fa-user"></i> Customer Name:</strong> <?php echo $order['customer_name']; ?></p>
                <p><strong><i class="fas fa-phone"></i> Customer Mobile:</strong> <?php echo $order['customer_mobile']; ?></p>
                <p><strong><i class="fas fa-dollar-sign"></i> Total Cost:</strong> <?php echo $order['total_cost']; ?></p>
                <p><strong><i class="fas fa-credit-card"></i> Payment Mode:</strong> <?php echo ucfirst($order['payment_mode']); ?></p>
                <p><strong><i class="fas fa-info-circle"></i> Status:</strong> <?php echo ucfirst($order['status']); ?></p>

                <h5><i class="fas fa-box"></i> Order Items</h5>
                <ul class="list-group">
                    <?php while ($item = mysqli_fetch_assoc($items_result)) { ?>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-2">
                                    <?php if (!empty($item['image_path'])): ?>
                                        <img src="<?php echo $item['image_path']; ?>" alt="<?php echo $item['product_name']; ?>" class="img-fluid img-thumbnail" style="max-width: 100px;">
                                    <?php else: ?>
                                        <i class="fas fa-image"></i> No Image Available
                                    <?php endif; ?>
                                </div>
                                <div class="col">
                                    <strong><i class="fas fa-tag"></i> Product:</strong> <?php echo $item['product_name']; ?><br>
                                    <strong><i class="fas fa-sort-numeric-up"></i> Quantity:</strong> <?php echo $item['quantity']; ?><br>
                                    <strong><i class="fas fa-dollar-sign"></i> Price:</strong> <?php echo $item['price']; ?>
                                </div>
                            </div>
                        </li>
                    <?php } ?>
                </ul><br><br>
                <?php if ($order['status'] === 'approved'): ?>
                    <button onclick="window.print()" class="btn btn-danger"><i class="fas fa-print"></i> Print Invoice</button>
                <?php endif; ?>
            </div>
        </div>
        <?php
                } else {
                    echo "<p>You are not authorized to view this order.</p>";
                }
            } else {
                echo "<p>Order not found.</p>";
            }
        }
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
