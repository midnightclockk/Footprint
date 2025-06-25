<?php
session_start();
include_once('includes/config.php');
if(strlen($_SESSION['alogin'])==0) {
    header('location:logout.php');
    exit();
}
date_default_timezone_set('Asia/Kathmandu');
$currentTime = date('Y-m-d H:i:s', time());

if(isset($_POST['submit'])) {
    $sql = mysqli_query($con, "SELECT password FROM admin WHERE password='".md5($_POST['password'])."' && username='".$_SESSION['alogin']."'");
    $num = mysqli_fetch_array($sql);
    if($num > 0) {
        mysqli_query($con, "UPDATE admin SET password='".md5($_POST['newpassword'])."', updationDate='$currentTime' WHERE username='".$_SESSION['alogin']."'");
        $_SESSION['msg'] = "Password Changed Successfully !!";
    } else {
        $_SESSION['msg'] = "Old Password not match !!";
    }
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
    <title>FootPrint | Change Password</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    <script type="text/javascript">
function valid() {
    if(document.chngpwd.password.value=="") {
        alert("Current Password field is empty !!");
        document.chngpwd.password.focus();
        return false;
    } else if(document.chngpwd.newpassword.value=="") {
        alert("New Password field is empty !!");
        document.chngpwd.newpassword.focus();
        return false;
    } else if(document.chngpwd.confirmpassword.value=="") {
        alert("Confirm Password field is empty !!");
        document.chngpwd.confirmpassword.focus();
        return false;
    } else if(document.chngpwd.newpassword.value != document.chngpwd.confirmpassword.value) {
        alert("Password and Confirm Password fields do not match !!");
        document.chngpwd.confirmpassword.focus();
        return false;
    }
    return true;
}
</script>
</head>
<body class="sb-nav-fixed">
<?php include_once('includes/header.php'); ?>
<div id="layoutSidenav">
    <?php include_once('includes/sidebar.php'); ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4 mb-3">Change Password</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Change Password</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-key me-1"></i> Change Password
                    </div>
                    <div class="card-body">
                        <?php if(isset($_SESSION['msg']) && $_SESSION['msg'] != "") { ?>
                            <div class="alert alert-<?php echo (strpos($_SESSION['msg'], 'Successfully') !== false) ? 'success' : 'danger'; ?> alert-dismissible fade show" role="alert">
                                <?php echo htmlentities($_SESSION['msg']); ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            <?php $_SESSION['msg'] = ""; } ?>
                        <form name="chngpwd" method="post" onSubmit="return valid();">
                            <div class="mb-3 row">
                                <label for="currentPassword" class="col-md-3 col-form-label">Current Password</label>
                                <div class="col-md-6">
                                    <input type="password" class="form-control" id="currentPassword" name="password" placeholder="Enter your current password" required>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="newPassword" class="col-md-3 col-form-label">New Password</label>
                                <div class="col-md-6">
                                    <input type="password" class="form-control" id="newPassword" name="newpassword" placeholder="Enter your new password" required>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="confirmPassword" class="col-md-3 col-form-label">Confirm Password</label>
                                <div class="col-md-6">
                                    <input type="password" class="form-control" id="confirmPassword" name="confirmpassword" placeholder="Enter your new password again" required>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-md-9 offset-md-3">
                                    <button type="submit" name="submit" class="btn btn-primary">Update Password</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
        <?php include_once('includes/footer.php'); ?>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
</body>
</html>