<!-- add_customer_process.php -->

<?php
include 'db_connect.php'; // Make sure to include your database connection file

// Create customers table if it doesn't exist
$sql_create_table = "CREATE TABLE IF NOT EXISTS sscustomers (
    customer_id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    address TEXT
)";

if ($con->query($sql_create_table) === TRUE) {
    // Table created successfully or already exists
} else {
    echo "Error creating table: " . $con->error;
    exit;
}

// Process form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Add Customer
    if (isset($_POST['add_customer'])) {
        $customer_name = $_POST['customer_name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];

        $sql_insert_customer = "INSERT INTO sscustomers (customer_name, email, phone, address) 
                                VALUES ('$customer_name', '$email', '$phone', '$address')";

        if ($con->query($sql_insert_customer) === TRUE) {
            $message = "Customer added successfully";
        } else {
            $message = "Error: " . $con->error;
        }
    }

    // Delete Customer
    if (isset($_POST['delete_customer'])) {
        $customer_id = $_POST['customer_id'];

        $sql_delete_customer = "DELETE FROM sscustomers WHERE customer_id = $customer_id";

        if ($con->query($sql_delete_customer) === TRUE) {
            $delete_message = "Customer deleted successfully";
        } else {
            $delete_message = "Error: " . $con->error;
        }
    }
}

// Retrieve recently added customers
$sql_recent_customers = "SELECT * FROM sscustomers ORDER BY customer_id DESC LIMIT 5";
$result = $con->query($sql_recent_customers);

$recent_customers = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $recent_customers[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Customer</title>
    <link rel="stylesheet" href="css/bootstrap-5.3.3/bootstrap.min.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/fontawesome-free-6.5.2-web/css/fontawesome.css" rel="stylesheet" />
  <link href="assets/fontawesome-free-6.5.2-web/css/brands.css" rel="stylesheet" />
  <link href="assets/fontawesome-free-6.5.2-web/css/solid.css" rel="stylesheet" />
    <style>
        body{
            background-color: lightgrey;
        }
         section {
            width: 700px;
            padding: 20px;
            margin: auto;
            background-color: #fff;
            border-radius: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <section>
    <div class="container mt-5">
        <h2 class="mb-4">Add Customer</h2>
        <?php if (isset($message)): ?>
            <div class="alert alert-info"><?= $message ?></div>
        <?php endif; ?>
        <form action="add_customer_process.php" method="post">
            <div class="form-group">
                <label for="customer_name">
                    <i class="fas fa-user"></i> Customer Name
                </label>
                <input type="text" class="form-control" id="customer_name" name="customer_name" required>
            </div>
            <div class="form-group">
                <label for="email">
                    <i class="fas fa-envelope"></i> Email
                </label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="phone">
                    <i class="fas fa-phone"></i> Phone Number
                </label>
                <input type="text" class="form-control" id="phone" name="phone" required>
            </div>
            <div class="form-group">
                <label for="address">
                    <i class="fas fa-map-marker-alt"></i> Address
                </label>
                <textarea class="form-control" id="address" name="address" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary" name="add_customer">
                <i class="fas fa-user-plus"></i> Add Customer
            </button>
        </form>
        </section>
        <hr>
<section>
        <h2 class="mt-5 mb-4">Recently Added Customers</h2>
        <?php if (!empty($recent_customers)): ?>
            <ul class="list-group">
                <?php foreach ($recent_customers as $customer): ?>
                    <li class="list-group-item">
                        <strong><?= $customer['customer_id'] ?></strong><br>
                        <strong><?= $customer['customer_name'] ?></strong><br>
                        <small>Email: <?= $customer['email'] ?> | Phone: <?= $customer['phone'] ?></small><br>
                        <small>Address: <?= $customer['address'] ?></small><br>
                        <form action="add_customer_process.php" method="post" class="mt-2">
                            <input type="hidden" name="customer_id" value="<?= $customer['customer_id'] ?>">
                            <button type="submit" class="btn btn-danger" name="delete_customer">
                            <i class="fas fa-trash-alt"></i> Delete
                        </button>
                        </form>
                    </li>
                <?php endforeach; ?>
            </ul>
            </section>
        <?php else: ?>
            <div class="alert alert-info">No customers added yet.</div>
        <?php endif; ?>
        
        <?php if (isset($delete_message)): ?>
            <div class="alert alert-info mt-4"><?= $delete_message ?></div>
        <?php endif; ?>
    </div>
    <script src="css/bootstrap-5.3.3/bootstrap.bundle.min.js"></script>
    <script src="css/bootstrap-5.3.3/popper.min.js"></script>
    <script src="css/bootstrap-5.3.3/jquery-3.5.1.slim.min.js"></script>
    <script src="css/bootstrap-5.3.3/bootstrap.min.js"></script>
</body>
</html>
