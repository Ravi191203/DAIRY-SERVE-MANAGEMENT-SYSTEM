<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['product_id'])) {
    $product_id = mysqli_real_escape_string($conn, $_POST['product_id']);

    $query = "DELETE FROM products WHERE product_id='$product_id'";

    if (mysqli_query($conn, $query)) {
        echo "Product deleted successfully";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
    mysqli_close($conn);

    header("Location: admin_add_product.php"); // Redirect to the product management page
    exit();
}
?>
