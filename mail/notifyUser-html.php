<?php
/**
 * Created by PhpStorm.
 * User: afraz
 * Date: 3/1/2020
 * Time: 11:29 PM
 */
/** @var \app\models\Request $model */
?>


<h3>Olá <?=$model->full_name?>,</h3>
<p>Aqui está o repertório que você selecionou.</p>
<p>Será um prazer tocarmos este repertório ao vivo no seu evento!</p>
<p>Em breve entraremos em contato.</p>
<p>Obrigado! =)</p>
<p>Equipe Banda Mega</p>
<p><span style="font-weight: bold">Telefone: </span> <?=$model->contact?></p>
<p><span style="font-weight: bold">Email: </span> <?=$model->email?></p>
<p><span style="font-weight: bold">Tempo total: </span> <?=$model->total_runtime?></p>
<h4>Repertório:</h4>
<table style="border-collapse: collapse; width: 400px; text-align: center;" border="1"  >
    <thead>
        <th style="padding: 10px;">Músicas</th>
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
