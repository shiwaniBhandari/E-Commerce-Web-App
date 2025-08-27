<?php
if (isset($_GET['remove_order'])) {
    $deleteID = $_GET['remove_order'];

    $deleteQuery = "DELETE FROM user_orders WHERE order_id = $deleteID";
    $deleteResult = mysqli_query($conn, $deleteQuery);

    if ($deleteResult) {
        echo "<script>
                alert('Order deleted successfully!');
                window.location.href = './index.php?list_orders';
              </script>";
        exit;
    } else {
        echo 'Error deleting order: ' . mysqli_error($conn);
    }
} else {
    echo 'Order ID not provided.';
    exit;
}
?>
