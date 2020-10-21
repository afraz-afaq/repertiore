<?php

use app\models\User;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            [
                'filter' => [User::ACTIVE => 'Active', User::INACTIVE => 'Inactive'],
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function($model, $key, $index, $column){
                    return $model->status == User::ACTIVE ? "<span style='color:green;'>ACTIVE</span>" : "<span style='color:red;'>INACTIVE</span>";
                }
            ],
            'email:email',
            [
                'format' => 'raw',
                'label' => 'Login Count',
                'value' => function($model, $key, $index, $column){
                    $count = $model->getUserLoginHistory()->count();
                    return Html::a($count,['user-login-history/index?id='.$model->id]);
                }
            ],
            [
                'format' => 'raw',
                'label' => 'Time Spent',
                'value' => function($model, $key, $index, $column){
                    $spent = $model->userTimeSpent->time_spent;
                    return round($spent/(60),2)." Min(s)";
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
