<?php

namespace common\searchModels;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Countries;

/**
 * CountrySearch represents the model behind the search form of `common\models\Countries`.
 */
class CountrySearch extends Countries
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['iso', 'continent', 'name', 'name_en', 'name_ru', 'name_uk', 'name_az', 'name_ka', 'name_cs', 'name_hy', 'name_pl', 'name_nl', 'name_fr', 'name_tr', 'name_de', 'name_et', 'name_sk', 'name_zh', 'name_it', 'timezone'], 'safe'],
            [['lat', 'lon'], 'number'],
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
        $query = Countries::find();

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
            'id' => $this->id,
            'lat' => $this->lat,
            'lon' => $this->lon,
        ]);

        $query->andFilterWhere(['ilike', 'iso', $this->iso])
            ->andFilterWhere(['ilike', 'continent', $this->continent])
            ->andFilterWhere(['ilike', 'name', $this->name])
            ->andFilterWhere(['ilike', 'name_en', $this->name_en])
            ->andFilterWhere(['ilike', 'name_ru', $this->name_ru])
            ->andFilterWhere(['ilike', 'name_uk', $this->name_uk])
            ->andFilterWhere(['ilike', 'name_az', $this->name_az])
            ->andFilterWhere(['ilike', 'name_ka', $this->name_ka])
            ->andFilterWhere(['ilike', 'name_cs', $this->name_cs])
            ->andFilterWhere(['ilike', 'name_hy', $this->name_hy])
            ->andFilterWhere(['ilike', 'name_pl', $this->name_pl])
            ->andFilterWhere(['ilike', 'name_nl', $this->name_nl])
            ->andFilterWhere(['ilike', 'name_fr', $this->name_fr])
            ->andFilterWhere(['ilike', 'name_tr', $this->name_tr])
            ->andFilterWhere(['ilike', 'name_de', $this->name_de])
            ->andFilterWhere(['ilike', 'name_et', $this->name_et])
            ->andFilterWhere(['ilike', 'name_sk', $this->name_sk])
            ->andFilterWhere(['ilike', 'name_zh', $this->name_zh])
            ->andFilterWhere(['ilike', 'name_it', $this->name_it])
            ->andFilterWhere(['ilike', 'timezone', $this->timezone]);

        return $dataProvider;
    }
}
