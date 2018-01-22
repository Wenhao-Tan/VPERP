<?php
namespace common\modules\order\models;


use yii\base\Model;
use yii\data\ActiveDataProvider;

class OrderSearch extends Order
{
    public function rules()
    {
        return [
            [
                ['order_amount', 'shipping_charges'], 'number',
            ],
            [
                ['order_id', 'order_date', 'sales_representative',
                    'customer_name', 'country_of_destination', 'currency',
                    'incoterm', 'custom_declaration', 'status', 'full_name'], 'safe'
            ],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Order::find()->select(['order.*', 'CONCAT(`customer`.`given_name`, " ", `customer`.`family_name`) as full_name'])
            ->joinWith(['customer']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 15,
            ],
            'sort'       => [
                'defaultOrder' => ['order_date' => SORT_DESC],
            ],
        ]);

        // load the search form data and validate
        if (!($this->load($params)) && $this->validate()) {
            return $dataProvider;
        }

        // adjust the query by adding the filters
        $query->andFilterWhere(['like', 'order_id', $this->order_id])
            ->andFilterWhere(['like', 'order_date', $this->order_date])
            ->andFilterWhere(['like', 'order.sales_representative', $this->sales_representative])
            ->andFilterWhere(['like', 'customer_name', $this->customer_name])
            ->andFilterWhere(['like', 'country_of_destination', $this->country_of_destination])
            ->andFilterWhere(['custom_declaration' => $this->custom_declaration])
            ->andFilterWhere(['status' => $this->status])
            ->andFilterWhere(['like', 'CONCAT(given_name, " ", family_name)', $this->full_name]);

        return $dataProvider;
    }
}