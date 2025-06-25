<?php
include('include/config.php');
// Set one order's status to Delivered for testing
$sql = "UPDATE orders SET orderStatus='Delivered' WHERE orderStatus IS NULL OR orderStatus='' LIMIT 1";
$result = mysqli_query($con, $sql);
if($result && mysqli_affected_rows($con) > 0) {
    echo "Success: One order marked as Delivered.";
} else {
    echo "No eligible order found or update failed.";
}
?> 