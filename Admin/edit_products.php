<?php 

if(isset($_GET['edit_products'])){
  $edit_id=$_GET['edit_products'];
  $get_data="Select * from `products` where product_id= $edit_id";
  $resultt=mysqli_query($conn,$get_data);
  $row=mysqli_fetch_assoc($resultt);
  $product_name=$row['product_name'];
  $product_D=$row['product_D'];
  $product_key=$row['product_key'];
  $category=$row['category_id'];
  $brand_id=$row['brand_id'];
  $product_img1=$row['product_img1'];
  $product_img2=$row['product_img2'];
  $product_img3=$row['product_img3'];
  $product_price=$row['product_price'];
  $product_discount=$row['product_discount'];
}
?>
<?php
if (isset($_POST['submit'])) {
  $product_name = $_POST['product_name'];
  $product_description = $_POST['product_description'];
  $product_key = $_POST['product_key'];
  $category = $_POST['category'];
  $brand = $_POST['brand'];
  $product_price = $_POST['product_price'];
  $product_discount = $_POST['product_disc'];
  $product_img1=$_FILES['product_img1'];
  $product_img2=$_FILES['product_img2'];
  $product_img3=$_FILES['product_img3'];
  $product_image1=$_FILES['product_img1']['name'];
  $product_image2=$_FILES['product_img2']['name'];
  $product_image3=$_FILES['product_img3']['name'];
 
  $temp_image1=$_FILES['product_img1']['tmp_name'];
  $temp_image2=$_FILES['product_img2']['tmp_name'];
  $temp_image3=$_FILES['product_img3']['tmp_name'];
 
  if( $product_name ==''  or  $product_description =='' or  $product_key =='' or  $category =='' or  $brand=='' or  $product_price==''
   or  $product_discount=='' or $product_image1=='' or  $product_image2=='' or $product_image3=='' )
  {
   echo "<script>alert('please fill all the variable fields and continue the process')</script>";
   exit();
  }else{
   move_uploaded_file($temp_image1, "./uploads/$product_image1");
   move_uploaded_file($temp_image2, "./uploads/$product_image2");
   move_uploaded_file($temp_image3, "./uploads/$product_image3");

  // Update the product details in the database
  $update_query = "UPDATE `products` SET `product_name`='$product_name', `product_D`='$product_description', 
  `product_key`='$product_key', `category_id`='$category', `brand_id`='$brand', `product_price`='$product_price',
   `product_discount`='$product_discount'  , `product_img1`='$product_image1' , `product_img2`='$product_image2' , `product_img3`='$product_image3' WHERE `product_id`='$edit_id'";

  $update_result = mysqli_query($conn, $update_query);

  if ($update_result) {
    echo "<script>alert('Product details updated successfully!')</script>";
    echo "<script>window.open('./index.php','_self')</script>";
  } else {
    echo "Error updating product details: " . mysqli_error($conn);
  }
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style.css">
        <script src="https://kit.fontawesome.com/700ef8c0d0.js" crossorigin="anonymous"></script>
        
</head>
<body>
<div class="form-container">
    <h2>Update  product details</h2>
    <form method="post" action="" enctype="multipart/form-data">
  <div class="form-field">
    <label for="product-name">Product Name:</label>
    <input type="text" id="product_name" name="product_name" value="<?php echo $product_name ?>" required>
  </div>

  <div class="form-field">
    <label for="product-description">Product Description:</label>
    <input type="text" id="product_description" name="product_description"   value="<?php echo $product_D ?>" required>
  </div>

  <div class="form-field">
    <label for="product-key">Product Key:</label>
    <input type="text" id="product_key" name="product_key"  value="<?php echo $product_key ?>" required>
  </div>

  <div class="form-field">
    <label for="category">Category:</label>
    <select id="category" name="category" required>
      <option value="">Select a category</option>
      <?php
      $select_query = "SELECT * FROM category";
      $result_query = mysqli_query($conn, $select_query);
      while ($row = mysqli_fetch_assoc($result_query)) {
        $category_name = $row['category_name'];
        $category_id = $row['category_id'];
        echo "<option value='$category_id'>$category_name</option>";
      }
      ?>
    </select>
  </div>

  <div class="form-field">
    <label for="brand">Brand:</label>
    <select id="brand" name="brand" required>
      <option value="">Select a brand</option>
      <?php
      $select_query = "SELECT * FROM brands";
      $result_query = mysqli_query($conn, $select_query);
      while ($row = mysqli_fetch_assoc($result_query)) {
        $brand_name = $row['brand_name'];
        $brand_id = $row['brand_id'];
        echo "<option value='$brand_id'>$brand_name</option>";
      }
      ?>
    </select>
  </div>

  <div class="form-field">
    <label for="product-img1">Insert product image 1:</label>
    <input type="file" id="product_img1" name="product_img1" accept="image/*" required>
    <?php
    // Display current image for product image 1
    // Replace 'current_image_1.jpg' with the actual image file name or URL
  
    echo "<img src='./uploads/$product_img1' alt='Current Image 1' width='100' style='margin-top: 10px; border-radius:50%'>";
    ?>
  </div>

  <div class="form-field">
    <label for="product-img2">Insert product image 2:</label>
    <input type="file" id="product_img2" name="product_img2" accept="image/*" required>
    <?php
    // Display current image for product image 2
    // Replace 'current_image_2.jpg' with the actual image file name or URL
   
    echo "<img src='./uploads/$product_img2' alt='Current Image 2' width='100' style='margin-top: 10px;border-radius:50%''>";
    ?>
  </div>

  <div class="form-field">
    <label for="product-img3">Insert product image 3:</label>
    <input type="file" id="product_img3" name="product_img3" accept="image/*" required>
    <?php
    // Display current image for product image 3
    // Replace 'current_image_3.jpg' with the actual image file name or URL
    $current_image_3 = 'current_image_3.jpg';
    echo "<img src='./uploads/$product_img3' alt='Current Image 3' width='100' style='margin-top: 10px;border-radius:50%''>";
    ?>
  </div>

  <div class="form-field">
    <label for="product-price">Product Original Price:</label>
    <input type="text" id="product-price" name="product_price" value="<?php echo $product_price ?>" required>
  </div>

  <div class="form-field">
    <label for="product-Disc">Product Discounted Price:</label>
    <input type="text" id="product-price" name="product_disc" value="<?php echo $product_discount ?>" required>
  </div>

  <div class="form-field">
    <input type="submit" value="Submit" name="submit">
  </div>
</form>

  </div>
</body>
</html>