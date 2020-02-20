<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Mega Band';
?>
    <div class="site-index">

    <div class="header">
        <div class="row">
            <div class="col-md-4 col-xs-6"><img src="web/images/mb.png" alt=""></div>

            <div class="col-md-4 col-md-offset-4 col-xs-6 text-right"><img src="web/images/arrows.PNG" alt=""></div>
        </div>

        <div class="row">
            <div class="col-md-4"><img src="web/images/logo.png" alt=""></div>
        </div>
    </div>
    <div class="content">


        <div class="row">
            <div class="col-md-3 col-xs-9">
                <div class="row">

                    <div class="col-md-12 col-xs-12">
                        <img class="list-img expand" src="web/images/expand.PNG" alt="">
                        <div class="genre">
                            <div class="genre-border-1">
                                <span style="font-size: 22px">C</span>OQUETEL
                            </div>
                            <div class="genre-border-2">
                            </div>
                        </div>

                        <div class="row expanded-container">
                            <div class="col-md-12 col-xs-12 expanded-box">

                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 col-xs-12">
                        <img class="list-img expand" src="web/images/expand.PNG" alt="">
                        <div class="genre">
                            <div class="genre-border-1">
                                <span style="font-size: 22px">C</span>OQUETEL
                            </div>
                            <div class="genre-border-2">
                            </div>
                        </div>
                        <div class="row expanded-container">
                            <div class="col-md-12 col-xs-12 expanded-box">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-1 col-xs-3"></div>
            <div class="col-md-3 col-xs-9">
                <div class="row panel-group">
                    <div class="col-md-12 col-xs-12">
                        <a class="onCollapse" data-toggle="collapse" href="#collapse3">
                            <img class="list-img expand" src="web/images/expand.PNG" alt="">
                        </a>
                        <div class="genre">
                            <div class="genre-border-1">
                                <span style="font-size: 22px">C</span>OQUETEL
                            </div>
                            <div class="genre-border-2">
                            </div>
                        </div>
                        <div id="collapse3" class="row expanded-container collapse">
                            <div class="col-md-12 col-xs-12 expanded-box">

                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 col-xs-12">
                        <a class="onCollapse" data-toggle="collapse" href="#collapse4">
                            <img class="list-img expand" src="web/images/expand.PNG" alt="">
                        </a>
                        <div class="genre">
                            <div class="genre-border-1">
                                <span style="font-size: 22px">C</span>OQUETEL
                            </div>
                            <div class="genre-border-2">
                            </div>
                        </div>
                        <div id="collapse4" class="row panel-collapse expanded-container collapse">
                            <div class="col-md-12 col-xs-12 expanded-box">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-1 col-xs-1"></div>
            <div class="col-md-3 col-xs-12 ">
                <div class="row">
                    <div class="col-xs-1"></div>
                    <div class="col-md-12 col-xs-10">
                        <div class="my-songs">
                            <div class="my-songs-header">
                                <p style="font-size: 12px">Seu Reportório <span
                                            style="margin-left: 30px; font-size: 10px">Tempo total: 00:00 MINUTOS</span>
                                </p>
                            </div>
                            No Song(s) Selected
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
                <?php $form = ActiveForm::begin(); ?>

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
    </div>

<?php $this->registerJsFile(Yii::$app->homeUrl . 'js/index.js', ['depends' => ['yii\web\JqueryAsset']]) ?>