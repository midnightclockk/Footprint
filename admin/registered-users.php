<?php session_start();
include_once('includes/config.php');
if(strlen($_SESSION["alogin"])==0)
{   
header('location:logout.php');
} else {

if(isset($_GET['del'])){
$catid=$_GET['id'];
mysqli_query($con,"delete from category where id ='$catid'");
echo "<script>alert('Data Deleted');</script>";
echo "<script>window.location.href='manage-categories.php'</script>";
          }

if(isset($_GET['deluser'])){
    $userid=intval($_GET['deluser']);
    mysqli_query($con,"DELETE FROM users WHERE id='$userid'");
    echo "<script>alert('User Deleted');</script>";
    echo "<script>window.location.href='registered-users.php'</script>";
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
        <title>FootPrint | Registered Users</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.bootstrap5.min.css" rel="stylesheet" />
        <style>
            .table th, .table td { vertical-align: middle !important; text-align: center; }
            .action-icon { color: #007bff; transition: color 0.2s; margin: 0 4px; }
            .action-icon:hover { color: #0056b3; }
            .badge-active { background: #28a745; color: #fff; }
            .badge-inactive { background: #dc3545; color: #fff; }
        </style>
    </head>
    <body class="sb-nav-fixed">
 <?php include_once('includes/header.php');?>
        <div id="layoutSidenav">
       <?php include_once('includes/sidebar.php');?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Registered Users</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Registered Users</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                               Users Details
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                <table class="table table-bordered table-striped align-middle mb-0" id="usersTable">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Contact No</th>
                                            <th>Location</th>
                                            <th>Reg. Date</th>
                                            <th>Last Update</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php $query=mysqli_query($con,"select * from users");
$cnt=1;
while($row=mysqli_fetch_array($query))
{
?>  
                                        <tr>
                                            <td><?php echo htmlentities($cnt);?></td>
                                            <td><?php echo htmlentities($row['name']);?></td>
                                            <td><?php echo htmlentities($row['email']);?></td>
                                            <td><?php echo htmlentities($row['contactno']);?></td>
                                            <td><?php echo htmlentities($row['shippingCity'] . ', ' . $row['shippingState']);?></td>
                                            <td><?php echo htmlentities($row['regDate']);?></td>
                                            <td><?php echo htmlentities($row['updationDate']);?></td>
                                            <td>
                                                <?php if($row['status']==='Active') { ?>
                                                    <span class="badge badge-active">Active</span>
                                                <?php } else { ?>
                                                    <span class="badge badge-inactive">Inactive</span>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <a href="user-orders.php?uid=<?php echo $row['id']?>&uname=<?php echo htmlentities($row['name']);?>" target="_blank" class="action-icon" title="View Orders">
                                                    <i class="fas fa-list-alt fa-lg"></i>
                                                </a>
                                                <a href="view-user.php?uid=<?php echo $row['id']?>" class="action-icon" title="View Profile">
                                                    <i class="fas fa-user fa-lg"></i>
                                                </a>
                                                <a href="edit-user.php?uid=<?php echo $row['id']?>" class="action-icon" title="Edit User">
                                                    <i class="fas fa-edit fa-lg"></i>
                                                </a>
                                                <a href="registered-users.php?deluser=<?php echo $row['id']; ?>" class="action-icon text-danger" title="Delete User" onclick="return confirm('Are you sure you want to delete this user?');">
                                                    <i class="fas fa-trash-alt fa-lg"></i>
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
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.bootstrap5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script>
        $(document).ready(function() {
            $('#usersTable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'csv', 'excel', 'print'
                ],
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
<?php } ?>
