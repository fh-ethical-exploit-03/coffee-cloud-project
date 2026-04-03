<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $servername = "localhost";
    $username = "atharv";
    $password = "atharv09";
    $dbname = "coffees";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $payment = $_POST['payment'];
    $cart_json = $_COOKIE['cart'];

    $cart = json_decode($cart_json, true);

    require ('pdf/fpdf.php'); // Include the FPDF library

    // Create a new instance of FPDF class
    $pdf = new FPDF();

    // Add a page
    $pdf->AddPage();

    // Set font for the entire document
    $pdf->SetFont('Arial', '', 12);

    // Title
    $pdf->Cell(0, 10, 'Invoice', 0, 1, 'C');

    // Add a line break
    $pdf->Ln(10);

    // Customer Information
    $pdf->Cell(50, 10, 'Customer Name:', 0);
    $pdf->Cell(0, 10, $name, 0, 1);

    $pdf->Cell(50, 10, 'Contact:', 0);
    $pdf->Cell(0, 10, $contact, 0, 1);

    $pdf->Cell(50, 10, 'Payment Method:', 0);
    $pdf->Cell(0, 10, $payment, 0, 1);

    // Add a line break
    $pdf->Ln(10);

    // Table header
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(50, 10, 'Description', 1, 0, 'C');
    $pdf->Cell(30, 10, 'Quantity', 1, 0, 'C');
    $pdf->Cell(40, 10, 'Unit Price', 1, 0, 'C');
    $pdf->Cell(40, 10, 'Total', 1, 1, 'C');

    // Table rows

    $pdf->SetFont('Arial', '', 12);
    $sum = 0;
    foreach($cart as $item) {
        $pdf->Cell(50, 10, $item['name'], 1, 0);
        $pdf->Cell(30, 10, $item['quantity'], 1, 0, 'C');
        $pdf->Cell(40, 10, $item['price'], 1, 0, 'R');
        $pdf->Cell(40, 10, $item['price'] * $item['quantity'], 1, 1, 'R');
        $sum += $item['price'] * $item['quantity'];
    }

    $sql = "INSERT INTO ORDERS(name, contact, payment, total_cart_value) VALUES('$name', '$contact', '$payment', '$sum');";
    $conn->query($sql);
    // Total
    $pdf->Cell(120, 10, 'Total:', 1, 0, 'R');
    $pdf->Cell(40, 10, $sum, 1, 1, 'R');

    // Set HTTP headers for download
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="invoice.pdf"');

    // Output the PDF
    $pdf->Output('invoice.pdf', 'D');

    echo "
    <script>
        window.href.location = 'index.php';
    </script>
    ";
    exit; // Exit script after download
} else {
}
?>