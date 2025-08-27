<?php
include('connection.php');
$query = "SELECT * FROM brands";
$result = mysqli_query($conn, $query);
if (isset($_GET['delete_brand'])) {
    $brandId = $_GET['delete_brand'];
    
    // Display confirmation message
    echo "<script>
            var result = confirm('Are you sure you want to delete this brand?');
            if (result) {
                window.location.href = 'index.php?remove_brand=$brandId';
            } else {
                window.location.href = 'index.php?view_brands';
            }
          </script>";
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>
  <title>Brands</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <style>
    table {
      border-collapse: collapse;
      width: 100%;
    }
    th, td {
      padding: 10px;
      text-align: center;
      vertical-align: middle;
    }
    th {
      background-color: #f2f2f2;
      font-weight: bold;
    }
    tr:nth-child(even) {
      background-color: #f9f9f9;
    }
    tr:hover {
      background-color: #e6e6e6;
    }
    img {
      display: block;
      margin: 0 auto;
      max-width: 50px;
      max-height: 50px;
    }
    .edit-icon,
    .delete-icon {
      display:inline-block;
     
      width: 20px;
      height: 20px;
      background-position: center;
      cursor: pointer;
    }
    .edit-icon {
      color: #1e88e5;
    }
    .delete-icon {
      color: #e53935;
    }
  </style>
    
</head>
<body>

<h2>Brands</h2>

<table>
  <tr>
    <th>Sl No</th>
    <th>Brand Image</th>
    <th>Brand Name</th>
    <th>Edit</th>
    <th>Delete</th>
  </tr>
  
  <?php
  $count = 1;
  while ($row = mysqli_fetch_assoc($result)) {
      $brandId = $row['brand_id'];
      $brandName = $row['brand_name'];
      $brandImage = $row['brand_img'];
  ?>
  
  <tr>
    <td><?php echo $count; ?></td>
    <td><img src="./brandsupload/<?php echo $brandImage; ?>" alt="Brand Image"></td>
    <td><?php echo $brandName; ?></td>
    <td><a href="index.php?edit_brand=<?php echo $brandId; ?>" class="edit-icon"><i class="fas fa-edit"></i></a></td>
    <td><a href="view_brands.php?delete_brand=<?php echo $brandId; ?>" class="delete-icon" ><i class="fas fa-trash-alt"></i></a></td>
  </tr>
  
  <?php
      $count++;
  }
  ?>
  
</table>

</body>
</html>
