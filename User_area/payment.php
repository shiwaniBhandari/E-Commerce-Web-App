<?php
include('../admin_area/connection.php');
include('../functions/common_function.php');
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="../style.css">
</head>
<body class="payment">
    <?php
$user_ip=getIPAddress();
$get_user="SELECT * FROM `user_table` where user_ip='$user_ip'";
   $resultt=mysqli_query($conn,$get_user);
   $run_query=mysqli_fetch_array($resultt);
   $user_id=$run_query['user_id'];

    ?>
    <br><br>
  <h1>Payment Options</h1>

  <div class="payment-options">
    <div class="payment-option">
     <a href="online.php?user_id=<?php echo $user_id ?>" target="_blank"> <img src="https://www.lyra.com/in/wp-content/uploads/sites/8/2019/04/Electronic-Point-of-Sales-E-POS-App-for-a-retail-business.png"  height="110px" alt="Pay Online"></a>
      <p>Pay Online</p>
    </div>

    <div class="payment-option" >
      <a href="offline.php?user_id=<?php echo $user_id ?>"><img src="https://png.pngtree.com/png-vector/20221028/ourmid/pngtree-online-shop-cash-on-delivery-icon-clipart-transparent-background-png-image_6386452.png" alt="Pay with Cash"></a>
      <p>Pay with Cash</p>
    </div>
    <div class="payment-option" >
      <a href="order.php?user_id=<?php echo $user_id ?>"><img src="data:image/png;base64,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" alt="Pay with Cash"></a>
      <p>Continue later</p>
    </div>
  </div>
</body>
</html>
