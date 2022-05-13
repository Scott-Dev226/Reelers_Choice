<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel="stylesheet" href="zoneStyle2.css" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
      integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l"
      crossorigin="anonymous"
    />
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.6.1/gsap.min.js"
      integrity="sha512-cdV6j5t5o24hkSciVrb8Ki6FveC2SgwGfLE31+ZQRHAeSRxYhAQskLkq3dLm8ZcWe1N3vBOEYmmbhzf7NTtFFQ=="
      crossorigin="anonymous"
    ></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.6.1/gsap.min.js"
      integrity="sha512-cdV6j5t5o24hkSciVrb8Ki6FveC2SgwGfLE31+ZQRHAeSRxYhAQskLkq3dLm8ZcWe1N3vBOEYmmbhzf7NTtFFQ=="
      crossorigin="anonymous"
    ></script>

    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Reeler's Choice</title>

    <script>
      window.onload = function () {
          gsap.to(".signup_body", { duration: 2, opacity: 1 });

        }
      
    </script>
  </head>

  <body class="signup_body">
    <div class="main-signup_site-container">
      <section class="signup-form">
        <div class="signup-form-holder">
          <h2 class="signup-header">Create User Name:</h2>
          <form
            action="sign_up_logic.php"
            method="post"
            class="my_registerform"
          >
            <input
              class="sign_field"
              type="text"
              name="name"
              placeholder="First Name..."
            />
            <input
              class="sign_field"
              type="text"
              name="email"
              placeholder="Enter a Valid Email..."
            />
            <input
              class="sign_field"
              type="text"
              name="uid"
              placeholder="Enter Username..."
            />
            <input
              class="sign_field"
              type="password"
              name="pwd"
              placeholder="Enter Password..."
            />
            <input
              class="sign_field"
              type="password"
              name="pwdrepeat"
              placeholder="Re-enter Password..."
            />

            <div class="buttonHolder">
              <button type="submit" name="submit" class="signup-submit-btn">
                Sign Up
              </button>
            </div>

            <?php
            
            error_reporting(E_ALL);
            ini_set('display_errors', 1); 
            
            if (isset($_GET["error"])) {
              if ($_GET["error"] == "emptyinput") {
                echo "<p class = 'echo-style'> Error - Please Fill in All Fields</p>";
              }
            
               else if ($_GET["error"] == "invaliduid") {
                echo "<p class = 'echo-style'>Error - Please Choose a Proper Username</p>";
              }
            
                 else if ($_GET["error"] == "usernametaken") {
                echo "<p class = 'echo-style'> Error - The selected Username has already been taken! Please try another</p>";
              }
            
                 else if ($_GET["error"] == "invalidemail") {
             echo "<p class = 'echo-style'> Error- Please Choose a Proper Email</p>";
              }
            
                else if ($_GET["error"] == "passwordsdontmatch") {
              echo "<p class = 'echo-style'> Error - Passwords entered do not match</p>";
              }
            
               else if ($_GET["error"] == "stmt failed") {
                echo "<p class = 'echo-style'>Error - Something went wrong, please try again</p>";
              }
            
            }
            ?>
          </form>

          <a href="login.php" class="api_info">
            Already signed up? Click here to Login!"</a
          >

          <img id="api_logo" src="tmdb.svg" />
          <p class="api_info">
            This product uses the TMDb API but is not endorsed or certified by
            TMDb
          </p>
        </div>
      </section>
    </div>
  </body>
</html>
