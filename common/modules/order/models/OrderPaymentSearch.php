<?php
/**
 * Created by PhpStorm.
 * User: Paul
 * Date: 2017/7/19
 * Time: 7:51
 */

namespace common\modules\order\models;


use yii\base\Model;
use yii\data\ActiveDataProvider;

class OrderPaymentSearch extends Model
{
    public function search($params)
    {
        $query = OrderPayment::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 15,
            ],
            'sort' => [
                'defaultOrder' => ['payment_date' => SORT_DESC],
            ],
        ]);

        if (!$this->load($params) && $this->validate()) {
            return $dataProvider;
        }
    }
}