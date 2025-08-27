<?php
include('../admin_area/connection.php');
include('../functions/common_function.php');
@session_start();
?> 

<!DOCTYPE html>
<html>
<head>
    <title>Login Form</title>
    <style>
        .login {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        .login h1 {
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
        .login input[type="password"] {
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

        .login input[type="submit"]:hover {
            background-color: #45a049;
        }

        .login p {
            text-align: center;
            margin-top: 10px;
        }

        .b{
            color: #4CAF50;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <section class="login">
    <h1>Login</h1>
    <form action="#" method="POST" >
        <label for="username">Username:</label>
        <input type="text" id="username" name="user_username" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="user_password" required>

        <input type="submit" value="Login" name="user_login">
    </form>

    <p>Don't have an account? <a class="b" href="user_registration.php">Register</a></p>
    <section>
</body>
</html>

<?php
if (isset($_POST['user_login'])) {
    $user_username = $_POST['user_username'];
    $user_password = $_POST['user_password'];

    $select_query = "SELECT * FROM `user_table` WHERE username='$user_username'";
    $resultt = mysqli_query($conn, $select_query);
    $row_count = mysqli_num_rows($resultt);
    $row_data = mysqli_fetch_assoc($resultt);
    $user_ip=getIPAddress();


    // cart item
    $select_query_cart = "SELECT * FROM `cart_details` WHERE ip_address='$user_ip'";
    $select_cart=mysqli_query($conn,$select_query_cart);
    $row_count_cart = mysqli_num_rows($select_cart);
    if ($row_count > 0) {
        $_SESSION['username']=$user_username;
        if (password_verify($user_password, $row_data['user_password'])) {
           // echo "<script>alert('Login Successful')</script>";
            if( $row_count==1 and  $row_count_cart==0){
                $_SESSION['username']=$user_username;
                 echo "<script>alert('Login Successful')</script>";
                 echo "<script>window.open('profile.php','_self')</script>";
            }else{
                $_SESSION['username']=$user_username;
                echo "<script>alert('Login Successful you have items in your cart')</script>";
                 echo "<script>window.open('payment.php','_self')</script>";
            }
        } else {
            echo "<script>alert('Invalid Password. Check the password and try to login again')</script>";
        }
    } else {
        echo "<script>alert('Invalid Credentials')</script>";
    }
}
?>
