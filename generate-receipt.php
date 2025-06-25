<?php
ob_start();
require_once __DIR__ . '/assets/fpdf/FPDF-master/fpdf.php';
require_once 'includes/config.php';

// Get order ID from query
$order_id = isset($_GET['order_id']) ? $_GET['order_id'] : '';
if (!$order_id) {
    die('Order ID missing.');
}

// Fetch order details
$order_sql = "SELECT * FROM orders WHERE orderNumber = '" . mysqli_real_escape_string($con, $order_id) . "'";
$order_res = mysqli_query($con, $order_sql);
$order = mysqli_fetch_assoc($order_res);
if (!$order) {
    echo '<h2 style="color:red;text-align:center;margin-top:40px;">Order not found.</h2>';
    exit;
}

// Fetch user details
$user_sql = "SELECT * FROM users WHERE id = '" . intval($order['userId']) . "'";
$user_res = mysqli_query($con, $user_sql);
$user = mysqli_fetch_assoc($user_res);
if (!$user) {
    echo '<h2 style="color:red;text-align:center;margin-top:40px;">User not found for this order.</h2>';
    exit;
}

// Fetch order items
$items_sql = "SELECT oi.*, p.productName, p.productCompany FROM order_items oi JOIN products p ON oi.productId = p.id WHERE oi.orderId = '" . intval($order['id']) . "'";
$items_res = mysqli_query($con, $items_sql);

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'FootPrint - Order Receipt', 0, 1, 'C');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 8, 'Order Number: ' . $order['orderNumber'], 0, 1);
$pdf->Cell(0, 8, 'Order Date: ' . $order['orderDate'], 0, 1);
$pdf->Ln(2);
$pdf->Cell(0, 8, 'Customer: ' . $user['name'], 0, 1);
$pdf->Cell(0, 8, 'Email: ' . $user['email'], 0, 1);
$pdf->Cell(0, 8, 'Contact: ' . $user['contactno'], 0, 1);
$pdf->Ln(5);

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(80, 8, 'Product', 1);
$pdf->Cell(30, 8, 'Brand', 1);
$pdf->Cell(20, 8, 'Qty', 1);
$pdf->Cell(30, 8, 'Price', 1);
$pdf->Cell(30, 8, 'Subtotal', 1);
$pdf->Ln();
$pdf->SetFont('Arial', '', 12);
$total = 0;
while ($item = mysqli_fetch_assoc($items_res)) {
    $subtotal = $item['quantity'] * $item['price'];
    $pdf->Cell(80, 8, $item['productName'], 1);
    $pdf->Cell(30, 8, $item['productCompany'], 1);
    $pdf->Cell(20, 8, $item['quantity'], 1, 0, 'C');
    $pdf->Cell(30, 8, 'Rs. ' . number_format($item['price'], 2), 1, 0, 'R');
    $pdf->Cell(30, 8, 'Rs. ' . number_format($subtotal, 2), 1, 0, 'R');
    $pdf->Ln();
    $total += $subtotal;
}
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(160, 10, 'Total', 1);
$pdf->Cell(30, 10, 'Rs. ' . number_format($total, 2), 1, 0, 'R');
$pdf->Ln(15);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 8, 'Thank you for shopping with FootPrint!', 0, 1, 'C');
$pdf->Output('I', 'FootPrint_Receipt_' . $order['orderNumber'] . '.pdf'); 