<?php
session_start();
include('includes/config.php');

// If coming from Buy Now button, set the buy_now session (only on GET)
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'set' && isset($_GET['id'])) {
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
    // Clear any previous address/payment session ONLY when coming from Buy Now button (GET)
    unset($_SESSION['buy_now_address']);
    unset($_SESSION['buy_now_payment']);
}

// Handle AJAX address save (for Update button)
if (isset($_POST['ajax']) && $_POST['ajax'] === 'save_address') {
    $_SESSION['buy_now_address'] = [
        'address' => $_POST['shipping_address'],
        'state' => $_POST['shipping_state'],
        'province' => $_POST['shipping_province'],
        'city' => $_POST['shipping_city'],
        'pincode' => $_POST['shipping_pincode'],
        'contact' => $_POST['contact_number']
    ];
    echo json_encode(['success' => true]);
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Save address and payment method in session
    $_SESSION['buy_now_address'] = [
        'address' => $_POST['shipping_address'],
        'state' => $_POST['shipping_state'],
        'province' => $_POST['shipping_province'],
        'city' => $_POST['shipping_city'],
        'pincode' => $_POST['shipping_pincode'],
        'contact' => $_POST['contact_number']
    ];
    $_SESSION['buy_now_payment'] = $_POST['payment_method'];
    // Redirect to the correct payment integration page
    $method = $_POST['payment_method'];
    if ($method === 'eSewa') {
        header('Location: esewa-request.php');
    } elseif ($method === 'Khalti') {
        header('Location: khalti-request.php');
    } else { // COD or fallback
        header('Location: payment-method.php');
    }
    exit;
}

