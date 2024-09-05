<?php

$server = "localhost";
$username = "root"; 
$password = "";     
$database = "22131051_20141188_22222895";

$mysqli = mysqli_connect($server, $username, $password, $database);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

?>
