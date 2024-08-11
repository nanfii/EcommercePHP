<?php 




$query = "SELECT * FROM `products where`";




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
                <img id="main-img" src="./admin\product_images/logo.jpg" alt="">
            </div>
            <div class="other-img-container">
                <div class="other-img"> <img src="./admin\product_images/logo.jpg" alt=""></div>
                <div class="other-img"> <img src="./admin\product_images/logo.jpg" alt=""></div>
                <div class="other-img"> <img src="./admin\product_images/banner.png" alt=""></div>
            </div>
        </article>

        <article class="see-more-text-container">
            <h2>product title</h2>
            <p>10</p>
            <p>key words</p>

            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Iusto debitis voluptatum non? Nostrum,
                delectus
                quam.</p>
        </article>
    </section>

    <script src="./js/script.js?v=<?php echo filemtime('./js/script.js'); ?>"></script>

</body>


</html>