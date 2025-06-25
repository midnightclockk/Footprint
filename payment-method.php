<?php 
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
    {   
header('location:login.php');
}
else{
	if (isset($_POST['submit'])) {

		mysqli_query($con,"update orders set 	paymentMethod='".$_POST['paymethod']."' where userId='".$_SESSION['id']."' and paymentMethod is null ");
		unset($_SESSION['cart']);
		header('location:order-history.php');

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

	    <title>FootPrint | Payment Method</title>
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
		<link rel="stylesheet" href="assets/css/config.css">
		<link href="assets/css/green.css" rel="alternate stylesheet" title="Green color">
		<link href="assets/css/blue.css" rel="alternate stylesheet" title="Blue color">
		<link href="assets/css/red.css" rel="alternate stylesheet" title="Red color">
		<link href="assets/css/orange.css" rel="alternate stylesheet" title="Orange color">
		<link href="assets/css/dark-green.css" rel="alternate stylesheet" title="Darkgreen color">
		<link rel="stylesheet" href="assets/css/font-awesome.min.css">
		<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
		<link rel="shortcut icon" href="assets/images/favicon.ico">
		<style>
			.payment-method-option {
				display: flex;
				align-items: center;
				padding: 20px;
				border: 1px solid #eee;
				border-radius: 5px;
				margin-bottom: 15px;
				cursor: pointer;
				transition: all 0.2s ease-in-out;
			}
			.payment-method-option:hover, .payment-method-option.selected {
				background-color: #f5f5f5;
				border-color: #12cca7;
				transform: translateY(-3px);
				box-shadow: 0 4px 12px rgba(0,0,0,0.1);
			}
			.payment-method-option input[type="radio"] {
				margin-right: 15px;
			}
			.payment-method-option img {
				height: 50px;
				margin-right: 20px;
			}
			.payment-method-option label {
				margin: 0;
				font-size: 18px;
				font-weight: 500;
			}
			#esewa-logo {
				height: 80px;
			}
		</style>
	</head>
    <body class="cnt-home">
	
		
<header class="header-style-1">
<?php include('includes/top-header.php');?>
<?php include('includes/main-header.php');?>
<?php include('includes/menu-bar.php');?>
</header>
<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="index.php">Home</a></li>
				<li><a href="my-cart.php">Cart</a></li>
				<li class='active'>Payment Method</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content outer-top-bd">
	<div class="container">
		<div class="checkout-box faq-page inner-bottom-sm">
			<div class="row">
				<div class="col-md-12">
					<h2>Choose Payment Method</h2>
					<div class="panel-group checkout-steps" id="accordion">
						<!-- checkout-step-01  -->
<div class="panel panel-default checkout-step-01">

	<!-- panel-heading -->
		<div class="panel-heading">
    	<h4 class="unicase-checkout-title">
	        <a data-toggle="collapse" class="" data-parent="#accordion" href="#collapseOne">
	         Select your Payment Method
	        </a>
	     </h4>
    </div>
    <!-- panel-heading -->

	<div id="collapseOne" class="panel-collapse collapse in">

		<!-- panel-body  -->
	    <div class="panel-body">
			<form name="payment" method="post">
				<div class="payment-method-option" onclick="selectPayment(this)">
					<input type="radio" name="paymethod" value="Esewa" id="esewa">
					<img src="assets/payment/esewa.png" alt="eSewa" id="esewa-logo">
					<label for="esewa">eSewa</label>
				</div>

				<div class="payment-method-option" onclick="selectPayment(this)">
					<input type="radio" name="paymethod" value="Khalti" id="khalti">
					<img src="assets/payment/khalti.png" alt="Khalti">
					<label for="khalti">Khalti</label>
				</div>

				<div class="payment-method-option" onclick="selectPayment(this)">
					<input type="radio" name="paymethod" value="COD" id="cod">
					<img src="assets/payment/COD.png" alt="Cash on Delivery">
					<label for="cod">Cash on Delivery (COD)</label>
				</div>
				
				<br/>
				<input type="submit" value="submit" name="submit" class="btn btn-primary">
			</form>
		</div>
		<!-- panel-body  -->

	</div><!-- row -->
</div>
<!-- checkout-step-01  -->
					  
					  	
					</div><!-- /.checkout-steps -->
				</div>
			</div><!-- /.row -->
		</div><!-- /.checkout-box -->
		<!-- ============================================== BRANDS CAROUSEL ============================================== -->
<?php include('includes/brands-slider.php');?>
<!-- ============================================== BRANDS CAROUSEL : END ============================================== -->	</div><!-- /.container -->
</div><!-- /.body-content -->
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
		function selectPayment(element) {
			// Find the radio button inside the clicked div and check it
			var radio = element.querySelector('input[type="radio"]');
			if (radio) {
				radio.checked = true;
			}
			
			// Remove 'selected' class from all options
			var options = document.querySelectorAll('.payment-method-option');
			options.forEach(function(option) {
				option.classList.remove('selected');
			});
			
			// Add 'selected' class to the clicked option
			element.classList.add('selected');
		}

		// Set the initial selected state on page load
		document.addEventListener('DOMContentLoaded', function() {
			var checkedRadio = document.querySelector('input[name="paymethod"]:checked');
			if (checkedRadio) {
				checkedRadio.closest('.payment-method-option').classList.add('selected');
			}

			// Intercept form submission for eSewa and Khalti
			var paymentForm = document.querySelector('form[name="payment"]');
			if (paymentForm) {
				paymentForm.addEventListener('submit', function(e) {
					var selected = document.querySelector('input[name="paymethod"]:checked');
					if (selected && selected.value === 'Esewa') {
						e.preventDefault();
						// Get amount and order id from PHP
						var amt = <?php echo isset($totalprice) ? (int)$totalprice : 100; ?>;
						var pid = 'ORDER' + Date.now(); // Unique order id
						var scd = '9810104786'; // Your eSewa merchant ID
						var su = encodeURIComponent('http://localhost/footprint/esewa-success.php');
						var fu = encodeURIComponent('http://localhost/footprint/esewa-failure.php');
						var esewaUrl = `https://esewa.com.np/epay/main?amt=${amt}&pdc=0&psc=0&txAmt=0&tAmt=${amt}&pid=${pid}&scd=${scd}&su=${su}&fu=${fu}`;
						window.location.href = esewaUrl;
					} else if (selected && selected.value === 'Khalti') {
						e.preventDefault();
						// Redirect to khalti-request.php (POST)
						var form = document.createElement('form');
						form.method = 'POST';
						form.action = 'khalti-request.php';
						document.body.appendChild(form);
						form.submit();
					}
				});
			}
		});

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
<?php } ?>