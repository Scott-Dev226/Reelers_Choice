<?php


error_reporting(E_ALL);
ini_set('display_errors', 1); 

if (isset($_POST["submit"])) {  
  
    $username = $_POST["uid"];
    $pwd = $_POST["pwd"];

   require_once 'dbh_logic.php';
   require_once 'functions_logic.php';


      if (emptyInputLogin($username, $pwd) !== false) {
       header("location: login.php?error=emptyinput");
       exit();
   }

   loginUser($conn, $username, $pwd);

}

   else{
       header("location: login.php");
exit();

   }

