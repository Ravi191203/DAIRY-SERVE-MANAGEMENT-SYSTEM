<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order History</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="../assets/fontawesome-free-6.5.2-web/css/fontawesome.css" rel="stylesheet" />
  <link href="../assets/fontawesome-free-6.5.2-web/css/brands.css" rel="stylesheet" />
  <link rel="stylesheet" href="../css/bootstrap-5.3.3/bootstrap.min.css">
  <link href="../assets/fontawesome-free-6.5.2-web/css/solid.css" rel="stylesheet" />
    <style>
         section {
            background: lightblue;
            width: 90%;
            padding: 20px;
            margin: auto;
            
            border-radius: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        body {
            background: lightgrey;
            font-family: 'Arial', sans-serif;
        }
        .container {
            margin-top: 50px;
        }
        .table {
            background-color: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .table thead {
            background: linear-gradient(45deg, #007bff, #6610f2);
            color: white;
        }
        .table tbody tr {
            transition: background-color 0.3s ease;
        }
        .table tbody tr:hover {
            background-color: #f1f1f1;
        }
        .img-thumbnail {
            max-width: 100px;
            max-height: 100px;
        }
        @media (max-width: 768px) {
            .table thead {
                display: none;
            }
            .table, .table tbody, .table tr, .table td {
                display: block;
                width: 100%;
            }
            .table tr {
                margin-bottom: 15px;
            }
            .table td {
                text-align: right;
                padding-left: 50%;
                position: relative;
            }
            .table td::before {
                content: attr(data-label);
                position: absolute;
                left: 0;
                width: 50%;
                padding-left: 15px;
                font-weight: bold;
                text-align: left;
            }
        }
    </style>
</head>
<body><br>
    <section>
    <div class="container">
        <b><h2 class="text-center mb-2">Recent Orders</h2></b>
        </section><br>
        <?php
        session_start();
        include 'db_connect.php';

        // Check database connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Assuming you store the username in a session variable called 'username'
        $username = $_SESSION['username'];

        // Modify the query to filter orders by the user's username
        $recent_orders_query = "SELECT o.*, oi.product_id, p.product_name, oi.quantity, p.image_path, p.price
                                FROM orders o
                                JOIN order_items oi ON o.order_id = oi.order_id
                                JOIN products p ON oi.product_id = p.product_id
                                WHERE o.username = ?
                                ORDER BY o.order_date DESC
                                LIMIT 5";

        // Prepare the statement
        $stmt = $conn->prepare($recent_orders_query);

        // Check if the statement was prepared successfully
        if ($stmt === false) {
            die("Error preparing the statement: " . $conn->error);
        }

        // Bind the parameter and execute the query
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $recent_orders_result = $stmt->get_result();

        if ($recent_orders_result->num_rows > 0) {
        ?>
        <section>
            <div class="table-responsive">
                <table class="table table-bordered table-hover mt-4">
                    <thead>
                        <tr>
                            <th><i class="fas fa-receipt"></i> Order ID</th>
                            <th><i class="fas fa-calendar-alt"></i> Order Date</th>
                            <th><i class="fas fa-dollar-sign"></i> Total Cost</th>
                            <th><i class="fas fa-credit-card"></i> Payment Mode</th>
                            <th><i class="fas fa-info-circle"></i> Status</th>
                            <th><i class="fas fa-image"></i> Image</th>
                            <th><i class="fas fa-list"></i> Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($recent_order = $recent_orders_result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td data-label="Order ID"><?php echo $recent_order['order_id']; ?></td>
                            <td data-label="Order Date"><?php echo $recent_order['order_date']; ?></td>
                            <td data-label="Total Cost"><?php echo $recent_order['total_cost']; ?></td>
                            <td data-label="Payment Mode"><?php echo ucfirst($recent_order['payment_mode']); ?></td>
                            <td data-label="Status"><?php echo ucfirst($recent_order['status']); ?></td>
                            <td data-label="Image">
                                <?php if (!empty($recent_order['image_path'])): ?>
                                    <img src="<?php echo $recent_order['image_path']; ?>" alt="<?php echo $recent_order['product_name']; ?>" class="img-fluid img-thumbnail">
                                <?php else: ?>
                                    No Image Available
                                <?php endif; ?>
                            </td>
                            <td data-label="Details">
                                <a href="oc.php" class="btn btn-primary">
                                    <i class="fas fa-info-circle"></i> Details
                                </a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            </section>
        <?php
        } else {
            echo "<div class='alert alert-warning'>No recent orders found.</div>";
        }

        // Close the statement and connection
        $stmt->close();
        $conn->close();
        ?>
    </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../css/bootstrap-5.3.3/bootstrap.bundle.min.js"></script>
    <script src="../css/bootstrap-5.3.3/bootstrap.bundle.min.js"></script>
<script src="../css/bootstrap-5.3.3/popper.min.js"></script>
<script src="../css/bootstrap-5.3.3/jquery-3.5.1.slim.min.js"></script>
<script src="../css/bootstrap-5.3.3/bootstrap.min.js"></script>
</body>
</html>
