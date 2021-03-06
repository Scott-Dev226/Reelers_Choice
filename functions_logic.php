<?php

error_reporting(E_ALL);
ini_set('display_errors', 1); 



function emptyInputSignup($name, $email, $username, $pwd, $pwd_dup) {
    $result;

    if (empty($name) || empty($email) || empty($username) || empty($pwd) || empty($pwd_dup)){
            $result = true;
    }

    else {
         $result = false;
    }    
    return $result;    
}



function invalidUid($username) {
    $result;
    if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
            $result = true;
    }
    else{
         $result = false;
    }    
    return $result;
    
}



function invalidEmail($email) {
    $result;

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $result = true;
    }
    else{
         $result = false;
    }    
    return $result;    
}


function pwdMatch($pwd, $pwd_dup) {
    $result;
    if ($pwd !== $pwd_dup) {
            $result = true;
    }

    else{
         $result = false;
    }    
    return $result;
    
}



function uidExists($conn, $username, $email) {
  $sql = "SELECT * FROM User_Auth WHERE users_UID = ? OR users_Password = ?;";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
       header("location: sign_up.php?error=stmtfailed");
       exit();

  }
mysqli_stmt_bind_param($stmt, "ss", $username, $email);
mysqli_stmt_execute($stmt);


$resultData = mysqli_stmt_get_result($stmt);

if ($row = mysqli_fetch_assoc($resultData)) {
return $row;
}

else {
    $result = false;
    return $result;
}

mysqli_stmt_close($stmt);

}




function createUser($conn, $name, $email, $username, $pwd) {
  $sql = "INSERT INTO User_Auth (users_Name, users_Email, users_UID, users_Password) VALUES (?, ?, ?, ?);";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
       header("location: sign_up.php?error=stmtfailed");
       exit();
  }

$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $username, $hashedPwd);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

         header("location: login.php");
       exit();

}


function emptyInputLogin($username, $pwd) {
    $result;

    if  (empty($username) || empty($pwd)) {
            $result = true;
    }

    else {
         $result = false;
    }    
    return $result;    
}


function loginUser($conn, $username, $pwd) {
$uidExists = uidExists($conn, $username, $username);

if($uidExists === false){
           header("location: login.php?error=wronglogin");
       exit(); 
}

$pwdHashed = $uidExists["users_Password"];
$checkPwd = password_verify($pwd, $pwdHashed);

if ($checkPwd === false){
                header("location: login.php?error=wronglogin");
       exit(); 
}

else if($checkPwd === true){
      session_start();
      $_SESSION["user_ID"] = $uidExists["users_ID"];
      $_SESSION["user_UID"] = $uidExists["users_UID"];

    
                  header("location: Index.php");
                    
                  
       exit();
      
  }

}