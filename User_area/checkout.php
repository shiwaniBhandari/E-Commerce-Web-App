<?php
session_start();
include('../admin_area/connection.php');
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
<section id="header">
    <div>
        <ul id="navbar">
            <li><a href="0"><img src="../images/logo.png" class="logo" ></a></li>
            <li><a href="../index.php">HOME</a></li>
            <li><a href="../shop.php">SHOP</a></li>
            <?php
    if(!isset($_SESSION['username'])){
      echo"<li><a href='user_registration.php'>REGISTER</a></li>";
    }else{
      echo"<li><a href='profile.php'>My Account</a></li>";
    }


    ?>
            <li><a href="../about.php">ABOUT</a></li>
            <li><a href="../contact.php">CONTACT</a></li>
            <li><a class="active" href="../cart.php"><i class="fa-solid fa-cart-shopping"></i></i></a></li>
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
           echo"<li><a href='./user_login.php'>Login</a></li>";
         }else{
            echo"<li><a href='./logout.php'>Logout</a></li>";
         }
  ?>
</section>
<section>
    <?php
    if(!isset($_SESSION['username'])){
        include('user_login.php');
    }else{
        include('payment.php');
    }
    ?>
    </section>

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