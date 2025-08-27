<?php
include('connection.php');
if (isset($_GET['delete_order'])) {
    $orderId = $_GET['delete_order'];
    
    // Display confirmation message
    echo "<script>
            var result = confirm('Are you sure you want to delete this Order?');
            if (result){
                window.location.href = 'index.php?remove_order=$orderId';
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
  </style>
</head>
<body>
  <h1>User Orders</h1>

  <table>
    <thead>
      <tr>
        <th>Sl No</th>
        <th>Due Amount</th>
        <th>Invoice Number</th>
        <th>Total Products</th>
        <th>Order Date</th>
        <th>Status</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
      <?php



        // Delete order if requested
       
        // Fetch data from the database
        $sql = "SELECT * FROM user_orders";
        $result = $conn->query($sql);

        $slNo = 1;
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$slNo."</td>";
            echo "<td>".$row['amount_due']."</td>";
            echo "<td>".$row['invoice_number']."</td>";
            echo "<td>".$row['total_products']."</td>";
            echo "<td>".$row['order_date']."</td>";
            echo "<td>".$row['order_status']."</td>";
            echo "<td class='delete-button'><a href='list_orders.php?delete_order=".$row['order_id']."'><i class='fas fa-trash'></i></a></td>";
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

