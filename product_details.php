<?php
include('./config/config.php');

if(isset($_GET['product_id'])){
    
$product_id = $_GET['product_id'];

$select_query = "SELECT * FROM `products` where `product_id` = $product_id ";
$result_query = mysqli_query($con,$select_query);
while ($row = mysqli_fetch_assoc($result_query)) {
    $product_title = $row['product_title'];
    $product_description = $row['product_discription'];
    $product_keywords = $row['product_keywords'];
    $product_categories = $row['category_id'];
    $product_brands = $row['brand_id'];
    $product_price = $row['product_price'];
    $product_image1 = $row['product_image1'];
    $product_image2 = $row['product_image2'];
    $product_image3 = $row['product_image3'];
}}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>see more</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="./css/new_style.css?v=<?php echo filemtime('./css/new_style.css'); ?>">
</head>

<body>


    <section class="see-more-container">
        <article class="see-more-img-container">
            <div class="main-img">
                <img id="main-img" src="./admin/product_images/<?php echo $product_image1; ?>" alt="">
            </div>
            <div class="other-img-container">
                <div class="other-img"> <img src="./admin/product_images/<?php echo $product_image1; ?>" alt=""></div>
                <div class="other-img"> <img src="./admin/product_images/<?php echo $product_image2; ?>" alt=""></div>
                <div class="other-img"> <img src="./admin/product_images/<?php echo $product_image3; ?>" alt=""></div>
            </div>
        </article>

        <article class="see-more-text-container">
            <?php if(isset($product_id)): ?>
            <h2><?php echo $product_title; ?></h2>
            <p><?php echo $product_keywords; ?></p>
            <p><?php echo $product_description; ?></p>
            <?php else: ?>
            <?php endif; ?>
        </article>
    </section>
    <script src="./js/script.js?v=<?php echo filemtime('./js/script.js'); ?>"></script>
</body>

</html>