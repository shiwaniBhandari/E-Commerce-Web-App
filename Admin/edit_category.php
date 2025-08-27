<?php
// Assuming you have a database connection established

// Check if the category ID is provided in the URL
if (isset($_GET['edit_category'])) {
    $categoryId = $_GET['edit_category'];
    
    // Fetch category details from the category table based on the provided category ID
    $query = "SELECT * FROM category WHERE category_id = $categoryId";
    $result = mysqli_query($conn, $query);
    $category = mysqli_fetch_assoc($result);
    
    // Check if the category exists
    if (!$category) {
        echo 'Category not found.';
        exit;
    }
} else {
    echo 'Category ID not provided.';
    exit;
}

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Get the updated category name from the form
    $updatedCategoryName = $_POST['category_name'];
    
    // Check if a new image is uploaded
    if ($_FILES['category_image']['error'] === UPLOAD_ERR_OK) {
        $tmpName = $_FILES['category_image']['tmp_name'];
        $imageName = $_FILES['category_image']['name'];
       
        
        // Move the uploaded image to the desired location
        move_uploaded_file($tmpName, "./uploads/$imageName");
        
        // Update the category image and name in the database
        $updateQuery = "UPDATE category SET category_name = '$updatedCategoryName', category_img = '$imageName' WHERE category_id = $categoryId";
    } else {
        // Update the category name only in the database
        $updateQuery = "UPDATE category SET category_name = '$updatedCategoryName' WHERE category_id = $categoryId";
    }
    
    $updateResult = mysqli_query($conn, $updateQuery);
    
    if ($updateResult) {
        echo "<script>alert('Category details updated successfully!')</script>";
    echo "<script>window.open('./index.php','_self')</script>";
    } else {
        echo 'Error updating category: ' . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Category</title>
  <style>
    body {
      font-family: Arial, sans-serif;
    }

    h2 {
      color: #333;
    }

    form {
      max-width: 400px;
      margin: 0 auto;
    }

    label {
      display: block;
      margin-bottom: 8px;
      font-weight: bold;
    }

    input[type="text"],
    input[type="file"] {
      width: 100%;
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    input[type="file"] {
      margin-bottom: 16px;
    }

    .previous-image {
      display: block;
      margin-bottom: 16px;
    }

    .previous-image img {
      max-width: 200px;
      max-height: 200px;
    }

    input[type="submit"] {
      display: block;
      width: 100%;
      padding: 12px;
      margin-top: 16px;
      background-color: #4CAF50;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 16px;
    }

    input[type="submit"]:hover {
      background-color: #45a049;
    }
  </style>
</head>
<body>

<h2>Edit Category</h2>

<form method="POST" action="" enctype="multipart/form-data">
  <label for="category_name">Category Name:</label>
  <input type="text" id="category_name" name="category_name" value="<?php echo $category['category_name']; ?>" required>
  <br><br>
  <label for="category_image">Category Image:</label>
  <input type="file" id="category_image" name="category_image">
  <br><br>
  <label>Previous Image:</label>
  <br>
  <?php if (!empty($category['category_img'])) : ?>
    <img src="./uploads/<?php echo $category['category_img']; ?>" alt="Previous Image" width="100">
  <?php else : ?>
    <span>No previous image</span>
  <?php endif; ?>
  <br><br>
  <input type="submit" name="submit" value="Update">
</form>

</body>
</html>
