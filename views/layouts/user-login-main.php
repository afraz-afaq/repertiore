<?php

use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>

<head>
    <title>User - Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->head() ?>

    <style>
        body {
            background: black;
            font-family: "Times New Roman PS Pro Bold", Georgia, Times, serif;
            color: black;
        }
        .btn-orange {
            border-radius: 10%;
            background: #f74813;
            color: #6600ff;
            color: white;
        }


        @media screen and (max-width: 900px) {

            .logo-image {
                width: 120px;
            }

            .arrow-image {
                width: 170px;
            }            

        }
    </style>

</head>

<body>
    <?php $this->beginBody() ?>
    <div class="header header-mobile">
        <div class="row">
            <div class="col-md-4 col-xs-5" style="margin-top: 12px"><a href="https://bandamega.com.br"><img class="logo-image" src="<?= Yii::$app->homeUrl ?>web/images/banda.png?version=1" alt="" width="200"></a></div>

            <div class="col-md-4 col-md-offset-4 col-xs-5 text-right"><img class="arrow-image" src="<?= Yii::$app->homeUrl ?>web/images/arrows.png" alt="" width="300"></div>
        </div>
    </div>
    <?= \Yii::$app->view->renderFile('@app/views/layouts/message_panel.php'); ?>
    <div class="container" style="padding: 16px">
        <?= $content ?>
    </div>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>