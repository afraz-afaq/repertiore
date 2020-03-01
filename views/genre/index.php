<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\GenreSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Genres';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="genre-index">


    <div class="panel panel-default">
        <div class="panel-heading">
            <h1><?= Html::encode($this->title) ?></h1>

            <p>
                <?= Html::a('Add Genre', ['create'], ['class' => 'btn btn-success']) ?>
            </p>
        </div>
        <div class="panel-body">

            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    [
                        'attribute' => 'name',
                        'headerOptions' => ['style' => 'text-align:center;'],
                        'contentOptions' => ['style' => ' text-align:center;'],
                    ]
                    ,
                    ['class' => 'yii\grid\ActionColumn',
                        'contentOptions' => ['style' => ' text-align:center;'],
                        'template' => "{update} {delete}"
                    ],
                ],
                'tableOptions' => ['class' => 'table table-hover'],
            ]); ?>
        </div>
    </div>

</div>
