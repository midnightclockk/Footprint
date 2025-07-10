<?php
session_start();
include('includes/config.php');
if (isset($_GET['action']) && $_GET['action'] === 'set' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $qty = isset($_GET['qty']) ? max(1, intval($_GET['qty'])) : 1;
    $query = mysqli_query($con, "SELECT * FROM products WHERE id={$id}");
    if (mysqli_num_rows($query) != 0) {
        $row = mysqli_fetch_array($query);
        $_SESSION['buy_now'] = [
            'id' => $row['id'],
            'quantity' => $qty,
            'price' => $row['productPrice'],
            'name' => $row['productName'],
            'image' => $row['productImage1']
        ];
    }
}
header('Location: payment-method.php');
exit; 