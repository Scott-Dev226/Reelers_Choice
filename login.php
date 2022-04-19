<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" href="zoneStyle2.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
    integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.6.1/gsap.min.js"
    integrity="sha512-cdV6j5t5o24hkSciVrb8Ki6FveC2SgwGfLE31+ZQRHAeSRxYhAQskLkq3dLm8ZcWe1N3vBOEYmmbhzf7NTtFFQ=="
    crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.6.1/gsap.min.js"
    integrity="sha512-cdV6j5t5o24hkSciVrb8Ki6FveC2SgwGfLE31+ZQRHAeSRxYhAQskLkq3dLm8ZcWe1N3vBOEYmmbhzf7NTtFFQ=="
    crossorigin="anonymous"></script>

  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Reeler's Choice</title>
    <script> 
  
  window.onload = function(){    
    
       gsap.from(".login-form-form", { duration: 1, opacity: 0, delay: 0.5, x: 50 });      
   	}
  
  
  
  
  </script>
</head>

<body class = "login_body">







<section class = "login-form-holder">

<div class = "login-form-form">
       
            <h2 id="login-logo">Reeler's Choice</h2>
         
  <h2 class = "signup-header">Sign in </h2>

<form action="login_logic.php" method="post">
  <input class = "login_field" type="text" name="uid" placeholder="Username...">
  <input class = "login_field" type="password" name="pwd" placeholder="Password...">
  <p style = "color:green; font-weight:bold" class = "api_info1">FOR QUICK LOGIN ~</p>
  <p style = "color:white" class = "api_info">Username: "Guest101"</p>
  <p style = "color:white" class = "api_info">Password: "pass"</p>
  <button type="submit" name="submit" class = "login-submit-btn"> Log In </button>
  <a href= "sign_up.php" class = "api_info"> Need to go back to Create a username? Click here!"</a>



  
</form>





 <img id = "api_logo" src = "tmdb.svg">
<p style = "color:white" class = "api_info">This product uses the TMDb API but is not endorsed or certified by TMDb</p>
</div>

<?php

error_reporting(E_ALL);
ini_set('display_errors', 1); 

if (isset($_GET["error"])) {
  if ($_GET["error"] == "emptyinput") {
    echo "<p class = 'echo-style'> Please Fill in All Fields</p>";
  }

    else if ($_GET["error"] == "TryAgain") {
    echo "<p class = 'echo-style'> Please Try Again!</p>";
  }



}
?>

</section>


</body>

</html>

