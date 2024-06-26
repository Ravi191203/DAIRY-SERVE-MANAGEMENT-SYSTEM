<?php
session_start(); // Start the session to use session variables
include 'db_connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Add and View Products</title>
    <link href="../assets/fontawesome-free-6.5.2-web/css/fontawesome.css" rel="stylesheet" />
    <link href="../assets/fontawesome-free-6.5.2-web/css/brands.css" rel="stylesheet" />
    <link href="../assets/fontawesome-free-6.5.2-web/css/solid.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: lightgrey;
        }
        section {
            width: 90%;
            padding: 20px;
            margin: auto;
            background-color: #fff;
            border-radius: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .container {
            margin-top: 30px;
        }
        .form-label {
            font-weight: bold;
        }
        .table-responsive {
            margin-top: 20px;
        }
        .product-image {
            max-width: 100px;
        }
        .form-container {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 04);
        }
        td {

vertical-align: top;
padding: 20px;

}
table {
            border-collapse: collapse;
            width: 100%;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <section style="background:lightgreen";>
    <div class="container">
        <h2 class="text-center text-dark mb-4">Add New Product</h2></section><br>
        <section>
        <div class="form-container">
            <?php
            if (isset($_SESSION['success_message'])) {
                echo "<div class='alert alert-success'>{$_SESSION['success_message']}</div>";
                unset($_SESSION['success_message']); // Clear the message after displaying it
            }
            if (isset($_SESSION['error_message'])) {
                echo "<div class='alert alert-danger'>{$_SESSION['error_message']}</div>";
                unset($_SESSION['error_message']); // Clear the message after displaying it
            }
            ?>
            <form id="add_product_form" method="POST" action="add_product.php">
                <div class="mb-3">
                    <label for="new_product_name" class="form-label">Product Name</label>
                    <input type="text" class="form-control" id="new_product_name" name="product_name" placeholder="Product Name" required>
                </div>
                <div class="mb-3">
                    <label for="new_product_price" class="form-label">Price</label>
                    <input type="number" class="form-control" id="new_product_price" name="product_price" placeholder="Price" required>
                </div>
                <div class="mb-3">
                    <label for="new_product_id" class="form-label">Product ID</label>
                    <input type="text" class="form-control" id="new_product_id" name="product_id" placeholder="Product ID will Auto Increment In db..." readonly>
                </div>
                <div class="mb-3">
                    <label for="new_product_image" class="form-label">Product Image URL</label>
                    <input type="text" class="form-control" id="new_product_image" name="product_image" placeholder="Product Image URL" required>
                </div>
                <div class="mb-3">
                    <label for="new_product_stock" class="form-label">Stock Quantity</label>
                    <input type="number" class="form-control" id="new_product_stock" name="stock_quantity" placeholder="Stock Quantity" required>
                </div>
                <div class="mb-3">
                    <label for="new_stock_status" class="form-label">Stock Status</label>
                    <select class="form-control" id="new_stock_status" name="stock_status" required>
                        <option value="in_stock">In Stock</option>
                        <option value="out_of_stock">Out of Stock</option>
                    </select>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Add Product</button>
                </div>
            </form>
        </div></section><br>
        <section>
        <h2 class="text-center text-info my-4">Existing Products</h2>
        <?php
        $query = "SELECT * FROM products ORDER BY product_id ASC";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
        ?>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                        <th><i class="fa fa-hashtag"></i> Product ID</th>
                        <th><i class="fa fa-tag"></i> Product Name</th>
                        <th><i class="fa fa-dollar-sign"></i> Price</th>
                        <th><i class="fa fa-image"></i> Image</th>
                        <th><i class="fa fa-boxes"></i> Stock Quantity</th>
                        <th><i class="fa fa-clipboard-list"></i> Stock Status</th>
                        <th><i class="fa fa-cogs"></i> Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <td><?php echo $row['product_id']; ?></td>
                            <td><?php echo $row['product_name']; ?></td>
                            <td><?php echo $row['price']; ?></td>
                            <td>
                                <?php if (!empty($row['image_path'])): ?>
                                    <img src="<?php echo $row['image_path']; ?>" alt="<?php echo $row['product_name']; ?>" class="product-image img-thumbnail">
                                <?php else: ?>
                                    No Image Available
                                <?php endif; ?>
                            </td>
                            <td><?php echo $row['stock_quantity']; ?></td>
                            <td><?php echo $row['stock_status']; ?></td>
                            <td>
                                <form method="POST" action="delete_product.php" style="display:inline-block;">
                                    <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                                <form method="GET" action="edit_product.php" style="display:inline-block;">
                                    <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                                    <button type="submit" class="btn btn-warning btn-sm">Edit</button>
                                </form>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            </section>
        <?php
        } else {
            echo "<p class='text-center'>No products found.</p>";
        }
        ?>
    </div><br>
    <section class="text-center bg-primary">
        <footer class="bg-primary">
            <h3>DSMS</h3>
        </footer>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
