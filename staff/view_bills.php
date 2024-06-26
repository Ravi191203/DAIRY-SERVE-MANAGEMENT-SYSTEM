<?php
include 'config.php';
session_start();

// Check if the user is logged in

$sql = "SELECT * FROM bills";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Bills</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        h2 {
            color: #343a40;
            font-weight: bold;
            margin-bottom: 30px;
            animation: fadeInDown 1s ease-out;
        }

        .card {
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
            transition: transform 0.3s, box-shadow 0.3s;
            border-radius: 10px;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }

        .card-body {
            padding: 20px;
        }

        .table thead {
            background-color: #343a40;
            color: #fff;
        }

        .table tbody tr {
            transition: background-color 0.3s, transform 0.3s;
        }

        .table tbody tr:hover {
            background-color: #f1f1f1;
            transform: scale(1.02);
        }

        .footer {
            background-color: #343a40;
            color: #fff;
            padding: 10px 0;
            position: absolute;
            bottom: 0;
            width: 100%;
            animation: fadeInUp 1s ease-out;
        }

        .footer p {
            margin: 0;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">View Bills</h2>
        <table id="billsTable" class="table table-bordered">
            <thead>
                <tr>
                    <th>Bill ID</th>
                    <th>Customer ID</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['bill_id']}</td>
                                <td>{$row['customer_id']}</td>
                                <td>{$row['amount']}</td>
                                <td>{$row['date']}</td>
                                <td>
                                    <a href='generate_invoice.php?bill_id={$row['bill_id']}' class='btn btn-primary'>Print Invoice</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No bills found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap 5 JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <!-- DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#billsTable').DataTable();
        });
    </script>
</body>
</html>
