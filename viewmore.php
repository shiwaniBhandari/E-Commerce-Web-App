<?php
session_start();
include('admin_area/connection.php');
include('functions/common_function.php');



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <link rel="stylesheet" href="styles.css">
    <script src="https://kit.fontawesome.com/700ef8c0d0.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
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
   
      
      <section class="view">
<h1>Product View More</h1>

<?php
// Connect to the database (replace 'hostname', 'username', 'password', and 'dbname' with your database credentials)

$loggedIn = isset($_SESSION['username']);
if (!$loggedIn){
    $redirect = urlencode('viewmore.php?product_id=' . $product_id);
    echo '<script>window.location.href = "./users_area/user_login.php?redirect=' . $redirect . '";</script>';
    exit();
}

$product_id = $_GET['product_id']; // Assuming the product ID is passed in the URL parameter


  $username = $_SESSION['username'];
// Create the ratings table if it doesn't exist
$sql = "CREATE TABLE IF NOT EXISTS ratings (
      id INT(11) AUTO_INCREMENT PRIMARY KEY,
      username varchar(25) NOT NULL,
      product_id INT(11) NOT NULL,
      rating FLOAT(2,1) NOT NULL,
      review TEXT,
      date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
$conn->query($sql);
// Retrieve the product details from the database
$product_id = $_GET['product_id']; // Assuming the product ID is passed in the URL parameter
$sql = "SELECT * FROM products WHERE product_id = $product_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $product = $result->fetch_assoc();

  // Get average rating and reviews from the database
// Get average rating and reviews from the database
$sql = "SELECT AVG(rating) AS average_rating, COUNT(*) AS total_reviews FROM ratings WHERE product_id = $product_id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$averageRating = round($row['average_rating'], 2); // Round the average rating to two decimal places
$totalReviews = $row['total_reviews'];

} else {
  echo "<p>Product not found.</p>";
  $conn->close();
  exit;
}
$hasRated = false;
$existingRating = null;

$sql = "SELECT * FROM ratings WHERE product_id = $product_id AND username = '$username'";
$result = $conn->query($sql);
if (!$result) {
  echo "Query execution failed: " . $conn->error;
  exit;
}

if ($result->num_rows> 0) {
  $hasRated = true;
  $existingRating = $result->fetch_assoc();
}


// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $rating = $_POST['rating'];
  $review = $_POST['review'];

  // Insert the rating and review into the database
  $sql = "INSERT INTO ratings (username,product_id, rating, review) VALUES ('$username',$product_id, $rating, '$review')";
  $conn->query($sql);
}
?>

<div class="producttr-image-container" style="background-image: url('./admin_area/uploads/<?php echo $product['product_img1']; ?>')"></div>

<div class="othertr-images">
  <img src="./admin_area/uploads/<?php echo $product['product_img1']; ?>" alt="Product Image" onclick="showLightbox(this)">
  <img src="./admin_area/uploads/<?php echo $product['product_img2']; ?>" alt="Product Image" onclick="showLightbox(this)">
  <img src="./admin_area/uploads/<?php echo $product['product_img3']; ?>" alt="Product Image" onclick="showLightbox(this)">
</div>

<div class="product-info">
  <p><strong>Price:</strong> $<?php echo $product['product_price']; ?></p>
  <p><strong>Offer Price:</strong> $<?php echo $product['product_discount']; ?></p>
  <p><strong>Description:</strong> <?php echo $product['product_D']; ?></p>
 
  <div class="rating">
  <span><?php echo number_format($averageRating, 1); ?></span>
  <?php
  $ratingStars = floor($averageRating);
  $remainingStars = 5 - $ratingStars;
  $hasHalfStar = fmod($averageRating, 1) >= 0.5; // Check if there is a half star

  for ($i = 0; $i < $ratingStars; $i++) {
    echo '<span class="rating-stars active"></span>';
  }

  if ($hasHalfStar) {
    echo '<span class="rating-stars active"></span>';
    $remainingStars--;
  }

  for ($i = 0; $i < $remainingStars; $i++) {
    echo '<span class="rating-stars"></span>';
  }
  ?>
</div>

