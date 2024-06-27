<?php
session_start();
require_once '../db_connect.php';

$farmer_id = $_SESSION['farmer_id'];

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $date = $_POST['date'];
    $milk_qty = $_POST['milk_qty'];
    $fat = $_POST['fat'];
    $snf = $_POST['snf'];
    $rate = $_POST['rate'];
    
    // Validate inputs
    if (empty($date) || empty($milk_qty) || empty($fat) || empty($snf) || empty($rate)) {
        $errors[] = "All fields are required";
    } else {
        // SQL query to insert daily data into the database
        $sql = "INSERT INTO daily_data (farmer_id, date, milk_qty, fat, snf, rate) 
                VALUES (?, ?, ?, ?, ?, ?)";
        
        $stmt = mysqli_stmt_init($con);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            // Handle SQL error
            $errors[] = "SQL error: " . mysqli_error($conn);
        } else {
            // Bind parameters and execute the statement
            mysqli_stmt_bind_param($stmt, "isdddi", $farmer_id, $date, $milk_qty, $fat, $snf, $rate);
            if (mysqli_stmt_execute($stmt)) {
                // Redirect back to view daily data page after 4 seconds
                header('Refresh: 4; URL=view_daily_data.php?adddata=success');
                echo '<div class="container mt-5">
                        <div class="alert alert-success" role="alert">
                            Data added successfully. Redirecting to view daily data page...
                        </div>
                      </div>';
                exit();
            } else {
                // Handle execution error
                $errors[] = "Execution error: " . mysqli_stmt_error($stmt);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Daily Data</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="../css/bootstrap-5.3.3/bootstrap.min.css">
    <link href="../assets/fontawesome-free-6.5.2-web/css/fontawesome.css" rel="stylesheet" />
  <link href="../assets/fontawesome-free-6.5.2-web/css/brands.css" rel="stylesheet" />
  <link href="../assets/fontawesome-free-6.5.2-web/css/solid.css" rel="stylesheet" />
    <style>
        body {
            background: linear-gradient(to right, #f3f4f6, black);
            color: #333;
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
            background-color: #ffffff;
            padding: 20px;
            width:500px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            animation: fadeIn 1s ease-in-out;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }

        .form-group label {
            font-weight: bold;
        }

        .form-control {
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .form-control:focus {
            box-shadow: 0 0 10px rgba(0, 123, 255, 0.25);
            border-color: #80bdff;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }

        .alert {
            margin-top: 20px;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="mb-4"><i class="fas fa-plus-circle"></i> Add Daily Data</h2>
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="form-group">
                <label for="date"><i class="fas fa-calendar-alt"></i> Date</label>
                <input type="date" class="form-control" id="date" name="date" required>
            </div>
            <div class="form-group">
                <label for="milk_qty"><i class="fas fa-tint"></i> Milk Quantity (liters)</label>
                <input type="number" step="0.01" class="form-control" id="milk_qty" name="milk_qty" required>
            </div>
            <div class="form-group">
                <label for="fat"><i class="fas fa-percentage"></i> Fat (%)</label>
                <input type="number" step="0.01" class="form-control" id="fat" name="fat" required>
            </div>
            <div class="form-group">
                <label for="snf"><i class="fas fa-percentage"></i> SNF (%)</label>
                <input type="number" step="0.01" class="form-control" id="snf" name="snf" required>
            </div>
            <div class="form-group">
                <label for="rate"><i class="fas fa-rupee-sign"></i> Rate (per liter)</label>
                <input type="number" step="0.01" class="form-control" id="rate" name="rate" required>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Submit</button>
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
    <script src="../css/bootstrap-5.3.3/bootstrap.bundle.min.js"></script>
<script src="../css/bootstrap-5.3.3/popper.min.js"></script>
<script src="../css/bootstrap-5.3.3/jquery-3.5.1.slim.min.js"></script>
<script src="../css/bootstrap-5.3.3/bootstrap.min.js"></script>
</body>

</html>
