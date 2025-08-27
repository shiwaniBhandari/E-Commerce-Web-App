<?php
require_once 'connection.php';

if(isset($_POST["submit"]))
{
    $brandname=$_POST["brandname"];
    $upload_dir=("brandsupload/");
    $brandimage = $_FILES["imageupload"]["name"];
    $_FILES["imageupload"]["name"];
    $upload_file = $upload_dir.basename($_FILES["imageupload"]["name"]);
    $imageType = strtolower(pathinfo($upload_file,PATHINFO_EXTENSION));
    $check = $_FILES["imageupload"]["size"];
    $upload_ok = 0;

    if(file_exists($upload_file)){
        echo "<script> alert('the file already exists')</script>";
        $upload_ok = 0;
    }
    else{
        $upload_ok = 1;
        if($check !== false){
            $upload_ok = 1;
            if ($imageType =='jpg' || $imageType =='jpeg' || $imageType =='png'){
                $upload_ok = 1;
              }else{
                echo "<script> alert('please change the file type to jpg,jpeg or png')</script>";
                $upload_ok = 0;
              }
    }
    else{
        echo "<script> alert('the photo size is 0 please change the photo')</script>";
    }

}
if($upload_ok == 0){
    echo "<script> alert('sorry your file doesnot uploaded.please try again')</script>";
}else{
    if($brandname != ""){
        move_uploaded_file($_FILES["imageupload"]["tmp_name"],$upload_file);
        $sql =" INSERT INTO brands(brand_name,brand_img)
        value('$brandname','$brandimage')";
        if($conn->query($sql) == TRUE)
        echo "<script> alert('your category has been uploaded sucessfully')</script>";
    }
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style.css">
        <script src="https://kit.fontawesome.com/700ef8c0d0.js" crossorigin="anonymous"></script>

</head>
<body>
  <form class="center" method ="post" action="" enctype="multipart/form-data">
    <div class ="input-container">
        <input type="text" id="name" name="brandname" placeholder="insert brand" required>

</div>
<br>
<div class ="input-container">
    <label for="image">Select image * : </label>
        <input type="file" id="image" name="imageupload" accept="image/*" required>
</div>
<br>
<input type="submit" name="submit"   placeholder="submit">
<a class="back-button" href="index.php"><i class="fa-solid fa-circle-arrow-left"></i>back</a>
</form>   
</body><?php
require_once 'connection.php';

if (isset($_POST["submit"])) {
    $brandname = $_POST["brandname"];
    $upload_dir = "brandsupload/";
    $brandimage = $_FILES["imageupload"]["name"];
    $upload_file = $upload_dir . basename($brandimage);
    $imageType = strtolower(pathinfo($upload_file, PATHINFO_EXTENSION));
    $check = $_FILES["imageupload"]["size"];
    $upload_ok = 1;

    // Validate file
    if (file_exists($upload_file)) {
        echo "<script>alert('The file already exists')</script>";
        $upload_ok = 0;
    } elseif ($check === 0) {
        echo "<script>alert('The photo size is 0. Please choose a valid image')</script>";
        $upload_ok = 0;
    } elseif (!in_array($imageType, ['jpg', 'jpeg', 'png'])) {
        echo "<script>alert('Only JPG, JPEG, and PNG files are allowed')</script>";
        $upload_ok = 0;
    }

    // Proceed if all good
    if ($upload_ok == 1 && $brandname != "") {
        if (move_uploaded_file($_FILES["imageupload"]["tmp_name"], $upload_file)) {
            $sql = "INSERT INTO brands (brand_title, brand_img) VALUES ('$brandname', '$brandimage')";
            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Brand has been uploaded successfully')</script>";
            } else {
                echo "<script>alert('Database error: " . mysqli_error($conn) . "')</script>";
            }
        } else {
            echo "<script>alert('Failed to upload file. Please try again.')</script>";
        }
    } else {
        echo "<script>alert('Brand name or image not valid. Please fix the errors.')</script>";
    }
}
?>

<!-- HTML Form -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload Brand</title>
    <link rel="stylesheet" href="../style.css">
    <script src="https://kit.fontawesome.com/700ef8c0d0.js" crossorigin="anonymous"></script>
</head>
<body>
<form class="center" method="post" enctype="multipart/form-data">
    <div class="input-container">
        <input type="text" name="brandname" placeholder="Insert brand name" required>
    </div>
    <br>
    <div class="input-container">
        <label for="image">Select image * :</label>
        <input type="file" name="imageupload" accept="image/*" required>
    </div>
    <br>
    <input type="submit" name="submit" value="Submit">
    <a class="back-button" href="index.php"><i class="fa-solid fa-circle-arrow-left"></i> Back</a>
</form>
</body>
</html>

</html>