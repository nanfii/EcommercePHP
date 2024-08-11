<?php 
include('../config/config.php');
include('../functions/common_function.php');
session_start();
if(isset($_SESSION['username'])){

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
    echo "<li><img src='./users_image/$user_image' alt='$user_image'></li> ";

}

                              ?>


                        <?php 
        
        if (!isset($_SESSION['username'])) {
            echo " <li>
                            <p>welcome gust</p>
                        </li>";


            echo "<li><a href='./user_login.php'><i class='fas fa-sign-in-alt'></i>login</a></li>";
        }
        else {
            echo "<li>".$_SESSION['username']."</li>";
            echo "<li><a href='./logout.php'><i class='fas fa-sign-out-alt'></i>logout</a></li>";
            
        }
        ?>
                    </ul>

                </div>
                <span class="top-icons">
                    <a href="../cart.php">
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
                    <a href="../index.php">
                        <span class="icon"><i class="fa fa-home"></i> </span>home
                    </a>
                </li>
                <li class="nav-list">
                    <a href="../display_all.php">
                        <span class="icon"><i class="fas fa-shopping-bag"></i> </span>products
                    </a>
                </li>
                <?php 
                     if (!isset($_SESSION['username'])) {
          echo "<li class='nav-list'><a href='registration.php'>
                        <span class='icon'><i fas fa-user-plus></i> </span>
                        register</a></li>";
        }
        else {
             echo "<li class='nav-list'><a href='profile.php'>
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




    <div class="container">
        <aside class="left-side-menu">

            <!-- <div class="logo">
                <span>as</span>
                <h1 class="title">Asmr<span>prog</span></h1>
            </div> -->
            <div class="main-menu">
                <ul class="lists">


                    <li class="link active">
                        <a href="profile.php?dashboard"><span class="menu-icon"><i
                                    class="fas fa-tachometer-alt"></i></span><span class="menu-text">dashboard</span>
                        </a>
                    </li>


                    <li class="link">
                        <a href="profile.php?pending_order"><span class="menu-icon"><i
                                    class="fas fa-hourglass-half"></i></span><span class="menu-text">pending
                                order</span>

                        </a>
                    </li>
                    <li class="link">
                        <a href="profile.php?edit_account"><span class="menu-icon"><i
                                    class="fas fa-user-edit"></i></span><span class="menu-text">edit account</span>

                        </a>
                    </li>
                    <li class="link">
                        <a href="profile.php?my_orders"><span class="menu-icon"><i
                                    class="fas fa-shopping-bag"></i></span><span class="menu-text"> my orders</span>

                        </a>
                    </li>
                    <li class="link">
                        <a href="profile.php?delete_account"><span class="menu-icon"><i
                                    class="fas fa-user-times"></i></span><span class="menu-text">delete account</span>

                        </a>
                    </li>
                    <li class="link list">
                        <a href="logout.php"><span class="menu-icon"><i class="fas fa-home"></i></span><span
                                class="menu-text">logout</span>

                        </a>
                    </li>
                </ul>
            </div>
        </aside>

        <main>

            <?php 
if (isset($_GET['edit_account'])) {
    include('edit_account.php');
}
if (isset($_GET['pending_order'])) {
    include('pending_order.php');
}
if (isset($_GET['my_orders'])) {
include('my_orders.php');
}
if (isset($_GET['delete_account'])) {
include('delete_account.php');
}
if (isset($_GET['dashboard'])) {
    include('dashboard.php');
}
else  {
    include('dashboard.php');
}
?>
        </main>

        <aside>

            <div>
                <div class="company">

                    <?php
                    if(isset($_SESSION['username'])){

                        echo "<img src='./users_image/$user_image' alt='$user_image'";
                        //   echo "<p class='work'>$username</p>";
                        echo "<li class='work'>".$_SESSION['username']."</li>";
                        echo "<li><a href='logout.php'><i class='fas fa-sign-out-alt'></i>logout</a></li>";
                    }
     
        else {
            echo "<li class='not-login'> <i class='fas fa-user'></i></li>";
            echo "<li>gust</li>";
            echo "<li><a href='logout.php'><i class='fas fa-sign-out-alt'></i>logout</a></li>";
            
        }
        ?>
                </div>
            </div>
        </aside>
    </div>









    <script src="../js/script.js?v=<?php echo filemtime('../js/script.js'); ?>"></script>

</body>

</html>