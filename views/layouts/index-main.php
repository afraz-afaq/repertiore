<?php

use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>

<head>
    <title>Ferramenta para montagem de repertório para casamentos e festas
        – Banda Mega</title>
    <link rel="shortcut icon" type="image/png" href="web/favicon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="A única ferramenta gratuita no mercado para montagem de
repertório de músicas para casamentos e eventos. Escolha as
músicas por categoria e receba no seu e-mail">

    <?php $this->head() ?>
    <style>
        .search_field {
            position: relative;

        }

        .search_field span {
            position: absolute;
            color: grey;
            right: 15px;
            bottom: 6px;
            cursor: pointer;
        }

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
            background: transparent;
            padding: 2px 2px 0 2px;
            border-radius: 2px;
            overflow-y: scroll;
            height: 400px;
        }

        .my-songs-container {
            position: fixed;
            width: 310px;
            margin-top: -120px;
        }

        .my-songs-header {
            background: #f74813;
            padding: 2px 2px 0 2px;
            height: 30px;
            border-radius: 2px;
        }

        .expanded-container {
            padding-left: 10px;
            padding-right: 10px;
            margin-bottom: 10px;
        }

        .expanded-box {
            width: 278px;
            height: 550px;
            background: #2c2e35;
            overflow-y: scroll;
            overflow-x: hidden;
            padding: 4px;
            background: transparent
        }

        .btn-orange {
            border-radius: 10%;
            background: #f74813;
            color: #6600ff;
            color: white;
        }

        .custom-input {
            border-radius: 100px;
        }

        iframe {
            margin-top: 4px;
        }

        .add-to {
            color: white;
            padding: 3px;
            font-size: 9px;
            margin-left: 85px;
            cursor: pointer;
            font-weight: bold;
            background: blue;
        }

        .remove-to {
            color: white;
            padding: 3px;
            font-size: 9px;
            margin-left: 200px;
            cursor: pointer;
            font-weight: bold;
            background: blue;
        }

        .header {
            background: black
        }

        hr {
            margin: 0;
            height: 1.5px;
            background: white;
            margin-top: 4px;
            margin-bottom: 4px;
            width: 258px;
        }



        /* player starts */

        p {
            margin: unset;
        }

        .song-share {
            position: absolute;
            right: 16px;
        }

        .seek {
            margin-top: 15px;
        }

        .audio-player {
            border: 1px solid #dfdfdf;
            text-align: center;
            display: flex;
            flex-flow: row;
            margin-bottom: 2px;
            width: 255px;
            position: relative;
        }

        .audio-player .album-image {
            min-height: 105px;
            width: 90px;
            background-size: cover;
            position: absolute;
            z-index: -1;
        }

        .audio-player .player-controls {
            align-items: center;
            justify-content: center;
            padding-top: 3px;
            flex: 3;
            margin-left: 10px;
            background-image: linear-gradient(-90deg, #bd7e7e, #565b55a6);
        }

        .audio-player .player-controls progress {
            width: 90%;
        }

        .audio-player .player-controls progress[value] {
            -webkit-appearance: none;
            appearance: none;
            background-color: white;
            color: blue;
            height: 5px;
        }

        .audio-player .player-controls progress[value]::-webkit-progress-bar {
            background-color: white;
            border-radius: 2px;
            border: 1px solid #dfdfdf;
            color: blue;
        }

        .audio-player .player-controls progress::-webkit-progress-value {
            background-color: blue;
        }

        .audio-player .player-controls p {
            font-size: 1.2rem;
            text-align: left;
            margin-left: 6px;
            height: 50px;
        }

        .audio-player .play-btn {
            background-image: url("<?= Yii::$app->homeUrl ?>web/images/play.png");
            background-size: cover;
            width: 70px;
            height: 70px;
            margin: 1.5rem 0 1rem 1rem;
            cursor: pointer
        }

        .audio-player .play-btn.pause {
            background-image: url("<?= Yii::$app->homeUrl ?>web/images/pause.png");
        }

        /* player  ends*/

        /* width */
        ::-webkit-scrollbar {
            width: 10px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            box-shadow: inset 0 0 5px grey;
            border-radius: 10px;
        }

        /* Handle */
        .expanded-box::-webkit-scrollbar-thumb {
            background: white;
            border-radius: 10px;
        }

        /* Handle on hover */
        .expanded-box::-webkit-scrollbar-thumb:hover {
            background: #dee1f8;
        }

        /* Handle */
        .my-songs::-webkit-scrollbar-thumb {
            background: white;
            border-radius: 10px;
        }

        /* Handle on hover */
        .my-songs::-webkit-scrollbar-thumb:hover {
            background: #dee1f8;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: orangered;
            border-radius: 10px;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #b30000;
        }

        @media screen and (max-width: 900px) {
            .my-songs-container {
                margin-top: 350px;
                position: absolute;
            }

            .logo-image {
                width: 120px;
            }

            .arrow-image {
                width: 170px;
            }

            .monteseu-image {
                width: 200px;
            }

            .content {
                margin-top: 200px
            }

            .mobile-songs-header {
                display: block !important;
            }

            .header-mobile {
                overflow: hidden;
                position: fixed;
                top: 0;
                width: 95%;
                z-index: 100
            }

            .to-up {
                margin-top: 20px;
                padding: 8px;
            }

            .share {
                margin-top: 450px;
                padding: 8px;
            }

            .search_field {
                margin-top: 16px;
            }

            .srch-btn {
                text-align: center
            }

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