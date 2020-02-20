<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Song */

$this->title = 'Create Song';
$this->params['breadcrumbs'][] = ['label' => 'Songs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="song-create">

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
