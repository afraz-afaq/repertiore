<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%requests}}`.
 */
class m200218_125305_create_requests_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%requests}}', [
            'id' => $this->primaryKey(),
            'full_name' => $this->string(100)->notNull(),
            'email' => $this->string(100)->notNull(),
            'contact' => $this->string(50)->notNull(),
            'total_runtime' => $this->string(5)->notNull(),
            'created_at' => $this->integer(11)->notNull()->unsigned(),
            'updated_at' => $this->integer(11)->notNull()->unsigned(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%requests}}');
    }
}
