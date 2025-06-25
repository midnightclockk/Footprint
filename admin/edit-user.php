<?php
session_start();
include_once('includes/config.php');
if(strlen($_SESSION["alogin"])==0) { header('location:logout.php'); exit(); }
$uid = intval($_GET['uid']);
$msg = '';
if(isset($_POST['update'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $contact = mysqli_real_escape_string($con, $_POST['contactno']);
    $status = $_POST['status'] === 'Active' ? 'Active' : 'Inactive';
    $sql = "UPDATE users SET name='$name', email='$email', contactno='$contact', status='$status', updationDate=NOW() WHERE id='$uid'";
    if(mysqli_query($con, $sql)) {
        $msg = '<div class="alert alert-success">User updated successfully.</div>';
    } else {
        $msg = '<div class="alert alert-danger">Update failed. Please try again.</div>';
    }
}
$query = mysqli_query($con, "SELECT * FROM users WHERE id='$uid'");
$user = mysqli_fetch_assoc($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Edit User | FootPrint Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <style>
        .edit-card { max-width: 500px; margin: 2rem auto; box-shadow: 0 2px 8px rgba(0,0,0,0.07); border-radius: 1rem; padding: 2rem; background: #fff; }
        .form-label { font-weight: 600; }
    </style>
</head>
<body class="sb-nav-fixed">
<?php include_once('includes/header.php');?>
<div id="layoutSidenav">
<?php include_once('includes/sidebar.php');?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Edit User</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="registered-users.php">Registered Users</a></li>
                    <li class="breadcrumb-item active">Edit User</li>
                </ol>
                <div class="edit-card">
                    <?php echo $msg; ?>
                    <form method="post">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo htmlentities($user['name']); ?>" required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="<?php echo htmlentities($user['email']); ?>" required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Contact No</label>
                            <input type="text" name="contactno" class="form-control" value="<?php echo htmlentities($user['contactno']); ?>" required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select" required>
                                <option value="Active" <?php if($user['status']==='Active') echo 'selected'; ?>>Active</option>
                                <option value="Inactive" <?php if($user['status']==='Inactive') echo 'selected'; ?>>Inactive</option>
                            </select>
                        </div>
                        <div class="mt-4">
                            <button type="submit" name="update" class="btn btn-success"><i class="fas fa-save"></i> Save</button>
                            <a href="view-user.php?uid=<?php echo $user['id']; ?>" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </main>
        <?php include_once('includes/footer.php');?>
    </div>
</div>
</body>
</html> 