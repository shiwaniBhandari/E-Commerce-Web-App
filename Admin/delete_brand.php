<?php
// Assuming you have a database connection established with $conn

// Check if the delete_brand parameter is present in the URL
if (isset($_GET['remove_brand'])) {
    $brandId = $_GET['remove_brand'];
    
    // Delete the brand from the database
    $deleteQuery = "DELETE FROM brands WHERE brand_id = $brandId";
    $deleteResult = mysqli_query($conn, $deleteQuery);
    
    if ($deleteResult) {
        echo "<script>alert('Brand deleted successfully!')</script>";
        echo "<script>window.open('./index.php?view_brands','_self')</script>";
        exit;
    } else {
        echo 'Error deleting brand: ' . mysqli_error($conn);
    }
}
?>
