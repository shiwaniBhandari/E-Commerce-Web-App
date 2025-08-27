<?php
// Assuming you have a database connection established with $conn

// Check if the edit_brand parameter is present in the URL
if (isset($_GET['edit_brand'])) {
    $brandId = $_GET['edit_brand'];
    
    // Fetch the brand data from the database
    $query = "SELECT * FROM brands WHERE brand_id = $brandId";
    $result = mysqli_query($conn, $query);
    $brand = mysqli_fetch_assoc($result);
    
    // Check if the form is submitted
    if (isset($_POST['submit'])) {
        $brandName = $_POST['brand_name'];
        
        // Check if a new image is uploaded
        if ($_FILES['brand_image']['error'] === UPLOAD_ERR_OK) {
            $tmpImage = $_FILES['brand_image']['tmp_name'];
            $newImage = './brandsupload/' . $_FILES['brand_image']['name'];
            
            // Move the uploaded image to the desired location
            move_uploaded_file($tmpImage, $newImage);
            
            // Update the brand with the new image
            $updateQuery = "UPDATE brands SET brand_name = '$brandName', brand_img = '$newImage' WHERE brand_id = $brandId";
        } else {
            // Update the brand without changing the image
            $updateQuery = "UPDATE brands SET brand_name = '$brandName' WHERE brand_id = $brandId";
        }
        
        $updateResult = mysqli_query($conn, $updateQuery);
        
        if ($updateResult) {
            echo "<script>alert('Category details updated successfully!')</script>";
            echo "<script>window.open('./index.php','_self')</script>";
            exit;
        } else {
            echo 'Error updating brand: ' . mysqli_error($conn);
        }
    }
}

?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Brand</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <style>
   
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

<h2>Edit Brand</h2>

<form method="POST" action="" enctype="multipart/form-data">
  <label for="brand_name">Brand Name:</label>
  <input type="text" id="brand_name" name="brand_name" value="<?php echo $brand['brand_name']; ?>" required>
  <br><br>
  <label for="brand_image">Brand Image:</label>
  <input type="file" id="brand_image" name="brand_image">
  <br><br>
  <label>Previous Image:</label>
  <br>
  <?php if (!empty($brand['brand_img'])) : ?>
    <img src="./brandsupload/<?php echo $brand['brand_img']; ?>" alt="Previous Image" width="100">
  <?php else : ?>
    <span>No previous image</span>
  <?php endif; ?>
  <br><br>
  <input type="submit" name="submit" value="Update">
</form>

</body>
</html>
