<?php 
include('../config/config.php');
include('../functions/common_function.php');

if(isset($_GET['user_id'])){
    $user_id = $_GET['user_id'];
}




$get_ip_address = getRealIPAddr();
$total_price=0;
$cart_query_price = "select * from `cart` where ip_address='$get_ip_address'";

$result_cart_price = mysqli_query($con,$cart_query_price);
$invoice_number = mt_rand();
$status = 'pending';
$count_products = mysqli_num_rows($result_cart_price);
 while ($row_price=mysqli_fetch_array($result_cart_price)) {
    $product_id = $row_price['product_id'];
    $select_product = "select * from `products` where product_id=$product_id";
$run_price = mysqli_query($con,$select_product);
while($row_product_price = mysqli_fetch_array($run_price)){
    $product_price = array($row_product_price['product_price']);
    $product_values = array_sum($product_price);
    $total_price += $product_values; 

}
 }


 $get_cart = "select * from `cart`";

 $run_cart = mysqli_query($con,$get_cart);
 $get_item_quantity = mysqli_fetch_array($run_cart);
 $quantity = $get_item_quantity['quantity'];
 if($quantity == 0){
    $quantity = 1;
    $subtotal = $total_price;
 }else{
    $quantity = $quantity;
    $subtotal = $total_price * $quantity;

 }

 $insert_orders = "INSERT INTO `user_order` (
    user_id,
    amount_due,
    invoice_number,
    total_product,
    order_date,
    order_status
) VALUES (
    $user_id,
    $subtotal,
    $invoice_number,
    $count_products,
    NOW(),
    '$status'
)";

$result_query = mysqli_query($con,$insert_orders);
if($result_query){
    echo "<script>alert('success')</script>";
    echo "<script>window.open('profile.php','_self')</script>";
}

$insert_pending_orders = "INSERT INTO `order_pending` (
    user_id,
    invoice_number,
    product_id,
    quantity,
    order_status
) VALUES (
    $user_id,
    $invoice_number,
    $product_id,
    $quantity,
    '$status'
)";
$result_pending_orders = mysqli_query($con,$insert_pending_orders);


$empty_cart = "DELETE FROM `cart` WHERE ip_address = '$get_ip_address'";
$result_delete = mysqli_query($con, $empty_cart);


?>



<form method="POST" action="https://api.chapa.co/v1/hosted/pay">
    <input type="hidden" name="public_key" value="CHAPUBK_TEST-ReP9r18N23sJpk65wFbxaxKmOKTUFNGE" />
    <input type="hidden" name="tx_ref" value="negade-tx-1234567" />
    <input type="hidden" name="amount" value="100" />
    <input type="hidden" name="currency" value="ETB" />
    <input type="email" name="email" value="ananiyafekede@gmail.com" />
    <input type="text" name="first_name" value="Israel" />
    <input type="text" name="last_name" value="Goytom" />
    <input type="text" name="title" value="Let us do this" />
    <input type="text" name="description" value="Paying with Confidence with cha" />
    <input type="hidden" name="logo" value="https://chapa.link/asset/images/chapa_swirl.svg" />
    <input type="hidden" name="callback_url" value="https://example.com/callbackurl" />
    <input type="hidden" name="return_url" value="https://example.com/returnurl" />
    <input type="hidden" name="meta[title]" value="test" />
    <button type="submit">Pay Now</button>
</form>