<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Database connection
    $conn = new mysqli("localhost", "root", "", "dry");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $salary = $_POST['salary'];
    $designation = $_POST['designation'];
    $address = $_POST['address'];

    // Insert into employee table
    $sql = "INSERT INTO employee (ename, phno, salary, designation, address) VALUES ('$name', '$phone', '$salary', '$designation', '$address')";

    if ($conn->query($sql) === TRUE) {
        // Get the last inserted ID
        $employee_id = $conn->insert_id;
        echo "Registration successful. Your employee ID is: " . $employee_id;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Staff Registration</title>
    <link rel="stylesheet" href="../css/bootstrap-5.3.3/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Staff Registration</h2>
    <form method="post" action="">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="text" class="form-control" id="phone" name="phone" required>
        </div>
        <div class="form-group">
            <label for="salary">Salary:</label>
            <input type="text" class="form-control" id="salary" name="salary" placeholder="admin will update" readonly>
        </div>
        <div class="form-group">
            <label for="designation">Designation:</label>
            <input type="text" class="form-control" id="designation" name="designation" required>
        </div>
        <div class="form-group">
            <label for="address">Address:</label>
            <input type="text" class="form-control" id="address" name="address" required>
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
        <a href="../staff/verify_staff.php" class="btn btn-secondary ml-2">Go to Staff Login</a>
    </form>
</div>
<script src="../css/bootstrap-5.3.3/bootstrap.bundle.min.js"></script>
<script src="../css/bootstrap-5.3.3/popper.min.js"></script>
<script src="../css/bootstrap-5.3.3/jquery-3.5.1.slim.min.js"></script>
<script src="../css/bootstrap-5.3.3/bootstrap.min.js"></script>
</body>
</html>
