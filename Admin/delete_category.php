<?php
// Assuming you have a database connection established

// Check if the category ID is provided in the URL
if (isset($_GET['remove_category'])) {
    $categoryId = $_GET['remove_category'];
    
    // Delete the category from the database
    $deleteQuery = "DELETE FROM category WHERE category_id = $categoryId";
    $deleteResult = mysqli_query($conn, $deleteQuery);
    
    if ($deleteResult) {
        echo "<script>alert('Category deleted successfully!')</script>";
    echo "<script>window.open('./index.php?view_category','_self')</script>";
        exit;
    } else {
        echo 'Error deleting category: ' . mysqli_error($conn);
    }
} else {
    echo 'Category ID not provided.';
    exit;
}
?>
