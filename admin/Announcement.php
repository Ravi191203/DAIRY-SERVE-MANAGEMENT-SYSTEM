<?php
// Include PHPMailer files
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
require '../PHPMailer/src/Exception.php';

// Set up PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Check if the form is submitted
if (isset($_POST['announce'])) {
    // Get the announcement message from the form
    $message = $_POST['message'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'dry');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch email addresses from the users table
    $emails = [];
    $sql = "SELECT email FROM users";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Validate email address format
            if (filter_var($row['email'], FILTER_VALIDATE_EMAIL)) {
                $emails[] = $row['email'];
            } else {
                echo '<div class="alert alert-warning text-center" role="alert">Invalid email address found: ' . htmlspecialchars($row['email']) . '</div>';
            }
        }
    }

    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
        $mail->SMTPAuth = true;
        $mail->Username = 'raviraghavendrashetty@gmail.com'; // Your email
        $mail->Password = 'yrpeyimomrzlwkea'; // Your app-specific password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
        $mail->Port = 587; // TCP port to connect to

        // Enable verbose debug output
        $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Enable detailed debug output
        $mail->Debugoutput = function($str, $level) {
            echo "Debug level $level; message: $str\n";
        };

        // Sender info
        $mail->setFrom('raviraghavendrashetty@gmail.com', 'Dairy Serve Management System');

        // Add recipient emails
        foreach ($emails as $email) {
            $mail->addAddress($email);
        }

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Announcement from Dairy Serve Management System';
        $mail->Body = $message;

        // Send email
        if ($mail->send()) {
            echo '<div class="alert alert-success text-center" role="alert">Announcement sent successfully!</div>';
        } else {
            echo '<div class="alert alert-danger text-center" role="alert">Announcement could not be sent. Mailer Error: ' . $mail->ErrorInfo . '</div>';
        }
    } catch (Exception $e) {
        echo '<div class="alert alert-danger text-center" role="alert">Announcement could not be sent. Mailer Error: ' . $e->getMessage() . '</div>';
    }

    // Close the database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Announcement</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 col-sm-10">
                <div class="card">
                    <div class="card-header bg-primary text-white text-center">
                        <h2><i class="fas fa-bullhorn"></i> Make an Announcement</h2>
                    </div>
                    <div class="card-body">
                        <form method="post" action="">
                            <div class="mb-3">
                                <label for="message" class="form-label">Announcement Message:</label>
                                <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                            </div>
                            <div class="d-grid">
                                <button type="submit" name="announce" class="btn btn-primary">Send Announcement</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>
