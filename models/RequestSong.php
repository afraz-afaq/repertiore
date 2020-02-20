<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "request_songs".
 *
 * @property int $id
 * @property int|null $request_id
 * @property int|null $song_id
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Request $request
 * @property Song $song
 */
class RequestSong extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'request_songs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['request_id', 'song_id', 'created_at', 'updated_at'], 'integer'],
            [['created_at', 'updated_at'], 'required'],
            [['request_id'], 'exist', 'skipOnError' => true, 'targetClass' => Request::className(), 'targetAttribute' => ['request_id' => 'id']],
            [['song_id'], 'exist', 'skipOnError' => true, 'targetClass' => Song::className(), 'targetAttribute' => ['song_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'request_id' => 'Request ID',
            'song_id' => 'Song ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Request]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRequest()
    {
        return $this->hasOne(Request::className(), ['id' => 'request_id']);
    }

    /**
     * Gets query for [[Song]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSong()
    {
        return $this->hasOne(Song::className(), ['id' => 'song_id']);
    }
}
