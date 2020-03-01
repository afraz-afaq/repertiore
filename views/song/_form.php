<?php

use app\models\Genre;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Song */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="song-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'url')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'duration')->textInput()->label("Duration (Seconds)") ?>

    <?= $form->field($model, 'genre_id')->dropDownList(
        ArrayHelper::map(Genre::find()->asArray()->all(), 'id', 'name'),
        ['prompt'=>'Select Genre...']);
        ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
