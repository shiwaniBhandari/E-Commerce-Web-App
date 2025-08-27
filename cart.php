<?php
session_start();
include('admin_area/connection.php');

include('functions/common_function.php');
if (isset($_POST['update_cart'])) {
   
    $quantities = $_POST['quantity'];
    $ip = getIPAddress();

    foreach($quantities as $product_id => $quantity) {
        $update_query = "UPDATE cart_details SET quantity='$quantity' WHERE ip_address='$ip' AND product_id='$product_id'";
        mysqli_query($conn, $update_query);
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
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/700ef8c0d0.js" crossorigin="anonymous"></script>
</head>
<body>  
<section id="header">
    <div>
        <ul id="navbar">
            <li><a href="0"><img src="./images/logo.png" class="logo" ></a></li>
            <li><a href="index.php">HOME</a></li>
            <li><a href="shop.php">SHOP</a></li>
            <?php
    if(!isset($_SESSION['username'])){
      echo"<li><a href='./users_area/user_registration.php'>REGISTER</a></li>";
    }else{
      echo"<li><a href='./users_area/profile.php'>My Account</a></li>";
    }


    ?>
            <li><a href="about.php">ABOUT</a></li>
            <li><a href="contact.php">CONTACT</a></li>
            <li><a class="active" href="cart.php"><i class="fa-solid fa-cart-shopping"></i></i></a></li>
        </ul>
    </div>
    <div>
        <form method="get" action="search.php">
            <input type="text" id="search" name="query" class="search-input" placeholder="Search...">
            <input type="submit" name="submit" value="Search" class="search-button">
        </form>
    </div>
</section>
<section id="header_login">
        <ul id="navbar_login">
       
        <?php
              if(!isset($_SESSION['username'])){
                echo"<li><a href='#'>Welcome User</a></li>";
              }else{
                 echo"<li><a href='#'>Welcome ".$_SESSION['username']."</a></li>";
              }
         if(!isset($_SESSION['username'])){
           echo"<li><a href='./users_area/user_login.php'>Login</a></li>";
         }else{
            echo"<li><a href='./users_area/logout.php'>Logout</a></li>";
         }
  ?>
</section>
<section id="page_headerr" class="about-header" >
    <h2>Know About Us!</h2>
    <p> There is no one who enjoys suffering, pursues it, or desires it merely for the sake of suffering.</p>
</section>
<section id="cart" class="section-p1">
<form method="post" action="">
        <table width="100%">
            <thead>
                <tr>
                    <td>Images</td>
                    <td>Products</td>
                    <td>Price</td>
                    <td>Remove</td>
                    <td>Quantity</td>
                    <td>Subtotal</td>
                    <td colspan="2">Operations</td>
                </tr>
            </thead>
            <tbody>
            <?php
            
            global $conn;
            $ip = getIPAddress();
            $total_price = 0;
            $cart_query = "SELECT * FROM `cart_details` WHERE ip_address='$ip' ";
            $resultt = mysqli_query($conn, $cart_query);
            
            if ($resultt) {
                while ($row = mysqli_fetch_array($resultt)) {
                    
                    $product_id = $row['product_id'];
                    $select_products = "SELECT * FROM `products` WHERE product_id='$product_id'";
                    $result_products = mysqli_query($conn, $select_products);
            
                    if ($result_products) {
                        while ($row_product_price = mysqli_fetch_array($result_products)) {
                            $product_price = array($row_product_price['product_discount']);
                            $price_table = $row_product_price['product_discount'];
                            $product_name = $row_product_price['product_name'];
                            $product_image1 = $row_product_price['product_img1'];
                            $product_values = array_sum($product_price);
                            $total_price += $product_values * $row['quantity'];
                            ?>
            
                            <tr>
                                <td><img src="./admin_area/uploads/<?php echo $product_image1; ?>"></td>
                                <td><?php echo $product_name; ?></td>
                                <td><?php echo '$' . $price_table; ?></td>
                                <td><input type="checkbox"></td>
                                <td><input type="number" value="<?php echo $row['quantity']; ?>" name="quantity[<?php echo $row['product_id']; ?>]"></td>
                                <td><?php echo '$' . ($product_values * $row['quantity']); ?></td>
                                <td>
                                    <input type="submit" value="Update cart" class="continue-button" name="update_cart">
                                    <input type="submit" value="Remove Item" class="continue-button" name="remove_cart">
                                </td>
                            </tr>
            
                            <?php
                        }
                    } else {
                        // Handle the case where the product query fails
                        echo "Failed to fetch product details.";
                    }
                }
            } else {
                // Handle the case where the cart query fails
                echo "Failed to fetch cart details.";
            }
            ?>
            </tbody>
        </table>
    </form>

</section>
<section id="cart-add" class="section-p1">
    <div id="subtotal">
        <h3>Cart Totals</h3>
        <table>
            <tr>
                <td>Cart Subtotal</td>
                <td><?php echo '$' . $total_price ; ?></td>
            </tr>
            <tr>
                <td>Shipping</td>
                <td>Free</td>
            </tr>
            <tr>
                <td><strong>Total</strong></td>
                <td><strong><?php echo '$' . $total_price; ?></strong></td>
            </tr>
        </table>
       <a href="./users_area/checkout.php"><button class="normal">Proceed to checkout</button></a>
      
    </div>

</section>
<div id="continue-shopping">
        <a href="shop.php" class="continue-button">Continue Shopping</a>
    </div>
<footer class="section-p1">
    <div class="col">
        <img class="logo" src="">
        <h4>contact US</h4>
        <p><strong>Address:</strong> 562 jolygrant road,street 32,Dehradun</p>
        <p><strong>Phone:</strong>+01 2222 365/ (+91) 01 2345 6789</p>
        <p><strong>Hours:</strong>10.00-18;00,Mon- Sat</p>
        <div class="follow">
            <h4>Follow us</h4>
            <div class="icon">
                <i class="fa-brands fa-facebook"></i>
                <i class="fa-brands fa-twitter"></i>
                <i class="fa-brands fa-instagram"></i>
                <i class="fa-brands fa-pinterest"></i>
                <i class="fa-brands fa-youtube"></i>
            </div>
        </div>
    </div>
    <div class="col">
        <h4>About</h4>
        <a href="#">About us</a>
        <a href="#">Delivery information</a>
        <a href="#">Terms and conditions</a>
        <a href="#"> contact us</a>
        <a href="#">privacy and policy</a>
    </div>
    <div class="col">
        <h4>My Account</h4>
        <a href="#">Sign In</a>
        <a href="#">View Cart</a>
        <a href="#">My whishlist</a>
        <a href="#"> Track my order</a>
        <a href="#">Help</a>
    </div>
    <div class="col-install">
        <h4>Install App</h4>
        <p> From App store or Google Play</p>
        <div class="row">
            <img src="">
            <img src="">
        </div>
    </div>
    <div class="copyright">
        <p>10 2023,BCA Project-Graphic Era university.</p>
    </div>
</footer>
</body>
</html>
