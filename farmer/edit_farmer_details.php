<?php
session_start();
require_once '../db_connect.php';

if (!isset($_SESSION["username"]) || $_SESSION["role"] != "farmer") {
    header("Location: index.php");
    exit();
}
echo "<center><b>Welcome, " . $_SESSION["username"] . "! You are logged in as Farmer.</b></center>";

// Check if the user is logged in and is a farmer
if (!isset($_SESSION['farmer_id'])) {
    die('Farmer not logged in');
}

$farmer_id = $_SESSION['farmer_id'];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fname = mysqli_real_escape_string($con, $_POST['fname']);
    $ph = mysqli_real_escape_string($con, $_POST['ph']);
    $f_vid = mysqli_real_escape_string($con, $_POST['f_vid']);
    $milk_type = mysqli_real_escape_string($con, $_POST['milk_type']);
    $min_litre = mysqli_real_escape_string($con, $_POST['min_litre']);

    // Validate inputs
    $errors = [];
    if (empty($fname)) {
        $errors[] = "Name is required";
    }
    if (empty($ph)) {
        $errors[] = "Phone number is required";
    }
    if (empty($f_vid)) {
        $errors[] = "Farm VID is required";
    }
    if (empty($milk_type)) {
        $errors[] = "Milk type is required";
    }
    if (empty($min_litre) || !is_numeric($min_litre)) {
        $errors[] = "Minimum litre must be a number";
    }

    // If no errors, update the farmer details
    if (empty($errors)) {
        $query = "UPDATE farmer SET fname='$fname', ph='$ph', f_vid='$f_vid', milk_type='$milk_type', min_litre='$min_litre' WHERE id='$farmer_id'";
        $result = mysqli_query($con, $query);

        if ($result) {
            $success = "Details updated successfully";
            // Redirect to farmer_details.php after successful update
            header("Location: farmer_details.php");
            exit;
        } else {
            $error = "Failed to update details: " . mysqli_error($con);
        }
    } else {
        $error = implode('<br>', $errors);
    }
}

// Fetch current farmer details for display
$query = "SELECT * FROM farmer WHERE id='$farmer_id'";
$result = mysqli_query($con, $query);
if ($result && mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);
} else {
    $error = "Failed to fetch farmer details";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Farmer Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="../assets/fontawesome-free-6.5.2-web/css/fontawesome.css" rel="stylesheet" />
  <link href="../assets/fontawesome-free-6.5.2-web/css/brands.css" rel="stylesheet" />
  <link href="../assets/fontawesome-free-6.5.2-web/css/solid.css" rel="stylesheet" />
  <link rel="stylesheet" href="../css/bootstrap-5.3.3/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(45deg, pink 0%, lightblue 100%);
            color: black;
            
            font-weight:bold;
            background-size: 200% 200%;
            animation: gradientBackground 10s ease-in-out infinite;
        }
        @keyframes gradientBackground {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .container {
            margin-top: 50px;
            animation: fadeIn 1s ease-in-out;
            background-color: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 10px;
            width: 40%;
        }

        .form-control {
            transition: all 0.3s ease;
        }

        .form-control:focus {
            background-color: rgba(255, 255, 255, 0.2);
            color: #fff;
        }

        .btn {
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn:hover {
            background-color: #fff;
            color: #2575fc;
            transform: scale(1.05);
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    </style>
</head>
<body>
<div class="container">
    <h2 class="text-center">Edit Farmer Details</h2>
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    <?php if (isset($success)): ?>
        <div class="alert alert-success"><?php echo $success; ?></div>
    <?php endif; ?>
    <?php if (isset($row)): ?>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="fname"><i class="fas fa-user"></i> Name</label>
                <input type="text" class="form-control" id="fname" name="fname" value="<?php echo htmlspecialchars($row['fname']); ?>" required>
            </div>
            <div class="form-group">
                <label for="ph"><i class="fas fa-phone"></i> Phone Number</label>
                <input type="text" class="form-control" id="ph" name="ph" value="<?php echo htmlspecialchars($row['ph']); ?>" required>
            </div>
            <div class="form-group">
                <label for="f_vid"><i class="fas fa-id-card"></i>  Farm VID</label>
                <input type="text" class="form-control" id="f_vid" name="f_vid" value="<?php echo htmlspecialchars($row['f_vid']); ?>" required>
            </div>
            <div class="form-group">
                <label for="milk_type"><i class="fas fa-tint"></i> Milk Type</label>
                <input type="text" class="form-control" id="milk_type" name="milk_type" value="<?php echo htmlspecialchars($row['milk_type']); ?>" required>
            </div>
            <div class="form-group">
                <label for="min_litre"><i class="fas fa-balance-scale"></i> Minimum Litre</label>
                <input type="text" class="form-control" id="min_litre" name="min_litre" value="<?php echo htmlspecialchars($row['min_litre']); ?>" required>
            </div>
            <center><button type="submit" class="btn btn-success">Update</button></center>
        </form>
    <?php endif; ?>
</div>
<script src="../css/bootstrap-5.3.3/bootstrap.bundle.min.js"></script>
<script src="../css/bootstrap-5.3.3/popper.min.js"></script>
<script src="../css/bootstrap-5.3.3/jquery-3.5.1.slim.min.js"></script>
<script src="../css/bootstrap-5.3.3/bootstrap.min.js"></script>
</body>
</html>
