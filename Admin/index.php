
<?php
session_start();
include('connection.php');
include('../functions/common_function.php');
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
    <section id="headera">
        <a href = "#" ><img src = "" class ="logo"></a>
        <div>
            <ul id = "navbara">
                <?php
                if(!isset($_SESSION['adminname'])){
            echo"<li><a class ='nav-item' href='#'>Welcome User</a></li>";
          }else{
             echo"<li><a class ='nav-item' href='#'>Welcome ".$_SESSION['adminname']."</a></li>";
          }
          ?>
</ul>
</div>
</section>
<section>
    <div id ="managedetails">
        <h3>Manage Details</h3>
</section>
<section class ="admin-section">
    <div class ="admin-info">
      
        <?php 
if(!isset($_SESSION['adminname'])){
   echo" <img src ='https://png.pngtree.com/png-clipart/20200225/original/pngtree-beautiful-admin-roles-line-vector-icon-png-image_5259362.jpg'>
   <h2>Admin Name </h2>";
}else{

    $adminname=$_SESSION['adminname'];
    $admin_image="Select * from `admin_table` where adminname='$adminname'";
    $result_image=mysqli_query($conn,$admin_image);
    $row_image=mysqli_fetch_array($result_image);
    $admin_image= $row_image['admin_image'];
    echo"<img src='./admin_images/$admin_image' alt='User Image'>
    <h2 >$adminname</h1>";
}
    ?>  
</div>
<div class ="buttongroup">
    <button><a href="index.php?insert_product">Insert Product</a></button>
    <button><a href="index.php?view_products">View Product</a></button>
    <button><a href="index.php?insert_category">Insert Category</a></button>
    <button><a href="index.php?view_category">View Category</a></button>
    <button><a href="index.php?insert_brands">Insert Brands</a></button>
    <button><a href="index.php?view_brands">View Brands</a></button>
    <button><a href="index.php?list_orders">All Orders</a></button>
    <button><a href="index.php?list_payment">All Payments</a></button>
    <button><a href="index.php?view_users">List User</a></button>
    <button>
    <?php
    if(!isset($_SESSION['adminname'])){
           echo"<a href='admin_login.php'>Login</a>";
         }else{
            echo"<a href='logout.php'>Logout</a>";
         }
         ?></button>
</div>
</section>
<section class="container_admin">
<div>
<?php
if(isset($_GET['insert_category']))
{
    include('insert_categories.php');
}
if(isset($_GET['insert_brands'])){
    include('insert_brands.php');
}
if(isset($_GET['insert_product'])){
    include('insert_products.php');
}
if(isset($_GET['view_products'])){
    include('view_products.php');
}
if(isset($_GET['edit_products'])){
    include('edit_products.php');
}
if(isset($_GET['remove_product'])){
    include('delete_product.php');
}
if(isset($_GET['view_category'])){
    include('view_category.php');
}
if(isset($_GET['edit_category'])){
    include('edit_category.php');
}
if(isset($_GET['remove_category'])){
    include('delete_category.php');
}
if(isset($_GET['view_brands'])){
    include('view_brands.php');
}
if(isset($_GET['edit_brand'])){
    include('edit_brand.php');
}
if(isset($_GET['remove_brand'])){
    include('delete_brand.php');
}
if(isset($_GET['list_orders'])){
    include('list_orders.php');
}
if(isset($_GET['remove_order'])){
    include('delete_order.php');
}
if(isset($_GET['list_payment'])){
    include('list_payment.php');
}
if(isset($_GET['remove_payment'])){
    include('delete_payment.php');
}
if(isset($_GET['view_users'])){
    include('view_users.php');
}
if(isset($_GET['remove_user'])){
    include('delete_user.php');
}
?>
  </div>
</section>

    
</body>
</html>