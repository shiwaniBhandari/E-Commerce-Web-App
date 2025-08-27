<?php
require_once 'connection.php';

if(isset($_POST["submit"]))
{
    $categoryname=$_POST["categoryname"];
    $upload_dir=("uploads/");
    $categoryimage = $_FILES["imageUpload"]["name"];
    $_FILES["imageUpload"]["name"];
    $upload_file = $upload_dir.basename($_FILES["imageUpload"]["name"]);
    $imageType = strtolower(pathinfo($upload_file,PATHINFO_EXTENSION));
    $check = $_FILES["imageUpload"]["size"];
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
    if($categoryname != ""){
        move_uploaded_file($_FILES["imageUpload"]["tmp_name"],$upload_file);
        $sql =" INSERT INTO category(category_name,category_img)
        value('$categoryname','$categoryimage')";
        if($conn->query($sql) == TRUE)
        echo "<script> alert('your category has been uploaed sucessfully')</script>";
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
        <input type="text" id="name" name="categoryname" placeholder="insert categories" required>

</div>
<br>
<div class ="input-container">
    <label for="image">Select image * : </label>
        <input type="file" id="image" name="imageUpload" accept="image/*" required>
</div>
<br>
<input type="submit" name="submit" value="insert categories "  placeholder="submit">
<a class="back-button" href="index.php"><i class="fa-solid fa-circle-arrow-left"></i>back</a>
</form>   
</body>
</html>