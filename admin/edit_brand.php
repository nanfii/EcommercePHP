 <h2 class="recent-order">edit brands</h2>

 <?php 
if(isset($_GET['edit_brand'])){
    $brand_id = $_GET['edit_brand'];


    $get_brand = "SELECT * FROM `brands` where brand_id=$brand_id";
    $result = mysqli_query($con,$get_brand);
  $row=mysqli_fetch_assoc($result);
  $brand_title = $row['brand_title'];
}


?>


 <form action="" method="post" class="form">

     <div class="single-form">

         <label for="edit_brand">brand title</label>
         <input type="text" name="edit_brand_title" value="<?php echo $brand_title ?>" required="required">
         <input class="btn" value="edit" type="submit" name="edit_brand">
     </div>
 </form>



 <?php 

if (isset($_POST['edit_brand'])) {
    $new_cat_title = $_POST['edit_brand_title'];
    $update_cat = "UPDATE `brands` SET brand_title='$new_cat_title' WHERE brand_id=$brand_id";
    $result = mysqli_query($con,$update_cat);
    if ($result) {
      
        bottomNotification('brand is updated', 'success', 'index.php');

      
        
    }
}

?>