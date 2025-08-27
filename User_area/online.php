<?php
include('../admin_area/connection.php');
include('../functions/common_function.php');


if(isset($_GET['user_id'])){

    $user_id=$_GET['user_id'];

}

//GETTING TOTAL PRICE AND TOTAL ITEMS
$get_ip_address=getIPAddress();
$total_price=0;
$cart_query_price="SELECT * FROM `cart_details` WHERE ip_address='$get_ip_address'";
$resultt_cart_price=mysqli_query($conn,$cart_query_price);
$invoice_number=mt_rand();
$status='pending'; 
$count_products=mysqli_num_rows($resultt_cart_price);
while($row_price=mysqli_fetch_array($resultt_cart_price)){
    $product_id=$row_price['product_id'];
    $select_product="SELECT * FROM `products` WHERE product_id='$product_id'";
    $run_price=mysqli_query($conn, $select_product);
    while($row_product_price=mysqli_fetch_array( $run_price)){
        $product_price=array($row_product_price['product_discount']);
        $product_values=array_sum( $product_price);
        $total_price+=$product_values;

    }

} 

// getting quantity form cart 
$get_cart="select * from  `cart_details`";
$run_cart=mysqli_query($conn,$get_cart);
$get_item_quantity=mysqli_fetch_array($run_cart);
$quantity=$get_item_quantity['quantity'];
if($quantity==0){
    $quantity=1;
    $subtotal=$total_price;
}else{
    $quantity=$quantity;
    $subtotal=$total_price*$quantity;

}

$insert_orders="INSERT INTO `user_orders` (user_id,amount_due,invoice_number,total_products,order_date,order_status)
values( $user_id,$subtotal,$invoice_number,$count_products,NOW(),'$status')";
$resultt_query=mysqli_query($conn,$insert_orders);
if($resultt_query){
  
    $order_id = mysqli_insert_id($conn); // Get the current order_id
    echo "<script>alert('Going to payment page. Please do not refresh.')</script>";
    header("Location: pay.php?order_id=$order_id");
    exit;
   
}








?> 