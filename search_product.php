<?php 
include('./config/config.php');
include('./functions/common_function.php');
session_start();
if(isset( $_SESSION['username'])){

    $username = $_SESSION['username'];
    $user_image = "select * from `user` where username='$username'";
    $result_image = mysqli_query($con,$user_image);
    $row_image = mysqli_fetch_array($result_image);
    $user_image = $row_image['user_image'];
    
    
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="./css/new_style.css?v=<?php echo filemtime('./css/new_style.css'); ?>">
</head>

<body>

    <!-- start of nav bar -->
    <nav>

        <section class="top-nav">

            <article class="logo">
                <img src="./logo.jpg" alt="">
            </article>

            <form action="search_product.php" method="get" class="search-form">
                <input type="search" class="search" placeholder="Search a product..." name="search_data">
                <input type="submit" value="Search" name="search_data_product">
            </form>
            <article class="nav-icon">
                <span class="top-icons" class="profile-toggle" id="profile-toggle">
                    <i class='fas fa-user'></i>

                </span>

                <div class="mini-profile">
                    <ul>

                        <?php
                        
                          if (!isset($_SESSION['username'])) {
                            echo "<li class='not-login'> <i class='fas fa-user'></i></li>";
                        }
                        else{
    echo "<li><img src='./users/users_image/$user_image' alt='$user_image'></li> ";

}

                              ?>


                        <?php 
        
        if (!isset($_SESSION['username'])) {
            echo " <li>
                            <p>welcome gust</p>
                        </li>";


            echo "<li><a href='./users/user_login.php'><i class='fas fa-sign-in-alt'></i>login</a></li>";
        }
        else {
            echo "<li>".$_SESSION['username']."</li>";
            echo "<li><a href='./users/logout.php'><i class='fas fa-sign-out-alt'></i>logout</a></li>";
            
        }

        ?>
                    </ul>

                </div>
                <span class="top-icons">
                    <a href="cart.php">
                        <i class="fas fa-shopping-bag"></i>
                        <span class="top-text">
                            <?php 
                            cart_item();
                            ?>
                        </span>
                    </a>
                </span>
                <span class="price-top">
                    <?php 
                         total_cart_price()
                        ?>
                </span>
            </article>
        </section>
        <section class="bottom-nav">

            <ul class="nav-lists">
                <li class="nav-list active">
                    <a href="index.php">
                        <span class="icon"><i class="fa fa-home"></i> </span>home
                    </a>
                </li>
                <li class="nav-list">
                    <a href="display_all.php">
                        <span class="icon"><i class="fas fa-shopping-bag"></i> </span>products
                    </a>
                </li>
                <?php 
                     if (!isset($_SESSION['username'])) {
          echo "<li class='nav-list'><a href='users/registration.php'>
                        <span class='icon'><i fas fa-user-plus></i> </span>
                        register</a></li>";
        }
        else {
             echo "<li class='nav-list'><a href='users/profile.php'>
                       <span class='icon'><i class='fas fa-user'></i> </span>my account 
                        </a></li>";
        }
                    ?>
                <li class="nav-list"><a href="">
                        <span class="icon"><i class="fas fa-envelope"></i> </span>contact
                    </a></li>

            </ul>
        </section>
    </nav>
    <?php                             
    cart()                     
?>


    <!-- ERROR DISPLAY -->

    <main class="main-section">
        <!-- products -->
        <!-- </section> -->

        <section class="main-menu">
            <div class="profile">
            </div>
            <div class="category">
                <h2 class="title">category</h2>
                <ul class="category-list">
                    <?php 
                get_category()
                ?>
                </ul>
            </div>
            <div class="factory">
                <h2 class="title">brand</h2>
                <ul class="category-list">
                    <?php 
                    get_brands()
                ?>
                </ul>
            </div>
        </section>

        <section class="products">
            <?php 
                      search_product();

            get_filtered_product_category();
            get_filtered_product_brand();
?>
        </section>
        <!-- end of side bar -->

    </main>
    <!-- footer -->

    <?php 

include('./config/footer.php')

?>


    <script src="./js/script.js?v=<?php echo filemtime('./js/script.js'); ?>"></script>
</body>

</html>