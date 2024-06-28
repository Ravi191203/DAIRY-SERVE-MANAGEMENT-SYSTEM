<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Staff</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dry";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['eid'];

$showquery = "SELECT * FROM employee WHERE eid=?";
$stmt = $conn->prepare($showquery);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$arrdata = $result->fetch_assoc();

if (isset($_POST['updatestaffdata'])) {
    $ename = $_POST['fname'];
    $phno = $_POST['phonenumber'];
    $salary = $_POST['salary'];
    $designation = $_POST['Designation'];
    $address = $_POST['staffaddress'];

    $sql = "UPDATE employee SET ename=?, phno=?, address=?, salary=?, designation=? WHERE eid=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssisi", $ename, $phno, $address, $salary, $designation, $id);
    $res = $stmt->execute();

    if ($res) {
        header('Location: staff.php');
    } else {
        echo "Error updating record: " . $conn->error;
    }
    $stmt->close();
}

$conn->close();
?>
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h3><b>Update Staff Details</b> <a class="btn btn-outline-secondary float-right" href="staff.php"><i class="fas fa-arrow-circle-left"></i> Back</a></h3>
        </div>
        <div class="card-body">
            <form action="" method="POST">
                <div class="form-group">
                    <label for="fname"><i class="fas fa-user"></i> First Name <sup>*</sup></label>
                    <input type="text" class="form-control" name="fname" value="<?php echo htmlspecialchars($arrdata['ename']); ?>" placeholder="First Name" required>
                </div>
                <div class="form-group">
                    <label for="phonenumber"><i class="fas fa-phone"></i> Phone Number <sup>*</sup></label>
                    <input type="text" class="form-control" name="phonenumber" value="<?php echo htmlspecialchars($arrdata['phno']); ?>" placeholder="Phone Number" required>
                </div>
                <div class="form-group">
                    <label for="staffaddress"><i class="fas fa-map-marker-alt"></i> Address <sup>*</sup></label>
                    <input type="text" class="form-control" name="staffaddress" value="<?php echo htmlspecialchars($arrdata['address']); ?>" placeholder="Address" required>
                </div>
                <div class="form-group">
                    <label for="salary"><i class="fas fa-money-bill"></i> Salary <sup>*</sup></label>
                    <input type="text" class="form-control" name="salary" value="<?php echo htmlspecialchars($arrdata['salary']); ?>" placeholder="Salary" required>
                </div>
                <div class="form-group">
                    <label for="Designation"><i class="fas fa-briefcase"></i> Designation <sup>*</sup></label>
                    <input type="text" class="form-control" name="Designation" value="<?php echo htmlspecialchars($arrdata['designation']); ?>" placeholder="Designation" required>
                </div>
                <button type="submit" name="updatestaffdata" class="btn btn-primary"><i class="fas fa-save"></i> Update</button>
            </form>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
