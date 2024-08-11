 <h2 class="recent-order">edit category</h2>

 <?php 
if(isset($_GET['edit_category'])){
    $category_id = $_GET['edit_category'];


    $get_category = "SELECT * FROM `categories` where category_id=$category_id";
    $result = mysqli_query($con,$get_category);
  $row=mysqli_fetch_assoc($result);
  $category_title = $row['category_title'];
}


?>


 <form action="" method="post" class="form">

     <div class="single-form">

         <label for="edit_category">category title</label>
         <input type="text" name="edit_category_title" value="<?php echo $category_title ?>" required="required">
         <input class="btn" value="edit" type="submit" name="edit_category">
     </div>
 </form>



 <?php 

if (isset($_POST['edit_category'])) {
    $new_cat_title = $_POST['edit_category_title'];
    $update_cat = "UPDATE `categories` SET category_title='$new_cat_title' WHERE category_id=$category_id";
    $result = mysqli_query($con,$update_cat);
    if ($result) {
        // echo "<Script>alert('cat is updated')</Script>";
        // echo "<Script>window.open('index.php','_self')</Script>";
        bottomNotification('category is updated', 'success', 'index.php');

        
    }
}

?>