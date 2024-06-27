<?php
include 'db_connect.php';
session_start(); // Start the session to access session variables

// Assuming the username is stored in the session during login
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    // Redirect to login page if the user is not logged in
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Process order placement here
    $username = $_SESSION['username']; // Get the logged-in username

    // Add further order processing logic here...
}

// Fetch products
$query = "SELECT * FROM products";
$result = mysqli_query($conn, $query);
$products = [];

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $products[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dairy Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/bootstrap-5.3.3/bootstrap.min.css">
    <link href="../assets/fontawesome-free-6.5.2-web/css/fontawesome.css" rel="stylesheet" />
    <link href="../assets/fontawesome-free-6.5.2-web/css/brands.css" rel="stylesheet" />
    <link href="../assets/fontawesome-free-6.5.2-web/css/solid.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <style>
        body {
            background-color: lightgrey;
        }

        .out-of-stock {
            position: relative;
            color: red;
            background-color: rgba(255, 0, 0, 0.1);
            /* Dim background color */
        }

        .out-of-stock::after {
            content: "Shortly it will be available";
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 24px;
            font-weight: bold;
            color: rgba(255, 0, 0, 0.5);
            /* Dim text color */
            text-align: center;
            z-index: 1;
        }

        .out-of-stock img {
            opacity: 0.5;
            /* Dim image */
        }

        .out-of-stock td {
            position: relative;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
            padding: 40px;
            border-radius: 15px;
            border-top: 1px solid #dee2e6;
            margin-top: 20px;
            font-weight: bold;
            color: white;

        }
        .form-control{
            border-radius: 15px;
            padding: 10px;
        }
        header {
            background-color: lightblue;
            border-radius: 20px;
        }

        td {

            vertical-align: top;
            padding: 20px;

        }

        section {
            padding: 20px;
            margin: auto;
            background-color: #fff;
            border-radius: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin: 20px 0;
        }

        header {
            background: linear-gradient(45deg, #ffee00, #FF5733);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 20px;
            margin-top: 20px;
            padding: 5px;
        }

        header h1 {
            color: white;
            font-size: 36px;
            font-weight: 700;
        }
        .footer{
            width: 87%;
            margin-left: 90px;
        }
    </style>
</head>

<body>
    <div class="container my-4">
        <section>
            <header>
                <center>
                    <h2 style="color:white">
                        <img src="../images/new.png" alt="logo" class="img-fluid" style="width:200px; height:130px">
                        ನಂದಿನಿ ಹಾಲಿನ ಉತ್ಪಾದನೆಗಳು
                    </h2>
                </center>
            </header>
        </section>
        <br><br>
        <form action="place_order.php" method="POST">
            <section>
                <h3 class="text-center text-success mb-4">Dairy Products</h3>
                <input type="hidden" name="username" value="<?= $username; ?>"> <!-- Hidden username field -->
                <div class="mb-3 row">
                    <label for="customer_name" class="col-sm-2 col-form-label"><i class="fa-solid fa-user-secret"></i> Customer Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="customer_name" placeholder="NAME" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="customer_mobile" class="col-sm-2 col-form-label"><i class="fa-solid fa-mobile-screen-button"></i> Customer Mobile</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="customer_mobile" placeholder="MOBILE" maxlength="10" required>
                    </div>
                </div>
            </section><br>
            <section>
                <table class="table table-collapse">
                    <thead class="table-secondary">
                        <tr>
                            <th><i class="fa-brands fa-product-hunt"></i> Items</th>
                            <th><i class="fa-solid fa-circle-info"></i> Product Name</th>
                            <th><i class="fa-solid fa-tag"></i> Price</th>
                            <th><i class="fa-solid fa-barcode"></i> Product ID</th>
                            <th><i class="fa-solid fa-star"></i> Quantity</th>
                            <th><i class="fa-solid fa-chart-line"></i> Stock Status</th>
                        </tr>
                    </thead>
                    <tbody id="product_table_body">
                        <?php foreach ($products as $product) : ?>
                            <tr class="<?= $product['stock_quantity'] == 0 ? 'out-of-stock' : ''; ?>">
                                <td><img src="<?= $product['image_path']; ?>" alt="<?= $product['product_name']; ?>" class="img-fluid" style="max-width: 100px;"></td>
                                <td><?= $product['product_name']; ?></td>
                                <td><i class="fas fa-indian-rupee-sign"></i> <?= $product['price']; ?></td>
                                <td>
                                    <?php if ($product['stock_quantity'] > 0) : ?>
                                        <input type="checkbox" name="products[<?= $product['product_id']; ?>][id]" value="<?= $product['product_id']; ?>"> <?= $product['product_id']; ?>
                                    <?php else : ?>
                                        Out of Stock
                                    <?php endif; ?>
                                </td>
                                <td><input type="text" class="form-control" name="products[<?= $product['product_id']; ?>][quantity]" value="0" <?= $product['stock_quantity'] == 0 ? 'disabled' : ''; ?>></td>
                                <td><?= $product['stock_quantity'] > 0 ? '<i class="fa-solid fa-arrow-trend-up"></i> In Stock' : '<i class="fa-solid fa-arrow-trend-down"></i> Out of Stock'; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </section><br>
            <section>
                <div class="d-flex justify-content-end my-3">
                    <button type="button" class="btn btn-success me-2" onclick="computeCost();">Total Cost</button>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-indian-rupee-sign"></i></span>
                        <input type="text" class="form-control" id="cost" name="cost" readonly>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="payment_mode" class="form-label">Payment Mode <i class="fa-solid fa-money-check-dollar"></i></label>
                    <select class="form-select" id="payment_mode" name="payment_mode" required>
                        <option value="offline">Offline</option>
                        <option value="online">Online</option>
                    </select>
                </div>
                <div id="transaction_id_div" class="mb-3" style="display:none;">
                    <label for="transaction_id" class="form-label">Transaction ID</label>
                    <input type="text" class="form-control" id="transaction_id" name="transaction_id">
                    <div class="mt-3">
                        <center>
                            <h3><i class="fa-solid fa-qrcode fa-beat-fade"></i> Scan the QR code to make the payment and enter the transaction ID above. <i class="fa-solid fa-qrcode fa-beat-fade"></i></h3>
                        </center>
                        <img src="../images/qr.jpg" alt="QR Code" class="img-fluid">
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-success">Submit Order <i class="fa-solid fa-truck-arrow-right"></i></button>
                    <button type="reset" class="btn btn-danger"><i class="fa-solid fa-circle-xmark" style="color: #000000;"></i> Clear Order Form</button>
                </div>
            </section>
        </form>
    </div>
    <script>
        document.getElementById('payment_mode').addEventListener('change', function() {
            const transactionIdDiv = document.getElementById('transaction_id_div');
            if (this.value === 'online') {
                transactionIdDiv.style.display = 'block';
            } else {
                transactionIdDiv.style.display = 'none';
            }
        });

        function computeCost() {
            const rows = document.getElementById('product_table_body').getElementsByTagName('tr');
            let totalCost = 0;
            for (let row of rows) {
                const checkbox = row.querySelector('input[type="checkbox"]');
                const quantityInput = row.querySelector('input[type="text"]');
                if (checkbox && checkbox.checked) {
                    const quantity = parseInt(quantityInput.value);
                    const price = parseFloat(row.cells[2].innerText.replace('₹', '').trim());
                    totalCost += quantity * price;
                }
            }
            document.getElementById('cost').value = totalCost.toFixed(2);
        }
    </script>
    <div class="footer bg-secondary">
        <h5>&copy;2023 Dairy Serve Management System. All Rights Reserved</h5>
    </div>
    <script src="../css/bootstrap-5.3.3/bootstrap.bundle.min.js"></script>
<script src="../css/bootstrap-5.3.3/popper.min.js"></script>
<script src="../css/bootstrap-5.3.3/jquery-3.5.1.slim.min.js"></script>
<script src="../css/bootstrap-5.3.3/bootstrap.min.js"></script>
</body>

</html>