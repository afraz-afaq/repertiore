<?php
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
<head>
    <title>Bootstrap Example</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->head() ?>
    <style>
        .genre-bor {
            margin-top: 2px;
            margin-right: 3px;
            border: red 1px solid;
            border-radius: 15px;
            width: 300px;
        }

        .genre-bor {
            margin-left: 2px;
            border: blue 1px solid;
            border-radius: 15px;
            padding: 8px;
            width: 300px;
            margin-bottom: 2px;
            margin-top: -2px;
        }

        body {
            background: black;
            font-family: "Times New Roman PS Pro Bold", Georgia, Times, serif;
            color: white;
        }

        .genre {
            position: relative;
            margin: 4px;
            font-size: 14px;
            font-weight: bold;
        }

        .genre-border-1 {
            width: 100%;
            height: 34px;
            position: absolute;
            padding-left: 5px;
            top: -3px;
            left: 3px;
            border: blue 1px solid;
            border-radius: 15px;

        }

        .genre-border-2 {
            width: 100%;
            height: 34px;
            z-index: 9;
            border: red 1px solid;
            border-radius: 15px;
        }

        .content {
            margin-top: 50px;
        }

        .list-img {
            float: right;
            position: relative;
            left: 32px;
        }

        .my-songs {
            background: #2c2e35;
            padding: 2px 2px 0 2px;
            border-radius: 2px;
            height: 350px;
            width: 270px;
            overflow-y:scroll;
        }

        .my-songs-header {
            background: #f74813;
            padding: 2px 2px 0 2px;
            border-radius: 2px;
        }

        .expanded-container {
            padding-left: 10px;
            padding-right: 10px;
            margin-bottom: 10px;
        }

        .expanded-box {
            width: 270px;
            height: 250px;
            background: #2c2e35;
            overflow-y: scroll;
            overflow-x: hidden;
            padding: unset;
            padding: 4px;
        }

        .btn-orange{
            border-radius:10%;
            background:#f74813;
            color: #6600ff;
        }

        .custom-input{
            border-radius: 100px;
        }

        iframe{
            margin-top: 4px;
        }

        .add-to{
            color: white;
            padding: 3px;
            font-size: 9px;
            margin-left: 142px;
            cursor: pointer;
            font-weight: bold;
            background: blue;
        }

        .remove-to{
            color: white;
            padding: 3px;
            font-size: 9px;
            margin-left: 200px;
            cursor: pointer;
            font-weight: bold;
            background: blue;
        }


    </style>
</head>
<body>
<?php $this->beginBody() ?>
<?= \Yii::$app->view->renderFile('@app/views/layouts/message_panel.php'); ?>
<div class="container">
    <?= $content ?>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>