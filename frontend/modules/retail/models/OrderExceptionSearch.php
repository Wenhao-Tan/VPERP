<?php

namespace frontend\modules\retail\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\retail\models\OrderException;

/**
 * OrderExceptionSearch represents the models behind the search form about `frontend\modules\retail\models\OrderException`.
 */
class OrderExceptionSearch extends OrderException
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['order_id', 'currency', 'penalty_date', 'staff', 'reason'], 'safe'],
            [['order_amount', 'penalty_amount'], 'number'],
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
        $query = OrderException::find();

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
            'order_amount' => $this->order_amount,
            'penalty_date' => $this->penalty_date,
            'penalty_amount' => $this->penalty_amount,
        ]);

        $query->andFilterWhere(['like', 'order_id', $this->order_id])
            ->andFilterWhere(['like', 'currency', $this->currency])
            ->andFilterWhere(['like', 'staff', $this->staff])
            ->andFilterWhere(['like', 'reason', $this->reason]);

        return $dataProvider;
    }
}
