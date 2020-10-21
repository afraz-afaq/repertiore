<?php

use app\config\Helper;

$image = Helper::getBaseUrl() . Helper::SONG_COVER_PATH . $model['link_name']  . Helper::SONG_COVER_EXT;
$song = Helper::getBaseUrl() . Helper::SONG_PATH . $model['link_name']  . ".mp3";
$id = isset($id) ? $id : $model['id'];
?>



<div class="audio-player">
    <div id="play-btn-<?= $id ?>" class="play-btn"></div>

    <img class="album-image-<?= $id ?> album-image" src="<?= $image ?>" />
    <div class="audio-wrapper" id="player-container" href="javascript:;">
        <audio id="player-<?= $id ?>" data-playerid="<?= $id ?>" ontimeupdate="initProgressBar(this,<?= $id ?>)" preload="none">
            <source src="<?= $song ?>" type="audio/mp3" />
        </audio>
    </div>
    <div class="player-controls scrubber">
        <p><span style="font-weight: bold"><?= $model['name'] ?></span> <small><br></small><?= $model['artist'] ? $model['artist'] : "
não disponível" ?></p>
        <span class="song-share" style="margin-left:96px;">
            <a href="https://www.facebook.com/sharer/sharer.php?u=https://bandamega.com.br/" class="social-btn-<?= $id ?>" style="visibility:hidden;" target="_blank">
                <img src="<?= Yii::$app->homeUrl ?>web/images/fb.png" width="23">
            </a>
            <a href="https://web.whatsapp.com/send?text=https://bandamega.com.br/" class="social-btn-<?= $id ?>" style="visibility:hidden;" data-action="share/whatsapp/share" target="_blank">
                <img src="<?= Yii::$app->homeUrl ?>web/images/whatsapp.png" width="20">
            </a>
            <img src="<?= Yii::$app->homeUrl ?>web/images/share.png" width="15px" onclick="toggleSocialBtns('social-btn-<?= $id ?>')" style="cursor:pointer" />
        </span>
        <div class="seek">
            <span id="seek-obj-container">
                <progress id="seek-obj-<?= $id ?>" value="0" max="1"></progress>
            </span>
            <small style="float: left; position: relative; left: 15px;" id="start-time-<?= $id ?>">00:00</small>
            <small style="float: right; position: relative; right: 20px;" id="end-time-<?= $id ?>">00:00</small>
        </div>
    </div>
</div>