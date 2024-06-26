<?php
//require('fpdf183/fpdf.php'); // Include FPDF library
require_once "connection.php";
require('fpdf/fpdf.php');

// Get invoice_id from form submission
$invoice_id = $_POST['invoice_id'];

// Database connection
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

// Retrieve data based on invoice_id
$sql = "SELECT * FROM `dairy_customers` WHERE `invoice_id` = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $invoice_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($row) {
    // Data found, proceed with PDF generation
    $pdf = new FPDF();
    $pdf->AddPage();

    // Set background image
    $pdf->Image("images/NATURE-ONE-DAIRY-CORPORATE-LOGO-01.png", 10, 6);

    // Draw border
    $pdf->SetLineWidth(1);
    $pdf->Rect(5, 5, $pdf->GetPageWidth() - 10, $pdf->GetPageHeight() - 10);

    // Title
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 10, 'Invoice', 0, 1, 'C');
    $pdf->Ln(10);

    // Invoice details
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, 'Invoice ID: ' . $row['invoice_id'], 0, 1);
    $pdf->Cell(0, 10, 'Customer Name: ' . $row['customer_name'], 0, 1);
    $pdf->Cell(0, 10, 'Customer Mobile: ' . $row['customer_mobile'], 0, 1);
    $pdf->Cell(0, 10, 'Total Cost: Rs. ' . $row['Total_cost'], 0, 1);
    $pdf->Ln(10);

    // Products Purchased
    $products = [];
    if ($row['PR1']) $products[] = $row['PR1'];
    if ($row['PR2']) $products[] = $row['PR2'];
    if ($row['PR3']) $products[] = $row['PR3'];
    if ($row['PR4']) $products[] = $row['PR4'];
    if ($row['PR5']) $products[] = $row['PR5'];

    // Table header
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(40, 10, 'Product ID', 1, 0, 'C');
    $pdf->Cell(80, 10, 'Product Name', 1, 0, 'C');
    $pdf->Cell(40, 10, 'Price', 1, 1, 'C');

    // Table body
    $pdf->SetFont('Arial', '', 12);
    foreach ($products as $product_id) {
        $product_sql = "SELECT * FROM `products` WHERE `product_id` = ?";
        $product_stmt = $conn->prepare($product_sql);
        $product_stmt->bind_param("i", $product_id);
        $product_stmt->execute();
        $product_result = $product_stmt->get_result();
        $product_row = $product_result->fetch_assoc();

        if ($product_row) {
            // Product details
            $pdf->Cell(40, 10, $product_row['product_id'], 1, 0, 'C');
            $pdf->Cell(80, 10, $product_row['product_name'], 1, 0, 'L');
            $pdf->Cell(40, 10, 'Rs. ' . $product_row['product_cost'], 1, 1, 'R');
        }
        $product_stmt->close();
    }

    // Output PDF
    $pdf->Output('I', 'Invoice_' . $invoice_id . '.pdf'); // I for inline, D for download
    exit;
} else {
    // No data found
    echo "<script>alert('Invoice ID not found');</script>";
    echo "<script>window.location.href = 'History.php';</script>";
}

$stmt->close();
$conn->close();
?>
