<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Bill</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Generate Bill for Farmer</h2>
        <form action="generate_bill.php" method="POST">
            <div class="form-group">
                <label for="farmer_id">Farmer ID</label>
                <input type="number" class="form-control" id="farmer_id" name="farmer_id" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Generate Bill</button>
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>
