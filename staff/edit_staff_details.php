<?php
session_start();
require_once '../db_connect.php'; // Ensure this file connects to your database

// Enable error reporting for debugging purposes
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the user is logged in and the eid is set
if (!isset($_SESSION['eid'])) {
    header('Location: verify_staff.php');
    exit;
}

$eid = $_SESSION['eid'];

// Check if the database connection is successful
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch staff details
$query = $con->prepare("SELECT * FROM employee WHERE eid = ?");
if (!$query) {
    die("Prepare failed: " . $con->error);
}
$query->bind_param("i", $eid);
$query->execute();
$result = $query->get_result();
$staff = $result->fetch_assoc();

$query->close();

// Update staff details if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['ename'];
    $phno = $_POST['phno'];
    $designation = $_POST['designation'];
    $address = $_POST['address'];
    
    // Add more fields as necessary

    $stmt = $con->prepare("UPDATE employee SET ename = ?, phno = ?, designation = ?, address = ? WHERE eid = ?");
    if (!$stmt) {
        die("Prepare failed: " . $con->error);
    }
    $stmt->bind_param("ssssi", $name, $phno, $designation, $address, $eid);
    // Bind more parameters as necessary

    if ($stmt->execute()) {
        $success = "Details updated successfully.";
        $stmt->close();
        // Refresh the page to reflect updated details
        header("Refresh:0");
    } else {
        $error = "Error updating details: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Staff Details</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-primary text-white text-center">
            <h2>Edit Staff Details</h2>
        </div>
        <div class="card-body">
            <?php if (isset($success)): ?>
                <div class="alert alert-success"><?php echo $success; ?></div>
            <?php elseif (isset($error)): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            <form method="POST" action="edit_staff_details.php">
                <div class="mb-3">
                    <label for="ename" class="form-label">Name</label>
                    <input type="text" class="form-control" id="ename" name="ename" value="<?php echo htmlspecialchars($staff['ename']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="phno" class="form-label">Phone Number</label>
                    <input type="text" class="form-control" id="phno" name="phno" value="<?php echo htmlspecialchars($staff['phno']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="designation" class="form-label">Designation</label>
                    <input type="text" class="form-control" id="designation" name="designation" value="<?php echo htmlspecialchars($staff['designation']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="address" name="address" value="<?php echo htmlspecialchars($staff['address']); ?>" required>
                </div>
                <!-- Add more fields as necessary -->
                <div class="mb-3">
                    <label for="salary" class="form-label">Salary</label>
                    <input type="number" class="form-control" id="salary" name="salary" value="<?php echo htmlspecialchars($staff['salary']); ?>" readonly>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
        <div class="card-footer text-center">
            <a href="staff_option.php" class="btn btn-secondary">Back</a>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>
