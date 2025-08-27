<?php
session_start();
include('../admin_area/connection.php');
if(isset($_GET['order_id'])){
    $order_id=$_GET['order_id'];
   // echo $order_id;
   $select_data="select * from `user_orders` where order_id=$order_id";
   $resultt=mysqli_query($conn,$select_data);
   $row_fetch=mysqli_fetch_assoc($resultt);
   $invoice_number=$row_fetch['invoice_number'];
   $amount_due=$row_fetch['amount_due'];

}
if(isset($_POST['confirm_payment'])){
    $invoice_number=$_POST['invoice_number'];
    $amount=$_POST['amount'];
    $payment_mode=$_POST['payment_mode'];
    $insert_query="insert into `user_payments`(order_id,invoice_number,amount,payment_mode)
    values($order_id,$invoice_number,$amount,'$payment_mode')";
    $resultt=mysqli_query($conn,$insert_query);
    if($resultt){
      echo "<h3 class='text-center text-light'>successfully completed the payment</h3>";
      echo "<script>window.open('profile.php?my_orders','_self')</script>";
    }
    $update_orders="update `user_orders` set order_status='Complete' where order_id=$order_id";
    $resultt_orders=mysqli_query($conn,$update_orders);

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>payment page</title>

    <style>
    /* CSS styling for the form */
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
    }

    .container {
      max-width: 400px;
      margin: 0 auto;
      padding: 20px;
      background-color: #ffffff;
      border: 1px solid #cccccc;
      border-radius: 4px;
      box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
    }

    h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    label {
      display: block;
      margin-bottom: 8px;
    }

    input[type="text"],
    select {
      width: 100%;
      padding: 10px;
      border: 1px solid #cccccc;
      border-radius: 4px;
      box-sizing: border-box;
      margin-bottom: 16px;
      font-size: 14px;
    }

    select {
      height: 36px;
    }

    input[type="submit"] {
      background-color: #4CAF50;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 16px;
    }

    input[type="submit"]:hover {
      background-color: #45a049;
    }
  </style>
</head>
<body>
<div class="container">
    <h2>Confirm Payment</h2>
    <form action="" method="post">
      <label for="invoice_number">Invoice Number:</label>
      <input type="text" id="invoice_number" name="invoice_number" value="<?php echo $invoice_number ?>">
      
      <label for="amount">Amount:</label>
      <input type="text" id="amount" name="amount" value="<?php echo $amount_due ?>">
      
      <label for="payment_type">Payment Type:</label>
      <select id="payment_type" name="payment_mode" required>
        <option value="">Select Payment Type</option>
        <option value="upi">UPI</option>
        <option value="netbanking">Netbanking</option>
        <option value="cash_on_delivery">Cash on Delivery</option>
      </select>
      
      <input type="submit" value="Confirm Payment" name="confirm_payment">
    </form>
  </div>
    
</body>
</html>