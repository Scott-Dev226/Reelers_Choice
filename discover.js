function msieversion() {
  var ua = window.navigator.userAgent;
  var msie = ua.indexOf("MSIE ");

  if (msie > 0) {
    // If Internet Explorer, return version number
    alert(parseInt(ua.substring(msie + 5, ua.indexOf(".", msie))));
  } // If another browser, return 0
  else {
    alert("otherbrowser");
  }

  return false;
}

const close_modal = () => {
  let modal = document.getElementById("myModal");

  // When the user clicks anywhere outside of the modal, close it
  document.getElementById("modal_closer").onclick = function () {
    document.getElementById("YT-Clip").src = "";
    modal.style.display = "none";

    document.getElementById("stream1").innerHTML = "N/A";
    document.getElementById("stream2").innerHTML = "";
    document.getElementById("stream3").innerHTML = "";
  };
};

const get_movie_trailer = (movie_ID) => {
  let movie_trailer_key;
  let trailer_url;
  let trailer_lead_url =
    "https://api.themoviedb.org/3/movie/" +
    movie_ID +
    "/videos?api_key=fccbfa7c189f50d5650077f65b125c2d";

  fetch(trailer_lead_url)
    .then(function (resp) {
      return resp.json();
    }) // Convert data to json
    .then(function (data) {
      movie_trailer_key = data.results[0].key;
      trailer_url =
        "https://www.youtube-nocookie.com/embed/" + movie_trailer_key;
      document.getElementById("YT-Clip").src = trailer_url;
    });
};

const get_movie_cast = (movie_ID) => {
  let cast_members = [];

  let cast_url =
    "https://api.themoviedb.org/3/movie/" +
    movie_ID +
    "/credits?api_key=fccbfa7c189f50d5650077f65b125c2d";

  fetch(cast_url)
    .then(function (resp) {
      return resp.json();
    }) // Convert data to json
    .then(function (data) {
      let i;
      for (i = 0; i <= 2; i++) {
        cast_members.push(" " + data.cast[i].name);
      }
      document.getElementById("cast_insert").innerHTML = cast_members;
    });
};

let y = 0;

const getMovieData = (genre_selected) => {
  y = y + 3600;
  document.getElementById("photo_holder").innerHTML = "";
  gsap.to(".cd_spin", { duration: 5, rotation: y });
  const user_keywords = document.getElementById("search").value;
  const search_url =
    "https://api.themoviedb.org/3/search/movie?api_key=fccbfa7c189f50d5650077f65b125c2d&region=US&query=" +
    user_keywords;

  let movieFetchURL;

  const search_str = document.getElementById("search").value.toString();
  if (genre_selected == null) {
    movieFetchURL =
      "https://api.themoviedb.org/3/discover/movie?primary_release_year=2021&sort_by=popularity.desc&region=US&include_video=true&include_adult=false&api_key=fccbfa7c189f50d5650077f65b125c2d";
  } else {
    movieFetchURL =
      "https://api.themoviedb.org/3/discover/movie?with_genres=" +
      genre_selected +
      "&region=US&sort_by=popularity.desc&include_video=true&api_key=fccbfa7c189f50d5650077f65b125c2d";
  }

  if (search_str.length !== 0) {
    movieFetchURL = search_url;
  }

  fetch(movieFetchURL)
    .then(function (resp) {
      return resp.json();
    }) // Convert data to json
    .then(function (data) {
      let posterURLArray = [];
      let movieTitleArray = [];

      let i;
      for (i = 0; i <= 19; i++) {
        posterURLArray.push(data.results[i].poster_path);
        movieTitleArray.push(data.results[i].original_title);

        let img = document.createElement("img"); // create an img element
        let movie_div = document.createElement("div");
        let movie_title = document.createElement("a");

        let t = document.createTextNode(movieTitleArray[i]);
        movie_title.appendChild(t);

        if (posterURLArray[i] === null) {
          img.src = "no-poster.png";
        } else {
          img.src = "https://image.tmdb.org/t/p/w200/" + posterURLArray[i];
        }

        const this_front_cover = posterURLArray[i];

        // set its src to the link l
        const current_movie = document
          .getElementById("photo_holder")
          .appendChild(movie_div);
        const current_title = current_movie.appendChild(movie_title);
        const current_photo = current_movie.appendChild(img);

        current_movie.setAttribute("class", "movie_capsule");
        current_photo.className = "movie_poster";
        current_title.setAttribute("class", "movie_title");

        const this_desc = data.results[i].overview;
        const this_backdrop_poster = data.results[i].backdrop_path;
        const this_title = data.results[i].original_title;
        const this_movieID = data.results[i].id;
        const this_date = data.results[i].release_date;

        current_photo.addEventListener(
          "mouseover",
          function () {
            document.getElementById(
              "main-container"
            ).style.backgroundImage = `url(https://image.tmdb.org/t/p/original/${this_front_cover})`;
            gsap.to(".preview-fade", {
              duration: 2,
              opacity: 1,
              delay: 1,
            });

            document.getElementById(
              "plot-preview-img"
            ).src = `https://image.tmdb.org/t/p/original/${this_backdrop_poster}`;

            document.getElementById("plot-preview-txt").innerHTML = this_desc;
          },
          false
        );

        current_photo.addEventListener(
          "mouseleave",
          function () {
            gsap.to(".preview-fade", {
              duration: 0.1,
              opacity: 0,
            });
          },
          false
        );

        const activate_modal = function () {
          get_movie_trailer(this_movieID);
          get_movie_cast(this_movieID);

          document.getElementById("title_insert").innerHTML = this_title;
          document.getElementById("desc_insert").innerHTML = this_desc;
          document.getElementById(
            "date_insert"
          ).innerHTML = `Release Date: ${this_date}`;

          document.getElementById("myModal").style.display = "block";
          gsap.from(".modal", {
            duration: 0.5,
            opacity: 0,
            y: -100,
          });
          gsap.from(".desc_text_slide", {
            duration: 1,
            opacity: 0,
            delay: 0.5,
            x: -100,
          });
          /*
          document.getElementById(
            "modal_holder"
          ).style.backgroundImage = `url(https://image.tmdb.org/t/p/original/${this_backdrop_poster})`;
          */
        };

        movie_title.onclick = activate_modal;
        current_photo.onclick = activate_modal;
      }

      gsap.from(".movie_capsule", {
        opacity: 0,
        x: -300,
        duration: 0.5,
        stagger: 0.2,
        borderColor: "#91f4c2",
      });
    });
};

