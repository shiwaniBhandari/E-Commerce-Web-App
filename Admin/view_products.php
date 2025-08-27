<?php

include('connection.php');
if (isset($_GET['delete_product'])) {
  $productId = $_GET['delete_product'];
  
  // Display confirmation message
  echo "<script>
          var result = confirm('Are you sure you want to delete this brand?');
          if (result) {
              window.location.href = 'index.php?remove_brand=$productId';
          } else {
              window.location.href = 'index.php?view_products';
          }
        </script>";
  exit;
}

?>

<!DOCTYPE html>
<html>
<head>
  <title>Product Table</title>
  <style>
    table {
      border-collapse: collapse;
      width: 100%;
    }
    
    th, td {
      padding: 10px;
    }
    
    th {
      background-color: #333;
      color: #fff;
      text-align: left;
    }
    
    td {
      border-bottom: 1px solid #ddd;
    }
    
    img {
      max-width: 100px;
      height: auto;
    }
    
    .status {
      display: inline-block;
      padding: 5px 10px;
      border-radius: 5px;
      color: #fff;
      font-weight: bold;
    }
    
    .active {
      background-color: green;
    }
    
    .inactive {
      background-color: red;
    }
    
    .edit-button, .delete-button {
      padding: 5px 10px;
      border: none;
      border-radius: 5px;
      color: white;
      cursor: pointer;
    }
    
    .edit-button {
      background-color: Blue ;
    }
    
    .delete-button {
      background-color: red;
    }
  </style>
</head>
<body>
  <table>
    <thead>
      <tr>
        <th>Product ID</th>
        <th>Product Title</th>
        <th>Product Image</th>
        <th>Product Original Price</th>
        <th>Product Discounted Price</th>
        <th>Total Sold</th>
        <th>Status</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
        <?php
        $get_products="Select * from `products`";
        $resultt=mysqli_query($conn,$get_products);
        $number=0;
        while($row=mysqli_fetch_assoc($resultt)){
            $number++;
            $product_id=$row['product_id'];
            $product_title=$row['product_name'];
            $product_image=$row['product_img1'];
            $product_price=$row['product_price'];
            $product_discount=$row['product_discount'];
            $status=$row['status'];
           
            ?>
             <tr>
            <td><?php echo $number ?></td>
            <td><?php echo $product_title?></td>
            <td><img src='./uploads/<?php echo $product_image; ?>' alt=''></td>
            <td><?php echo $product_price ?></td>
            <td><?php echo $product_discount ?></td>
            <td><?php 
             
             $get_count = "SELECT SUM(quantity) AS total_quantity FROM `orders_pending` WHERE product_id = $product_id";
             $resultt_count = mysqli_query($conn, $get_count);
             $row_count = mysqli_fetch_assoc($resultt_count);
             $total_quantity = $row_count['total_quantity'];
             echo $total_quantity;
             ?></td>
            <td><span class='status active'><?php echo $status ?></span></td>
            <td><a href='index.php?edit_products=<?php echo  $product_id ?>'><button class='edit-button'><i class='fa-solid fa-pen-to-square'></i></button></a></td>
            <td><a href='view_products.php?delete_product=<?php echo  $product_id ?>'><button class='delete-button'><i class='fa-solid fa-trash'></i></button></a></td>
          </tr>
          <?php
        }
    ?>
    
    
    </tbody>
  </table>
</body>
</html>