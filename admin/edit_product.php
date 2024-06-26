<?php
session_start(); // Start the session to use session variables
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    
    $query = "SELECT * FROM products WHERE product_id = '$product_id'";
    $result = mysqli_query($conn, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);
    } else {
        echo "Product not found.";
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $stock_quantity = $_POST['stock_quantity'];
    $stock_status = $_POST['stock_status'];
    
    $query = "UPDATE products SET product_name='$product_name', price='$product_price', image_path='$product_image', stock_quantity='$stock_quantity', stock_status='$stock_status' WHERE product_id='$product_id'";
    
    if (mysqli_query($conn, $query)) {
        $_SESSION['success_message'] = "Product updated successfully.";
        header("Location: admin_add_product.php"); // Redirect to the page showing all products
        exit;
    } else {
        echo "Error updating product: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            margin-top: 30px;
        }
        .form-label {
            font-weight: bold;
        }
        .form-container {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 1);
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center text-success mb-4">Edit Product</h2>
        <div class="form-container">
            <form method="POST" action="edit_product.php">
                <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                <div class="mb-3">
                    <label for="edit_product_name" class="form-label">Product Name</label>
                    <input type="text" class="form-control" id="edit_product_name" name="product_name" value="<?php echo $product['product_name']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="edit_product_price" class="form-label">Price</label>
                    <input type="number" class="form-control" id="edit_product_price" name="product_price" value="<?php echo $product['price']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="edit_product_image" class="form-label">Product Image URL</label>
                    <input type="text" class="form-control" id="edit_product_image" name="product_image" value="<?php echo $product['image_path']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="edit_product_stock" class="form-label">Stock Quantity</label>
                    <input type="number" class="form-control" id="edit_product_stock" name="stock_quantity" value="<?php echo $product['stock_quantity']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="edit_stock_status" class="form-label">Stock Status</label>
                    <select class="form-control" id="edit_stock_status" name="stock_status" required>
                        <option value="in_stock" <?php if ($product['stock_status'] == 'in_stock') echo 'selected'; ?>>In Stock</option>
                        <option value="out_of_stock" <?php if ($product['stock_status'] == 'out_of_stock') echo 'selected'; ?>>Out of Stock</option>
                    </select>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Update Product</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
