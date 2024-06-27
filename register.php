<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>REGISTER FORM</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css">
    <link href="assets/fontawesome-free-6.5.2-web/css/fontawesome.css" rel="stylesheet" />
  <link href="assets/fontawesome-free-6.5.2-web/css/brands.css" rel="stylesheet" />
  <link href="assets/fontawesome-free-6.5.2-web/css/solid.css" rel="stylesheet" />
  <link rel="stylesheet" href="css/bootstrap-5.3.3/bootstrap.min.css">
    <link rel="icon" href="/dairy-serve-management-system/images/new.png" type="image/icon type">
    <style>
    body {
            background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.4)), url(images/mainimg.jpeg);
            background-repeat: no-repeat;
            background-size: cover;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        
        .card {
            animation: fadeIn 1s ease-in-out;
            border-radius: 15px;
            animation: fadeIn 1s ease-in-out;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
            margin: 10% auto;
            border: 2px solid transparent;
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }
        .x{
            border-radius: 20px;
        }
        .card-header {
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }
        .btn-primary {
            transition: background-color 0.3s, transform 0.3s;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }
        .form-control {
            border-radius: 5px;
            transition: border-color 0.3s, box-shadow 0.3s;
        }
        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 10px rgba(0, 123, 255, 0.5);
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .form-control{
            width: 100%;
	padding: 12px;
	margin: auto;
	border: 1px solid #ddd;
	border-radius: 12px;
	background: #f9f9f9;
	color: #333;
        }
        .form-control input:focus,
        .form-control textarea:focus,
        .form-control select:focus {
	border-color: red;
}
    </style>
</head>

<body style="background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.4)), url(images/mainimg.jpeg); background-repeat: no-repeat; background-size: 1500px 900px;">
    <div class="container">
        <div class="row justify-content-center align-items-center" style="height: 100vh;">
            <div class="col-lg-6 col-md-8 col-sm-10">
                <div class="card border-danger">
                    <div class="x card-header bg-danger text-white text-center">
                        <h2 class="card-title">Register</h2>
                    </div>
                    <div class="card-body">
                        <form method="post">
                            <div class="mb-3">
                                <label for="username" class="form-label"><i class="fa-solid fa-user-tie"></i> Username:</label>
                                <input type="text" class="form-control" name="username" id="username" placeholder="Enter Username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label"><i class="fa-solid fa-lock"></i> Password:</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Enter password" required>
                            </div>
                            <div class="mb-3">
                                <label for="role" class="form-label"><i class="fas fa-user-shield"></i>
                                 Role:</label>
                                <select class="form-select" name="role" id="role" required>
                                    <option value="">-- Select --</option>
                                    <option value="farmer">Farmer</option>
                                    <option value="staff">Staff</option>
                                    <option value="buyer">Buyer</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                            <div class="d-grid">
                                <button type="submit" name="register" class="btn btn-danger">Register</button>
                            </div>
                        </form>
                        <?php
                        if (isset($_POST['register'])) {
                            $username = $_POST['username'];
                            $password = md5($_POST['password']); // Hash the password for security (note: use a stronger hashing method in production)
                            $role = $_POST['role'];

                            $conn = new mysqli('localhost', 'root', '', 'dry'); // Adjust database credentials as per your configuration
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }

                            // Check if username already exists
                            $checkSql = "SELECT * FROM users WHERE username = '$username'";
                            $result = $conn->query($checkSql);

                            if ($result->num_rows > 0) {
                                echo '<div class="alert alert-danger text-center" role="alert">Username already exists. Please try with a different one.</div>';
                            } else {
                                $sql = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')";
                                if ($conn->query($sql) === TRUE) {
                                    echo '<div class="alert alert-success text-center" role="alert">Registration successful! Redirecting...</div>';

                                    // Redirect based on role
                                    switch ($role) {
                                        case 'admin':
                                            echo '<script>setTimeout(function(){ window.location = "startpage.php"; }, 2000);</script>';
                                            break;
                                        case 'farmer':
                                            echo '<script>setTimeout(function(){ window.location = "/dairy-serve-management-system/index.php"; }, 2000);</script>';
                                            break;
                                        case 'staff':
                                            echo '<script>setTimeout(function(){ window.location = "/dairy-serve-management-system/staff1/staff_register.php"; }, 2000);</script>';
                                            break;
                                        case 'buyer':
                                            echo '<script>setTimeout(function(){ window.location = "index.php"; }, 2000);</script>';
                                            break;
                                        default:
                                            echo '<script>setTimeout(function(){ window.location = "index.php"; }, 2000);</script>';
                                    }
                                } else {
                                    echo '<div class="alert alert-danger text-center" role="alert">Error: ' . $sql . '<br>' . $conn->error . '</div>';
                                }
                            }

                            $conn->close();
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="css/bootstrap-5.3.3/bootstrap.bundle.min.js"></script>
<script src="css/bootstrap-5.3.3/popper.min.js"></script>
<script src="css/bootstrap-5.3.3/jquery-3.5.1.slim.min.js"></script>
<script src="css/bootstrap-5.3.3/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
</body>

</html>
