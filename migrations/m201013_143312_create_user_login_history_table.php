<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_login_history}}`.
 */
class m201013_143312_create_user_login_history_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_login_history}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'date' => $this->date(),
            'ip' => $this->string(),
            'created_at' => $this->integer(11)->unsigned(),
            'updated_at' => $this->integer(11)->unsigned(),
        ]);

        $this->createIndex(
            '{{%idx-user_login_history}}',
            '{{%user_login_history}}',
            'user_id'
        );

        // add foreign key for table `{{%songs}}`
        $this->addForeignKey(
            '{{%fk-user_login_history}}',
            '{{%user_login_history}}',
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
            '{{%fk-user_login_history}}',
            '{{%user_login_history}}'
        );

        $this->dropIndex(
            '{{%idx-user_login_history}}',
            '{{%user_login_history}}'
        );

        $this->dropTable('{{%user_login_history}}');
    }
}
