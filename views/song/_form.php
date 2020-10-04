<?php

use app\config\Helper;
use app\models\Genre;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Song */
/* @var $form yii\widgets\ActiveForm */

$cover_link = $model->name == NULL ?   Helper::getBaseUrl() . '/web/images/image_placeholder.png' : Helper::getBaseUrl() . '/web/uploads/song-covers/' . $model->song_cover;
?>

<div class="song-form">

    <?php $form = ActiveForm::begin([
        'id' => 'songs-form',
        'options' => ['enctype' => 'multipart/form-data'],
        'enableAjaxValidation' => true,
        'enableClientValidation' => true,
    ]); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'artist')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'duration')->textInput()->label("Duration (Seconds)") ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'link_name')->textInput()->label("Link Name") ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'genre_id')->dropDownList(
                ArrayHelper::map(Genre::find()->asArray()->all(), 'id', 'name'),
                ['prompt' => 'Select Genre...']
            );
            ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <span style="font-weight: bold">Upload Song?</span> <?= Html::checkbox(
                                                                    "song_check",
                                                                    $model->song_check,
                                                                    [
                                                                        'id' => "song-upload-option",
                                                                        'style' =>
                                                                        '-moz-transform: scale(2); 
                    -webkit-transform: scale(2); 
                    -ms-transform: scale(2);  
                    -o-transform: scale(2);
                    transform: scale(2);
                    margin: 10px;'
                                                                    ]
                                                                ) ?>
        </div>
    </div>

    <div class="row" id="song-embed-option" style="display:<?= $model->song_check ? "none" : "block" ?>">
        <div class="col-md-6">
            <?= $form->field($model, 'url')->textarea(['rows' => 6])->label("Embedded Url") ?>
        </div>
    </div>
<div id="upload-song-option">
    <div class="row"  style="display: <?= $model->song_check ? "block" : "none" ?>">
        <div class="col-md-6">
            <?= $form->field($model, 'song_url')->fileInput(["accept" => ".mp3", "id" => 'uploaded_song_url'])->label('Song') ?>
            <p class="help-block help-block-error song-required" style="display: none ; color: #ff8889 !important; margin-bottom: 10px">
                Song cannot be blank.</p>
        </div>
    </div>



    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'song_cover')->fileInput(["accept" => ".png,.jpg", "id" => 'uploaded_cover_image', 'onChange' => 'readURL(this)'])->label('Cover Image') ?>
            <p class="help-block help-block-error cover-image-required" style="display: none ; color: #ff8889 !important; margin-bottom: 10px">
                Cover Image cannot be blank.</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= Html::img($cover_link, [
                'id' => 'uploaded_cover_img',
                'class' => 'img-rounded', 'alt' => 'Display Cover Image', 'style' => 'margin-top:6px;width: 100px; height: 100px;'
            ]) ?>
        </div>
    </div>
    </div>
    <div class="row" style="margin-top: 12px">
        <div class="col-md-6">
            <div class="form-group pull-right">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success btn-submit']) ?>
                <?= Html::resetButton('Reset', ['class' => 'btn btn-primary btn-submit reset-btn']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
<?php $this->registerJsFile(Yii::$app->homeUrl . 'web/js/songs.js', ['depends' => ['yii\web\JqueryAsset']]) ?>