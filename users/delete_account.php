<?php
if(isset($_POST['delete_account']))

?>
<form action="" method="post" class="delete-box">

    <input type="submit" value="delete account" class="add-to-cart" name="delete">
    <input type="submit" value="not delete account" class="see-more" name="not_delete">
</form>


<?php 


if(isset($_SESSION['username'])){

    
    $username_session = $_SESSION['username'];
    if(isset($_POST['delete'])){
        $delete_query = "delete from `user` where username='$username_session'";
        $result = mysqli_query($con,$delete_query);
        if($result){
            session_unset();
            session_destroy();
        echo "<script>alertMessage('account deleted successfully','success','../index.php');</script>";

    }

    
}
if(isset($_POST['not_delete'])){
    echo "<Script>window.open('profile.php','_Self')</Script>";
}
}

 



?>