<?php
session_start();
$count = 0;
if (!empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $count += $item['quantity'];
    }
}
echo $count;
?> 