<?php
// Start the session if it's not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if the user_id is set in the session
if (!isset($_SESSION['user_id'])) {
    // Handle the case when user_id is not set (e.g., redirect to login page)
    header("Location: login.php");
    exit();
}

require_once 'db_connect.php';

$user_id = $_SESSION['user_id'];

$query = "SELECT * FROM notifications WHERE user_id='$user_id' ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Notifications</title>
    <style>
        body {
            background-color: lightgrey;
        }
        section {
            border:solid 2px black;
            width: 90%;
            padding: 20px;
            margin: auto;
            background-color: lightgrey;
            border-radius: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="../assets/fontawesome-free-6.5.2-web/css/fontawesome.css" rel="stylesheet" />
  <link href="../assets/fontawesome-free-6.5.2-web/css/brands.css" rel="stylesheet" />
  <link href="../assets/fontawesome-free-6.5.2-web/css/solid.css" rel="stylesheet" />
</head>
<body>
    <div class="container my-4">
        <h2 class="text-center">Notifications</h2>
        
        <ul class="list-group">
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <section>
                <li class="list-group-item">
                    <i class="fa fa-bell fa-beat-fade"></i> <!-- Font Awesome Icon -->
                    <?php echo $row['message']; ?>
                    <span class="text-muted float-end"><?php echo $row['created_at']; ?></span>
                </li>
                </section><br>
            <?php } ?>
        </ul>
    </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
} else {
    echo "<p class='text-center'>No notifications found.</p>";
}

mysqli_close($conn);
?>
