<?php

namespace common\searchModels;

use common\helpers\CasinoHelper;
use shop\helpers\ProductHelper;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Casino;

/**
 * CasinoSearch represents the model behind the search form of `common\models\Casino`.
 */
class CasinoSearch extends Casino
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'country_id'], 'integer'],
            [['title', 'logo', 'background', 'website', 'description'], 'safe'],
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
        $query = Casino::find();

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
            'country_id' => $this->country_id,
        ]);

        $query->andFilterWhere(['ilike', 'title', $this->title])
            ->andFilterWhere(['ilike', 'logo', $this->logo])
            ->andFilterWhere(['ilike', 'background', $this->background])
            ->andFilterWhere(['ilike', 'website', $this->website])
            ->andFilterWhere(['ilike', 'description', $this->description]);

        return $dataProvider;
    }

    /**
     * @return mixed
     */
    public function statusList()
    {
        return CasinoHelper::statusList();
    }
}
