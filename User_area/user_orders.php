<!DOCTYPE html>
<html>
<head>
  <style>
    .order_body{
      font-family: Arial, sans-serif;
    }
    
    .order_body h1 {
      text-align: center;
      color: #333;
    }

    table {
      border-collapse: collapse;
      width: 100%;
      margin-top: 20px;
    }
 
    th {
      background-color: cadetblue;
      color: #fff;
      text-align: left;
      padding: 10px;
    }

    td {
      border: 1px solid #ccc;
      padding: 10px;
    }

    tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    tr:hover {
      background-color: #e0e0e0;
    }
  </style>
</head>
<body class="order_body">
<?php 
$username=$_SESSION['username'];
$get_user = "Select * from `user_table` where username='$username'";
$resultt=mysqli_query($conn,$get_user);
$row_fetch=mysqli_fetch_assoc($resultt);
$user_id=$row_fetch['user_id'];

?>

  <h1>My Orders</h1>
  <table>
    <tr>
      <th>Sl No</th>
      <th>Amount Due</th>
      <th>Total Products</th>
      <th>Invoice Number</th>
      <th>Date</th>
      <th>Complete/Incomplete</th>
      <th>Status</th>
    </tr>
<?php 
$get_order_details="SELECT * FROM `user_orders` where user_id=$user_id";
$resultt_orders=mysqli_query($conn,$get_order_details);
$number=1;
while($row_orders=mysqli_fetch_assoc($resultt_orders)){
    $order_id=$row_orders['order_id'];
    $amount_due=$row_orders['amount_due'];
    $total_products=$row_orders['total_products'];
    $invoice_number=$row_orders['invoice_number'];
    $order_status=($row_orders['order_status'] == 'pending') ? 'Incomplete' : 'Complete';
    $order_date=$row_orders['order_date'];
  
    echo"<tr>
    <td>$number</td>
    <td>$amount_due</td>
    <td>$total_products</td>
    <td>$invoice_number</td>
    <td>$order_date</td>
    <td>$order_status</td>";
    ?>
    <?php
    if($order_status=='Complete'){
      echo "<td>Paid</td>";
    }else{
      echo "<td><a href='confirm_payment.php?order_id=$order_id' class='text-light'>confirm</a></td>
      <tr>";
    }
  $number++;
  }
?>
  </table>
</body>
</html>
