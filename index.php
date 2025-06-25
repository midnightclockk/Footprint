<?php session_start();
error_reporting(0);
include('includes/config.php');
if(isset($_GET['action']) && $_GET['action']=="add"){
	$id=intval($_GET['id']);
	if(isset($_SESSION['cart'][$id])){
		$_SESSION['cart'][$id]['quantity']++;
	}else{
		$sql_p="SELECT * FROM products WHERE id={$id}";
		$query_p=mysqli_query($con,$sql_p);
		if(mysqli_num_rows($query_p)!=0){
			$row_p=mysqli_fetch_array($query_p);
			$_SESSION['cart'][$row_p['id']]=array("quantity" => 1, "price" => $row_p['productPrice']);
		}else{
			$message="Product ID is invalid";
		}
	}
	if(isset($_GET['ajax']) && $_GET['ajax']==1) {
		session_write_close();
		exit;
	}
	echo "<script>alert('Product has been added to the cart')</script>";
	echo "<script type='text/javascript'> document.location ='my-cart.php'; </script>";
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

	    <title>FootPrint | Home Page</title>

	    <!-- Bootstrap Core CSS -->
	    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
	    
	    <!-- Customizable CSS -->
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
		<link rel="stylesheet" href="assets/css/font-awesome.min.css">
		<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
		
		<!-- Favicon -->
		<link rel="shortcut icon" href="assets/images/favicon.ico">

		<style>
		.wishlist-heart {
			color: #fff;
			font-size: 18px;
			transition: color 0.2s;
		}
		.wishlist-heart:hover {
			color:rgb(255, 25, 0);
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
		<div class="furniture-container homepage-container">
		<div class="row">
		
			<div class="col-xs-12 col-sm-12 col-md-3 sidebar">
				<!-- ================================== TOP NAVIGATION ================================== -->
	<?php include('includes/side-menu.php');?>
<!-- ================================== TOP NAVIGATION : END ================================== -->
			</div><!-- /.sidemenu-holder -->	
			
			<div class="col-xs-12 col-sm-12 col-md-9 homebanner-holder">
				<!-- ========================================== SECTION – HERO ========================================= -->
			
<div id="hero" class="homepage-slider3">
	<div id="owl-main" class="owl-carousel owl-inner-nav owl-ui-sm">
		<div class="full-width-slider">	
			<div class="item" style="background-image: url(assets/images/sliders/banner.avif);">
				<!-- /.container-fluid -->
			</div><!-- /.item -->
		</div><!-- /.full-width-slider -->
	    
	    <div class="full-width-slider">
			<div class="item full-width-slider" style="background-image: url(assets/images/sliders/banner2.jpg);">
                <div class="container-fluid">
                    <div class="caption vertical-center text-center">
                        <div class="big-text fadeInDown-1" style="font-size: 3.5rem; font-weight: bold; margin-top: -10rem; padding-right: 10rem;">
                            The 9060 'Grey'
                        </div>
                        <div class="excerpt fadeInDown-2" style="font-size: 1.5rem; margin-top: 1rem; padding-right: 18rem;">
                            Worn by Storm Reid.
                        </div>
                        <div class="button-holder fadeInDown-3" style="padding-right: 18rem; text-align: left;">
                            <a href="product-details.php?pid=25" class="btn-lg btn btn-uppercase btn-primary shop-now-button">Shop Now</a>
                        </div>
                    </div>
                </div>
			</div><!-- /.item -->
		</div><!-- /.full-width-slider -->

	</div><!-- /.owl-carousel -->
</div>
			
<!-- ========================================= SECTION – HERO : END ========================================= -->	
				<!-- ============================================== INFO BOXES ============================================== -->
<div class="info-boxes wow fadeInUp">
	<div class="info-boxes-inner">
		<div class="row">
			<div class="col-md-6 col-sm-4 col-lg-4">
				<div class="info-box">
					<div class="row">
						<div class="col-xs-2">
						     <i class="icon fa fa-dollar"></i>
						</div>
						<div class="col-xs-10">
							<h4 class="info-box-heading green">money back</h4>
						</div>
					</div>	
					<h6 class="text">30 Day Money Back Guarantee.</h6>
				</div>
			</div><!-- .col -->

			<div class="hidden-md col-sm-4 col-lg-4">
				<div class="info-box">
					<div class="row">
						<div class="col-xs-2">
							<i class="icon fa fa-truck"></i>
						</div>
						<div class="col-xs-10">
							<h4 class="info-box-heading orange">free shipping</h4>
						</div>
					</div>
					<h6 class="text">free ship-on oder over Rs. 6000</h6>	
				</div>
			</div><!-- .col -->

			<div class="col-md-6 col-sm-4 col-lg-4">
				<div class="info-box">
					<div class="row">
						<div class="col-xs-2">
							<i class="icon fa fa-gift"></i>
						</div>
						<div class="col-xs-10">
							<h4 class="info-box-heading red">Special Sale</h4>
						</div>
					</div>
					<h6 class="text">All items-sale up to 20% off </h6>	
				</div>
			</div><!-- .col -->
		</div><!-- /.row -->
	</div><!-- /.info-boxes-inner -->
	
</div><!-- /.info-boxes -->
<!-- ============================================== INFO BOXES : END ============================================== -->		
			</div><!-- /.homebanner-holder -->
			
		</div><!-- /.row -->

		<!-- ============================================== SCROLL TABS ============================================== -->
		<div  >
			<div class="more-info-tab clearfix">
			   <h3 class="new-product-title pull-left">All Products</h3>
		<!-- 		<ul class="nav nav-tabs nav-tab-line pull-right" id="new-products-1">
					<li class="active"><a href="#all" data-toggle="tab">All</a></li>
					<li><a href="#books" data-toggle="tab">Books</a></li>
					<li><a href="#furniture" data-toggle="tab">Furniture</a></li>
				</ul> -->
			</div>

			<div class="tab-content outer-top-xs">
				<div class="tab-pane in active" id="all">			
					<div class="product-slider">
						<div class="owl-carousel home-owl-carousel custom-carousel owl-theme" data-item="4">
<?php
$ret = mysqli_query($con, "select * from products");
while ($row = mysqli_fetch_array($ret)) {
?>
    <div class="item">
        <div class="product">
            <div class="product-image square-image">
                <div class="image">
                    <a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>">
                        <img src="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>" alt="" />
                    </a>
                </div>
            </div>
            <div class="product-info text-left">
                <h3 class="name"><a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['productName']);?></a></h3>
                <div class="rating rateit-small"></div>
                <div class="description"></div>
                <div class="product-price">
                    <span class="price">Rs.<?php echo htmlentities($row['productPrice']);?></span>
                    <span class="price-before-discount">Rs.<?php echo htmlentities($row['productPriceBeforeDiscount']);?></span>
                </div>
            </div>
            <?php if($row['productAvailability']=='In Stock'){?>
                <div class="action">
                    <a href="#" class="lnk btn btn-info" onclick="addToCart(<?php echo $row['id']; ?>); return false;">Add to Cart</a>
                    <a href="index.php?pid=<?php echo htmlentities($row['id'])?>&&action=wishlist" class="lnk btn btn-default wishlist-heart" title="Add to Wishlist" style="margin-left:8px;">
                        <i class="fa fa-heart"></i>
                    </a>
                </div>
            <?php } else {?>
                <div class="action" style="color:red">Out of Stock</div>
            <?php } ?>
        </div>
    </div>
<?php } ?>

			</div><!-- /.home-owl-carousel -->
					</div><!-- /.product-slider -->
				</div>



			</div>
		</div>
		    

         <!-- ============================================== TABS ============================================== -->
	
		
<hr />

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

	<script>
	function updateCartCount() {
		var xhr = new XMLHttpRequest();
		xhr.open('GET', 'cart-count.php', true);
		xhr.onreadystatechange = function() {
			if (xhr.readyState === 4 && xhr.status === 200) {
				var cartCountElements = document.querySelectorAll('.basket-item-count .count');
				cartCountElements.forEach(function(el) {
					el.textContent = xhr.responseText;
				});
			}
		};
		xhr.send();
	}

	function addToCart(productId) {
		var xhr = new XMLHttpRequest();
		xhr.open('GET', 'index.php?action=add&id=' + productId + '&ajax=1', true);
		xhr.onreadystatechange = function() {
			if (xhr.readyState === 4 && xhr.status === 200) {
				alert('Product has been added to the cart');
				updateCartCount();
			}
		};
		xhr.send();
	}
	</script>

</body>
</html>