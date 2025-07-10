<?php session_start();
include_once('includes/config.php');
if(strlen( $_SESSION["alogin"])==0)
{   
header('location:logout.php');
} else {
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Shopping Portal | Manage All Orders</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <style>
            .table th, .table td { vertical-align: middle !important; text-align: center; }
            .action-icon { color: #007bff; transition: color 0.2s; margin: 0 5px; }
            .action-icon:hover { color: #0056b3; }
        </style>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
 <?php include_once('includes/header.php');?>
        <div id="layoutSidenav">
       <?php include_once('includes/sidebar.php');?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Manage All Orders</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Manage All Orders</li>
                        </ol>
                        <?php if(isset($_SESSION['delmsg'])) { ?>
                        <div class="alert alert-<?php echo strpos($_SESSION['delmsg'], 'successfully') !== false ? 'success' : 'danger'; ?> alert-dismissible fade show" role="alert">
                            <?php echo htmlentities($_SESSION['delmsg']); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php unset($_SESSION['delmsg']); } ?>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                               All Order Details
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                <table class="table table-bordered table-striped align-middle mb-0" id="datatablesSimple">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>Order No.</th>
                                            <th>Order By</th>
                                            <th>Order Amount</th>
                                            <th>Order Date</th>
                                            <th>Order Status</th>
                                            <th>Payment Mode</th>
                                            <th>Payment Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php // Show all placed orders (not just cart), i.e., orders with paymentMethod IS NOT NULL
$query=mysqli_query($con,"SELECT MIN(orders.id) as id, COALESCE(orderNumber, 'N/A') as orderNumber, users.name, SUM(totalAmount) as totalAmount, MIN(orderDate) as orderDate, COALESCE(MAX(orderStatus), 'N/A') as orderStatus, paymentMethod FROM orders JOIN users ON users.id=orders.userId WHERE orders.paymentMethod IS NOT NULL GROUP BY orderNumber ORDER BY orderDate DESC");
$cnt=1;
$orderFound = false;
while($row=mysqli_fetch_array($query))
{
    $orderFound = true;
?>  
                                        <tr>
                                            <td><?php echo htmlentities($cnt);?></td>
                                            <td><?php echo htmlentities($row['orderNumber']);?></td>
                                            <td><?php echo htmlentities($row['name']);?></td>
                                            <td><?php echo htmlentities($row['totalAmount']);?></td>
                                            <td><?php echo htmlentities($row['orderDate']);?></td>
                                            <td>
                                              <?php if (empty($row['orderStatus'])): ?>
                                                <span style="color:red;">Not Processed Yet</span>
                                              <?php else: ?>
                                                <?php echo htmlentities($row['orderStatus']); ?>
                                              <?php endif; ?>
                                            </td>
                                            <td><?php echo htmlentities($row['paymentMethod']);?></td>
                                            <td>
                                              <?php if (strtolower($row['paymentMethod']) === 'cod'): ?>
                                                <?php if (strtolower($row['orderStatus']) === 'delivered'): ?>
                                                  <span class="badge bg-success">Paid on Delivery</span>
                                                <?php else: ?>
                                                  <span class="badge bg-warning">Pending</span>
                                                <?php endif; ?>
                                              <?php else: ?>
                                                <span class="badge bg-success">Paid</span>
                                              <?php endif; ?>
                                            </td>
                                            <td>
                                                <a href="order-details.php?orderid=<?php echo $row['id']?>" target="_blank" class="btn btn-outline-primary btn-sm" title="View Order Details">
                                                    <i class="fas fa-file fa-lg"></i> View
                                                </a>
                                            </td>
                                        </tr>
<?php $cnt=$cnt+1; } ?>
<?php if (!$orderFound): ?>
    <tr><td colspan="9" style="text-align:center; font-size:18px; color:#c00; font-weight:bold;">Order is not placed yet.</td></tr>
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
        <script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
<?php } ?>