const getMovieDataNav = (genre_selected) => {
  document.getElementById("search").value = "";
  getMovieData(genre_selected);
};

const movie_genre_reset = () => {
  document.getElementById("photo_holder").innerHTML = "";
  document.getElementById("search").value = "";
  getMovieData();
};

const user_pinned_content = (user_UID) => {
  let values = {
    pinned_title: document.getElementById("title_insert").innerText,
    user_comments: document.getElementById("pinned_comments").value.toString(),
    user_reaction: document.getElementById("user_rating").value,
    trailer_url: document.getElementById("YT-Clip").src,
    username: user_UID,
  };

  $.ajax({
    url: "reaction.php",
    type: "POST",
    cache: false,
    data: values,
  });

  document.getElementById("myModal").style.display = "none";
};

const user_pinned_content2 = () => {
  user_pinned_content();

  initialPull();
  $("#user_reactions").load(" #user_reactions");
  document.getElementById("pinned_comments").value = "";
};

const initialPull = () => {
  $.ajax({
    url: "initial-pull.php",
    type: "GET",
    cache: false,
    success: function (data) {
      let jsonData = JSON.parse(data);
      console.log(jsonData);

      const setRating = (reaction) => {
        let string = "&#11088;";

        for (let i = 0; i < reaction - 1; i++) {
          string = string + "&#11088;";
        }
        return string;
      };

      let newIndex = 0;
      for (let i = jsonData.length - 1; i > jsonData.length - 6; i--) {
        if (newIndex <= 5) {
          newIndex = newIndex + 1;

          console.log("userID" + newIndex.toString());

          document.getElementById("userID" + newIndex.toString()).innerHTML =
            jsonData[i].user_UID;
          document.getElementById("title" + newIndex.toString()).innerHTML =
            jsonData[i].movie_title;
          document.getElementById("rating" + newIndex.toString()).innerHTML =
            setRating(parseInt(jsonData[i].user_reaction));
          document.getElementById("comments" + newIndex.toString()).innerHTML =
            jsonData[i].user_comments;
          document.getElementById("date" + newIndex.toString()).innerHTML =
            jsonData[i].reaction_time;
        }
      }
    },
  });
};

const myFunction = (event) => {
  if (event.keyCode == 13) {
    getMovieData();
  }
};

let x = 0;

const carousel_push = (direction) => {
  if (direction == "push") {
    x = x - 832;
    gsap.to(".movie_capsule", {
      x: x,
      duration: 1.1,
    });

    if (x <= -2300) {
      gsap.to(".movie_capsule", {
        x: 0,
        duration: 1.5,
      });
      x = 0;
    }
  } else if (direction == "pull" && x <= -832) {
    x = x + 832;
    gsap.to(".movie_capsule", {
      x: x,
      duration: 1.5,
    });
  }
};
