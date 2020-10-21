var total_time = 0;

// Shorthand for $( document ).ready()
$(function () {
  if ($("#search_text").val() == "") $("#clear_search").hide();

  $(document).on("click", ".onCollapse", function () {
    var collapse_id = $(this).attr("href");
    var check = $(collapse_id).attr("aria-expanded");
    if (check == "true") {
      $(this)
        .find('img')
        .first()
        .attr("src", home_url + "web/images/close.png");
    } else if (check == "false") {
      $(this)
        .find('img')
        .first()
        .attr("src", home_url + "web/images/ex.png");
    }
  });
  initPlayers();
});

let playlist = [];
let playerlist = [];

function addToPlaylist(id, runtime) {
  if (checkIfSongIsAvailable(id) == true) {
    alert("Essa música já está em seu repertório.", "danger");
  } else {
    runtime = parseInt(runtime);
    if (total_time + runtime <= max_runtime) {
      total_time += runtime;
      $(".repertoireRuntime").html(
        "Tempo total: " + secToMinutes(total_time) + " minutos"
      );
    } else {
      alert(
        "O limite para o tempo de repertório é de " +
          secToMinutes(max_runtime) +
          " minutos"
      );
      return;
    }

    $.ajax({
      url: home_url + "site/get-song-player?id=" + id,
      type: "get",
      error: function (xhr, status, error) {
        alert(
          "There was an error with your request." +
            xhr.responseText +
            "  " +
            error
        );
      },
    }).done(function (data) {
      var url = data;
      var date = new Date();
      var timestamp = date.getTime();
      id = timestamp + "-" + id;
      var newSong =
        "<div id='remove-" +
        id +
        "' style='margin-left: 16px'>" +
        "<span class='remove-to' onclick='removeFromPlaylist(\"" +
        id +
        '",' +
        runtime +
        ")'>-REMOVER</span> " +
        url +
        "</div>";
      $(".my-songs").append(newSong);
      initPlayers();
      playlist.push(id);
      if (playlist.length > 0) $("#no-songs").hide();

      $("#hiddenRuntime").val(secToMinutes(total_time));
      $("#hiddenSongs").val(playlist.toString());
      $.notify(
        "Música adicionada com sucesso! Tempo Total: " +
          secToMinutes(total_time),
        "info"
      );
    });
  }
}

function removeFromPlaylist(id, runtime) {
  total_time -= runtime;
  $(".repertoireRuntime").html(
    "Tempo total: " + secToMinutes(total_time) + " minutos"
  );
  playlist = playlist.filter(function (value, index, arr) {
    return value !== id;
  });
  $("#remove-" + id).remove();

  if (playlist.length <= 0) $("#no-songs").show();
  $("#hiddenRuntime").val(secToMinutes(total_time));
  $("#hiddenSongs").val(playlist.toString());
  $.notify(
    "Música removida com sucesso! Tempo Total: " + secToMinutes(total_time),
    "info"
  );
}

function secToMinutes(time) {
  var minutes = Math.floor(time / 60);
  var seconds = time - minutes * 60;
  return str_pad_left(minutes, "0", 3) + ":" + str_pad_left(seconds, "0", 2);
}

function str_pad_left(string, pad, length) {
  return (new Array(length + 1).join(pad) + string).slice(-length);
}

$("#request-form")
  .on("beforeSubmit", function (event) {
    $(".submit-btn").attr("disabled", true);
    if (total_time <= 0) {
      alert("Por favor, selecione algumas músicas.");
      event.preventDefault();
      $(".submit-btn").attr("disabled", false);
    }
  })
  .on("submit", function (event) {
    if (total_time <= 0) {
      event.preventDefault();
      $(".submit-btn").attr("disabled", false);
    }
    clearInterval(timer);
  });

function checkIfSongIsAvailable(songId) {
  var check = false;
  for (var i = 0; i < playlist.length; i++) {
    var sid = playlist[i].split("-")[1];
    if (parseInt(sid) === parseInt(songId)) {
      check = true;
      break;
    }
  }

  return check;
}

function checkIfSongPlayerIsAvailable(songId) {
  var check = false;
  for (var i = 0; i < playerlist.length; i++) {
    var sid = playerlist[i];
    if (parseInt(sid) === parseInt(songId)) {
      check = true;
      break;
    }
  }

  return check;
}

