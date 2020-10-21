<?php

use app\models\User;
use yii\db\Migration;

/**
 * Handles adding columns to table `{{%user}}`.
 */
class m201004_165824_add_type_column_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user','type',$this->integer()->after('username'));
        $this->addColumn('user','status',$this->integer()->after('type')->defaultValue(User::ACTIVE));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user','type');
        $this->dropColumn('user','status');

    }
}
