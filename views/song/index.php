<?php

use app\config\Helper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\SongSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Songs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="song-index">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h1><?= Html::encode($this->title) ?></h1>

            <p>
                <?= Html::a('Add Song', ['create'], ['class' => 'btn btn-success']) ?>
            </p>
        </div>
        <div class="panel-body">


            <?php // echo $this->render('_search', ['model' => $searchModel]); 
            ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    'name',
                    [

                        'attribute' => 'url',
                        'label' => 'Song',
                        'format' => 'raw',
                        'value' => function ($model, $key, $index, $column) {
                            if ($model->url)
                                return $model->url;
                            else {
                                $song = Helper::getBaseUrl() . Helper::SONG_PATH . $model->link_name . ".mp3";
                                return ' <audio controls preload="none">
                                <source src="' . $song . '" type="audio/ogg">
                                <source src="' . $song . '" type="audio/mpeg">
                            Your browser does not support the audio element.
                            </audio> ';
                            }
                        }
                    ],
                    [
                        'attribute' => 'song_cover',
                        'label' => 'Cover',
                        'format' => 'raw',
                        'value' => function ($model, $key, $index, $column) {
                            $cover = Helper::getBaseUrl() . Helper::SONG_COVER_PATH . $model->link_name  . Helper::SONG_COVER_EXT;
                            return ' <img src="' . $cover . '" width="80"/>';
                        }
                    ],
                    'duration',
                    [
                        'attribute' => 'genre',
                        'value' => 'genre.name'
                    ],

                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{view} {delete}',
                    ],
                ],
                'tableOptions' => ['class' => 'table table-hover'],
            ]); ?>

        </div>
    </div>
</div>