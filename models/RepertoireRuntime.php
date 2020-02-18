<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "repertoire_runtime".
 *
 * @property int $id
 * @property string|null $runtime
 * @property int $created_at
 * @property int $updated_at
 */
class RepertoireRuntime extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'repertoire_runtime';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['runtime'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'runtime' => 'Runtime',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
