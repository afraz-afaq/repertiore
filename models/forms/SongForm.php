<?php

namespace app\models\forms;

use app\models\Song;

class SongForm extends Song
{

    const SCENARIO_CREATE = 1;
    const SCENARIO_UPDATE = 2;


    public $uploaded_cover;
    public $uploaded_song;
    public $song_cover;
    public $song_url;
    public $song_check;

    public function rules()
    {
        return [
            ['song_url', 'file', 'skipOnEmpty' => true, 'extensions' => 'mp3'],
            ['song_cover', 'image', 'skipOnEmpty' => true, 'extensions' => 'jpg, png'],
            [['name', 'genre_id', 'duration', 'artist','link_name'], 'required'],
            ['name', 'unique', 'targetClass' => Song::class],
            [['url', 'song_cover', 'link_name'], 'string'],
            ['link_name', 'unique'],
            [['name'], 'string', 'max' => 100],
            [['duration'], 'integer'],
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
            'song_cover' => 'Song Cover',
            'link_name' => 'Link Name',
            'duration' => 'Duration',
            'genre_id' => 'Genre',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
