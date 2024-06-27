<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>History</title>
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/bootstrap-5.3.3/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style media="screen">
        h3 {
            text-align: center;
            color: green;
        }

        a {
            float: right;
            margin-right: 40px;
        }

        .C {
            position: relative;
        }

        .delete-form {
            position: fixed;
            bottom: 10px;
            right: 10px;
        }
        .input-form{
            position: fixed;
            right: 10px;

        }
        .copyright {
            left: 0;
            bottom: 0;
            text-align: center;
            margin-top: 350px;
        }
    </style>
</head>
<body>
<div class="C">
    <a href="Cart.php">
        <button type="button" class="btn btn-warning" name="button">Back To Cart</button>
    </a>
    <div class="main-content" style="margin:20px;">
        <h3>Customer Payment Details</h3>
    </div>
    
<form class="delete-form" action="" method="POST">
    <div class="input-group">
        <input type="number" class="form-control" name="invoice_id" placeholder="Enter Invoice ID To Delete" required>
        <button type="submit" class="btn btn-danger" name="delete">Delete</button>
    </div>
</form>
    <!--Fetch Details-->
    <div class="card">
        <div class="card-body">
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

            if (isset($_POST['delete'])) {
                $invoice_id = $_POST['invoice_id'];
                $delete_sql = "DELETE FROM `dairy_customers` WHERE `invoice_id` = ?";
                $stmt = $conn->prepare($delete_sql);
                $stmt->bind_param("i", $invoice_id);
                if ($stmt->execute()) {
                    echo "<p style='color: green;'>Record deleted successfully</p>";
                } else {
                    echo "<p style='color: red;'>Error deleting record: " . $conn->error . "</p>";
                }
                $stmt->close();
            }

            $sql = "SELECT * FROM `dairy_customers` ORDER BY `invoice_id` DESC";
            $query_run = mysqli_query($conn, $sql);
            ?>
            <table class="table table-bordered border-success">
                <thead>
                <tr>
                    <th scope="col"><i class="fas fa-file-invoice-dollar"></i> Invoice ID</th>
                    <th scope="col"><i class="fas fa-user-alt"></i> Name</th>
                    <th scope="col"><i class="fas fa-phone"></i> Mobile</th>
                    <th scope="col"><i class="fas fa-rupee-sign"></i> Total Cost</th>
                    <th scope="col" colspan="5"><i class="fab fa-product-hunt"></i> Products ID Purchased</th>
                </tr>
                </thead>
                <?php
                if ($query_run) {
                    foreach ($query_run as $row) {
                        ?>
                        <tbody>
                        <tr>
                            <td><?php echo $row['invoice_id']; ?></td>
                            <td><?php echo $row['customer_name']; ?></td>
                            <td><?php echo $row['customer_mobile']; ?></td>
                            <td><i class="fas fa-rupee-sign"></i> <?php echo $row['Total_cost']; ?></td>
                            <td><?php echo $row['PR1'] . '  ' . $row['PR2'] . '  ' . $row['PR3'] . '  ' . $row['PR4'] . '  ' . $row['PR5']; ?></td>
                        </tr>
                        </tbody>
                        <?php
                    }
                } else {
                    echo "No Record Found";
                }
                ?>
            </table>
        </div>
    </div>
</div>

<form class="input-form" action="generate_invoice.php" method="POST">
    <div class="input-group">
        <input type="number" class="form-control" name="invoice_id" placeholder="Enter Invoice ID" required>
        <button type="submit" class="btn btn-primary" name="generate_bill">Generate Invoice</button>
    </div>
</form>
<script src="css/bootstrap-5.3.3/bootstrap.bundle.min.js"></script>
    <script src="css/bootstrap-5.3.3/popper.min.js"></script>
    <script src="css/bootstrap-5.3.3/jquery-3.5.1.slim.min.js"></script>
    <script src="css/bootstrap-5.3.3/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<p class="copyright">&copy DAIRY.com 2021 <sub>All Rights Reserved</sub></p>
</body>
</html>
