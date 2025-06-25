<?php 
session_start();
error_reporting(0);
include('includes/config.php');
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Meta -->
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<meta name="description" content="FootPrint - Before You Buy Guide. Learn how to choose the right footwear, understand sizing, and make informed purchasing decisions.">
		<meta name="author" content="">
	    <meta name="keywords" content="footwear guide, shoe sizing, buying guide, FootPrint">
	    <meta name="robots" content="all">

	    <title>Before You Buy - FootPrint</title>

	    <!-- Bootstrap Core CSS -->
	    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
	    
	    <!-- Customizable CSS -->
	    <link rel="stylesheet" href="assets/css/main.css">
	    <link rel="stylesheet" href="assets/css/red.css">
	    <link rel="stylesheet" href="assets/css/owl.carousel.css">
		<link rel="stylesheet" href="assets/css/owl.transitions.css">
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
		<link rel="stylesheet" href="assets/css/font-awesome.min.css">
		<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
		
		<!-- Favicon -->
		<link rel="shortcut icon" href="assets/images/favicon.ico">

		<style>
			.guide-section {
				padding: 40px 0;
				border-bottom: 1px solid #eee;
			}
			.guide-section:last-child {
				border-bottom: none;
			}
			.guide-title {
				color: #ff0000;
				font-size: 28px;
				margin-bottom: 20px;
				font-weight: bold;
			}
			.guide-subtitle {
				color: #333;
				font-size: 20px;
				margin-bottom: 15px;
				font-weight: 600;
			}
			.guide-content {
				line-height: 1.8;
				color: #666;
			}
			.size-chart {
				background: #f9f9f9;
				padding: 20px;
				border-radius: 5px;
				margin: 20px 0;
			}
			.size-chart table {
				width: 100%;
				border-collapse: collapse;
			}
			.size-chart th, .size-chart td {
				padding: 10px;
				text-align: center;
				border: 1px solid #ddd;
			}
			.size-chart th {
				background: #ff0000;
				color: white;
			}
			.tip-box {
				background: #fff3cd;
				border: 1px solid #ffeaa7;
				border-radius: 5px;
				padding: 15px;
				margin: 15px 0;
			}
			.warning-box {
				background: #f8d7da;
				border: 1px solid #f5c6cb;
				border-radius: 5px;
				padding: 15px;
				margin: 15px 0;
			}
			.checklist {
				list-style: none;
				padding: 0;
			}
			.checklist li {
				padding: 8px 0;
				padding-left: 30px;
				position: relative;
			}
			.checklist li:before {
				content: "✓";
				color: #28a745;
				font-weight: bold;
				position: absolute;
				left: 0;
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
<div class="body-content outer-top-xs" id="top-banner-and-menu">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<!-- Page Header -->
				<div class="page-header text-center" style="margin: 40px 0;">
					<h1 style="color: #ff0000; font-size: 36px; font-weight: bold;">Before You Buy</h1>
					<p style="font-size: 18px; color: #666;">Your Complete Guide to Smart Footwear Shopping</p>
				</div>

				<!-- Introduction Section -->
				<div class="guide-section">
					<h2 class="guide-title">Why This Guide Matters</h2>
					<div class="guide-content">
						<p>Buying the right footwear is crucial for comfort, performance, and foot health. This comprehensive guide will help you make informed decisions and avoid common pitfalls when shopping for shoes, sneakers, and other footwear.</p>
					</div>
				</div>

				<!-- Sizing Guide Section -->
				<div class="guide-section">
					<h2 class="guide-title">Understanding Shoe Sizing</h2>
					
					<h3 class="guide-subtitle">How to Measure Your Feet</h3>
					<div class="guide-content">
						<ol>
							<li>Place a piece of paper on a hard floor</li>
							<li>Stand on the paper with your heel against a wall</li>
							<li>Mark the longest part of your foot (usually the big toe)</li>
							<li>Measure the distance from heel to toe in centimeters</li>
							<li>Repeat for both feet and use the larger measurement</li>
						</ol>
					</div>

					<h3 class="guide-subtitle">International Size Conversion</h3>
					<div class="size-chart">
						<table>
							<thead>
								<tr>
									<th>US Size</th>
									<th>UK Size</th>
									<th>EU Size</th>
									<th>Foot Length (cm)</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>7</td>
									<td>6</td>
									<td>40</td>
									<td>25.5</td>
								</tr>
								<tr>
									<td>8</td>
									<td>7</td>
									<td>41</td>
									<td>26.5</td>
								</tr>
								<tr>
									<td>9</td>
									<td>8</td>
									<td>42</td>
									<td>27.5</td>
								</tr>
								<tr>
									<td>10</td>
									<td>9</td>
									<td>43</td>
									<td>28.5</td>
								</tr>
								<tr>
									<td>11</td>
									<td>10</td>
									<td>44</td>
									<td>29.5</td>
								</tr>
							</tbody>
						</table>
					</div>

					<div class="tip-box">
						<strong>Pro Tip:</strong> Always try on shoes in the afternoon when your feet are slightly larger due to natural swelling throughout the day.
					</div>
				</div>

				<!-- Foot Type Section -->
				<div class="guide-section">
					<h2 class="guide-title">Understanding Your Foot Type</h2>
					
					<h3 class="guide-subtitle">Arch Types</h3>
					<div class="guide-content">
						<ul class="checklist">
							<li><strong>High Arch:</strong> Look for shoes with good cushioning and flexibility</li>
							<li><strong>Normal Arch:</strong> Most shoes will work well for you</li>
							<li><strong>Low Arch (Flat Feet):</strong> Choose shoes with good arch support and stability</li>
						</ul>
					</div>

					<h3 class="guide-subtitle">Width Considerations</h3>
					<div class="guide-content">
						<p>Foot width is just as important as length. Common width options include:</p>
						<ul class="checklist">
							<li><strong>Narrow (B):</strong> For slim feet</li>
							<li><strong>Medium (D):</strong> Standard width for most people</li>
							<li><strong>Wide (E/EE):</strong> For wider feet</li>
							<li><strong>Extra Wide (EEE):</strong> For very wide feet</li>
						</ul>
					</div>
				</div>

				<!-- Activity-Based Selection -->
				<div class="guide-section">
					<h2 class="guide-title">Choosing Shoes by Activity</h2>
					
					<h3 class="guide-subtitle">Running Shoes</h3>
					<div class="guide-content">
						<ul class="checklist">
							<li>Look for adequate cushioning and shock absorption</li>
							<li>Consider your running style (neutral, overpronation, underpronation)</li>
							<li>Ensure proper toe box space for natural foot movement</li>
							<li>Check for breathable materials</li>
						</ul>
					</div>

					<h3 class="guide-subtitle">Casual/Lifestyle Shoes</h3>
					<div class="guide-content">
						<ul class="checklist">
							<li>Prioritize comfort for daily wear</li>
							<li>Consider versatile styling for different occasions</li>
							<li>Look for durable materials for longevity</li>
							<li>Ensure proper fit for extended wear</li>
						</ul>
					</div>

					<h3 class="guide-subtitle">Sports/Athletic Shoes</h3>
					<div class="guide-content">
						<ul class="checklist">
							<li>Choose sport-specific features (basketball, tennis, etc.)</li>
							<li>Look for proper ankle support if needed</li>
							<li>Consider court surface compatibility</li>
							<li>Ensure good traction and grip</li>
						</ul>
					</div>
				</div>

				<!-- Material Guide -->
				<div class="guide-section">
					<h2 class="guide-title">Understanding Materials</h2>
					
					<h3 class="guide-subtitle">Upper Materials</h3>
					<div class="guide-content">
						<ul class="checklist">
							<li><strong>Leather:</strong> Durable, breathable, molds to foot shape</li>
							<li><strong>Synthetic:</strong> Lightweight, often more affordable</li>
							<li><strong>Mesh:</strong> Highly breathable, great for athletic shoes</li>
							<li><strong>Canvas:</strong> Casual, comfortable, easy to clean</li>
						</ul>
					</div>

					<h3 class="guide-subtitle">Sole Materials</h3>
					<div class="guide-content">
						<ul class="checklist">
							<li><strong>Rubber:</strong> Excellent traction and durability</li>
							<li><strong>EVA:</strong> Lightweight cushioning</li>
							<li><strong>Polyurethane:</strong> Durable but heavier</li>
							<li><strong>TPU:</strong> Good balance of weight and durability</li>
						</ul>
					</div>
				</div>

				<!-- Fit Testing -->
				<div class="guide-section">
					<h2 class="guide-title">How to Test the Fit</h2>
					
					<div class="guide-content">
						<h3 class="guide-subtitle">The Fit Test Checklist</h3>
						<ul class="checklist">
							<li>Stand up and walk around in the shoes</li>
							<li>Check for adequate toe space (about 1/2 inch from longest toe)</li>
							<li>Ensure no heel slippage</li>
							<li>Check that the ball of your foot aligns with the widest part of the shoe</li>
							<li>Make sure there's no pinching or pressure points</li>
							<li>Test on both feet (they may be different sizes)</li>
						</ul>
					</div>

					<div class="warning-box">
						<strong>Warning:</strong> Don't buy shoes that feel tight expecting them to "break in." Shoes should feel comfortable from the first wear.
					</div>
				</div>

				<!-- Care and Maintenance -->
				<div class="guide-section">
					<h2 class="guide-title">Care and Maintenance</h2>
					
					<h3 class="guide-subtitle">Daily Care</h3>
					<div class="guide-content">
						<ul class="checklist">
							<li>Clean shoes regularly with appropriate products</li>
							<li>Allow shoes to dry completely between wears</li>
							<li>Use shoe trees to maintain shape</li>
							<li>Rotate between multiple pairs to extend lifespan</li>
						</ul>
					</div>

					<h3 class="guide-subtitle">Storage Tips</h3>
					<div class="guide-content">
						<ul class="checklist">
							<li>Store in a cool, dry place</li>
							<li>Avoid direct sunlight and heat sources</li>
							<li>Use proper shoe storage solutions</li>
							<li>Keep away from moisture and humidity</li>
						</ul>
					</div>
				</div>

				<!-- Return Policy -->
				<div class="guide-section">
					<h2 class="guide-title">Our Return Policy</h2>
					
					<div class="guide-content">
						<p>At FootPrint, we want you to be completely satisfied with your purchase. Here's what you need to know:</p>
						
						<h3 class="guide-subtitle">Return Conditions</h3>
						<ul class="checklist">
							<li>Items must be returned within 30 days of purchase</li>
							<li>Shoes must be unworn and in original condition</li>
							<li>Original packaging and tags must be included</li>
							<li>Return shipping costs may apply</li>
						</ul>

						<h3 class="guide-subtitle">Exchange Policy</h3>
						<ul class="checklist">
							<li>Free size exchanges within 30 days</li>
							<li>Style exchanges subject to availability</li>
							<li>Contact our customer service for assistance</li>
						</ul>
					</div>
				</div>

				<!-- Final Tips -->
				<div class="guide-section">
					<h2 class="guide-title">Final Shopping Tips</h2>
					
					<div class="guide-content">
						<ul class="checklist">
							<li>Always try on shoes before purchasing</li>
							<li>Bring the socks you plan to wear with the shoes</li>
							<li>Shop in the afternoon when feet are largest</li>
							<li>Don't compromise on fit for style</li>
							<li>Consider your lifestyle and daily activities</li>
							<li>Invest in quality - good shoes last longer</li>
							<li>Read customer reviews for real-world feedback</li>
						</ul>
					</div>

					<div class="tip-box">
						<strong>Remember:</strong> The right shoes can make all the difference in your comfort and performance. Take your time to find the perfect fit!
					</div>
				</div>

				<!-- Contact Section -->
				<div class="guide-section text-center">
					<h2 class="guide-title">Need Help?</h2>
					<div class="guide-content">
						<p>Our customer service team is here to help you find the perfect footwear.</p>
						<p><strong>Contact us:</strong></p>
						<p>📧 Email: <a href="mailto:support@footprint.com">imkashifk5@gmail.com</a></p>
						<p>📞 Phone: <a href="tel:+9779810104786">+977-9810104786</a></p>
						<p>📍 Address: <a href="https://www.google.com/maps/search/?api=1&query=Kathmandu,+Nepal" target="_blank">Kathmandu, Nepal</a></p>
						<p>💬 Live Chat: Available during business hours</p>
					</div>
				</div>
			</div>
		</div>
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

	<script>
		// Navbar scroll behavior
		$(window).scroll(function() {
			if ($(this).scrollTop() > 100) {
				$('.header-style-1 .header-nav').addClass('navbar-fixed');
			} else {
				$('.header-style-1 .header-nav').removeClass('navbar-fixed');
			}
		});
	</script>

</body>
</html> 