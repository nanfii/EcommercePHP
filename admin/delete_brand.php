<?php
if (isset($_GET['delete_brand'])) {
    $brand_id = $_GET['delete_brand'];

    $delete_query = "delete FROM  `brands` where brand_id = $brand_id";
$delete_result = mysqli_query($con,$delete_query);
    if ($delete_result) {
        bottomNotification('brand is deleted', 'success', 'index.php');
        // echo "<script>alert('brand is deleted')</script>";
        // echo "<Script>window.open('index.php','_self')</Script>";
    }
}

?>