$(".mobile-songs-header").click(function () {
  $("html,body").animate(
    {
      scrollTop: $(".my-songs-container").offset().top,
    },
    "slow"
  );
});

$(".up").click(function () {
  var percentageToScroll = 100;
  var percentage = percentageToScroll / 100;
  var height = $(document).scrollTop();
  var scrollAmount = height * (1 - percentage);
  $("html,body").animate({ scrollTop: scrollAmount }, "slow");
});

document.addEventListener(
  "play",
  function (e) {
    var audios = document.getElementsByTagName("audio");
    for (var i = 0, len = audios.length; i < len; i++) {
      if (audios[i] != e.target) {
        audios[i].pause();
        document
          .getElementById("play-btn-" + audios[i].dataset.playerid)
          .classList.remove("pause");
        isPlaying = true;
      }
    }
  },
  true
);

function toggleSocialBtns(btns) {
  const style = $("." + btns).attr("style");
  const visibiltity = style.split(":")[1].trim();
  if (visibiltity == "hidden;")
    $("." + btns).prop("style", "visibility:visible;");
  else $("." + btns).prop("style", "visibility:hidden;");
}

function onSearchFocus(search) {
  $("#clear_search").show();
}

function onSearchFocusOut(search) {
  setTimeout(function () {
    $("#clear_search").hide();
  }, 200);
}

function clearSearch() {
  $("#search_text").val("");
  $("#search_form").submit();
  $("#clear_search").hide();
}

function initProgressBar(currentplayer, currentplayerid) {
  var player = currentplayer;
  var length = player.duration;
  var current_time = player.currentTime;
  let id = "-" + currentplayerid;
  // calculate total length of value
  var totalLength = calculateTotalValue(length);
  document.getElementById("end-time" + id).innerHTML = totalLength;

  // calculate current value time
  var currentTime = calculateCurrentValue(current_time);
  document.getElementById("start-time" + id).innerHTML = currentTime;

  var progressbar = document.getElementById("seek-obj" + id);
  progressbar.value = player.currentTime / player.duration;
  progressbar.addEventListener("click", seek);

  if (player.currentTime == player.duration) {
    console.log("play-btn-" + id);
    document.getElementById("play-btn" + id).classList.remove("pause");
  }

  function seek(event) {
    var percent = event.offsetX / this.offsetWidth;
    player.currentTime = percent * player.duration;
    progressbar.value = percent / 100;
  }
}

function initPlayers() {
  // pass num in if there are multiple audio players e.g 'player' + i

  var audios = document.getElementsByTagName("audio");
  for (var i = 0, len = audios.length; i < len; i++) {
    (function () {
      // Variables
      // ----------------------------------------------------------
      // audio embed object

      curplayer = audios[i];
      let id = curplayer.dataset.playerid;
      if (!checkIfSongPlayerIsAvailable(id)) {
        playerlist.push(id);
        (player = curplayer),
          (isPlaying = false),
          (playBtn = document.getElementById("play-btn-" + id));

        // Controls Listeners
        // ----------------------------------------------------------
        if (playBtn != null) {
          playBtn.addEventListener("click", function (e) {
            togglePlay(id);
          });
        }

        // Controls & Sounds Methods
        // ----------------------------------------------------------
        function togglePlay(player_id) {
          player = document.getElementById("player-" + id);
          console.log(player.paused + "  " + "player-" + id);
          if (player.paused === false) {
            player.pause();
            isPlaying = false;
            document.getElementById("play-btn-" + id).classList.remove("pause");
          } else {
            player.play();
            document.getElementById("play-btn-" + id).classList.add("pause");
            isPlaying = true;
          }
        }
      }
    })();
  }
}

function calculateTotalValue(length) {
  var minutes = Math.floor(length / 60),
    seconds_int = length - minutes * 60,
    seconds_str = seconds_int.toString(),
    seconds = seconds_str.substr(0, 2),
    time = minutes + ":" + seconds;

  return time;
}

function calculateCurrentValue(currentTime) {
  var current_hour = parseInt(currentTime / 3600) % 24,
    current_minute = parseInt(currentTime / 60) % 60,
    current_seconds_long = currentTime % 60,
    current_seconds = current_seconds_long.toFixed(),
    current_time =
      (current_minute < 10 ? "0" + current_minute : current_minute) +
      ":" +
      (current_seconds < 10 ? "0" + current_seconds : current_seconds);

  return current_time;
}
