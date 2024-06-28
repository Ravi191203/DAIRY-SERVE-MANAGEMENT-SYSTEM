<?php
session_start();
require_once '../db_connect.php';

$farmer_id = $_SESSION['farmer_id'];

// Fetch daily data entries for the logged-in farmer
$sql = "SELECT * FROM daily_data WHERE farmer_id = ?";
$stmt = mysqli_stmt_init($con);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    // Handle SQL error
    echo "SQL Error";
    exit();
} else {
    mysqli_stmt_bind_param($stmt, "i", $farmer_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
}

// Initialize total cost
$total_cost = 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Daily Data</title>
    <link href="../assets/fontawesome-free-6.5.2-web/css/fontawesome.css" rel="stylesheet" />
    <link href="../assets/fontawesome-free-6.5.2-web/css/brands.css" rel="stylesheet" />
    <link href="../assets/fontawesome-free-6.5.2-web/css/solid.css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/bootstrap-5.3.3/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #f3f4f6, #e1e6ec);
            color: #333;
        }

        .container {
            margin-top: 50px;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            animation: fadeIn 1s ease-in-out;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }

        .table {
            background-color: #fafafa;
            transition: all 0.3s ease;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .table th,
        .table td {
            text-align: center;
            vertical-align: middle;
            padding: 15px;
            transition: all 0.3s ease;
        }

        .table tbody tr {
            transition: background-color 0.3s ease;
        }

        .table tbody tr:hover {
            background-color: #f1f1f1;
        }

        .thead-light th {
            background-color: #e2e8f0;
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
        <h2>View Daily Data</h2>
        <table class="table table-hover table-bordered">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Date</th>
                    <th scope="col">Milk Quantity (liters)</th>
                    <th scope="col">Fat (%)</th>
                    <th scope="col">SNF (%)</th>
                    <th scope="col">Rate (per liter)</th>
                    <th scope="col">Cost</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $count = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    $cost = $row['milk_qty'] * $row['rate'];
                    $total_cost += $cost;
                    echo "<tr>";
                    echo "<th scope='row'>" . $count . "</th>";
                    echo "<td>" . $row['date'] . "</td>";
                    echo "<td>" . $row['milk_qty'] . "</td>";
                    echo "<td>" . $row['fat'] . "</td>";
                    echo "<td>" . $row['snf'] . "</td>";
                    echo "<td>" . $row['rate'] . "</td>";
                    echo "<td>" . number_format($cost, 2) . "</td>";
                    echo "</tr>";
                    $count++;
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="6">Total Cost(milk_qty * rate)</th>
                    <th><?php echo number_format($total_cost, 2); ?></th>
                </tr>
            </tfoot>
        </table>
        <button class="btn btn-primary"><a href="farmedatabill.php" style="color: white; text-decoration: none;">SUBMIT</a></button>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
</body>

</html>
