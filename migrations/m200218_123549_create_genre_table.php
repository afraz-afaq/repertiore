<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%genre}}`.
 */
class m200218_123549_create_genre_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%genre}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull(),
            'created_at' => $this->integer(11)->notNull()->unsigned(),
            'updated_at' => $this->integer(11)->notNull()->unsigned(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%genre}}');
    }
}
