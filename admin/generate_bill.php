<?php
require_once '../db_connect.php';
require_once '../fpdf/fpdf.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $farmer_id = $_POST['farmer_id'];

    // Validate farmer_id (you can add more validation if needed)
    if (!is_numeric($farmer_id) || $farmer_id <= 0) {
        echo "Invalid farmer ID.";
        exit();
    }

    // Fetch farmer details from the database
    $sql = "SELECT date, milk_qty, fat, snf, rate FROM daily_data WHERE farmer_id = ?";
    $stmt = mysqli_stmt_init($con);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "SQL error: " . mysqli_error($con);
        exit();
    }

    mysqli_stmt_bind_param($stmt, "i", $farmer_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $farmer_data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $farmer_data[] = $row;
    }

    class PDF extends FPDF
    {
        function Header()
        {
            $this->SetFont('Arial', 'B', 12);
            $this->Cell(0, 10, 'Milk Collection Bill', 0, 1, 'C');
            $this->Ln(10);
        }

        function Footer()
        {
            $this->SetY(-15);
            $this->SetFont('Arial', 'I', 8);
            $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
        }

        function BillTable($header, $data)
        {
            $this->SetFont('Arial', 'B', 10);
            foreach ($header as $col) {
                $this->Cell(38, 7, $col, 1);
            }
            $this->Ln();
            $this->SetFont('Arial', '', 10);
            foreach ($data as $row) {
                foreach ($row as $col) {
                    $this->Cell(38, 6, $col, 1);
                }
                $this->Ln();
            }
        }
    }

    $pdf = new PDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 12);

    $header = ['Date', 'Milk Qty', 'Fat (%)', 'SNF (%)', 'Rate'];
    $data = [];

    foreach ($farmer_data as $row) {
        $data[] = [$row['date'], $row['milk_qty'], $row['fat'], $row['snf'], $row['rate']];
    }

    $pdf->BillTable($header, $data);

    $pdf->Output('I', 'bill.pdf');
} else {
    echo "Invalid request method.";
}
?>
