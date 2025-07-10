<?php
session_start();
include_once('includes/config.php');
if(strlen($_SESSION['alogin'])==0) {
    header('location:index.php');
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
	<title>FootPrint | Pending Orders</title>
	<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
	<link href="css/styles.css" rel="stylesheet" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">
<?php include_once('includes/header.php');?>
<div id="layoutSidenav">
	<?php include_once('includes/sidebar.php');?>
	<div id="layoutSidenav_content">
		<main>
			<div class="container-fluid px-4">
				<h1 class="mt-4 mb-3">Pending Orders</h1>
				<ol class="breadcrumb mb-4">
					<li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
					<li class="breadcrumb-item active">Pending Orders</li>
				</ol>
				<div class="card mb-4">
					<div class="card-header d-flex align-items-center justify-content-between">
						<span><i class="fas fa-table me-1"></i> Orders Details</span>
						<a href="edit-order.php" class="btn btn-success btn-sm"><i class="fas fa-tasks"></i> Order Manage</a>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table id="ordersTable" class="table table-bordered table-striped align-middle mb-0">
								<thead class="table-dark">
									<tr>
										<th>#</th>
										<th>Order ID</th>
										<th>Name</th>
										<th>Email</th>
										<th>Contact No</th>
										<th>Product</th>
										<th>Order Date</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
<?php 
$status='Delivered';
$query=mysqli_query($con,"select users.name as username,users.email as useremail,users.contactno as usercontact,products.productName as productname,orders.orderDate as orderdate,orders.id as id, orders.orderNumber as orderNumber from orders join users on orders.userId=users.id join products on products.id=orders.productId where orders.orderStatus!='$status' or orders.orderStatus is null");
$cnt=1;
$orderFound = false;
while($row=mysqli_fetch_array($query))
{
	$orderFound = true;
?>
									<tr>
										<td><?php echo htmlentities($cnt);?></td>
										<td><?php echo htmlentities($row['orderNumber']);?></td>
										<td><?php echo htmlentities($row['username']);?></td>
										<td><?php echo htmlentities($row['useremail']);?></td>
										<td><?php echo htmlentities($row['usercontact']);?></td>
										<td><?php echo htmlentities($row['productname']);?></td>
										<td><?php echo htmlentities($row['orderdate']);?></td>
										<td>
											<a href="order-details.php?oid=<?php echo htmlentities($row['id']);?>" title="Order Details" target="_blank" class="btn btn-info btn-sm"><i class="fas fa-info-circle"></i> Details</a>
											<a href="edit-order.php?orderNumber=<?php echo urlencode($row['id']); ?>" title="Order Manage" class="btn btn-success btn-sm ms-1"><i class="fas fa-tasks"></i> Order Manage</a>
										</td>
									</tr>
<?php $cnt++; } ?>
<?php if (!$orderFound): ?>
    <tr><td colspan="9" style="text-align:center; font-size:18px; color:#c00; font-weight:bold;">Order is not pending yet.</td></tr>
<?php endif; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</main>
		<?php include_once('includes/footer.php');?>
	</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script>
$(document).ready(function() {
	$('#ordersTable').DataTable({
		pageLength: 10,
		lengthMenu: [5, 10, 25, 50, 100],
		order: [[0, 'asc']],
		columnDefs: [
			{ orderable: false, targets: -1 }
		]
	});
});
</script>
</body>
</html>