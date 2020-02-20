<?php

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
                <?= Html::a('Create Song', ['create'], ['class' => 'btn btn-success']) ?>
            </p>
        </div>
        <div class="panel-body">


            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    'name',
                    'url:ntext',
                    'duration',
                    'genre_id',
                    //'created_at',
                    //'updated_at',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>

        </div>
    </div>
</div>