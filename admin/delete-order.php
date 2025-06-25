<?php
session_start();
include('include/config.php');

// Check if admin is logged in
if(strlen($_SESSION['alogin'])==0) {
    header('location:index.php');
    exit();
}

// Check if order ID is provided and is numeric
if(!isset($_GET['orderid']) || !is_numeric($_GET['orderid'])) {
    $_SESSION['delmsg'] = "Invalid order ID";
    header('location:delivered-orders.php');
    exit();
}

$orderid = intval($_GET['orderid']);

// Check if order exists and is in 'Delivered' status
$check_query = mysqli_query($con, "SELECT orderStatus FROM orders WHERE id='$orderid'");
if(mysqli_num_rows($check_query) == 0) {
    $_SESSION['delmsg'] = "Order not found";
    header('location:delivered-orders.php');
    exit();
}

$row = mysqli_fetch_array($check_query);
if($row['orderStatus'] != 'Delivered') {
    $_SESSION['delmsg'] = "Only delivered orders can be deleted";
    header('location:delivered-orders.php');
    exit();
}

// Delete the order
$delete_query = mysqli_query($con, "DELETE FROM orders WHERE id='$orderid'");
if($delete_query) {
    $_SESSION['delmsg'] = "Order deleted successfully";
} else {
    $_SESSION['delmsg'] = "Error deleting order";
}

header('location:delivered-orders.php');
?> 