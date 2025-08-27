<?php
if (isset($_GET['remove_payment'])) {
    $deleteID = $_GET['remove_payment'];

    $deleteQuery = "DELETE FROM user_payments WHERE payment_id = $deleteID";
    $deleteResult = mysqli_query($conn, $deleteQuery);

    if ($deleteResult) {
        echo "<script>
                alert('payemnt deleted successfully!');
                window.location.href = './index.php?list_payment';
              </script>";
        exit;
    } else {
        echo 'Error deleting payment: ' . mysqli_error($conn);
    }
} else {
    echo 'payment ID not provided.';
    exit;
}
?>