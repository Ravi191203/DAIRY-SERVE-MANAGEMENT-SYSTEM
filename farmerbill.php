<?php
require_once "connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Farmer Details</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-5.3.3/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <script type="text/javascript" src="hide.js"></script>
  <style>
    .header {
      position: fixed;
      right: 0;
      top: 0;
      width: 100%;
      background-color: black;
      color: white;
      text-align: center;
      z-index: 1000;
      padding: 10px 0;
    }

    .LOGO {
      height: 80px;
      width: auto;
      float: left;
      margin-left: 30px;
    }

    .list {
      float: right;
      margin-right: 40px;
      list-style: none;
    }

    .list li {
      display: inline-block;
      margin-right: 30px;
      margin-top: 30px;
    }

    .list li a {
      text-decoration: none;
      font-size: 20px;
      color: white;
      font-family: serif;
      font-weight: bold;
    }

    .list li:hover {
      border-bottom: 4px solid yellow;
      transition: .3s;
    }

    .main-box {
      margin-top: 140px;
      padding: 20px;
      background-color: rgba(255, 255, 255, 0.9);
      border-radius: 10px;
    }

    .heading {
      color: white;
      font-size: 35px;
      text-align: center;
      letter-spacing: 3px;
      margin-bottom: 20px;
    }

    .form-group label {
      font-size: 18px;
      font-weight: bold;
    }

    .submitf {
      display: block;
      width: 100%;
      font-size: 20px;
    }

    .bdy {
      background-image: linear-gradient(rgba(0,0,0,0.3),rgba(0,0,0,0.3)), url('images/billcc.png');
      background-repeat: no-repeat;
      background-size: cover;
      color: white;
      min-height: 100vh;
      padding-bottom: 60px;
    }

    .footer {
      background-color: black;
      color: white;
      text-align: center;
      padding: 20px;
      position: relative;
      bottom: 0;
      width: 100%;
      margin-top: 20px;
    }

    .alert {
      margin-top: 20px;
    }
  </style>
</head>
<body class="bdy">
  <!-- Header -->
  <div class="header">
    <div class="container-fluid">
      <div class="row align-items-center">
        <div class="col-md-2">
          <a href="index.php"><img src="images/NATURE-ONE-DAIRY-CORPORATE-LOGO-01.png" alt="logo" class="LOGO img-fluid"></a>
        </div>
        <div class="col-md-10">
          <ul class="list d-flex justify-content-end">
            <li><a href="startpage.php" class="effect">HOME</a></li>
            <li><a href="Service.php" class="effect">SERVICE</a></li>
            <li><a href="aboutus.html" class="effect">ABOUT US</a></li>
          </ul>
          <h3>Bill Generation</h3>
        </div>
      </div>
    </div>
  </div>

  <div class="container main-box">
    <form class="bill" action="farmerbill.php" method="POST">
      <div class="form-group text-dark">
        <label for="fid"><i class="fas fa-id-card"></i> Farmer ID:</label>
        <input type="text" class="form-control" name="fid" placeholder="Enter farmer id" required>
      </div>
      <div class="form-group text-dark">
        <label for="from-date"><i class="fas fa-calendar-alt"></i> From-Date:</label>
        <input type="date" class="form-control" name="from-date" required>
      </div>
      <div class="form-group text-dark">
        <label for="to-date"><i class="fas fa-calendar-alt"></i> To-Date:</label>
        <input type="date" class="form-control" name="to-date" required>
      </div>
      <button type="submit" class="btn btn-success submitf" name="billinfo"><i class="fas fa-paper-plane"></i> Submit</button>
      <hr>
    </form>

    <?php
    if (isset($_POST['billinfo'])) {
      $fid = $_POST['fid'];
      $frmdate = date("Y-m-d", strtotime($_POST['from-date']));
      $todate = date("Y-m-d", strtotime($_POST['to-date']));

      $sql = "SELECT f.id, f.fname, f.milk_type, SUM(r.quan) AS total_quantity
              FROM farmer f
              JOIN record r ON f.id = r.fid
              WHERE r.date BETWEEN '$frmdate' AND '$todate'
              AND f.id = '$fid'
              GROUP BY f.id, f.fname, f.milk_type";

      $query_run = mysqli_query($conn, $sql);

      if ($query_run) {
        if (mysqli_num_rows($query_run) > 0) {
          foreach ($query_run as $row) {
    ?>
      <div class="design">
        <form id="receipt" action="final.php" method="POST" class="mt-4">
          <div class="form-group text-dark">
            <label for="fid"><i class="fas fa-id-card"></i> Farmer ID:</label>
            <input type="text" class="form-control" name="fid" value="<?php echo $row['id']; ?>" readonly>
          </div>
          <div class="form-group text-dark">
            <label for="fname"><i class="fas fa-user"></i> Farmer Name:</label>
            <input type="text" class="form-control" name="fname" value="<?php echo $row['fname']; ?>" readonly>
          </div>
          <div class="form-group text-dark">
            <label for="type"><i class="fas fa-tint"></i> Milk Type:</label>
            <input type="text" class="form-control" name="type" value="<?php echo $row['milk_type']; ?>" readonly>
          </div>
          <div class="form-group text-dark">
            <label for="cost"><i class="fas fa-dollar-sign"></i> Cost per liter:</label>
            <input type="text" class="form-control" name="cost" value="<?php
              $milk_type = strtolower($row['milk_type']);
              $price_query = ($milk_type == "cow") ?
                "SELECT product_cost FROM products1 WHERE product_id = 210" :
                "SELECT product_cost FROM products1 WHERE product_id = 209";

              $price_result = mysqli_query($conn, $price_query);
              if ($price_result && mysqli_num_rows($price_result) > 0) {
                $price_row = mysqli_fetch_assoc($price_result);
                echo $price_row['product_cost'];
              } else {
                echo "N/A";
              }
            ?>" readonly>
          </div>
          <div class="form-group text-dark">
            <label for="sum"><i class="fas fa-balance-scale"></i> Net Quantity:</label>
            <input type="text" class="form-control" name="sum" value="<?php echo $row['total_quantity']; ?>" readonly>
          </div>
          <div class="form-group text-dark">
            <label for="amount"><i class="fas fa-money-bill-wave"></i> Net Amount:</label>
            <input type="text" class="form-control" name="amount" value="<?php
              if (isset($price_row['product_cost'])) {
                echo $row['total_quantity'] * $price_row['product_cost'];
              } else {
                echo "N/A";
              }
            ?>" readonly>
          </div>
          <button type="submit" class="btn btn-primary submitf" name="final"><i class="fas fa-receipt"></i> BILL</button>
        </form>
      </div>
    <?php
          }
        } else {
          echo "<div class='alert alert-danger'>Record not found.</div>";
        }
      } else {
        echo "<div class='alert alert-danger'>Error: " . mysqli_error($conn) . "</div>";
      }
    }
    ?>
  </div>

  <!-- Footer -->
  <div class="footer">
    <p>&copy; 2024 DIARY.com All Rights Reserved</p>
  </div>
  <script src="css/bootstrap-5.3.3/bootstrap.bundle.min.js"></script>
  <script src="css/bootstrap-5.3.3/popper.min.js"></script>
  <script src="css/bootstrap-5.3.3/jquery-3.5.1.slim.min.js"></script>
  <script src="css/bootstrap-5.3.3/bootstrap.min.js"></script>
  <!-- Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
