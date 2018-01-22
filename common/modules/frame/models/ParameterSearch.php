<?php

namespace common\modules\frame\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\frame\models\Parameter;

/**
 * ParameterSearch represents the models behind the search form about `common\modules\frame\models\Parameter`.
 */
class ParameterSearch extends Parameter
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['reference', 'front_material', 'temple_material', 'rim_type', 'shape'], 'safe'],
            [['lens_width', 'bridge_width', 'temple_length', 'frame_width', 'lens_height', 'spring_hinge', 'clip_on'], 'integer'],
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
        $query = Parameter::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC,
                ]
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'lens_width' => $this->lens_width,
            'bridge_width' => $this->bridge_width,
            'temple_length' => $this->temple_length,
            'frame_width' => $this->frame_width,
            'lens_height' => $this->lens_height,
            'spring_hinge' => $this->spring_hinge,
            'clip_on' => $this->clip_on,
        ]);

        $query->andFilterWhere(['like', 'reference', $this->reference])
            ->andFilterWhere(['like', 'front_material', $this->front_material])
            ->andFilterWhere(['like', 'temple_material', $this->temple_material])
            ->andFilterWhere(['like', 'rim_type', $this->rim_type])
            ->andFilterWhere(['like', 'shape', $this->shape]);

        return $dataProvider;
    }
}
