<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include_once('includes/config.php');

// Pagination logic
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;
$limit = 6;
$offset = ($page - 1) * $limit;

// Get total products for pagination
$total_products_result = mysqli_query($con, "SELECT COUNT(*) as total FROM products");
$total_products_row = mysqli_fetch_assoc($total_products_result);
$total_products = $total_products_row['total'];
$total_pages = ceil($total_products / $limit);

// Fetch products for current page
$latest_products_query = mysqli_query($con, "SELECT p.id, p.productName, p.productImage1, p.postingDate, c.categoryName FROM products p JOIN category c ON p.category = c.id ORDER BY p.id DESC LIMIT $limit OFFSET $offset");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="MediaCenter, Template, eCommerce">
    <meta name="robots" content="all">
    <title>Latest Products | Footprint</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/red.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.css">
    <link rel="stylesheet" href="assets/css/owl.transitions.css">
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
    <link href="assets/css/blog-about.css" rel="stylesheet">
    <link rel="shortcut icon" href="assets/images/favicon.ico">
</head>
<body>
<?php include('includes/header.php');?>
<div class="blog-header bg-dark text-white py-2 mb-4" style="margin-bottom: 60px;">
    <div class="container">
        <h1 class="text-center mb-0" style="font-size: 4.5rem;">Latest Products</h1>
        <p class="text-center" style="font-size: 1.7rem; margin-top: 5px;">
            <a href="index.php" style="color: #fff; text-decoration: none;">Home</a> / <span style="font-weight: bold; color: #fff;">Latest</span>
        </p>
    </div>
</div>
<div class="container py-5">
    <div class="row">
        <div class="col-lg-12">
            <div class="row g-4 justify-content-center">
                <?php while($product = mysqli_fetch_array($latest_products_query)) {
                    $product_id = htmlentities($product['id']);
                    $product_name = htmlentities($product['productName']);
                    $product_image = htmlentities($product['productImage1']);
                    $product_date = date('M d, Y', strtotime($product['postingDate']));
                    $product_category = htmlentities($product['categoryName']);
                ?>
                <div class="col-md-6 py-2 mb-4 col-lg-4" style="margin-bottom: 10px;">
                    <div class="card h-100 d-flex flex-column">
                        <img class="card-img-top" src="admin/productimages/<?php echo $product_id; ?>/<?php echo $product_image; ?>" alt="<?php echo $product_name; ?>" />
                        <div class="card-body d-flex flex-column">
                            <div class="small text-muted"><?php echo $product_date; ?> | <?php echo $product_category; ?></div>
                            <h2 class="card-title" style="font-size:1.25rem;"><?php echo $product_name; ?></h2>
                            <p class="card-text">Brief description of the product or related blog content...</p>
                            <a class="btn btn-primary mt-auto" href="product-details.php?pid=<?php echo $product_id; ?>">View Product →</a>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
            <!-- Pagination -->
            <nav aria-label="Pagination">
                <hr class="my-0" />
                <ul class="pagination justify-content-center my-4">
                    <li class="page-item<?php if($page == 1) echo ' disabled'; ?>">
                        <a class="page-link" href="?page=1" tabindex="-1" aria-disabled="<?php echo $page == 1 ? 'true' : 'false'; ?>">Newer</a>
                    </li>
                    <?php for($i = 1; $i <= $total_pages; $i++): ?>
                        <li class="page-item<?php if($i == $page) echo ' active'; ?>">
                            <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>
                    <li class="page-item<?php if($page == $total_pages) echo ' disabled'; ?>">
                        <a class="page-link" href="?page=<?php echo $total_pages; ?>">Older</a>
                    </li>
                </ul>
            </nav>
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
<script src="assets/js/lightbox.min.js"></script>
<script src="assets/js/bootstrap-select.min.js"></script>
<script src="assets/js/wow.min.js"></script>
<script src="assets/js/scripts.js"></script>
</body>
</html> 