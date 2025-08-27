<?php

if(isset($_GET['remove_product'])){
    $delete_id=$_GET['remove_product'];

    $delete_product="Delete from `products` where product_id=$delete_id";
    $result_product=mysqli_query($conn,$delete_product);
    if($result_product){
        echo "<script>alert('Product deleted successfully!')</script>";
    echo "<script>window.open('./index.php?view_products','_self')</script>";
    }


}
?>