<?php

use yii\db\Migration;

/**
 * Class m200424_145609_add_artist_column_in_songs_table
 */
class m200424_145609_add_artist_column_in_songs_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn("songs", "artist", $this->string()->after("name"));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn("songs", "artist");
    }
}
