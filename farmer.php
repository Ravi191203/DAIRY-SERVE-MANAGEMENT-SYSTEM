<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Farmer Details</title>
    <link rel="stylesheet" href="css/bootstrap-5.3.3/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="css/bootstrap-5.3.3/bootstrap.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
    <h2 class="text-center mb-4">Farmer Details</h2>
    <!-- Fetch Details & display -->
    <div class="card">
        <div class="card-body">
            <?php
            $conn = new mysqli("localhost", "root", "", "dry");
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $sql = "SELECT * FROM farmer";
            $query_run = mysqli_query($conn, $sql);
            ?>

            <table id="farmerTable" class="table table-striped table-hover">
                <thead class="table-dark">
                <tr>
                    <th scope="col"><i class="fas fa-id-badge"></i> ID</th>
                    <th scope="col"><i class="fas fa-user-alt"></i> Firstname</th>
                    <th scope="col"><i class="fas fa-phone"></i> Phone</th>
                    <th scope="col"><i class="fas fa-address-book"></i> Village ID</th>
                    <th scope="col"><i class="fas fa-caret-square-down"></i> Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if ($query_run) {
                    while ($row = $query_run->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['fname']; ?></td>
                            <td><?php echo $row['ph']; ?></td>
                            <td><?php echo $row['f_vid']; ?></td>
                            <td>
                                <div class="btn-group">
                                    <a class="btn btn-secondary" href="edit.php?id=<?php echo $row['id']; ?>"><i class="fas fa-edit"></i> Edit</a>
                                    <a class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this farmer?');" href="delete.php?id=<?php echo $row['id']; ?>"><i class="fas fa-trash-alt"></i> Delete</a>
                                </div>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center'>No Record Found</td></tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="footer mt-5 text-center">
    <p>&copy; 2023 Dairy Serve Management System. All Rights Reserved</p>
</div>
<script src="css/bootstrap-5.3.3/bootstrap.bundle.min.js"></script>
<script src="css/bootstrap-5.3.3/popper.min.js"></script>
<script src="css/bootstrap-5.3.3/jquery-3.5.1.slim.min.js"></script>
<script src="css/bootstrap-5.3.3/bootstrap.min.js"></script>
<script src="css/bootstrap-5.3.3/dataTables.bootstrap5.min.js"></script>
<script src="css/bootstrap-5.3.3/jquery.dataTables.min.js"></script>
<!-- Bootstrap 5 JS and Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<!-- DataTables JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#farmerTable').DataTable();
    });
</script>
</body>
</html>
