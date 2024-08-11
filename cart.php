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
    
    
}?>

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


    <form action="" method="post">
        <section class="all-cart">
            <?php 
                    global $con;
                    $get_ip_address = getRealIPAddr();
                    $total_price = 0;
                    $cart_query = "SELECT * FROM `cart` WHERE ip_address='$get_ip_address'";
                    $result = mysqli_query($con,$cart_query);
                    $result_count = mysqli_num_rows($result);
                    if($result_count > 0){
                        
                        while ($row=mysqli_fetch_array($result)) {
                            $product_id = $row['product_id'];
                            $select_products = "SELECT * FROM `products` WHERE product_id='$product_id'";
                            $result_product = mysqli_query($con,$select_products);
                            while ($row_product_price = mysqli_fetch_array($result_product)) {
                                $product_price = array($row_product_price['product_price']);
                                $price_table = $row_product_price['product_price'];
                                $product_title = $row_product_price['product_title'];
                                $product_image1 = $row_product_price['product_image1'];
                                $product_values= array_sum($product_price);
                                $total_price+=$product_values;
                                ?>
            <div class='cart-card'>
                <div class='ratio-box'>
                    <img src="admin/product_images/<?php echo $product_image1?>" class='the-img' alt='$product_title'>
                </div>
                <?php 
                     $get_ip_address = getRealIPAddr();
                    if(isset($_POST['update_cart'])){
                        $quantities = $_POST['quantity'];
                        $update_cart = "UPDATE `cart` SET quantity='$quantities' WHERE product_id=$product_id AND ip_address='$get_ip_address'";
                        $result_quantity = mysqli_query($con, $update_cart);
                $total_price=$total_price * $quantities;
            }
            
                    ?>

                <div class='card-body'>
                    <div class='card-info'>
                        <span class='product-name'><?php echo $product_title?></span>
                        <span class='card-price'><?php echo $price_table?></span>
                    </div>
                    <div class='card-buttons'>

                        <input type="text" class="quantity-input" name="quantity">
                        <input type="submit" value="update" class="see-more" name="update_cart">
                    </div>
                    <div class='card-buttons'>

                        <input type="checkbox" name="remove_item[]" value="<?php echo $product_id?>">
                        <input type="submit" value="remove" class="see-more" name="remove_cart">
                    </div>
                </div>

            </div>

            <?php 
                     $get_ip_address = getRealIPAddr();
                    if(isset($_POST['update_cart'])){
                        $quantities = $_POST['quantity'];
                        $update_cart = "UPDATE `cart` SET quantity='$quantities' WHERE product_id=$product_id AND ip_address='$get_ip_address'";
                        $result_quantity = mysqli_query($con, $update_cart);
                        
                        
        bottomNotification('item updated successfully', 'success', 'cart.php');

            }
            
            ?>


            <?php 
                            }
                        }
                    
                    }
                    else {
                        echo "<h2>no cart</h2>";
                    }
                    ?>

        </section>

        <?php 
                    global $con;
                    $get_ip_address = getRealIPAddr();
                    $cart_query = "SELECT * FROM `cart` WHERE ip_address='$get_ip_address'";
                    $result = mysqli_query($con,$cart_query);
                    $result_count = mysqli_num_rows($result);
                  
                    if($result_count > 0){
                        echo "
                        <div class='out-put'>
                        <p class='total-price'>total :  "?>

        <?php total_cart_price() ?>
        <?php
        echo "
        <span></span> </p>
        <a href='index.php' class='see-more'>continue shopping</a>
        <a href='./users/checkout.php' class='see-more'>check out</a>

        ";}
        else {
        echo "

        <a href='index.php' class='see-more align'>continue shopping</a>
        </div>
        ";


        }
        ?>
    </form>
    </div>
    <?php  
        function remove_cart(){
            global $con;
            if(isset($_POST['remove_cart'])){
                foreach($_POST['remove_item'] as $remove_id){
                    $delete_query = "DELETE FROM `cart` WHERE product_id=$remove_id" ;
                    $run_delete = mysqli_query($con,$delete_query);
                    if($run_delete){
        bottomNotification('item removed successfully', 'success', 'index.php');
                        
                        // echo "<script>window.open('index.php','_self')</script>";
                    }
                }
            }
        }
        remove_cart();

       
    ?>

    <script src="./js/script.js?v=<?php echo filemtime('./js/script.js'); ?>"></script>

</body>

</html>