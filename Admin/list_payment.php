<?php
include('connection.php');
if (isset($_GET['delete_payment'])) {
    $paymentId = $_GET['delete_payment'];
    
    // Display confirmation message
    echo "<script>
            var result = confirm('Are you sure you want to delete this Order?');
            if (result){
                window.location.href = 'index.php?remove_payment=$paymentId';
            } else {
                window.location.href = 'index.php?list_payment';
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
  <h1>All Payments</h1>

  <table>
    <thead>
      <tr>
        <th>Sl No</th>
        <th>Invoice Number</th>
        <th>Amount</th>
        <th>Payment Mode</th>
        <th>Payment Date</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
      <?php



        // Delete order if requested
       
        // Fetch data from the database
        $sql = "SELECT * FROM user_payments";
        $result = $conn->query($sql);

        $slNo = 1;
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$slNo."</td>";
            echo "<td>".$row['invoice_number']."</td>";
            echo "<td>".$row['amount']."</td>";
            echo "<td>".$row['payment_mode']."</td>";
            echo "<td>".$row['date']."</td>";
            echo "<td class='delete-button'><a href='list_payment.php?delete_payment=".$row['payment_id']."'><i class='fas fa-trash'></i></a></td>";
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

