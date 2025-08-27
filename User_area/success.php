<?php


session_start();
include('../admin_area/connection.php');
require("../instamojo-php-0.4/src/Instamojo.php");
require("./cred.php");
include('../functions/common_function.php');
$api = new Instamojo\Instamojo(API_KEY, AUTH_TOKEN, 'https://test.instamojo.com/api/1.1/');

try {
    $payment_re_id=$_GET['payment_request_id'];
    $payment_id=$_GET['payment_id'];
    $response = $api->paymentRequestPaymentStatus($payment_re_id,$payment_id);
  // echo("<pre>");
   // print_r($response);
   
//fetching data from response
$status = $response['status'];
if(strcmp($status,'Failed')==0){
    echo('Payment Failed');

}else{
    if(isset($_GET['order_id'])){
        $order_id=$_GET['order_id'];
        $sql = "SELECT invoice_number FROM user_orders WHERE order_id = $order_id";

// Execute the query
$result = mysqli_query($conn, $sql);

    // Fetch the result row
    $row = mysqli_fetch_assoc($result);


    //getting ip address
    $get_ip_address=getIPAddress();

    // Retrieve the invoice_number
    $invoice_number = $row['invoice_number'];
        $amount = $response["payment"]["amount"];
        $paymode = $response["payment"]["instrument_type"];
       $query=" INSERT INTO `user_payments`(`payment_id`, `order_id`, `invoice_number`, `amount`, `payment_mode`, date)
         VALUES ('$payment_id','$order_id','$invoice_number',' $amount','$paymode',NOW())";
         $result_query=mysqli_query($conn,$query);
         if( $result_query){
           echo '<h1>order placed successfully</h1>';
           echo '<h3>Payment ID :</h3>'.$payment_id;
           echo '<h3>Amount :</h3>'.$amount;
           echo '<h3>Status:</h3>'.$status;

         }
         
         else{
             echo 'Error '.mysqli_error($conn);
         }
         $update_orders="update `user_orders` set order_status='Complete' where order_id=$order_id";
         $resultt_orders=mysqli_query($conn,$update_orders);
         $empty_cart="Delete from `cart_details` where
ip_address='$get_ip_address'";
$resultt_delete=mysqli_query($conn,$empty_cart);

    }
}


}
catch (Exception $e) {
    print('Error: ' . $e->getMessage());
}

?>