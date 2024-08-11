<?php 
if(isset($_GET['delete_product'])){
    $delete_id = $_GET['delete_product'];

    $delete_query= "delete  from  `products` where product_id=$delete_id";
    $result = mysqli_query($con,$delete_query);
    if ($result) {
        // echo "<Script>alert('product deleted')</Script>";
        // echo "<Script>window.open('./index.php','_self')</Script>";
        bottomNotification('product deleted', 'success', 'index.php');

    }
}


?>