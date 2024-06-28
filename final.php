<?php
require_once "connection.php";
require('fpdf/fpdf.php');

if (isset($_POST['final'])) {
    $fid = $_POST['fid'];
    $fname = $_POST['fname'];
    $type = $_POST['type'];
    $cost = $_POST['cost'];
    $sum = $_POST['sum'];
    $amount = $_POST['amount'];

    // Insert billing details into bill table
    $sql = "INSERT INTO bill (farmer_id, farmer_name, quantity, amount) VALUES ('$fid', '$fname', '$sum', '$amount')";

    $query_run = mysqli_query($conn, $sql);

    if ($query_run) {
        class myPDF extends FPDF {
            function header() {
                $this->Image("images/NATURE-ONE-DAIRY-CORPORATE-LOGO-01.png", 10, 6, 30);
                $this->SetFont("Helvetica", "B", 20);
                $this->Cell(0, 10, "Farmer Invoice", 0, 1, 'C');
                $this->Ln(10);
            }

            function footer() {
                $this->SetY(-15);
                $this->SetFont("Helvetica", "I", 12);
                $this->Cell(0, 10, "DSMS | Page " . $this->PageNo(), 0, 0, 'C');
            }
        }

        $pdf = new myPDF();
        $pdf->AddPage();
        $pdf->SetFont("Helvetica", "", 16);
    
        $pdf->Cell(0, 10, "Date: " . date("d-m-Y"), 0, 1, 'R');
        $pdf->Cell(0, 10, "Time: " . date("H:i:s"), 0, 1, 'R');
       

        $pdf->SetFont("Helvetica", "B", 16);
        $pdf->Cell(50, 10, "Farmer ID:", 0, 0);
        $pdf->SetFont("Helvetica", "", 16);
        $pdf->Cell(0, 10, $fid, 0, 1);

 
        

        $pdf->SetFont("Helvetica", "B", 16);
        $pdf->Cell(50, 10, "Bill ID:", 0, 0);
        $pdf->SetFont("Helvetica", "", 16);
        $pdf->Cell(0, 10, "234", 0, 1);

        $pdf->SetFont("Helvetica", "B", 16);
        $pdf->Cell(50, 10, "Farmer Name:", 0, 0);
        $pdf->SetFont("Helvetica", "", 16);
        $pdf->Cell(0, 10, $fname, 0, 1);

        $pdf->SetFont("Helvetica", "B", 16);
        $pdf->Cell(50, 10, "Milk Type:", 0, 0);
        $pdf->SetFont("Helvetica", "", 16);
        $pdf->Cell(0, 10, $type, 0, 1);

        $pdf->SetFont("Helvetica", "B", 16);
        $pdf->Cell(50, 10, "Cost per Litre:", 0, 0);
        $pdf->SetFont("Helvetica", "", 16);
        $pdf->Cell(0, 10, $cost, 0, 1);

      

        $pdf->SetFont("Helvetica", "B", 11);
        $pdf->Cell(0    ,8, "Quantity Supplied =", 0, 1, 'R');
        $pdf->SetFont("Helvetica", "", 11);
        $pdf->Cell(0, 10, $sum, 0, 1, 'R');

        $pdf->SetFont("Helvetica", "B", 11);
        $pdf->Cell(0, 10, "Net Amount =", 0, 1, 'R');
        $pdf->SetFont("Helvetica", "", 11);
        $pdf->Cell(0, 10, $amount, 0, 1, 'R');

        $pdf->Output();
        exit;  // Ensure no further output after generating PDF
    } else {
        echo "Error in adding billing: " . mysqli_error($conn);
    }
}
?>
