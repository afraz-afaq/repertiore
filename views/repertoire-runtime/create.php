<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RepertoireRuntime */

$this->title = 'Create Repertoire Runtime';
$this->params['breadcrumbs'][] = ['label' => 'Repertoire Runtimes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="repertoire-runtime-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
