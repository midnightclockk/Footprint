<?php
require_once '../includes/config.php';

$order = null;
$message = '';

// Handle form submission for update
if (isset($_POST['update_order'])) {
    $orderNumber = $_POST['orderNumber'];
    $status = $_POST['status'];
    $tracking = $_POST['tracking_number'];
    $sql = "UPDATE orders SET status=?, tracking_number=? WHERE orderNumber=?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, 'sss', $status, $tracking, $orderNumber);
    if (mysqli_stmt_execute($stmt)) {
        $message = 'Order updated successfully!';
    } else {
        $message = 'Failed to update order.';
    }
}

// Fetch order details if order number is provided
if (isset($_GET['orderNumber']) || isset($_POST['orderNumber'])) {
    $orderNumber = isset($_GET['orderNumber']) ? $_GET['orderNumber'] : $_POST['orderNumber'];
    $sql = "SELECT * FROM orders WHERE orderNumber=?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, 's', $orderNumber);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $order = mysqli_fetch_assoc($result);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Order - Admin</title>
    <style>
        body { font-family: Arial, sans-serif; background: #faf7f5; padding: 40px; }
        .edit-card { max-width: 500px; margin: 60px auto; background: #fff; border-radius: 16px; box-shadow: 0 4px 24px rgba(0,0,0,0.04); padding: 40px; }
        h2 { text-align: center; margin-bottom: 24px; }
        .form-group { margin-bottom: 16px; }
        label { display: block; margin-bottom: 6px; color: #333; }
        input[type=text], select { width: 100%; padding: 8px; border-radius: 6px; border: 1px solid #ccc; }
        .btn { background: #198754; color: #fff; border: none; padding: 10px 24px; border-radius: 6px; cursor: pointer; font-weight: bold; }
        .btn:hover { background: #145c32; }
        .message { text-align: center; color: #198754; margin-bottom: 16px; }
    </style>
</head>
<body>
    <div class="edit-card">
        <h2>Edit Order</h2>
        <?php if ($message) echo '<div class="message">' . htmlspecialchars($message) . '</div>'; ?>
        <form method="get" style="margin-bottom: 24px;">
            <div class="form-group">
                <label for="orderNumber">Order Number</label>
                <input type="text" name="orderNumber" id="orderNumber" value="<?php echo isset($orderNumber) ? htmlspecialchars($orderNumber) : ''; ?>" required>
            </div>
            <button type="submit" class="btn">Fetch Order</button>
        </form>
        <?php if ($order): ?>
        <form method="post">
            <input type="hidden" name="orderNumber" value="<?php echo htmlspecialchars($order['orderNumber']); ?>">
            <div class="form-group">
                <label>Status</label>
                <select name="status" required>
                    <?php
                    $statuses = ['Pending', 'Processing', 'Shipped', 'Delivered', 'Cancelled'];
                    foreach ($statuses as $status) {
                        $selected = ($order['status'] == $status) ? 'selected' : '';
                        echo "<option value='$status' $selected>$status</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label>Tracking Number</label>
                <input type="text" name="tracking_number" value="<?php echo htmlspecialchars($order['tracking_number'] ?? ''); ?>">
            </div>
            <button type="submit" name="update_order" class="btn">Update Order</button>
        </form>
        <?php elseif (isset($orderNumber)): ?>
            <div style="color: red; text-align: center;">Order not found.</div>
        <?php endif; ?>
    </div>
</body>
</html> 