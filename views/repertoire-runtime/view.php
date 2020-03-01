<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\RepertoireRuntime */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Repertoire Runtimes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="repertoire-runtime-view">


    <div class="panel panel-default">
        <div class="panel-heading">
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
        </div>
        <div class="panel-body">


    <?= DetailView::widget([
        'model' => $model,
        'template' => '<tr><th style="color: #555; font-weight: bold; font-size: 12px">{label}</th><td{contentOptions}>{value}</td></tr>',
        'attributes' => [
            'runtime',
            'updated_at:datetime',
        ],
    ]) ?>
        </div>
    </div>
</div>
