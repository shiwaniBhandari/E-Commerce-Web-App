
<?php
session_start();
include('functions/common_function.php');
include('admin_area/connection.php');

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
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="styles.css">
        <script src="https://kit.fontawesome.com/700ef8c0d0.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    </head>
    <body>
        <section id="header">
        
        <div>


<ul id="navbar">
  <li><a href="0"><img  src="./images/logo.png" class="logo" ></a></li>
    <li><a class="active" href="index.php">HOME</a></li>
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
      <section id="hero">
        <h4>Trade-in-offer</h4>
        <h2>Super value deals</h2>
        <h1>On all products</h1>
        <p>Save more with amazing deals & upto 80% off!</p>
        <button>Shop now</button>
      </section>

      </section>
      <section id="features" class="section-p1">
        <div class="fe-box">
            <img src="https://media.istockphoto.com/id/1302438914/vector/fast-delivery-truck-icon-fast-shipping-design-for-website-and-mobile-apps-vector-illustration.jpg?s=612x612&w=0&k=20&c=1aEygfLbr7XCq2Lr61qrrFS2SjY6cVccOySPu_N7gww=" alt="" width="190" height="140">
            <h3>Free Shipping</h3>

        </div>
        <div class="fe-box">
            <img src="https://img.freepik.com/free-vector/taking-orders-by-phone-store-contact-center-customers-support-easy-order-fast-delivery-trade-service-call-center-operator-cartoon-character_335657-2564.jpg?w=360" alt="" width="190" height="140">
            <h3>Online Order</h3>

        </div>
        <div class="fe-box">
            <img src="https://img.freepik.com/premium-vector/boy-saving-money-piggy-bank_7710-173.jpg?w=2000" alt="" width="190" height="140">
            <h3>Save Money</h3>

        </div>
        <div class="fe-box">
            <img src="https://cdn.dribbble.com/users/66052/screenshots/10007568/social-media-marketing.png" alt="" width="190" height="140">
            <h3>Promotion</h3>

        </div>
        <div class="fe-box">
            <img src="https://rockpapersimple.com/wp-content/uploads/2015/09/experiences-sell.png" alt="" width="190" height="140">
            <h3>Happy Sell</h3>

        </div>
        
    </div>
    <div class="fe-box">
        <img src="https://www.pngitem.com/pimgs/m/677-6775515_transparent-government-clipart-icon-back-office-support-hd.png" alt="" width="190" height="140">
        <h3>F24/7 Support</h3>

    </div>
      </section>
      <section id ="banner2">
    <div class="banner-box">
        <h2>Face Products</h2>
        <h3>70% Off On Each face Product</h3>
    </div>
    <div class="banner-box banner-box2">
        <h2>URBAN FASHION</h2>
        <h3>PROVE YOUR GENERATION URBAN STYLE</h3>
    </div>
    <div class="banner-box banner-box3">
        <h2>Seasonable Sale</h2>
        <h3> Winter Collection -50% OFf</h3>
    </div>
</section>

      <section class="cati">
        <h2>Categories!</h2>
        <p>Shop According Your Need</p>
        </section>

      
    <section id="bodyy">
      <section class="container">
        <img class="control prev" src="images/img1.png" alt="">
 
        <div class="slider">
          <?php
         getcategories();
          ?>
            </div>
            <img class="control next" src="images/img2.png" alt="">
        </section>
    </section>
    <section id ="sm-banner" class="section-p1">
    <div class="banner-box">
        <h4> CRAZY DEALS </h4>
        <h2>Buy 1 Get 1 Free</h2>
        <span>The best classic Dress is on sale at cara</span>
        <button class="white"><a href="shop.php">More</a></button>
    </div>
    <div class="banner-box banner-box2">
        <h4> Spring / Summer.</h4>
        <h2>Upcoming season</h2>
        <span>The best classic Dress is on sale at cara</span>
        <button class="white"><a href="shop.php">Collection</a></button>
    </div>
</section>
    <section class="cati">
        <h2>Brands!</h2>
        <p>Brands that You love</p>
        </section>

      
    <section id="bodyb">
      <section class="containerb">
        <img class="controlb prevb" src="images/img1.png" alt="">
 
        <div class="sliderb">
            <?php
           getbrands();
            ?>     

            </div>
            <img class="controlb nextb" src="images/img2.png" alt="">
        </section>
        </section>
        <section id="banner" class="section-m1">
        <h3><b>Repair services</b></h3>
        <h2>Up to <span>60% Off</span> -All Dresses & Accessories</h2>
        <button class="normal"><a href="shop.php">Explore more</a></button>
    </section>
    <section class="cati">
        <h2 > Featured products</h2>
        <p>Top pickup for you</p>
        </section>
        <section>
       <div>
        <main>
    <?php
getfeproducts()
    ?>
    </main>
        </div>
</section>



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