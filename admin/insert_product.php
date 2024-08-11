<?php 
include('../config/config.php');
if(isset($_POST["insert_product"])){
 $product_title = $_POST['product_title'];
 $product_description = $_POST['description'];
 $product_keywords = $_POST['product_keywords'];
 $product_categories = $_POST['product_categories'];
 $product_brands = $_POST['product_brands'];
 $product_price = $_POST['product_price'];
 $product_status = 'true';

//  images
 $product_image1 = $_FILES['product_image1']['name'];
 $product_image2 = $_FILES['product_image2']['name'];
 $product_image3 = $_FILES['product_image3']['name'];
 
 // image temp name
 $temp_image1 = $_FILES['product_image1']['tmp_name'];
 $temp_image2 = $_FILES['product_image2']['tmp_name'];
 $temp_image3 = $_FILES['product_image3']['tmp_name'];

if ($product_title == '' or $product_description == '' or $product_keywords == '' or $product_categories == '' or $product_brands == '' or $product_price == '' or $product_image1 == '' or $product_image2 == '' or $product_image3 == '' ) {
    // echo "<script>alert('Fill all fields')</script>";
        bottomNotification('fill all place', 'fail', 'insert_products.php');

    exit();
    }
 else{
    move_uploaded_file($temp_image1,"./product_images/$product_image1");
    move_uploaded_file($temp_image2,"./product_images/$product_image2");
    move_uploaded_file($temp_image3,"./product_images/$product_image3");
 

$insert_products = "INSERT INTO `products` (product_title, product_discription, product_keywords, category_id, brand_id, product_image1, product_image2, product_image3, product_price, date, status) VALUES ('$product_title', '$product_description', '$product_keywords', '$product_categories', '$product_brands', '$product_image1', '$product_image2', '$product_image3', '$product_price', NOW(), '$product_status')";

$result_query = mysqli_query($con,$insert_products);

if($result_query){
//    echo "<script>alert('success')</script>" ;   
        bottomNotification('product added successfully', 'success', 'insert_products.php');

}

else{
    echo "error";
}
}
}
?>

<?php 
include('../config/config.php');
include('../functions/common_function.php');
session_start();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home</title>
    <link rel="stylesheet" href="../css/style.css?v=<?php echo filemtime('../css/style.css'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="../css/new_style.css?v=<?php echo filemtime('../css/new_style.css'); ?>">
</head>

<body>

    <!-- start of nav bar -->
    <nav>

        <section class="top-nav">

            <article class="logo">
                <img src="../logo.jpg" alt="">
            </article>

            <article class="nav-icon">
                <span class="top-icons" class="profile-toggle" id="profile-toggle">
                    <i class='fas fa-user'></i>

                </span>

                <div class="mini-profile">
                    <ul>

                        <li><img src='../logo.jpg' alt='$user_image'></li>
                        <?php
        
        if (!isset($_SESSION['admin_name'])) {
            echo " <li>
                            <p>welcome admin</p>
                        </li>";


            echo "<li><a href='./admin_login.php'><i class='fas fa-sign-in-alt'></i>login</a></li>";
        }
        else {
            echo "<li>".$_SESSION['admin_name']."</li>";
            echo "<li><a href='../users/logout.php'><i class='fas fa-sign-out-alt'></i>logout</a></li>";
            echo "<script>window.open(./admin_login.php)</script>";
            
        }
        ?>
                    </ul>

                </div>

            </article>
        </section>
    </nav>


    <form action="" method="post" enctype="multipart/form-data" class="form">
        <h2 class="recent-order">insert a product</h2>
        <!-- title -->
        <div class="single-form">
            <label for="product_title">product title</label>
            <input type="text" name="product_title" id="product_title" class="form-control"
                placeholder="enter product title" autocomplete="off" required="required">
        </div>
        <!--end of title -->
        <!-- description -->
        <div class="single-form">
            <label for="description">description</label>
            <input type="text" name="description" id="description" class="form-control" placeholder="enter description"
                autocomplete="off" required="required">
        </div>
        <!--end of description -->
        <!-- keywords -->
        <div class="single-form">
            <label for="product_keywords">product keywords</label>
            <input type="text" name="product_keywords" id="product_keywords" class="form-control"
                placeholder="enter product keywords" autocomplete="off" required="required">
        </div>
        <!--end of keywords -->

        <!-- categories -->

        <div class="single-form">
            <label for="product_categories">categories</label>
            <select name="product_categories" id="" class="form-select">

                <option value="">select categories</option>
                <?php 
                $select_categories = "SELECT * FROM `categories`";
                $result_categories = mysqli_query($con , $select_categories); 
              
                while(  $row_data = mysqli_fetch_assoc($result_categories)){
                    $category_title = $row_data["category_title"]; 
                    $category_id = $row_data["category_id"];
                     echo "<option value='$category_id'>$category_title</option>";
                   
                }
            
                ?>
            </select>

        </div>
        <!-- brands -->
        <div class="single-form">
            <label for="product_brands">brands</label>
            <select name="product_brands" id="" class="form-select">
                <option value="">select brands</option>
                <?php 
                $select_brands = "SELECT * FROM `brands`";
                $result_brands = mysqli_query($con , $select_brands); 
           
                while(  $row_data = mysqli_fetch_assoc($result_brands)){
                    $brand_title = $row_data["brand_title"]; 
                    $brand_id = $row_data["brand_id"];
 echo "<option value='$brand_id'>$brand_title</option>";
                   
                }
                ?>

            </select>

        </div>


        <!-- images -->
        <div class="single-form">
            <label for="product_keywords">Product Image 1</label>
            <input type="file" name="product_image1" id="product_image1" class="form-control" required="required"
                accept="image/*">
        </div>
        <!--end of image -->
        <!-- images -->
        <div class="single-form">
            <label for="product_keywords">Product Image 2</label>
            <input type="file" name="product_image2" id="product_image2" class="form-control" required="required"
                accept="image/*">
        </div>
        <!--end of image -->
        <!-- images -->
        <div class="single-form">
            <label for="product_keywords">Product Image 3</label>
            <input type="file" name="product_image3" id="product_image3" class="form-control" required="required"
                accept="image/*">
        </div>
        <!--end of image -->

        <!-- price -->
        <div class="single-form">
            <label for="product_price">product price</label>
            <input type="number" name="product_price" id="product_price" class="form-control"
                placeholder="enter product price" autocomplete="off" required="required">
        </div>
        <input type="submit" name="insert_product" class="btn" value="insert products">
        <!--price  -->
    </form>

    <script defer src="../js/script.js?v=<?php echo filemtime('../js/script.js'); ?>"></script>

</body>

</html>