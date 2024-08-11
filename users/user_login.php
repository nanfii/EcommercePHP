<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/style.css?v=<?php echo filemtime('../css/style.css'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="../css/new_style.css?v=<?php echo filemtime('../css/new_style.css'); ?>">

</head>

<body>
    <form action="./log-in-action.php" class="form" method="post" enctype="multipart/form-data">
        <h6 class="recent-order">user login</h6>

        <div class="single-form">
            <label for="name">username</label>
            <input type="text" name="user_username" id="name" placeholder="enter user name" autocomplete="off"
                required="required">
        </div>

        <div class="single-form">
            <label for="password">password</label>
            <input type="password" name="user_password" id="password" placeholder="enter password" autocomplete="off"
                required="required">
        </div>


        <input type="submit" value="login" class="btn" name="user_login">
        <p class="recommendation">don't have an account <a href="../users/registration.php">register</a></p>

    </form>
    <script src="../js/script.js?v=<?php echo filemtime('../js/script.js'); ?>"></script>

</body>

</html>