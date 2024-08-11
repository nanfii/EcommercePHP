<?php
if (isset($_GET['delete_category'])) {
    $category_id = $_GET['delete_category'];

    $delete_query = "delete FROM `categories` where category_id = $category_id";
$delete_result = mysqli_query($con,$delete_query);
    
    if ($delete_result) {
        // echo "<script>alert('category is deleted')</script>";
        // echo "<Script>window.open('index.php','_self')</Script>";
        bottomNotification('category is deleted', 'success', 'index.php');

    }
}

?>