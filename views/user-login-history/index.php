<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\UserLoginHistorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Login Histories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-login-history-index">


    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'user.email',
            'date',
            'ip',
            [
                'label' => 'Time',
                'value' => function($model){
                    return date('m/d/Y H:i:s', $model->created_at);
                }
            ],
        
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
