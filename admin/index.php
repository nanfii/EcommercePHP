<?php 
include('../config/config.php');
include('../functions/common_function.php');
session_start();
// // Check if the user is logged in
// if (!isset($_SESSION['user_logged_in']) || $_SESSION['user_logged_in'] !== true) {
//     // If the user is not logged in, redirect them to the login page
//     header("Location: admin_login.php");
//     exit;
// }
// else{
//   echo "<scrip>window.open('./index.php','_self')</scrip>";
    
// }
// ?>


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
                            welcome admin
                        </li>";

            echo "<li><a href='./admin_login.php'><i class='fas fa-sign-in-alt'></i>login</a></li>";
        }
        else {
            echo "<li>".$_SESSION['admin_name']."</li>";
            echo "<li><a href='./admin_logout.php'><i class='fas fa-sign-out-alt'></i>logout</a></li>";
            echo "<script>window.open('./index.php')</script>";
            
        }
        ?>
                    </ul>

                </div>

            </article>
        </section>
    </nav>
    <!-- ERROR DISPLAY -->
    <main class="main-section2">

        <aside class="main-menu2">
            <ul class="lists">
                <li class="link active"><a href="insert_product.php"><span class="menu-icon"><i
                                class="fas fa-plus-circle"></i></span><span class="menu-text">insert products</a>
                </li>
                <li class="link"><a href="index.php?view_products"><span class="menu-icon"><i
                                class="fas fa-eye"></i></span><span class="menu-text">view products</a></li>
                <li class="link"><a href="index.php?insert-category"><span class="menu-icon"><i
                                class="fas fa-plus-circle"></i></span><span class="menu-text"></span>
                        insert category</a></li>
                <li class="link"><a href="index.php?view_category"><span class="menu-icon"><i
                                class="fas fa-eye"></i></span><span class="menu-text"></span>
                        view category</a></li>
                <li class="link"><a href="index.php?insert-brands"><span class="menu-icon"><i
                                class="fas fa-plus-circle"></i></span><span class="menu-text"></span>
                        insert brands</a></li>
                <li class="link"><a href="index.php?view_brands"><span class="menu-icon"><i
                                class="fas fa-eye"></i></span><span class="menu-text"></span>
                        view brands</a></li>
                <li class="link"><a href="index.php?all_orders"><span class="menu-icon"><i
                                class="fas fa-list-alt"></i></span><span class="menu-text"></span>
                        all orders</a></li>
                <li class="link"><a href="index.php?all_payments"><span class="menu-icon"><i
                                class="fas fa-money-bill-alt"></i></span><span class="menu-text"></span>
                        all payments</a></li>
                <li class="link"><a href="index.php?list_users"><span class="menu-icon"><i
                                class="fas fa-users"></i></span><span class="menu-text"></span>
                        user list</a></li>
                <li class="link list"><a href="./admin_logout.php"><span class="menu-icon"><i
                                class="fas fa-sign-out-alt"></i></span><span class="menu-text"></span>
                        log out</a></li>
            </ul>
        </aside>

        <section class="contents">
            <?php

// Get the total number of products
$total_products_query = "SELECT COUNT(*) as total_products FROM `products`";
$total_products_result = mysqli_query($con, $total_products_query);
if ($total_products_result) {
    $total_products_row = mysqli_fetch_assoc($total_products_result);
    $total_products = $total_products_row['total_products'];
} else {
    $total_products = 0;
}

// Get the total number of orders
$total_orders_query = "SELECT COUNT(*) as total_orders FROM `order_pending`";
$total_orders_result = mysqli_query($con, $total_orders_query);
if ($total_orders_result) {
    $total_orders_row = mysqli_fetch_assoc($total_orders_result);
    $total_orders = $total_orders_row['total_orders'];
} else {
    $total_orders = 0;
}

// Get the total number of users
$total_users_query = "SELECT COUNT(*) as total_users FROM `user`";
$total_users_result = mysqli_query($con, $total_users_query);
if ($total_users_result) {
    $total_users_row = mysqli_fetch_assoc($total_users_result);
    $total_users = $total_users_row['total_users'];
} else {
    $total_users = 0;
}

// Calculate the total revenue
$total_revenue_query = "SELECT SUM(product_price * quantity) as total_revenue FROM `order_pending`";
$total_revenue_result = mysqli_query($con, $total_revenue_query);
if ($total_revenue_result) {
    $total_revenue_row = mysqli_fetch_assoc($total_revenue_result);
    $total_revenue = $total_revenue_row['total_revenue'];
} else {
    $total_revenue = 0;
}

// Display the HTML with the analytics information
echo "<article class='dash-board'>
    <h2 class='recent-order'>Analytics</h2>
    <div class='analytics'>
        <section class='analytic'>
            <div class='info'>
                <p class=''>total products</p>
                <h1>$total_products</h1>
            </div>
            <div class='graph1'><i class='fas fa-box-open'></i></div>
        </section>
        <section class='analytic'>
            <div class='info'>
                <p class=''>total order</p>
                <h1>$total_orders</h1>
            </div>
            <div class='graph2'><i class='fas fa-shopping-cart'></i></div>
        </section>
        <section class='analytic'>
            <div class='info'>
                <p class=''>total users</p>
                <h1>$total_users</h1>
            </div>
            <div class='graph3'><i class='fas fa-users'></i></div>
        </section>
        <section class='analytic'>
            <div class='info'>
                <p class=''>Total Revenue</p>
                <h1>$total_revenue</h1>
            </div>
            <div class='graph4'><i class='fas fa-chart-line'></i></div>
        </section>
    </div>
</article>";
?>

            <article>

                <?php 
            
            if(isset($_GET['insert-category'])){

                include('insert-category.php');
            }
            if(isset($_GET['insert-brands'])){

                include('insert-brands.php');
            }
            if(isset($_GET['view_products'])){
                
                include('view_products.php');
            }
            if(isset($_GET['edit_products'])){
                
                include('edit_products.php');
            }
            if(isset($_GET['delete_product'])){

                include('delete_product.php');
            }
            if(isset($_GET['view_category'])){
                
                include('view_category.php');
            }
            if(isset($_GET['view_brands'])){

                include('view_brands.php');
            }
            if(isset($_GET['edit_category'])){

                include('edit_category.php');
            }
            if(isset($_GET['edit_brand'])){

                include('edit_brand.php');
            }
            if(isset($_GET['delete_brand'])){

                include('delete_brand.php');
            }
            if(isset($_GET['all_orders'])){

                include('all_orders.php');
            }
            if(isset($_GET['delete_category'])){
                
            include('delete_category.php');
        }
        if(isset($_GET['all_payments'])){
            
            include('all_payments.php');
        }
        if(isset($_GET['list_users'])){
                
                include('list_users.php');
            }
            ?>
            </article>
        </section>
    </main>
    <script defer src="../js/script.js?v=<?php echo filemtime('../js/script.js'); ?>"></script>
</body>

</html>