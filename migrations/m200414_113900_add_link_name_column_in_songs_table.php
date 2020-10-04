<?php

use yii\db\Migration;

/**
 * Class m200414_113900_add_link_name_column_in_songs_table
 */
class m200414_113900_add_link_name_column_in_songs_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn("songs", "link_name", $this->string()->after("url"));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn("songs", "link_name");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200414_113900_add_song_cover_column_in_songs_table cannot be reverted.\n";

        return false;
    }
    */
}
