<?php
session_start();
$orderNumber = isset($_GET['orderNumber']) ? $_GET['orderNumber'] : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success | FootPrint</title>
    <style>
        body { background: #f4f6f8; font-family: Arial, sans-serif; margin: 0; padding: 0; display: flex; align-items: center; justify-content: center; min-height: 100vh; }
        .card-success { max-width: 400px; margin: 0; background: #fff; border-radius: 16px; box-shadow: 0 4px 24px rgba(0,0,0,0.07); padding: 40px 30px; text-align: center; border-top: 10px solid #2ecc71; }
        .success-icon { background: #2ecc71; width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 18px; }
        .success-icon svg { width: 36px; height: 36px; color: #fff; }
        .success-title { color: #2ecc71; font-size: 2rem; font-weight: bold; margin-bottom: 10px; }
        .success-msg { color: #444; font-size: 1.1rem; margin-bottom: 30px; }
        .order-info { margin-bottom: 18px; }
        .order-info strong { color: #222; }
        .btn-row { display: flex; gap: 12px; justify-content: center; }
        .btn-success, .btn-receipt { background: #2ecc71; color: #fff; border: none; padding: 12px 22px; border-radius: 6px; font-size: 1rem; font-weight: 500; text-decoration: none; transition: background 0.2s; cursor: pointer; }
        .btn-success:hover, .btn-receipt:hover { background: #27ae60; }
        .btn-link { background: none; color: #3498db; border: none; padding: 0; font-size: 1rem; text-decoration: underline; cursor: pointer; }
        .btn-link:hover { color: #217dbb; }
    </style>
</head>
<body>
    <div class="card-success">
        <div class="success-icon">
            <svg fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" stroke="#fff" stroke-width="0"/><path d="M7 13l3 3 7-7" stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </div>
        <div class="success-title">Success!</div>
        <div class="success-msg">Your order has been placed successfully.</div>
        <?php if ($orderNumber): ?>
            <div class="order-info">
                <div><strong>Order Number:</strong> <?php echo htmlspecialchars($orderNumber); ?></div>
                <div><strong>Payment Mode:</strong> Cash on Delivery (COD)</div>
            </div>
            <div class="btn-row">
                <a href="print-receipt.php?order_id=<?php echo urlencode($orderNumber); ?>" class="btn-receipt" target="_blank">Print Receipt</a>
                <a href="index.php" class="btn-success">Continue Shopping</a>
            </div>
        <?php else: ?>
            <div class="order-info">Order number not found.</div>
            <a href="order-history.php" class="btn-link">Go to My Orders</a>
        <?php endif; ?>
    </div>
</body>
</html> 