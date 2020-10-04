<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%songs}}`.
 */
class m200218_123820_create_songs_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%songs}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull(),
            'url' => $this->text(),
            'duration' => $this->string(),
            'genre_id' => $this->integer()->notNull(),
            'created_at' => $this->integer(11)->notNull()->unsigned(),
            'updated_at' => $this->integer(11)->notNull()->unsigned(),
        ]);

        // creates index for column `genre_id`
        $this->createIndex(
            '{{%idx-genre_id}}',
            '{{%songs}}',
            'genre_id'
        );

        // add foreign key for table `{{%songs}}`
        $this->addForeignKey(
            '{{%fk-idx-genre_id}}',
            '{{%songs}}',
            'genre_id',
            '{{%genre}}',
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
            '{{%fk-idx-genre_id}}',
            '{{%genre}}'
        );

        $this->dropIndex(
            '{{%idx-genre_id}}',
            '{{%genre}}'
        );

        $this->dropTable('{{%songs}}');
    }
}
