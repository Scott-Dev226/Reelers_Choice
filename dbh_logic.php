<?php
$servername = "mysql.nicsco22.dreamhosters.com";
$username2 = "chaosdblogin";
$password = "Hacker7*";
$name2 = "chaosbackenddb";

// Create connection
$conn = mysqli_connect($servername, $username2, $password, $name2);
// Check connection

if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}