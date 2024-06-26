<?php
require('fpdf/fpdf.php');

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dry"; // replace with your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch employee data
$eid = $_GET['eid']; // Assuming employee ID is passed via GET request
$sql = "SELECT * FROM employee WHERE eid = $eid";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Create a new PDF file
    $pdf = new FPDF();
    $pdf->AddPage();

    // Set title
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 10, 'Salary Slip', 0, 1, 'C');

    // Employee details
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(50, 10, 'Employee ID:', 0, 0);
    $pdf->Cell(50, 10, $row['eid'], 0, 1);

    $pdf->Cell(50, 10, 'Employee Name:', 0, 0);
    $pdf->Cell(50, 10, $row['ename'], 0, 1);

    $pdf->Cell(50, 10, 'Phone Number:', 0, 0);
    $pdf->Cell(50, 10, $row['phno'], 0, 1);

    $pdf->Cell(50, 10, 'Designation:', 0, 0);
    $pdf->Cell(50, 10, $row['designation'], 0, 1);

    $pdf->Cell(50, 10, 'Address:', 0, 0);
    $pdf->Cell(50, 10, $row['address'], 0, 1);

    // Salary details
    $pdf->Cell(50, 10, 'Salary:', 0, 0);
    $pdf->Cell(50, 10, 'Rs. ' . $row['salary'], 0, 1);

    // Output the PDF
    $pdf->Output();

} else {
    echo "No employee found with ID: $eid";
}

$conn->close();
?>
