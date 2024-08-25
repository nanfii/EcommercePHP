<?php 
include('../functions/common_function.php');
include('../config/config.php'); 

@session_start();
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
    <?php 

$user_ip = getRealIPAddr();
$get_user = "SELECT * FROM `user` WHERE `user_ip`='$user_ip'";
$result = mysqli_query($con,$get_user);
$run_query = mysqli_fetch_array($result);
$user_id = $run_query['user_id'];

?>



    <div class="payment-methods form">

        <a href="order.php?user_id=<?php echo $user_id ?>" class="add-to-cart">
            <p>offline</p>
        </a>
    </div>
</body>

</html>