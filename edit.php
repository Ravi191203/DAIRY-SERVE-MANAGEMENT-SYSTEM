<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Farmer</title>
    <link href="assets/fontawesome-free-6.5.2-web/css/fontawesome.css" rel="stylesheet" />
    <link href="assets/fontawesome-free-6.5.2-web/css/brands.css" rel="stylesheet" />
    <link href="assets/fontawesome-free-6.5.2-web/css/solid.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/bootstrap-5.3.3/b4.5.2.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
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

$id = $_GET['id'];

$showquery = "SELECT * FROM farmer WHERE id=?";
$stmt = $conn->prepare($showquery);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$arrdata = $result->fetch_assoc();

if (isset($_POST['updatefarmerdata'])) {
    $fname = $_POST['fname'];
    $ph = $_POST['ph'];
    $f_vid = $_POST['f_vid'];
    $milk_type = $_POST['milk_type'];
    $min_litre = $_POST['min_litre'];
    $animalID = $_POST['animalID'];

    $sql = "UPDATE farmer SET fname=?, ph=?, f_vid=?, milk_type=?, min_litre=?, animalID=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssisssi", $fname, $ph, $f_vid, $milk_type, $min_litre, $animalID, $id);
    $res = $stmt->execute();

    if ($res) {
        header('Location: farmer.php');
    } else {
        echo "Error updating record: " . $conn->error;
    }
    $stmt->close();
}

$conn->close();
?>
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h3><b>Update Farmer Details</b> <a class="btn btn-outline-secondary float-right" href="farmer.php"><i class="fas fa-arrow-circle-left"></i> Back</a></h3>
        </div>
        <div class="card-body">
            <form action="" method="POST">
                <div class="form-group">
                    <label for="fname"><i class="fas fa-user"></i> First Name <sup>*</sup></label>
                    <input type="text" class="form-control" name="fname" value="<?php echo htmlspecialchars($arrdata['fname']); ?>" placeholder="First Name" required>
                </div>
                <div class="form-group">
                    <label for="ph"><i class="fas fa-phone"></i> Phone Number <sup>*</sup></label>
                    <input type="text" class="form-control" name="ph" value="<?php echo htmlspecialchars($arrdata['ph']); ?>" placeholder="Phone Number" maxlength="10" required>
                </div>
                <div class="form-group">
                    <label for="f_vid"><i class="fas fa-map-marker-alt"></i> Village ID <sup>*</sup></label>
                    <input type="number" class="form-control" name="f_vid" value="<?php echo htmlspecialchars($arrdata['f_vid']); ?>" placeholder="Village ID" required>
                </div>
                <div class="form-group">
                    <label for="milk_type"><i class="fas fa-cow"></i> Milk Type <sup>*</sup></label>
                    <input type="text" class="form-control" name="milk_type" value="<?php echo htmlspecialchars($arrdata['milk_type']); ?>" placeholder="Cow or Buffalo" required>
                </div>
                <div class="form-group">
                    <label for="min_litre"><i class="fas fa-tint"></i> Minimum Litre <sup>*</sup></label>
                    <input type="number" class="form-control" name="min_litre" value="<?php echo htmlspecialchars($arrdata['min_litre']); ?>" placeholder="/day" required>
                </div>
                <div class="form-group">
                    <label for="animalID"><i class="fas fa-id-badge"></i> Animal Health ID <sup>*</sup></label>
                    <input type="text" class="form-control" name="animalID" value="<?php echo htmlspecialchars($arrdata['animalID']); ?>" placeholder="Issued by Health Ministry" maxlength="5" required>
                </div>
                <button type="submit" name="updatefarmerdata" class="btn btn-primary"><i class="fas fa-save"></i> Update</button>
            </form>
        </div>
    </div>
</div>
<script src="css/bootstrap-5.3.3/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
