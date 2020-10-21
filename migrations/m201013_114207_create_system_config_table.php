<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%system_config}}`.
 */
class m201013_114207_create_system_config_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%system_config}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'is_enabled' => $this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%system_config}}');
    }
}
