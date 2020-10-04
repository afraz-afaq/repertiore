<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Request */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="request-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'full_name',
            'email:email',
            'contact',
            'total_runtime',
        ],
    ]) ?>

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

</div>
