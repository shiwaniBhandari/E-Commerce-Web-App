<?php
include('connection.php');
if(isset($_POST['submit'])){
 $product_name = $_POST['product_name'];
 $product_description=$_POST['product_description'];
 $product_key=$_POST['product_key'];
 $product_category=$_POST['category'];
 $product_brand=$_POST['brand'];
 $product_price=$_POST['product_price'];
 $product_disc=$_POST['product_disc'];
 $product_status='true';


 $product_image1=$_FILES['product_img1']['name'];
 $product_image2=$_FILES['product_img2']['name'];
 $product_image3=$_FILES['product_img3']['name'];

 $temp_image1=$_FILES['product_img1']['tmp_name'];
 $temp_image2=$_FILES['product_img2']['tmp_name'];
 $temp_image3=$_FILES['product_img3']['tmp_name'];

 if( $product_name ==''  or  $product_description =='' or  $product_key =='' or  $product_category =='' or  $product_brand=='' or  $product_price==''
  or  $product_disc=='' or $product_image1=='' or  $product_image2=='' or $product_image3=='' )
 {
  echo "<script>alert('please fill all the variable fields')</script>";
  exit();
 }else{
  move_uploaded_file($temp_image1, "./uploads/$product_image1");
  move_uploaded_file($temp_image2, "./uploads/$product_image2");
  move_uploaded_file($temp_image3, "./uploads/$product_image3");

  $insert_products = "INSERT INTO `products` (product_name, product_D, Product_key, category_id, brand_id, product_img1, product_img2, product_img3, product_price, product_discount, Date, status)
  VALUES ('$product_name', '$product_description', '$product_key', '$product_category', '$product_brand', '$product_image1', '$product_image2', '$product_image3', '$product_price', '$product_disc', NOW(), '$product_status')";  
  $result_query=mysqli_query($conn,  $insert_products);
  if( $result_query){
    echo "<script>alert('successfully inserted the product')</script>";
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
    <h2>Product Form</h2>
    <form  method ="post" action="" enctype="multipart/form-data">
      <div class="form-field">
        <label for="product-name">Product Name:</label>
        <input type="text" id="product_name" name="product_name" required>
      </div>
      
      <div class="form-field">
        <label for="product-description">Product Description:</label>
        <input type="text" id="product_description" name="product_description" required>
      </div>
      
      <div class="form-field">
        <label for="product-key">Product Key:</label>
        <input type="text" id="product_key" name="product_key" required>
      </div>
      
      <div class="form-field">
        <label for="category">Category:</label>
        <select id="category" name="category" required>
          <option value="">Select a category</option>
          <?php
          $select_query = "Select * From category";
          $result_query = mysqli_query($conn,  $select_query);
        while($row=mysqli_fetch_assoc($result_query)){
          $category_name=$row['category_name'];
          $category_id=$row['category_id'];
          echo "  <option value=' $category_id'>$category_name</option>";

        }
        ?>
        </select>
      </div>
      <div class="form-field">
        <label for="brand">Brand:</label>
        <select id="brand" name="brand" required>
          <option value="">Select a brand</option>
          <?php
          $select_query = "Select * From brands";
          $result_query = mysqli_query($conn,  $select_query);
        while($row=mysqli_fetch_assoc($result_query)){
          $brand_name=$row['brand_name'];
          $brand_id=$row['brand_id'];
          echo "  <option value=' $brand_id'>$brand_name</option>";

        }
        ?>
          
        </select>
      </div>

      
      <div class="form-field">
        <label for="product-img1">Insert product image 1</label>
        <input type="file" id="product_img1" name="product_img1" accept="image/*" required>
      </div>
      <div class="form-field">
        <label for="product-img2">Insert product image 2</label>
        <input type="file" id="product-img2" name="product_img2" accept="image/*" required>
      </div>
      <div class="form-field">
        <label for="product-img3">Insert product image 3</label>
        <input type="file" id="product-img3" name="product_img3" accept="image/*" required>
      </div>
      <div class="form-field">
        <label for="product-price">Product Original Price:</label>
        <input type="text" id="product-price" name="product_price" required>
      </div>
      <div class="form-field">
        <label for="product-Disc">Product Discounted Price:</label>
        <input type="text" id="product-price" name="product_disc" required>
      </div>
      
      <div class="form-field">
        <input type="submit" value="Submit" name="submit">
      </div>
      </form>
  </div>
</body>
</html>

