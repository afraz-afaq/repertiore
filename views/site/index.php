<?php

/* @var $this yii\web\View */

/** @var float $runtime */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Mega Band';
?>
    <div class="site-index">

    <div class="header">
        <div class="row">
            <div class="col-md-4 col-xs-6"><img src="<?= Yii::$app->homeUrl ?>web/images/mb.png" alt=""></div>

            <div class="col-md-4 col-md-offset-4 col-xs-6 text-right"><img
                        src="<?= Yii::$app->homeUrl ?>web/images/arrows.PNG" alt=""></div>
        </div>

        <div class="row">
            <div class="col-md-4"><img src="<?= Yii::$app->homeUrl ?>web/images/logo.png" alt=""></div>
        </div>
    </div>
    <div class="content">


        <div class="row">
            <div class="col-md-3 col-xs-9">
                <div class="row panel-group">
                    <?php foreach ($genres[0] as $genre): ?>
                        <div class="col-md-12 col-xs-12">
                            <a class="onCollapse" data-toggle="collapse" href="#collapse<?= $genre['id'] ?>">
                                <img class="list-img expand" src="<?= Yii::$app->homeUrl ?>web/images/expand.png"
                                     alt="">
                            </a>
                            <div class="genre">
                                <div class="genre-border-1">
                                    <span style="font-size: 22px"><?= substr($genre['name'], 0, 1) ?></span><?= substr($genre['name'], 1, strlen($genre['name'])) ?>
                                </div>
                                <div class="genre-border-2">
                                </div>
                            </div>
                            <div id="collapse<?= $genre['id'] ?>" class="row expanded-container collapse">
                                <div class="col-md-12 col-xs-12 expanded-box">
                                    <?php if (count($genre['songs']) > 0): ?>
                                        <?php foreach ($genre['songs'] as $song): ?>
                                            <span class="add-to"
                                                  onclick='addToPlaylist("<?= $song['id'] ?>","<?= $song['duration'] ?>")'>+ADD REPERTÓRIO</span>
                                            <div id="add-<?= $song['id'] ?>">
                                                <?= $song['url'] ?>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <span>No Song(s) Available Right Now</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="col-md-1 col-xs-3"></div>
            <div class="col-md-3 col-xs-9">
                <div class="row panel-group">
                    <?php foreach ($genres[1] as $genre): ?>
                        <div class="col-md-12 col-xs-12">
                            <a class="onCollapse" data-toggle="collapse" href="#collapse<?= $genre['id'] ?>">
                                <img class="list-img expand" src="<?= Yii::$app->homeUrl ?>web/images/expand.png"
                                     alt="">
                            </a>
                            <div class="genre">
                                <div class="genre-border-1">
                                    <span style="font-size: 22px"><?= substr($genre['name'], 0, 1) ?></span><?= substr($genre['name'], 1, strlen($genre['name'])) ?>
                                </div>
                                <div class="genre-border-2">
                                </div>
                            </div>
                            <div id="collapse<?= $genre['id'] ?>" class="row expanded-container collapse">
                                <div class="col-md-12 col-xs-12 expanded-box">
                                    <?php if (count($genre['songs']) > 0): ?>
                                        <?php foreach ($genre['songs'] as $song): ?>
                                            <span class="add-to"
                                                  onclick='addToPlaylist("<?= $song['id'] ?>","<?= $song['duration'] ?>")'>+ADD REPERTÓRIO</span>
                                            <div id="add-<?= $song['id'] ?>">
                                                <?= $song['url'] ?>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <span>No Song(s) Available Right Now</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="col-md-1 col-xs-1"></div>
            <div class="col-md-3 col-xs-12 ">
                <div class="row">
                    <div class="col-xs-1"></div>
                    <div class="col-md-12 col-xs-10">
                        <div class="my-songs">
                            <div class="my-songs-header">
                                <p style="font-size: 12px">Seu Reportório <span id="repertoireRuntime"
                                                                                style="margin-left: 15px; font-size: 10px">Tempo total: 00:00 MINUTOS</span>
                                </p>
                            </div>
                            <span id="no-songs">No Song(s) Selected</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="contact-form" style="margin-top: 16px">
    <div class="row">
        <div class="col-md-12 col-xs-12 text-center">
            <h4 style="color:#6600ff;">Receba seu repertório por e-mail
            </h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-xs-1">
        </div>
        <div class="col-md-4 col-xs-10">
            <?php $form = ActiveForm::begin(['id' => 'request-form']); ?>
            <?= Html::hiddenInput('runtime', null, ['id' => 'hiddenRuntime']) ?>
            <?= Html::hiddenInput('songs', null, ['id' => 'hiddenSongs']) ?>
            <?= $form->field($model, 'name')->textInput(['class' => 'custom-input form-control']) ?>
            <?= $form->field($model, 'contact')->textInput(['class' => 'custom-input form-control']) ?>
            <?= $form->field($model, 'email')->textInput(['class' => 'custom-input form-control']) ?>

            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group text-center">
                        <?= Html::submitButton('ENVIAR', ['class' => 'btn btn-orange', 'style' => 'margin-top:6px;']) ?>
                    </div>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>

    </div>


<?php
$this->registerJs("var max_runtime = " . $runtime . ";", \yii\web\View::POS_BEGIN); ?>
<?php $this->registerJs("var home_url = " . Yii::$app->homeUrl . ";", \yii\web\View::POS_BEGIN); ?>
<?php $this->registerJsFile(Yii::$app->homeUrl . '/web/js/index.js', ['depends' => ['yii\web\JqueryAsset']]) ?>