<?php
/**
 * Created by PhpStorm.
 * User: rohan
 * Date: 20/6/16
 * Time: 1:46 AM
 */

use yii\helpers\Html;
use kartik\growl\Growl;
?>
<?php
 foreach (\Yii::$app->session->getAllFlashes() as $message):; ?>
    <?php
     if(isset($message['alertbox']) and $message['alertbox'] == true){ ?>
         <?php foreach (Yii::$app->session->getAllFlashes() as $message):; ?>
             <div class="col-md-12">
                <div class="alert <?php echo (!empty($message['type'])) ? $message['type'] : 'alert-danger'?> alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong><?php echo (!empty($message['title'])) ? $message['title'] : 'Message Not Set!'?></strong>
                    <?php echo (!empty($message['message'])) ? $message['message'] : 'Message Not Set!'?> :
                </div>
             </div>
         <?php endforeach; ?>

    <?php
         } else {
         echo Growl::widget([
             'type' => (!empty($message['type'])) ? $message['type'] : 'danger',
             'title' => (!empty($message['title'])) ? Html::encode($message['title']) : 'Title Not Set!',
             'icon' => (!empty($message['icon'])) ? $message['icon'] : 'fa fa-info',
             'body' => (!empty($message['message'])) ? Html::encode($message['message']) : 'Message Not Set!',
             'showSeparator' => true,
             'delay' => 1, //This delay is how long before the message shows
             'pluginOptions' => [
                 'delay' => (!empty($message['duration'])) ? $message['duration'] : 3000, //This delay is how long the message shows for
                 'placement' => [
                     'from' => (!empty($message['positonY'])) ? $message['positonY'] : 'top',
                     'align' => (!empty($message['positonX'])) ? $message['positonX'] : 'right',
                 ]
             ]
         ]);
     }
    ?>
<?php endforeach; ?>



