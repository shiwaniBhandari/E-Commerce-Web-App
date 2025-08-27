<?php
session_start();
include('admin_area/connection.php');
include('functions/common_function.php');

if (isset($_POST["submit"])) {
    $email = $_POST["email"];

    // Insert the email into the database
    $sql = "INSERT INTO newsletter_emails(email) VALUES ('$email')";

    if ($conn->query($sql) === TRUE) {
        echo " <script>alert('Thank you for subscribing!')</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="font/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <script src="https://kit.fontawesome.com/700ef8c0d0.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<section id="header">
<div>


<ul id="navbar">
  <li><a href="0"><img src="./images/logo.png" class="logo" ></a></li>
    <li><a  href="index.php">HOME</a></li>
    <li><a class="active" href="shop.php">SHOP</a></li>
    <?php
    if(!isset($_SESSION['username'])){
      echo"<li><a href='./users_area/user_registration.php'>REGISTER</a></li>";
    }else{
      echo"<li><a href='./users_area/profile.php'>My Account</a></li>";
    }


    ?>
    <li><a href="about.php">ABOUT</a></li>
    <li><a href="contact.php">CONTACT</a></li>
    <li><a href="cart.php"><i class="fa-solid fa-cart-shopping"></i><sup><?php cart_item();?></sup></a></li>
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
    <main>

    <?php 
      getproducts();
      get_unique_categories();
      get_unique_brand();
  
  ?>

  <?php
  cart();
  ?>
  </main>
    <section class="newsletter-section">
        <section>
        <h2>#Signup for our Newsletter</h2>
        <p>Get updates on our latest offers and promotions!</p>
</section>
        <form class="newsletter-form"  action="" onsubmit="validateEmail(event)" method="POST">
            <input type="email" id="email" name="email" class="newsletter-input" placeholder="Enter your email to get the updates" required>
            <input type="submit" name="submit" class="newsletter-button" value="Subscribe">
        </form>
    </section>

    <footer class="section-p1">
      <div class="col">
        <img class="logo" src="">
        <h4>Contact</h4>
        <p><Strong>Address:</Strong>562 Jolygrant road,Street 32,Dehradun</p>
        <p><Strong>Phone:</Strong>+01 2222 365 /(+91) 01 2345 6789</p>
        <p><Strong>Hours:</Strong>10:00 - 18:00, Mon - Sat</p>
        <div class="follow">
          <h4>Follow Us</h4>
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
        <a href="#">About Us</a>
        <a href="#">Delivery information</a>
        <a href="#">Terms and Condition</a>
        <a href="#">Contact us</a>
        <a href="#">Privacy policy</a>

      </div>
      <div class="col">
        <h4>My Account</h4>
        <a href="./users_area/login.php">Sign In</a>
        <a href="./cart.php">View Cart</a>
        <a href="#">My Wishlist</a>
        <a href="#">Track My Order</a>
        <a href="#">Help</a>
      </div>
        <div class="col install">
          <h4>Install App</h4>
          <p>From App Store Or Google Play</p>
          <div class="row">
            <img src="">
            <img src="">
          </div>
          </div>
          <div class="copyright">
            <p>© 2023, BCA Project - Graphic Era University</p>
         
        </div>
    </footer>
</body>
</html>