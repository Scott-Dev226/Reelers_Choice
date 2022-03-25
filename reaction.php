<?php
session_start();
$servername = "mysql.nicsco22.dreamhosters.com";
$username = "chaosdblogin";
$password = "Hacker7*";
$dbname = "chaosbackenddb";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection


$current_user = $_SESSION["user_UID"];
$title = $_REQUEST['pinned_title'];
$reaction = $_REQUEST['user_reaction'];
$url = $_REQUEST['trailer_url'];
$comments = $_REQUEST['user_comments'];
$timeStamp = date("m/d/Y");


$result = mysqli_query($conn, 'SELECT * FROM movie_reactions');
$result2 = $result->num_rows + 1;

$sql = "INSERT INTO movie_reactions (movie_title, trailer_url, user_reaction, user_UID, user_comments, reaction_time)
VALUES ('$title', '$url','$reaction', '$current_user', '$comments', '$timeStamp')";

mysqli_query($conn, $sql);
 
 

?>