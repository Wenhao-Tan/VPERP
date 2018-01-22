<?php
namespace common\modules\customer\models;


use yii\db\ActiveRecord;

class Address extends ActiveRecord
{
    public function rules()
    {
        return [
            [['name', 'street_1', 'city', 'country'], 'required'],
            [['name', 'company', 'street_1', 'street_2',
                'city', 'state', 'zip_code', 'mobile_phone', 'other_phone'], 'trim'],
        ];
    }
}