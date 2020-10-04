<?php

use app\config\Helper;

$image = Helper::getBaseUrl() . Helper::SONG_COVER_PATH . $model['name'] . Helper::SONG_COVER_EXT;
$song = Helper::getBaseUrl() . Helper::SONG_PATH . $model['name'] . ".mp3";
?>


<table style="margin-top:8px;">
    <tr style="width: 200px" style="border: blue">
        <td style="width: 80px">
            <img src="<?= $image ?>" width="80" height="80" />
        </td>
        <td style="padding: 12px; vertical-align:top; background-image: linear-gradient(-90deg, #bd7e7e, #565b55a6);">
            <span style="font-weight: bold"> <?= $model['name'] ?></span><br>
            <span style="font-size: 11px"> <?= $model['artist'] ?></span><br>

            <span class="song-share" style="margin-left:96px;">
                <a href="https://www.facebook.com/sharer/sharer.php?u=https://bandamega.com.br/app/" class="social-btn-<?= $model['id'] ?>" style="visibility:hidden;" target="_blank">
                    <img src="<?= Yii::$app->homeUrl ?>web/images/fb.png" width="23">
                </a>
                <a href="https://web.whatsapp.com/send?text=https://bandamega.com.br/app/" class="social-btn-<?= $model['id'] ?>" style="visibility:hidden;" data-action="share/whatsapp/share" target="_blank">
                    <img src="<?= Yii::$app->homeUrl ?>web/images/whatsapp.png" width="20">
                </a>
                <img src="<?= Yii::$app->homeUrl ?>web/images/share.png" width="15px" onclick="toggleSocialBtns('social-btn-<?= $model['id'] ?>')" style="cursor:pointer" />
            </span>

        </td>
    </tr>
    <tr>
        <td colspan="2">
            <audio style="width: 275px" controls preload="none">
                <source src="<?= $song ?>" type="audio/ogg">
                <source src="<?= $song ?>" type="audio/mpeg">
                Your browser does not support the audio element.
            </audio>
        </td>
    </tr>
</table>