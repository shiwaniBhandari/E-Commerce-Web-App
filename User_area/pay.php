<?php
// session start
session_start();
include('../admin_area/connection.php');
include('../functions/common_function.php');
require("../instamojo-php-0.4/src/Instamojo.php");
require("./cred.php");

// fetch data from form
if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
    $select_data = "SELECT * FROM `user_orders` WHERE order_id = $order_id";
    $resultt = mysqli_query($conn, $select_data);

    if ($resultt) {
        $row_fetch = mysqli_fetch_assoc($resultt);
        $invoice_number = $row_fetch['invoice_number'];
        $amount_due = $row_fetch['amount_due'];
        $user_id = $row_fetch['user_id'];

        $select_query = "SELECT username, user_mobile, user_email FROM user_table WHERE user_id = $user_id";
        $result = mysqli_query($conn, $select_query);

        if ($result) {
            $row = mysqli_fetch_assoc($result);

            // Retrieve user_name user_phone and user_email
            $user_name = $row['username'];
            $user_phone = $row['user_mobile'];
            $user_email = $row['user_email'];

            // Create API object
            $api = new Instamojo\Instamojo(API_KEY, AUTH_TOKEN, 'https://test.instamojo.com/api/1.1/');

            // 1. Payment request creation 
            try {
                $response = $api->paymentRequestCreate(array(
                    "purpose" => "Testing",
                    "amount" => $amount_due,
                    "phone" => $user_phone,
                    "send_email" => true,
                    "email" => $user_email,
                   
                    "redirect_url" => "http://localhost/mini%20project/users_area/success.php?order_id=$order_id"
                ));
                $url=$response["longurl"];
                header("location:$url");
            } catch (Exception $e) {
                echo 'Error: ' . $e->getMessage();
            }
        } else {
            echo "Failed to retrieve user details.";
        }

        // Free the result set
        mysqli_free_result($result);
    } else {
        echo "Failed to retrieve order details.";
    }

    // Free the result set
    mysqli_free_result($resultt);
} else {
    echo "Invalid order ID.";
}
?>



