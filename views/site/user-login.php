<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<style>
    .loader {
        border: 6px solid #f3f3f3;
        /* Light grey */
        border-top: 6px solid #3498db;
        /* Blue */
        border-radius: 50%;
        width: 50px;
        height: 50px;
        animation: spin 2s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    .g-recaptcha {
        transform: scale(0.77);
        transform-origin: 0 0;
    }
</style>
<div class="site-login">

    <div class="genre-create">
        <div class="row">

            <div class="col-md-2"></div>
            <div class="col-md-8 text-center">

                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        <h1><?= Html::encode($this->title) ?></h1>

                        <p>Por favor, preencha os campos abaixo para fazer o login:</p>
                    </div>
                    <div class="panel-body">


                        <?php $form = ActiveForm::begin([
                            'id' => 'login-form',
                            'layout' => 'horizontal',

                        ]); ?>

                        <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

                        <?= $form->field($model, 'password')->passwordInput() ?>

                        <center>
                            <div class="loader"></div>
                            <div class="g-recaptcha" data-sitekey="6Lc1MtUZAAAAAF0Mjc8BdF0GwHW-og1JCYdO21ct"></div>
                        </center>
                        <div class="form-group">
                            <div class="col-lg-offset-1 col-lg-11 pull-right" style="margin-top:8px;">
                                <?= Html::submitButton('Login', ['class' => 'btn btn-orange submit-btn', 'name' => 'login-button']) ?>
                            </div>
                        </div>

                        <?php ActiveForm::end(); ?>

                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
</div>

<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer>
</script>

<script type="text/javascript">
    var onloadCallback = function() {
        $('.loader').hide();
    };
</script>