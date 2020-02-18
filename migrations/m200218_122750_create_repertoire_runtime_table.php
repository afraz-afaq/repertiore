<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%repertoire_runtime}}`.
 */
class m200218_122750_create_repertoire_runtime_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%repertoire_runtime}}', [
            'id' => $this->primaryKey(),
            'runtime' => $this->string(),
            'created_at' => $this->integer(11)->notNull()->unsigned(),
            'updated_at' => $this->integer(11)->notNull()->unsigned(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%repertoire_runtime}}');
    }
}
