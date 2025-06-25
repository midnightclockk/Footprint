<?php
session_start();
// khalti-response.php
// See: https://docs.khalti.com/
// LIVE ENVIRONMENT: Using live secret key and live endpoint

if (!isset($_GET['pidx'])) {
    echo "Invalid response from Khalti.";
    exit;
}

$pidx = $_GET['pidx'];
$secret_key = "caec814fc85844b4b672d0eac1dfb8fd"; // Your new live secret key

// Verify payment with Khalti (see docs)
$verify_url = "https://a.khalti.com/api/v2/epayment/lookup/";
$data = ["pidx" => $pidx];

$curl = curl_init();
curl_setopt_array($curl, [
    CURLOPT_URL => $verify_url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => http_build_query($data),
    CURLOPT_HTTPHEADER => [
        "Authorization: Key $secret_key"
    ]
]);
$response = curl_exec($curl);
curl_close($curl);

$result = json_decode($response, true);

if (isset($result['status']) && $result['status'] === 'Completed') {
    // --- Save order to DB if not already saved ---
    require_once 'includes/config.php';
    $order_number = isset($_SESSION['last_order_number']) ? $_SESSION['last_order_number'] : '';
    $user_id = isset($_SESSION['id']) ? $_SESSION['id'] : 0;
    $total_amount = isset($_SESSION['cart_total']) ? $_SESSION['cart_total'] : 0;
    $order_exists = false;
    $check = mysqli_query($con, "SELECT id FROM orders WHERE orderNumber='".mysqli_real_escape_string($con, $order_number)."'");
    if ($check && mysqli_num_rows($check) > 0) {
        $order_exists = true;
    }
    if (!$order_exists && !empty($_SESSION['cart']) && $user_id) {
        // Insert order
        $now = date('Y-m-d H:i:s');
        $insert_order = mysqli_query($con, "INSERT INTO orders (orderNumber, userId, orderDate, totalAmount, paymentMethod, orderStatus) VALUES ('".mysqli_real_escape_string($con, $order_number)."', '".intval($user_id)."', '$now', '".floatval($total_amount)."', 'Khalti', 'Paid')");
        $order_id = mysqli_insert_id($con);
        // Insert order items
        foreach ($_SESSION['cart'] as $pid => $item) {
            $qty = intval($item['quantity']);
            $price = floatval($item['price']);
            mysqli_query($con, "INSERT INTO order_items (order_id, productId, quantity, price) VALUES ('".mysqli_real_escape_string($con, $order_number)."', '".intval($pid)."', '$qty', '$price')");
        }
        // Clear cart
        unset($_SESSION['cart']);
        unset($_SESSION['cart_total']);
    }
    // Payment successful: show styled success card
    echo '<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">';
    echo '<title>Payment Success</title>';
    echo '<style>
        body { background: #f4f6f8; font-family: Arial, sans-serif; margin: 0; padding: 0; display: flex; align-items: center; justify-content: center; min-height: 100vh; }
        .card-success { max-width: 400px; margin: 0; background: #fff; border-radius: 16px; box-shadow: 0 4px 24px rgba(0,0,0,0.07); padding: 40px 30px; text-align: center; border-top: 10px solid #2ecc71; }
        .success-icon { background: #2ecc71; width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 18px; }
        .success-icon svg { width: 36px; height: 36px; color: #fff; }
        .success-title { color: #2ecc71; font-size: 2rem; font-weight: bold; margin-bottom: 10px; }
        .success-msg { color: #444; font-size: 1.1rem; margin-bottom: 30px; }
        .btn-row { display: flex; gap: 12px; justify-content: center; }
        .btn-success, .btn-receipt { background: #2ecc71; color: #fff; border: none; padding: 12px 22px; border-radius: 6px; font-size: 1rem; font-weight: 500; text-decoration: none; transition: background 0.2s; cursor: pointer; }
        .btn-success:hover, .btn-receipt:hover { background: #27ae60; }
    </style></head><body>';
    echo '<div class="card-success">';
    echo '<div class="success-icon"><svg fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" stroke="#fff" stroke-width="0"/><path d="M7 13l3 3 7-7" stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></svg></div>';
    echo '<div class="success-title">Success!</div>';
    echo '<div class="success-msg">We are delighted to inform you that we received your payment.</div>';
    echo '<div class="btn-row">';
    echo '<a href="index.php" class="btn-success">Continue Shopping</a>';
    $order_number = isset($_SESSION['last_order_number']) ? $_SESSION['last_order_number'] : '';
    echo '<a href="print-receipt.php?order_id=' . htmlspecialchars($order_number) . '" class="btn-receipt" target="_blank">Print Receipt</a>';
    echo '</div>';
    echo '</div></body></html>';
} else if (isset($result['status']) && strtolower($result['status']) === 'user canceled') {
    // User cancelled payment: show a friendly styled page
    echo '<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">';
    echo '<title>Payment Cancelled</title>';
    echo '<style>
        body { background: #fafbfc; font-family: Arial, sans-serif; margin: 0; padding: 0; display: flex; align-items: center; justify-content: center; min-height: 100vh; }
        .cancel-container { max-width: 600px; margin: 0; background: #fff; border-radius: 12px; box-shadow: 0 4px 24px rgba(0,0,0,0.07); padding: 40px 30px; text-align: center; }
        .cancel-title { color: #e74c3c; font-size: 2.5rem; font-weight: bold; margin-bottom: 10px; letter-spacing: 2px; }
        .cancel-sub { color: #444; font-size: 1.3rem; margin-bottom: 30px; }
        .cancel-illustration { margin-bottom: 30px; }
        .cancel-btn { display: inline-block; background: #12cca7; color: #fff; padding: 12px 32px; border-radius: 6px; text-decoration: none; font-size: 1.1rem; font-weight: 500; transition: background 0.2s; }
        .cancel-btn:hover { background: #0fa387; }
    </style></head><body>';
    echo '<div class="cancel-container">';
    echo '<div class="cancel-illustration">';
    echo '<svg width="120" height="120" viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="60" cy="60" r="56" fill="#fff3f3" stroke="#e74c3c" stroke-width="4"/><rect x="35" y="50" width="50" height="30" rx="6" fill="#e74c3c" fill-opacity="0.12" stroke="#e74c3c" stroke-width="2"/><line x1="40" y1="55" x2="80" y2="75" stroke="#e74c3c" stroke-width="3"/><line x1="80" y1="55" x2="40" y2="75" stroke="#e74c3c" stroke-width="3"/></svg>';
    echo '</div>';
    echo '<div class="cancel-title">PAYMENT CANCELLED</div>';
    echo '<div class="cancel-sub">You cancelled the payment. No money was deducted.</div>';
    echo '<a href="payment-method.php" class="cancel-btn">Go back to Payment Method</a>';
    echo '</div></body></html>';
} else {
    // Payment failed or pending (other reasons): show styled error card
    echo '<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">';
    echo '<title>Payment Error</title>';
    echo '<style>
        body { background: #f4f6f8; font-family: Arial, sans-serif; margin: 0; padding: 0; display: flex; align-items: center; justify-content: center; min-height: 100vh; }
        .card-error { max-width: 400px; margin: 0; background: #fff; border-radius: 16px; box-shadow: 0 4px 24px rgba(0,0,0,0.07); padding: 40px 30px; text-align: center; border-top: 10px solid #e74c3c; }
        .error-icon { background: #e74c3c; width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 18px; }
        .error-icon svg { width: 36px; height: 36px; color: #fff; }
        .error-title { color: #e74c3c; font-size: 2rem; font-weight: bold; margin-bottom: 10px; }
        .error-msg { color: #444; font-size: 1.1rem; margin-bottom: 30px; }
        .btn-row { display: flex; gap: 12px; justify-content: center; }
        .btn-success { background: #2ecc71; color: #fff; border: none; padding: 12px 22px; border-radius: 6px; font-size: 1rem; font-weight: 500; text-decoration: none; transition: background 0.2s; cursor: pointer; }
        .btn-success:hover { background: #27ae60; }
        .btn-error { background: #e74c3c; color: #fff; border: none; padding: 12px 22px; border-radius: 6px; font-size: 1rem; font-weight: 500; text-decoration: none; transition: background 0.2s; cursor: pointer; }
        .btn-error:hover { background: #c0392b; }
    </style></head><body>';
    echo '<div class="card-error">';
    echo '<div class="error-icon"><svg fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" stroke="#fff" stroke-width="0"/><path d="M15 9l-6 6M9 9l6 6" stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></svg></div>';
    echo '<div class="error-title">Error!</div>';
    echo '<div class="error-msg">Unfortunately we have an issue with your payment, try again later.</div>';
    echo '<div class="btn-row">';
    echo '<a href="index.php" class="btn-success">Continue Shopping</a>';
    echo '<a href="payment-method.php" class="btn-error">Try again</a>';
    echo '</div>';
    echo '</div></body></html>';
}
?> 