<?php
session_start();
include_once('includes/config.php');
if(strlen($_SESSION["alogin"])==0) {
    header('location:logout.php');
    exit();
}
date_default_timezone_set('Asia/Kathmandu');
$orderid = isset($_GET['oid']) ? intval($_GET['oid']) : (isset($_GET['orderid']) ? intval($_GET['orderid']) : 0);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_status'])) {
    $new_status = mysqli_real_escape_string($con, $_POST['order_status']);
    $remark = mysqli_real_escape_string($con, $_POST['remark']);

    mysqli_query($con, "UPDATE orders SET orderStatus='$new_status' WHERE id='$orderid'");

    mysqli_query($con, "INSERT INTO ordertrackhistory (orderId, status, remark) VALUES ('$orderid', '$new_status', '$remark')");
    header("Location: order-details.php?oid=$orderid&success=1");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>FootPrint | Order Details</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">
<?php include_once('includes/header.php'); ?>
<div id="layoutSidenav">
    <?php include_once('includes/sidebar.php'); ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4 mb-3">Order Details</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="todays-orders.php">Today's Orders</a></li>
                    <li class="breadcrumb-item active">Order Details</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <span><i class="fas fa-info-circle me-1"></i> Order Details</span>
							</div>
                    <div class="card-body">
<?php 
                        $query = mysqli_query($con, "SELECT orders.id as oid, orders.orderNumber, users.name as username, users.email as useremail, users.contactno as usercontact, users.shippingAddress as shippingaddress, users.shippingCity as shippingcity, users.shippingState as shippingstate, users.shippingPincode as shippingpincode, users.billingAddress, users.billingState, users.billingCity, users.billingPincode, products.productName as productname, products.shippingCharge as shippingcharge, orders.quantity as quantity, orders.orderDate as orderdate, products.productPrice as productprice, products.id as pid, products.productImage1, orders.paymentMethod FROM orders LEFT JOIN users ON orders.userId=users.id LEFT JOIN products ON products.id=orders.productId WHERE orders.id='$orderid'");
                        if($row = mysqli_fetch_array($query)) {
                        ?>
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <table class="table table-bordered">
                                    <tr><th>Order ID</th><td><?php echo htmlentities($row['oid']); ?></td></tr>
                                    <tr><th>Order Number</th><td><?php echo htmlentities($row['orderNumber']); ?></td></tr>
                                    <tr><th>Order Date</th><td><?php echo htmlentities($row['orderdate']); ?></td></tr>
                                    <tr><th>Username</th><td><?php echo htmlentities($row['username']); ?></td></tr>
                                    <tr><th>Email</th><td><?php echo htmlentities($row['useremail']); ?></td></tr>
                                    <tr><th>Contact No</th><td><?php echo htmlentities($row['usercontact']); ?></td></tr>
                                    <tr><th>Shipping Address</th><td><?php echo htmlentities($row['shippingaddress'].", ".$row['shippingcity'].", ".$row['shippingstate']." - ".$row['shippingpincode']); ?></td></tr>
                                    <tr><th>Billing Address</th><td><?php echo htmlentities($row['billingAddress'].", ".$row['billingCity'].", ".$row['billingState']." - ".$row['billingPincode']); ?></td></tr>
                                    <tr><th>Payment Mode</th><td><?php echo htmlentities($row['paymentMethod']); ?></td></tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-bordered">
                                    <tr><th>Order Number</th><td><?php echo htmlentities($row['orderNumber']); ?></td></tr>
                                    <tr><th>Product Name</th><td><?php echo htmlentities($row['productname']); ?></td></tr>
                                    <tr><th>Product Image</th><td><img src="productimages/<?php echo htmlentities($row['pid']."/".$row['productImage1']); ?>" width="120" class="img-thumbnail"></td></tr>
                                    <tr><th>Quantity</th><td><?php echo htmlentities($row['quantity']); ?></td></tr>
                                    <tr><th>Product Price</th><td><?php echo htmlentities($row['productprice']); ?></td></tr>
                                    <tr><th>Shipping Charge</th><td><?php echo htmlentities($row['shippingcharge']); ?></td></tr>
                                    <tr><th>Grand Total</th><td><strong><?php echo htmlentities($row['quantity']*$row['productprice']+$row['shippingcharge']); ?></strong></td></tr>
								</table>
                            </div>
                        </div>
<?php 
                        } else {
                            echo '<div class="alert alert-danger">Order not found.</div>';
                        }
                        ?>
                        <div class="card mt-4">
                            <div class="card-header"><i class="fas fa-history me-1"></i> Order History</div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-bordered mb-0">
                                        <thead class="table-light">
	<tr>
		<th>Remark</th>
		<th>Status</th>
		<th>Date</th>
	</tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $ret = mysqli_query($con, "SELECT * FROM ordertrackhistory WHERE orderId='$orderid'");
                                        $count = mysqli_num_rows($ret);
                                        if($count>0) {
                                            while($rowh = mysqli_fetch_array($ret)) {
                                        ?>
                                            <tr>
                                                <td><?php echo htmlentities($rowh['remark']); ?></td>
                                                <td><?php echo htmlentities($rowh['status']); ?></td>
                                                <td><?php echo htmlentities($rowh['postingDate']); ?></td>
    </tr>
                                        <?php } } else { ?>
                                            <tr><td colspan="3" class="text-center">No history found.</td></tr>
                                        <?php } ?>
                                        </tbody>
										</table>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                        <?php
                        if (isset($_GET['success']) && $_GET['success'] == '1') {
                            echo '<div class="alert alert-success mb-3">Order status updated successfully.</div>';
                        }
                        ?>
                        <form method="post" class="row g-2 align-items-end">
                            <div class="col-auto">
                                <select name="order_status" class="form-select" required>
                                    <option value="">Select Status</option>
                                    <option value="Packed">Packed</option>
                                    <option value="Dispatched">Dispatched</option>
                                    <option value="In Transit">In Transit</option>
                                    <option value="Out For Delivery">Out For Delivery</option>
                                    <option value="Delivered">Delivered</option>
                                </select>
                            </div>
                            <div class="col-auto">
                                <input type="text" name="remark" class="form-control" placeholder="Remark (optional)">
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary">Update Status</button>
                            </div>
                        </form>
                        </div>
							</div>
							</div>
						</div>						
        </main>
        <?php include_once('includes/footer.php'); ?>
    </div>
			</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
</body>
</html>