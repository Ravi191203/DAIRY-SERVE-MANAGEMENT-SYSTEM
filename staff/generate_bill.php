<?php
include 'config.php';
session_start();



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customer_id = $_POST['customer_id'];
    $amount = $_POST['amount'];
    $date = date('Y-m-d');

    $sql = "INSERT INTO bills (customer_id, amount, date) VALUES ('$customer_id', '$amount', '$date')";
    if ($conn->query($sql) === TRUE) {
        $message = "Bill generated successfully";
    } else {
        $message = "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Generate Bill</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Generate Bill</h2>
        <?php if (isset($message)): ?>
            <div class="alert alert-info"><?= $message ?></div>
        <?php endif; ?>
        <form action="" method="post">
            <div class="form-group">
                <label for="customer_id">Customer ID</label>
                <input type="number" class="form-control" id="customer_id" name="customer_id" required>
            </div>
            <div class="form-group">
                <label for="amount">Amount</label>
                <input type="number" class="form-control" id="amount" name="amount" required>
            </div>
            <button type="submit" class="btn btn-primary">Generate Bill</button>
        </form>
    </div>
</body>
</html>
