<?php 
session_start();
include('functions/common_function.php');
include('admin_area/connection.php');

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
    <link rel="stylesheet" href="style.css">
</head>


<body>  
     
<section id="header">
<div>


<ul id="navbar">
  <li><a href="0"><img src="./images/logo.png" class="logo" ></a></li>
    <li><a  href="index.php">HOME</a></li>
    <li><a href="shop.php">SHOP</a></li>
    <?php
    if(!isset($_SESSION['username'])){
      echo"<li><a href='./users_area/user_registration.php'>REGISTER</a></li>";
    }else{
      echo"<li><a href='./users_area/profile.php'>My Account</a></li>";
    }


    ?>
    <li><a  class="active" href="about.php">ABOUT</a></li>
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
        <section id="page_header" >
            <h2>#STAYHOME</h2>
            <p> Save more with coupns & upto 80% off!</P>
            </section>
            
            <section id="about-head" class="section-p1">
                <img src=https://img.freepik.com/vecteurs-premium/homme-femme-sont-assis-bureau-ordinateur-portable-zone-texte-au-dessus-eux_534019-299.jpg alt="">
                <div>
                    <h2>Who We Are?</h2>
                    <p>HEY! HELLO! NAMASTE! Welcome to our online store! We are passionate about providing 
                     you with a seamless and enjoyable shopping experience. At our e-commerce website,
                     we offer a wide range of high-quality products to cater to your diverse needs.
                     Whether you're searching for the latest fashion trends, innovative gadgets, home essentials, or unique gifts,
                     we've got you covered. Our dedicated team works tirelessly to curate an extensive collection of products from reputable brands and artisans worldwide.
                     With our user-friendly interface, secure payment options, and fast shipping, we strive to make your online shopping experience convenient, reliable, and delightful.
                     Customer satisfaction is our top priority, and we are committed to offering exceptional customer service.
                      Explore our store, discover incredible deals, and embark on a memorable shopping journey with us. </p>
                      

                      <abbr title="">Thank you for choosing us as your preferred online shopping destination!</abbr> 

                      <br><br><br><br>

                      <marquee bgcolor="#ccc" loop="-1" scrollamount="5" width="100%">create a stunning images with as much or as little we control as youlike thanks
                        to a choice of basic and creative modes.
                      </marquee>
                   
                </div>
            </section>

                </div>
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
                  <a href="#">Sign In</a>
                  <a href="#">View Cart</a>
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
                  <script src="main.js"></script>
          
              </body>
          </html>