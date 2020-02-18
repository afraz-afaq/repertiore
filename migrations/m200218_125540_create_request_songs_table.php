<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%request_songs}}`.
 */
class m200218_125540_create_request_songs_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%request_songs}}', [
            'id' => $this->primaryKey(),
            'request_id' => $this->integer(),
            'song_id' => $this->integer(),
            'created_at' => $this->integer(11)->notNull()->unsigned(),
            'updated_at' => $this->integer(11)->notNull()->unsigned(),
        ]);

        // creates index for column `request_id`
        $this->createIndex(
            '{{%idx-requests-request_id}}',
            '{{%request_songs}}',
            'request_id'
        );

        // add foreign key for table `{{%request_songs}}`
        $this->addForeignKey(
            '{{%fk-requests-request_id}}',
            '{{%request_songs}}',
            'request_id',
            '{{%requests}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        // creates index for column `song_id`
        $this->createIndex(
            '{{%idx-songs-song_id}}',
            '{{%request_songs}}',
            'song_id'
        );

        // add foreign key for table `{{%request_songs}}`
        $this->addForeignKey(
            '{{%fk-songs-song_id}}',
            '{{%request_songs}}',
            'song_id',
            '{{%songs}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            '{{%fk-requests-request_id}}',
            '{{%request_songs}}'
        );


        $this->dropIndex(
            '{{%idx-requests-request_id}}}',
            '{{%request_songs}}'
        );


        $this->dropForeignKey(
            '{{%fk-songs-song_id}}',
            '{{%request_songs}}'
        );


        $this->dropIndex(
            '{{%idx-songs-song_id}}',
            '{{%request_songs}}'
        );


        $this->dropTable('{{%request_songs}}');
    }
}
