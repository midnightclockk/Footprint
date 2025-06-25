<?php 
session_start();
error_reporting(0);
include('includes/config.php');

if(isset($_POST['submit'])){
	if(!empty($_SESSION['cart'])){
		foreach($_POST['quantity'] as $key => $val){
			if($val==0){
				unset($_SESSION['cart'][$key]);
			}else{
				$_SESSION['cart'][$key]['quantity']=$val;
			}
		}
		echo "<script>alert('Your Cart has been Updated');</script>";
		echo "<script>document.location = 'my-cart.php';</script>";
	}
}

// Code for Remove a Product from Cart
if(isset($_POST['remove_code']))
	{

if(!empty($_SESSION['cart'])){
		foreach($_POST['remove_code'] as $key){
			
				unset($_SESSION['cart'][$key]);
		}
			echo "<script>alert('Your Cart has been Updated');</script>";
	}
}
// code for insert product in order table


if(isset($_POST['ordersubmit'])) 
{
	
if(strlen($_SESSION['login'])==0)
    {   
header('location:login.php');
}
else{
	foreach($_SESSION['cart'] as $pid => $item){
		mysqli_query($con,"insert into orders(userId,productId,quantity) values('".$_SESSION['id']."','".$pid."','".$item['quantity']."')");
	}
	header('location:payment-method.php');
	exit;
}
}

// code for billing address updation
	if(isset($_POST['update']))
	{
		$baddress=$_POST['billingaddress'];
		$bstate=$_POST['bilingstate'];
		$bcity=$_POST['billingcity'];
		$bpincode=$_POST['billingpincode'];
		$query=mysqli_query($con,"update users set billingAddress='$baddress',billingState='$bstate',billingCity='$bcity',billingPincode='$bpincode' where id='".$_SESSION['id']."'");
		if($query)
		{
			echo "<script>alert('Billing Address has been updated');document.location = 'my-cart.php';</script>";
			exit;
		}
	}


