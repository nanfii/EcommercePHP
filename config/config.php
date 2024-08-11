<?php 

/**
 * Database configuration settings
 * This file contains the database connection setup for the application.
 */
$con = mysqli_connect("localhost","root","","store");

// Check the connection and handle errors
if(!$con){
    echo "connecction failed";
}

?>
