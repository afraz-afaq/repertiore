<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "songs".
 *
 * @property int $id
 * @property string $name
 * @property string $artist
 * @property string $url
 * @property string $link_name
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
            [['name', 'genre_id', 'duration', 'artist','link_name'], 'required'],
            [['url', 'link_name'], 'string'],
            [['genre_id', 'created_at', 'updated_at'], 'integer'],
            [['name', 'artist'], 'string', 'max' => 100],
            //            [['duration'], 'string', 'max' => 255],
            [['duration'], 'integer'],
            [['genre_id'], 'exist', 'skipOnError' => true, 'targetClass' => Genre::className(), 'targetAttribute' => ['genre_id' => 'id']],
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
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
            'artist' => 'Artist',
            'url' => 'Url',
            'link_name' => 'Link Name',
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
