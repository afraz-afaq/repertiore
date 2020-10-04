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
      (player = curplayer),
        (isPlaying = false),
        (playBtn = document.getElementById("play-btn-" + id));
      console.log(playBtn);
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

// initPlayers(jQuery("#player-container").length);
initPlayers();
