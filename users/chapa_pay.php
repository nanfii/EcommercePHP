<?php 
include('../config/config.php');
include('../functions/common_function.php');

if(isset($_GET['user_id'])){
    $user_id = $_GET['user_id'];
}

$get_ip_address = getRealIPAddr();// Chappa paymenat Integration
$total_price = 0;
$cart_query_price = "SELECT * FROM `cart` WHERE ip_address='$get_ip_address'";
$result_cart_price = mysqli_query($con,$cart_query_price);
$invoice_number = mt_rand();
$status = 'pending';
$count_products = mysqli_num_rows($result_cart_price);

while ($row_price = mysqli_fetch_array($result_cart_price)) {
    $product_id = $row_price['product_id'];
    $select_product = "SELECT * FROM `products` WHERE product_id=$product_id";
    $run_price = mysqli_query($con,$select_product);
    while($row_product_price = mysqli_fetch_array($run_price)){
        $product_price = array($row_product_price['product_price']);
        $product_values = array_sum($product_price);
        $total_price += $product_values; 
    }
}

$select_query = "SELECT * FROM `user` WHERE user_id='$user_id'";
$result = mysqli_query($con, $select_query);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $username = $row['username'];
    $user_email = $row['user_email'];
    
}

$get_cart = "SELECT * FROM `cart`";
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





if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$curl = curl_init();

$postData = array(
'amount' => '100',
'currency' => $_POST['currency'],
'email' => $_POST['email'],
'first_name' => $_POST['first_name'],
'last_name' => $_POST['last_name'],
'phone_number' => '0912345678',
'tx_ref' => $_POST['tx_ref'],
'callback_url' => $_POST['callback_url'],
'return_url' => $_POST['return_url'],
'customization' => array(
'title' => $_POST['title'],
'description' => $_POST['description']
)
);

curl_setopt_array($curl, array(
CURLOPT_URL => 'https://api.chapa.co/v1/transaction/initialize',
CURLOPT_RETURNTRANSFER => true,
CURLOPT_ENCODING => '',
CURLOPT_MAXREDIRS => 10,
CURLOPT_TIMEOUT => 0,
CURLOPT_FOLLOWLOCATION => true,
CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
CURLOPT_CUSTOMREQUEST => 'POST',
CURLOPT_POSTFIELDS => json_encode($postData),
CURLOPT_HTTPHEADER => array(
'Authorization: Bearer CHASECK_TEST-hCZRifTa0PTpavURJqPMr1XxXLE7Zvc6',
'Content-Type: application/json'
),
));

$response = curl_exec($curl);
$responseData = json_decode($response, true);

if ($responseData['status'] === 'success') {
$insert_orders="INSERT INTO `user_order` (
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
)" ; 

$result_query=mysqli_query($con,$insert_orders); 
$insert_pending_orders="INSERT INTO `order_pending` (
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
)" ; 


$result_pending_orders=mysqli_query($con,$insert_pending_orders);
$empty_cart="DELETE FROM `cart` WHERE ip_address = '$get_ip_address'" ; 
$result_delete=mysqli_query($con,$empty_cart);
}
if ($responseData['status'] === 'success') {

$checkoutUrl = $responseData['data']['checkout_url'];
header('Location: ' . $checkoutUrl);
exit();
} else {
// Display an error message
echo "Error: " . $responseData['message'];
}
curl_close($curl);
} else {
// Display the HTML form
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Payment Form</title>
    <link rel="stylesheet" href="../css/style.css?v=<?php echo filemtime('../css/style.css'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="../css/new_style.css?v=<?php echo filemtime('../css/new_style.css'); ?>">
</head>

<body>
    <form method="POST" action="https://api.chapa.co/v1/hosted/pay" class="form">

        <h6 class="recent-order"> total price: <?php echo $subtotal ?></h6>

        <input type="hidden" name="public_key" value="CHAPUBK_TEST-ReP9r18N23sJpk65wFbxaxKmOKTUFNGE" />
        <input type="hidden" name="tx_ref" value="<?php echo $invoice_number ?>" />
        <input type="hidden" name="amount" value="<?php echo  $subtotal ?>" />
        <input type="hidden" name="currency" value="ETB" />

        <div class="single-form">
            <label for="email">Email</label>
            <input type="email" name="email" value="<?php echo $user_email ?>" />
        </div>

        <div class="single-form">
            <label for="first_name">First Name</label>
            <input type="text" name="first_name" value="<?php echo $username ?>" />
        </div>

        <div class="single-form">
            <label for="last_name">Last Name</label>
            <input type="text" name="last_name" value="<?php echo $username ?>" />
        </div>

        <div class="single-form">
            <label for="title">Title</label>
            <input type="text" name="title" value="" placeholder="payment" />
        </div>

        <div class="single-form">
            <label for="description">Description</label>
            <input type="text" name="description" value="Paying with Confidence with cha" />
        </div>

        <input type="hidden" name="logo" value="https://chapa.link/asset/images/chapa_swirl.svg" />
        <input type="hidden" name="callback_url" value="http://localhost/ecommerce-website/users/profile.php" />
        <input type="hidden" name="return_url" value="http://localhost/ecommerce-website/users/profile.php?my_orders" />
        <input type="hidden" name="meta[title]" value="test" />

        <button type="submit" class="add-to-cart" name="chapa">Pay Now</button>
    </form>
</body>

</html>
