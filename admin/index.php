<?php
session_start();
error_reporting(0);
include("include/config.php");
if(isset($_POST['submit']))
{
	$username=$_POST['username'];
	$password=md5($_POST['password']);
$ret=mysqli_query($con,"SELECT * FROM admin WHERE username='$username' and password='$password'");
$num=mysqli_fetch_array($ret);
if($num>0)
{
$extra="dashboard.php";
$_SESSION['alogin']=$_POST['username'];
$_SESSION['id']=$num['id'];

header("location:dashboard.php");
exit();
}
else
{
$_SESSION['errmsg']="Invalid username or password";
header("location:index.php");
exit();
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>FootPrint | Admin Login</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-dark">
	<div class="container">
		<a class="navbar-brand" href="../index.php">FootPrint | Admin</a>
		<a class="btn btn-outline-light" href="http://localhost/footprint/">Back to Portal</a>
	</div>
</nav>

<div class="container d-flex align-items-center justify-content-center" style="min-height: 80vh;">
	<div class="card shadow" style="width: 100%; max-width: 400px;">
		<div class="card-body">
			<h3 class="card-title text-center mb-4">Sign In</h3>
			<?php if(!empty($_SESSION['errmsg'])): ?>
				<div class="alert alert-danger" role="alert">
					<?php echo htmlentities($_SESSION['errmsg']); $_SESSION['errmsg']=""; ?>
				</div>
			<?php endif; ?>
			<form method="post">
				<div class="mb-3">
					<label for="inputEmail" class="form-label">Username</label>
					<input type="text" class="form-control" id="inputEmail" name="username" placeholder="Username" required>
				</div>
				<div class="mb-3">
					<label for="inputPassword" class="form-label">Password</label>
					<input type="password" class="form-control" id="inputPassword" name="password" placeholder="Password" required>
				</div>
				<button type="submit" class="btn btn-primary w-100" name="submit">Login</button>
			</form>
		</div>
	</div>
</div>

<footer class="footer mt-auto py-3 bg-dark text-light">
	<div class="container text-center">
		<b>Copyright ©2025; FootPrint | All Rights Reserved</b>
	</div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>