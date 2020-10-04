<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Song;

/**
 * SongSearch represents the model behind the search form of `app\models\Song`.
 */
class SongSearch extends Song
{
    public $genre;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'genre_id', 'created_at', 'updated_at'], 'integer'],
            [['name', 'url', 'duration','genre'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Song::find()->joinWith('genre');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'songs.id' => $this->id,
            'genre_id' => $this->genre_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'songs.name', $this->name])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'duration', $this->duration])
            ->andFilterWhere(['like', 'genre.name', $this->genre]);

        return $dataProvider;
    }
}
