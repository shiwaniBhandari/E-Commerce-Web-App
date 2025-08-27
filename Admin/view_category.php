<?php


include('connection.php');
$query = "SELECT * FROM category";
$result = mysqli_query($conn, $query);
if (isset($_GET['delete_category'])) {
  $categoryId = $_GET['delete_category'];
  
  // Display confirmation message
  echo "<script>
          var result = confirm('Are you sure you want to delete this brand?');
          if (result) {
              window.location.href = 'index.php?remove_category=$categoryId';
          } else {
              window.location.href = 'index.php?view_category';
          }
        </script>";
  exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Categories</title>
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
    .edit-icon, .delete-icon {
      display: inline-block;
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

<h2>Categories</h2>

<table>
  <tr>
    <th>Sl No</th>
    <th>Category Image</th>
    <th>Category Name</th>
    <th>Edit</th>
    <th>Delete</th>
  </tr>
  
  <?php
  $count = 1;
  while ($row = mysqli_fetch_assoc($result)) {
      $categoryId = $row['category_id'];
      $categoryName = $row['category_name'];
      $categoryImage = $row['category_img'];
  ?>
  
  <tr>
    <td><?php echo $count; ?></td>
    <td><img src=".\uploads\<?php echo $categoryImage; ?>" alt="Category Image"></td>
    <td><?php echo $categoryName; ?></td>
    <td><a href="index.php?edit_category=<?php echo $categoryId; ?>" class="edit-icon"><i class="fas fa-edit"></i></a></td>
    <td><a href="view_category.php?delete_category=<?php echo $categoryId; ?>" class="delete-icon"><i class="fas fa-trash-alt"></i></a></td>
  </tr>
  
  <?php
      $count++;
  }
  ?>
  
</table>

</body>
</html>
