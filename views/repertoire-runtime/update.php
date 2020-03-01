<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RepertoireRuntime */

$this->title = 'Update Repertoire Runtime';
$this->params['breadcrumbs'][] = ['label' => 'Repertoire Runtimes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="repertoire-runtime-update">


    <div class="panel panel-default">
        <div class="panel-heading">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="panel-body">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
        </div>
    </div>
</div>
