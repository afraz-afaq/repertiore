<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m200218_122920_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull(),
            'username' => $this->string(50)->notNull(),
            'email' => $this->string(100)->notNull(),
            'password' => $this->string(50)->notNull(),
            'created_at' => $this->integer(11)->notNull()->unsigned(),
            'updated_at' => $this->integer(11)->notNull()->unsigned(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
