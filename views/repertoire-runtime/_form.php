<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RepertoireRuntime */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="repertoire-runtime-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'runtime')->textInput()->label("Max Runtime (Seconds)") ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
