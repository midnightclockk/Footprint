<?php
session_start();
$total = 0;
if (!empty($_SESSION['cart'])) {
    include('includes/config.php');
    $productIds = array_keys($_SESSION['cart']);
    if (count($productIds) > 0) {
        $sql = "SELECT id, productPrice, shippingCharge FROM products WHERE id IN (".implode(',', $productIds).")";
        $query = mysqli_query($con, $sql);
        $products = [];
        while($row = mysqli_fetch_assoc($query)){
            $products[$row['id']] = $row;
        }
        foreach ($_SESSION['cart'] as $productId => $cartItem) {
            if (isset($products[$productId])) {
                $row = $products[$productId];
                $quantity = $cartItem['quantity'];
                $subtotal = ($quantity * $row['productPrice']) + $row['shippingCharge'];
                $total += $subtotal;
            }
        }
    }
}
echo number_format($total, 2); 