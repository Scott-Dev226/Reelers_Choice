<?php

error_reporting(E_ALL);
ini_set('display_errors', 1); 


if (isset($_POST["submit"])) {

    $name = $_POST["name"];
    $email = $_POST["email"];
   
    $username = $_POST["uid"];
    $pwd = $_POST["pwd"];
    $pwd_dup = $_POST["pwdrepeat"];

   require_once 'dbh_logic.php';
   require_once 'functions_logic.php';


   if (emptyInputSignup($name, $email, $username, $pwd, $pwd_dup) !== false) {
       header("location: sign_up.php?error=emptyinput");
       exit();
   }
   if (invalidUid($username) !== false) {
       header("location: sign_up.php?error=invaliduid");
       exit();
   }
      if (invalidEmail($email) !== false) {
       header("location: sign_up.php?error=invalidemail");
       exit();
   }

  if (pwdMatch($pwd, $pwd_dup) !== false) {
       header("location: sign_up.php?error=passwordsdontmatch");
       exit();
   }

     if (uidExists($conn, $username, $email) !== false) {
       header("location: sign_up.php?error=usernametaken");
       exit();
   }

createUser($conn, $name, $email, $username, $pwd);

}


else {
header("location: sign_up.php");
exit();
 
}