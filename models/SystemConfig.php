<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "system_config".
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $is_enabled
 */
class SystemConfig extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'system_config';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['is_enabled'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'is_enabled' => 'Is Enabled',
        ];
    }
}
