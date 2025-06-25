<?php
ob_start();
require_once 'includes/config.php';

$order_id = isset($_GET['order_id']) ? $_GET['order_id'] : '';
if (!$order_id) {
    echo '<h2 style="color:red;text-align:center;margin-top:40px;">Order ID missing.</h2>';
    exit;
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
$items_sql = "SELECT oi.*, p.productName, p.productCompany, p.productImage1, p.category, p.subCategory 
              FROM order_items oi 
              LEFT JOIN products p ON oi.productId = p.id 
              WHERE oi.orderId = '" . intval($order['id']) . "'";
$items_res = mysqli_query($con, $items_sql);
$items = [];
while ($row = mysqli_fetch_assoc($items_res)) {
    $items[] = $row;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Receipt - <?php echo htmlspecialchars($order_id); ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Playfair+Display:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body { 
            background: #faf7f5; 
            font-family: 'Inter', sans-serif; 
            margin: 0; 
            padding: 40px;
            color: #333;
            line-height: 1.5;
        }
        .receipt-card { 
            max-width: 1100px; 
            margin: 0 auto; 
            background: #fff; 
            border-radius: 24px; 
            box-shadow: 0 4px 24px rgba(0,0,0,0.04); 
            padding: 60px;
            display: grid;
            grid-template-columns: 1fr 520px;
            gap: 60px;
        }
        .left-column {
            padding-right: 40px;
        }
        .right-column {
            background: #f9f9f9;
            border-radius: 16px;
            padding: 32px;
        }
        .receipt-card .left-column h1 {
            font-size: 42px;
            font-weight: 700;
            margin: 0 0 24px 0;
            color: #2ecc71 !important;
            line-height: 1.2;
        }
        .message {
            color: #666;
            margin-bottom: 48px;
            font-size: 15px;
            line-height: 1.6;
        }
        .billing-section h2 {
            font-size: 16px;
            font-weight: 600;
            margin: 0 0 24px 0;
            color: #000;
        }
        .billing-grid {
            display: grid;
            gap: 16px;
            margin-bottom: 40px;
        }
        .billing-row {
            display: grid;
            grid-template-columns: 100px 1fr;
            gap: 16px;
            align-items: baseline;
        }
        .label {
            font-size: 14px;
            color: #000;
            font-weight: 500;
        }
        .value {
            font-size: 14px;
            color: #666;
        }
        .track-button {
            display: inline-block;
            background: rgb(255, 0, 0);
            color: white;
            padding: 16px 32px;
            border-radius: 100px;
            text-decoration: none;
            font-weight: 500;
            font-size: 15px;
            border: none;
            cursor: pointer;
            transition: background-color 0.2s;
            text-align: center;
            min-width: 180px;
            max-width: 100%;
            box-sizing: border-box;
        }
        .track-button:hover {
            background: #a80000;
            box-shadow: 0 2px 12px rgba(255,0,0,0.15);
            transform: scale(1.03);
        }
        .order-summary h2 {
            font-size: 20px;
            font-weight: 600;
            margin: 0 0 24px 0;
            color: #000;
        }
        .order-meta {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
            margin-bottom: 32px;
            padding-bottom: 32px;
            border-bottom: 1px solid #eee;
        }
        .meta-item {
            display: grid;
            gap: 8px;
        }
        .meta-label {
            font-size: 13px;
            color: #666;
        }
        .meta-value {
            font-size: 14px;
            color: #000;
            font-weight: 500;
        }
        .order-items {
            margin-bottom: 32px;
        }
        .order-item {
            display: grid;
            grid-template-columns: 64px 1fr auto;
            gap: 16px;
            padding: 16px 0;
            align-items: center;
        }
        .order-item:not(:last-child) {
            border-bottom: 1px solid #eee;
        }
        .item-image {
            width: 64px;
            height: 64px;
            border-radius: 8px;
            overflow: hidden;
        }
        .item-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .item-details h3 {
            margin: 0 0 4px 0;
            font-size: 14px;
            font-weight: 500;
            color: #000;
        }
        .item-details p {
            margin: 0;
            font-size: 13px;
            color: #666;
        }
        .item-price {
            font-size: 14px;
            font-weight: 500;
            color: #000;
        }
        .order-summary-footer {
            border-top: 1px solid #eee;
            padding-top: 24px;
        }
        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            font-size: 14px;
            color: #666;
        }
        .summary-row.total {
            margin-top: 16px;
            padding-top: 16px;
            border-top: 1px solid #eee;
            font-weight: 600;
            font-size: 16px;
            color: #000;
        }
        @media print {
            body { 
                background: #fff;
                padding: 0;
            }
            .receipt-card { 
                box-shadow: none; 
                margin: 0;
                padding: 20px;
            }
        }
        @media (max-width: 1000px) {
            .receipt-card {
                grid-template-columns: 1fr;
                gap: 40px;
                padding: 40px;
            }
            .left-column {
                padding-right: 0;
            }
        }
        @media (max-width: 600px) {
            body {
                padding: 20px;
            }
            .receipt-card {
                padding: 24px;
            }
            h1 {
                font-size: 32px;
                color: #198754;
            }
            .billing-row {
                grid-template-columns: 1fr;
                gap: 4px;
            }
            .track-button {
                width: 100%;
                font-size: 16px;
                padding: 14px 0;
                min-width: 0;
            }
        }
    </style>
</head>
<body>
    <div class="receipt-card">
        <div class="left-column">
            <h1>Payment Received!</h1>
            <div class="message">
                Your order will be processed within 24 hours during working days. We will notify you by email once your order has been shipped.
            </div>
            <div class="billing-section">
                <h2>Billing address</h2>
                <div class="billing-grid">
                    <div class="billing-row">
                        <div class="label">Name :</div>
                        <div class="value"><?php echo htmlspecialchars($user['name']); ?></div>
                    </div>
                    <div class="billing-row">
                        <div class="label">Address :</div>
                        <div class="value"><?php echo htmlspecialchars($user['shippingAddress']); ?></div>
                    </div>
                    <div class="billing-row">
                        <div class="label">Phone :</div>
                        <div class="value"><?php echo htmlspecialchars($user['contactno']); ?></div>
                    </div>
                    <div class="billing-row">
                        <div class="label">Email :</div>
                        <div class="value"><?php echo htmlspecialchars($user['email']); ?></div>
                    </div>
                </div>
                <a href="order-status.php?order_id=<?php echo urlencode($order['orderNumber']); ?>" class="track-button">Track your order</a>
                <div class="footer" style="text-align: center; margin-top: 50px;">
                    Thank you for shopping with 
                    <span style="font-family: 'Playfair Display', serif; color: black; font-weight: bold;">Foot</span><span style="font-family: 'Playfair Display', serif; color: red; font-weight: bold;">Print</span><span style="font-family: 'Playfair Display', serif; color: black; font-weight: bold;">!</span>
                </div>
            </div>
        </div>
        <div class="right-column">
            <!-- Store Details -->
            <div style="text-align:center; margin-bottom: 16px;">
                <div class="footer" style="text-align: center; margin-top: 10px;"> 
                    <span style="font-family: 'Playfair Display', serif; color: black; font-weight: bold; font-size: 30px;">Foot</span><span style="font-family: 'Playfair Display', serif; color: red; font-weight: bold; font-size: 30px;">Print</span>
                </div>
                <div style="font-size: 13px; color: #666;">Kathmandu, Nepal</div>
                <div style="font-size: 13px; color: #666;">Phone: 9810104786 | Email: imkashifk5@gmail.com</div>
                <div style="font-size: 13px; color: #666;">www.footprint.com</div>
            </div>
            <!-- Invoice Details -->
            <div style="margin-bottom: 16px; max-width: 100%;">
                <div style="display: grid; grid-template-columns: 170px 1fr; row-gap: 4px; column-gap: 8px; font-size: 13px; color: #666;">
                    <div>Invoice #</div>
                    <div>: <span style="color:#000; font-weight:500;"> <?php echo htmlspecialchars($order['orderNumber']); ?> </span></div>
                    <div>Date</div>
                    <div>: <span style="color:#000; font-weight:500;"> <?php echo date('d M Y', strtotime($order['orderDate'])); ?> </span></div>
                    <div>Time</div>
                    <div>: <span style="color:#000; font-weight:500;"> <?php echo date('H:i:s', strtotime($order['orderDate'])); ?> </span></div>
                </div>
                <hr style="border: none; border-top: 1px solid #eee; margin: 10px 0;">
                <div style="display: grid; grid-template-columns: 170px 1fr; row-gap: 4px; column-gap: 8px; font-size: 13px; color: #666;">
                    <div>Customer</div>
                    <div>: <span style="color:#000; font-weight:500;"> <?php echo htmlspecialchars($user['name']); ?> </span></div>
                    <div>Phone</div>
                    <div>: <span style="color:#000; font-weight:500;"> <?php echo htmlspecialchars($user['contactno']); ?> </span></div>
                    <div>Email</div>
                    <div>: <span style="color:#000; font-weight:500;"> <?php echo htmlspecialchars($user['email']); ?> </span></div>
                    <div>Delivery Location</div>
                    <div>: <span style="color:#000; font-weight:500;"> <?php echo htmlspecialchars($user['shippingAddress']); ?> </span></div>
                    <div>Payment Method</div>
                    <div>: <span style="color:#000; font-weight:500;"> <?php echo htmlspecialchars($order['paymentMethod']); ?> </span></div>
                </div>
            </div>
            <!-- Product Details Table with Images -->
            <div style="overflow-x:auto; margin-bottom: 16px;">
                <?php $subtotal = 0; ?>
                <table style="width:100%; border-collapse:collapse; font-size:13px;">
                    <thead>
                        <tr style="background:#f3f3f3;">
                            <th style="padding:6px; border:1px solid #eee;">Image</th>
                            <th style="padding:6px; border:1px solid #eee;">Product</th>
                            <th style="padding:6px; border:1px solid #eee;">Size</th>
                            <th style="padding:6px; border:1px solid #eee;">Qty</th>
                            <th style="padding:6px; border:1px solid #eee;">Unit Price</th>
                            <th style="padding:6px; border:1px solid #eee;">Discount</th>
                            <th style="padding:6px; border:1px solid #eee;">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($items as $item): ?>
                        <?php $subtotal += ($item['price'] * $item['quantity']) - (isset($item['discount']) ? $item['discount'] : 0); ?>
                        <tr>
                            <td style="padding:6px; border:1px solid #eee; text-align:center;">
                                <?php 
                                    $brandMap = [ '3' => 'Nike' ];
                                    $categoryMap = [ '15' => 'Air Jordan 1', '16' => 'Dunk' ];
                                    $brand = $brandMap[$item['category']] ?? $item['category'];
                                    $category = $categoryMap[$item['subCategory']] ?? $item['subCategory'];
                                    $encodedPath = implode('/', [ rawurlencode($brand), rawurlencode($category), $item['productImage1'] ]);
                                    $imagePath = "/Footprint/productimages/" . $encodedPath;
                                ?>
                                <img src="<?php echo $imagePath; ?>" alt="<?php echo htmlspecialchars($item['productName']); ?>" style="width:48px; height:48px; object-fit:cover; border-radius:6px;">
                            </td>
                            <td style="padding:6px; border:1px solid #eee;"> <?php echo htmlspecialchars($item['productName']); ?> </td>
                            <td style="padding:6px; border:1px solid #eee;"> <?php echo isset($item['size']) ? htmlspecialchars($item['size']) : '-'; ?> </td>
                            <td style="padding:6px; border:1px solid #eee; text-align:center;"> <?php echo htmlspecialchars($item['quantity']); ?> </td>
                            <td style="padding:6px; border:1px solid #eee;"> Rs.<?php echo (int)$item['price']; ?> </td>
                            <td style="padding:6px; border:1px solid #eee;"> Rs.<?php echo isset($item['discount']) ? (int)$item['discount'] : '0'; ?> </td>
                            <td style="padding:6px; border:1px solid #eee; font-weight:500; color:#000;"> Rs.<?php echo (int)(($item['price'] * $item['quantity']) - (isset($item['discount']) ? $item['discount'] : 0)); ?> </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- Order Total Section -->
            <div style="margin: 16px 0; font-size: 15px; font-weight: 600;">
                <div>Total Amount Payable: <span style="color:#000;">Rs.<?php echo (int)$subtotal; ?></span></div>
                <div>Payment Mode: <span style="color:#000;"> <?php echo htmlspecialchars($order['paymentMethod']); ?> </span></div>
            </div>
            <!-- Additional Info -->
            <div style="font-size:12px; color:#666; border-top:1px solid #eee; padding-top:10px; margin-bottom: 24px; text-align: center;">
                <div>Returns accepted within 7 days with original packaging.</div>
                <div class="footer" style="text-align: center; margin-top: 0px;">
                    Thank you for shopping with 
                    <span style="font-family: 'Playfair Display', serif; color: black; font-weight: bold;">Foot</span><span style="font-family: 'Playfair Display', serif; color: red; font-weight: bold;">Print</span><span style="font-family: 'Playfair Display', serif; color: black; font-weight: bold;">!</span>
                </div>
                <div style="display: inline-block; margin-top: 12px; border: 2px solid #c00; border-radius: 12px; padding: 8px 32px; color: #c00; font-size: 15px; font-family: 'Playfair Display', serif; font-weight: bold; background: #fff0f0; box-shadow: 0 2px 8px rgba(200,0,0,0.08); letter-spacing: 2px; text-transform: uppercase;">FootPrint Authorized</div>
            </div>
        </div>
    </div>
</body>
</html>
<?php ob_end_flush(); ?> 