<?php
include('admin/include/config.php');

// Function to create directory if it doesn't exist
function createDirectory($path) {
    if (!file_exists($path)) {
        mkdir($path, 0777, true);
        echo "Created directory: {$path}<br>";
    }
}

// Function to copy directory contents
function copyDirectory($source, $destination) {
    if (!is_dir($source)) {
        echo "Source directory $source does not exist<br>";
        return false;
    }
    
    if (!is_dir($destination)) {
        mkdir($destination, 0777, true);
    }
    
    $files = scandir($source);
    foreach ($files as $file) {
        if ($file != "." && $file != "..") {
            copy($source . '/' . $file, $destination . '/' . $file);
        }
    }
    return true;
}

// Create productimages directory if it doesn't exist
$base_dir = 'admin/productimages';
createDirectory($base_dir);

// First, let's backup the current images
$backup_dir = 'admin/productimages_backup_' . date('Y_m_d_H_i_s');
createDirectory($backup_dir);
if (is_dir($base_dir)) {
    $files = scandir($base_dir);
    foreach ($files as $file) {
        if ($file != "." && $file != ".." && is_dir($base_dir . '/' . $file)) {
            copyDirectory($base_dir . '/' . $file, $backup_dir . '/' . $file);
        }
    }
}

// Get all products with their images
$query = mysqli_query($con, "SELECT id, productImage1, productImage2, productImage3 FROM products ORDER BY id");
if (!$query) {
    die("Database error: " . mysqli_error($con));
}

// Create mapping of old to new IDs
$id_mapping = array();
$new_id = 1;
while ($row = mysqli_fetch_assoc($query)) {
    $id_mapping[$row['id']] = $new_id;
    $new_id++;
}

// Reset the query pointer
mysqli_data_seek($query, 0);

// Process each product
while ($row = mysqli_fetch_assoc($query)) {
    $old_id = $row['id'];
    $new_id = $id_mapping[$old_id];
    
    // Create new directory
    $new_dir = $base_dir . '/' . $new_id;
    createDirectory($new_dir);
    
    // Copy images from old directory to new
    $old_dir = $base_dir . '/' . $old_id;
    if (is_dir($old_dir)) {
        copyDirectory($old_dir, $new_dir);
        echo "Copied images from ID $old_id to $new_id<br>";
    }
}

// Update database IDs
$queries = array(
    "SET @count = 0",
    "UPDATE products SET id = @count:= @count + 1 ORDER BY id",
    "ALTER TABLE products AUTO_INCREMENT = 1"
);

foreach ($queries as $sql) {
    if (!mysqli_query($con, $sql)) {
        echo "Error executing query: " . mysqli_error($con) . "<br>";
    }
}

echo "<br>Process completed. Please verify that:<br>";
echo "1. All product IDs have been reset<br>";
echo "2. Image folders have been properly renamed<br>";
echo "3. All images are displaying correctly on the website<br>";
echo "4. A backup of your images has been created in: $backup_dir<br>";
?> 