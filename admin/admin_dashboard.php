<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link href="../assets/fontawesome-free-6.5.2-web/css/fontawesome.css" rel="stylesheet" />
    <link href="../assets/fontawesome-free-6.5.2-web/css/brands.css" rel="stylesheet" />
    <link href="../assets/fontawesome-free-6.5.2-web/css/solid.css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/bootstrap-5.3.3/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        body {
            background-color: lightgrey;
        }
        section {
            width: 90%;
            padding: 30px;
            margin: auto;
            background-color: #fff;
            border-radius: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .c1{
            width: 90%;
            padding: 1px;
            margin: auto;
            background-color: #fff;
            border-radius: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .container {
            margin-top: 50px;
        }
        h2 {
            margin-bottom: 30px;
        }
        table {
            table-layout: auto; /* Dynamic width for columns */
        }
        th, td {
            text-align: center;
            vertical-align: middle;
            padding: 8px;
            white-space: nowrap; /* Prevent text from wrapping */
        }
        th {
            background-color: #f8f9fa;
        }
        @media (max-width: 768px) {
            th, td {
                font-size: 0.9rem; /* Smaller font size for mobile */
            }
            .btn-sm {
                font-size: 0.8rem; /* Smaller button size for mobile */
            }
        }
    </style>
</head>
<body>
    
    <div class="container">
    <section class="c1">
        <h2 class="text-center">Admin Dashboard</h2>
        </section><br>
        <?php
        include '../db_connect.php';

        $query = "SELECT orders.*, customers.customer_name, customers.customer_mobile 
                  FROM orders 
                  JOIN customers ON orders.customer_id = customers.customer_id 
                  WHERE status='pending' ORDER BY order_date DESC";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) > 0) {
        ?>
        <section>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th><i class="fa fa-hashtag"></i> Order ID</th>
                        <th><i class="fa fa-user"></i> Customer Name</th>
                        <th><i class="fa fa-phone"></i> Customer Mobile</th>
                        <th><i class="fa fa-indian-rupee-sign"></i> Total Cost</th>
                        <th><i class="fa fa-credit-card"></i> Payment Mode</th>
                        <th><i class="fa fa-receipt"></i> Transaction ID</th>
                        <th><i class="fa fa-calendar"></i> Order Date</th>
                        <th><i class="fa fa-cogs"></i> Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($order = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $order['order_id']; ?></td>
                        <td><?php echo $order['customer_name']; ?></td>
                        <td><?php echo $order['customer_mobile']; ?></td>
                        <td><?php echo $order['total_cost']; ?></td>
                        <td><?php echo ucfirst($order['payment_mode']); ?></td>
                        <td><?php echo $order['transaction_id']; ?></td>
                        <td><?php echo $order['order_date']; ?></td>
                        <td>
                            <a href="admin_verify_order.php?order_id=<?php echo $order['order_id']; ?>&action=approve" class="btn btn-success btn-sm">Approve</a>
                            <a href="admin_verify_order.php?order_id=<?php echo $order['order_id']; ?>&action=decline" class="btn btn-danger btn-sm">Decline</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            </section>
        </div>
        <?php
        } else {
            echo "<p class='text-center'>No pending orders found.</p>";
        }
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
