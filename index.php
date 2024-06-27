<?php
session_start();
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $conn = new mysqli('localhost', 'root', '', 'dry');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM users WHERE username=? AND password=?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param('ss', $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $row['role'];
            $_SESSION['user_id'] = $row['id'];

            switch ($row['role']) {
                case 'admin':
                    header("Location: startpage.php");
                    break;
                case 'farmer':
                    header("Location: startfarmer.php");
                    break;
                case 'staff':
                    header("Location: /dairy-serve-management-system/staff/verify_staff.php");
                    break;
                case 'buyer':
                    header("Location: startbuyer.php");
                    break;
            }
            exit();
        } else {
            $error_message = 'Invalid username or password';
        }

        $stmt->close();
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Form</title>
    <link rel="icon" href="/dairy-serve-management-system/images/new.png" type="image/icon type">
    <link href="assets/fontawesome-free-6.5.2-web/css/fontawesome.css" rel="stylesheet" />
    <link href="assets/fontawesome-free-6.5.2-web/css/brands.css" rel="stylesheet" />
    <link href="assets/fontawesome-free-6.5.2-web/css/solid.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/bootstrap-5.3.3/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css">
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
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center align-items-center" style="height: 100vh;">
            <div class="col-lg-6 col-md-8 col-sm-10">
                <div class="card border-primary">
                    <div class="card-header bg-primary text-white text-center">
                        <h2 class="card-title">Login Form</h2>
                    </div>
                    <div class="card-body">
                        <?php
                        if (isset($error_message)) {
                            echo '<div class="alert alert-danger text-center" role="alert"><b>' . $error_message . '</b></div>';
                        }
                        ?>
                        <form method="post">
                            <div class="mb-3">
                                <label for="username" class="form-label"><b><i class="fa-solid fa-user-tie"></i> Username:</b></label>
                                <input type="text" class="form-control" name="username" id="username" placeholder="Enter Username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label"><b><i class="fa-solid fa-lock"></i> Password:</b></label>
                                <div class="input-group">
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password" required>
                                    <button class="btn btn-outline-secondary" type="button" id="togglePassword"><i class="fa-solid fa-eye" style="color: #ffffff;"></i> Show</button>
                                </div>
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="showPassword">
                                <label class="form-check-label" for="showPassword"><i class="fa-regular fa-eye fa-flip" style="color: #0400ff;"></i> Show Password</label>
                            </div>
                            <div class="d-grid">
                                <button type="submit" name="login" class="btn btn-primary">Login</button>
                            </div><br>
                        </form>
                        <p class="mt-3 text-center"><b><i class="fa fa-user-plus fa-beat-fade"></i> Not registered yet? <a href="register.php">Register here</a></b></p>
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
    <script>
        document.getElementById("togglePassword").addEventListener("click", function () {
            var passwordField = document.getElementById("password");
            var toggleButton = document.getElementById("togglePassword");

            if (passwordField.type === "password") {
                passwordField.type = "text";
                toggleButton.textContent = "Hide";
            } else {
                passwordField.type = "password";
                toggleButton.textContent = "Show";
            }
        });

        document.getElementById("showPassword").addEventListener("change", function () {
            var passwordField = document.getElementById("password");
            var toggleButton = document.getElementById("togglePassword");

            if (this.checked) {
                passwordField.type = "text";
                toggleButton.textContent = "Hide";
            } else {
                passwordField.type = "password";
                toggleButton.textContent = "Show";
            }
        });
    </script>
</body>
</html>
