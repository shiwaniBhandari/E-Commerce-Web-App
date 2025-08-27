<?php
include('../admin_area/connection.php');
include('../functions/common_function.php');
?>


<!DOCTYPE html>
<html>
<head>
    <title>User Registration Form</title>
    <style>
        .login{
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        .login  h1 {
            text-align: center;
            color: #333;
        }

       .login form {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .login  label {
            display: block;
            margin-bottom: 5px;
        }

        .login input[type="text"],
        .login input[type="email"],
        .login  input[type="password"],
        .login  input[type="tel"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }

        .login input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .login  input[type="submit"]:hover {
            background-color: #45a049;
        }

        .login p {
            text-align: center;
            margin-top: 10px;
        }

        .b {
            color: #4CAF50;
            text-decoration: none;
        }
    </style>
</head>
<body>
<section  class="login">
    <h1>User Registration</h1>
    <form action="#" method="POST" enctype="multipart/form-data">
        <label for="username">Username:</label>
        <input type="text" id="username" name="user_username" placeholder="Enter username" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="user_email" placeholder="Enter your email" required>

        <label for="userimage">User Image:</label>
        <input type="file" id="userimage" name="user_image"  required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="user_password" placeholder="Enter your password" required>

        <label for="confirmpassword">Confirm Password:</label>
        <input type="password" id="confirmpassword" name="conf_user_password" placeholder="Enter your password again" required>

        <label for="address">Address:</label>
        <input type="text" id="address" name="user_address" placeholder="Enter your address" required>

        <label for="contactnumber">Contact Number:</label>
        <input type="tel" id="contactnumber" name="user_contact" placeholder="Enter your mobile number" required>

        <input type="submit" value="Register" name="user_register" >
    </form>

    <p><b>Already have an account? </b><a class="b" href="user_login.php"><b>Login</b></a></p>
    </section>
</body>
</html>

<!-- php -->
<?php
if(isset($_POST['user_register'])){
    $user_username=$_POST['user_username'];
    $user_email=$_POST['user_email'];
    $user_password=$_POST['user_password'];
    $hash_password=password_hash($user_password,PASSWORD_DEFAULT);
    $conf_user_password=$_POST['conf_user_password'];
    $user_address=$_POST['user_address'];
    $user_contact=$_POST['user_contact'];
    $user_image=$_FILES['user_image']['name'];
    $user_image_tmp=$_FILES['user_image']['tmp_name'];
    $user_ip=getIPAddress();
 $select_query="Select * from `user_table` where username='$user_username'or user_email='$user_email'";
 $resultt=mysqli_query($conn,$select_query);
 $row_count=mysqli_num_rows($resultt);

 if($row_count>0){
    echo "<script>alert('username or email already exist')</script>";
 }else if($user_password!= $conf_user_password){
    echo "<script>alert('PASSWORDS do not match')</script>";
 }
 else{
    move_uploaded_file($user_image_tmp,"./user_images/$user_image");
    $insert_query="INSERT INTO `user_table` (username,user_email,user_password,user_image,
    user_ip,user_address,user_mobile) VALUES ('$user_username','$user_email','$hash_password',
    '$user_image','$user_ip','$user_address','$user_contact') ";
    $sql_execute=mysqli_query($conn,$insert_query);
    
    if($sql_execute === TRUE){
        echo "<script>alert('Data inserted successfully')</script>";
    }else{
        die(mysqli_error($conn));
    }
}
$select_cart_items = "SELECT * FROM `cart_details` WHERE ip_address='$user_ip'";
$result_cart = mysqli_query($conn, $select_cart_items);

if ($result_cart) {
    $rows_count = mysqli_num_rows($result_cart);
    
    if ($rows_count > 0) {
        $_SESSION['username']= $user_username;
        echo "<script>alert('You have items in your cart')</script>";
        echo "<script>window.open('checkout.php','_self')</script>";
    } else {
        echo "<script>window.open('../index.php','_self')</script>";
    }
} else {
    // Handle the query execution error
    echo "Error executing the query: " . mysqli_error($conn);
}

}
?>