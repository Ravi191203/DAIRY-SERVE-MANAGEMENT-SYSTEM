<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Animal Info</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
    <div class="row">
        <div class="col-12 text-center">
            <h2 class="mb-4"><img src="../images/cow-silhouette.png" alt="cow" style="height:50px; width:auto;"> Dairy Animal Details</h2>
        </div>
    </div>
    <!-- Fetch Details -->
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
            $sql = "SELECT * FROM farmer";
            $query_run = mysqli_query($conn, $sql);
            ?>
            <table id="example1" class="table table-striped table-hover">
                <thead class="table-dark">
                <tr>
                    <th scope="col"><img src="images/dorsal.png" alt="" style="height:25px; width:auto;"> Animal Health ID</th>
                    <th scope="col"><i class="fas fa-user-alt"></i> Owner</th>
                    <th scope="col"><i class="fas fa-phone"></i> Phone</th>
                    <th scope="col"><img src="images/cow-silhouette.png" alt="" style="height:25px; width:auto;"> Animal Type</th>
                    <th scope="col"><img src="images/milk.png" alt="" style="height:25px; width:auto;"> Minimum Litre/day</th>
                    <th scope="col"><i class="fas fa-calendar-alt"></i> Registered Date</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if ($query_run) {
                    foreach ($query_run as $row) {
                        ?>
                        <tr>
                            <td><?php echo $row['animalID']; ?></td>
                            <td><?php echo $row['fname']; ?></td>
                            <td><?php echo $row['ph']; ?></td>
                            <td><?php echo $row['milk_type']; ?></td>
                            <td><?php echo $row['min_litre']; ?> L</td>
                            <td><?php echo $row['reg_date']; ?></td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<tr><td colspan='6' class='text-center'>No Record Found</td></tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example1').DataTable();
    });
</script>
</body>
</html>
