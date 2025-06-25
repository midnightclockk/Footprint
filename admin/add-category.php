<?php session_start();
include_once('includes/config.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);
if(strlen( $_SESSION["alogin"])==0)
{   
header('location:logout.php');
} else {

if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
}

//For Adding categories
if(isset($_POST['submit']))
{
$category=$_POST['category'];
$description=$_POST['description'];
$createdby=$_SESSION['alogin'];
$sql=mysqli_query($con,"insert into category(categoryName,categoryDescription,createdBy) values('$category','$description','$createdby')");
if (!$sql) {
    die("Error inserting category: " . mysqli_error($con));
}
echo "<script>alert('Category added successfully');</script>";
echo "<script>window.location.href='manage-categories.php'</script>";

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
        <title>FootPrint | Add Category</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body>
   <?php include_once('includes/header.php');?>
        <div id="layoutSidenav">
   <?php include_once('includes/sidebar.php');?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Add Category</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Add Category</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">
<form  method="post">                                
<div class="row">
<div class="col-2">Category Name</div>
<div class="col-4"><input type="text" placeholder="Enter category Name"  name="category" class="form-control" required></div>
</div>

<div class="row" style="margin-top:1%;">
<div class="col-2">Category Description</div>
<div class="col-4"><textarea placeholder="Enter category Description"  name="description" class="form-control"></textarea></div>
</div>

<div class="row">
<div class="col-2"><button type="submit" name="submit" class="btn btn-primary">Submit</button></div>
</div>

</form>
                            </div>
                        </div>
                    </div>
                </main>
          <?php include_once('includes/footer.php');?>
            </div>
        </div>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/scripts.js"></script>
        
    </body>
</html>
<?php } ?>
