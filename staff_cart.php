<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Process order placement here
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
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <style>
        .out-of-stock {
            position: relative;
            background-color: rgba(255, 0, 0, 0.1); /* Dim background color */
        }
        .out-of-stock::after {
            content: "Shortly it will be available";
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 24px;
            font-weight: bold;
            color: rgba(255, 0, 0, 0.5); /* Dim text color */
            text-align: center;
            z-index: 1;
        }
        .out-of-stock img {
            opacity: 0.5; /* Dim image */
        }
        .out-of-stock td {
            position: relative;
        }
    </style>
</head>
<body>
    <div class="container my-4">
        <a href="startpage.php">
            <img src="../images/new.png" alt="logo" class="img-fluid" style="max-width: 100px;">
        </a>
        <br><br>
        <form action="place_order.php" method="POST">
            <h3 class="text-center text-success mb-4">Dairy Products</h3>
            <div class="mb-3 row">
                <label for="customer_name" class="col-sm-2 col-form-label">Customer Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="customer_name" placeholder="NAME" required>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="customer_mobile" class="col-sm-2 col-form-label">Customer Mobile</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="customer_mobile" placeholder="MOBILE" maxlength="10" required>
                </div>
            </div>
            <table class="table table-bordered table-success">
                <thead class="table-danger">
                    <tr>
                        <th>Items</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Product ID</th>
                        <th>Quantity</th>
                        <th>Stock Status</th>
                    </tr>
                </thead>
                <tbody id="product_table_body">
                    <?php foreach ($products as $product): ?>
                        <tr class="<?= $product['stock_quantity'] == 0 ? 'out-of-stock' : ''; ?>">
                            <td><img src="<?= $product['image_path']; ?>" alt="<?= $product['product_name']; ?>" class="img-fluid" style="max-width: 100px;"></td>
                            <td><?= $product['product_name']; ?></td>
                            <td><i class="fas fa-rupee-sign"></i> <?= $product['price']; ?></td>
                            <td>
                                <?php if ($product['stock_quantity'] > 0): ?>
                                    <input type="checkbox" name="products[<?= $product['product_id']; ?>][id]" value="<?= $product['product_id']; ?>"> <?= $product['product_id']; ?>
                                <?php else: ?>
                                    Out of Stock
                                <?php endif; ?>
                            </td>
                            <td><input type="text" class="form-control" name="products[<?= $product['product_id']; ?>][quantity]" value="0" <?= $product['stock_quantity'] == 0 ? 'disabled' : ''; ?>></td>
                            <td><?= $product['stock_quantity'] > 0 ? 'In Stock' : 'Out of Stock'; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="d-flex justify-content-end my-3">
                <button type="button" class="btn btn-success me-2" onclick="computeCost();">Total Cost</button>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-rupee-sign"></i></span>
                    <input type="text" class="form-control" id="cost" name="cost" readonly>
                </div>
            </div>
            <div class="mb-3">
                <label for="payment_mode" class="form-label">Payment Mode</label>
                <select class="form-select" id="payment_mode" name="payment_mode" required>
                    <option value="offline">Offline</option>
                    <option value="online">Online</option>
                </select>
            </div>
            <div id="transaction_id_div" class="mb-3" style="display:none;">
                <label for="transaction_id" class="form-label">Transaction ID</label>
                <input type="text" class="form-control" id="transaction_id" name="transaction_id">
                <div class="mt-3">
                    <img src="../images/qr.jpg" alt="QR Code" class="img-fluid">
                    <p>Scan the QR code to make the payment and enter the transaction ID above.</p>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-success">Submit Order</button>
                <button type="reset" class="btn btn-danger">Clear Order </button>
            </div>
        </form>
    </div>
    <script>
        document.getElementById('payment_mode').addEventListener('change', function () {
            var paymentMode = this.value;
            var transactionIdDiv = document.getElementById('transaction_id_div');
            if (paymentMode === 'online') {
                transactionIdDiv.style.display = 'block';
            } else {
                transactionIdDiv.style.display = 'none';
            }
        });

        function computeCost() {
            let totalCost = 0;
            document.querySelectorAll('input[name^="products"]').forEach(input => {
                if (input.type === 'checkbox' && input.checked) {
                    const quantityInput = document.querySelector(`input[name="products[${input.value}][quantity]"]`);
                    const price = parseFloat(input.closest('tr').querySelector('td:nth-child(3)').innerText.replace('₹ ', ''));
                    totalCost += price * parseInt(quantityInput.value);
                }
            });
            document.getElementById('cost').value = totalCost.toFixed(2);
        }
    </script>
    <script src="css/bootstrap-5.3.3/bootstrap.bundle.min.js"></script>
<script src="css/bootstrap-5.3.3/popper.min.js"></script>
<script src="css/bootstrap-5.3.3/jquery-3.5.1.slim.min.js"></script>
<script src="css/bootstrap-5.3.3/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
