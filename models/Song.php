<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "songs".
 *
 * @property int $id
 * @property string $name
 * @property string $url
 * @property string|null $duration
 * @property int $genre_id
 * @property int $created_at
 * @property int $updated_at
 *
 * @property RequestSong[] $requestSongs
 * @property Genre $genre
 */
class Song extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'songs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'url', 'genre_id', 'created_at', 'updated_at'], 'required'],
            [['url'], 'string'],
            [['genre_id', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['duration'], 'string', 'max' => 255],
            [['genre_id'], 'exist', 'skipOnError' => true, 'targetClass' => Genre::className(), 'targetAttribute' => ['genre_id' => 'id']],
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
            'url' => 'Url',
            'duration' => 'Duration',
            'genre_id' => 'Genre',
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
        return $this->hasMany(RequestSong::className(), ['song_id' => 'id']);
    }

    /**
     * Gets query for [[Genre]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGenre()
    {
        return $this->hasOne(Genre::className(), ['id' => 'genre_id']);
    }
}
