<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/style.css?v=<?php echo filemtime('../css/style.css'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="../css/new_style.css?v=<?php echo filemtime('../css/new_style.css'); ?>">
</head>

<body>

    <form action="" class="form" method="post" enctype="multipart/form-data">
        <h6 class="recent-order">admin login</h6>
        <div class="single-form">
            <label for="user_name">Username</label>
            <input type="text" name="admin_name" placeholder="Enter your username" required>
        </div>

        <div class="single-form">
            <label for="user_name">Password</label>
            <input type="password" name="admin_password" placeholder="Enter your password" required>
        </div>
        <input type="submit" value="Login" name="admin_login" class="btn">
        <p class="recommendation">Don't have an account? <a href="./admin_registration.php">register</a></p>

    </form>

    <script src="../js/script.js?v=<?php echo filemtime('../js/script.js'); ?>"></script>
</body>

</html>


<?php
include("../config/config.php");
include("../functions/common_function.php");
// Start session
session_start();
// checking for submit click 
if (isset($_POST['admin_login'])) {
    $username = mysqli_real_escape_string($con, $_POST['admin_name']);
    $password = mysqli_real_escape_string($con, $_POST['admin_password']);
// accessing data from database
    $select_query = "SELECT * FROM `admin_table` WHERE admin_name = ?";
    $stmt = mysqli_prepare($con, $select_query);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row_data = mysqli_fetch_assoc($result);
// checking for password
    if ($row_data && password_verify($password, $row_data['admin_password'])) {
        // Set session variables and redirect to the index page
        $_SESSION['admin_name'] = $row_data['admin_name'];
        // echo "<script>alertMessage('Login successful', 'success', './index.php')</script>";
 bottomNotification('Login successful', 'success', './index.php');
    } else {
        // echo "<script>alertMessage('Invalid username or password', 'fail', './admin_login.php')</script>";
         bottomNotification('Invalid username or password', 'fail', './admin_login.php');    }
}
?>