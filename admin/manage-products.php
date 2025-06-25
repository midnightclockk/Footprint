<?php
session_start();
include_once('includes/config.php');
if(strlen($_SESSION["alogin"])==0) {
    header('location:logout.php');
exit();
}
if(isset($_GET['del'])) {
    mysqli_query($con,"delete from products where id ='".$_GET['id']."'");
                  $_SESSION['delmsg']="Product deleted !!";
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
	<title>FootPrint | Manage Products</title>
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
                <h1 class="mt-4 mb-3">Manage Products</h1>
		<ol class="breadcrumb mb-4">
			<li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
			<li class="breadcrumb-item active">Manage Products</li>
		</ol>
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <span><i class="fas fa-table me-1"></i> Products Details</span>
                        <a href="add-product.php" class="btn btn-success btn-sm"><i class="fas fa-plus"></i> Add Product</a>
                    </div>
                    <div class="card-body">
		<?php if(isset($_SESSION['delmsg']) && $_SESSION['delmsg'] != "") { ?>
			<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<?php echo htmlentities($_SESSION['delmsg']); ?>
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
			<?php $_SESSION['delmsg'] = ""; } ?>
				<div class="table-responsive">
                            <table id="productsTable" class="table table-bordered table-striped align-middle mb-0">
						<thead class="table-dark">
							<tr>
								<th>#</th>
								<th>Product Name</th>
								<th>Category</th>
								<th>Subcategory</th>
								<th>Company Name</th>
								<th>Product Creation Date</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
<?php $query=mysqli_query($con,"select products.*,category.categoryName,subcategory.subcategory from products join category on category.id=products.category join subcategory on subcategory.id=products.subCategory");
$cnt=1;
while($row=mysqli_fetch_array($query))
{
?>
							<tr>
								<td><?php echo htmlentities($cnt);?></td>
								<td><?php echo htmlentities($row['productName']);?></td>
								<td><?php echo htmlentities($row['categoryName']);?></td>
								<td><?php echo htmlentities($row['subcategory']);?></td>
								<td><?php echo htmlentities($row['productCompany']);?></td>
								<td><?php echo htmlentities($row['postingDate']);?></td>
								<td>
                                            <a href="edit-products.php?id=<?php echo $row['id']?>" class="btn btn-sm btn-primary" title="Edit"><i class="fas fa-edit"></i> Edit</a>
                                            <a href="manage-products.php?id=<?php echo $row['id']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')" class="btn btn-sm btn-danger ms-1" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
								</td>
							</tr>
<?php $cnt=$cnt+1; } ?>
						</tbody>
					</table>
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
	<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script>
$(document).ready(function() {
    $('#productsTable').DataTable({
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