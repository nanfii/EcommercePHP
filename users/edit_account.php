<?php 
if(isset($_SESSION['username'])){

    if(isset($_GET['edit_account'])){
        $user_session_name = $_SESSION['username'];
        $select_query = "select * from `user` where username='$user_session_name'";
        $result_query = mysqli_query($con,$select_query);
        $row_fetch = mysqli_fetch_assoc($result_query);
        $user_id = $row_fetch['user_id'];
        $username = $row_fetch['username'];
        $user_email = $row_fetch['user_email'];
        $user_address = $row_fetch['user_address'];
        $user_mobile = $row_fetch['user_mobile'];
        
    }
    
    
    if(isset($_POST['user_update'])){
        $update_id = $user_id;
        $username = $_POST['user_username'];
        $user_email = $_POST['user_email'];
        $user_address = $_POST['user_address'];
        $user_mobile = $_POST['user_mobile'];
        $user_image = $_FILES['user_image']['name'];
        $user_image_tmp = $_FILES['user_image']['tmp_name'];
        move_uploaded_file($user_image_tmp,"users_image/$user_image");
        $update_data = "UPDATE `user` 
                SET username = '$username',
                    user_email = '$user_email',
                    user_address = '$user_address',
                    user_image = '$user_image',
                    user_mobile = '$user_mobile'
                WHERE user_id = $update_id";
$result_update_data = mysqli_query($con,$update_data);
if($result_update_data){
        echo "<script>alertMessage('profile updated successfully','success','logout.php');</script>"; 
}



}


?>








<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>edit account</title>
</head>
<style>
.form {
    width: 800px;
    grid-column-start: 0;
    grid-column-end: 3;
}
</style>

<body>

    <form action="" method="post" enctype="multipart/form-data" class="form">
        <div class="single-form">
            <label for="username">username</label>
            <input type="text" name="user_username" value="<?php echo $username?>">
        </div>
        <div class="single-form">
            <label for="email">email</label>
            <input type="email" name="user_email" value="<?php echo $user_email?>">
        </div>

        <div class=" single-form">
            <label for="image">image</label>
            <input type="file" name="user_image">
        </div>
        <div class="single-form">
            <label for="address">address</label>
            <input type="address" name="user_address" value="<?php echo $user_address?>">
        </div>
        <div class="single-form">
            <label for="mobile">contact</label>
            <input type="mobile" name="user_mobile" value="<?php echo $user_mobile?>">
        </div>
        <input type="submit" value="update" name="user_update" class="btn">
    </form>


</body>

</html>
<?php
}
?>