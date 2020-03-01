<?php
/**
 * Created by PhpStorm.
 * User: afraz
 * Date: 3/1/2020
 * Time: 11:29 PM
 */
/** @var \app\models\Request $model */
?>


<h3>Hi <?=$model->full_name?>,</h3>
<p>Your repertoire request has been received. We will contact you shortly
through the provided contact information.</p>
<p><span style="font-weight: bold">Contact: </span> <?=$model->contact?></p>
<p><span style="font-weight: bold">Email: </span> <?=$model->email?></p>
<p><span style="font-weight: bold">Total Runtime: </span> <?=$model->total_runtime?></p>
<h4>Songs:</h4>
<ul>
    <?php foreach ($model->requestSongs as $requestSong): ?>
        <li><?=$requestSong->song->name?></li>
    <?php endforeach;?>
</ul>
