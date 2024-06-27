<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Salary Slip</title>
    <link rel="stylesheet" href="css/bootstrap-5.3.3/bootstrap.min.css">
    <style>
        body {
            background-color: pink;
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <section>
    <div class="container mt-5">
        <h2 class="text-center">Generate Salary Slip</h2>
        <form action="generate_salary_slip.php" method="GET">
            <div class="form-group">
                <label for="eid">Employee ID:</label>
                <input type="number" class="form-control" id="eid" name="eid" required>
            </div>
            <button type="submit" class="btn btn-primary">Generate</button>
        </form>
    </div>
    </section>
    <script src="css/bootstrap-5.3.3/bootstrap.bundle.min.js"></script>
    <script src="css/bootstrap-5.3.3/popper.min.js"></script>
    <script src="css/bootstrap-5.3.3/jquery-3.5.1.slim.min.js"></script>
    <script src="css/bootstrap-5.3.3/bootstrap.min.js"></script>
</body>
</html>
