<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Animal Info</title>
  <style>
    body {
            background-color: lightgrey;
        }
        section {
            width: 90%;
            padding: 20px;
            margin: auto;
            background-color: #fff;
            border-radius: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
  </style>
  <link rel="stylesheet" href="css/bootstrap-5.3.3/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

  <!-- Header -->
  <header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container-fluid">
        <a class="navbar-brand" href="startpage.php">
          <img src="images/new.png" alt="logo" height="100" width="auto">
        </a>
        <h3 style="color: aliceblue;">
      <img src="images/cow-silhouette.png" alt="cow" style="height: 50px; width: auto;"> Dairy Animal Details
    </h3>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="startpage.php"><i class="fas fa-home"></i> HOME</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="Service.php"><i class="fas fa-dolly-flatbed"></i> SERVICES</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="aboutus.html"><i class="fas fa-info-circle"></i> ABOUT US</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
<br><br><br><br><br><br><br>
  <!-- Main content -->
  <div class="container mt-5">
    
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
        <section>
        <table id="example1" class="table table-striped table-hover">
          <thead>
            <tr>
              <th scope="col"><img src="images/dorsal.png" alt="" style="height: 25px; width: auto;"> Animal Health ID</th>
              <th scope="col"><i class="fas fa-user-alt"></i> Owner</th>
              <th scope="col"><i class="fas fa-phone"></i> Phone</th>
              <th scope="col"><img src="images/cow-silhouette.png" alt="" style="height: 25px; width: auto;"> Animal Type</th>
              <th scope="col"><img src="images/milk.png" alt="" style="height: 25px; width: auto;"> Minimum Litre/day</th>
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
              echo "No Record Found";
            }
            ?>
          </tbody>
        </table>
        
      </div>
    </div>
  </div>
  </section>
  <!-- Footer -->
  <div class="footer alert alert-info">
    <h5>&copy;2023 Dairy Serve Management System. All Rights Reserved</h5>
</div>
<style>
   .footer {
            text-align: center;
            padding: 40px;
            border-radius: 15px;
            background-color: black;
            border-top: 1px solid #dee2e6;
            margin-top: 20px;
            font-weight: bold;
            color: white;
        } 
</style>
<script src="../css/bootstrap-5.3.3/bootstrap.bundle.min.js"></script>
<script src="../css/bootstrap-5.3.3/popper.min.js"></script>
<script src="../css/bootstrap-5.3.3/jquery-3.5.1.slim.min.js"></script>
<script src="../css/bootstrap-5.3.3/bootstrap.min.js"></script>

  <!-- Bootstrap JS, Popper.js, and jQuery -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>