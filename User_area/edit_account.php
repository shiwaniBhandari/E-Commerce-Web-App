<?php
if(isset($_GET['edit_account'])){
    $user_session_name=$_SESSION['username'];
    $select_query="Select * from `user_table` where username='$user_session_name'";
    $resultt_query=mysqli_query($conn,$select_query);
    $row_fetch=mysqli_fetch_assoc($resultt_query);
    $user_id=$row_fetch['user_id'];
    $username=$row_fetch['username'];
    $user_email=$row_fetch['user_email'];
    $user_address=$row_fetch['user_address'];
    $user_mobile=$row_fetch['user_mobile'];
}

    if(isset($_POST['user_update'])){
    $update_id=$user_id;
    $username=$_POST['user_username'];
    $user_email=$_POST['user_email'];
    $user_address=$_POST['user_address'];
    $user_mobile=$_POST['user_mobile'];
    $user_image=$_FILES['user_image']['name'];
    $user_image_tmp=$_FILES['user_image']['tmp_name'];

    move_uploaded_file($user_image_tmp,"./user_images/$user_image");
    //update query
    $update_data="UPDATE `user_table` SET username='$username',user_email='$user_email',user_image='$user_image',user_address='$user_address',user_mobile='$user_mobile' WHERE user_id=$update_id";
    $resultt_query_update=mysqli_query($conn,$update_data);
    if($resultt_query_update){
        echo "<script>alert('Data updated successfully')</script>";
        echo "<script>window.open('logout.php','_self')</script>";
    }
    }


?>
<!DOCTYPE html>
<html>

<head>
  <title>Edit Account</title>
  <link rel="stylesheet" href="../style.css">
</head>

<body class="update_body">
  <div class="update_container">
    <h1>Edit Account</h1>
    <form action="" method="post" enctype="multipart/form-data">
      <label for="username">Username:</label>
      <input type="text" id="username" name="user_username" value="<?php echo  $username?>" required>
      
      <label for="email">Email:</label>
      <input type="email" id="email" name="user_email" value="<?php echo  $user_email?>" required>
      
      <label for="profile-photo">User Profile Photo:</label>
      <img class="current-image" src="./user_images/<?php echo $user_image?>" alt="Current Image">
      <input type="file" id="profile-photo" name="user_image">
      
      <label for="address">Address:</label>
      <input type="text" id="address" name="user_address" value="<?php echo  $user_address?>" required>
      
      <label for="phone">Phone Number:</label>
      <input type="text" id="phone" name="user_mobile" value="<?php echo  $user_mobile?>" required>
      
      <input type="submit" value="Update" name="user_update" class="update_button">
    </form>
  </div>
</body>

</html>