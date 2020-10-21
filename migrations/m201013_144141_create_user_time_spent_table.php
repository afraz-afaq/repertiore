<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_time_spent}}`.
 */
class m201013_144141_create_user_time_spent_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_time_spent}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'time_spent' => $this->integer()
        ]);

        $this->createIndex(
            '{{%idx-user_time_spent}}',
            '{{%user_time_spent}}',
            'user_id'
        );

        // add foreign key for table `{{%songs}}`
        $this->addForeignKey(
            '{{%fk-user_time_spent}}',
            '{{%user_time_spent}}',
            'user_id',
            '{{%user}}',
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
            '{{%fk-user_time_spent}}',
            '{{%user_time_spent}}'
        );

        $this->dropIndex(
            '{{%idx-user_time_spent}}',
            '{{%user_time_spent}}'
        );

        $this->dropTable('{{%user_time_spent}}');
    }
}
