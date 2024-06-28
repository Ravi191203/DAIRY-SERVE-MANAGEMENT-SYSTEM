<?php
session_start();
include 'config.php';
require_once 'fpdf/fpdf.php'; // Ensure FPDF library is included

// Check database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get username from GET parameter
$username = $_GET['username'];

// Fetch customer_id using username
$customer_id_query = "SELECT customer_id FROM orders WHERE username = ? LIMIT 1";
$customer_id_stmt = $conn->prepare($customer_id_query);
if ($customer_id_stmt === false) {
    die("Error preparing the statement: " . $conn->error);
}
$customer_id_stmt->bind_param("s", $username);
$customer_id_stmt->execute();
$customer_id_result = $customer_id_stmt->get_result();
$customer_id_row = $customer_id_result->fetch_assoc();
$customer_id = $customer_id_row['customer_id'];

// Fetch customer details using customer_id
$customer_query = "SELECT customer_name, customer_mobile, customer_email FROM customers WHERE customer_id = ?";
$customer_stmt = $conn->prepare($customer_query);
if ($customer_stmt === false) {
    die("Error preparing the statement: " . $conn->error);
}
$customer_stmt->bind_param("i", $customer_id);
$customer_stmt->execute();
$customer_result = $customer_stmt->get_result();
$customer = $customer_result->fetch_assoc();

// Fetch orders for the specified username
$user_orders_query = "SELECT o.*, oi.product_id, p.product_name, oi.quantity, p.price
                     FROM orders o
                     JOIN order_items oi ON o.order_id = oi.order_id
                     JOIN products p ON oi.product_id = p.product_id
                     WHERE o.username = ?
                     ORDER BY o.order_date DESC";
$stmt = $conn->prepare($user_orders_query);
if ($stmt === false) {
    die("Error preparing the statement: " . $conn->error);
}
$stmt->bind_param("s", $username);
$stmt->execute();
$user_orders_result = $stmt->get_result();

// Initialize FPDF
class PDF extends FPDF {
    // Page header
    function Header() {
        // Logo
        $this->Image('images/new.png',10,6,30); // Adjust the path and size as needed
        // Arial bold 15
        $this->SetFont('Arial','B',15);
        // Move to the right
        $this->Cell(80);
        // Title
        $this->Cell(30,10,'Ordered Products Invoice',0,0,'C');
        // Line break
        $this->Ln(20);
    }

    // Page footer
    function Footer() {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Page number
        $this->Cell(0,10,'DSMS - Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);
 // Added border to the title cell

// Add customer details
$pdf->SetFont('Arial','B',10);
$pdf->Cell(190,10,'Customer Details',1,1,'C');
$pdf->SetFont('Arial','',10);
$pdf->Cell(190,10,'Name: '.$customer['customer_name'],1,1);
$pdf->Cell(190,10,'Mobile: '.$customer['customer_mobile'],1,1);
$pdf->Cell(190,10,'Email: '.$customer['customer_email'],1,1);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(190,10,'Order Details for '.$username,1,1,'C');
// Iterate through orders and add details to PDF
while ($order = $user_orders_result->fetch_assoc()) {
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(190,10,'Order ID: '.$order['order_id'],1,1); // Added border to each cell
    $pdf->Cell(190,10,'Order Date: '.$order['order_date'],1,1);
    $pdf->Cell(190,10,'Product Name: '.$order['product_name'],1,1);
    $pdf->Cell(190,10,'Quantity: '.$order['quantity'],1,1);
    $pdf->Cell(190,10,'Price: '.$order['price'],1,1);
    $pdf->Cell(190,10,'Total Cost: '.$order['total_cost'],1,1);
    $pdf->Cell(190,10,'Payment Mode: '.ucfirst($order['payment_mode']),1,1);
    $pdf->Ln();
}

// Output PDF
$pdf->Output();

// Close the statement and connection
$stmt->close();
$conn->close();
?>
