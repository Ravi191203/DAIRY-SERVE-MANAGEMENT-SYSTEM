<?php include 'snippets/head_footer.php'; ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>STAFF</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .modal-content {
            margin: auto;
        }

        .card {
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
            transition: transform 0.3s, box-shadow 0.3s;
            border-radius: 10px;
            margin-top: 20px;
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
<div class="container main-content">
    <h2 class="text-center mb-4">STAFF Management</h2>

    <button onclick="document.getElementById('id03').style.display='block'" class="btn btn-primary mb-3">
        <i class="fas fa-user-plus"></i> Add STAFF
    </button>

    <!-- Add staff modal -->
    <div id="id03" class="modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Add STAFF</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="modal-body" action="sadd.php" method="POST">
                    <div class="mb-3">
                        <label for="fname" class="form-label">First Name <sup>*</sup></label>
                        <input type="text" class="form-control" id="fname" name="fname" placeholder="First name" required>
                    </div>
                    <div class="mb-3">
                        <label for="phonenumber" class="form-label">Phone Number <sup>*</sup></label>
                        <input type="text" class="form-control" id="phonenumber" name="phonenumber" placeholder="Phone number" maxlength="10" required>
                    </div>
                    <div class="mb-3">
                        <label for="staffaddress" class="form-label">Address <sup>*</sup></label>
                        <input type="text" class="form-control" id="staffaddress" name="staffaddress" placeholder="Address" required>
                    </div>
                    <div class="mb-3">
                        <label for="salary" class="form-label">Salary <sup>*</sup></label>
                        <input type="text" class="form-control" id="salary" name="salary" placeholder="Salary" required>
                    </div>
                    <div class="mb-3">
                        <label for="designation" class="form-label">Designation <sup>*</sup></label>
                        <input type="text" class="form-control" id="designation" name="Designation" placeholder="Designation" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="savestaffdata" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
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
            $sql = "SELECT * FROM employee";
            $query_run = mysqli_query($conn, $sql);
            ?>
            <table id="staffTable" class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th scope="col"><i class="fas fa-id-badge"></i> ID</th>
                        <th scope="col"><i class="fas fa-user-alt"></i> Name</th>
                        <th scope="col"><i class="fas fa-phone"></i> Phone</th>
                        <th scope="col"><i class="fas fa-address-book"></i> Address</th>
                        <th scope="col"><i class="fas fa-money-bill-wave"></i> Salary</th>
                        <th scope="col"><i class="fas fa-briefcase"></i> Designation</th>
                        <th scope="col"><i class="fas fa-caret-square-down"></i> Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($query_run) {
                        foreach ($query_run as $row) {
                    ?>
                    <tr>
                        <td><?php echo $row['eid']; ?></td>
                        <td><?php echo $row['ename']; ?></td>
                        <td><?php echo $row['phno']; ?></td>
                        <td><?php echo $row['address']; ?></td>
                        <td><i class="fas fa-rupee-sign"></i> <?php echo $row['salary']; ?></td>
                        <td><?php echo $row['designation']; ?></td>
                        <td>
                            <div class="btn-group">
                                <a class="btn btn-secondary" href="sedit.php?eid=<?php echo $row['eid']; ?>"><i class="fas fa-edit"></i> Edit</a>
                                <a class="btn btn-danger" onclick="return confirm('Do you really want to delete?');" href="sdelete.php?eid=<?php echo $row['eid']; ?>"><i class="fas fa-trash-alt"></i> Delete</a>
                            </div>
                        </td>
                    </tr>
                    <?php
                        }
                    } else {
                        echo "<tr><td colspan='7'>No Record Found</td></tr>";
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

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#staffTable').DataTable();
    });
</script>
</body>
</html>
