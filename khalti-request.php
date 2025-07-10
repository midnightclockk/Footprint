<?php
// khalti-request.php
// See: https://docs.khalti.com/
// LIVE ENVIRONMENT: Using live secret key and live endpoint

session_start();

// 1. Get order/cart info (robust handling)
$amount = 0;
if (!empty($_SESSION['buy_now'])) {
    $buyNowProduct = $_SESSION['buy_now'];
    $amount = (int)($buyNowProduct['quantity'] * $buyNowProduct['price'] * 100); // paisa
} elseif (!empty($_SESSION['cart'])) {
    $cart_total = 0;
    foreach ($_SESSION['cart'] as $id => $item) {
        $cart_total += $item['quantity'] * $item['price'];
    }
    $amount = (int)($cart_total * 100); // paisa
} else {
    $cart_total_raw = isset($_SESSION['cart_total']) ? $_SESSION['cart_total'] : 0;
    $cart_total_clean = str_replace(',', '', $cart_total_raw); // Remove commas if present
    $cart_total = is_numeric($cart_total_clean) ? (float)$cart_total_clean : 0;
    $amount = (int)($cart_total * 100); // paisa
}
$order_id = uniqid('order_'); // Or use your actual order ID
$_SESSION['last_order_number'] = $order_id;

// Debug output for troubleshooting
// Remove or comment out after confirming correct value
// echo "<pre>DEBUG: cart_total_raw = "; var_dump($cart_total_raw); echo "\nDEBUG: cart_total_clean = "; var_dump($cart_total_clean); echo "\nDEBUG: amount (paisa) = "; var_dump($amount); echo "</pre>";

// Validation: Amount must be at least 100 paisa (Rs. 1)
if ($amount < 100) {
    echo '<meta http-equiv="refresh" content="5;url=payment-method.php">';
    echo '<div style="margin:40px auto;max-width:600px;padding:30px;border:2px solid #e74c3c;background:#fff3f3;border-radius:8px;text-align:center;">
            <h2 style="color:#e74c3c;">Order total must be at least Rs. 1 to use Khalti payment.</h2>
            <p>You will be redirected in 5 seconds...</p>
            <a href="payment-method.php" style="display:inline-block;margin-top:20px;padding:10px 20px;background:#12cca7;color:#fff;text-decoration:none;border-radius:5px;">Go back to Payment Method</a>
          </div>';
    exit;
}

// 2. Khalti config (live environment)
$khalti_url = "https://a.khalti.com/api/v2/epayment/initiate/"; // Live endpoint per docs
$return_url = "http://localhost/Footprint/khalti-response.php"; // Update if needed
$website_url = "http://localhost/Footprint/"; // Update if needed
$secret_key = "caec814fc85844b4b672d0eac1dfb8fd"; // Your new live secret key

// 3. Prepare payload (see docs)
$data = [
    "return_url" => $return_url,
    "website_url" => $website_url,
    "amount" => $amount,
    "purchase_order_id" => $order_id,
    "purchase_order_name" => "FootPrint Order",
    "customer_info" => [
        "name" => $_SESSION['user_name'] ?? "Guest",
        "email" => $_SESSION['user_email'] ?? "guest@example.com",
        "phone" => $_SESSION['user_phone'] ?? "9800000000"
    ]
];

// 4. Initiate cURL request to Khalti (see docs)
$curl = curl_init();
curl_setopt_array($curl, [
    CURLOPT_URL => $khalti_url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => json_encode($data),
    CURLOPT_HTTPHEADER => [
        "Authorization: Key $secret_key",
        "Content-Type: application/json"
    ]
]);
$response = curl_exec($curl);
curl_close($curl);

$result = json_decode($response, true);

if (isset($result['payment_url'])) {
    // 5. Redirect to Khalti payment page
    header("Location: " . $result['payment_url']);
    exit;
} else {
    // 6. Handle error
    echo "Khalti Payment Error: ";
    print_r($result);
    echo '<br><a href="payment-method.php">Go back to Payment Method</a>';
}
?> 