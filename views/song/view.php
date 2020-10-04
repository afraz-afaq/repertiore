<?php

use app\config\Helper;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Song */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Songs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="song-view">


    <div class="panel panel-default">
        <div class="panel-heading">
            <h1><?= Html::encode($this->title) ?></h1>
            <p>
                <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>
        </div>
        <div class="panel-body">
            <?= DetailView::widget([
                'model' => $model,
                'template' => '<tr><th style="color: #555; font-weight: bold; font-size: 12px">{label}</th><td{contentOptions}>{value}</td></tr>',
                'attributes' => [
                    'name',
                    ($model->url ? 'url:raw'  :
                        [

                            'attribute' => 'url',
                            'label' => 'Song',
                            'format' => 'raw',
                            'value' => function ($model, $widget) {
                                $song = Helper::getBaseUrl() . Helper::SONG_PATH . $model->link_name  . ".mp3";
                                return ' <audio controls>
                            <source src="' . $song . '" type="audio/ogg">
                            <source src="' . $song . '" type="audio/mpeg">
                          Your browser does not support the audio element.
                          </audio> ';
                            }
                        ]),
                    [
                        'attribute' => 'song_cover',
                        'label' => 'Cover',
                        'format' => 'raw',
                        'value' => function ($model, $widget) {
                            $cover = Helper::getBaseUrl() . Helper::SONG_COVER_PATH . $model->link_name  . Helper::SONG_COVER_EXT;
                            return ' <img src="' . $cover . '" width="270"/>';
                        }
                    ],
                    'duration',
                    'genre.name',
                ],
            ]) ?>
        </div>
    </div>
</div>