<?php
if ($loggedIn) { ?>
      <div class="rating-form">
        <?php if (!$hasRated) { ?>
          <form method="POST">
            <label for="rating">Your Rating:</label>
            <input type="number" id="rating" name="rating" min="1" max="5" step="0.1" required>
            <label for="review">Your Review:</label>
            <textarea id="review" name="review" rows="4" required></textarea>
            <button type="submit" name="submit">Submit</button>
          </form>
        <?php } else { ?>
          <p>You have already submitted a rating.</p>
        <?php } ?>
      </div>
    <?php } 
?>
<div class="reviews">
  <h2>Reviews</h2>
  <?php
  // Fetch reviews from the database
  $sql = "SELECT * FROM ratings WHERE product_id = $product_id ORDER BY date_added DESC";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      ?>
      <div class="review">
        <strong>Rating: <span class="review-rating"><?php echo $row['rating']; ?></span></strong>
        <p><?php echo $row['review']; ?></p>
        <span class="review-date"><?php echo $row['date_added']; ?></span>
      </div>
      <?php
    }
  } else {
    echo "<p>No reviews yet.</p>";
  }
  ?>
</div>

<div class="lightbox" onclick="hideLightbox()">
  <img class="lightbox-image">
</div>
</section>



  

    <section class="newsletter-section">
        <section>
        <h2>#Signup for our Newsletter</h2>
        <p>Get updates on our latest offers and promotions!</p>
</section>
        <form class="newsletter-form"  action="" onsubmit="validateEmail(event)" method="POST">
            <input type="email" id="email" name="email" class="newsletter-input" placeholder="Enter your email to get the updates" autocomplete="email" required>
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
    <script>

      
const productImageContainer = document.querySelector('.producttr-image-container');
const otherImages = document.querySelectorAll('.othertr-images img');
const body = document.querySelector('body');

let currentIndex = 0;
let isLightboxOpen = false;

productImageContainer.addEventListener('click', () => {
  if (!isLightboxOpen) {
    const src = productImageContainer.style.backgroundImage.slice(5, -2);
    openLightbox(src);
  }
});

otherImages.forEach((image, index) => {
  image.addEventListener('click', () => {
    const src = image.getAttribute('src');
    currentIndex = index;
    productImageContainer.style.backgroundImage = `url(${src})`;
  });
});

function openLightbox(src) {
  const lightbox = document.createElement('div');
  lightbox.classList.add('lightbox', 'active'); // Add the 'active' class to show the lightbox
  const lightboxImage = document.createElement('img');
  lightboxImage.classList.add('lightbox-image');
  lightboxImage.setAttribute('src', src);
  lightbox.appendChild(lightboxImage);
  body.appendChild(lightbox);
  isLightboxOpen = true;
  body.classList.add('no-scroll');

  lightbox.addEventListener('click', (event) => {
    if (event.target === lightbox) { // Close the lightbox only if the background is clicked
      closeLightbox();
    }
  });

  lightboxImage.addEventListener('click', (event) => {
    event.stopPropagation();
    navigateImages();
  });

  document.addEventListener('keydown', handleKeydown); // Add event listener for keyboard navigation
}

function closeLightbox() {
  const lightbox = document.querySelector('.lightbox');
  const parent = lightbox.parentNode;
  parent.removeChild(lightbox);
  isLightboxOpen = false;
  body.classList.remove('no-scroll');
  document.removeEventListener('keydown', handleKeydown);
}


function navigateImages() {
  const lightboxImage = document.querySelector('.lightbox-image');
  currentIndex = (currentIndex + 1) % otherImages.length;
  const src = otherImages[currentIndex].getAttribute('src');
  lightboxImage.setAttribute('src', src);
}

function handleKeydown(event) {
  if (event.key === 'Escape') {
    closeLightbox();
  } else if (event.key === 'ArrowLeft') {
    currentIndex = (currentIndex - 1 + otherImages.length) % otherImages.length;
    const src = otherImages[currentIndex].getAttribute('src');
    const lightboxImage = document.querySelector('.lightbox-image');
    lightboxImage.setAttribute('src', src);
  } else if (event.key === 'ArrowRight') {
    navigateImages();
  }
}
    </script>
  
</body>
</html>

