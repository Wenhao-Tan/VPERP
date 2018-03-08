<?php

namespace frontend\modules\frame\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\frame\models\Price;

/**
 * PriceSearch represents the models behind the search form about `frontend\modules\frame\models\Price`.
 */
class PriceSearch extends Price
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['reference'], 'safe'],
            [['purchase_price', 'wholesale_price_cny', 'wholesale_min_price_cny', 'wholesale_price_usd', 'wholesale_min_price_usd', 'retailing_price_cny', 'retailing_price_usd'], 'number'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Price::find();

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
            'purchase_price' => $this->purchase_price,
            'wholesale_price_cny' => $this->wholesale_price_cny,
            'wholesale_min_price_cny' => $this->wholesale_min_price_cny,
            'wholesale_price_usd' => $this->wholesale_price_usd,
            'wholesale_min_price_usd' => $this->wholesale_min_price_usd,
            'retailing_price_cny' => $this->retailing_price_cny,
            'retailing_price_usd' => $this->retailing_price_usd,
        ]);

        $query->andFilterWhere(['like', 'reference', $this->reference]);

        return $dataProvider;
    }
}
