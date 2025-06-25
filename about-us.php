<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include_once('includes/config.php');

// Check database connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
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
        <title>About Us | Footprint</title>
        
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

        <!-- Custom CSS for Blog/About -->
        <link href="assets/css/blog-about.css" rel="stylesheet">
        
        <!-- Favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">
        
        <style>
            .hero-section {
                background: #23272b;
                color: white;
                padding: 40px 0;
                text-align: center;
            }
            .hero-section h1 {
                font-size: 48px;
                margin-bottom: 20px;
            }
            .hero-section p {
                font-size: 20px;
                max-width: 800px;
                margin: 0 auto;
            }
            .stats-section {
                padding: 60px 0;
                background: #f8f9fa;
            }
            .stat-item {
                text-align: center;
                padding: 20px;
            }
            .stat-number {
                font-size: 36px;
                font-weight: bold;
                color: #ff0000;
                margin-bottom: 10px;
            }
            .stat-label {
                font-size: 18px;
                color: #333;
            }
            .timeline-section {
                padding: 60px 0;
            }
            .timeline-item {
                margin-bottom: 40px;
                position: relative;
                padding-left: 30px;
            }
            .timeline-item:before {
                content: '';
                position: absolute;
                left: 0;
                top: 0;
                width: 2px;
                height: 100%;
                background: #ff0000;
            }
            .timeline-year {
                font-size: 24px;
                font-weight: bold;
                color: #ff0000;
                margin-bottom: 10px;
            }
            .timeline-content {
                background: #fff;
                padding: 20px;
                border-radius: 5px;
                box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            }
            .values-section {
                padding: 60px 0;
                background: #f8f9fa;
            }
            .value-card {
                background: white;
                padding: 30px;
                border-radius: 5px;
                box-shadow: 0 2px 5px rgba(0,0,0,0.1);
                margin-bottom: 30px;
                text-align: center;
            }
            .value-card i {
                font-size: 40px;
                color: #ff0000;
                margin-bottom: 20px;
            }
            .value-card h3 {
                color: #333;
                margin-bottom: 15px;
            }
        </style>
    </head>
    <body>
        <?php include('includes/header.php');?>
        
        <div class="hero-section">
            <div class="container">
                <h1>About FootPrint</h1>
                <p>Transforming the way Nepal shops for footwear, one step at a time</p>
            </div>
        </div>

        <div class="container" style="padding: 10px 0 20px 0; margin-top: 40px;">
            <div class="row justify-content-center">
                <div class="col-md-8" style="margin-left: 30px;">
                    <div style="background: #fff; border-radius: 12px; box-shadow: 0 4px 16px rgba(82, 168, 255, 0.51); padding: 24px 24px 16px 24px; margin-bottom: 32px; display: flex; align-items: center; gap: 24px; flex-wrap: wrap;">
                        <img src="img/photo.jpg" alt="MD Kashif Khan" style="width: 125px; height: 180px; object-fit: cover; border: 3px solid #23272b; background: #f7f7f7; box-shadow: 0 2px 8px rgba(44,62,80,0.08);">
                        <div style="flex: 1 1 250px; min-width: 200px;">
                            <h3 style="margin-bottom: 8px; color: #23272b; font-weight: 700;">MD Kashif Khan</h3>
                            <h5 style="margin-bottom: 12px; color: #2874f0; font-weight: 500;">Padmashree International College</h5>
                            <p style="margin-bottom: 10px; font-size: 1.05rem; color: #444; text-align: Justify;">This is my college project for BCA 5th Semester. I have hosted this website to sell shoes online as part of my academic learning and practical exposure.</p>
                            <p style="margin-bottom: 10px; font-size: 1.05rem; color: #444; text-align: Justify;">This project demonstrates my skills in web development, database management, and e-commerce integration. I have used PHP, MySQL, Bootstrap, and other modern web technologies to build a fully functional online shoe store.</p>
                            <p style="margin-bottom: 0; font-size: 1.05rem; color: #444; text-align: Justify;">Thank you for visiting my website! If you have any feedback or suggestions, feel free to reach out. Your support and encouragement mean a lot to me as I continue to learn and grow in the field of IT.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="stats-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="stat-item">
                            <div class="stat-number">100+</div>
                            <div class="stat-label">Happy Customers</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-item">
                            <div class="stat-number">10+</div>
                            <div class="stat-label">Products</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-item">
                            <div class="stat-number">5+</div>
                            <div class="stat-label">Cities</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-item">
                            <div class="stat-number">24/7</div>
                            <div class="stat-label">Customer Support</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="timeline-section">
            <div class="container">
                <h2 class="text-center mb-5">Our Project Timeline</h2>
                <div class="timeline-item">
                    <div class="timeline-year">Planning</div>
                    <div class="timeline-content">
                        <h3>16th March, 2025 - 30th March, 2025</h3>
                        <p>Defining project scope, objectives, and initial strategies.</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-year">Research</div>
                    <div class="timeline-content">
                        <h3>25th March, 2025 - 13th May, 2025</h3>
                        <p>In-depth market analysis, user behavior studies, and technology feasibility.</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-year">Design</div>
                    <div class="timeline-content">
                        <h3>2nd May, 2025 - 25th May, 2025</h3>
                        <p>Creating UI/UX mockups, wireframes, and overall system architecture design.</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-year">Development</div>
                    <div class="timeline-content">
                        <h3>26th May, 2025 - 5th June, 2025</h3>
                        <p>Coding and building the core functionalities and features of the platform.</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-year">Testing</div>
                    <div class="timeline-content">
                        <h3>6th June, 2025 - 9th June, 2025</h3>
                        <p>Quality assurance, bug fixing, and performance testing to ensure a robust system.</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-year">Launch</div>
                    <div class="timeline-content">
                        <h3>10th June, 2025</h3>
                        <p>Official release and deployment of the updated platform to the public.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="values-section">
            <div class="container">
                <h2 class="text-center mb-5">Our Values</h2>
                <div class="row">
                    <div class="col-md-4">
                        <div class="value-card">
                            <i class="fa fa-heart"></i>
                            <h3>Customer First</h3>
                            <p>We put our customers at the heart of everything we do, ensuring their satisfaction is our top priority.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="value-card">
                            <i class="fa fa-lightbulb-o"></i>
                            <h3>Innovation</h3>
                            <p>We constantly innovate to provide the best shopping experience and stay ahead of the curve.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="value-card">
                            <i class="fa fa-users"></i>
                            <h3>Integrity</h3>
                            <p>We conduct our business with honesty, transparency, and ethical practices.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include('includes/footer.php');?>
        
        <!-- Additional Scripts -->
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
