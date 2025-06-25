<?php session_start();
include_once('includes/config.php');
if(strlen( $_SESSION["alogin"])==0)
{   
header('location:logout.php');
} else {

if(isset($_GET['del']))
{
mysqli_query($con,"delete from subcategory where id = '".$_GET['id']."'");
echo "<script>alert('Data Deleted');</script>";
echo "<script>window.location.href='manage-subcategories.php'</script>";
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
        <title>Shopping Portal | Manage In Transit Orders</title>
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
                        <h1 class="mt-4">Manage In Transit Orders</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Manage In Transit Orders</li>
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
                               In Transit Order Details
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
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php $query=mysqli_query($con,"SELECT orders.id,orderNumber,totalAmount,orderStatus,orderDate,users.name,users.contactno 
    FROM `orders` join users on users.id=orders.userId where (orderStatus='In Transit')");
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
                                            <td style="color:blue;"><?php echo htmlentities($row['orderStatus']);?></td>
                                            <td>
                                                <a href="order-details.php?orderid=<?php echo $row['id']?>" target="_blank" class="action-icon" title="View Order Details">
                                                    <i class="fas fa-file fa-lg"></i>
                                                </a>
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