// For select options (example data, replace with your actual data)
$provinces = ['Province 1', 'Province 2', 'Bagmati', 'Gandaki', 'Lumbini', 'Karnali', 'Sudurpashchim'];
$cities = ['Kathmandu', 'Pokhara', 'Biratnagar', 'Birgunj', 'Lalitpur', 'Bharatpur', 'Butwal'];
$buyNowProduct = $_SESSION['buy_now'] ?? null;
$buyNowAddress = $_SESSION['buy_now_address'] ?? null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buy Now - Shipping & Payment</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/red.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.css">
    <link rel="stylesheet" href="assets/css/lightbox.css">
    <!-- <link rel="stylesheet" href="css/styles.css"> -->
    <style>
        body { background: #f4f6f8; }
        .checkout-main { max-width: 1100px; margin: 40px auto; padding: 0 16px; }
        .product-summary-card {
            display: flex;
            align-items: center;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
            padding: 20px 32px;
            margin-bottom: 32px;
            gap: 24px;
        }
        .product-summary-card img {
            width: 80px; height: 80px; object-fit: cover; border-radius: 8px; border: 1px solid #eee;
        }
        .product-summary-details { flex: 1; }
        .product-summary-details h3 { margin: 0 0 6px 0; font-size: 20px; font-weight: 600; }
        .product-summary-details .price { font-size: 16px; color: #198754; font-weight: 600; }
        .product-summary-details .qty { font-size: 15px; color: #555; }
        .checkout-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
        }
        .checkout-form, .checkout-payment {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
            padding: 32px 28px;
        }
        .checkout-form h2, .checkout-payment h2 {
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 24px;
            color: #222;
        }
        .form-group { margin-bottom: 18px; }
        label { font-weight: 500; display: block; margin-bottom: 6px; }
        input, select { width: 100%; padding: 8px 10px; border: 1px solid #ccc; border-radius: 6px; font-size: 15px; }
        .payment-methods { margin-top: 10px; }
        .payment-option {
            display: flex;
            align-items: center;
            background: #fafbfc;
            border: 1.5px solid #eee;
            border-radius: 10px;
            padding: 18px 100px;
            margin-bottom: 18px;
            cursor: pointer;
            transition: box-shadow 0.2s, border-color 0.2s, background 0.2s;
            font-size: 20px;
        }
        .payment-option input[type="radio"] {
            margin-right: -110px;
            accent-color: #198754;
            transform: scale(1.2);
        }
        .payment-option img {
            height: 40px;
            margin-right: 0;
        }
        .payment-option img[src*='eSewa'] {
            height: 80px;
        }
        .payment-option img[src*='Khalti'] {
            height: 60px;
        }
        .payment-option.selected, .payment-option:hover {
            background: #e6f7ee;
            border-color: #198754;
            box-shadow: 0 2px 8px rgba(25,135,84,0.08);
        }
        .submit-btn { background: #198754; color: #fff; border: none; padding: 12px 32px; border-radius: 8px; font-size: 16px; font-weight: 600; cursor: pointer; margin-top: 20px; width: 100%; }
        .submit-btn:hover { background: #145c32; }
        @media (max-width: 900px) {
            .checkout-grid { grid-template-columns: 1fr; gap: 24px; }
        }
        @media (max-width: 600px) {
            .checkout-form, .checkout-payment, .product-summary-card { padding: 16px 8px; }
            .product-summary-card img { width: 60px; height: 60px; }
            .payment-option img { height: 28px; }
            .payment-option { font-size: 15px; padding: 12px 8px; }
        }
        input[type=radio], input[type=checkbox] {
            margin: 0px -170px 0px;
            margin-top: 1px \9;
            line-height: normal;
        }
    </style>
</head>
<body class="cnt-home">

<!-- ============================================== HEADER ============================================== -->
<header class="header-style-1">
<?php include('includes/top-header.php');?>
<?php include('includes/main-header.php');?>
<?php include('includes/menu-bar.php');?>
</header>
<!-- ============================================== HEADER : END ============================================== -->

<div class="checkout-main" style="padding-top: 32px; padding-bottom: 48px; min-height: 80vh; background: #f4f6f8;">
    <?php if ($buyNowProduct): ?>
    <div class="product-summary-card">
        <img src="<?php echo 'admin/productimages/' . $buyNowProduct['id'] . '/' . $buyNowProduct['image']; ?>" alt="<?php echo htmlspecialchars($buyNowProduct['name']); ?>">
        <div class="product-summary-details">
            <h3><?php echo htmlspecialchars($buyNowProduct['name']); ?></h3>
            <div class="price">Price: Rs. <?php echo (int)$buyNowProduct['price']; ?></div>
            <div class="qty">Quantity: <?php echo (int)$buyNowProduct['quantity']; ?></div>
        </div>
    </div>
    <?php endif; ?>
    <div class="checkout-grid">
        <form class="checkout-form" method="post" style="grid-column: 1 / span 2; display: grid; grid-template-columns: 1fr 1fr; gap: 40px; background: none; box-shadow: none; padding: 0;">
            <div class="checkout-form" style="background: #fff; box-shadow: 0 2px 12px rgba(0,0,0,0.06); border-radius: 12px; padding: 32px 28px;">
                <h2>Shipping Address</h2>
                <div id="address-warning" style="display:none; margin-bottom:16px; padding:10px 16px; border-radius:6px; font-size:15px;"></div>
                <div class="form-group">
                    <label for="shipping_address">Shipping Address*</label>
                    <input type="text" name="shipping_address" id="shipping_address" required value="<?php echo isset(
                        $buyNowAddress['address']) ? htmlspecialchars($buyNowAddress['address']) : ''; ?>">
                </div>
                <div class="form-group">
                    <label for="shipping_state">Shipping State*</label>
                    <input type="text" name="shipping_state" id="shipping_state" required value="<?php echo isset(
                        $buyNowAddress['state']) ? htmlspecialchars($buyNowAddress['state']) : ''; ?>">
                </div>
                <div class="form-group">
                    <label for="shipping_province">Select Province*</label>
                    <select name="shipping_province" id="shipping_province" required>
                        <option value="">Select Province</option>
                        <?php foreach ($provinces as $province): ?>
                            <option value="<?php echo htmlspecialchars($province); ?>" <?php echo (isset($buyNowAddress['province']) && $buyNowAddress['province'] === $province) ? 'selected' : ''; ?>><?php echo htmlspecialchars($province); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="shipping_city">Select City*</label>
                    <select name="shipping_city" id="shipping_city" required>
                        <option value="">Select City</option>
                        <?php foreach ($cities as $city): ?>
                            <option value="<?php echo htmlspecialchars($city); ?>" <?php echo (isset($buyNowAddress['city']) && $buyNowAddress['city'] === $city) ? 'selected' : ''; ?>><?php echo htmlspecialchars($city); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="shipping_pincode">Shipping Pincode*</label>
                    <input type="text" name="shipping_pincode" id="shipping_pincode" required value="<?php echo isset(
                        $buyNowAddress['pincode']) ? htmlspecialchars($buyNowAddress['pincode']) : ''; ?>">
                </div>
                <div class="form-group">
                    <label for="contact_number">Contact Number*</label>
                    <input type="text" name="contact_number" id="contact_number" required value="<?php echo isset(
                        $buyNowAddress['contact']) ? htmlspecialchars($buyNowAddress['contact']) : ''; ?>">
                </div>
                <button type="button" class="submit-btn" id="update-address-btn" autocomplete="off">Update</button>
            </div>
            <div class="checkout-payment" style="background: #fff; box-shadow: 0 2px 12px rgba(0,0,0,0.06); border-radius: 12px; padding: 32px 28px;">
                <h2>Choose Payment Method</h2>
                <div class="payment-methods">
                    <label class="payment-option">
                        <input type="radio" name="payment_method" value="eSewa" required>
                        <img src="assets/payment/eSewa.png" alt="eSewa"> eSewa
                    </label>
                    <label class="payment-option">
                        <input type="radio" name="payment_method" value="Khalti" required>
                        <img src="assets/payment/Khalti.png" alt="Khalti"> Khalti
                    </label>
                    <label class="payment-option">
                        <input type="radio" name="payment_method" value="COD" required>
                        <img src="assets/payment/COD.png" alt="Cash on Delivery"> Cash on Delivery (COD)
                    </label>
                </div>
                <button type="submit" class="submit-btn" style="margin-top: 24px;">Proceed</button>
            </div>
        </form>
    </div>
</div>
<?php include('includes/footer.php');?>

<script src="assets/js/jquery-1.11.1.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/bootstrap-hover-dropdown.min.js"></script>
<script src="assets/js/owl.carousel.min.js"></script>
<script src="assets/js/echo.min.js"></script>
<script src="assets/js/jquery.easing-1.3.min.js"></script>
<script src="assets/js/bootstrap-slider.min.js"></script>
<script src="assets/js/jquery.rateit.min.js"></script>
<script type="text/javascript" src="assets/js/lightbox.min.js"></script>
<script src="assets/js/bootstrap-select.min.js"></script>
<script src="assets/js/wow.min.js"></script>
<script src="assets/js/scripts.js"></script>

<script>
// Highlight selected payment option
const paymentOptions = document.querySelectorAll('.payment-option');
paymentOptions.forEach(option => {
    option.addEventListener('click', function() {
        paymentOptions.forEach(opt => opt.classList.remove('selected'));
        this.classList.add('selected');
        this.querySelector('input[type="radio"]').checked = true;
    });
    // Pre-select if checked on load
    if(option.querySelector('input[type="radio"]').checked) {
        option.classList.add('selected');
    }
});
// Update button (address only, no submit)
document.getElementById('update-address-btn').addEventListener('click', function(e) {
    const address = document.getElementById('shipping_address').value.trim();
    const state = document.getElementById('shipping_state').value.trim();
    const province = document.getElementById('shipping_province').value.trim();
    const city = document.getElementById('shipping_city').value.trim();
    const pincode = document.getElementById('shipping_pincode').value.trim();
    const contact = document.getElementById('contact_number').value.trim();
    const warningDiv = document.getElementById('address-warning');
    if (!address || !state || !province || !city || !pincode || !contact) {
        warningDiv.style.display = 'block';
        warningDiv.style.background = '#fff3cd';
        warningDiv.style.color = '#856404';
        warningDiv.style.border = '1px solid #ffeeba';
        warningDiv.textContent = 'Please fill out all required address fields.';
    } else {
        // Save address via AJAX
        fetch(window.location.pathname, {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams({
                ajax: 'save_address',
                shipping_address: address,
                shipping_state: state,
                shipping_province: province,
                shipping_city: city,
                shipping_pincode: pincode,
                contact_number: contact
            })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                warningDiv.style.display = 'block';
                warningDiv.style.background = '#d4edda';
                warningDiv.style.color = '#155724';
                warningDiv.style.border = '1px solid #c3e6cb';
                warningDiv.textContent = 'Address saved!';
            } else {
                warningDiv.style.display = 'block';
                warningDiv.style.background = '#fff3cd';
                warningDiv.style.color = '#856404';
                warningDiv.style.border = '1px solid #ffeeba';
                warningDiv.textContent = 'Failed to save address.';
            }
        })
        .catch(() => {
            warningDiv.style.display = 'block';
            warningDiv.style.background = '#fff3cd';
            warningDiv.style.color = '#856404';
            warningDiv.style.border = '1px solid #ffeeba';
            warningDiv.textContent = 'Failed to save address.';
        });
    }
});
</script>

</body>
</html> 