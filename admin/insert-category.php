<?php 
include("../config/config.php");
if(isset($_POST['insert_cat'])){
    $category_title = $_POST['cat_title'];
    
    $select_query = "SELECT * FROM `categories` WHERE `category_title`='$category_title'";
    $result_select = mysqli_query($con, $select_query);
    $number=mysqli_num_rows($result_select);
    if($number > 0){
        //   echo "<script>alert('the category is in side the data base')</script>";
        bottomNotification('the category is in side the data base', 'fail', 'index.php?insert-category');

    }
else{
    $insert_query = "INSERT INTO `categories` (category_title) VALUES ('$category_title')";
    $result = mysqli_query($con, $insert_query);
    
    if($result){
        // success message
        // echo "<script>alert('added successfully')</script>";
        bottomNotification('category added successfully', 'success', 'index.php?insert-category');

    } 
}
}
?>

<form action="" method="post" class="form">
    <h2 class="recent-order">add category</h2>

    <div class="underline"></div>
    <div class="input-container single-form">
        <label for="category">Category</label>
        <input type="text" placeholder="Add category" name="cat_title">
    </div>
    <input type="submit" name="insert_cat" value="Add category" class="btn">
</form>