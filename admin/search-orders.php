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
        <title>Shopping Portal | Manage Searched Orders</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed bg-light">
 <?php include_once('includes/header.php');?>
        <div id="layoutSidenav">
       <?php include_once('includes/sidebar.php');?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4 py-4">
                        <h1 class="mt-4 mb-3">Manage Searched Orders</h1>
                        <nav aria-label="breadcrumb">
                          <ol class="breadcrumb mb-4">
                              <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Manage Searched Orders</li>
                          </ol>
                        </nav>
                        <div class="card shadow mb-4">
                            <div class="card-header bg-primary text-white">
                                <i class="fas fa-table me-1"></i>
                               All Order Details
                            </div>
                            <div class="card-body">
<?php
if(isset($_GET['search']) && !empty($_GET['searchinputdata'])){
$searchinput=$_GET['searchinputdata'];
?>
    <h4 class="text-center text-primary mb-4">Search Result against <span class="fw-bold"><?php echo htmlspecialchars($searchinput);?></span></h4>
    <div class="table-responsive">
        <table id="datatablesSimple" class="table table-bordered table-hover align-middle">
            <thead class="table-light">
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
            <tfoot class="table-light">
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
            </tfoot>
            <tbody>
<?php $query=mysqli_query($con,"SELECT orders.id,orderNumber,totalAmount,orderStatus,orderDate,orders.paymentMethod,users.name,users.contactno,products.productAvailability 
    FROM `orders` 
    JOIN users ON users.id=orders.userId 
    JOIN products ON products.id=orders.productId 
    WHERE (users.name like '%$searchinput%' || orders.orderNumber like '%$searchinput%')");
$cnt=1;
while($row=mysqli_fetch_array($query))
{
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
                        <a href="order-details.php?orderid=<?php echo $row['id']?>#update" class="btn btn-outline-success btn-sm" title="Update Order">
                            <i class="fas fa-edit"></i> Update
                        </a>
                    </td>
                </tr>
<?php $cnt=$cnt+1; } ?>
            </tbody>
        </table>
    </div>
<?php } ?>
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
<?php } ?>
