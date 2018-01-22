<?php

namespace common\modules\customer\models;

use backend\modules\user\models\UserAssigned;
use Yii;
use yii\data\ActiveDataProvider;

class CustomerSearch extends Customer
{
    public function rules()
    {
        return [
            [['given_name', 'family_name', 'nationality', 'email', 'mobile_phone', 'whatsapp', 'skype', 'company'],'safe',],
            [['given_name', 'family_name', 'nationality', 'email', 'mobile_phone', 'whatsapp', 'skype', 'company'],'string',],
        ];
    }

    public function search($params)
    {
        $query = Customer::find();

        if ($this->load($params) && $this->validate()) {
            $query->andFilterWhere(['like', 'given_name', $this->given_name]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['created_at' => SORT_DESC]],
        ]);

        // Get current staff
        if (!Yii::$app->user->can('admin')) {
            $staffId = UserAssigned::getCurrentStaffId();
            $dataProvider->query->where(['sales_representative' => $staffId]);
        }

        return $dataProvider;
    }
}