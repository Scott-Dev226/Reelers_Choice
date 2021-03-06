<?php

session_start();

if (!isset($_SESSION["user_UID"])) {
    header("location: sign_up.php");
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel="stylesheet" href="zoneStyle2.css" /> 
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.6.1/gsap.min.js"
      integrity="sha512-cdV6j5t5o24hkSciVrb8Ki6FveC2SgwGfLE31+ZQRHAeSRxYhAQskLkq3dLm8ZcWe1N3vBOEYmmbhzf7NTtFFQ=="
      crossorigin="anonymous"
    ></script>
    <script src="discover.js"></script>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Reeler's Choice</title>
  </head>

  <body class="index_body" id="index_body_ID">
    <script>
      window.onload = function(){
        gsap.to(".movie_Info_Div", { duration: 2.5, opacity: 1 });
        var userZip = "<?php echo "$jackpotZip" ?>"
        getMovieData();
        initialPull();      
      }
    </script>

    <div id="navholder">
      <nav id="Nav-Bar">
        <ul id="Nav-List">
          <img id="snow_logo" class="cd_spin" src="cd.jpg" />
          <li id="site-logo">
            <p>Reeler's Choice</p>
          </li>
          
        <?php

        if (isset($_SESSION["user_UID"])) {
            $jackpot = $_SESSION["user_UID"];
            $jackpotZip = $_SESSION["user_Zip"];
            echo "<p id = 'welcome_msg'> Welcome, <span style = 'color:orange'>{$jackpot}!! </span> </p>";

        } else {
            echo "No Users are Logged in";
        }

        ?>
        <li id="Nav-Item">
          <div id="search_holder">
            <input box type="text" id="search" placeholder="Search for any Movie... (+ Enter)"
              onkeypress="myFunction(event)" />
          </div>
        </li>

        <li id="Nav-Item" class="nav_hover" onclick="getMovieDataNav(80)">
          ACTION
        </li>
        <li id="Nav-Item" class="nav_hover" onclick="getMovieDataNav(27)">
          HORROR
        </li>
        <li id="Nav-Item" class="nav_hover" onclick="getMovieDataNav(878)">
          SCI-FI
        </li>
        <li id="Nav-Item" class="nav_hover" onclick="getMovieDataNav(35)">
          COMEDY
        </li>
        <li id="Nav-Item" class="nav_hover" onclick="getMovieDataNav(10402)">
          MUSIC
        </li>
        <li id="Nav-Item">
          <a href="logout_logic.php" class="Nav-Slide">LOGOUT</a>
        </li>
      </ul>
    </nav>
  </div>

  <div id="main-container" class="dynamic_HQ">
    <div class="movie_Info_Div" id="movie_Info_Div">
      <div id="myModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content" id="modal_holder">
          <img class="close" id="modal_closer" src="close-btn.png" onclick="close_modal()" />
          <h1 id="title_insert" class="desc_text_slide">N/A</h1>
          <p id="date_insert"></p>
          <p id="cast_insert"></p>
          <img id="backdrop_poster_img" />
          <div id="trailer_holder">
            <iframe id="YT-Clip" width="500" height="300" src="" frameborder="0"
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
              allowfullscreen></iframe>
          </div>

          <p id="desc_insert" class="desc_text_slide">N/A</p>

          <input box id="pinned_comments" type="text" name="comments" placeholder="Enter Comments..." />

          <select name="reaction" id="user_rating">
            <option value="1">1 STAR</option>
            <option value="2">2 STARS</option>
            <option value="3">3 STARS</option>
            <option value="4">4 STARS</option>
            <option value="5">5 STARS</option>
          </select>

          <button class="btn btn-primary" id="reaction_btn" type="button" onclick="user_pinned_content2()">
            Click Here to Submit
          </button>
        </div>
      </div>

      <img id="carousel-btn2" src="red_arrow.png" onclick="carousel_push('pull')" />
      <img src="green_arrow.png" id="carousel-btn" type="button" onclick="carousel_push('push')" />

      <div id="photo_holder" class="photo_slide"></div>
      <div id="plot-preview-holder">
        <div class="preview-fade">
          <img id="plot-preview-img" src="ticket.jpg" />
          <p id="plot-preview-txt"></p>
        </div>
      </div>

      <div id="user_reactions">
        <div id="user1_reaction" class="user_reaction_ind">
          <ul>
            <li id="reaction_line">
              <span style="color: red"> RATING: </span>
              <span id="rating1"> </span>
            </li>
            <li id="reaction_line">
              <span style="color: red"> DATE: </span>
              <span id="date1"> </span>
            </li>
            <li id="reaction_line">
              <span style="color: red"> USERNAME: </span>
              <span id="userID1"> </span>
            </li>
            <li id="reaction_line">
              <span style="color: red"> MOVIE TITLE: </span>
              <span id="title1"> </span>
            </li>

            <li id="reaction_line">
              <span style="color: red"> COMMENTS: </span>
              <span id="comments1"> </span>
            </li>
          </ul>
        </div>

        <div id="user2_reaction" class="user_reaction_ind">
          <ul>
            <li id="reaction_line">
              <span style="color: blue"> RATING: </span>
              <span id="rating2"> </span>
            </li>
            <li id="reaction_line">
              <span style="color: blue"> DATE: </span>
              <span id="date2"> </span>
            </li>
            <li id="reaction_line">
              <span style="color: blue"> USERNAME: </span>
              <span id="userID2"> </span>
            </li>
            <li id="reaction_line">
              <span style="color: blue"> MOVIE TITLE: </span>
              <span id="title2"> </span>
            </li>
            <li id="reaction_line">
              <span style="color: blue"> COMMENTS: </span>
              <span id="comments2"> </span>
            </li>
          </ul>
        </div>

        <div id="user3_reaction" class="user_reaction_ind">
          <ul>
            <li id="reaction_line">
              <span style="color: green"> RATING: </span>
              <span id="rating3"> </span>
            </li>
            <li id="reaction_line">
              <span style="color: green"> DATE: </span>
              <span id="date3"> </span>
            </li>
            <li id="reaction_line">
              <span style="color: green"> USERNAME: </span>
              <span id="userID3"> </span>
            </li>
            <li id="reaction_line">
              <span style="color: green"> MOVIE TITLE: </span>
              <span id="title3"> </span>
            </li>
            <li id="reaction_line">
              <span style="color: green"> COMMENTS: </span>
              <span id="comments3"> </span>
            </li>
          </ul>
        </div>

        <div id="user4_reaction" class="user_reaction_ind">
          <ul>
            <li id="reaction_line">
              <span style="color: brown"> RATING: </span>
              <span id="rating4"> </span>
            </li>
            <li id="reaction_line">
              <span style="color: brown"> DATE: </span>
              <span id="date4"> </span>
            </li>
            <li id="reaction_line">
              <span style="color: brown"> USERNAME: </span>
              <span id="userID4"> </span>
            </li>
            <li id="reaction_line">
              <span style="color: brown"> MOVIE TITLE: </span>
              <span id="title4"> </span>
            </li>
            <li id="reaction_line">
              <span style="color: brown"> COMMENTS: </span>
              <span id="comments4"> </span>
            </li>
          </ul>
        </div>

        <div id="user5_reaction" class="user_reaction_ind">
          <ul>
            <li id="reaction_line">
              <span style="color: grey"> RATING: </span>
              <span id="rating5"> </span>
            </li>
            <li id="reaction_line">
              <span style="color: grey"> DATE: </span>
              <span id="date5"> </span>
            </li>
            <li id="reaction_line">
              <span style="color: grey"> USERNAME: </span>
              <span id="userID5"> </span>
            </li>
            <li id="reaction_line">
              <span style="color: grey"> MOVIE TITLE: </span>
              <span id="title5"> </span>
            </li>
            <li id="reaction_line">
              <span style="color: grey"> COMMENTS: </span>
              <span id="comments5"> </span>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</body>

</html>