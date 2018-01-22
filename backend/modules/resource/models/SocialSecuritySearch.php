<?php

namespace backend\modules\resource\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\resource\models\SocialSecurity;

/**
 * SocialSecuritySearch represents the models behind the search form about `backend\modules\resource\models\SocialSecurity`.
 */
class SocialSecuritySearch extends SocialSecurity
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['month'], 'safe'],
            [['base_value', 'pension_c', 'pension_p', 'medical_c', 'medical_p', 'critical_illness_c', 'critical_illness_p', 'employment_injury_c', 'employment_injury_p', 'maternity_c', 'maternity_p', 'unemployment_c', 'unemployment_p'], 'number'],
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
        $query = SocialSecurity::find();

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
            'month' => $this->month,
            'base_value' => $this->base_value,
            'pension_c' => $this->pension_c,
            'pension_p' => $this->pension_p,
            'medical_c' => $this->medical_c,
            'medical_p' => $this->medical_p,
            'critical_illness_c' => $this->critical_illness_c,
            'critical_illness_p' => $this->critical_illness_p,
            'employment_injury_c' => $this->employment_injury_c,
            'employment_injury_p' => $this->employment_injury_p,
            'maternity_c' => $this->maternity_c,
            'maternity_p' => $this->maternity_p,
            'unemployment_c' => $this->unemployment_c,
            'unemployment_p' => $this->unemployment_p,
        ]);

        return $dataProvider;
    }
}