// code for Shipping address updation
	if(isset($_POST['shipupdate']))
	{
		$saddress=$_POST['shippingaddress'];
		$sstate=$_POST['shippingstate'];
		$scity=$_POST['shippingcity'];
		$spincode=$_POST['shippingpincode'];
		$query=mysqli_query($con,"update users set shippingAddress='$saddress',shippingState='$sstate',shippingCity='$scity',shippingPincode='$spincode' where id='".$_SESSION['id']."'");
		if($query)
		{
			echo "<script>alert('Shipping Address has been updated');document.location = 'my-cart.php';</script>";
			exit;
		}
	}

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Meta -->
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<meta name="description" content="">
		<meta name="author" content="">
	    <meta name="keywords" content="MediaCenter, Template, eCommerce">
	    <meta name="robots" content="all">

	    <title>My Cart</title>
	    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
	    <link rel="stylesheet" href="assets/css/main.css">
	    <link rel="stylesheet" href="assets/css/red.css">
	    <link rel="stylesheet" href="assets/css/owl.carousel.css">
		<link rel="stylesheet" href="assets/css/owl.transitions.css">
		<!--<link rel="stylesheet" href="assets/css/owl.theme.css">-->
		<link href="assets/css/lightbox.css" rel="stylesheet">
		<link rel="stylesheet" href="assets/css/animate.min.css">
		<link rel="stylesheet" href="assets/css/rateit.css">
		<link rel="stylesheet" href="assets/css/bootstrap-select.min.css">

		<!-- Demo Purpose Only. Should be removed in production -->
		<link rel="stylesheet" href="assets/css/config.css">

		<link href="assets/css/green.css" rel="alternate stylesheet" title="Green color">
		<link href="assets/css/blue.css" rel="alternate stylesheet" title="Blue color">
		<link href="assets/css/red.css" rel="alternate stylesheet" title="Red color">
		<link href="assets/css/orange.css" rel="alternate stylesheet" title="Orange color">
		<link href="assets/css/dark-green.css" rel="alternate stylesheet" title="Darkgreen color">
		<!-- Demo Purpose Only. Should be removed in production : END -->

		
		<!-- Icons/Glyphs -->
		<link rel="stylesheet" href="assets/css/font-awesome.min.css">

        <!-- Fonts --> 
		<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
		
		<!-- Favicon -->
		<link rel="shortcut icon" href="assets/images/favicon.ico">

		<!-- HTML5 elements and media queries Support for IE8 : HTML5 shim and Respond.js -->
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->

		<style>
			.shopping-cart-table .table>tbody>tr>td {
				vertical-align: middle;
			}
			.cart-romove-item, .cart-image, .cart-product-quantity, .cart-product-sub-total, .cart-product-grand-total {
				text-align: center;
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
<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="index.php">Home</a></li>
				<li class='active'>Shopping Cart</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content outer-top-xs">
	<div class="container">
		<div class="row inner-bottom-sm">
			<div class="shopping-cart">
<?php if(!empty($_SESSION['cart'])): ?>
				<div class="col-md-12 col-sm-12 shopping-cart-table">
					<div class="table-responsive">
						<form name="cart" method="post">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th class="cart-romove item">Remove</th>
										<th class="cart-description item">Image</th>
										<th class="cart-product-name item">Product Name</th>
										<th class="cart-qty item">Quantity</th>
										<th class="cart-sub-total item">Price Per unit</th>
										<th class="cart-sub-total item">Shipping Charge</th>
										<th class="cart-total last-item">Grandtotal</th>
									</tr>
								</thead>
								<tfoot>
									<tr>
										<td colspan="7">
											<div class="shopping-cart-btn">
												<span class="">
													<a href="index.php" class="btn btn-upper btn-primary outer-left-xs">Continue Shopping</a>
													<button type="submit" name="submit" class="btn btn-upper btn-primary pull-right outer-right-xs">Update shopping cart</button>
												</span>
											</div>
										</td>
									</tr>
								</tfoot>
								<tbody>
									<?php
									$pdtid = array();
									$totalprice = 0;
									$totalqunty = 0;

									if (!empty($_SESSION['cart'])) {
										$productIds = array_keys($_SESSION['cart']);
										$sql = "SELECT * FROM products WHERE id IN (".implode(',', $productIds).")";
										$query = mysqli_query($con, $sql);
										
										$products = [];
										while($row = mysqli_fetch_assoc($query)){
											$products[$row['id']] = $row;
										}

										foreach ($_SESSION['cart'] as $productId => $cartItem) {
											$row = $products[$productId];
											$quantity = $cartItem['quantity'];
											$subtotal = ($quantity * $row['productPrice']) + $row['shippingCharge'];
											$totalprice += $subtotal;
											$totalqunty += $quantity;
											$pdtid[] = $row['id'];
									?>
									<tr>
										<td class="romove-item"><input type="checkbox" name="remove_code[]" value="<?php echo htmlentities($productId); ?>" /></td>
										<td class="cart-image">
											<a class="entry-thumbnail" href="product-details.php?pid=<?php echo htmlentities($row['id']); ?>">
												<img src="admin/productimages/<?php echo htmlentities($row['id']); ?>/<?php echo htmlentities($row['productImage1']); ?>" alt="" width="114" height="146">
											</a>
										</td>
										<td class="cart-product-name-info">
											<h4 class='cart-product-description'><a href="product-details.php?pid=<?php echo htmlentities($row['id']); ?>"><?php echo htmlentities($row['productName']); ?></a></h4>
											<div class="row">
												<div class="col-sm-4"><div class="rating rateit-small"></div></div>
												<div class="col-sm-8">
													<?php
													$rt = mysqli_query($con, "SELECT * FROM productreviews WHERE productId='" . $row['id'] . "'");
													if($rt && mysqli_num_rows($rt) > 0):
													?>
														<div class="reviews">(<?php echo htmlentities(mysqli_num_rows($rt)); ?> Reviews)</div>
													<?php endif; ?>
												</div>
											</div><!-- /.row -->
										</td>
										<td class="cart-product-quantity">
											<div class="quant-input">
												<div class="arrows">
													<div class="arrow plus gradient"><span class="ir"><i class="icon fa fa-sort-asc"></i></span></div>
													<div class="arrow minus gradient"><span class="ir"><i class="icon fa fa-sort-desc"></i></span></div>
												</div>
												<input type="text" value="<?php echo htmlentities($quantity); ?>" name="quantity[<?php echo htmlentities($productId); ?>]">
											</div>
										</td>
										<td class="cart-product-sub-total"><span class="cart-sub-total-price"><?php echo "Rs " . htmlentities($row['productPrice']); ?>.00</span></td>
										<td class="cart-product-sub-total"><span class="cart-sub-total-price"><?php echo "Rs " . htmlentities($row['shippingCharge']); ?>.00</span></td>
										<td class="cart-product-grand-total"><span class="cart-grand-total-price"><?php echo htmlentities($subtotal); ?>.00</span></td>
									</tr>
									<?php
										}
									}
									$_SESSION['qnty'] = $totalqunty;
									$_SESSION['pid'] = $pdtid;
									$_SESSION['cart_total'] = $totalprice;
									?>
								</tbody>
							</table>
						
					</div>
				</div>
				<div class="col-md-4 col-sm-12 estimate-ship-tax">
					<table class="table table-bordered">
						<thead>
							<tr><th><span class="estimate-title">Shipping Address</span></th></tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<?php
									$query=mysqli_query($con,"select * from users where id='".$_SESSION['id']."'");
									while($row=mysqli_fetch_array($query)):
									?>
									<div class="form-group">
										<label class="info-title" for="Shipping Address">Shipping Address<span>*</span></label>
										<textarea class="form-control unicase-form-control text-input" name="shippingaddress" required="required"><?php echo $row['shippingAddress']; ?></textarea>
									</div>
									<div class="form-group">
										<label class="info-title" for="Shipping State ">Shipping State  <span>*</span></label>
										<select class="form-control unicase-form-control text-input" id="shippingstate" name="shippingstate" required>
											<option value="">Select Province</option>
											<?php
											$provinces = [
												'Province No. 1',
												'Madhesh Province',
												'Bagmati Province',
												'Gandaki Province',
												'Lumbini Province',
												'Karnali Province',
												'Sudurpashchim Province'
											];
											foreach ($provinces as $province) {
												$selected = ($row['shippingState'] == $province) ? 'selected' : '';
												echo "<option value=\"$province\" $selected>$province</option>";
											}
											?>
										</select>
									</div>
									<div class="form-group">
										<label class="info-title" for="Shipping City">Shipping City <span>*</span></label>
										<select class="form-control unicase-form-control text-input" id="shippingcity" name="shippingcity" required>
											<option value="">Select City</option>
											<?php
											$cities = ['Kathmandu', 'Pokhara', 'Lalitpur', 'Biratnagar', 'Birgunj', 'Dharan', 'Bharatpur', 'Janakpur', 'Butwal', 'Hetauda'];
											foreach ($cities as $city) {
												$selected = ($row['shippingCity'] == $city) ? 'selected' : '';
												echo "<option value=\"$city\" $selected>$city</option>";
											}
											?>
										</select>
									</div>
									<div class="form-group">
										<label class="info-title" for="Shipping Pincode">Shipping Pincode <span>*</span></label>
										<input type="text" class="form-control unicase-form-control text-input" id="shippingpincode" name="shippingpincode" required="required" value="<?php echo $row['shippingPincode']; ?>" >
									</div>
									<button type="submit" name="shipupdate" class="btn-upper btn btn-primary checkout-page-button">Update</button>
									<?php endwhile; ?>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="col-md-4 col-sm-12 cart-shopping-total">
					<table class="table table-bordered">
						<thead>
							<tr><th><div class="cart-grand-total">Grand Total :<span class="inner-left-md"><?php echo "Rs " . $totalprice; ?>.00</span></div></th></tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<div class="cart-checkout-btn pull-right">
										<button type="submit" name="ordersubmit" class="btn btn-primary">PROCEED TO CHECKOUT</button>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				</form>
<?php else: ?>
				<div class="row">
					<div class="col-md-12">
						<h3>Your shopping Cart is empty</h3>
						<a href="index.php" class="btn btn-upper btn-primary outer-left-xs">Continue Shopping</a>
					</div>
				</div>
<?php endif; ?>
			</div>
		</div>
		<?php include('includes/brands-slider.php');?>
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

	<!-- For demo purposes – can be removed on production -->
	
	<script src="switchstylesheet/switchstylesheet.js"></script>
	
	<script>
		$(document).ready(function(){ 
			$(".changecolor").switchstylesheet( { seperator:"color"} );
			$('.show-theme-options').click(function(){
				$(this).parent().toggleClass('open');
				return false;
			});
		});

		$(window).bind("load", function() {
		   $('.show-theme-options').delay(2000).trigger('click');
		});
	</script>
	<!-- For demo purposes – can be removed on production : End -->
</body>
</html>