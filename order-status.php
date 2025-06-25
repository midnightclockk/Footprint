<?php
$order_id = isset($_GET['order_id']) ? $_GET['order_id'] : '';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Order Status</title>
    <style>
        body { font-family: Arial, sans-serif; background: #faf7f5; padding: 40px; }
        .status-card { max-width: 500px; margin: 60px auto; background: #fff; border-radius: 16px; box-shadow: 0 4px 24px rgba(0,0,0,0.04); padding: 40px; text-align: center; }
        .order-id { font-size: 18px; color: #333; margin-bottom: 16px; }
        .status { font-size: 22px; color: #198754; font-weight: bold; }
    </style>
</head>
<body>
    <div class="status-card">
        <div class="order-id">Order ID: <?php echo htmlspecialchars($order_id); ?></div>
        <div class="status">Your order is being processed!</div>
        <!-- You can add more order details here -->
    </div>
</body>
</html> 