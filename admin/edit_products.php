<?php 

if(isset($_GET['edit_products'])){
    $product_id = $_GET['edit_products'];
    $select_query = "SELECT * FROM `products` where product_id=$product_id";
    $result = mysqli_query($con,$select_query);
    $row = mysqli_fetch_array($result);
    $product_title = $row['product_title'];
    $product_description = $row['product_discription'];
    $product_keywords = $row['product_keywords'];
    $category_id = $row['category_id'];
    $brand_id = $row['brand_id'];
    $product_image1 = $row['product_image1'];
    $product_image2 = $row['product_image2'];
    $product_image3= $row['product_image3'];
    $product_price = $row['product_price'];

}

            if(isset($_POST['edit_product'])){
                $product_title = $_POST['product_title'];
                $product_description = $_POST['product_description'];
                $product_keywords = $_POST['product_keywords'];
                $category_id = $_POST['product_category'];
                $brand_id = $_POST['product_brand'];
                $product_price = $_POST['product_price'];
                $product_image1 = $_FILES['product_image1']['name'];
                $product_image2 = $_FILES['product_image2']['name'];
                $product_image3 = $_FILES['product_image3']['name'];
                $temp_image1 = $_FILES['product_image1']['tmp_name'];
                $temp_image2 = $_FILES['product_image2']['tmp_name'];
                $temp_image3= $_FILES['product_image3']['tmp_name'];

  if ($product_title == '' || $product_description == '' || $product_keywords == '' || $product_price == '' || $product_image1 == '' || $product_image2 == '' || $product_image3 == '') {
    echo "<script>alert('fill all place')</script>";
        bottomNotification('fill all place', 'success', 'edit_products.php');

  }
  else{

      move_uploaded_file($temp_image1,"./product_images/$product_image1");
      move_uploaded_file($temp_image2,"./product_images/$product_image2");
      move_uploaded_file($temp_image3,"./product_images/$product_image3");
      

$update_products = "
UPDATE products 
SET 
    product_title = '$product_title',
    product_discription = '$product_description',
    product_keywords = '$product_keywords',
    category_id = '$category_id',
    brand_id = '$brand_id',
    product_price=$product_price,
    product_image1 = '$product_image1',
    product_image2 = '$product_image2',
    product_image3 = '$product_image3'
WHERE product_id = $product_id
";

$result_update = mysqli_query($con,$update_products);
if($result_update){
    // echo "<script>alert('updated successfully')</script>";
    // echo "<script>window.open('./index.php','_self')</script>";
        bottomNotification('product is updated successfully', 'success', 'index.php');

}
      
    }
            }


?>
<form action="" method="post" enctype="multipart/form-data" class="form">
    <h2 class="recent-order">edit a product</h2>

    <div class="single-form">
        <label for="product_title">product title</label>
        <input type="text" name="product_title" required="required" value="<?php echo $product_title?>">
    </div>
    <div class="single-form">
        <label for="product_description">product description</label>
        <input type="text" name="product_description" required="required" value="<?php echo $product_description?>">
    </div>
    <div class=" single-form">
        <label for="product_keywords">product keywords</label>
        <input type="text" name="product_keywords" required="required" value="<?php echo $product_keywords?>">
    </div>
    <div class=" single-form">
        <label for="product_image">category</label>
        <select name="product_category" id="">
            <?php 
$select_current_categories = "SELECT * FROM `categories` WHERE category_id='$category_id'";
$result_current_category = mysqli_query($con, $select_current_categories);
$row_current_category = mysqli_fetch_array($result_current_category);
$current_category_id = $row_current_category['category_id'];
$current_category_title = $row_current_category['category_title'];
echo "<option value='$current_category_id'>$current_category_title</option>";

$select_category = "SELECT * FROM `categories`";
$result = mysqli_query($con, $select_category);
while ($row_category = mysqli_fetch_array($result)) {
    $category_id = $row_category['category_id'];
    $category_title = $row_category['category_title'];
    echo "<option value='$category_id'>$category_title</option>";
}
?>
        </select>
    </div>
    <div class="single-form">
        <label for="product_image">brands</label>
        <select name="product_brand" id="">
            <?php 
             $select_current_brands = "SELECT * FROM `brands` where brand_id='$brand_id'";
            $result_current_brand = mysqli_query($con,$select_current_brands);
            $row_current_brand=mysqli_fetch_array($result_current_brand);
            $current_brand_id=$row_current_brand['brand_id'];
            $current_brand_title=$row_current_brand['brand_title'];
            echo "<option value='$current_brand_id'>$current_brand_title</option>";
            
            $select_brands = "SELECT * FROM `brands`";
            $result = mysqli_query($con,$select_brands);
            while($row_brand=mysqli_fetch_array($result)){
                $product_brand =  $row_brand['brand_title'];
                echo "<option value='$product_brand'>$product_brand</option>";

            }
            

            ?>
        </select>
    </div>
    <div class="single-form">
        <label for="product_image">product image1</label>
        <input type="file" name="product_image1" required="required">
    </div>
    <div class="single-form">
        <label for="product_image">product image2</label>
        <input type="file" name="product_image2" required="required">
    </div>
    <div class="single-form">
        <label for="product_image">product image3</label>
        <input type="file" name="product_image3" required="required">
    </div>
    <div class=" single-form">
        <label for="product_price">product price</label>
        <input type="text" name="product_price" required="required" value="<?php echo $product_price?>">
    </div>
    <input type="submit" class="btn" value="update" name="edit_product">

</form>