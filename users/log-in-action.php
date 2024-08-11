<?php 
include('../config/config.php'); 
include('../functions/common_function.php');
session_start();


if (isset($_POST['user_login'])) {
    $user_username = $_POST['user_username'];
    $user_password = $_POST['user_password'];

$select_query="SELECT * FROM `user` WHERE username='$user_username'"; 
$result = mysqli_query($con ,$select_query);
$row_count=mysqli_num_rows($result);
$row_data =mysqli_fetch_assoc($result);
$user_ip= getRealIPAddr();

$select_query_cart="SELECT * FROM `cart` WHERE ip_address='$user_ip'"; 
$select_cart=mysqli_query($con,$select_query_cart);
$row_count_cart=mysqli_num_rows($select_cart);

if($row_count > 0){
if (password_verify($user_password,$row_data['user_password'])) {
    $_SESSION['username'] = $user_username;
    if($row_count == 1 and $row_count_cart==0){
        $_SESSION['username'] = $user_username;
        // echo "<script>alertMessage('login successfully','success','./profile.php');</script>";
        BottomNotification('login successfully', 'success', './profile.php');
        // echo "<script>window.open('./profile.php','_self')</script>";
    }
    
    else{
        $_SESSION['username'] = $user_username;
        // echo "<script>alertMessage('login successfully','success','./payment.php');</script>";
        BottomNotification('login successfully', 'success', './payment.php');
        
    }
    
}
else{
        // echo "<script>alertMessage('invalid password','fail','./user_login.php');</script>";
        BottomNotification('invalid password', 'fail', './user_login.php');
        


}
}
else{
        //    echo "<script>alertMessage('invalid user','fail','./user_login.php');</script>";
              BottomNotification('invalid user', 'fail', './user_login.php');



}
}

?>