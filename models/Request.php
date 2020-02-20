<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "requests".
 *
 * @property int $id
 * @property string $full_name
 * @property string $email
 * @property string $contact
 * @property string $total_runtime
 * @property int $created_at
 * @property int $updated_at
 *
 * @property RequestSong[] $requestSongs
 */
class Request extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'requests';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['full_name', 'email', 'contact', 'total_runtime', 'created_at', 'updated_at'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['full_name', 'email'], 'string', 'max' => 100],
            [['contact'], 'string', 'max' => 50],
            [['total_runtime'], 'string', 'max' => 5],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'full_name' => 'Full Name',
            'email' => 'Email',
            'contact' => 'Contact',
            'total_runtime' => 'Total Runtime',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[RequestSongs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRequestSongs()
    {
        return $this->hasMany(RequestSong::className(), ['request_id' => 'id']);
    }
}
