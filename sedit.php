<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Update Staff</title>
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/farmer.css">
    <style media="screen">
        .delete-icon {
            position: absolute;
            padding: 4px 5px;
            border-radius: 5px;
            text-decoration: none;
            margin-left: 50px;
        }

        .delete-icon:hover {
            transform: scale(1.2);
            opacity: 0.8;
        }

        u {
            text-decoration: none;
        }
    </style>
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
<form class="modal-content animate" action="" method="POST">
    <h3><b><u>Update Staff details</u></b><a class="delete-icon" href="staff.php"><i class="fas fa-arrow-circle-left"></i></a></h3>
    <div class="container">
        <label for="fname">First Name <sup>*</sup> </label>
        <input type="text" name="fname" value="<?php echo htmlspecialchars($arrdata['ename']); ?>" placeholder="first name" required/>
        <br>
        <label for="phonenumber">Phone number<sup>*</sup> </label>
        <input type="text" name="phonenumber" value="<?php echo htmlspecialchars($arrdata['phno']); ?>" placeholder="Phone Number" required/>
        <br>
        <label for="staffaddress">Address<sup>*</sup> </label>
        <input type="text" name="staffaddress" value="<?php echo htmlspecialchars($arrdata['address']); ?>" placeholder="address" required/>
        <br>
        <label for="salary">Salary<sup>*</sup> </label>
        <input type="text" name="salary" value="<?php echo htmlspecialchars($arrdata['salary']); ?>" placeholder="salary" required/>
        <br>
        <label for="Designation">Designation<sup>*</sup> </label>
        <input type="text" name="Designation" value="<?php echo htmlspecialchars($arrdata['designation']); ?>" placeholder="Designation" required/>
        <br>
        <input type="submit" name="updatestaffdata" class="submit-btn-add" value="Update">
    </div>
</form>
</body>
</html>
