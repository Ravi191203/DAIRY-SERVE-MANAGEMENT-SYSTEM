<?php
require('fpdf/fpdf.php');
include 'db_connect.php';

class PDF extends FPDF
{
    function Header()
    {
        // Logo
        $this->Image('../images/new.png',10,6,30); // Adjust the path and size as needed
        $this->SetFont('Arial','B',15);
        // Move to the right
        $this->Cell(80);
        // Title
        $this->Cell(30,10,'Invoice',0,0,'C');
        // Line break
        $this->Ln(20);
    }

    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        // Page number
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }

    function FancyTable($header, $data)
    {
        // Colors, line width and bold font
        $this->SetFillColor(255,0,0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128,0,0);
        $this->SetLineWidth(.3);
        $this->SetFont('','B');
        // Header
        $w = array(40, 35, 40, 45);
        for($i=0;$i<count($header);$i++)
            $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
        $this->Ln();
        // Color and font restoration
        $this->SetFillColor(224,235,255);
        $this->SetTextColor(0);
        $this->SetFont('');
        // Data
        $fill = false;
        foreach($data as $row)
        {
            $this->Cell($w[0],6,$row[0],'LR',0,'L',$fill);
            $this->Cell($w[1],6,$row[1],'LR',0,'L',$fill);
            $this->Cell($w[2],6,$row[2],'LR',0,'R',$fill);
            $this->Cell($w[3],6,$row[3],'LR',0,'R',$fill);
            $this->Ln();
            $fill = !$fill;
        }
        // Closing line
        $this->Cell(array_sum($w),0,'','T');
    }
}

if (isset($_GET['bill_id'])) {
    $bill_id = $_GET['bill_id'];

    // Fetch bill details
    $sql = "SELECT * FROM bills WHERE bill_id = $bill_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $bill = $result->fetch_assoc();
        
        // Fetch customer details
        $customer_id = $bill['customer_id'];
        $sql_customer = "SELECT * FROM sscustomers WHERE customer_id = $customer_id";
        $result_customer = $conn->query($sql_customer);
        
        if ($result_customer->num_rows > 0) {
            $customer = $result_customer->fetch_assoc();

            $pdf = new PDF();
            $pdf->AliasNbPages();
            $pdf->AddPage();
            
            // Add bill details
            $pdf->SetFont('Arial','',12);
            $pdf->Cell(0,10,'Bill ID: ' . $bill['bill_id'],0,1);
            $pdf->Cell(0,10,'Customer ID: ' . $bill['customer_id'],0,1);
            $pdf->Cell(0,10,'Amount: $' . $bill['amount'],0,1);
            $pdf->Cell(0,10,'Date: ' . $bill['date'],0,1);

            // Add customer details
            $pdf->Cell(0,10,'',0,1); // empty cell for spacing
            $pdf->Cell(0,10,'Customer Details:',0,1);
            $pdf->Cell(0,10,'Name: ' . (isset($customer['customer_name']) ? $customer['customer_name'] : 'N/A'),0,1);
            $pdf->Cell(0,10,'Email: ' . (isset($customer['email']) ? $customer['email'] : 'N/A'),0,1);
            $pdf->Cell(0,10,'Phone: ' . (isset($customer['phone']) ? $customer['phone'] : 'N/A'),0,1);
            $pdf->Cell(0,10,'Address: ' . (isset($customer['address']) ? $customer['address'] : 'N/A'),0,1);

            // Add a border around the page
            $pdf->SetDrawColor(0, 0, 0);
            $pdf->Rect(5, 5, 200, 287, 'D');

            // Output PDF
            $pdf->Output();
        } else {
            echo "Customer details not found.";
        }
    } else {
        echo "No bill found with ID: $bill_id";
    }
} else {
    echo "No bill ID provided.";
}
?>
