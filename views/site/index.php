<?php

/* @var $this yii\web\View */

/** @var float $runtime */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Mega Band';
$count = 0;
?>

<div class="site-index">

    <div class="header header-mobile">
        <div class="row">
            <div class="col-md-4 col-xs-5" style="margin-top: 12px"><a href="https://bandamega.com.br"><img class="logo-image" src="<?= Yii::$app->homeUrl ?>web/images/banda.png?version=1" alt="" width="200"></a></div>

            <div class="col-md-4 col-md-offset-4 col-xs-5 text-right"><img class="arrow-image" src="<?= Yii::$app->homeUrl ?>web/images/arrows.png" alt="" width="300"></div>
        </div>
        <div class="row">
            <div class="col-md-4"><img class="monteseu-image" src="<?= Yii::$app->homeUrl ?>web/images/monteseu.png" alt="" width="300"></div>
        </div>
        <div class="row">

            <div class="col-md-8" style="margin-right:6px;">
                <div class="my-songs-header mobile-songs-header" style="display:none; cursor:pointer;">
                    <p style="font-size: 17px; font-weight: bold; font-family: Calibri;">Seu Repertório <span class="repertoireRuntime" style="margin-left: 11px; font-size: 12px; font-weight: bold; font-family: Calibri;">Tempo total: 00:00 minutos</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="content">


        <div class="search-area">
            <?php ActiveForm::begin(['id' => 'search_form']); ?>
            <div class="row">
                <div class="col-md-6 col-xs-12" style="margin-top: 4px">
                    <div class="search_field">
                        <?= Html::textInput('search_query', $search, [
                            'class' => 'custom-input form-control',
                            'id' => 'search_text',
                            'placeholder' => "Buscar: música, artista ou gênero", "onFocus" => "onSearchFocus(this)",
                            "onFocusOut" => "onSearchFocusOut(this)"
                        ]) ?>
                        <span id="clear_search" onclick="clearSearch()">Cancelar</span>
                    </div>
                </div>
                <div class="col-md-2 col-xs-12 srch-btn" style="margin-top: 4px">
                    <?= Html::submitButton('BUSCAR', ['class' => 'btn btn-orange submit-btn', 'style' => 'font-weight:bold;']) ?>

                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>

        <div class="row" style="margin-top: 26px">
            <div class="col-md-3 col-xs-9">
                <?php if (count($genres) > 0) : ?>
                    <div class="row panel-group">
                        <?php foreach ($genres[0] as $genre) : ?>
                            <div class="col-md-12 col-xs-12">
                                <a class="onCollapse" data-toggle="collapse" href="#collapse<?= $genre['id'] ?>">
                                    <img class="list-img expand" src="<?= Yii::$app->homeUrl ?>web/images/ex.png" alt="">
                                </a>
                                <div class="genre">
                                    <div class="genre-border-1">
                                        <div style="font-size: 17px; margin-top: 6px;"><?= $genre['name'] ?></div>
                                    </div>
                                    <div class="genre-border-2">
                                    </div>
                                </div>
                                <div id="collapse<?= $genre['id'] ?>" class="row expanded-container collapse">
                                    <div class="col-md-12 col-xs-12 expanded-box" <?= count($songs[$genre['id']]) <= 0 ? 'style="height:40px;"' : '' ?>>
                                        <?php if (count($songs[$genre['id']]) > 0) : ?>
                                            <?php foreach ($songs[$genre['id']] as $song) : ?>
                                                <div style="border: 3px solid white; margin-bottom: 6px;">
                                                    <div style="border-bottom: 3px solid;"><span class="add-to" onclick='addToPlaylist("<?= $song['id'] ?>","<?= $song['duration'] ?>")'>+ADICIONAR AO REPERTÓRIO</span></div>
                                                    <div id="add-<?= $song['id'] ?>">
                                                        <?php if ($song['url'] == null) : ?>
                                                            <?= $this->render('music-player-layout.php', ['model' => $song]); ?>
                                                        <?php else : ?>
                                                            <span style="font-weight: bold; font-size: 14px"><?= $song['url'] == null ? $song['name'] . ' (' . ($song['duration'] / 60) . ' minutos)' : $song['url'] ?></span>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>

                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <span>Nenhuma música disponível no momento</span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else : ?>
                    <p>Nenhum resultado</p>

                <?php endif; ?>
            </div>
            <div class="col-md-1 col-xs-3"></div>
            <div class="col-md-3 col-xs-9">
                <?php if (count($genres) > 0 && isset($genres[1])) : ?>
                    <div class="row panel-group">
                        <?php foreach ($genres[1] as $genre) : ?>
                            <div class="col-md-12 col-xs-12">
                                <a class="onCollapse" data-toggle="collapse" href="#collapse<?= $genre['id'] ?>">
                                    <img class="list-img expand" src="<?= Yii::$app->homeUrl ?>web/images/ex.png" alt="">
                                </a>
                                <div class="genre">
                                    <div class="genre-border-1">
                                        <div style="font-size: 17px;margin-top: 6px;"><?= $genre['name'] ?></div>
                                    </div>
                                    <div class="genre-border-2">
                                    </div>
                                </div>
                                <div id="collapse<?= $genre['id'] ?>" class="row expanded-container collapse">
                                    <div class="col-md-12 col-xs-12 expanded-box" <?= count($songs[$genre['id']]) <= 0 ? 'style="height:40px;"' : '' ?>>
                                        <?php if (count($songs[$genre['id']]) > 0) : ?>
                                            <?php foreach ($songs[$genre['id']] as $song) : ?>
                                                <div style="border: 3px solid white; margin-bottom: 6px;">
                                                <div style="border-bottom: 3px solid;"><span class="add-to" onclick='addToPlaylist("<?= $song['id'] ?>","<?= $song['duration'] ?>")'>+ADICIONAR AO REPERTÓRIO</span></div>
                                                    <div id="add-<?= $song['id'] ?>">
                                                        <?php if ($song['url'] == null) : ?>
                                                            <?= $this->render('music-player-layout.php', ['model' => $song]); ?>
                                                        <?php else : ?>
                                                            <span style="font-weight: bold; font-size: 14px"><?= $song['url'] == null ? $song['name'] . ' (' . ($song['duration'] / 60) . ' minutos)' : $song['url'] ?></span>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <span>Nenhuma música disponível no momento</span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-md-1 col-xs-1"></div>
            <div class="col-md-3 col-xs-12 ">
                <div class="row">

                    <div class="col-md-12 col-xs-10">
                        <div class="my-songs-container">
                            <div class="my-songs-header">
                                <span style="font-weight: bold;font-family: Calibri;">Seu Repertório</span> <span class="repertoireRuntime" style="margin-left: 1px; font-size: 11px; font-weight: bold; font-family: Calibri;">Tempo total: 00:00 minutos</span>
                            </div>
                            <div class="my-songs">
                                <div style="padding-left: 18px">
                                    <span id="no-songs">Sem músicas adicionadas</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="contact-form" style="margin-top: 16px">
        <div class="row">
            <div class="col-md-8 col-xs-12 text-center">
                <h4 style="color:#6600ff;">Receba seu repertório por e-mail
                </h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2 col-xs-1">
            </div>
            <div class="col-md-4 col-xs-10">
                <?php $form = ActiveForm::begin(['id' => 'request-form']); ?>
                <?= Html::hiddenInput('runtime', null, ['id' => 'hiddenRuntime']) ?>
                <?= Html::hiddenInput('songs', null, ['id' => 'hiddenSongs']) ?>
                <?= $form->field($model, 'name')->textInput(['class' => 'custom-input form-control'])->label('Nome:') ?>
                <?= $form->field($model, 'contact')->widget(\yii\widgets\MaskedInput::className(), [
                    'mask' => '(99) 99999-9999',
                    'options' => ['class' => 'custom-input form-control']
                ]) ?>
                <?= $form->field($model, 'email')->textInput(['class' => 'custom-input form-control']) ?>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group text-center">
                            <?= Html::submitButton('ENVIAR', ['class' => 'btn btn-orange submit-btn', 'style' => 'margin-top:6px;font-weight:bold;']) ?>
                        </div>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
    <div class="share">
        <div class="row">
            <div class="col-md-8 col-xs-12 text-center">
                <h2>COMPARTILHE:</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-xs-12 text-center">
                <a href="https://www.facebook.com/sharer/sharer.php?u=https://bandamega.com.br/app/" target="_blank">
                    <img src="<?= Yii::$app->homeUrl ?>web/images/fb.png" width="55">
                </a>

                <a href="https://web.whatsapp.com/send?text=https://bandamega.com.br/app/" data-action="share/whatsapp/share" target="_blank">
                    <img src="<?= Yii::$app->homeUrl ?>web/images/whatsapp.png" width="50">
                </a>
            </div>
        </div>
    </div>

    <div class="row to-up" style="width: 100%">
        <div class="col-md-12 col-xs-12" style="text-align: right; margin-left:20px;">
            <img src="https://bandamega.com.br/wp-content/uploads/2019/10/Seta-Top.png" alt="Seta-Top" data-lazy-src="https://bandamega.com.br/wp-content/uploads/2019/10/Seta-Top.png" style="cursor: pointer" class="up" data-was-processed="true">
        </div>
    </div>


    <?php $this->registerJsFile(Yii::$app->homeUrl . 'web/js/notify.min.js', ['depends' => ['yii\web\JqueryAsset']]) ?>
    <?php
    $this->registerJs("var max_runtime = " . $runtime . ";", \yii\web\View::POS_BEGIN); ?>
    <?php $this->registerJs("var home_url = " . Yii::$app->homeUrl . ";", \yii\web\View::POS_BEGIN); ?>
    <?php $this->registerJsFile(Yii::$app->homeUrl . 'web/js/index.js?version=1.2', ['depends' => ['yii\web\JqueryAsset']]) ?>