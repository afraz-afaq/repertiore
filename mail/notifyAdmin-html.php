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
<table style="border-collapse: collapse; width: 400px; text-align: center;" border="1"  >
    <thead>
    <th style="padding: 10px;">Songs</th>
    <th style="padding: 10px;">Gênero</th>
    </thead>
    <tbody>
    <?php foreach ($model->requestSongs as $requestSong): ?>
        <tr>
            <td style="padding: 10px;"><?=$requestSong->song->name?></td>
            <td style="padding: 10px;"><?=$requestSong->song->genre->name?></td>
        </tr>
    <?php endforeach;?>
    </tbody>
</table>
