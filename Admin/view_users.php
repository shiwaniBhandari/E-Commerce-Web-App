<?php
include('connection.php');
if (isset($_GET['delete_user'])) {
    $userId = $_GET['delete_user'];
    
    // Display confirmation message
    echo "<script>
            var result = confirm('Are you sure you want to remove this user?');
            if (result){
                window.location.href = 'index.php?remove_user=$userId';
            } else {
                window.location.href = 'index.php?view_users';
            }
          </script>";
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>
  <title>User Orders</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <style>
    table {
      border-collapse: collapse;
      width: 100%;
    }

    th, td {
      text-align: left;
      padding: 8px;
    }

    th {
      background-color: #f2f2f2;
    }

    .delete-button {
      text-align: center;
    }
    .user-image {
  width: 110px;
  height: 110px;
  border-radius: 50%;
}

  </style>
</head>
<body>
  <h1>All Users</h1>

  <table>
    <thead>
      <tr>
        <th>Sl No</th>
        <th>User Photo</th>
        <th>User Name</th>
        <th>User Email</th>
        <th>User Phone</th>
        <th>User Address</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
      <?php



        // Delete order if requested
       
        // Fetch data from the database
        $sql = "SELECT * FROM user_table";
        $result = $conn->query($sql);

        $slNo = 1;
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$slNo."</td>";
            echo "<td class ='image'><img src ='./uploads/".$row['user_image']."'  class='user-image'></td>";
            echo "<td>".$row['username']."</td>";
            echo "<td>".$row['user_email']."</td>";
            echo "<td>".$row['user_mobile']."</td>";
            echo "<td>".$row['user_address']."</td>";
            echo "<td class='delete-button'><a href='view_users.php?delete_user=".$row['user_id']."'><i class='fas fa-trash'></i></a></td>";
            echo "</tr>";
            $slNo++;
          }
        } else {
          echo "<tr><td colspan='7'>No orders found.</td></tr>";
        }

        
      ?>
    </tbody>
  </table>
</body>
</html>