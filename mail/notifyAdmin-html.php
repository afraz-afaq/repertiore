<?php
/**
 * Created by PhpStorm.
 * User: afraz
 * Date: 3/1/2020
 * Time: 11:29 PM
 */
/** @var \app\models\Request $model */
?>

<h3>Hi Admin,</h3>
<p>A new repertoire request has been received following are the details:</p>
<p><span style="font-weight: bold">Name: </span> <?= $model->full_name?></p>
<p><span style="font-weight: bold">Contact: </span> <?=$model->contact?></p>
<p><span style="font-weight: bold">Email: </span> <?=$model->email?></p>
<p><span style="font-weight: bold">Total Runtime: </span> <?=$model->total_runtime?></p>
<h4>Songs:</h4>
<ul>
    <?php foreach ($model->requestSongs as $requestSong): ?>
        <li><?=$requestSong->song->name?></li>
    <?php endforeach;?>
</ul>
