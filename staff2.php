<?php
session_start();


$employee_id = $_SESSION['eid'];

// Database connection
$conn = new mysqli("localhost", "root", "", "dry");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch staff details
$sql = "SELECT * FROM employee WHERE eid = '$eid'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $staff = $result->fetch_assoc();
} else {
    echo "No staff found";
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $salary = $_POST['salary'];
    $designation = $_POST['designation'];
    $address = $_POST['address'];

    $update_sql = "UPDATE employee SET ename = '$name', phno = '$phone', salary = '$salary', designation = '$designation', address = '$address' WHERE eid = '$employee_id'";

    if ($conn->query($update_sql) === TRUE) {
        echo '<p class="message">Details updated successfully!</p>';
        // Refresh staff details after update
        $staff['ename'] = $name;
        $staff['phno'] = $phone;
        $staff['salary'] = $salary;
        $staff['designation'] = $designation;
        $staff['address'] = $address;
    } else {
        echo '<p class="message">Error: ' . $update_sql . '<br>' . $conn->error . '</p>';
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Staff Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.css">
    <style>
        .card {
            border-radius: 20px;
            color: gray;
            background-color: lightblue;
            padding: 20px;
            margin-bottom: 20px;
        }
        .login {
            float: right;
            margin: 20px;
            font-size: 18px;
        }
        .title {
            text-align: center;
            color: blue;
            font-size: 24px;
            margin-bottom: 20px;
        }
        h4{
            float:right;
            margin-left: -200px;
        }
    </style>
   
</head>
<body>
   
    <center><h2> EDIT STAFF DETAILS</h2></center>
    <h4><a href="/PROJECT-K/staff_dashboard.php">BACK</a></h4><br>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <form method="post">
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?php echo $staff['ename']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone:</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $staff['phno']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="salary">Salary:</label>
                            <input type="text" class="form-control" id="salary" name="salary" value="<?php echo $staff['salary']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="designation">Designation:</label>
                            <input type="text" class="form-control" id="designation" name="designation" value="<?php echo $staff['designation']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Address:</label>
                            <textarea class="form-control" id="address" name="address" rows="3" required><?php echo $staff['address']; ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Details</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="footer">
        <center><p>&copy; 2023 DIARY. All Rights Reserved</p></center>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
