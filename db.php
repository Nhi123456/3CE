<?php

$servername = "127.0.0.1:53447";
$username = "azure";
$password = "6#vWHD_$";
$db = "dbshoppingcart";

// Create connection
$con = mysqli_connect($servername, $username, $password,$db);

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}


?>
