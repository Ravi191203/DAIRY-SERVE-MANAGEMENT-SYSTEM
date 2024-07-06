<?php
include 'config.php';
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $farmer_id = $_POST['farmer_id'];
    $date = $_POST['date'];
    $milk_qty = $_POST['milk_qty'];
    $fat = $_POST['fat'];
    $snf = $_POST['snf'];
    $rate = $_POST['rate'];

    $sql = "INSERT INTO daily_data (farmer_id, date, milk_qty, fat, snf, rate) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("isdddd", $farmer_id, $date, $milk_qty, $fat, $snf, $rate);
        if ($stmt->execute()) {
            $message = "New data entry added successfully";
        } else {
            $message = "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $message = "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Daily Data Entry</title>
    <link rel="stylesheet" href="../css/bootstrap-5.3.3/b4.5.2.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Add Daily Data Entry</h2>
        <?php if (isset($message)): ?>
            <div class="alert alert-info"><?= $message ?></div>
        <?php endif; ?>
        <form action="" method="post">
            <div class="form-group">
                <label for="farmer_id">Farmer ID</label>
                <input type="number" class="form-control" id="farmer_id" name="farmer_id" required>
            </div>
            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" class="form-control" id="date" name="date" required>
            </div>
            <div class="form-group">
                <label for="milk_qty">Milk Quantity</label>
                <input type="number" step="0.01" class="form-control" id="milk_qty" name="milk_qty" required>
            </div>
            <div class="form-group">
                <label for="fat">Fat</label>
                <input type="number" step="0.01" class="form-control" id="fat" name="fat" required>
            </div>
            <div class="form-group">
                <label for="snf">SNF</label>
                <input type="number" step="0.01" class="form-control" id="snf" name="snf" required>
            </div>
            <div class="form-group">
                <label for="rate">Rate</label>
                <input type="number" step="0.01" class="form-control" id="rate" name="rate" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Entry</button>
        </form>
    </div>
    <script src="../css/bootstrap-5.3.3/bootstrap.bundle.min.js"></script>
<script src="../css/bootstrap-5.3.3/popper.min.js"></script>
<script src="../css/bootstrap-5.3.3/jquery-3.5.1.slim.min.js"></script>
<script src="../css/bootstrap-5.3.3/bootstrap.min.js"></script>
</body>
</html>
