<?php
namespace common\modules\lens\models;

use yii\data\ActiveDataProvider;

class CustomizeSearch extends Customize
{
    public function rules()
    {
        return [
            [['created_at','custom_number', 'ref_number', 'supplier', 'status'], 'safe'],
        ];
    }

    public function search($params) {
        $query = Customize::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC,
                ],
            ],
            'pagination' => ['pageSize' => 15],
        ]);

        if(!($this->load($params)) && $this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'created_at', $this->created_at])
            ->andFilterWhere(['like', 'custom_number', $this->custom_number])
            ->andFilterWhere(['like', 'ref_number', $this->ref_number])
            ->andFilterWhere(['supplier' => $this->supplier])
            ->andFilterWhere(['status' => $this->status]);

        return $dataProvider;
    }
}