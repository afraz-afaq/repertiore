<?php

use yii\db\Migration;

/**
 * Class m200416_095938_make_url_nullable_in_songs_Table
 */
class m200416_095938_make_url_nullable_in_songs_Table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn("songs","url",$this->string()->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200416_095938_make_url_nullable_in_songs_Table cannot be reverted.\n";

        return false;
    }
    */
}
