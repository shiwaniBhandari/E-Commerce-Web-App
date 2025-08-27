<?php
if (isset($_GET['remove_user'])) {
    $userID = $_GET['remove_user'];

    $deleteQuery = "DELETE FROM user_table WHERE user_id = $userID";
    $deleteResult = mysqli_query($conn, $deleteQuery);

    if ($deleteResult) {
        echo "<script>
                alert('User Removed successfully!');
                window.location.href = './index.php?list_orders';
              </script>";
        exit;
    } else {
        echo 'Error deleting user: ' . mysqli_error($conn);
    }
} else {
    echo 'user ID not provided.';
    exit;
}
?>