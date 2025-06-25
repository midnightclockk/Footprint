<?php
session_start();
include_once('includes/config.php');
if(strlen($_SESSION["alogin"])==0) { header('location:logout.php'); exit(); }
$uid = intval($_GET['uid']);
$query = mysqli_query($con, "SELECT * FROM users WHERE id='$uid'");
$user = mysqli_fetch_assoc($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>View User | FootPrint Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <style>
        .profile-card { max-width: 500px; margin: 2rem auto; box-shadow: 0 2px 8px rgba(0,0,0,0.07); border-radius: 1rem; padding: 2rem; background: #fff; }
        .profile-label { font-weight: 600; color: #333; }
        .profile-value { color: #555; }
        .badge-active { background: #28a745; color: #fff; padding: 0.3em 0.8em; border-radius: 0.5em; }
        .badge-inactive { background: #dc3545; color: #fff; padding: 0.3em 0.8em; border-radius: 0.5em; }
    </style>
</head>
<body class="sb-nav-fixed">
<?php include_once('includes/header.php');?>
<div id="layoutSidenav">
<?php include_once('includes/sidebar.php');?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">User Profile</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="registered-users.php">Registered Users</a></li>
                    <li class="breadcrumb-item active">View User</li>
                </ol>
                <div class="profile-card">
                    <h3 class="mb-3"><i class="fas fa-user"></i> <?php echo htmlentities($user['name']); ?></h3>
                    <div class="mb-2"><span class="profile-label">Email:</span> <span class="profile-value"><?php echo htmlentities($user['email']); ?></span></div>
                    <div class="mb-2"><span class="profile-label">Contact No:</span> <span class="profile-value"><?php echo htmlentities($user['contactno']); ?></span></div>
                    <div class="mb-2"><span class="profile-label">Registration Date:</span> <span class="profile-value"><?php echo htmlentities($user['regDate']); ?></span></div>
                    <div class="mb-2"><span class="profile-label">Last Update:</span> <span class="profile-value"><?php echo htmlentities($user['updationDate']); ?></span></div>
                    <div class="mb-2"><span class="profile-label">Status:</span> <?php if($user['status']==='Active') { ?><span class="badge-active">Active</span><?php } else { ?><span class="badge-inactive">Inactive</span><?php } ?></div>
                    <div class="mt-4">
                        <a href="registered-users.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
                        <a href="edit-user.php?uid=<?php echo $user['id']; ?>" class="btn btn-primary"><i class="fas fa-edit"></i> Edit</a>
                    </div>
                </div>
            </div>
        </main>
        <?php include_once('includes/footer.php');?>
    </div>
</div>
</body>
</html> 